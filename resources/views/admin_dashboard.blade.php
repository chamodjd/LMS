@extends('dashboard_app')

@push('title')
    Admin Dashboard
@endpush
@section('content')

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

        <!-- Stats Cards -->
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:24px;">

            <div style="background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px;">
                <div style="background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px;">
                    <div style="font-size:12px; color:#6b7280; margin-bottom:6px;">Total students</div>
                    <div style="font-size:28px; font-weight:600; color:#111827;">{{ $totalStudents }}</div>
                    <div style="font-size:12px; color:#16a34a; margin-top:4px;"><i class="fa fa-arrow-up"></i> Active
                        learners
                    </div>
                </div>
            </div>

            <div style="background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px;">
                <div style="background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px;">
                    <div style="font-size:12px; color:#6b7280; margin-bottom:6px;">Total Instructors</div>
                    <div style="font-size:28px; font-weight:600; color:#111827;">{{$totalInstructors}}</div>
                    <div style="font-size:12px; color:#16a34a; margin-top:4px;"><i class="fa fa-arrow-up"></i> Active
                        Instructors
                    </div>
                </div>

            </div>

            <div style="background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px;">
                <div style="background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px;">
                    <div style="font-size:12px; color:#6b7280; margin-bottom:6px;">Total Programs</div>
                    <div style="font-size:28px; font-weight:600; color:#111827;">{{ $totalCourses }}</div>
                    <div style="font-size:12px; color:#16a34a; margin-top:4px;"><i class="fa fa-arrow-up"></i> Active
                        Courses
                    </div>
                </div>
            </div>

            <div style="background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px;">
                <div>
                    <button onclick="openAddAccountModal()"
                            style="background:#5D5FEF;color:#fff;border:none;border-radius:8px;padding:8px 18px;font-size:13px;font-weight:700;cursor:pointer;">
                        + Create student Account
                    </button>
                </div>
                <br>
                <div>
                    <button onclick="openAddInstructorModal()"
                            style="background:#5D5FEF;color:#fff;border:none;border-radius:8px;padding:8px 18px;font-size:13px;font-weight:700;cursor:pointer;">
                        + Create Instructor Account
                    </button>
                </div>
                <br>
                <div>
                    <button onclick="openAddCourseModal()"
                            style="background:#5D5FEF;color:#fff;border:none;border-radius:8px;padding:8px 18px;font-size:13px;font-weight:700;cursor:pointer;">
                        + Add Course
                    </button>
                </div>
            </div>

        </div>

    </div>


    {{--add model instructor--}}
    <div id="addInstructorModal"
         style="display:none;position:fixed;inset:0;background:rgba(27,27,51,0.4);z-index:50;align-items:center;justify-content:center;">
        <div style="background:#fff;border-radius:16px;padding:32px;width:100%;max-width:400px;">
            <h3 style="margin:0 0 6px 0;color:#1B1B33;">Add instructor</h3>
            <p style="margin:0 0 20px 0;color:#8A8AA3;font-size:13px;">Create a login for a teacher.</p>

            @if ($errors->any())
                <div
                    style="background:#FDEDED;color:#E14B4B;padding:10px 14px;border-radius:8px;font-size:13px;margin-bottom:16px;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                <input type="hidden" name="role" value="teacher">
                <input name="name" placeholder="Name" required
                       style="width:100%;padding:11px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;">
                <input name="email" type="email" placeholder="Email" required
                       style="width:100%;padding:11px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;">
                <input name="password" type="password" placeholder="Password" required minlength="6"
                       style="width:100%;padding:11px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;">
                <input name="mobile_no" placeholder="Mobile No" required
                       style="width:100%;padding:11px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;">
                <input name="hire_date" type="date" required
                       style="width:100%;padding:11px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;">
                <input name="salary" type="number" step="0.01" placeholder="Salary" required
                       style="width:100%;padding:11px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;">
                <input name="department" id="deptNameInput" oninput="previewDeptPrefix()" placeholder="Department"
                       required
                       style="width:100%;padding:11px;margin-bottom:6px;border:1.5px solid #E4E4EF;border-radius:8px;">
                <div id="deptPrefixPreview"
                     style="margin-bottom:10px; font-size:12px; color:#6b7280; min-height:16px;"></div>
                <input name="qualification" placeholder="Qualification" required
                       style="width:100%;padding:11px;margin-bottom:16px;border:1.5px solid #E4E4EF;border-radius:8px;">
                <div style="display:flex;gap:10px;">
                    <button type="button" onclick="closeAddInstructorModal()"
                            style="flex:1;padding:11px;border-radius:8px;border:1.5px solid #E4E4EF;background:#fff;cursor:pointer;">
                        Cancel
                    </button>
                    <button type="submit"
                            style="flex:1;padding:11px;border-radius:8px;border:none;background:#5D5FEF;color:#fff;font-weight:700;cursor:pointer;">
                        Create account
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{--        add student--}}
    <div id="addAccountModal"
         style="display:none;position:fixed;inset:0;background:rgba(27,27,51,0.4);z-index:50;align-items:center;justify-content:center;">
        <div style="background:#fff;border-radius:16px;padding:32px;width:100%;max-width:400px;">
            <h3 style="margin:0 0 6px 0;color:#1B1B33;">Add account</h3>
            <p style="margin:0 0 20px 0;color:#8A8AA3;font-size:13px;">Create a login for a teacher or student.</p>

            @if ($errors->any())
                <div
                    style="background:#FDEDED;color:#E14B4B;padding:10px 14px;border-radius:8px;font-size:13px;margin-bottom:16px;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                <input name="name" placeholder="Name" required
                       style="width:100%;padding:11px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;">
                <input name="email" type="email" placeholder="Email" required
                       style="width:100%;padding:11px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;">
                <input name="password" type="password" placeholder="Password" required minlength="6"
                       style="width:100%;padding:11px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;">

                <select name="role" id="roleSelect" required onchange="toggleStudentFields()"
                        style="width:100%;padding:11px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;">
                    <option value="student">Student</option>
                </select>

                <div id="studentFields">
                    <input name="address" placeholder="Address"
                           style="width:100%;padding:11px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;">
                    <input name="dob" type="date" placeholder="Date of birth"
                           style="width:100%;padding:11px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;">
                    <select name="degree"
                            style="width:100%;padding:11px;margin-bottom:16px;border:1.5px solid #E4E4EF;border-radius:8px;">
                        @foreach ($courses as $course)
                            <option value="{{ $course->name }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div style="display:flex;gap:10px;">
                    <button type="button" onclick="closeAddAccountModal()"
                            style="flex:1;padding:11px;border-radius:8px;border:1.5px solid #E4E4EF;background:#fff;cursor:pointer;">
                        Cancel
                    </button>
                    <button type="submit"
                            style="flex:1;padding:11px;border-radius:8px;border:none;background:#5D5FEF;color:#fff;font-weight:700;cursor:pointer;">
                        Create account
                    </button>
                </div>
            </form>


        </div>
    </div>

    {{--            courses model--}}
    <div id="addCourseModal"
         style="display:none;position:fixed;inset:0;background:rgba(27,27,51,0.4);z-index:50;align-items:center;justify-content:center;">
        <div style="background:#fff;border-radius:16px;padding:32px;width:100%;max-width:400px;">
            <h3 style="margin:0 0 6px 0;color:#1B1B33;">Add course</h3>
            <p style="margin:0 0 20px 0;color:#8A8AA3;font-size:13px;">Create a new course.</p>

            @if ($errors->any())
                <div
                    style="background:#FDEDED;color:#E14B4B;padding:10px 14px;border-radius:8px;font-size:13px;margin-bottom:16px;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.courses.store') }}">
                @csrf
                <input name="name" id="courseNameInput" oninput="suggestCourseCode()" placeholder="Course name" required
                       style="width:100%;padding:11px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;">
                <input name="code" id="courseCodeInput" placeholder="Course code (e.g. CS)" required maxlength="10"
                       style="width:100%;padding:11px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;text-transform:uppercase;">
                <input name="department" placeholder="Department (e.g. IT)" required
                       style="width:100%;padding:11px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;">
                <input name="duration" type="number" placeholder="Duration (years)" required
                       style="width:100%;padding:11px;margin-bottom:10px;border:1.5px solid #E4E4EF;border-radius:8px;">
                <input name="price" type="number" step="0.01" placeholder="Price" required
                       style="width:100%;padding:11px;margin-bottom:16px;border:1.5px solid #E4E4EF;border-radius:8px;">
                <div style="display:flex;gap:10px;">
                    <div style="display:flex;gap:10px;">
                        <button type="button" onclick="closeAddCourseModal()"
                                style="flex:1;padding:11px;border-radius:8px;border:1.5px solid #E4E4EF;background:#fff;cursor:pointer;">
                            Cancel
                        </button>
                        <button type="submit"
                                style="flex:1;padding:11px;border-radius:8px;border:none;background:#5D5FEF;color:#fff;font-weight:700;cursor:pointer;">
                            Create course
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
