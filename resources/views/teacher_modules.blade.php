@extends('teacher_app')

@push('title')
    My Courses
@endpush
@section('content')

    <div style="margin-left:220px; padding:24px; flex:1; background:#f0fdf4;">

        <h1 style="font-size:22px; font-weight:600; color:#064e3b; margin-bottom:16px;">My Courses</h1>

        @if (session('message'))
            <div style="background:#E9F9F0;color:#2FA86A;padding:10px 16px;border-radius:8px;margin-bottom:16px;font-size:14px;">
                {{ session('message') }}
            </div>
        @endif

        <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(240px, 1fr)); gap:16px;">
            @forelse ($modules as $module)
                <a href="{{ route('teacher.modules.show', $module) }}" style="text-decoration:none;">
                    <div style="position:relative; background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px; cursor:pointer; transition:transform 0.15s ease, box-shadow 0.15s ease;"
                         onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 6px 16px rgba(0,0,0,0.08)';"
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">

                        <div style="position:absolute; top:16px; right:16px;">
                            <span style="font-size:11px; font-weight:700; background:#d1fae5; color:#059669; padding:3px 8px; border-radius:5px;">{{ $module->module_code }}</span>
                        </div>

                        <div style="width:44px; height:44px; border-radius:10px; background:#d1fae5; display:flex; align-items:center; justify-content:center; margin-bottom:14px;">
                            <i class="fa fa-book" style="color:#059669; font-size:18px;"></i>
                        </div>

                        <h4 style="font-size:15px; font-weight:600; color:#111827; margin-bottom:6px; padding-right:60px;">{{ $module->title }}</h4>
                        <p style="font-size:13px; color:#6b7280; margin-bottom:8px;">{{ $module->description }}</p>
                        <span style="font-size:12px; color:#059669;"><i class="fa fa-graduation-cap"></i> {{ $module->course->name }}</span>
                    </div>
                </a>
            @empty
                <p style="color:#8A8AA3;">No modules assigned to you yet.</p>
            @endforelse
        </div>

    </div>

@endsection
