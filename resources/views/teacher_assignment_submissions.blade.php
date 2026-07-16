@extends('teacher_app')

@section('content')

    <div style="margin-left:220px; padding:24px; flex:1; background:#f0fdf4;">

        <a href="{{ route('teacher.modules.show', $assignment->course_module_id) }}" style="color:#059669; text-decoration:none; font-size:14px;">
            <i class="fa fa-arrow-left"></i> Back to module
        </a>

        <h1 style="font-size:22px; font-weight:700; margin:15px 0 5px;">{{ $assignment->title }}</h1>
        <p style="color:#6b7280; margin-bottom:20px;">{{ $submissions->count() }} submission(s)</p>

        @if (session('message'))
            <div style="background:#d1fae5; color:#065f46; padding:12px 16px; border-radius:8px; margin-bottom:20px;">
                {{ session('message') }}
            </div>
        @endif

        @if ($submissions->where('checked', true)->where('published', false)->count() > 0)
            <form action="{{ route('teacher.assignments.publish-all', $assignment) }}" method="POST" style="margin-bottom:20px;">
                @csrf
                <button type="submit" style="background:#065f46; color:white; border:none; padding:10px 18px; border-radius:8px; cursor:pointer;">
                    <i class="fa fa-bullhorn"></i> Publish All Checked Marks
                </button>
            </form>
        @endif

        <div style="background:white; border-radius:12px; overflow:hidden; box-shadow:0 1px 3px rgba(0,0,0,0.1);">
            <table style="width:100%; border-collapse:collapse;">
                <thead>
                <tr style="background:#f9fafb; text-align:left;">
                    <th style="padding:12px 16px; font-size:13px; color:#6b7280;">Student</th>
                    <th style="padding:12px 16px; font-size:13px; color:#6b7280;">Submitted</th>
                    <th style="padding:12px 16px; font-size:13px; color:#6b7280;">File</th>
                    <th style="padding:12px 16px; font-size:13px; color:#6b7280;">Status</th>
                    <th style="padding:12px 16px; font-size:13px; color:#6b7280;">Marks</th>
                    <th style="padding:12px 16px; font-size:13px; color:#6b7280;">Feedback</th>
                    <th style="padding:12px 16px; font-size:13px; color:#6b7280;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($submissions as $submission)
                    <tr style="border-top:1px solid #f3f4f6;">
                        <td style="padding:12px 16px;">{{ $submission->student->name ?? 'N/A' }}</td>
                        <td style="padding:12px 16px;">{{ optional($submission->submitted_at)->format('d M Y, h:i A') }}</td>
                        <td style="padding:12px 16px;">
                            @if ($submission->file_path)
                                <a href="{{ Storage::url($submission->file_path) }}" target="_blank" style="color:#2563eb;">
                                    {{ $submission->original_name ?? 'Download' }}
                                </a>
                            @else
                                —
                            @endif
                        </td>
                        <td style="padding:12px 16px;">
                            @if ($submission->published)
                                <span style="background:#d1fae5; color:#065f46; padding:3px 10px; border-radius:999px; font-size:12px;">Published</span>
                            @elseif ($submission->checked)
                                <span style="background:#dbeafe; color:#1e40af; padding:3px 10px; border-radius:999px; font-size:12px;">Checked</span>
                            @else
                                <span style="background:#fef3c7; color:#92400e; padding:3px 10px; border-radius:999px; font-size:12px;">Pending</span>
                            @endif
                        </td>
                        <td style="padding:12px 16px;">
                            <form action="{{ route('teacher.submissions.grade', $submission) }}" method="POST" style="display:flex; gap:8px; align-items:center;">
                                @csrf
                                <input type="number" name="marks" min="0" max="100" step="0.01" value="{{ $submission->marks }}" required
                                       style="width:70px; padding:6px 8px; border:1px solid #d1d5db; border-radius:6px;">
                        </td>
                        <td style="padding:12px 16px;">
                            <input type="text" name="feedback" value="{{ $submission->feedback }}" placeholder="Optional feedback"
                                   style="width:160px; padding:6px 8px; border:1px solid #d1d5db; border-radius:6px;">
                        </td>
                        <td style="padding:12px 16px; white-space:nowrap;">
                            <button type="submit" style="background:#059669; color:white; border:none; padding:7px 12px; border-radius:6px; cursor:pointer; font-size:13px;">
                                Save
                            </button>
                            </form>

                            @if ($submission->checked && !$submission->published)
                                <form action="{{ route('teacher.submissions.publish', $submission) }}" method="POST" style="display:inline-block; margin-left:6px;">
                                    @csrf
                                    <button type="submit" style="background:#7c3aed; color:white; border:none; padding:7px 12px; border-radius:6px; cursor:pointer; font-size:13px;">
                                        Publish
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding:20px 16px; text-align:center; color:#9ca3af;">No submissions yet.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
