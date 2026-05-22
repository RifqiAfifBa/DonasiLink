@extends('layouts.shelter')

@section('title', 'Dashboard Shelter')

@section('content')
<div class="max-w-7xl mx-auto px-6 lg:px-8 py-8 lg:py-10 space-y-7">
    <div class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-100 dark:bg-brand-900/40 text-brand-700 dark:text-brand-200 text-xs font-bold uppercase tracking-wider">
                <i class="fas fa-home"></i> Dashboard Shelter
            </span>
            <h1 class="mt-3 text-3xl font-extrabold text-ink-900 dark:text-white">Halo, {{ session('shelter_nama', 'Shelter') }} 👋</h1>
            <p class="mt-1 text-ink-500 dark:text-ink-400">Kelola kampanye donasi hewan Anda di sini.</p>
        </div>
        <x-button :href="route('shelter.form')" variant="primary" size="lg" icon="plus">Buat Kampanye Baru</x-button>
    </div>

    @if(session('success'))
        <x-alert type="success">{{ session('success') }}</x-alert>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
        <x-stat-card label="Total Kampanye" :value="$kampanye->count()" icon="folder-open" tone="brand" />
        <x-stat-card label="Dana Terkumpul" :value="'Rp ' . number_format($kampanye->sum('total_terkumpul'), 0, ',', '.')" icon="coins" tone="success" />
        <x-stat-card label="Kampanye Aktif" :value="$kampanye->where('status','aktif')->count()" icon="bolt" tone="info" />
    </div>

    <div>
        <h2 class="text-lg font-bold text-ink-900 dark:text-white mb-4">Kampanye Anda</h2>
        @if($kampanye->count() > 0)
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($kampanye as $item)
                    @php $pct = $item->target_donasi > 0 ? min(($item->total_terkumpul / $item->target_donasi) * 100, 100) : 0; @endphp
                    <article class="flex flex-col bg-white dark:bg-ink-800 border border-ink-200 dark:border-ink-700 rounded-3xl overflow-hidden shadow-[0_1px_3px_rgba(15,23,42,0.05)] hover:shadow-[0_18px_40px_rgba(124,58,237,0.12)] hover:-translate-y-0.5 transition-all duration-300">
                        <div class="relative aspect-[16/10] overflow-hidden bg-gradient-to-br from-brand-100 to-fuchsia-100 dark:from-ink-700 dark:to-ink-800">
                            @if($item->gambar)
                                <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->nama_hewan }}" class="w-full h-full object-cover">
                            @else
                                <div class="flex items-center justify-center w-full h-full text-5xl text-brand-400"><i class="fas fa-paw"></i></div>
                            @endif
                        </div>
                        <div class="flex-1 flex flex-col p-5">
                            <h3 class="text-lg font-bold text-ink-900 dark:text-white">{{ $item->nama_hewan }}</h3>
                            <p class="mt-1 text-sm text-ink-500 dark:text-ink-400 leading-relaxed flex-1">{{ Str::limit($item->deskripsi_hewan, 80) }}</p>
                            <div class="mt-4 inline-flex items-center gap-2 self-start px-3 py-1.5 rounded-lg bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 text-sm font-semibold">
                                <i class="fas fa-coins"></i> Rp {{ number_format($item->total_terkumpul, 0, ',', '.') }}
                            </div>
                            <div class="mt-3 h-2 rounded-full bg-ink-100 dark:bg-ink-700 overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-brand-500 to-fuchsia-500" style="width: {{ $pct }}%"></div>
                            </div>
                            <div class="mt-4 grid grid-cols-2 gap-2">
                                <x-button :href="route('shelter.updateForm', $item->id)" variant="secondary" size="sm" icon="edit">Edit</x-button>
                                <x-button :href="route('kampanye.show', $item->id)" variant="dark" size="sm" icon="eye">Lihat</x-button>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <x-card padding="p-0">
                <x-empty-state icon="paw" title="Belum Ada Kampanye" message="Mulai bantu hewan dengan membuat kampanye donasi pertama Anda.">
                    <x-button :href="route('shelter.form')" variant="primary" size="lg" icon="plus">Buat Kampanye Pertama</x-button>
                </x-empty-state>
            </x-card>
        @endif
    </div>
</div>
@endsection
