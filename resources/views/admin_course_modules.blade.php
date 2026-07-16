@extends('dashboard_app')

@push('title')
    {{ $course->name }} - Modules
@endpush
@section('content')

    <div style="margin-left:220px; padding:24px; flex:1; background:#f9fafb;">

        <a href="{{ route('admin.courses') }}" style="font-size:13px; color:#6b7280; text-decoration:none;">
            <i class="fa fa-arrow-left"></i> Back to Courses
        </a>

        <h1 style="font-size:22px; font-weight:600; color:#111827; margin:12px 0 4px;">{{ $course->name }}</h1>
        <p style="font-size:13px; color:#6b7280; margin-bottom:20px;">{{ $course->duration }} years &middot;
            ${{ number_format($course->price, 2) }}</p>

        @if (session('message'))
            <div
                style="background:#E9F9F0;color:#2FA86A;padding:10px 16px;border-radius:8px;margin-bottom:16px;font-size:14px;">
                {{ session('message') }}
            </div>
        @endif

        <button onclick="openAddModuleModal()"
                style="display:inline-flex; align-items:center; gap:6px; background:#5D5FEF; color:#fff; padding:6px 14px; border:none; border-radius:6px; font-size:13px; line-height:1.4; cursor:pointer; margin-bottom:16px;">
            + Add Module
        </button>

        <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(240px, 1fr)); gap:16px;">
            @forelse ($modules as $module)
                <div onclick="window.location.href='{{ route('admin.modules.show', $module) }}'"
                     style="position:relative; background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px; cursor:pointer; transition:transform 0.15s ease, box-shadow 0.15s ease;"
                     onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 6px 16px rgba(0,0,0,0.08)';"
                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">

                    <div style="position:absolute; top:16px; right:16px;">
                        <span style="font-size:11px; font-weight:700; background:#eef2ff; color:#4f46e5; padding:3px 8px; border-radius:5px;">{{ $module->module_code }}</span>
                    </div>

                    <div style="width:44px; height:44px; border-radius:10px; background:#eef2ff; display:flex; align-items:center; justify-content:center; margin-bottom:14px;">
                        <i class="fa fa-file-text-o" style="color:#4f46e5; font-size:18px;"></i>
                    </div>

                    <h4 style="font-size:15px; font-weight:600; color:#111827; margin-bottom:6px; padding-right:50px;">{{ $module->title }}</h4>
                    <p style="font-size:13px; color:#6b7280; margin-bottom:12px; min-height:18px;">{{ $module->description }}</p>

                    @if ($module->instructor)
                        <span style="display:inline-flex; align-items:center; gap:5px; font-size:12px; background:#eff6ff; color:#2563eb; padding:3px 8px; border-radius:5px;">
                    <i class="fa fa-user"></i> {{ $module->instructor->name }}
                </span>
                    @else
                        <span style="font-size:12px; color:#9ca3af;">No teacher assigned</span>
                    @endif

                    <div onclick="event.stopPropagation();" style="display:flex; justify-content:flex-end; align-items:center; margin-top:16px; border-top:1px solid #f3f4f6; padding-top:12px;">
                        <button type="button" class="icon-btn icon-btn-update" title="Update"
                                onclick="openUpdateModuleModal({{ $module->id }}, '{{ $module->title }}', `{{ $module->description }}`, {{ $module->instructor_id ?? 'null' }}, {{ $module->order ?? 1 }})">
                            <i class="fa fa-pencil"></i>
                        </button>
                        <button type="button" class="icon-btn icon-btn-delete" title="Delete"
                                onclick="confirmDeleteModule({{ $module->id }})">
                            <i class="fa fa-trash"></i>
                        </button>
                        ...
                    </div>
                </div>
            @empty
                <p style="color:#8A8AA3;">No modules yet.</p>
            @endforelse
        </div>

    </div>

    <!-- Add Module Modal -->
    <div id="addModuleModal"
         style="display:none;position:fixed;inset:0;background:rgba(27,27,51,0.4);z-index:50;align-items:center;justify-content:center;">
        <div style="background:#fff;border-radius:16px;padding:32px;width:100%;max-width:400px;">
            <h3 style="margin:0 0 20px 0;color:#1B1B33;">Add module</h3>
            <form method="POST" action="{{ route('admin.modules.store', $course) }}">
                @csrf
                <input name="title" placeholder="Module title" required
                       style="width:100%;padding:11px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;">
                <textarea name="description" placeholder="Description" rows="3"
                          style="width:100%;padding:11px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;"></textarea>

                <select name="instructor_id"
                        style="width:100%;padding:11px;margin-bottom:16px;border:1.5px solid #E4E4EF;border-radius:8px;">
                    <option value="">-- Assign teacher (optional) --</option>
                    @forelse ($instructors as $instructor)
                        <option value="{{ $instructor->id }}">{{ $instructor->name }} ({{ $instructor->department }})
                        </option>
                    @empty
                        <option value="" disabled>No instructors in this department</option>
                    @endforelse
                </select>

                <div style="display:flex;gap:10px;">
                    <button type="button" onclick="closeAddModuleModal()"
                            style="flex:1;padding:11px;border-radius:8px;border:1.5px solid #E4E4EF;background:#fff;cursor:pointer;">
                        Cancel
                    </button>
                    <button type="submit"
                            style="flex:1;padding:11px;border-radius:8px;border:none;background:#5D5FEF;color:#fff;font-weight:700;cursor:pointer;">
                        Add module
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Update Module Modal -->
    <div id="updateModuleModal"
         style="display:none;position:fixed;inset:0;background:rgba(27,27,51,0.4);z-index:50;align-items:center;justify-content:center;">
        <div style="background:#fff;border-radius:16px;padding:32px;width:100%;max-width:400px;">
            <h3 style="margin:0 0 20px 0;color:#1B1B33;">Update module</h3>
            <form id="update-module-form" method="POST">
                @csrf
                @method('PUT')
                <input type="text" name="title" id="modal-module-title" placeholder="Module title" required
                       style="width:100%;padding:11px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;">
                <textarea name="description" id="modal-module-description" placeholder="Description" rows="3"
                          style="width:100%;padding:11px;margin-bottom:16px;border:1.5px solid #E4E4EF;border-radius:8px;"></textarea>
                <select name="instructor_id" id="modal-module-instructor"
                        style="width:100%;padding:11px;margin-bottom:16px;border:1.5px solid #E4E4EF;border-radius:8px;">
                    <option value="">-- Assign teacher (optional) --</option>
                    @foreach ($instructors as $instructor)
                        <option value="{{ $instructor->id }}">{{ $instructor->name }} ({{ $instructor->department }})
                        </option>
                    @endforeach
                </select>
                <div style="display:flex;gap:10px;">
                    <button type="button" onclick="closeUpdateModuleModal()"
                            style="flex:1;padding:11px;border-radius:8px;border:1.5px solid #E4E4EF;background:#fff;cursor:pointer;">
                        Cancel
                    </button>
                    <button type="submit"
                            style="flex:1;padding:11px;border-radius:8px;border:none;background:#5D5FEF;color:#fff;font-weight:700;cursor:pointer;">
                        Update module
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
