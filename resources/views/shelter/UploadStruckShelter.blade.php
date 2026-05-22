@extends('layouts.shelter')

@section('title', 'Riwayat Penarikan')

@section('content')
<section class="max-w-7xl mx-auto px-6 py-10 lg:py-14">
    <div class="flex flex-wrap items-end justify-between gap-4 mb-8">
        <div>
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-100 dark:bg-brand-900/40 text-brand-700 dark:text-brand-200 text-xs font-bold uppercase tracking-wider">
                <i class="fas fa-clock-rotate-left"></i> Riwayat
            </span>
            <h1 class="mt-3 text-3xl font-extrabold text-ink-900 dark:text-white">Riwayat Penarikan</h1>
            <p class="mt-2 text-ink-500 dark:text-ink-400">Pantau status penarikan dan unggah bukti pengeluaran untuk transparansi donatur.</p>
        </div>
        <x-button :href="route('shelter.withdraw')" variant="primary" size="md" icon="plus">Ajukan Penarikan</x-button>
    </div>

    @if(session('success'))
        <x-alert type="success" class="mb-6">{{ session('success') }}</x-alert>
    @endif
    @if(session('error'))
        <x-alert type="danger" class="mb-6">{{ session('error') }}</x-alert>
    @endif

    <x-table-card>
        @if($riwayat->count() > 0)
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-ink-200 dark:border-ink-700">
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Kampanye</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Rekening</th>
                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Jumlah</th>
                        <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Status</th>
                        <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ink-100 dark:divide-ink-700">
                    @foreach($riwayat as $item)
                        <tr class="hover:bg-ink-50 dark:hover:bg-ink-900/40 transition-colors align-top">
                            <td class="px-6 py-5 text-ink-700 dark:text-ink-200 whitespace-nowrap">{{ $item->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-5">
                                <p class="font-semibold text-ink-900 dark:text-white">{{ $item->kampanye->nama_hewan ?? '—' }}</p>
                                <p class="text-xs text-ink-500 dark:text-ink-400 line-clamp-2 max-w-xs">{{ $item->keterangan }}</p>
                            </td>
                            <td class="px-6 py-5">
                                <p class="font-semibold text-ink-900 dark:text-white">{{ $item->bank }}</p>
                                <p class="text-xs text-ink-500 dark:text-ink-400">{{ $item->nomor_rekening }} a/n {{ $item->nama_rekening }}</p>
                            </td>
                            <td class="px-6 py-5 text-right font-bold text-brand-700 dark:text-brand-300 whitespace-nowrap">Rp {{ number_format($item->total_penarikan, 0, ',', '.') }}</td>
                            <td class="px-6 py-5 text-center">
                                @if($item->isPending())
                                    <x-badge type="warning"><i class="fas fa-clock"></i> Diproses</x-badge>
                                @elseif($item->isApproved())
                                    <x-badge type="info"><i class="fas fa-check"></i> Disetujui</x-badge>
                                    <p class="text-[10px] text-ink-400 mt-1">Menunggu bukti</p>
                                @elseif($item->isCompleted())
                                    <x-badge type="success"><i class="fas fa-check-double"></i> Selesai</x-badge>
                                    <p class="text-[10px] text-ink-400 mt-1">{{ $item->tanggal_selesai?->format('d/m/Y') }}</p>
                                @else
                                    <x-badge type="danger"><i class="fas fa-times-circle"></i> Ditolak</x-badge>
                                @endif
                            </td>
                            <td class="px-6 py-5 text-center">
                                @if($item->isApproved())
                                    <x-button :href="route('shelter.bukti.form', $item->id)" variant="primary" size="sm" icon="upload">Upload Bukti</x-button>
                                @elseif($item->isCompleted() && $item->bukti_pengeluaran)
                                    <a href="{{ Storage::url($item->bukti_pengeluaran) }}"
                                       data-lightbox="{{ Storage::url($item->bukti_pengeluaran) }}"
                                       data-lightbox-caption="Bukti pengeluaran &middot; {{ $item->kampanye->nama_hewan ?? 'Penarikan' }} &middot; Rp {{ number_format($item->total_penarikan, 0, ',', '.') }}"
                                       class="inline-flex items-center gap-1.5 text-xs font-semibold text-brand-600 dark:text-brand-300 hover:underline cursor-zoom-in">
                                        <i class="fas fa-image"></i> Lihat Bukti
                                    </a>
                                @else
                                    <span class="text-xs text-ink-400 italic">—</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <x-empty-state icon="receipt" title="Belum ada riwayat penarikan" message="Penarikan yang Anda ajukan akan muncul di sini." />
        @endif
    </x-table-card>
</section>
@endsection
