<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Eduleb">
    <meta name="keywords" content="agency, business, corporate, creative, html5, modern, multipurpose, One Page, parallax, startup">
    <!-- SITE TITLE -->
    <title>Eduleb</title>
    <!-- Latest Bootstrap min CSS -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/themify-icons.css') }}">
    <!--- owl carousel Css-->
    <link rel="stylesheet" href="{{ asset('assets/owlcarousel/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/owlcarousel/css/owl.theme.css') }}">
    <!--jquery-simple-mobilemenu Css-->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-simple-mobilemenu.css') }}">
    <!-- MAGNIFIC CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <!-- animate CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

<style>
    body.dark-mode {
        background: #0f172a !important;
        color: #e2e8f0 !important;
    }
    body.dark-mode div[style*="background:white"],
    body.dark-mode div[style*="background: white"],
    body.dark-mode div[style*="background:#fff"],
    body.dark-mode div[style*="background: #fff"],
    body.dark-mode div[style*="background:#f9fafb"],
    body.dark-mode div[style*="background: #f9fafb"] {
        background: #1e293b !important;
        border-color: #334155 !important;
    }
    body.dark-mode table {
        background: transparent !important;
        color: #e2e8f0 !important;
        border-collapse: collapse;
    }
    body.dark-mode table th {
        background: #1e293b !important;
        color: #94a3b8 !important;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid #334155 !important;
        border-top: none !important;
        border-left: none !important;
        border-right: none !important;
    }
    body.dark-mode table td {
        background: transparent !important;
        color: #e2e8f0 !important;
        border-bottom: 1px solid #1e293b !important;
        border-top: none !important;
        border-left: none !important;
        border-right: none !important;
    }
    body.dark-mode .table-striped > tbody > tr:nth-of-type(odd) > *,
    body.dark-mode .table-striped > tbody > tr:nth-of-type(even) > * {
        background-color: transparent !important;
    }
    body.dark-mode table tr:hover td {
        background: #1e293b !important;
    }
    body.dark-mode input[type="text"],
    body.dark-mode input[type="date"],
    body.dark-mode input[type="number"],
    body.dark-mode select {
        background: #1e293b !important;
        color: #e2e8f0 !important;
        border: 1px solid #334155 !important;
    }
    body.dark-mode input::placeholder {
        color: #64748b !important;
    }
    body.dark-mode h1, body.dark-mode h2, body.dark-mode h3 {
        color: #f1f5f9 !important;
    }
    body.dark-mode a.sidebar-link {
        color: #94a3b8 !important;
    }
    body.dark-mode div[style*="border:1px solid #e5e7eb"] {
        border-color: #334155 !important;
    }

    /* Reg No badge */
    body.dark-mode .reg-badge,
    .reg-badge {
        display: inline-block;
        background: #312e81;
        color: #a5b4fc;
        padding: 2px 8px;
        border-radius: 5px;
        font-size: 11px;
        font-weight: 600;
    }

    /* Stat numbers - currently dark text, invisible on dark bg */
    body.dark-mode div[style*="font-size:28px"] {
        color: #f1f5f9 !important;
    }

    /* Card labels like "Total students" */
    body.dark-mode div[style*="color:#6b7280"] {
        color: #94a3b8 !important;
    }

    /* Active sidebar link - remove bright white highlight */
    body.dark-mode a.sidebar-link[style*="background:#eff6ff"] {
        background: #1e293b !important;
        color: #93c5fd !important;
    }

    /* Sidebar itself */
    body.dark-mode #adminSidebar {
        background: #0f172a !important;
        border-right: 1px solid #1e293b !important;
    }

    /* "LMS Admin" logo text */
    body.dark-mode div[style*="color:#1e40af"] {
        color: #93c5fd !important;
    }

    /* Section labels: Main, Management, System */
    body.dark-mode div[style*="color:#9ca3af"] {
        color: #64748b !important;
    }

    /* Welcome text + avatar circle */
    body.dark-mode span[style*="color:#6b7280"] {
        color: #94a3b8 !important;
    }
    body.dark-mode div[style*="background:#dbeafe"] {
        background: #312e81 !important;
        color: #a5b4fc !important;
    }

    /* Modal content wrapper */
    body.dark-mode .modal-content {
        background: #1e293b !important;
        color: #e2e8f0 !important;
        border: 1px solid #334155 !important;
    }

    /* Modal header - override the inline #fef3c7 yellow */
    body.dark-mode .modal-header {
        background: #0f172a !important;
        border-bottom: 1px solid #334155 !important;
    }
    body.dark-mode .modal-header h5,
    body.dark-mode .modal-title {
        color: #f1f5f9 !important;
    }
    body.dark-mode .btn-close {
        filter: invert(1);
    }

    /* Modal form labels + inputs */
    body.dark-mode .modal-body label {
        color: #94a3b8 !important;
    }
    body.dark-mode .modal-body .form-control {
        background: #0f172a !important;
        color: #e2e8f0 !important;
        border: 1px solid #334155 !important;
    }
    body.dark-mode .modal-body .form-control:focus {
        background: #0f172a !important;
        color: #e2e8f0 !important;
        border-color: #6366f1 !important;
        box-shadow: 0 0 0 0.2rem rgba(99,102,241,0.25) !important;
    }

    /* Custom modals (Add Account / Add Course / Add Instructor) */
    body.dark-mode div[style*="background:#fff;border-radius:16px"] {
        background: #1e293b !important;
    }
    body.dark-mode div[style*="background:#fff;border-radius:16px"] h3 {
        color: #f1f5f9 !important;
    }
    body.dark-mode div[style*="background:#fff;border-radius:16px"] p {
        color: #94a3b8 !important;
    }
    body.dark-mode div[style*="background:#fff;border-radius:16px"] input,
    body.dark-mode div[style*="background:#fff;border-radius:16px"] select {
        background: #0f172a !important;
        color: #e2e8f0 !important;
        border-color: #334155 !important;
    }

    body.dark-mode .swal2-popup {
        background: #1e293b !important;
        color: #e2e8f0 !important;
    }
    body.dark-mode .swal2-title {
        color: #f1f5f9 !important;
    }
    body.dark-mode .swal2-html-container {
        color: #cbd5e1 !important;
    }
    body.dark-mode .swal2-input,
    body.dark-mode .swal2-file,
    body.dark-mode .swal2-textarea {
        background: #0f172a !important;
        color: #e2e8f0 !important;
        border: 1px solid #334155 !important;
    }

    body.dark-mode input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(1);
    }

    /* Module list items */
    body.dark-mode div[style*="border-bottom:1px solid #f3f4f6"] {
        border-bottom-color: #334155 !important;
    }
    body.dark-mode h4[style*="color:#111827"] {
        color: #f1f5f9 !important;
    }
    body.dark-mode p[style*="color:#6b7280"] {
        color: #94a3b8 !important;
    }

    /* Icon buttons - force colored background even without explicit class match */
    body.dark-mode .icon-btn {
        border: none !important;
    }
    body.dark-mode .icon-btn-update {
        background: #f59e0b !important;
        color: #fff !important;
    }
    body.dark-mode .icon-btn-delete {
        background: #dc2626 !important;
        color: #fff !important;
    }

</style>

    <style>
    .icon-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 12px;
    margin-right: 4px;
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

</head>
