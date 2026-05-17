<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Admin - DonasiLink</title>
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark-mode');
        }
    </script>
    <style>
        :root {
            --bg-primary: #f4f1f8;
            --bg-secondary: #ffffff;
            --text-primary: #2b1b2f;
            --text-secondary: #888888;
            --accent-primary: #ccb3d1;
            --accent-secondary: #9b59b6;
            --sidebar-bg: #2b1b2f;
            --topbar-bg: #ffffff;
        }
        .dark-mode {
            --bg-primary: #120c14;
            --bg-secondary: #1e1422;
            --text-primary: #e0d0e6;
            --text-secondary: #b8a0c5;
            --accent-primary: #7c3f8e;
            --accent-secondary: #ccb3d1;
            --sidebar-bg: #1a0f1f;
            --topbar-bg: #1e1422;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; transition: background-color 0.3s ease, color 0.3s ease; }
        body { font-family: 'Segoe UI', sans-serif; background: var(--bg-primary); color: var(--text-primary); display: flex; min-height: 100vh; }

        /* SIDEBAR */
        .admin-sidebar {
            width: 240px;
            background: var(--sidebar-bg);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
        }
        .sidebar-brand {
            padding: 24px 20px 20px;
            border-bottom: 1px solid #3d2b42;
        }
        .sidebar-brand h4 {
            color: #CCB3D1;
            font-size: 20px;
            font-weight: 700;
            margin: 0;
        }
        .sidebar-brand small {
            color: #9b7fa8;
            font-size: 11px;
        }
        .sidebar-nav {
            flex: 1;
            padding: 16px 0;
        }
        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: #c5b0cc;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.2s;
        }
        .sidebar-nav a:hover, .sidebar-nav a.active {
            background: #3d2b42;
            color: #ffffff;
            border-left: 3px solid #CCB3D1;
        }
        .sidebar-nav a i { width: 18px; font-size: 15px; }
        .sidebar-nav .nav-section {
            padding: 12px 20px 4px;
            font-size: 10px;
            color: #6b5070;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid #3d2b42;
        }
        .sidebar-footer .admin-name {
            color: #c5b0cc;
            font-size: 13px;
            margin-bottom: 8px;
        }
        .sidebar-footer .admin-name span { color: #fff; font-weight: 600; }
        .btn-logout {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #4a1060;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 8px 14px;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
            width: 100%;
            transition: background 0.2s;
        }
        .btn-logout:hover { background: #6b1a8a; color: #fff; }

        /* MAIN CONTENT */
        .admin-main {
            margin-left: 240px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .admin-topbar {
            background: var(--topbar-bg);
            padding: 16px 28px;
            border-bottom: 1px solid var(--border-color, #e8e0ed);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .admin-topbar h6 { margin: 0; color: var(--text-primary); font-weight: 600; font-size: 16px; }
        
        /* Toggle Switch Style */
        .theme-switch-wrapper { display: flex; align-items: center; }
        .theme-switch {
            display: inline-block; height: 24px; position: relative; width: 44px;
        }
        .theme-switch input { display: none; }
        .slider {
            background-color: var(--bg-primary); border: 1.5px solid var(--accent-primary);
            bottom: 0; cursor: pointer; left: 0; position: absolute; right: 0; top: 0;
            transition: .4s; border-radius: 34px;
        }
        .slider:before {
            background-color: var(--accent-secondary);
            bottom: 3px; content: ""; height: 15px; left: 4px;
            position: absolute; transition: .4s; width: 15px; border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        input:checked + .slider { background-color: var(--sidebar-bg); border-color: var(--accent-secondary); }
        input:checked + .slider:before { transform: translateX(18px); background-color: var(--accent-primary); }
        .admin-topbar .topbar-right { color: #888; font-size: 13px; }
        .admin-content { padding: 28px; flex: 1; }
    </style>
</head>
<body>

<aside class="admin-sidebar">
    <div class="sidebar-brand">
        <h4>$ DonasiLink</h4>
        <small>Admin Panel</small>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-section">Menu</div>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-chart-pie"></i> Dashboard
        </a>
        <a href="{{ route('admin.shelters') }}" class="{{ request()->routeIs('admin.shelters') ? 'active' : '' }}">
            <i class="fas fa-home"></i> Shelter
        </a>
        <a href="{{ route('admin.kampanye') }}" class="{{ request()->routeIs('admin.kampanye') ? 'active' : '' }}">
            <i class="fas fa-paw"></i> Kampanye
        </a>
        <a href="{{ route('admin.donasi') }}" class="{{ request()->routeIs('admin.donasi') ? 'active' : '' }}">
            <i class="fas fa-hand-holding-heart"></i> Donasi
        </a>
    </nav>
    <div class="sidebar-footer">
        <p class="admin-name">Login sebagai: <span>{{ session('admin_nama', 'Admin') }}</span></p>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
</aside>

<div class="admin-main">
    <div class="admin-topbar">
        <h6>@yield('page-title', 'Dashboard')</h6>
        <div style="display:flex;align-items:center;gap:15px;">
            <div class="theme-switch-wrapper">
                <label class="theme-switch" for="themeCheckbox">
                    <input type="checkbox" id="themeCheckbox">
                    <div class="slider"></div>
                </label>
            </div>
            <span class="topbar-right"><i class="fas fa-calendar-alt me-1"></i>{{ now()->format('d M Y') }}</span>
        </div>
    </div>
    <div class="admin-content">
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const themeCheckbox = document.getElementById('themeCheckbox');
    if (localStorage.getItem('theme') === 'dark') {
        document.documentElement.classList.add('dark-mode');
        themeCheckbox.checked = true;
    }
    themeCheckbox.addEventListener('change', () => {
        const isDark = document.documentElement.classList.toggle('dark-mode');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
    });
</script>
</body>
</html>
