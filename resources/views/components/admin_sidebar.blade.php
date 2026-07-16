<style>
    .sidebar-link {
        transition: background 0.15s ease, color 0.15s ease, padding-left 0.15s ease;
    }
    .sidebar-link:hover {
        background: #eff6ff;
        color: #1d4ed8 !important;
        padding-left: 24px;
        cursor: pointer;
    }
</style>

<!-- Sidebar -->

<div style="display:flex; min-height:100vh;">

    <div
        style="width:220px; background:var(--surface-1); border-right:1px solid #e5e7eb; padding:20px 0; position:fixed; top:0; left:0; height:100vh; overflow-y:auto;">


        <div
            style="padding:0 20px 20px; font-size:18px; font-weight:600; color:#1e40af; display:flex; align-items:center; gap:8px;">
            <i class="fa fa-graduation-cap"></i> LMS Admin

            <button id="darkModeToggle" onclick="toggleDarkMode()"
                    style="background:none; border:1px solid #e5e7eb; border-radius:6px; padding:6px 10px; cursor:pointer; font-size:14px; margin-right:10px;">
                <i id="darkModeIcon" class="fa fa-moon-o"></i>
            </button>

        </div>


        <div style="font-size:11px; color:#9ca3af; padding:10px 20px 5px; letter-spacing:0.05em;">Main</div>

        <a href="{{ route('admin.dashboard') }}" class="sidebar-link"
           style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; text-decoration:none;
   {{ request()->routeIs('admin.dashboard') ? 'background:#eff6ff; color:#1d4ed8;' : 'color:#6b7280;' }}">
            <i class="fa fa-home"></i> Dashboard
        </a>

        <a href="{{ route('admin.students') }}" class="sidebar-link"
           style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; text-decoration:none;
   {{ request()->routeIs('admin.students') ? 'background:#eff6ff; color:#1d4ed8;' : 'color:#6b7280;' }}">
            <i class="fa fa-users"></i> Students
        </a>

        <a href="{{ route('admin.courses') }}" class="sidebar-link"
           style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; text-decoration:none;
   {{ request()->routeIs('admin.courses') ? 'background:#eff6ff; color:#1d4ed8;' : 'color:#6b7280;' }}">
            <i class="fa fa-book"></i> Courses
        </a>

        <a href="{{ route('admin.instructors') }}" class="sidebar-link"
           style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; text-decoration:none;
   {{ request()->routeIs('admin.instructors') ? 'background:#eff6ff; color:#1d4ed8;' : 'color:#6b7280;' }}">
            <i class="fa fa-certificate"></i> Instructors
        </a>


        <div style="font-size:11px; color:#9ca3af; padding:15px 20px 5px; letter-spacing:0.05em;">SYSTEM</div>


        <a href="{{ route('admin.contact') }}" class="sidebar-link"
           style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#6b7280; text-decoration:none;">
            <i class="fa fa-envelope"></i> Contact
        </a>

        <a href="#" class="sidebar-link"
           style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#6b7280; text-decoration:none;">
            <i class="fa fa-cog"></i> Settings
        </a>

        <a href="{{ route('admin.index') }}"
           style="display:flex; align-items:center; gap:10px; padding:10px 20px; font-size:14px; color:#f87171; text-decoration:none;">
            <i class="fa fa-sign-out"></i> Logout
        </a>

    </div>
