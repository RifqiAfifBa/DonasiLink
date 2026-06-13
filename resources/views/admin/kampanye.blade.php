@extends('layouts.admin')

@section('title', 'Manajemen Kampanye')
@section('page-title', 'Manajemen Kampanye')
@section('page-subtitle', 'Daftar seluruh kampanye di platform')

@section('content')
<x-table-card title="Semua Kampanye" :subtitle="$kampanye->count() . ' kampanye terdaftar'">
    @if($kampanye->count() > 0)
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-ink-200 dark:border-ink-700">
                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400 w-12">#</th>
                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Hewan</th>
                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Shelter</th>
                    <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Target</th>
                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Progress</th>
                    <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Status</th>
                    <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400 w-20">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-ink-100 dark:divide-ink-700">
                @foreach($kampanye as $i => $item)
                    @php
                        $tone = $item->status === 'aktif' ? 'success' : ($item->status === 'selesai' ? 'info' : 'danger');
                    @endphp
                    <tr class="hover:bg-ink-50 dark:hover:bg-ink-900/40 transition-colors">
                        <td class="px-6 py-4 text-ink-500 dark:text-ink-400">{{ $i + 1 }}</td>
                        <td class="px-6 py-4 max-w-xs">
                            <p class="font-semibold text-ink-900 dark:text-white">{{ $item->nama_hewan }}</p>
                            <p class="text-xs text-ink-500 dark:text-ink-400 mt-0.5 truncate">{{ Str::limit($item->deskripsi_hewan, 60) }}</p>
                        </td>
                        <td class="px-6 py-4 text-ink-700 dark:text-ink-200">{{ $item->shelter->Nama_shelter ?? '-' }}</td>
                        <td class="px-6 py-4 text-right text-ink-700 dark:text-ink-200">Rp {{ number_format($item->target_donasi, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-28 h-2 rounded-full bg-ink-100 dark:bg-ink-700 overflow-hidden">
                                    <div class="h-full rounded-full bg-gradient-to-r from-brand-500 to-fuchsia-500" style="width: {{ $item->persentase() }}%"></div>
                                </div>
                                <span class="text-xs font-bold text-ink-700 dark:text-ink-200">{{ $item->persentase() }}%</span>
                            </div>
                            <p class="mt-1 text-xs text-ink-500 dark:text-ink-400">Rp {{ number_format($item->total_terkumpul, 0, ',', '.') }}</p>
                        </td>
                        <td class="px-6 py-4 text-center"><x-badge :type="$tone">{{ ucfirst($item->status) }}</x-badge></td>
                        <td class="px-6 py-4 text-center">
                            <form action="{{ route('admin.kampanye.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kampanye &quot;{{ $item->nama_hewan }}&quot;? Semua data donasi terkait akan ikut terhapus. Tindakan ini tidak dapat dibatalkan.')">
                                @csrf @method('DELETE')
                                <x-button type="submit" variant="danger" size="sm" icon="trash-can">Hapus</x-button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <x-empty-state icon="paw" title="Belum ada kampanye" />
    @endif
</x-table-card>
@endsection
