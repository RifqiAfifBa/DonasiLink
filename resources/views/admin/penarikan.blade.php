@extends('layouts.admin')

@section('title', 'Penarikan Dana')
@section('page-title', 'Manajemen Penarikan Dana')
@section('page-subtitle', 'Tinjau pengajuan & verifikasi bukti pengeluaran shelter')

@section('content')
<div class="space-y-5">
    @if(session('success'))
        <x-alert type="success" dismissible>{{ session('success') }}</x-alert>
    @endif

    <x-table-card title="Daftar Pengajuan Penarikan" :subtitle="$riwayat->count() . ' pengajuan'">
        @if($riwayat->count() > 0)
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-ink-200 dark:border-ink-700">
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Shelter & Kampanye</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Rekening & Tujuan</th>
                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Nominal</th>
                        <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Status</th>
                        <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Bukti & Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ink-100 dark:divide-ink-700">
                    @foreach($riwayat as $item)
                        <tr class="hover:bg-ink-50 dark:hover:bg-ink-900/40 transition-colors align-top">
                            <td class="px-6 py-5 text-ink-700 dark:text-ink-200 whitespace-nowrap">
                                <p>{{ $item->created_at->format('d/m/Y') }}</p>
                                <p class="text-[10px] text-ink-400">{{ $item->created_at->format('H:i') }}</p>
                                @if($item->tanggal_disetujui)
                                    <p class="text-[10px] text-emerald-600 dark:text-emerald-300 mt-1"><i class="fas fa-check mr-0.5"></i>{{ $item->tanggal_disetujui->format('d/m H:i') }}</p>
                                @endif
                                @if($item->tanggal_selesai)
                                    <p class="text-[10px] text-brand-600 dark:text-brand-300"><i class="fas fa-check-double mr-0.5"></i>{{ $item->tanggal_selesai->format('d/m H:i') }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-5">
                                <p class="font-semibold text-ink-900 dark:text-white">{{ $item->shelter ? $item->shelter->nama_shelter : 'Shelter #'.$item->shelter_id }}</p>
                                <p class="text-xs text-brand-600 dark:text-brand-300 mt-0.5"><i class="fas fa-paw mr-1"></i>{{ $item->kampanye->nama_hewan ?? '—' }}</p>
                            </td>
                            <td class="px-6 py-5 max-w-md">
                                <p class="font-semibold text-ink-900 dark:text-white">{{ $item->bank }} &middot; {{ $item->nomor_rekening }}</p>
                                <p class="text-xs text-ink-500 dark:text-ink-400">a/n {{ $item->nama_rekening }}</p>
                                <p class="mt-1.5 inline-block px-2.5 py-1 rounded-md bg-ink-100 dark:bg-ink-900 text-xs text-ink-600 dark:text-ink-300">{{ $item->keterangan }}</p>
                            </td>
                            <td class="px-6 py-5 text-right font-extrabold text-brand-700 dark:text-brand-300 whitespace-nowrap">Rp {{ number_format($item->total_penarikan, 0, ',', '.') }}</td>
                            <td class="px-6 py-5 text-center">
                                @if($item->isPending())
                                    <x-badge type="warning"><i class="fas fa-clock"></i> Diproses</x-badge>
                                @elseif($item->isApproved())
                                    <x-badge type="info"><i class="fas fa-check"></i> Disetujui</x-badge>
                                    <p class="text-[10px] text-ink-400 mt-1">Menunggu bukti dari shelter</p>
                                @elseif($item->isCompleted())
                                    <x-badge type="success"><i class="fas fa-check-double"></i> Selesai</x-badge>
                                    <p class="text-[10px] text-emerald-600 dark:text-emerald-300 mt-1">Transparan publik</p>
                                @else
                                    <x-badge type="danger"><i class="fas fa-times-circle"></i> Ditolak</x-badge>
                                @endif
                            </td>
                            <td class="px-6 py-5">
                                @if($item->isPending())
                                    <div class="flex justify-center gap-2">
                                        <form action="{{ route('admin.penarikan.accept', $item->id) }}" method="POST">@csrf
                                            <x-button type="submit" variant="success" size="sm" icon="check">Terima</x-button>
                                        </form>
                                        <form action="{{ route('admin.penarikan.reject', $item->id) }}" method="POST">@csrf
                                            <x-button type="submit" variant="danger" size="sm" icon="times">Tolak</x-button>
                                        </form>
                                    </div>
                                @elseif($item->isCompleted())
                                    <div class="flex flex-col items-center gap-2">
                                        <a href="{{ Storage::url($item->bukti_pengeluaran) }}"
                                           data-lightbox="{{ Storage::url($item->bukti_pengeluaran) }}"
                                           data-lightbox-caption="Bukti pengeluaran &middot; {{ $item->kampanye->nama_hewan ?? 'Penarikan' }} &middot; Rp {{ number_format($item->total_penarikan, 0, ',', '.') }}"
                                           class="block w-20 h-20 rounded-lg overflow-hidden ring-2 ring-emerald-300 dark:ring-emerald-700 hover:ring-emerald-500 transition-all cursor-zoom-in">
                                            <img src="{{ Storage::url($item->bukti_pengeluaran) }}" alt="Bukti" class="w-full h-full object-cover">
                                        </a>
                                        @if($item->deskripsi_penggunaan)
                                            <button type="button" onclick="toggleDeskripsi({{ $item->id }})" class="text-[11px] font-semibold text-brand-600 dark:text-brand-300 hover:underline">Lihat Rincian</button>
                                            <div id="deskripsi-{{ $item->id }}" class="hidden text-left text-xs text-ink-600 dark:text-ink-300 p-2 rounded-lg bg-ink-100 dark:bg-ink-900 max-w-xs whitespace-pre-line">{{ $item->deskripsi_penggunaan }}</div>
                                        @endif
                                    </div>
                                @elseif($item->isApproved())
                                    <span class="text-[11px] text-ink-400 italic">Menunggu shelter upload bukti</span>
                                @else
                                    <span class="text-[11px] text-ink-400 italic">—</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <x-empty-state icon="inbox" title="Belum ada pengajuan penarikan" message="Pengajuan penarikan dari shelter akan muncul di sini." />
        @endif
    </x-table-card>
</div>

@push('scripts')
<script>
function toggleDeskripsi(id) {
    document.getElementById('deskripsi-' + id)?.classList.toggle('hidden');
}
</script>
@endpush
@endsection
