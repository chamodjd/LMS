@extends('dashboard_app')

@push('title')
    Admin Dashboard
@endpush
@section('content')

    <div style="display:flex; min-height:100vh;">

        <!-- Sidebar -->
        <div
            style="width:220px; background:var(--surface-1); border-right:1px solid #e5e7eb; padding:20px 0; position:fixed; top:0; left:0; height:100vh; overflow-y:auto;">

            <div
                style="padding:0 20px 20px; font-size:18px; font-weight:600; color:#1e40af; display:flex; align-items:center; gap:8px;">
                <i class="fa fa-graduation-cap"></i> LMS Admin
            </div>

            <div style="font-size:11px; color:#9ca3af; padding:10px 20px 5px; letter-spacing:0.05em;">MAIN</div>

            <a href="{{ route('admin.dashboard') }}"
               style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; background:#eff6ff; color:#1d4ed8; text-decoration:none;">
                <i class="fa fa-home"></i> Dashboard
            </a>
            <a href="#"
               style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#6b7280; text-decoration:none;">
                <i class="fa fa-users"></i> Students
            </a>
            <a href="#"
               style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#6b7280; text-decoration:none;">
                <i class="fa fa-book"></i> Courses
            </a>
            <a href="#"
               style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#6b7280; text-decoration:none;">
                <i class="fa fa-certificate"></i> Instructors
            </a>

            <div style="font-size:11px; color:#9ca3af; padding:15px 20px 5px; letter-spacing:0.05em;">MANAGEMENT</div>

            <a href="#"
               style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#6b7280; text-decoration:none;">
                <i class="fa fa-file-excel-o"></i> Export Excel
            </a>
            <a href="#"
               style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#6b7280; text-decoration:none;">
                <i class="fa fa-file-pdf-o"></i> Export PDF
            </a>
            <a href="#"
               style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#6b7280; text-decoration:none;">
                <i class="fa fa-calendar"></i> Schedule
            </a>

            <div style="font-size:11px; color:#9ca3af; padding:15px 20px 5px; letter-spacing:0.05em;">SYSTEM</div>

            <a href="{{ route('admin.contact') }}"
               style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#6b7280; text-decoration:none;">
                <i class="fa fa-envelope"></i> Contact
            </a>
            <a href="#"
               style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#6b7280; text-decoration:none;">
                <i class="fa fa-cog"></i> Settings
            </a>
            <a href="{{ route('admin.index') }}"
               style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#f87171; text-decoration:none;">
                <i class="fa fa-sign-out"></i> Logout
            </a>

        </div>

        <!-- Main Content -->
        <div style="margin-left:220px; padding:24px; flex:1; background:#f9fafb;">

            <!-- Top Bar -->
            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px;">
                <h1 style="font-size:22px; font-weight:600; color:#111827;">Dashboard</h1>
                <div style="display:flex; align-items:center; gap:12px;">
                    <span style="font-size:14px; color:#6b7280;">Welcome, Admin</span>
                    <div
                        style="width:36px; height:36px; border-radius:50%; background:#dbeafe; display:flex; align-items:center; justify-content:center; font-size:13px; font-weight:600; color:#1d4ed8;">
                        AD
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:24px;">

                <div style="background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px;">
                    <div style="font-size:12px; color:#6b7280; margin-bottom:6px;">Total students</div>
                    <div style="font-size:28px; font-weight:600; color:#111827;">{{ $totalStudents }}</div>
                    <div style="font-size:12px; color:#16a34a; margin-top:4px;"><i class="fa fa-arrow-up"></i> Active
                        learners
                    </div>
                </div>

                <div style="background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px;">
                    <div style="font-size:12px; color:#6b7280; margin-bottom:6px;">STD registered</div>
                    <div style="font-size:28px; font-weight:600; color:#111827;">{{ $stdCount }}</div>
                    <div style="font-size:12px; color:#2563eb; margin-top:4px;"><i class="fa fa-id-card"></i> Auto
                        generated
                    </div>
                </div>

                <div style="background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px;">
                    <div style="font-size:12px; color:#6b7280; margin-bottom:6px;">Average age</div>
                    <div style="font-size:28px; font-weight:600; color:#111827;">{{ $avgAge }}</div>
                    <div style="font-size:12px; color:#6b7280; margin-top:4px;"><i class="fa fa-user"></i> Years old
                    </div>
                </div>

                <div style="background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px;">
                    <div style="font-size:12px; color:#6b7280; margin-bottom:6px;">Avg weight</div>
                    <div style="font-size:28px; font-weight:600; color:#111827;">{{ $avgWeight }} kg</div>
                    <div style="font-size:12px; color:#6b7280; margin-top:4px;"><i class="fa fa-balance-scale"></i>
                        Average
                    </div>
                </div>

            </div>

            <!-- Middle Row -->
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:24px;">

                <!-- Recent Students -->
                <div style="background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
                        <h2 style="font-size:15px; font-weight:600; color:#111827;">Recent students</h2>
                        <a href="#" style="font-size:12px; color:#2563eb; text-decoration:none;">View all</a>
                    </div>

                    @foreach($recentStudents as $student)
                        <div
                            style="display:flex; align-items:center; gap:10px; padding:8px 0; border-bottom:1px solid #f3f4f6;">
                            <div
                                style="width:32px; height:32px; border-radius:50%; background:#dbeafe; display:flex; align-items:center; justify-content:center; font-size:11px; font-weight:600; color:#1d4ed8; flex-shrink:0;">
                                {{ strtoupper(substr($student->name, 0, 2)) }}
                            </div>
                            <div>
                                <div style="font-size:13px; font-weight:500; color:#111827;">{{ $student->name }}</div>
                                <div style="font-size:11px; color:#9ca3af;">{{ $student->reg_no }}
                                    · {{ $student->address }}</div>
                            </div>
                            <span
                                style="margin-left:auto; font-size:11px; padding:2px 8px; border-radius:10px; background:#dcfce7; color:#16a34a;">Active</span>
                        </div>
                    @endforeach

                </div>

                <!-- Quick Actions -->
                <div style="background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px;">
                    <h2 style="font-size:15px; font-weight:600; color:#111827; margin-bottom:16px;">Quick actions</h2>

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px;">
                        <a href="/student"
                           style="display:flex; align-items:center; gap:8px; padding:12px; border:1px solid #e5e7eb; border-radius:8px; text-decoration:none; color:#111827; font-size:13px;">
                            <i class="fa fa-user-plus" style="color:#2563eb;"></i> Add student
                        </a>
                        <a href="#"
                           style="display:flex; align-items:center; gap:8px; padding:12px; border:1px solid #e5e7eb; border-radius:8px; text-decoration:none; color:#111827; font-size:13px;">
                            <i class="fa fa-list" style="color:#7c3aed;"></i> Student list
                        </a>
                        <a href="#"
                           style="display:flex; align-items:center; gap:8px; padding:12px; border:1px solid #e5e7eb; border-radius:8px; text-decoration:none; color:#111827; font-size:13px;">
                            <i class="fa fa-file-excel-o" style="color:#16a34a;"></i> Export Excel
                        </a>
                        <a href="#"
                           style="display:flex; align-items:center; gap:8px; padding:12px; border:1px solid #e5e7eb; border-radius:8px; text-decoration:none; color:#111827; font-size:13px;">
                            <i class="fa fa-file-pdf-o" style="color:#dc2626;"></i> Export PDF
                        </a>
                        <a href="#"
                           style="display:flex; align-items:center; gap:8px; padding:12px; border:1px solid #e5e7eb; border-radius:8px; text-decoration:none; color:#111827; font-size:13px;">
                            <i class="fa fa-search" style="color:#d97706;"></i> Search
                        </a>
                        <a href="{{ route('admin.contact') }}"
                           style="display:flex; align-items:center; gap:8px; padding:12px; border:1px solid #e5e7eb; border-radius:8px; text-decoration:none; color:#111827; font-size:13px;">
                            <i class="fa fa-envelope" style="color:#0891b2;"></i> Contact
                        </a>
                    </div>
                </div>

            </div>

            <!-- Full Student Table -->
            <div style="background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px;">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
                    <h2 style="font-size:15px; font-weight:600; color:#111827;">All students</h2>
                    <a href="/student"
                       style="background:#2563eb; color:white; padding:8px 16px; border-radius:8px; text-decoration:none; font-size:13px;">
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
                        <th style="text-align:left; padding:8px 10px; color:#6b7280; font-weight:500;">DOB</th>
                        <th style="text-align:left; padding:8px 10px; color:#6b7280; font-weight:500;">Age</th>
                        <th style="text-align:left; padding:8px 10px; color:#6b7280; font-weight:500;">Weight</th>
                        <th style="text-align:left; padding:8px 10px; color:#6b7280; font-weight:500;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $student)
                        <tr style="border-bottom:1px solid #f3f4f6;">
                            <td style="padding:8px 10px; color:#111827;">{{ $loop->iteration }}</td>
                            <td style="padding:8px 10px; color:#2563eb; font-weight:500;">{{ $student->reg_no }}</td>
                            <td style="padding:8px 10px; color:#111827;">{{ $student->name }}</td>
                            <td style="padding:8px 10px; color:#6b7280;">{{ $student->address }}</td>
                            <td style="padding:8px 10px; color:#6b7280;">{{ $student->dob }}</td>
                            <td style="padding:8px 10px; color:#111827;">{{ $student->age }}</td>
                            <td style="padding:8px 10px; color:#111827;">{{ $student->weight }}</td>
                            <td style="padding:8px 10px;">
                                <button onclick="openUpdateModal({{ $student->id }})"
                                        style="background:#fef3c7; color:#92400e; border:none; padding:4px 10px; border-radius:6px; font-size:12px; cursor:pointer; margin-right:4px;">
                                    Edit
                                </button>
                                <button onclick="confirmDelete({{ $student->id }})"
                                        style="background:#fee2e2; color:#991b1b; border:none; padding:4px 10px; border-radius:6px; font-size:12px; cursor:pointer;">
                                    Delete
                                </button>
                                <form id="delete-form-{{ $student->id }}" action="/delete/{{ $student->id }}"
                                      method="POST" style="display:none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background:#fef3c7;">
                    <h5 class="modal-title">Update student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="update-form" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-2">
                            <label style="font-size:13px;">Reg No</label>
                            <input type="text" name="reg_no" id="modal-reg_no" class="form-control" readonly>
                        </div>
                        <div class="mb-2">
                            <label style="font-size:13px;">Name</label>
                            <input type="text" name="name" id="modal-name" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label style="font-size:13px;">Address</label>
                            <input type="text" name="address" id="modal-address" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label style="font-size:13px;">DOB</label>
                            <input type="date" name="dob" id="modal-dob" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label style="font-size:13px;">Age</label>
                            <input type="number" name="age" id="modal-age" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label style="font-size:13px;">Weight</label>
                            <input type="number" name="weight" id="modal-weight" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success w-100 mt-2">Update student</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div style="background:#FDEDED;color:#E14B4B;padding:12px 16px;border-radius:8px;margin-bottom:16px;">
            <ul style="margin:0;padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('message'))
        <p style="color:green;">{{ session('message') }}</p>
    @endif

    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf
        <input name="name" placeholder="Name" required>
        <input name="email" type="email" placeholder="Email" required>
        <input name="password" type="password" placeholder="Password" required>
        <select name="role" required>
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
        </select>
        <button type="submit">Create account</button>
    </form>

@endsection
