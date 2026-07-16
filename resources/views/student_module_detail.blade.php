@extends('student_app')
@push('title') {{ $module->title }} @endpush
@section('content')
    <div style="margin-left:220px; padding:24px;">

        <a href="{{ route('student.course') }}" style="font-size:13px; color:#6b7280; text-decoration:none;"><i class="fa fa-arrow-left"></i> Back</a>
        <h1 style="font-size:22px; font-weight:600; margin:12px 0 4px;">{{ $module->title }}</h1>
        <p style="font-size:13px; color:#6b7280; margin-bottom:20px;">{{ $module->description }}</p>

        @if (session('message'))
            <div style="background:#E9F9F0;color:#2FA86A;padding:10px 16px;border-radius:8px;margin-bottom:16px;font-size:14px;">{{ session('message') }}</div>
        @endif

        <!-- LECTURE NOTES -->
        <h3 style="font-size:16px; font-weight:600; margin-bottom:12px;">Lecture Notes</h3>
        <div style="background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px; margin-bottom:24px;">
            @forelse ($module->topics as $topic)
                <div style="padding:12px 0; border-bottom:1px solid #f3f4f6;">
                    <h4 style="font-size:14px; font-weight:600;">{{ $topic->order }}. {{ $topic->title }}</h4>
                    <p style="font-size:13px; color:#6b7280;">{{ $topic->description }}</p>
                    @if ($topic->file_path)
                        <a href="{{ asset('storage/' . $topic->file_path) }}" target="_blank" style="font-size:12px; color:#2563eb;"><i class="fa fa-file-text-o"></i> {{ $topic->original_name }}</a>
                    @endif
                </div>
            @empty
                <p style="color:#8A8AA3; text-align:center;">No lecture notes yet.</p>
            @endforelse
        </div>

        <!-- ASSIGNMENTS -->
        <h3 style="font-size:16px; font-weight:600; margin-bottom:12px;">Assignments</h3>
        <div style="margin-bottom:24px;">
            @forelse ($module->assignments as $assignment)
                <div style="background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px; margin-bottom:12px;">
                    <h4 style="font-size:14px; font-weight:600;">{{ $assignment->title }}</h4>
                    <p style="font-size:13px; color:#6b7280; margin-bottom:8px;">{{ $assignment->description }}</p>
                    @if ($assignment->end_date)
                        <span style="font-size:12px; color:#dc2626;"><i class="fa fa-flag-checkered"></i> Due: {{ \Carbon\Carbon::parse($assignment->end_date)->format('M d, Y g:i A') }}</span>
                    @endif
                    @if ($assignment->file_path)
                        <br><a href="{{ asset('storage/' . $assignment->file_path) }}" target="_blank" style="font-size:12px; color:#2563eb;"><i class="fa fa-paperclip"></i> {{ $assignment->original_name }}</a>
                    @endif

                    <div style="margin-top:12px; padding-top:12px; border-top:1px solid #f3f4f6;">
                        @if ($assignment->my_submission)
                            <span style="font-size:12px; color:#16a34a;"><i class="fa fa-check-circle"></i> Submitted: {{ $assignment->my_submission->original_name }}
                                @if ($assignment->my_submission->marks !== null) &middot; Marks: {{ $assignment->my_submission->marks }} @endif
                        </span>
                        @else
                            <form method="POST" action="{{ route('student.assignments.submit', $assignment) }}" enctype="multipart/form-data" style="display:flex; gap:8px;">
                                @csrf
                                <input type="file" name="file" required style="flex:1; padding:6px; border:1px solid #e5e7eb; border-radius:6px; font-size:12px;">
                                <button type="submit" style="background:#5D5FEF; color:#fff; border:none; border-radius:6px; padding:6px 14px; font-size:12px; cursor:pointer;">Submit</button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <p style="color:#8A8AA3;">No assignments yet.</p>
            @endforelse
        </div>

        <!-- EXAMS -->
        <h3 style="font-size:16px; font-weight:600; margin-bottom:12px;">Exams</h3>
        <div>
            @forelse ($module->exams as $exam)
                <div style="background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px; margin-bottom:12px; display:flex; justify-content:space-between; align-items:center;">
                    <div>
                        <h4 style="font-size:14px; font-weight:600;">{{ $exam->title }}</h4>
                        <span style="font-size:12px; color:#6b7280;">{{ $exam->questions->count() }} questions @if($exam->duration_minutes) &middot; {{ $exam->duration_minutes }} mins @endif</span>
                    </div>
                    @if ($exam->my_attempt)
                        <span style="font-size:13px; color:#16a34a; font-weight:600;">Score: {{ $exam->my_attempt->score }}/{{ $exam->my_attempt->total_questions }}</span>
                    @else
                        <a href="{{ route('student.exams.take', $exam) }}" style="background:#5D5FEF; color:#fff; padding:8px 16px; border-radius:6px; font-size:13px; text-decoration:none;">Take Exam</a>
                    @endif
                </div>
            @empty
                <p style="color:#8A8AA3;">No exams available yet.</p>
            @endforelse
        </div>

    </div>
@endsection
