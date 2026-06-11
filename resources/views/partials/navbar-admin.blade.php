@php
    $nav = [
        ['route' => 'admin.dashboard', 'match' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => 'chart-pie'],
        ['route' => 'admin.shelters',  'match' => 'admin.shelters',  'label' => 'Shelter',   'icon' => 'home'],
        ['route' => 'admin.kampanye',  'match' => 'admin.kampanye',  'label' => 'Kampanye',  'icon' => 'paw'],
        ['route' => 'admin.donasi',    'match' => 'admin.donasi',    'label' => 'Donasi',    'icon' => 'hand-holding-heart'],
        ['route' => 'admin.penarikan', 'match' => 'admin.penarikan*', 'label' => 'Penarikan Dana', 'icon' => 'money-bill-wave'],
        ['route' => 'admin.users',     'match' => 'admin.users*',     'label' => 'Manajemen Pengguna', 'icon' => 'user-shield'],
    ];
@endphp

<aside id="adminSidebar"
       class="fixed inset-y-0 left-0 z-40 w-64 -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out
              bg-gradient-to-b from-ink-900 to-ink-800 dark:from-black dark:to-ink-900 text-ink-100 flex flex-col shadow-2xl">
    <div class="px-6 pt-6 pb-5 border-b border-white/5">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
            <span class="w-10 h-10 rounded-xl btn-gradient flex items-center justify-center text-white shadow-lg">
                <i class="fas fa-paw"></i>
            </span>
            <div>
                <p class="text-base font-extrabold text-white">DonasiLink</p>
                <p class="text-[11px] uppercase tracking-widest text-brand-300/80">Admin Panel</p>
            </div>
        </a>
    </div>

    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
        <p class="px-3 pt-2 pb-1 text-[10px] font-bold uppercase tracking-widest text-ink-400">Menu</p>
        @foreach($nav as $item)
            @php $active = request()->routeIs($item['match']); @endphp
            <a href="{{ route($item['route']) }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all
                      {{ $active
                         ? 'bg-white/10 text-white shadow-inner'
                         : 'text-ink-300 hover:bg-white/5 hover:text-white' }}">
                <span class="w-8 h-8 rounded-lg flex items-center justify-center {{ $active ? 'btn-gradient text-white' : 'bg-white/5 text-ink-300' }}">
                    <i class="fas fa-{{ $item['icon'] }} text-xs"></i>
                </span>
                {{ $item['label'] }}
            </a>
        @endforeach
    </nav>

    <div class="p-4 border-t border-white/5">
        <div class="flex items-center gap-3 mb-3">
            <span class="w-9 h-9 rounded-full btn-gradient flex items-center justify-center text-white font-bold text-sm">
                {{ strtoupper(substr(session('admin_nama','A'),0,1)) }}
            </span>
            <div class="min-w-0">
                <p class="text-xs text-ink-400">Login sebagai</p>
                <p class="text-sm font-semibold text-white truncate">{{ session('admin_nama', 'Admin') }}</p>
            </div>
        </div>
        <form action="{{ route('logout') }}" method="POST">@csrf
            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-3 py-2 rounded-xl bg-white/5 hover:bg-rose-500/20 hover:text-rose-200 text-ink-200 text-sm font-medium transition-colors">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
</aside>

<div onclick="document.getElementById('adminSidebar').classList.add('-translate-x-full')"
     class="fixed inset-0 z-30 bg-ink-900/50 lg:hidden hidden" id="adminSidebarOverlay"></div>
