<nav class="sticky top-0 z-40 bg-white/85 dark:bg-ink-900/85 backdrop-blur-md border-b border-ink-200 dark:border-ink-800">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 h-16 flex items-center justify-between gap-4">
        <a href="{{ route('donatur.dashboard') }}" class="flex items-center gap-2 text-xl font-extrabold text-ink-900 dark:text-white">
            <span class="w-9 h-9 rounded-xl btn-gradient flex items-center justify-center text-white shadow-md">
                <i class="fas fa-paw text-sm"></i>
            </span>
            DonasiLink
        </a>

        <div class="hidden md:flex items-center gap-1">
            <a href="{{ route('donatur.dashboard') }}" class="px-4 py-2 rounded-full text-sm font-medium {{ request()->routeIs('donatur.*') ? 'bg-brand-100 text-brand-700 dark:bg-brand-900/40 dark:text-brand-200' : 'text-ink-600 hover:text-brand-600 hover:bg-brand-50 dark:text-ink-300 dark:hover:bg-ink-800' }}">Dashboard</a>
            <a href="{{ route('kampanye.index') }}" class="px-4 py-2 rounded-full text-sm font-medium {{ request()->routeIs('kampanye.*') ? 'bg-brand-100 text-brand-700 dark:bg-brand-900/40 dark:text-brand-200' : 'text-ink-600 hover:text-brand-600 hover:bg-brand-50 dark:text-ink-300 dark:hover:bg-ink-800' }}">Kampanye</a>
            <a href="{{ route('impact-story') }}" class="px-4 py-2 rounded-full text-sm font-medium {{ request()->routeIs('impact-story') ? 'bg-brand-100 text-brand-700 dark:bg-brand-900/40 dark:text-brand-200' : 'text-ink-600 hover:text-brand-600 hover:bg-brand-50 dark:text-ink-300 dark:hover:bg-ink-800' }}">Impact Story</a>
        </div>

        <div class="flex items-center gap-2">
            <x-theme-toggle />
            <x-notification-bell />
            <div class="hidden sm:flex items-center gap-2 pl-1 pr-3 py-1 rounded-full bg-brand-50 dark:bg-ink-800 border border-brand-100 dark:border-ink-700">
                <span class="w-7 h-7 rounded-full btn-gradient text-white text-xs font-bold flex items-center justify-center">{{ strtoupper(substr(session('donatur_nama','D'),0,1)) }}</span>
                <span class="text-sm font-semibold text-ink-800 dark:text-ink-100">{{ session('donatur_nama','Donatur') }}</span>
            </div>
            <form action="{{ route('logout') }}" method="POST">@csrf
                <x-button type="submit" variant="ghost" size="sm" icon="sign-out-alt">Keluar</x-button>
            </form>
        </div>
    </div>
</nav>