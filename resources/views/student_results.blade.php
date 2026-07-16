@extends('student_app')

@push('title')
    My Results
@endpush

@section('content')

    <div style="margin-left:220px; padding:24px; flex:1; background:#f5f3ff;">

        <h1 style="font-size:22px; font-weight:600; color:#1e1b4b; margin-bottom:4px;">My Results</h1>
        <p style="font-size:14px; color:#6b7280; margin-bottom:24px;">Your exam scores and assignment marks</p>

        @if (session('message'))
            <div style="background:#E9F9F0;color:#2FA86A;padding:10px 16px;border-radius:8px;margin-bottom:16px;font-size:14px;">
                {{ session('message') }}
            </div>
        @endif

        @forelse ($modules as $module)
            <div style="background:white; border-radius:12px; padding:20px; margin-bottom:20px;">

                <div style="display:flex; align-items:center; gap:10px; margin-bottom:16px;">
                    <span style="font-size:11px; background:#eef2ff; color:#4f46e5; padding:2px 8px; border-radius:5px;">{{ $module->module_code }}</span>
                    <h3 style="font-size:16px; font-weight:600; color:#111827;">{{ $module->title }}</h3>
                </div>

                <!-- Exams -->
                <div style="margin-bottom:16px;">
                    <div style="font-size:12px; font-weight:600; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:8px;">Exams</div>

                    @forelse ($module->exams as $exam)
                        @php $attempt = $exam->attempts->first(); @endphp
                        <div style="display:flex; justify-content:space-between; align-items:center; padding:10px 0; border-bottom:1px solid #f3f4f6;">
                            <span style="font-size:14px; color:#111827;">{{ $exam->title }}</span>

                            @if ($attempt)
                                @php
                                    $pct = $attempt->total_questions > 0 ? round(($attempt->score / $attempt->total_questions) * 100) : 0;
                                @endphp
                                <span style="font-size:13px; font-weight:600; color:#16a34a; background:#dcfce7; padding:3px 10px; border-radius:999px;">
                                    {{ $attempt->score }}/{{ $attempt->total_questions }} ({{ $pct }}%)
                                </span>
                            @else
                                <span style="font-size:12px; color:#9ca3af; background:#f3f4f6; padding:3px 10px; border-radius:999px;">Not attempted</span>
                            @endif
                        </div>
                    @empty
                        <p style="font-size:13px; color:#9ca3af;">No published exams yet.</p>
                    @endforelse
                </div>

                <!-- Assignments -->
                <div>
                    <div style="font-size:12px; font-weight:600; color:#6b7280; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:8px;">Assignments</div>

                    @forelse ($module->assignments as $assignment)
                        @php $submission = $assignment->submissions->first(); @endphp
                        <div style="display:flex; justify-content:space-between; align-items:center; padding:10px 0; border-bottom:1px solid #f3f4f6;">
                            <span style="font-size:14px; color:#111827;">{{ $assignment->title }}</span>

                            @if (!$submission)
                                <span style="font-size:12px; color:#9ca3af; background:#f3f4f6; padding:3px 10px; border-radius:999px;">Not submitted</span>
                            @elseif ($submission->published)
                                <span style="display:flex; align-items:center; gap:8px;">
                                    <span style="font-size:13px; font-weight:600; color:#16a34a; background:#dcfce7; padding:3px 10px; border-radius:999px;">
                                        {{ $submission->marks }}/100
                                    </span>
                                    @if ($submission->feedback)
                                        <span style="font-size:12px; color:#6b7280; font-style:italic;">"{{ $submission->feedback }}"</span>
                                    @endif
                                </span>
                            @else
                                <span style="font-size:12px; color:#92400e; background:#fef3c7; padding:3px 10px; border-radius:999px;">Awaiting marks</span>
                            @endif
                        </div>
                    @empty
                        <p style="font-size:13px; color:#9ca3af;">No assignments yet.</p>
                    @endforelse
                </div>

            </div>
        @empty
            <div style="background:white; border-radius:12px; padding:40px; text-align:center; color:#9ca3af;">
                No modules found for your course yet.
            </div>
        @endforelse

    </div>

@endsection
