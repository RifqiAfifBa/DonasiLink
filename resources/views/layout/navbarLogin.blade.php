<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <title>DonasiLink</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark-mode');
        }
    </script>
    <style>
        :root {
            --bg-primary: #f8f5fb;
            --bg-secondary: #ffffff;
            --text-primary: #1a0f1f;
            --text-secondary: #888888;
            --accent-primary: #ccb3d1;
            --accent-secondary: #9b59b6;
            --navbar-bg: #ccb3d1;
        }
        .dark-mode {
            --bg-primary: #120c14;
            --bg-secondary: #1e1422;
            --text-primary: #e0d0e6;
            --text-secondary: #b8a0c5;
            --accent-primary: #7c3f8e;
            --accent-secondary: #ccb3d1;
            --navbar-bg: #2b1b2f;
        }
        * { margin:0; padding:0; box-sizing:border-box; transition: background-color 0.3s ease, color 0.3s ease; }
        body { font-family:'Inter',sans-serif; background:var(--bg-primary); color:var(--text-primary); overflow-x:hidden; }

        /* ── NAVBAR ── */
        .dl-navbar {
            background: var(--navbar-bg);
            position: sticky; top:0; z-index:1000;
            box-shadow: 0 2px 12px rgba(108,73,125,0.12);
        }
        .dl-nav-inner {
            max-width:1200px; margin:0 auto; padding:0 32px;
            height:64px; display:flex; align-items:center; justify-content:space-between;
        }
        .dl-brand { display:flex; align-items:center; gap:8px; text-decoration:none; }
        .dl-brand-logo { font-size:22px; font-weight:800; color:var(--text-primary); letter-spacing:-0.5px; }
        .dl-nav-links { display:flex; align-items:center; gap:6px; }
        .dl-nav-links a {
            color:var(--text-primary); font-size:14px; font-weight:500;
            padding:8px 18px; border-radius:30px; text-decoration:none; transition:all 0.2s;
        }
        .dl-nav-links a:hover { background:rgba(43,27,47,0.1); }
        .dl-nav-links a.active { background:rgba(43,27,47,0.12); font-weight:600; }
        .dl-nav-actions { display:flex; align-items:center; gap:10px; }
        
        /* Toggle Switch Style */
        .theme-switch-wrapper { display: flex; align-items: center; }
        .theme-switch {
            display: inline-block; height: 26px; position: relative; width: 48px;
        }
        .theme-switch input { display: none; }
        .slider {
            background-color: rgba(255,255,255,0.2); border: 1px solid rgba(255,255,255,0.25);
            bottom: 0; cursor: pointer; left: 0; position: absolute; right: 0; top: 0;
            transition: .4s; border-radius: 34px;
        }
        .slider:before {
            font-family: "Font Awesome 6 Free"; font-weight: 900; content: "\f185";
            display: flex; align-items: center; justify-content: center; font-size: 10px; color: #fff;
            background-color: var(--accent-secondary);
            bottom: 3.5px; height: 17px; left: 4px;
            position: absolute; transition: .4s; width: 17px; border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        input:checked + .slider { background-color: rgba(0,0,0,0.2); }
        input:checked + .slider:before { content: "\f186"; transform: translateX(22px); background-color: var(--accent-primary); }

        .dl-btn-login {
            background:var(--text-primary); color:var(--bg-secondary); padding:9px 24px; border-radius:30px;
            font-size:14px; font-weight:600; text-decoration:none; transition:all 0.2s;
        }
        .dl-btn-login:hover { opacity: 0.9; }
        .dl-btn-register {
            color:var(--text-primary); background:rgba(255,255,255,0.3); border:1.5px solid rgba(43,27,47,0.3);
            padding:8px 22px; border-radius:30px; font-size:14px; font-weight:600;
            text-decoration:none; transition:all 0.2s;
        }
        .dl-btn-register:hover { background:rgba(255,255,255,0.5); }
        .dl-user-chip {
            display:flex; align-items:center; gap:8px;
            background:rgba(255,255,255,0.3); border:1.5px solid rgba(43,27,47,0.15);
            border-radius:30px; padding:5px 16px 5px 5px; text-decoration:none;
        }
        .dl-user-avatar {
            width:28px; height:28px; border-radius:50%; background:var(--text-primary);
            display:flex; align-items:center; justify-content:center;
            color:var(--navbar-bg); font-weight:700; font-size:12px;
        }
        .dl-user-chip span { color:var(--text-primary); font-size:13px; font-weight:600; }
        .dl-logout-btn {
            background:var(--text-primary); color:var(--bg-secondary); border:none; padding:8px 18px;
            border-radius:30px; font-size:13px; font-weight:600; cursor:pointer; transition:all 0.2s;
        }
        .dl-logout-btn:hover { opacity: 0.9; }
    </style>
</head>
<body>
    <nav class="dl-navbar">
        <div class="dl-nav-inner">
            <a href="{{ route('beranda') }}" class="dl-brand">
                <span class="dl-brand-logo">$ DonasiLink</span>
            </a>

            <div class="dl-nav-links">
                <a href="{{ route('beranda') }}" class="{{ request()->routeIs('beranda') ? 'active' : '' }}">Beranda</a>
                <a href="{{ route('kampanye.index') }}" class="{{ request()->routeIs('kampanye.*') ? 'active' : '' }}">Kampanye</a>
                <a href="{{ route('impact-story') }}" class="{{ request()->routeIs('impact-story') ? 'active' : '' }}">Impact Story</a>
            </div>

            <div class="dl-nav-actions">
                <div class="theme-switch-wrapper">
                    <label class="theme-switch" for="themeCheckbox">
                        <input type="checkbox" id="themeCheckbox">
                        <div class="slider"></div>
                    </label>
                </div>
                @if(session('role') === 'donatur')
                    <a href="{{ route('donatur.dashboard') }}" class="dl-user-chip">
                        <div class="dl-user-avatar">{{ strtoupper(substr(session('donatur_nama','D'),0,1)) }}</div>
                        <span>{{ session('donatur_nama','Donatur') }}</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" style="margin:0">
                        @csrf
                        <button type="submit" class="dl-logout-btn">Logout</button>
                    </form>
                @else
                    <a href="{{ route('register') }}" class="dl-btn-register">Daftar</a>
                    <a href="{{ route('login') }}" class="dl-btn-login">Masuk</a>
                @endif
            </div>
        </div>
    </nav>
    @yield('content')
    @include('layout.footer')
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