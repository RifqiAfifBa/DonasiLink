<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <title>Donatur - DonasiLink</title>
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
        }
        .dark-mode {
            --bg-primary: #120c14;
            --bg-secondary: #1e1422;
            --text-primary: #e0d0e6;
            --text-secondary: #b8a0c5;
            --accent-primary: #7c3f8e;
            --accent-secondary: #ccb3d1;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; transition: background-color 0.3s ease, color 0.3s ease; }
        body { font-family: 'Inter', sans-serif; background: var(--bg-primary); color: var(--text-primary); overflow-x: hidden; }
        html { scrollbar-gutter: stable; }

        .donatur-navbar {
            background: var(--navbar-bg, #1a0f1f);
            padding: 0; position: sticky; top: 0; z-index: 1000;
            box-shadow: 0 4px 24px var(--shadow);
            border-bottom: 1px solid var(--border-color);
        }
        .donatur-nav-inner {
            max-width: 1200px; margin: 0 auto; padding: 0 24px;
            height: 68px; display: flex; align-items: center; justify-content: space-between;
        }
        .nav-brand { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .nav-brand .brand-icon {
            width: 38px; height: 38px; border-radius: 10px;
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 16px;
        }
        .nav-brand .brand-text { font-size: 20px; font-weight: 800; color: #fff; letter-spacing: -0.3px; }
        .donatur-badge {
            background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.25);
            border-radius: 20px; padding: 3px 10px; color: #fff; font-size: 11px; font-weight: 600;
        }
        .donatur-nav-links { display: flex; align-items: center; gap: 4px; }
        .donatur-nav-links a {
            color: rgba(255,255,255,0.7); font-size: 14px; font-weight: 500;
            padding: 8px 16px; border-radius: 8px; text-decoration: none; transition: all 0.2s;
        }
        .donatur-nav-links a:hover, .donatur-nav-links a.active {
            color: #fff; background: rgba(255,255,255,0.1);
        }
        .donatur-user { display: flex; align-items: center; gap: 12px; }
        .donatur-chip {
            display: flex; align-items: center; gap: 8px;
            background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.15);
            border-radius: 30px; padding: 6px 14px 6px 6px; text-decoration: none;
        }
        .donatur-avatar {
            width: 30px; height: 30px; border-radius: 50%;
            background: linear-gradient(135deg, #c9a6d4, #9b59b6);
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-weight: 700; font-size: 12px;
        }
        .donatur-chip .dname { color: #fff; font-size: 13px; font-weight: 600; }
        .btn-logout-d {
            background: rgba(220,53,69,0.12); border: 1px solid rgba(220,53,69,0.2);
            color: #ff9a9a; padding: 7px 16px; border-radius: 8px;
            font-size: 13px; font-weight: 500; cursor: pointer; transition: all 0.2s;
        }
        .btn-logout-d:hover { background: rgba(220,53,69,0.22); color: #ffb3b3; }
        
        /* Toggle Switch Style */
        .theme-switch-wrapper { display: flex; align-items: center; }
        .theme-switch {
            display: inline-block; height: 26px; position: relative; width: 48px;
        }
        .theme-switch input { display: none; }
        .slider {
            background-color: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.2);
            bottom: 0; cursor: pointer; left: 0; position: absolute; right: 0; top: 0;
            transition: .4s; border-radius: 34px;
        }
        .slider:before {
            background-color: var(--accent-secondary);
            bottom: 3.5px; content: ""; height: 17px; left: 4px;
            position: absolute; transition: .4s; width: 17px; border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        input:checked + .slider { background-color: rgba(0,0,0,0.2); }
        input:checked + .slider:before { transform: translateX(22px); background-color: var(--accent-primary); }
    </style>
</head>
<body>
    <nav class="donatur-navbar">
        <div class="donatur-nav-inner">
            <div style="display:flex;align-items:center;gap:14px;">
                <a href="{{ route('donatur.dashboard') }}" class="nav-brand">
                    <div class="brand-icon">🐾</div>
                    <span class="brand-text">DonasiLink</span>
                </a>
                <span class="donatur-badge">Donatur</span>
            </div>

            <div class="donatur-nav-links">
                <a href="{{ route('donatur.dashboard') }}" class="{{ request()->routeIs('donatur.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-pie me-1"></i>Dashboard
                </a>
                <a href="{{ route('kampanye.index') }}" class="{{ request()->routeIs('kampanye.*') ? 'active' : '' }}">
                    <i class="fas fa-paw me-1"></i>Kampanye
                </a>
                <a href="{{ route('impact-story') }}" class="{{ request()->routeIs('impact-story') ? 'active' : '' }}">
                    <i class="fas fa-book-open me-1"></i>Impact Story
                </a>
            </div>

            <div class="donatur-user">
                <div class="theme-switch-wrapper">
                    <label class="theme-switch" for="themeCheckbox">
                        <input type="checkbox" id="themeCheckbox">
                        <div class="slider"></div>
                    </label>
                </div>
                <a href="{{ route('donatur.dashboard') }}" class="donatur-chip">
                    <div class="donatur-avatar">
                        {{ strtoupper(substr(session('donatur_nama', 'D'), 0, 1)) }}
                    </div>
                    <span class="dname">{{ session('donatur_nama', 'Donatur') }}</span>
                </a>
                <form action="{{ route('logout') }}" method="POST" style="margin:0">
                    @csrf
                    <button type="submit" class="btn-logout-d">
                        <i class="fas fa-sign-out-alt me-1"></i>Logout
                    </button>
                </form>
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
