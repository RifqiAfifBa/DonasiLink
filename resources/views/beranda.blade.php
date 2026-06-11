@extends('layouts.public')

@section('title', 'Beranda')

@section('content')
<section class="relative overflow-hidden bg-gradient-to-br from-brand-50 via-white to-fuchsia-50 dark:from-ink-900 dark:via-ink-900 dark:to-brand-950">
    <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full bg-brand-300/30 dark:bg-brand-700/20 blur-3xl"></div>
    <div class="absolute top-40 -left-32 w-80 h-80 rounded-full bg-fuchsia-300/20 dark:bg-fuchsia-800/20 blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-6 lg:px-8 pt-16 lg:pt-24 pb-20 grid lg:grid-cols-2 gap-12 items-center">
        <div>
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-brand-100/80 dark:bg-brand-900/40 text-brand-700 dark:text-brand-200 text-xs font-bold backdrop-blur-sm">
                <i class="fas fa-paw"></i> Platform Donasi Hewan Terpercaya
            </span>
            <h1 class="mt-6 text-4xl sm:text-5xl lg:text-6xl font-black leading-[1.05] tracking-tight text-ink-900 dark:text-white">
                Bantu Mereka<br>
                <span class="bg-gradient-to-r from-brand-600 to-fuchsia-600 bg-clip-text text-transparent">Menemukan</span><br>
                Kebahagiaan Kembali
            </h1>
            <p class="mt-6 max-w-xl text-base lg:text-lg text-ink-600 dark:text-ink-300 leading-relaxed">
                DonasiLink menghubungkan Anda dengan shelter hewan yang membutuhkan bantuan. Transparansi penuh, dampak nyata untuk hewan-hewan tercinta.
            </p>
            <div class="mt-8 flex flex-wrap items-center gap-3">
                <x-button :href="route('kampanye.index')" variant="primary" size="lg" icon="heart">Donasi Sekarang</x-button>
                <x-button :href="route('impact-story')" variant="secondary" size="lg" icon="book-open">Impact Story</x-button>
            </div>
        </div>
        <div class="relative hidden lg:block">
            <div class="absolute inset-0 -m-6 rounded-[2rem] bg-gradient-to-tr from-brand-500/20 to-fuchsia-500/20 blur-2xl"></div>
            <img src="{{ asset('Asset/Pic/kucing.jpeg') }}" alt="Hewan yang membutuhkan" loading="lazy"
                 class="relative w-full max-h-[460px] object-cover rounded-3xl shadow-2xl ring-1 ring-black/5">
        </div>
    </div>

    <div class="relative bg-ink-900 dark:bg-black/40">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-8 grid grid-cols-3 gap-6">
            @foreach([
                ['n' => '100+', 'l' => 'Hewan Terselamatkan'],
                ['n' => '50+',  'l' => 'Donatur Aktif'],
                ['n' => '10+',  'l' => 'Shelter Terverifikasi'],
            ] as $s)
                <div class="text-center">
                    <p class="text-3xl sm:text-4xl font-black bg-gradient-to-r from-brand-300 to-fuchsia-300 bg-clip-text text-transparent">{{ $s['n'] }}</p>
                    <p class="mt-1 text-xs sm:text-sm text-ink-400">{{ $s['l'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-20 bg-white dark:bg-ink-900">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto">
            <span class="inline-block px-3 py-1 rounded-full bg-brand-100 dark:bg-brand-900/40 text-brand-700 dark:text-brand-200 text-xs font-bold uppercase tracking-wider">Mengapa DonasiLink?</span>
            <h2 class="mt-3 text-3xl sm:text-4xl font-extrabold text-ink-900 dark:text-white">Platform yang Anda Percaya</h2>
            <p class="mt-3 text-ink-500 dark:text-ink-400">Setiap donasi Anda tersalurkan dengan tepat dan transparan.</p>
        </div>

        <div class="mt-12 grid md:grid-cols-3 gap-6">
            @foreach([
                ['icon' => 'shield-halved', 'title' => '100% Transparan', 'desc' => 'Setiap rupiah donasi Anda dapat dipantau secara real-time dengan laporan keuangan terbuka.'],
                ['icon' => 'paw',           'title' => 'Untuk Hewan Nyata', 'desc' => 'Semua kampanye terverifikasi langsung dari shelter mitra kami.'],
                ['icon' => 'chart-line',    'title' => 'Pantau Dampak',     'desc' => 'Dapatkan update perkembangan hewan yang Anda donasikan.'],
            ] as $f)
                <div class="group p-7 rounded-3xl bg-gradient-to-br from-ink-50 to-white dark:from-ink-800 dark:to-ink-800/40 border border-ink-100 dark:border-ink-700 hover:border-brand-300 dark:hover:border-brand-700 hover:-translate-y-1 transition-all duration-300 shadow-[0_1px_3px_rgba(15,23,42,0.04)] hover:shadow-[0_18px_40px_rgba(124,58,237,0.12)]">
                    <div class="w-14 h-14 rounded-2xl btn-gradient flex items-center justify-center text-white text-xl shadow-lg group-hover:scale-110 transition-transform">
                        <i class="fas fa-{{ $f['icon'] }}"></i>
                    </div>
                    <h3 class="mt-5 text-lg font-bold text-ink-900 dark:text-white">{{ $f['title'] }}</h3>
                    <p class="mt-2 text-sm text-ink-600 dark:text-ink-400 leading-relaxed">{{ $f['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-20 bg-ink-50 dark:bg-ink-900/50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto">
            <span class="inline-block px-3 py-1 rounded-full bg-brand-100 dark:bg-brand-900/40 text-brand-700 dark:text-brand-200 text-xs font-bold uppercase tracking-wider">Kampanye Terkini</span>
            <h2 class="mt-3 text-3xl sm:text-4xl font-extrabold text-ink-900 dark:text-white">Mereka Menunggu Bantuan Anda</h2>
            <p class="mt-3 text-ink-500 dark:text-ink-400">Pilih kampanye dan mulai berdonasi hari ini.</p>
        </div>

        <div class="mt-12 grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($kampanye as $item)
                @include('partials.campaign-card', ['item' => $item])
            @empty
                <div class="col-span-full">
                    <x-empty-state icon="paw" title="Belum ada kampanye aktif" message="Pantau terus untuk update kampanye terbaru." />
                </div>
            @endforelse
        </div>

        <div class="mt-12 text-center">
            <x-button :href="route('kampanye.index')" variant="dark" size="lg" icon="arrow-right">Lihat Semua Kampanye</x-button>
        </div>
    </div>
</section>
@endsection
