@extends('student_app')

@push('title')
    {{ $exam->title }}
@endpush
@section('content')

<div style="margin-left:220px; padding:24px; flex:1;">

    <h1 style="font-size:20px; font-weight:600; color:#1e1b4b; margin-bottom:4px;">{{ $exam->title }}</h1>
    <p style="font-size:13px; color:#6b7280; margin-bottom:20px;">
        {{ $questions->count() }} questions
        @if ($exam->duration_minutes) &middot; {{ $exam->duration_minutes }} minutes @endif
    </p>

    <form method="POST" action="{{ route('student.exams.submit', $exam) }}">
        @csrf

        @foreach ($questions as $i => $question)
            <div style="background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px; margin-bottom:16px;">
                <p style="font-weight:600; color:#111827; margin-bottom:14px;">{{ $i + 1 }}. {{ $question->question }}</p>

                <label style="display:flex; align-items:center; gap:8px; padding:10px; border:1px solid #e5e7eb; border-radius:8px; margin-bottom:8px; cursor:pointer;">
                    <input type="radio" name="answers[{{ $question->id }}]" value="a" required>
                    <span>{{ $question->option_a }}</span>
                </label>
                <label style="display:flex; align-items:center; gap:8px; padding:10px; border:1px solid #e5e7eb; border-radius:8px; margin-bottom:8px; cursor:pointer;">
                    <input type="radio" name="answers[{{ $question->id }}]" value="b">
                    <span>{{ $question->option_b }}</span>
                </label>
                <label style="display:flex; align-items:center; gap:8px; padding:10px; border:1px solid #e5e7eb; border-radius:8px; margin-bottom:8px; cursor:pointer;">
                    <input type="radio" name="answers[{{ $question->id }}]" value="c">
                    <span>{{ $question->option_c }}</span>
                </label>
                <label style="display:flex; align-items:center; gap:8px; padding:10px; border:1px solid #e5e7eb; border-radius:8px; cursor:pointer;">
                    <input type="radio" name="answers[{{ $question->id }}]" value="d">
                    <span>{{ $question->option_d }}</span>
                </label>
            </div>
        @endforeach

        <button type="submit" onclick="return confirm('Submit your answers? You cannot change them after submitting.');"
                style="background:#5D5FEF; color:#fff; border:none; border-radius:8px; padding:12px 28px; font-size:14px; font-weight:700; cursor:pointer;">
            Submit Exam
        </button>
    </form>

</div>

@endsection
