<!doctype html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'DonasiLink') | DonasiLink</title>

    <script>
        (function() {
            try {
                var t = localStorage.getItem('theme');
                if (t === 'dark') document.documentElement.classList.add('dark');
                else if (t === 'light') document.documentElement.classList.remove('dark');
            } catch (e) {}
        })();
        function toggleTheme(isDark) {
            document.documentElement.classList.toggle('dark', isDark);
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            document.querySelectorAll('[data-theme-toggle]').forEach(function(el) {
                if (el.type === 'checkbox') el.checked = isDark;
            });
        }
        document.addEventListener('click', function(e) {
            var toggle = e.target.closest('[data-theme-toggle]');
            if (toggle) {
                if (toggle.tagName === 'BUTTON') {
                    e.preventDefault();
                    toggleTheme(!document.documentElement.classList.contains('dark'));
                }
            }
        });
        document.addEventListener('change', function(e) {
            var toggle = e.target.closest('[data-theme-toggle]');
            if (toggle && toggle.type === 'checkbox') {
                toggleTheme(toggle.checked);
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            var isDark = document.documentElement.classList.contains('dark');
            document.querySelectorAll('[data-theme-toggle]').forEach(function(el) {
                if (el.type === 'checkbox') el.checked = isDark;
            });
        });
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('head')
</head>
<body class="min-h-screen antialiased bg-ink-50 text-ink-800 dark:bg-ink-900 dark:text-ink-100 font-sans">
    @yield('body')
    @include('partials.donation-success-modal')
    @include('partials.image-lightbox')
    @stack('scripts')
</body>
</html>
