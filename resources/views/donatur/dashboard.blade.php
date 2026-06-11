@extends('layouts.donatur')

@section('title', 'Dashboard Donatur')

@push('head')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-6 lg:px-8 py-8 lg:py-10 space-y-7">
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-ink-900 via-brand-900 to-brand-700 px-8 py-10 text-white">
        <div class="absolute -top-32 -right-16 w-80 h-80 rounded-full bg-brand-500/20 blur-3xl"></div>
        <div class="absolute -bottom-20 left-20 w-60 h-60 rounded-full bg-fuchsia-500/15 blur-3xl"></div>
        <div class="relative z-10">
            <p class="text-sm font-medium text-brand-200/80">Selamat datang kembali</p>
            <h1 class="mt-1 text-3xl sm:text-4xl font-extrabold">
                Halo, <span class="bg-gradient-to-r from-brand-200 to-fuchsia-200 bg-clip-text text-transparent">{{ $donatur->username }}!</span>
            </h1>
            <p class="mt-2 text-brand-200/80">Terima kasih atas kebaikan Anda. Setiap donasi membawa harapan baru.</p>
            <div class="mt-5">
                <x-button :href="route('kampanye.index')" variant="secondary" size="md" icon="heart">Lihat Kampanye Aktif</x-button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
        <x-stat-card label="Total Donasi Anda" :value="'Rp ' . number_format($totalDonasi, 0, ',', '.')" icon="hand-holding-heart" tone="brand" />
        <x-stat-card label="Jumlah Donasi" :value="$jumlahDonasi" icon="receipt" tone="info" />
        <x-stat-card label="Kampanye Didukung" :value="$kampanyeDidonasi" icon="paw" tone="success" />
    </div>

    {{-- Chart: Donation Timeline --}}
    <x-chart id="donationTimelineChart" title="Timeline Donasi Anda" type="line" :data="$donationTimelineData" />

    <div class="grid lg:grid-cols-2 gap-6">
        <x-table-card title="Riwayat Donasi" subtitle="5 transaksi terakhir Anda">
            @if($riwayatDonasi->count() > 0)
            <ul class="divide-y divide-ink-100 dark:divide-ink-700">
                @foreach($riwayatDonasi->take(5) as $donasi)
                @php
                $tone = match($donasi->status) {
                'berhasil' => ['icon' => 'check', 'badge' => 'success'],
                'pending' => ['icon' => 'clock', 'badge' => 'warning'],
                default => ['icon' => 'times', 'badge' => 'danger'],
                };
                @endphp
                <li class="flex items-center gap-4 px-6 py-4 hover:bg-ink-50 dark:hover:bg-ink-900/40 transition-colors">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center
                                {{ $donasi->status === 'berhasil' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300' : '' }}
                                {{ $donasi->status === 'pending'  ? 'bg-amber-100 text-amber-700 dark:bg-amber-900/40 dark:text-amber-300' : '' }}
                                {{ ! in_array($donasi->status, ['berhasil','pending']) ? 'bg-rose-100 text-rose-700 dark:bg-rose-900/40 dark:text-rose-300' : '' }}">
                        <i class="fas fa-{{ $tone['icon'] }}"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-ink-900 dark:text-white truncate">{{ $donasi->kampanye->nama_hewan ?? 'Kampanye' }}</p>
                        <p class="text-xs text-ink-500 dark:text-ink-400">{{ $donasi->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-bold text-ink-900 dark:text-white">Rp {{ number_format($donasi->jumlah, 0, ',', '.') }}</p>
                        <x-badge :type="$tone['badge']" class="mt-1">{{ ucfirst($donasi->status) }}</x-badge>
                    </div>
                </li>
                @endforeach
            </ul>
            @else
            <x-empty-state icon="inbox" title="Belum ada riwayat donasi" message="Mulai berdonasi untuk membantu hewan yang membutuhkan.">
                <x-button :href="route('kampanye.index')" variant="primary" size="md" icon="heart">Mulai Berdonasi</x-button>
            </x-empty-state>
            @endif
        </x-table-card>

        <x-table-card title="Kampanye Aktif">
            <x-slot:actions>
                <a href="{{ route('kampanye.index') }}" class="text-sm font-semibold text-brand-600 dark:text-brand-300 hover:underline">Lihat Semua →</a>
            </x-slot:actions>

            @if($kampanyeAktif->count() > 0)
            <ul class="p-4 space-y-3">
                @foreach($kampanyeAktif as $item)
                @php $pct = $item->target_donasi > 0 ? min(($item->total_terkumpul / $item->target_donasi) * 100, 100) : 0; @endphp
                <li class="flex items-center gap-4 p-3 rounded-2xl bg-ink-50 dark:bg-ink-900 hover:bg-brand-50 dark:hover:bg-ink-800 border border-ink-100 dark:border-ink-700 transition-colors">
                    @if($item->gambar)
                    <img src="{{ route('foto.show', $item->gambar) }}" alt="{{ $item->nama_hewan }}" class="w-14 h-14 rounded-xl object-cover shrink-0">
                    @else
                    <div class="w-14 h-14 rounded-xl btn-gradient flex items-center justify-center text-white shrink-0">
                        <i class="fas fa-paw"></i>
                    </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-ink-900 dark:text-white truncate">{{ $item->nama_hewan }}</p>
                        <div class="mt-1.5 h-1.5 rounded-full bg-ink-200 dark:bg-ink-700 overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-brand-500 to-fuchsia-500" style="width: {{ $pct }}%"></div>
                        </div>
                        <p class="mt-1 text-xs text-ink-500 dark:text-ink-400 truncate">
                            Rp {{ number_format($item->total_terkumpul, 0, ',', '.') }}
                            <span class="opacity-50">/ Rp {{ number_format($item->target_donasi, 0, ',', '.') }}</span>
                        </p>
                    </div>
                    <x-button :href="route('checkout.show', $item->id)" variant="primary" size="sm" icon="heart">Donasi</x-button>
                </li>
                @endforeach
            </ul>
            @else
            <x-empty-state icon="paw" title="Belum ada kampanye aktif" />
            @endif
        </x-table-card>
    </div>
</div>
@endsection