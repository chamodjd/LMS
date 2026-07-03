@extends('dashboard_app')

@push('title')
    Student Dashboard
@endpush

@section('content')

    <div style="display:flex; min-height:100vh;">

        <!-- Sidebar -->
        <div style="width:220px; background:#1e1b4b; padding:20px 0; position:fixed; top:0; left:0; height:100vh; overflow-y:auto;">

            <div style="padding:0 20px 20px; font-size:18px; font-weight:600; color:white; display:flex; align-items:center; gap:8px;">
                <i class="fa fa-graduation-cap" style="color:#a5b4fc;"></i> Student Portal
            </div>

            <div style="font-size:11px; color:#6366f1; padding:10px 20px 5px; letter-spacing:0.05em;">MY LEARNING</div>

            <a href="#" style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; background:#312e81; color:#a5b4fc; text-decoration:none;">
                <i class="fa fa-home"></i> Dashboard
            </a>
            <a href="#" style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#a5b4fc; text-decoration:none;">
                <i class="fa fa-book"></i> My Courses
            </a>
            <a href="#" style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#a5b4fc; text-decoration:none;">
                <i class="fa fa-calendar"></i> Schedule
            </a>
            <a href="#" style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#a5b4fc; text-decoration:none;">
                <i class="fa fa-certificate"></i> Certificates
            </a>

            <div style="font-size:11px; color:#6366f1; padding:15px 20px 5px; letter-spacing:0.05em;">ACCOUNT</div>

            <a href="#" style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#a5b4fc; text-decoration:none;">
                <i class="fa fa-user"></i> My Profile
            </a>
            <a href="#" style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#a5b4fc; text-decoration:none;">
                <i class="fa fa-cog"></i> Settings
            </a>
            <a href="{{ route('admin.index') }}" style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#f87171; text-decoration:none;">
                <i class="fa fa-sign-out"></i> Logout
            </a>
        </div>

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
                <div style="background:white; border-radius:12px; padding:20px; border-left:4px solid #4f46e5;">
                    <div style="font-size:12px; color:#6b7280; margin-bottom:6px;">Enrolled courses</div>
                    <div style="font-size:28px; font-weight:600; color:#1e1b4b;">4</div>
                    <div style="font-size:12px; color:#4f46e5; margin-top:4px;"><i class="fa fa-book"></i> Active</div>
                </div>
                <div style="background:white; border-radius:12px; padding:20px; border-left:4px solid #16a34a;">
                    <div style="font-size:12px; color:#6b7280; margin-bottom:6px;">Completed</div>
                    <div style="font-size:28px; font-weight:600; color:#1e1b4b;">2</div>
                    <div style="font-size:12px; color:#16a34a; margin-top:4px;"><i class="fa fa-check"></i> Courses</div>
                </div>
                <div style="background:white; border-radius:12px; padding:20px; border-left:4px solid #d97706;">
                    <div style="font-size:12px; color:#6b7280; margin-bottom:6px;">Avg score</div>
                    <div style="font-size:28px; font-weight:600; color:#1e1b4b;">85%</div>
                    <div style="font-size:12px; color:#d97706; margin-top:4px;"><i class="fa fa-star"></i> Good</div>
                </div>
                <div style="background:white; border-radius:12px; padding:20px; border-left:4px solid #dc2626;">
                    <div style="font-size:12px; color:#6b7280; margin-bottom:6px;">Certificates</div>
                    <div style="font-size:28px; font-weight:600; color:#1e1b4b;">2</div>
                    <div style="font-size:12px; color:#dc2626; margin-top:4px;"><i class="fa fa-certificate"></i> Earned</div>
                </div>
            </div>

            <!-- Middle Row -->
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:24px;">

                <!-- My Courses -->
                <div style="background:white; border-radius:12px; padding:20px;">
                    <h2 style="font-size:15px; font-weight:600; color:#1e1b4b; margin-bottom:16px;">My courses</h2>

                    <div style="margin-bottom:12px;">
                        <div style="display:flex; justify-content:space-between; font-size:13px; margin-bottom:6px;">
                            <span style="color:#111827; font-weight:500;">Web Development</span>
                            <span style="color:#4f46e5;">75%</span>
                        </div>
                        <div style="height:6px; background:#e5e7eb; border-radius:3px;">
                            <div style="width:75%; height:100%; background:#4f46e5; border-radius:3px;"></div>
                        </div>
                    </div>
                    <div style="margin-bottom:12px;">
                        <div style="display:flex; justify-content:space-between; font-size:13px; margin-bottom:6px;">
                            <span style="color:#111827; font-weight:500;">Data Science</span>
                            <span style="color:#16a34a;">50%</span>
                        </div>
                        <div style="height:6px; background:#e5e7eb; border-radius:3px;">
                            <div style="width:50%; height:100%; background:#16a34a; border-radius:3px;"></div>
                        </div>
                    </div>
                    <div style="margin-bottom:12px;">
                        <div style="display:flex; justify-content:space-between; font-size:13px; margin-bottom:6px;">
                            <span style="color:#111827; font-weight:500;">UI/UX Design</span>
                            <span style="color:#d97706;">30%</span>
                        </div>
                        <div style="height:6px; background:#e5e7eb; border-radius:3px;">
                            <div style="width:30%; height:100%; background:#d97706; border-radius:3px;"></div>
                        </div>
                    </div>
                    <div>
                        <div style="display:flex; justify-content:space-between; font-size:13px; margin-bottom:6px;">
                            <span style="color:#111827; font-weight:500;">Mobile Development</span>
                            <span style="color:#dc2626;">10%</span>
                        </div>
                        <div style="height:6px; background:#e5e7eb; border-radius:3px;">
                            <div style="width:10%; height:100%; background:#dc2626; border-radius:3px;"></div>
                        </div>
                    </div>
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
                    <div style="font-size:13px; color:#6b7280; margin-bottom:8px;"><i class="fa fa-user" style="width:16px;"></i> Age: {{ $student->age ?? '24' }}</div>
                    <div style="font-size:13px; color:#6b7280;"><i class="fa fa-balance-scale" style="width:16px;"></i> Weight: {{ $student->weight ?? '65' }} kg</div>
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
