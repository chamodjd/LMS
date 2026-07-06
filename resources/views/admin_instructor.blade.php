@extends('dashboard_app')

@push('title')
    Students
@endpush
@section('content')



        <div style="margin-left:220px; padding:24px; flex:1; background:#f9fafb;">

            <h1 style="font-size:22px; font-weight:600; color:#111827; margin-bottom:24px;">Instructors</h1>

            <div style="background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px;">
                <table class="table table-bordered table-hover table-striped">
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
                        </tr>
                    @empty
                        <tr><td colspan="7" style="text-align:center;padding:16px;color:#8A8AA3;">No instructors yet.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
