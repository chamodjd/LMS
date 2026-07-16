<div style="display:flex; min-height:100vh;">

    <!-- Sidebar -->
    <div style="width:220px; background:#064e3b; padding:20px 0; position:fixed; top:0; left:0; height:100vh; overflow-y:auto;">

        <div style="padding:0 20px 20px; font-size:18px; font-weight:600; color:white; display:flex; align-items:center; gap:8px;">
            <i class="fa fa-chalkboard-teacher" style="color:#6ee7b7;"></i> Teacher Portal
        </div>

        <a href="{{ route('teacher.dashboard') }}" style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; background:{{ request()->routeIs('teacher.dashboard') ? '#065f46' : 'transparent' }}; color:#6ee7b7; text-decoration:none;">
            <i class="fa fa-home"></i> Dashboard
        </a>
        <a href="{{ route('teacher.modules') }}" style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; background:{{ request()->routeIs('teacher.modules') || request()->routeIs('teacher.modules.show') ? '#065f46' : 'transparent' }}; color:#6ee7b7; text-decoration:none;">
            <i class="fa fa-book"></i> My Courses
        </a>
        <a href="#" style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#6ee7b7; text-decoration:none;">
            <i class="fa fa-users"></i> My Students
        </a>
        <a href="#" style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#6ee7b7; text-decoration:none;">
            <i class="fa fa-calendar"></i> Schedule
        </a>
        <a href="{{ route('teacher.assignments.index') }}" style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#6ee7b7; text-decoration:none;">
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
