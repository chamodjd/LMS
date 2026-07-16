@extends('student_app')

@push('title')
    Student Dashboard
@endpush

@section('content')



        <!-- Main Content -->
        <div style="margin-left:220px; padding:24px; flex:1; background:#f5f3ff;">

            <!-- Top Bar -->
            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px;">
                <div>
                    <h1 style="font-size:22px; font-weight:600; color:#1e1b4b;">Welcome back, {{ $student->name ?? 'Student' }}! 👋</h1>
                    <p style="font-size:14px; color:#6b7280; margin-top:4px;">{{ $student->reg_no ?? 'STD001' }} · Keep learning!</p>
                </div>
                <div style="display:flex; align-items:center; gap:12px;">
                    <div style="width:40px; height:40px; border-radius:50%; background:#4f46e5; display:flex; align-items:center; justify-content:center; font-size:14px; font-weight:600; color:white;">
                        {{ strtoupper(substr($student->name ?? 'ST', 0, 2)) }}
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:24px;">
                <div style="background:white; border-radius:12px; padding:20px; border-left:4px solid #6366f1;">
                    <div style="font-size:12px; color:#6b7280; margin-bottom:6px;">My Course</div>
                    <div style="font-size:20px; font-weight:600; color:#111827;">{{ $course->name ?? 'Not enrolled' }}</div>
                    <div style="font-size:12px; color:#6366f1; margin-top:4px;"><i class="fa fa-graduation-cap"></i> {{ $course->code ?? '' }}</div>
                </div>
                <div style="background:white; border-radius:12px; padding:20px; border-left:4px solid #16a34a;">
                    <div style="font-size:12px; color:#6b7280; margin-bottom:6px;">Modules</div>
                    <div style="font-size:28px; font-weight:600; color:#111827;">{{ $totalModules }}</div>
                    <div style="font-size:12px; color:#16a34a; margin-top:4px;"><i class="fa fa-book"></i> Total</div>
                </div>
                <div style="background:white; border-radius:12px; padding:20px; border-left:4px solid #f59e0b;">
                    <div style="font-size:12px; color:#6b7280; margin-bottom:6px;">Exams completed</div>
                    <div style="font-size:28px; font-weight:600; color:#111827;">{{ $completedExams }}</div>
                    <div style="font-size:12px; color:#f59e0b; margin-top:4px;"><i class="fa fa-check-circle"></i> Submitted</div>
                </div>
                <div style="background:white; border-radius:12px; padding:20px; border-left:4px solid #dc2626;">
                    <div style="font-size:12px; color:#6b7280; margin-bottom:6px;">Avg score</div>
                    <div style="font-size:28px; font-weight:600; color:#111827;">{{ $avgScore }}%</div>
                    <div style="font-size:12px; color:#dc2626; margin-top:4px;"><i class="fa fa-star"></i> Overall</div>
                </div>
            </div>

            <!-- Middle Row -->
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:24px;">

                <!-- My Courses -->
                <div style="background:white; border-radius:12px; padding:20px;">
                    <h3 style="font-size:16px; font-weight:600; margin-bottom:16px;">My Modules</h3>
                    @forelse ($modules as $module)
                        <a href="{{ route('student.modules.show', $module) }}" style="display:block; text-decoration:none; padding:12px 0; border-bottom:1px solid #f3f4f6;">
                            <div style="display:flex; justify-content:space-between; align-items:center;">
                                <div>
                                    <span style="font-size:11px; background:#eef2ff; color:#4f46e5; padding:2px 8px; border-radius:5px; margin-right:6px;">{{ $module->module_code }}</span>
                                    <span style="font-size:14px; font-weight:600; color:#111827;">{{ $module->title }}</span>
                                </div>
                                <i class="fa fa-chevron-right" style="color:#9ca3af;"></i>
                            </div>
                        </a>
                    @empty
                        <p style="color:#8A8AA3; text-align:center; padding:16px;">No modules available yet for your course.</p>
                    @endforelse
                </div>

                <!-- My Profile -->
                <div style="background:white; border-radius:12px; padding:20px;">
                    <h2 style="font-size:15px; font-weight:600; color:#1e1b4b; margin-bottom:16px;">My profile</h2>
                    <div style="display:flex; align-items:center; gap:16px; margin-bottom:16px;">
                        <div style="width:60px; height:60px; border-radius:50%; background:#4f46e5; display:flex; align-items:center; justify-content:center; font-size:22px; font-weight:600; color:white;">
                            {{ strtoupper(substr($student->name ?? 'ST', 0, 2)) }}
                        </div>
                        <div>
                            <div style="font-size:16px; font-weight:600; color:#1e1b4b;">{{ $student->name ?? 'Student Name' }}</div>
                            <div style="font-size:13px; color:#6b7280;">{{ $student->reg_no ?? 'STD001' }}</div>
                        </div>
                    </div>
                    <div style="font-size:13px; color:#6b7280; margin-bottom:8px;"><i class="fa fa-map-marker" style="width:16px;"></i> {{ $student->address ?? 'Address' }}</div>
                    <div style="font-size:13px; color:#6b7280; margin-bottom:8px;"><i class="fa fa-calendar" style="width:16px;"></i> DOB: {{ $student->dob ?? '2000-01-01' }}</div>
                </div>
            </div>

            <!-- Upcoming Schedule -->
            <div style="background:white; border-radius:12px; padding:20px;">
                <h2 style="font-size:15px; font-weight:600; color:#1e1b4b; margin-bottom:16px;">Upcoming classes</h2>
                <table style="width:100%; border-collapse:collapse; font-size:13px;">
                    <thead>
                    <tr style="border-bottom:1px solid #e5e7eb;">
                        <th style="text-align:left; padding:8px 10px; color:#6b7280; font-weight:500;">Course</th>
                        <th style="text-align:left; padding:8px 10px; color:#6b7280; font-weight:500;">Instructor</th>
                        <th style="text-align:left; padding:8px 10px; color:#6b7280; font-weight:500;">Date</th>
                        <th style="text-align:left; padding:8px 10px; color:#6b7280; font-weight:500;">Time</th>
                        <th style="text-align:left; padding:8px 10px; color:#6b7280; font-weight:500;">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr style="border-bottom:1px solid #f3f4f6;">
                        <td style="padding:8px 10px; color:#111827; font-weight:500;">Web Development</td>
                        <td style="padding:8px 10px; color:#6b7280;">Mr. Silva</td>
                        <td style="padding:8px 10px; color:#6b7280;">2026-07-05</td>
                        <td style="padding:8px 10px; color:#6b7280;">9:00 AM</td>
                        <td style="padding:8px 10px;"><span style="background:#dcfce7; color:#16a34a; padding:2px 8px; border-radius:10px; font-size:11px;">Upcoming</span></td>
                    </tr>
                    <tr style="border-bottom:1px solid #f3f4f6;">
                        <td style="padding:8px 10px; color:#111827; font-weight:500;">Data Science</td>
                        <td style="padding:8px 10px; color:#6b7280;">Ms. Perera</td>
                        <td style="padding:8px 10px; color:#6b7280;">2026-07-06</td>
                        <td style="padding:8px 10px; color:#6b7280;">2:00 PM</td>
                        <td style="padding:8px 10px;"><span style="background:#dbeafe; color:#1d4ed8; padding:2px 8px; border-radius:10px; font-size:11px;">Scheduled</span></td>
                    </tr>
                    <tr>
                        <td style="padding:8px 10px; color:#111827; font-weight:500;">UI/UX Design</td>
                        <td style="padding:8px 10px; color:#6b7280;">Mr. Fernando</td>
                        <td style="padding:8px 10px; color:#6b7280;">2026-07-07</td>
                        <td style="padding:8px 10px; color:#6b7280;">11:00 AM</td>
                        <td style="padding:8px 10px;"><span style="background:#fef3c7; color:#92400e; padding:2px 8px; border-radius:10px; font-size:11px;">Pending</span></td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection
