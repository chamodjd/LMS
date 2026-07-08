@extends('dashboard_app')

@push('title')
    Courses
@endpush

@section('content')

    <div style="margin-left:220px; padding:24px; flex:1; background:#f9fafb;">

        <h1 style="font-size:22px; font-weight:600; color:#111827; margin-bottom:16px;">Courses</h1>

        @if (session('message'))
            <div
                style="background:#E9F9F0;color:#2FA86A;padding:10px 16px;border-radius:8px;margin-bottom:16px;font-size:14px;">
                {{ session('message') }}
            </div>
        @endif

        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; gap:10px;">
            <input type="text" id="courseSearch" onkeyup="filterCourseTable()" placeholder="Search courses..."
                   style="flex:1; max-width:320px; padding:10px 14px; border:1px solid #e5e7eb; border-radius:6px;">
            <div style="display:flex; gap:10px;">
                <button onclick="openAddCourseModal()"
                        style="background:#5D5FEF;color:#fff;border:none;border-radius:8px;padding:8px 18px;font-size:13px;font-weight:700;cursor:pointer; margin-bottom:16px;">
                    + Add Course
                </button>

                <form id="exportCourseForm" action="{{ route('admin.courses.export.pdf') }}" method="GET">
                    <input type="hidden" name="search" id="exportCourseSearch">
                    <button type="button" onclick="exportFilteredCourses()"
                            style="display:inline-flex; align-items:center; gap:6px; background:#dc2626; color:#fff; padding:6px 10px; border:none; border-radius:6px; font-size:14px; cursor:pointer;">
                        <i class="fa fa-file-pdf-o"></i> Export PDF
                    </button>
                </form>
            </div>
        </div>

        <div style="background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px;">
            <table class="table table-bordered table-hover table-striped" id="courseTable">

                <style>
                    #courseTable th, #courseTable td {
                        padding: 4px 8px;
                        font-size: 12.5px;
                        vertical-align: middle;
                        line-height: 1.3;
                    }

                    .icon-btn {
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                        width: 24px;
                        height: 24px;
                        border: none;
                        border-radius: 5px;
                        cursor: pointer;
                        font-size: 11px;
                        margin-right: 3px;
                        padding: 0;
                    }

                    .icon-btn-update {
                        background: #f59e0b;
                        color: #fff;
                    }

                    .icon-btn-delete {
                        background: #dc2626;
                        color: #fff;
                    }
                </style>

                <thead>
                <tr>
                    <th>ID</th>
                    <th>Course Name</th>
                    <th>Duration</th>
                    <th>Price</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse ($courses as $course)
                    <tr>
                        <td>{{ $course->id }}</td>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->duration }} year{{ $course->duration > 1 ? 's' : '' }}</td>
                        <td>${{ number_format($course->price, 2) }}</td>
                        <td>
                            <button type="button" class="icon-btn icon-btn-update" title="Update"
                                    onclick="openUpdateCourseModal(
                                        {{ $course->id }},
                                        '{{ $course->name }}',
                                        '{{ $course->duration }}',
                                        '{{ $course->price }}'
                                         )"><i class="fa fa-pencil"></i></button>
                            <button type="button" class="icon-btn icon-btn-delete" title="Delete"
                                    onclick="confirmDeleteCourse({{ $course->id }})"><i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center;padding:16px;color:#8A8AA3;">No courses yet.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>
    </div>

    <!-- Update Course Modal -->
    <div class="modal fade" id="updateCourseModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background:#fef3c7;">
                    <h5 class="modal-title">Update course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="update-course-form" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-2">
                            <label style="font-size:13px;">Course Name</label>
                            <input type="text" name="name" id="modal-course-name" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label style="font-size:13px;">Duration (years)</label>
                            <input type="number" name="duration" id="modal-course-duration" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label style="font-size:13px;">Price</label>
                            <input type="number" step="0.01" name="price" id="modal-course-price" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success w-100 mt-2">Update course</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    {{--            courses model--}}
    <div id="addCourseModal"
         style="display:none;position:fixed;inset:0;background:rgba(27,27,51,0.4);z-index:50;align-items:center;justify-content:center;">
        <div style="background:#fff;border-radius:16px;padding:32px;width:100%;max-width:400px;">
            <h3 style="margin:0 0 6px 0;color:#1B1B33;">Add course</h3>
            <p style="margin:0 0 20px 0;color:#8A8AA3;font-size:13px;">Create a new course.</p>

            @if ($errors->any())
                <div
                    style="background:#FDEDED;color:#E14B4B;padding:10px 14px;border-radius:8px;font-size:13px;margin-bottom:16px;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.courses.store') }}">
                @csrf
                <input name="name" placeholder="Course name" required
                       style="width:100%;padding:11px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;">
                <input name="duration" type="number" placeholder="Duration (years)" required
                       style="width:100%;padding:11px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;">
                <input name="price" type="number" step="0.01" placeholder="Price" required
                       style="width:100%;padding:11px;margin-bottom:16px;border:1.5px solid #E4E4EF;border-radius:8px;">
                <div style="display:flex;gap:10px;">
                    <button type="button" onclick="closeAddCourseModal()"
                            style="flex:1;padding:11px;border-radius:8px;border:1.5px solid #E4E4EF;background:#fff;cursor:pointer;">
                        Cancel
                    </button>
                    <button type="submit"
                            style="flex:1;padding:11px;border-radius:8px;border:none;background:#5D5FEF;color:#fff;font-weight:700;cursor:pointer;">
                        Create course
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
