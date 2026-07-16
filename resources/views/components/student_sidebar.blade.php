<div style="display:flex; min-height:100vh;">

    <!-- Sidebar -->
    <div style="width:220px; background:#1e1b4b; padding:20px 0; position:fixed; top:0; left:0; height:100vh; overflow-y:auto;">

        <div style="padding:0 20px 20px; font-size:18px; font-weight:600; color:white; display:flex; align-items:center; gap:8px;">
            <i class="fa fa-graduation-cap" style="color:#a5b4fc;"></i> Student Portal
        </div>

        <div style="font-size:11px; color:#6366f1; padding:10px 20px 5px; letter-spacing:0.05em;">MY LEARNING</div>

        <a href="{{route('student.dashboard')}}" style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; background:#312e81; color:#a5b4fc; text-decoration:none;">
            <i class="fa fa-home"></i> Dashboard
        </a>
        <a href="{{ route('student.course') }}" style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#a5b4fc; text-decoration:none;">
            <i class="fa fa-book"></i> My Courses
        </a>
        <a href="{{ route('student.results') }}" style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:{{ request()->routeIs('student.results') ? '#ffffff' : '#a5b4fc' }}; background:{{ request()->routeIs('student.results') ? '#312e81' : 'transparent' }}; text-decoration:none;">
            <i class="fa fa-chart-bar"></i> My Results
        </a>
        <a href="#" style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#a5b4fc; text-decoration:none;">
            <i class="fa fa-certificate"></i> Certificates
        </a>

        <div style="font-size:11px; color:#6366f1; padding:15px 20px 5px; letter-spacing:0.05em;">ACCOUNT</div>

        <a href="#" style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#a5b4fc; text-decoration:none;">
            <i class="fa fa-user"></i> My Profile
        </a>
        <a href="#" style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#a5b4fc; text-decoration:none;">
            <i class="fa fa-cog"></i> Settings
        </a>
        <a href="{{ route('admin.index') }}" style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#f87171; text-decoration:none;">
            <i class="fa fa-sign-out"></i> Logout
        </a>
    </div>
