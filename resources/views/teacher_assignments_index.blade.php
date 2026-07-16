@extends('teacher_app')

@section('content')

    <div style="margin-left:220px; padding:24px; flex:1; background:#f0fdf4;">
        <h1 style="font-size:22px; font-weight:700; margin-bottom:5px;">Assignments</h1>
        <p style="color:#6b7280; margin-bottom:20px;">All assignments across your modules</p>

        <div style="background:white; border-radius:12px; overflow:hidden; box-shadow:0 1px 3px rgba(0,0,0,0.1);">
            <table style="width:100%; border-collapse:collapse;">
                <thead>
                <tr style="background:#f9fafb; text-align:left;">
                    <th style="padding:12px 16px; font-size:13px; color:#6b7280;">Assignment</th>
                    <th style="padding:12px 16px; font-size:13px; color:#6b7280;">Module</th>
                    <th style="padding:12px 16px; font-size:13px; color:#6b7280;">Submissions</th>
                    <th style="padding:12px 16px; font-size:13px; color:#6b7280;">Pending Review</th>
                    <th style="padding:12px 16px; font-size:13px; color:#6b7280;"></th>
                </tr>
                </thead>
                <tbody>
                @forelse ($assignments as $assignment)
                    <tr style="border-top:1px solid #f3f4f6;">
                        <td style="padding:12px 16px;">{{ $assignment->title }}</td>
                        <td style="padding:12px 16px;">{{ $assignment->module->title ?? '—' }}</td>
                        <td style="padding:12px 16px;">{{ $assignment->submissions_count }}</td>
                        <td style="padding:12px 16px;">
                            @if ($assignment->pending_review_count > 0)
                                <span style="background:#fef3c7; color:#92400e; padding:3px 10px; border-radius:999px; font-size:12px;">
                                    {{ $assignment->pending_review_count }}
                                </span>
                            @else
                                <span style="color:#9ca3af;">0</span>
                            @endif
                        </td>
                        <td style="padding:12px 16px;">
                            <a href="{{ route('teacher.assignments.submissions', $assignment) }}" style="color:#059669; text-decoration:none; font-weight:600;">
                                View Submissions →
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding:20px 16px; text-align:center; color:#9ca3af;">No assignments yet.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
