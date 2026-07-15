<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'LearnZikri') }} — Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,600;0,9..144,700;1,9..144,600&family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --sidebar-bg: #0D1117;
            --sidebar-border: rgba(255,255,255,.07);
            --sidebar-text: #8B949E;
            --sidebar-text-active: #E6EDF3;
            --sidebar-accent: #F59E0B;
            --sidebar-accent-soft: rgba(245,158,11,.12);
            --sidebar-hover: rgba(255,255,255,.05);
            --sidebar-width: 256px;

            --content-bg: #F0F4F8;
            --card-bg: #FFFFFF;
            --card-border: #E2E8F0;
            --card-shadow: 0 1px 3px rgba(0,0,0,.07), 0 4px 16px rgba(0,0,0,.05);

            --text-dark: #0F172A;
            --text-mid: #475569;
            --text-soft: #94A3B8;

            --gold: #F59E0B;
            --gold-deep: #B45309;
            --gold-soft: rgba(245,158,11,.1);
            --emerald: #10B981;
            --emerald-soft: rgba(16,185,129,.1);
            --red: #EF4444;
            --red-soft: rgba(239,68,68,.1);
            --blue: #3B82F6;
            --blue-soft: rgba(59,130,246,.1);

            --radius-l: 16px;
            --radius-m: 12px;
            --radius-s: 8px;
            --serif: 'Fraunces', serif;
            --sans: 'Inter', sans-serif;
            --mono: 'JetBrains Mono', monospace;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html, body { height: 100%; }
        body { font-family: var(--sans); background: var(--content-bg); color: var(--text-dark); }
        a { text-decoration: none; color: inherit; }

        /* ── Admin Shell ── */
        .admin-shell {
            display: flex;
            min-height: 100vh;
        }

        /* ── Sidebar ── */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            border-right: 1px solid var(--sidebar-border);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            height: 100vh;
            z-index: 100;
            overflow-y: auto;
        }

        .sidebar-logo {
            padding: 28px 24px 20px;
            border-bottom: 1px solid var(--sidebar-border);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .sidebar-logo-icon {
            width: 36px; height: 36px;
            background: var(--gold);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }
        .sidebar-logo-text {
            font-family: var(--serif);
            font-size: 18px;
            font-weight: 700;
            color: #fff;
            line-height: 1;
        }
        .sidebar-logo-text span { color: var(--gold); font-style: italic; }
        .sidebar-logo-sub {
            font-size: 10px;
            font-family: var(--mono);
            color: var(--sidebar-text);
            text-transform: uppercase;
            letter-spacing: .06em;
            margin-top: 2px;
        }

        .sidebar-section {
            padding: 16px 14px 8px;
        }
        .sidebar-section-label {
            font-family: var(--mono);
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: var(--sidebar-text);
            padding: 0 10px;
            margin-bottom: 6px;
        }

        .sidebar-nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: var(--radius-s);
            font-size: 13.5px;
            font-weight: 500;
            color: var(--sidebar-text);
            transition: all .18s ease;
            margin-bottom: 2px;
        }
        .sidebar-nav-item:hover {
            background: var(--sidebar-hover);
            color: var(--sidebar-text-active);
        }
        .sidebar-nav-item.active {
            background: var(--sidebar-accent-soft);
            color: var(--sidebar-accent);
            font-weight: 600;
        }
        .sidebar-nav-item .nav-icon {
            width: 32px; height: 32px;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 15px;
            background: rgba(255,255,255,.04);
            flex-shrink: 0;
        }
        .sidebar-nav-item.active .nav-icon {
            background: var(--sidebar-accent-soft);
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 16px 14px;
            border-top: 1px solid var(--sidebar-border);
        }
        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: var(--radius-s);
            background: var(--sidebar-hover);
        }
        .sidebar-user-avatar {
            width: 34px; height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gold), var(--gold-deep));
            display: flex; align-items: center; justify-content: center;
            font-size: 14px;
            font-weight: 700;
            color: var(--sidebar-bg);
            flex-shrink: 0;
        }
        .sidebar-user-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--sidebar-text-active);
        }
        .sidebar-user-role {
            font-size: 11px;
            font-family: var(--mono);
            color: var(--sidebar-text);
        }
        .sidebar-logout {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 9px 12px;
            border-radius: var(--radius-s);
            font-size: 13px;
            font-weight: 500;
            color: #EF4444;
            background: transparent;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-top: 4px;
            transition: background .18s;
        }
        .sidebar-logout:hover { background: rgba(239,68,68,.08); }

        /* ── Main Content ── */
        .admin-main {
            margin-left: var(--sidebar-width);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ── Top Bar ── */
        .admin-topbar {
            background: var(--card-bg);
            border-bottom: 1px solid var(--card-border);
            padding: 0 32px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .topbar-title {
            font-family: var(--serif);
            font-size: 20px;
            font-weight: 700;
            color: var(--text-dark);
        }
        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* ── Page Body ── */
        .admin-page {
            padding: 32px;
            flex: 1;
        }

        /* ── Utility Buttons ── */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            font-size: 13.5px;
            font-weight: 600;
            border-radius: 100px;
            padding: 10px 22px;
            border: 1px solid transparent;
            cursor: pointer;
            transition: all .2s ease;
            text-decoration: none;
            font-family: var(--sans);
        }
        .btn-primary {
            background: var(--gold);
            color: var(--sidebar-bg);
        }
        .btn-primary:hover {
            background: var(--gold-deep);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(245,158,11,.3);
        }
        .btn-danger {
            background: var(--red-soft);
            color: var(--red);
            border-color: rgba(239,68,68,.2);
        }
        .btn-danger:hover { background: var(--red); color: #fff; }
        .btn-ghost {
            background: transparent;
            color: var(--text-mid);
            border-color: var(--card-border);
        }
        .btn-ghost:hover { background: var(--content-bg); }

        /* ── Cards ── */
        .card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: var(--radius-l);
            box-shadow: var(--card-shadow);
        }

        /* ── Alert / Flash ── */
        .alert {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 18px;
            border-radius: var(--radius-m);
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 20px;
        }
        .alert-success { background: var(--emerald-soft); color: #065F46; border: 1px solid rgba(16,185,129,.25); }
        .alert-error { background: var(--red-soft); color: #7F1D1D; border: 1px solid rgba(239,68,68,.25); }

        /* ── Badge ── */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 100px;
            font-size: 12px;
            font-weight: 600;
            font-family: var(--mono);
        }
        .badge-green { background: var(--emerald-soft); color: #065F46; }
        .badge-amber { background: var(--gold-soft); color: var(--gold-deep); }
        .badge-red { background: var(--red-soft); color: #991B1B; }
        .badge-blue { background: var(--blue-soft); color: #1E40AF; }

        /* ── Table ── */
        .admin-table { width: 100%; border-collapse: collapse; }
        .admin-table th {
            text-align: left;
            padding: 12px 16px;
            font-family: var(--mono);
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: var(--text-soft);
            border-bottom: 1px solid var(--card-border);
        }
        .admin-table td {
            padding: 16px;
            font-size: 14px;
            border-bottom: 1px solid var(--card-border);
            vertical-align: middle;
        }
        .admin-table tr:last-child td { border-bottom: none; }
        .admin-table tr:hover td { background: var(--content-bg); }

        /* ── Stats Card ── */
        .stat-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: var(--radius-l);
            padding: 24px;
            box-shadow: var(--card-shadow);
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .stat-icon {
            width: 48px; height: 48px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px;
        }
        .stat-label { font-size: 13px; color: var(--text-soft); font-weight: 500; }
        .stat-value { font-family: var(--serif); font-size: 32px; font-weight: 700; color: var(--text-dark); line-height: 1; }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; margin-bottom: 28px; }

        /* ── Form Elements ── */
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: 13px; font-weight: 600; color: var(--text-mid); margin-bottom: 7px; }
        .form-input {
            width: 100%;
            padding: 11px 14px;
            border: 1px solid var(--card-border);
            border-radius: var(--radius-s);
            font-size: 14px;
            font-family: var(--sans);
            color: var(--text-dark);
            background: var(--card-bg);
            transition: border-color .18s, box-shadow .18s;
            outline: none;
        }
        .form-input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(245,158,11,.15);
        }
        .form-input[type="file"] { padding: 8px 12px; }
        .form-error { font-size: 12px; color: var(--red); margin-top: 5px; }

        /* ── Scrollbar ── */
        .sidebar::-webkit-scrollbar { width: 4px; }
        .sidebar::-webkit-scrollbar-track { background: transparent; }
        .sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,.1); border-radius: 4px; }
    </style>
