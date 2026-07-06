@extends('dashboard_app')

@push('title')
    Courses
@endpush

@section('content')


        <div style="margin-left:220px; padding:24px; flex:1; background:#f9fafb;">

            <h1 style="font-size:22px; font-weight:600; color:#111827; margin-bottom:24px;">Courses</h1>

            @if (session('message'))
                <div style="background:#E9F9F0;color:#2FA86A;padding:10px 16px;border-radius:8px;margin-bottom:16px;font-size:14px;">
                    {{ session('message') }}
                </div>
            @endif

            <div style="background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px;">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Course Name</th>
                        <th>Duration</th>
                        <th>Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($courses as $course)
                        <tr>
                            <td>{{ $course->id }}</td>
                            <td>{{ $course->name }}</td>
                            <td>{{ $course->duration }} year{{ $course->duration > 1 ? 's' : '' }}</td>
                            <td>${{ number_format($course->price, 2) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" style="text-align:center;padding:16px;color:#8A8AA3;">No courses yet.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection
