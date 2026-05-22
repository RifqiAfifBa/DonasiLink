<nav class="sticky top-0 z-40 bg-white/85 dark:bg-ink-900/85 backdrop-blur-md border-b border-ink-200 dark:border-ink-800">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 h-16 flex items-center justify-between gap-4">
        <a href="{{ route('shelter.landingpage') }}" class="flex items-center gap-2 text-xl font-extrabold text-ink-900 dark:text-white">
            <span class="w-9 h-9 rounded-xl btn-gradient flex items-center justify-center text-white shadow-md">
                <i class="fas fa-home text-sm"></i>
            </span>
            <span>DonasiLink <span class="text-brand-600 dark:text-brand-300 text-sm font-semibold">Shelter</span></span>
        </a>

        <div class="hidden md:flex items-center gap-1">
            <a href="{{ route('shelter.landingpage') }}" class="px-4 py-2 rounded-full text-sm font-medium {{ request()->routeIs('shelter.landingpage') ? 'bg-brand-100 text-brand-700 dark:bg-brand-900/40 dark:text-brand-200' : 'text-ink-600 hover:text-brand-600 hover:bg-brand-50 dark:text-ink-300 dark:hover:bg-ink-800' }}">Dashboard</a>
            <a href="{{ route('shelter.form') }}" class="px-4 py-2 rounded-full text-sm font-medium {{ request()->routeIs('shelter.form') ? 'bg-brand-100 text-brand-700 dark:bg-brand-900/40 dark:text-brand-200' : 'text-ink-600 hover:text-brand-600 hover:bg-brand-50 dark:text-ink-300 dark:hover:bg-ink-800' }}">Buat Kampanye</a>
            <a href="{{ route('shelter.withdraw') }}" class="px-4 py-2 rounded-full text-sm font-medium {{ request()->routeIs('shelter.withdraw') ? 'bg-brand-100 text-brand-700 dark:bg-brand-900/40 dark:text-brand-200' : 'text-ink-600 hover:text-brand-600 hover:bg-brand-50 dark:text-ink-300 dark:hover:bg-ink-800' }}">Penarikan</a>
            <a href="{{ route('shelter.uploadStruk') }}" class="px-4 py-2 rounded-full text-sm font-medium {{ request()->routeIs('shelter.uploadStruk') ? 'bg-brand-100 text-brand-700 dark:bg-brand-900/40 dark:text-brand-200' : 'text-ink-600 hover:text-brand-600 hover:bg-brand-50 dark:text-ink-300 dark:hover:bg-ink-800' }}">Riwayat</a>
        </div>

        <div class="flex items-center gap-2">
            <x-theme-toggle variant="button" />
            <div class="hidden sm:flex items-center gap-2 pl-1 pr-3 py-1 rounded-full bg-brand-50 dark:bg-ink-800 border border-brand-100 dark:border-ink-700">
                <span class="w-7 h-7 rounded-full btn-gradient text-white text-xs font-bold flex items-center justify-center">{{ strtoupper(substr(session('shelter_nama','S'),0,1)) }}</span>
                <span class="text-sm font-semibold text-ink-800 dark:text-ink-100">{{ session('shelter_nama','Shelter') }}</span>
            </div>
            <form action="{{ route('logout') }}" method="POST">@csrf
                <x-button type="submit" variant="ghost" size="sm" icon="sign-out-alt">Keluar</x-button>
            </form>
        </div>
    </div>
</nav>
