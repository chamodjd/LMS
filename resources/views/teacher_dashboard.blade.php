@extends('dashboard_app')

@push('title')
    Teacher Dashboard
@endpush

@section('content')

    <div style="display:flex; min-height:100vh;">

        <!-- Sidebar -->
        <div style="width:220px; background:#064e3b; padding:20px 0; position:fixed; top:0; left:0; height:100vh; overflow-y:auto;">

            <div style="padding:0 20px 20px; font-size:18px; font-weight:600; color:white; display:flex; align-items:center; gap:8px;">
                <i class="fa fa-chalkboard-teacher" style="color:#6ee7b7;"></i> Teacher Portal
            </div>

            <div style="font-size:11px; color:#059669; padding:10px 20px 5px; letter-spacing:0.05em;">TEACHING</div>

            <a href="#" style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; background:#065f46; color:#6ee7b7; text-decoration:none;">
                <i class="fa fa-home"></i> Dashboard
            </a>
            <a href="#" style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#6ee7b7; text-decoration:none;">
                <i class="fa fa-book"></i> My Courses
            </a>
            <a href="#" style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#6ee7b7; text-decoration:none;">
                <i class="fa fa-users"></i> My Students
            </a>
            <a href="#" style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#6ee7b7; text-decoration:none;">
                <i class="fa fa-calendar"></i> Schedule
            </a>
            <a href="#" style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#6ee7b7; text-decoration:none;">
                <i class="fa fa-tasks"></i> Assignments
            </a>

            <div style="font-size:11px; color:#059669; padding:15px 20px 5px; letter-spacing:0.05em;">REPORTS</div>

            <a href="#" style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#6ee7b7; text-decoration:none;">
                <i class="fa fa-file-excel-o"></i> Export Excel
            </a>
            <a href="#" style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#6ee7b7; text-decoration:none;">
                <i class="fa fa-file-pdf-o"></i> Export PDF
            </a>

            <div style="font-size:11px; color:#059669; padding:15px 20px 5px; letter-spacing:0.05em;">ACCOUNT</div>

            <a href="#" style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#6ee7b7; text-decoration:none;">
                <i class="fa fa-user"></i> My Profile
            </a>
            <a href="{{ route('admin.index') }}" style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#f87171; text-decoration:none;">
                <i class="fa fa-sign-out"></i> Logout
            </a>

        </div>

        <!-- Main Content -->
        <div style="margin-left:220px; padding:24px; flex:1; background:#f0fdf4;">

            <!-- Top Bar -->
            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px;">
                <div>
                    <h1 style="font-size:22px; font-weight:600; color:#064e3b;">Welcome, Teacher! 👋</h1>
                    <p style="font-size:14px; color:#6b7280; margin-top:4px;">Manage your students and courses</p>
                </div>
                <div style="display:flex; align-items:center; gap:12px;">
                    <div style="width:40px; height:40px; border-radius:50%; background:#059669; display:flex; align-items:center; justify-content:center; font-size:14px; font-weight:600; color:white;">
                        TC
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:24px;">
                <div style="background:white; border-radius:12px; padding:20px; border-left:4px solid #059669;">
                    <div style="font-size:12px; color:#6b7280; margin-bottom:6px;">My students</div>
                    <div style="font-size:28px; font-weight:600; color:#064e3b;">{{ $totalStudents }}</div>
                    <div style="font-size:12px; color:#059669; margin-top:4px;"><i class="fa fa-users"></i> Total enrolled</div>
                </div>
                <div style="background:white; border-radius:12px; padding:20px; border-left:4px solid #2563eb;">
                    <div style="font-size:12px; color:#6b7280; margin-bottom:6px;">My courses</div>
                    <div style="font-size:28px; font-weight:600; color:#064e3b;">5</div>
                    <div style="font-size:12px; color:#2563eb; margin-top:4px;"><i class="fa fa-book"></i> Active courses</div>
                </div>
                <div style="background:white; border-radius:12px; padding:20px; border-left:4px solid #d97706;">
                    <div style="font-size:12px; color:#6b7280; margin-bottom:6px;">Avg student age</div>
                    <div style="font-size:28px; font-weight:600; color:#064e3b;">{{ $avgAge }}</div>
                    <div style="font-size:12px; color:#d97706; margin-top:4px;"><i class="fa fa-user"></i> Years</div>
                </div>
                <div style="background:white; border-radius:12px; padding:20px; border-left:4px solid #dc2626;">
                    <div style="font-size:12px; color:#6b7280; margin-bottom:6px;">Assignments</div>
                    <div style="font-size:28px; font-weight:600; color:#064e3b;">12</div>
                    <div style="font-size:12px; color:#dc2626; margin-top:4px;"><i class="fa fa-tasks"></i> Pending review</div>
                </div>
            </div>

            <!-- Middle Row -->
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:24px;">

                <!-- Recent Students -->
                <div style="background:white; border-radius:12px; padding:20px;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
                        <h2 style="font-size:15px; font-weight:600; color:#064e3b;">Recent students</h2>
                        <a href="#" style="font-size:12px; color:#059669; text-decoration:none;">View all</a>
                    </div>
                    @foreach($recentStudents as $student)
                        <div style="display:flex; align-items:center; gap:10px; padding:8px 0; border-bottom:1px solid #f3f4f6;">
                            <div style="width:32px; height:32px; border-radius:50%; background:#d1fae5; display:flex; align-items:center; justify-content:center; font-size:11px; font-weight:600; color:#059669; flex-shrink:0;">
                                {{ strtoupper(substr($student->name, 0, 2)) }}
                            </div>
                            <div>
                                <div style="font-size:13px; font-weight:500; color:#111827;">{{ $student->name }}</div>
                                <div style="font-size:11px; color:#9ca3af;">{{ $student->reg_no }} · Age {{ $student->age }}</div>
                            </div>
                            <span style="margin-left:auto; font-size:11px; padding:2px 8px; border-radius:10px; background:#dcfce7; color:#16a34a;">Active</span>
                        </div>
                    @endforeach
                </div>

                <!-- Quick Actions -->
                <div style="background:white; border-radius:12px; padding:20px;">
                    <h2 style="font-size:15px; font-weight:600; color:#064e3b; margin-bottom:16px;">Quick actions</h2>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px;">
                        <a href="/student" style="display:flex; align-items:center; gap:8px; padding:12px; border:1px solid #e5e7eb; border-radius:8px; text-decoration:none; color:#111827; font-size:13px;">
                            <i class="fa fa-user-plus" style="color:#059669;"></i> Add student
                        </a>
                        <a href="#" style="display:flex; align-items:center; gap:10px; padding:12px; border:1px solid #e5e7eb; border-radius:8px; text-decoration:none; color:#111827; font-size:13px;">
                            <i class="fa fa-list" style="color:#2563eb;"></i> Student list
                        </a>
                        <a href="#" style="display:flex; align-items:center; gap:8px; padding:12px; border:1px solid #e5e7eb; border-radius:8px; text-decoration:none; color:#111827; font-size:13px;">
                            <i class="fa fa-file-excel-o" style="color:#16a34a;"></i> Export Excel
                        </a>
                        <a href="#" style="display:flex; align-items:center; gap:8px; padding:12px; border:1px solid #e5e7eb; border-radius:8px; text-decoration:none; color:#111827; font-size:13px;">
                            <i class="fa fa-file-pdf-o" style="color:#dc2626;"></i> Export PDF
                        </a>
                        <a href="#" style="display:flex; align-items:center; gap:8px; padding:12px; border:1px solid #e5e7eb; border-radius:8px; text-decoration:none; color:#111827; font-size:13px;">
                            <i class="fa fa-plus" style="color:#d97706;"></i> New course
                        </a>
                        <a href="{{ route('admin.contact') }}" style="display:flex; align-items:center; gap:8px; padding:12px; border:1px solid #e5e7eb; border-radius:8px; text-decoration:none; color:#111827; font-size:13px;">
                            <i class="fa fa-envelope" style="color:#7c3aed;"></i> Contact admin
                        </a>
                    </div>
                </div>
            </div>

            <!-- Student Table -->
            <div style="background:white; border-radius:12px; padding:20px;">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
                    <h2 style="font-size:15px; font-weight:600; color:#064e3b;">All my students</h2>
                    <a href="/student" style="background:#059669; color:white; padding:8px 16px; border-radius:8px; text-decoration:none; font-size:13px;">
                        + Add student
                    </a>
                </div>
                <table style="width:100%; border-collapse:collapse; font-size:13px;">
                    <thead>
                    <tr style="border-bottom:1px solid #e5e7eb;">
                        <th style="text-align:left; padding:8px 10px; color:#6b7280; font-weight:500;">#</th>
                        <th style="text-align:left; padding:8px 10px; color:#6b7280; font-weight:500;">Reg No</th>
                        <th style="text-align:left; padding:8px 10px; color:#6b7280; font-weight:500;">Name</th>
                        <th style="text-align:left; padding:8px 10px; color:#6b7280; font-weight:500;">Address</th>
                        <th style="text-align:left; padding:8px 10px; color:#6b7280; font-weight:500;">Age</th>
                        <th style="text-align:left; padding:8px 10px; color:#6b7280; font-weight:500;">Weight</th>
                        <th style="text-align:left; padding:8px 10px; color:#6b7280; font-weight:500;">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $student)
                        <tr style="border-bottom:1px solid #f3f4f6;">
                            <td style="padding:8px 10px; color:#111827;">{{ $loop->iteration }}</td>
                            <td style="padding:8px 10px; color:#059669; font-weight:500;">{{ $student->reg_no }}</td>
                            <td style="padding:8px 10px; color:#111827;">{{ $student->name }}</td>
                            <td style="padding:8px 10px; color:#6b7280;">{{ $student->address }}</td>
                            <td style="padding:8px 10px; color:#111827;">{{ $student->age }}</td>
                            <td style="padding:8px 10px; color:#111827;">{{ $student->weight }} kg</td>
                            <td style="padding:8px 10px;">
                                <span style="background:#dcfce7; color:#16a34a; padding:2px 8px; border-radius:10px; font-size:11px;">Active</span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection
