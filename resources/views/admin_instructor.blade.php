@extends('dashboard_app')

@push('title')
    Students
@endpush
@section('content')

    <div style="margin-left:200px; padding:24px; flex:1; background:#f9fafb;">

        <h1 style="font-size:22px; font-weight:600; color:#111827; margin-bottom:16px;">Instructors</h1>

        @if (session('message'))
            <div
                style="background:#E9F9F0;color:#2FA86A;padding:10px 16px;border-radius:8px;margin-bottom:16px;font-size:14px;">
                {{ session('message') }}
            </div>
        @endif
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; gap:10px;">
            <input type="text" id="instructorSearch" onkeyup="filterInstructorTable()"
                   placeholder="Search instructors..."
                   style="flex:1; max-width:320px; padding:10px 14px; border:1px solid #e5e7eb; border-radius:6px;">

            <div style="display:flex; gap:10px;">

                <button onclick="openAddInstructorModal()"
                        style="background:#5D5FEF;color:#fff;border:none;border-radius:8px;padding:8px 18px;font-size:13px;font-weight:700;cursor:pointer; margin-bottom:16px;">
                    + Create Instructor Account
                </button>

                <form action="{{ route('admin.instructors.import') }}" method="POST" enctype="multipart/form-data"
                      id="importInstructorForm" style="display:inline;">
                    @csrf
                    <input type="file" name="excel_file" id="excelInstructorFile" accept=".csv" style="display:none;">
                    <button type="button" onclick="openImportInstructorDialog()"
                            style="display:inline-flex; align-items:center; gap:6px; background:#16a34a; color:#fff; padding:6px 10px; border:none; border-radius:6px; font-size:13px; cursor:pointer;">
                        <i class="fa fa-file-excel-o"></i> Import Excel
                    </button>
                </form>

                <form id="exportInstructorForm" action="{{ route('admin.instructors.export.pdf') }}" method="GET">
                    <input type="hidden" name="search" id="exportInstructorSearch">
                    <button type="button" onclick="exportFilteredInstructors()"
                            style="display:inline-flex; align-items:center; gap:6px; background:#dc2626; color:#fff; padding:6px 10px; border:none; border-radius:6px; font-size:13px; cursor:pointer;">
                        <i class="fa fa-file-pdf-o"></i> Export PDF
                    </button>
                </form>
            </div>
        </div>

        <div style="background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px;">
            <table class="table table-bordered table-hover table-striped" id="instructorTable">
                <style>
                    #instructorTable th, #instructorTable td {
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
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Emp No</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Hire Date</th>
                    <th>Salary</th>
                    <th>Department</th>
                    <th>Qualification</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse ($instructors as $instructor)
                    <tr>
                        <td>{{ $instructor->id }}</td>
                        <td>{{ $instructor->emp_no }}</td>
                        <td>{{ $instructor->name }}</td>
                        <td>{{ $instructor->mobile_no }}</td>
                        <td>{{ $instructor->hire_date }}</td>
                        <td>{{ $instructor->salary }}</td>
                        <td>{{ $instructor->department }}</td>
                        <td>{{ $instructor->qualification }}</td>
                        <td>
                            <button type="button" class="icon-btn icon-btn-update" title="Update"
                                    onclick="openUpdateInstructorRowModal(
                                {{ $instructor->id }},
                                '{{ $instructor->name }}',
                                '{{ $instructor->mobile_no }}',
                                '{{ $instructor->hire_date }}',
                                '{{ $instructor->salary }}',
                                '{{ $instructor->department }}',
                                '{{ $instructor->qualification }}'
                                )"><i class="fa fa-pencil"></i></button>
                            <button type="button" class="icon-btn icon-btn-delete" title="Delete"
                                    onclick="confirmDeleteInstructor({{ $instructor->id }})"><i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" style="text-align:center;padding:16px;color:#8A8AA3;">No instructors yet.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>
    </div>

    <!-- Update Instructor Modal -->
    <div class="modal fade" id="updateInstructorRowModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background:#fef3c7;">
                    <h5 class="modal-title">Update instructor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="update-instructor-row-form" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-2">
                            <label style="font-size:13px;">Name</label>
                            <input type="text" name="name" id="modal-instructor-name" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label style="font-size:13px;">Mobile No</label>
                            <input type="text" name="mobile_no" id="modal-instructor-mobile" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label style="font-size:13px;">Hire Date</label>
                            <input type="date" name="hire_date" id="modal-instructor-hire-date" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label style="font-size:13px;">Salary</label>
                            <input type="number" step="0.01" name="salary" id="modal-instructor-salary"
                                   class="form-control">
                        </div>
                        <div class="mb-2">
                            <label style="font-size:13px;">Department</label>
                            <input type="text" name="department" id="modal-instructor-department" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label style="font-size:13px;">Qualification</label>
                            <input type="text" name="qualification" id="modal-instructor-qualification"
                                   class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success w-100 mt-2">Update instructor</button>
                    </form>
                </div>
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
                <input name="department" placeholder="Department" required
                       style="width:100%;padding:11px;margin-bottom:16px;border:1.5px solid #E4E4EF;border-radius:8px;">
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

@endsection