</head>
<body>
<div class="admin-shell">

    {{-- ══ SIDEBAR ══ --}}
    <aside class="sidebar">
        {{-- Logo --}}
        <div class="sidebar-logo">
            <div class="sidebar-logo-icon">📚</div>
            <div>
                <div class="sidebar-logo-text">Learn<span>Zikri</span></div>
                <div class="sidebar-logo-sub">Admin Panel</div>
            </div>
        </div>

        {{-- Navigation --}}
        <div class="sidebar-section">
            <div class="sidebar-section-label">Menu</div>

            <a href="{{ route('dashboard') }}"
               class="sidebar-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="nav-icon">🏠</span>
                Dashboard
            </a>

            @role('owner')
            <a href="{{ route('admin.categories.index') }}"
               class="sidebar-nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <span class="nav-icon">🏷️</span>
                Categories
            </a>

            <a href="{{ route('admin.courses.index') }}"
               class="sidebar-nav-item {{ request()->routeIs('admin.courses.*') ? 'active' : '' }}">
                <span class="nav-icon">🎬</span>
                Courses
            </a>

            <a href="{{ route('admin.teachers.index') }}"
               class="sidebar-nav-item {{ request()->routeIs('admin.teachers.*') ? 'active' : '' }}">
                <span class="nav-icon">👨‍🏫</span>
                Teachers
            </a>

            <a href="{{ route('admin.subscribe_transactions.index') }}"
               class="sidebar-nav-item {{ request()->routeIs('admin.subscribe_transactions.*') ? 'active' : '' }}">
                <span class="nav-icon">💳</span>
                Subscriptions
            </a>
            @endrole

            @role('teacher')
            <a href="{{ route('admin.courses.index') }}"
               class="sidebar-nav-item {{ request()->routeIs('admin.courses.*') ? 'active' : '' }}">
                <span class="nav-icon">🎬</span>
                My Courses
            </a>
            @endrole
        </div>

        {{-- Footer --}}
        <div class="sidebar-footer">
            <a href="{{ route('profile.edit') }}" class="sidebar-nav-item" style="margin-bottom: 8px;">
                <span class="nav-icon">⚙️</span>
                Profile Settings
            </a>
            <div class="sidebar-user" style="margin-bottom: 10px;">
                <div class="sidebar-user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                <div>
                    <div class="sidebar-user-name">{{ Auth::user()->name }}</div>
                    <div class="sidebar-user-role">
                        @role('owner') Owner @endrole
                        @role('teacher') Teacher @endrole
                        @role('student') Student @endrole
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-logout"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                    <span>🚪</span> Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- ══ MAIN CONTENT ══ --}}
    <div class="admin-main">
        {{-- Top Bar --}}
        <div class="admin-topbar">
            <div class="topbar-title">
                @isset($header)
                    {{ $header }}
                @else
                    Admin Panel
                @endisset
            </div>
            <div class="topbar-actions">
                @isset($headerActions)
                    {{ $headerActions }}
                @endisset
            </div>
        </div>

        {{-- Page Content --}}
        <main class="admin-page">
            {{ $slot }}
        </main>
    </div>

</div>
</body>
</html>
