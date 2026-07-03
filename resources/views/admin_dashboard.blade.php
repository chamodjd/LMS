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
                    <div style="font-size:28px; font-weight:600; color:#111827;"></div>
                    <div style="font-size:12px; color:#6b7280; margin-top:4px;"><i class="fa fa-user"></i> Years old
                    </div>
                </div>

                <div style="background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px;">
                    <div style="font-size:12px; color:#6b7280; margin-bottom:6px;">Avg weight</div>
                    <div style="font-size:28px; font-weight:600; color:#111827;"></div>
                    <div style="font-size:12px; color:#6b7280; margin-top:4px;"><i class="fa fa-balance-scale"></i>
                        Average
                    </div>
                </div>

            </div>

            <!-- Full Student Table -->
            <div style="background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px;">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
                    <h2 style="font-size:15px; font-weight:600; color:#111827;">All students</h2>
                    <button onclick="openAddAccountModal()" style="background:#5D5FEF;color:#fff;border:none;border-radius:8px;padding:8px 18px;font-size:13px;font-weight:700;cursor:pointer;">
                        + Create student Account
                    </button>
                </div>

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Reg No</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>DOB</th>
                                    <th>Degree</th>
                                </tr>
                                </thead>
                                <tbody id="student-table-body">
                                @include('components.student_rows', ['students' => $students])
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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

    <div id="addAccountModal" style="display:none;position:fixed;inset:0;background:rgba(27,27,51,0.4);z-index:50;align-items:center;justify-content:center;">
        <div style="background:#fff;border-radius:16px;padding:32px;width:100%;max-width:400px;">
            <h3 style="margin:0 0 6px 0;color:#1B1B33;">Add account</h3>
            <p style="margin:0 0 20px 0;color:#8A8AA3;font-size:13px;">Create a login for a teacher or student.</p>

            @if ($errors->any())
                <div style="background:#FDEDED;color:#E14B4B;padding:10px 14px;border-radius:8px;font-size:13px;margin-bottom:16px;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                <input name="name" placeholder="Name" required style="width:100%;padding:11px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;">
                <input name="email" type="email" placeholder="Email" required style="width:100%;padding:11px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;">
                <input name="password" type="password" placeholder="Password" required minlength="6" style="width:100%;padding:11px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;">

                <select name="role" id="roleSelect" required onchange="toggleStudentFields()" style="width:100%;padding:11px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;">
                    <option value="student">Student</option>
                </select>

                <div id="studentFields">
                    <input name="address" placeholder="Address" style="width:100%;padding:11px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;">
                    <input name="dob" type="date" placeholder="Date of birth" style="width:100%;padding:11px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;">
                    <select name="degree" style="width:100%;padding:11px;margin-bottom:16px;border:1.5px solid #E4E4EF;border-radius:8px;">
                        <option value="Computer Science">Computer Science</option>
                        <option value="Software Engineering">Software Engineering</option>
                    </select>
                </div>

                <div style="display:flex;gap:10px;">
                    <button type="button" onclick="closeAddAccountModal()" style="flex:1;padding:11px;border-radius:8px;border:1.5px solid #E4E4EF;background:#fff;cursor:pointer;">Cancel</button>
                    <button type="submit" style="flex:1;padding:11px;border-radius:8px;border:none;background:#5D5FEF;color:#fff;font-weight:700;cursor:pointer;">Create account</button>
                </div>
            </form>


        </div>
    </div>



@endsection
