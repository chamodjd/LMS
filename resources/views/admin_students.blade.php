@extends('dashboard_app')

@push('title')
    Students
@endpush
@section('content')

    <div style="margin-left:220px; padding:24px; flex:1; background:#f9fafb;">

        <h1 style="font-size:22px; font-weight:600; color:#111827; margin-bottom:16px;">Students</h1>

        @if (session('message'))
            <div
                style="background:#E9F9F0;color:#2FA86A;padding:10px 16px;border-radius:8px;margin-bottom:16px;font-size:14px;">
                {{ session('message') }}
            </div>
        @endif

        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; gap:10px;">
            <input type="text" id="studentSearch" onkeyup="filterStudentTable()" placeholder="Search students..."
                   style="flex:1; max-width:320px; padding:10px 14px; border:1px solid #e5e7eb; border-radius:6px;">


            <div style="display:flex; gap:10px;">

                <button onclick="openAddAccountModal()"
                        style="background:#5D5FEF;color:#fff;border:none;border-radius:8px;padding:8px 18px;font-size:13px;font-weight:700;cursor:pointer; margin-bottom:16px;">
                    + Create student Account
                </button>

                <form action="{{ route('admin.students.import') }}" method="POST" enctype="multipart/form-data"
                      id="importForm" style="display:inline;">
                    @csrf
                    <input type="file" name="excel_file" id="excelFile" accept=".csv" style="display:none;">
                    <button type="button" onclick="openImportDialog()"
                            style="display:inline-flex; align-items:center; gap:6px; background:#16a34a; color:#fff; padding:6px 10px; border:none; border-radius:6px; font-size:13px; cursor:pointer;">
                        <i class="fa fa-file-excel-o"></i> Import Excel
                    </button>
                </form>


                <form id="exportForm" action="{{ route('admin.students.export.pdf') }}" method="GET">
                    <input type="hidden" name="search" id="exportSearch">
                    <button type="button" onclick="exportFiltered()"
                            style="display:inline-flex; align-items:center; gap:6px; background:#dc2626; color:#fff; padding:6px 10px; border:none; border-radius:6px; font-size:14px; cursor:pointer;">
                        <i class="fa fa-file-pdf-o"></i> Export PDF
                    </button>
                </form>
            </div>
        </div>
        <div style="background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px;">
            <style>
                #studentTable th, #studentTable td {
                    padding: 4px 8px;
                    font-size: 12.5px;
                    vertical-align: middle;
                    line-height: 1.3;
                }

                .icon-btn {
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    width: 24px;
                    height: 24px;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    font-size: 11px;
                    margin-right: 3px;
                    padding: 0;
                }

                .icon-btn-update {
                    background: #f59e0b;
                    color: #fff;
                }

                .icon-btn-delete {
                    background: #dc2626;
                    color: #fff;
                }
            </style>

            <table class="table table-bordered table-hover table-striped" id="studentTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Reg No</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>DOB</th>
                    <th>Degree</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse ($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->reg_no }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->address }}</td>
                        <td>{{ $student->dob }}</td>
                        <td>{{ $student->degree }}</td>
                        <td>
                            <button type="button" class="icon-btn icon-btn-update" title="Update"
                                    onclick="openUpdateStudentModal(
                                        {{ $student->id }},
                                       '{{ $student->name }}',
                                       '{{ $student->address }}',
                                       '{{ $student->dob }}',
                                       '{{ $student->degree }}'
                                         )"><i class="fa fa-pencil"></i></button>
                            <button type="button" class="icon-btn icon-btn-delete" title="Delete"
                                    onclick="confirmDeleteStudent({{ $student->id }})"><i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center;padding:16px;color:#8A8AA3;">No students yet.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>
    </div>

    <!-- Update Student Modal -->
    <div class="modal fade" id="updateStudentModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background:#fef3c7;">
                    <h5 class="modal-title">Update student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="update-student-form" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-2">
                            <label style="font-size:13px;">Name</label>
                            <input type="text" name="name" id="modal-student-name" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label style="font-size:13px;">Address</label>
                            <input type="text" name="address" id="modal-student-address" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label style="font-size:13px;">DOB</label>
                            <input type="date" name="dob" id="modal-student-dob" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label style="font-size:13px;">Degree</label>
                            <input type="text" name="degree" id="modal-student-degree" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success w-100 mt-2">Update student</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    {{--        add student--}}
    <div id="addAccountModal"
         style="display:none;position:fixed;inset:0;background:rgba(27,27,51,0.4);z-index:50;align-items:center;justify-content:center;">
        <div style="background:#fff;border-radius:16px;padding:32px;width:100%;max-width:400px;">
            <h3 style="margin:0 0 6px 0;color:#1B1B33;">Add account</h3>
            <p style="margin:0 0 20px 0;color:#8A8AA3;font-size:13px;">Create a login for a student.</p>

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

@endsection
