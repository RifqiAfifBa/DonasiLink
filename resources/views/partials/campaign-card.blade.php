@php
    $pct = ($item->target_donasi ?? 0) > 0 ? min(($item->total_terkumpul / $item->target_donasi) * 100, 100) : 0;
    $sakit = ($item->sedang_sakit ?? null) === 'ya';
@endphp

<article class="group flex flex-col bg-white dark:bg-ink-800 border border-ink-200 dark:border-ink-700 rounded-3xl overflow-hidden shadow-[0_1px_3px_rgba(15,23,42,0.04)] hover:shadow-[0_18px_40px_rgba(124,58,237,0.14)] hover:-translate-y-1 transition-all duration-300">
    <div class="relative aspect-[16/10] overflow-hidden bg-gradient-to-br from-brand-100 to-fuchsia-100 dark:from-ink-700 dark:to-ink-800">
        @if($item->gambar)
            <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->nama_hewan }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        @else
            <div class="flex items-center justify-center w-full h-full text-6xl text-brand-400 dark:text-brand-600">
                <i class="fas fa-paw"></i>
            </div>
        @endif
        <div class="absolute top-3 left-3">
            @if($sakit)
                <x-badge type="danger"><i class="fas fa-heartbeat"></i> Sedang Sakit</x-badge>
            @else
                <x-badge type="success"><i class="fas fa-check-circle"></i> Sehat</x-badge>
            @endif
        </div>
    </div>

    <div class="flex-1 flex flex-col p-5">
        <p class="text-xs font-semibold text-brand-600 dark:text-brand-300">
            <i class="fas fa-home mr-1"></i>{{ $item->shelter->nama_shelter ?? 'Shelter' }}
        </p>
        <h3 class="mt-1 text-lg font-bold text-ink-900 dark:text-white">{{ $item->nama_hewan }}</h3>
        <p class="mt-1.5 text-sm text-ink-500 dark:text-ink-400 leading-relaxed flex-1">{{ Str::limit($item->deskripsi_hewan ?? '', 90) }}</p>

        <div class="mt-4">
            <div class="h-2 rounded-full bg-ink-100 dark:bg-ink-700 overflow-hidden">
                <div class="h-full rounded-full bg-gradient-to-r from-brand-500 to-fuchsia-500" style="width: {{ $pct }}%"></div>
            </div>
            <div class="mt-2 flex items-center justify-between text-xs">
                <span class="text-ink-500 dark:text-ink-400">
                    Terkumpul <strong class="text-brand-700 dark:text-brand-300">Rp {{ number_format($item->total_terkumpul ?? 0, 0, ',', '.') }}</strong>
                </span>
                <span class="font-bold text-ink-700 dark:text-ink-200">{{ number_format($pct, 0) }}%</span>
            </div>
        </div>

        <x-button :href="route('kampanye.show', $item->id)" variant="primary" size="md" icon="heart" class="mt-5 w-full">
            Donasi Sekarang
        </x-button>
    </div>
</article>
