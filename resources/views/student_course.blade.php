@extends('student_app')
@push('title') My Course @endpush
@section('content')
    <div style="margin-left:220px; padding:24px;">
        <h1 style="font-size:22px; font-weight:600; color:#111827; margin-bottom:4px;">{{ $course->name }}</h1>
        <p style="font-size:13px; color:#6b7280; margin-bottom:20px;">{{ $course->duration }} years</p>

        <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(240px, 1fr)); gap:16px;">
            @forelse ($modules as $module)
                <a href="{{ route('student.modules.show', $module) }}" style="text-decoration:none;">
                    <div style="background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px; cursor:pointer; transition:transform 0.15s ease;"
                         onmouseover="this.style.transform='translateY(-3px)';" onmouseout="this.style.transform='translateY(0)';">
                        <span style="font-size:11px; font-weight:700; background:#eef2ff; color:#4f46e5; padding:3px 8px; border-radius:5px;">{{ $module->module_code }}</span>
                        <h4 style="font-size:15px; font-weight:600; color:#111827; margin:10px 0 4px;">{{ $module->title }}</h4>
                        <p style="font-size:13px; color:#6b7280;">{{ $module->description }}</p>
                        @if ($module->instructor)
                            <span style="font-size:12px; color:#2563eb; margin-top:8px; display:block;"><i class="fa fa-user"></i> {{ $module->instructor->name }}</span>
                        @endif
                    </div>
                </a>
            @empty
                <p style="color:#8A8AA3;">No modules available yet.</p>
            @endforelse
        </div>
    </div>
@endsection
