@extends('layouts.admin')

@section('title', 'Manajemen Donasi')
@section('page-title', 'Manajemen Donasi')
@section('page-subtitle', 'Riwayat seluruh transaksi donasi')

@section('content')
<x-table-card title="Semua Donasi" :subtitle="$donasi->count() . ' transaksi'">
    @if(session('success'))
        <div class="px-6 pt-4">
            <x-alert type="success">{{ session('success') }}</x-alert>
        </div>
    @endif
    @if($donasi->count() > 0)
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-ink-200 dark:border-ink-700">
                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400 w-12">#</th>
                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Donatur</th>
                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Kampanye</th>
                    <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Jumlah</th>
                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Metode</th>
                    <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Tanggal</th>
                    <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-ink-100 dark:divide-ink-700">
                @foreach($donasi as $i => $item)
                    @php
                        $tone = $item->status === 'berhasil' ? 'success' : ($item->status === 'pending' ? 'warning' : 'danger');
                    @endphp
                    <tr class="hover:bg-ink-50 dark:hover:bg-ink-900/40 transition-colors">
                        <td class="px-6 py-4 text-ink-500 dark:text-ink-400">{{ $i + 1 }}</td>
                        <td class="px-6 py-4">
                            <p class="font-semibold text-ink-900 dark:text-white">{{ $item->nama_donatur }}</p>
                            <p class="text-xs text-ink-500 dark:text-ink-400">{{ $item->email_donatur }}</p>
                        </td>
                        <td class="px-6 py-4 text-ink-700 dark:text-ink-200">{{ $item->kampanye->nama_hewan ?? '-' }}</td>
                        <td class="px-6 py-4 text-right font-bold text-brand-700 dark:text-brand-300">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-ink-700 dark:text-ink-200">{{ str_replace('_', ' ', ucfirst($item->metode_pembayaran)) }}</td>
                        <td class="px-6 py-4 text-center"><x-badge :type="$tone">{{ ucfirst($item->status) }}</x-badge></td>
                        <td class="px-6 py-4 text-ink-500 dark:text-ink-400 text-xs">{{ $item->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-center">
                            @if($item->status === 'pending')
                                <div class="flex items-center justify-center gap-1">
                                    <form action="{{ route('admin.donasi.accept', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-3 py-1.5 rounded-lg bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-bold transition-colors"
                                                onclick="return confirm('Setujui donasi ini?')">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.donasi.reject', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-3 py-1.5 rounded-lg bg-rose-500 hover:bg-rose-600 text-white text-xs font-bold transition-colors"
                                                onclick="return confirm('Tolak donasi ini?')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                </div>
                            @else
                                <span class="text-xs text-ink-400">-</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <x-empty-state icon="hand-holding-heart" title="Belum ada data donasi" />
    @endif
</x-table-card>
@endsection
