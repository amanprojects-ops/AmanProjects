<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') — Dashboard</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- MDB5 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.min.css" crossorigin="anonymous" />

    <style>
        :root {
            --sidebar-width: 265px;
            --sidebar-bg: #0f172a;
            --sidebar-border: rgba(255,255,255,0.07);
            --accent: #6366f1;
            --accent-glow: rgba(99,102,241,0.35);
            --accent-hover: #4f46e5;
            --body-bg: #f1f5f9;
            --card-shadow: 0 2px 16px rgba(15,23,42,0.08);
            --header-height: 64px;
            --nav-text: rgba(255,255,255,0.72);
            --nav-hover-bg: rgba(255,255,255,0.07);
            --nav-active-bg: rgba(99,102,241,0.18);
            --nav-active-border: #6366f1;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--body-bg);
            margin: 0;
            min-height: 100vh;
        }

        /* ── SIDEBAR ── */
        #adminSidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            z-index: 1040;
            transition: transform 0.3s cubic-bezier(.4,0,.2,1);
            box-shadow: 4px 0 24px rgba(0,0,0,0.18);
        }
        #adminSidebar .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 20px 22px 18px;
            border-bottom: 1px solid var(--sidebar-border);
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%);
            text-decoration: none;
        }
        #adminSidebar .sidebar-brand .brand-icon {
            width: 38px; height: 38px;
            background: var(--accent);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 17px; color: #fff;
            box-shadow: 0 4px 12px var(--accent-glow);
            flex-shrink: 0;
        }
        #adminSidebar .sidebar-brand .brand-text {
            display: flex; flex-direction: column;
        }
        #adminSidebar .sidebar-brand .brand-title {
            font-size: 15px; font-weight: 700; color: #fff;
            line-height: 1.2;
        }
        #adminSidebar .sidebar-brand .brand-sub {
            font-size: 10.5px; color: rgba(255,255,255,0.45);
            font-weight: 400; letter-spacing: 0.04em;
            text-transform: uppercase;
        }
        #adminSidebar .sidebar-nav {
            flex: 1; overflow-y: auto; padding: 14px 12px;
        }
        #adminSidebar .sidebar-nav::-webkit-scrollbar { width: 4px; }
        #adminSidebar .sidebar-nav::-webkit-scrollbar-track { background: transparent; }
        #adminSidebar .sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.12); border-radius: 4px; }

        #adminSidebar .nav-section-label {
            font-size: 10px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.08em;
            color: rgba(255,255,255,0.28);
            padding: 14px 12px 6px;
        }
        #adminSidebar .nav-item a,
        #adminSidebar .nav-item button {
            display: flex; align-items: center; gap: 12px;
            padding: 9px 14px;
            border-radius: 10px;
            color: var(--nav-text);
            text-decoration: none;
            font-size: 13.5px; font-weight: 500;
            transition: all 0.18s ease;
            border: none; background: transparent; width: 100%; text-align: left;
            cursor: pointer;
        }
        #adminSidebar .nav-item a:hover,
        #adminSidebar .nav-item button:hover {
            background: var(--nav-hover-bg);
            color: #fff;
            transform: translateX(2px);
        }
        #adminSidebar .nav-item a.active {
            background: var(--nav-active-bg);
            color: #fff;
            border-left: 3px solid var(--nav-active-border);
            padding-left: 11px;
            font-weight: 600;
        }
        #adminSidebar .nav-item .nav-icon {
            width: 32px; height: 32px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 8px;
            background: rgba(255,255,255,0.06);
            font-size: 13px;
            flex-shrink: 0;
            transition: background 0.18s;
        }
        #adminSidebar .nav-item a.active .nav-icon {
            background: var(--accent);
            color: #fff;
        }
        #adminSidebar .nav-item a:hover .nav-icon {
            background: rgba(255,255,255,0.1);
        }
        #adminSidebar .sidebar-footer {
            padding: 14px 12px;
            border-top: 1px solid var(--sidebar-border);
        }

        /* ── MAIN AREA ── */
        #mainContent {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex; flex-direction: column;
            transition: margin-left 0.3s cubic-bezier(.4,0,.2,1);
        }

        /* ── TOP HEADER ── */
        #adminTopbar {
            position: sticky; top: 0; z-index: 1030;
            background: #fff;
            height: var(--header-height);
            display: flex; align-items: center;
            padding: 0 24px;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 1px 8px rgba(15,23,42,0.06);
            gap: 16px;
        }
        #adminTopbar .topbar-toggle {
            display: none;
            width: 38px; height: 38px; border-radius: 9px;
            background: #f1f5f9; border: none; cursor: pointer;
            align-items: center; justify-content: center;
            color: #64748b; font-size: 16px;
            transition: background 0.15s;
        }
        #adminTopbar .topbar-toggle:hover { background: #e2e8f0; }
        #adminTopbar .topbar-brand {
            font-weight: 700; font-size: 16px; color: #0f172a;
            flex: 1;
        }
        #adminTopbar .topbar-brand span {
            color: var(--accent);
        }
        #adminTopbar .topbar-actions {
            display: flex; align-items: center; gap: 10px;
        }
        #adminTopbar .btn-view-site {
            display: flex; align-items: center; gap: 7px;
            padding: 7px 16px;
            background: #f8fafc; border: 1px solid #e2e8f0;
            border-radius: 9px; font-size: 13px; font-weight: 500;
            color: #475569; text-decoration: none;
            transition: all 0.15s;
        }
        #adminTopbar .btn-view-site:hover {
            background: #e2e8f0; color: #1e293b;
        }
        /* ── USER PILL (trigger) ── */
        .topbar-user-pill {
            display: flex; align-items: center; gap: 10px;
            padding: 6px 12px 6px 6px;
            background: #f8fafc; border: 1px solid #e2e8f0;
            border-radius: 50px;
            transition: all 0.15s;
        }
        .topbar-user-pill:hover {
            background: #f1f5f9; border-color: #cbd5e1;
        }
        .topbar-user-pill .avatar {
            width: 32px; height: 32px; border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), #8b5cf6);
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; font-weight: 700; color: #fff;
            flex-shrink: 0;
        }
        .topbar-user-pill .user-name {
            font-size: 13px; font-weight: 600; color: #1e293b;
            max-width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }

        /* ── USER DROPDOWN WRAPPER ── */
        .user-dropdown-wrapper {
            position: relative;
        }

        /* ── USER DROPDOWN PANEL ── */
        .user-dropdown-panel {
            display: none;
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            min-width: 220px;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(15,23,42,0.14), 0 2px 10px rgba(15,23,42,0.06);
            z-index: 2000;
            overflow: hidden;
            animation: dropdownIn 0.18s cubic-bezier(.4,0,.2,1);
            transform-origin: top right;
        }
        .user-dropdown-panel.open {
            display: block;
        }
        @keyframes dropdownIn {
            from { opacity: 0; transform: scale(0.95) translateY(-6px); }
            to   { opacity: 1; transform: scale(1) translateY(0); }
        }

        /* ── USER INFO HEADER ── */
        .user-dropdown-info {
            display: flex; align-items: center; gap: 12px;
            padding: 16px 16px 14px;
        }
        .user-dropdown-avatar {
            width: 42px; height: 42px; border-radius: 50%; flex-shrink: 0;
            background: linear-gradient(135deg, var(--accent), #8b5cf6);
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; font-weight: 700; color: #fff;
        }
        .user-dropdown-name {
            font-size: 14px; font-weight: 700; color: #0f172a;
            margin: 0 0 2px;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 140px;
        }
        .user-dropdown-email {
            font-size: 11.5px; color: #94a3b8;
            margin: 0;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 140px;
        }

        /* ── DIVIDER ── */
        .user-dropdown-divider {
            height: 1px; background: #f1f5f9; margin: 0;
        }

        /* ── MENU ITEMS ── */
        .user-dropdown-item {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 14px;
            font-size: 13.5px; font-weight: 500; color: #334155;
            text-decoration: none;
            transition: background 0.12s;
        }
        .user-dropdown-item:hover {
            background: #f8fafc; color: #0f172a;
        }
        .user-dropdown-item-icon {
            width: 30px; height: 30px; border-radius: 8px;
            background: #f1f5f9;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; color: var(--accent); flex-shrink: 0;
            transition: background 0.12s;
        }
        .user-dropdown-item:hover .user-dropdown-item-icon {
            background: rgba(99,102,241,0.1);
        }

        /* ── LOGOUT ITEM ── */
        .user-dropdown-logout {
            color: #ef4444 !important;
            padding-bottom: 12px;
        }
        .user-dropdown-logout:hover {
            background: #fef2f2 !important;
        }

        /* ── PAGE CONTENT ── */
        #pageContent {
            flex: 1; padding: 28px 28px 40px;
        }

        /* ── ALERTS ── */
        .admin-alert {
            border: none; border-radius: 12px;
            padding: 14px 20px;
            margin-bottom: 20px;
            display: flex; align-items: flex-start; gap: 12px;
            font-size: 14px; font-weight: 500;
        }
        .admin-alert.success {
            background: #f0fdf4; color: #166534;
            border-left: 4px solid #22c55e;
        }
        .admin-alert.danger {
            background: #fef2f2; color: #991b1b;
            border-left: 4px solid #ef4444;
        }
        .admin-alert .alert-icon { font-size: 16px; margin-top: 1px; }
        .admin-alert .alert-close {
            margin-left: auto; background: none; border: none;
            cursor: pointer; opacity: 0.5; font-size: 16px;
            line-height: 1; color: inherit;
        }
        .admin-alert .alert-close:hover { opacity: 1; }

        /* ── PAGE HEADER ── */
        .page-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 24px;
        }
        .page-title {
            font-size: 22px; font-weight: 700; color: #0f172a;
            display: flex; align-items: center; gap: 10px;
            margin: 0;
        }
        .page-title .title-icon {
            width: 40px; height: 40px; border-radius: 10px;
            background: linear-gradient(135deg, var(--accent), #8b5cf6);
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 17px;
        }

        /* ── ADMIN CARDS ── */
        .admin-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }
        .admin-card-header {
            padding: 18px 24px;
            border-bottom: 1px solid #f1f5f9;
            display: flex; align-items: center; justify-content: space-between;
            background: #fafbfd;
        }
        .admin-card-header h2, .admin-card-header h3 {
            font-size: 15px; font-weight: 700; color: #1e293b; margin: 0;
        }
        .admin-card-body { padding: 24px; }

        /* ── STAT CARDS (dashboard) ── */
        .stat-card {
            border-radius: 16px; padding: 22px 24px;
            color: #fff; position: relative; overflow: hidden;
            border: none; box-shadow: 0 8px 24px rgba(0,0,0,0.14);
        }
        .stat-card::before {
            content: '';
            position: absolute; top: -30px; right: -30px;
            width: 100px; height: 100px; border-radius: 50%;
            background: rgba(255,255,255,0.1);
        }
        .stat-card::after {
            content: '';
            position: absolute; bottom: -20px; right: 20px;
            width: 70px; height: 70px; border-radius: 50%;
            background: rgba(255,255,255,0.07);
        }
        .stat-card .stat-icon {
            font-size: 28px; opacity: 0.9; margin-bottom: 14px;
        }
        .stat-card .stat-label {
            font-size: 12px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.06em;
            opacity: 0.8; margin-bottom: 6px;
        }
        .stat-card .stat-value {
            font-size: 38px; font-weight: 800; line-height: 1;
        }
        .stat-card.indigo { background: linear-gradient(135deg, #6366f1, #4f46e5); }
        .stat-card.violet { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
        .stat-card.rose   { background: linear-gradient(135deg, #f43f5e, #e11d48); }
        .stat-card.teal   { background: linear-gradient(135deg, #14b8a6, #0d9488); }

        /* ── TABLES ── */
        .admin-table-wrapper {
            overflow-x: auto;
        }
        .admin-table {
            width: 100%; border-collapse: separate; border-spacing: 0;
            font-size: 13.5px;
        }
        .admin-table thead tr th {
            background: #f8fafc;
            padding: 12px 18px;
            font-size: 11px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.07em;
            color: #64748b; border-bottom: 2px solid #e2e8f0;
            white-space: nowrap;
        }
        .admin-table tbody tr td {
            padding: 13px 18px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155; vertical-align: middle;
        }
        .admin-table tbody tr:last-child td { border-bottom: none; }
        .admin-table tbody tr:hover td { background: #fafbff; }

        /* ── BADGES ── */
        .status-badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 3px 10px; border-radius: 20px;
            font-size: 11px; font-weight: 600;
        }
        .status-badge.published { background: #dcfce7; color: #166534; }
        .status-badge.draft     { background: #fef9c3; color: #854d0e; }
        .status-badge.active    { background: #dcfce7; color: #166534; }
        .status-badge.inactive  { background: #f1f5f9; color: #64748b; }

        /* ── ACTION BUTTONS ── */
        .btn-admin-edit {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 5px 13px; border-radius: 8px;
            background: #ede9fe; color: #6d28d9;
            font-size: 12.5px; font-weight: 600; text-decoration: none;
            border: none; cursor: pointer;
            transition: all 0.15s;
        }
        .btn-admin-edit:hover { background: #ddd6fe; color: #4c1d95; }
        .btn-admin-delete {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 5px 13px; border-radius: 8px;
            background: #fee2e2; color: #b91c1c;
            font-size: 12.5px; font-weight: 600;
            border: none; cursor: pointer;
            transition: all 0.15s;
        }
        .btn-admin-delete:hover { background: #fecaca; color: #7f1d1d; }
        .btn-admin-view {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 5px 13px; border-radius: 8px;
            background: #e0f2fe; color: #0369a1;
            font-size: 12.5px; font-weight: 600; text-decoration: none;
            border: none; cursor: pointer;
            transition: all 0.15s;
        }
        .btn-admin-view:hover { background: #bae6fd; color: #0c4a6e; }

        /* ── PRIMARY BTN ── */
        .btn-admin-primary {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 10px 22px; border-radius: 10px;
            background: linear-gradient(135deg, var(--accent), #4f46e5);
            color: #fff; font-size: 14px; font-weight: 600;
            border: none; cursor: pointer; text-decoration: none;
            box-shadow: 0 4px 14px var(--accent-glow);
            transition: all 0.2s;
        }
        .btn-admin-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px var(--accent-glow);
            color: #fff;
            background: linear-gradient(135deg, var(--accent-hover), #3730a3);
        }
        .btn-admin-secondary {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 10px 22px; border-radius: 10px;
            background: #f1f5f9; color: #475569;
            font-size: 14px; font-weight: 600;
            border: 1px solid #e2e8f0; cursor: pointer; text-decoration: none;
            transition: all 0.15s;
        }
        .btn-admin-secondary:hover {
            background: #e2e8f0; color: #1e293b;
        }
        .btn-admin-danger {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 10px 22px; border-radius: 10px;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: #fff; font-size: 14px; font-weight: 600;
            border: none; cursor: pointer;
            box-shadow: 0 4px 14px rgba(239,68,68,0.3);
            transition: all 0.2s;
        }
        .btn-admin-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(239,68,68,0.4);
        }

        /* ── FORMS ── */
        .form-section {
            background: #fff; border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: var(--card-shadow);
            margin-bottom: 20px;
        }
        .form-section-header {
            padding: 18px 24px;
            border-bottom: 1px solid #f1f5f9;
            background: #fafbfd;
            border-radius: 16px 16px 0 0;
        }
        .form-section-header h3 {
            font-size: 14px; font-weight: 700; color: #1e293b;
            margin: 0; display: flex; align-items: center; gap: 8px;
        }
        .form-section-body { padding: 24px; }
        .form-label-custom {
            font-size: 12.5px; font-weight: 600;
            color: #475569; margin-bottom: 7px; display: block;
            text-transform: uppercase; letter-spacing: 0.04em;
        }
        .form-control-custom {
            width: 100%; padding: 10px 14px;
            background: #f8fafc; border: 1.5px solid #e2e8f0;
            border-radius: 10px; font-size: 14px; color: #0f172a;
            font-family: 'Inter', sans-serif;
            transition: all 0.15s;
            outline: none;
        }
        .form-control-custom:focus {
            background: #fff;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-glow);
        }
        .form-control-custom::placeholder { color: #94a3b8; }
        .form-error { font-size: 12px; color: #ef4444; margin-top: 5px; }

        /* File input */
        .file-input-wrapper {
            position: relative;
            border: 2px dashed #e2e8f0; border-radius: 10px;
            padding: 16px 20px;
            background: #f8fafc;
            transition: border-color 0.15s;
            cursor: pointer;
        }
        .file-input-wrapper:hover { border-color: var(--accent); }
        .file-input-wrapper input[type="file"] {
            position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%;
        }
        .file-input-label {
            display: flex; align-items: center; gap: 10px;
            color: #64748b; font-size: 13.5px;
        }
        .file-input-label i { font-size: 20px; color: var(--accent); }

        /* Switch */
        .switch-wrapper {
            display: flex; align-items: center; gap: 12px;
            padding: 12px 16px; background: #f8fafc;
            border: 1.5px solid #e2e8f0; border-radius: 10px;
        }
        .switch-label { font-size: 13.5px; font-weight: 500; color: #334155; }

        /* Progress bar */
        .skill-bar { background: #e2e8f0; border-radius: 99px; height: 6px; width: 80px; }
        .skill-bar-fill { height: 6px; border-radius: 99px; background: linear-gradient(90deg, var(--accent), #8b5cf6); }

        /* ── BACK LINK ── */
        .back-link {
            display: inline-flex; align-items: center; gap: 7px;
            font-size: 13px; font-weight: 500; color: #6366f1;
            text-decoration: none; margin-bottom: 20px;
            transition: gap 0.15s;
        }
        .back-link:hover { gap: 10px; color: #4f46e5; }

        /* ── EMPTY STATE ── */
        .empty-state {
            text-align: center; padding: 50px 20px;
        }
        .empty-state i { font-size: 42px; color: #cbd5e1; margin-bottom: 14px; }
        .empty-state p { color: #94a3b8; font-size: 14px; margin: 0; }

        /* ── MOBILE OVERLAY ── */
        #sidebarOverlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 1035;
            backdrop-filter: blur(2px);
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 991px) {
            #adminSidebar {
                transform: translateX(-100%);
            }
            #adminSidebar.open {
                transform: translateX(0);
            }
            #mainContent {
                margin-left: 0 !important;
            }
            #adminTopbar .topbar-toggle {
                display: flex;
            }
            #pageContent {
                padding: 18px 16px 32px;
            }
            #sidebarOverlay.open {
                display: block;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Sidebar Overlay (mobile) -->
    <div id="sidebarOverlay" onclick="closeSidebar()"></div>

    <!-- SIDEBAR -->
    @include('admin.partials.sidebar')

    <!-- MAIN CONTENT -->
    <div id="mainContent">
        <!-- TOPBAR -->
        @include('admin.partials.header')

        <!-- PAGE CONTENT -->
        <main id="pageContent">

            {{-- Success Alert --}}
            @if(session('success'))
                <div class="admin-alert success" id="successAlert">
                    <i class="fa-solid fa-circle-check alert-icon"></i>
                    <span>{{ session('success') }}</span>
                    <button class="alert-close" onclick="this.parentElement.remove()">×</button>
                </div>
            @endif

            {{-- Error Alert --}}
            @if($errors->any())
                <div class="admin-alert danger" id="errorAlert">
                    <i class="fa-solid fa-triangle-exclamation alert-icon"></i>
                    <div>
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                    <button class="alert-close" onclick="this.parentElement.remove()">×</button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
    
    <!-- MDB5 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js" crossorigin="anonymous"></script>

    <script>
        function openSidebar() {
            document.getElementById('adminSidebar').classList.add('open');
            document.getElementById('sidebarOverlay').classList.add('open');
            document.body.style.overflow = 'hidden';
        }
        function closeSidebar() {
            document.getElementById('adminSidebar').classList.remove('open');
            document.getElementById('sidebarOverlay').classList.remove('open');
            document.body.style.overflow = '';
        }

        // ── User Dropdown ──
        function toggleUserDropdown() {
            var panel  = document.getElementById('userDropdownPanel');
            var caret  = document.getElementById('userDropdownCaret');
            var trigger = document.getElementById('userDropdownTrigger');
            var isOpen = panel.classList.contains('open');
            if (isOpen) {
                panel.classList.remove('open');
                caret.style.transform = '';
                trigger.setAttribute('aria-expanded', 'false');
                panel.setAttribute('aria-hidden', 'true');
            } else {
                panel.classList.add('open');
                caret.style.transform = 'rotate(180deg)';
                trigger.setAttribute('aria-expanded', 'true');
                panel.setAttribute('aria-hidden', 'false');
            }
        }

        // Close dropdown on outside click
        document.addEventListener('click', function(e) {
            var wrapper = document.getElementById('userDropdownWrapper');
            if (wrapper && !wrapper.contains(e.target)) {
                var panel  = document.getElementById('userDropdownPanel');
                var caret  = document.getElementById('userDropdownCaret');
                var trigger = document.getElementById('userDropdownTrigger');
                if (panel) { panel.classList.remove('open'); panel.setAttribute('aria-hidden', 'true'); }
                if (caret)  { caret.style.transform = ''; }
                if (trigger) { trigger.setAttribute('aria-expanded', 'false'); }
            }
        });

        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                var panel = document.getElementById('userDropdownPanel');
                if (panel && panel.classList.contains('open')) toggleUserDropdown();
            }
        });

        // Auto-dismiss alerts after 5 seconds
        ['successAlert', 'errorAlert'].forEach(function(id) {
            var el = document.getElementById(id);
            if (el) setTimeout(function() {
                el.style.transition = 'opacity 0.4s';
                el.style.opacity = '0';
                setTimeout(function() { el.remove(); }, 400);
            }, 5000);
        });
    </script>

    @stack('scripts')
</body>
</html>
