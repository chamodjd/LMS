@extends('teacher_app')

@push('title')
    Teacher Dashboard
@endpush

@section('content')



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
                <div style="background:white; border-left:4px solid #7c3aed; border-radius:12px; padding:20px; cursor:pointer;" onclick="openContactModal()">
                    <div style="display:flex; align-items:center; gap:8px; color:#111827; font-weight:600;">
                        <i class="fa fa-envelope" style="color:#7c3aed;"></i> Contact admin
                    </div>
                </div>
                <div style="background:white; border-radius:12px; padding:20px; border-left:4px solid #dc2626;">
                    <div style="font-size:12px; color:#6b7280; margin-bottom:6px;">Assignments</div>
                    <div style="font-size:28px; font-weight:600; color:#064e3b;">12</div>
                    <div style="font-size:12px; color:#dc2626; margin-top:4px;"><i class="fa fa-tasks"></i> Pending review</div>
                </div>
            </div>


    </div>

@endsection
