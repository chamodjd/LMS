@extends('dashboard_app')

@push('title')
    Students
@endpush
@section('content')


            <div style="margin-left:220px; padding:24px; flex:1; background:#f9fafb;">

                <h1 style="font-size:22px; font-weight:600; color:#111827; margin-bottom:24px;">Students</h1>

                <div style="background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px;">
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
                        <tbody>
                        @forelse ($students as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->reg_no }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->address }}</td>
                                <td>{{ $student->dob }}</td>
                                <td>{{ $student->degree }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="6" style="text-align:center;padding:16px;color:#8A8AA3;">No students yet.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

@endsection
