@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan platform DonasiLink')

@section('content')
<div class="space-y-7">
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">
        <x-stat-card label="Total Shelter" :value="$totalShelter" icon="home" tone="brand" />
        <x-stat-card label="Total Donatur" :value="$totalDonatur" icon="users" tone="info" />
        <x-stat-card label="Total Kampanye" :value="$totalKampanye" icon="paw" tone="success" />
        <x-stat-card label="Total Donasi" :value="$totalDonasi" icon="hand-holding-heart" tone="warning" />
    </div>

    <x-table-card title="Daftar Shelter" subtitle="Shelter yang terdaftar di platform">
        @if($shelters->count() > 0)
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-ink-200 dark:border-ink-700">
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400 w-12">#</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Nama Shelter</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Username</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Lokasi</th>
                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Kampanye</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ink-100 dark:divide-ink-700">
                    @foreach($shelters as $i => $shelter)
                        <tr class="hover:bg-ink-50 dark:hover:bg-ink-900/40 transition-colors">
                            <td class="px-6 py-4 text-ink-500 dark:text-ink-400">{{ $i + 1 }}</td>
                            <td class="px-6 py-4 font-semibold text-ink-900 dark:text-white">{{ $shelter->Nama_shelter }}</td>
                            <td class="px-6 py-4 text-ink-700 dark:text-ink-200">{{ $shelter->username ?? '-' }}</td>
                            <td class="px-6 py-4 text-ink-700 dark:text-ink-200">{{ $shelter->Lokasi }}</td>
                            <td class="px-6 py-4 text-right font-semibold text-ink-900 dark:text-white">{{ $shelter->kampanye->count() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <x-empty-state icon="home" title="Belum ada shelter terdaftar" />
        @endif
    </x-table-card>

    <x-table-card title="Daftar Kampanye" subtitle="Semua kampanye di platform">
        @if($kampanye->count() > 0)
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-ink-200 dark:border-ink-700">
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400 w-12">#</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Hewan</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Shelter</th>
                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Target</th>
                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Terkumpul</th>
                        <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ink-100 dark:divide-ink-700">
                    @foreach($kampanye as $i => $item)
                        @php
                            $tone = $item->status === 'aktif' ? 'success' : ($item->status === 'selesai' ? 'info' : 'danger');
                        @endphp
                        <tr class="hover:bg-ink-50 dark:hover:bg-ink-900/40 transition-colors">
                            <td class="px-6 py-4 text-ink-500 dark:text-ink-400">{{ $i + 1 }}</td>
                            <td class="px-6 py-4 font-semibold text-ink-900 dark:text-white">{{ $item->nama_hewan }}</td>
                            <td class="px-6 py-4 text-ink-700 dark:text-ink-200">{{ $item->shelter->Nama_shelter ?? '-' }}</td>
                            <td class="px-6 py-4 text-right text-ink-700 dark:text-ink-200">Rp {{ number_format($item->target_donasi, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-right font-semibold text-brand-700 dark:text-brand-300">Rp {{ number_format($item->total_terkumpul, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-center"><x-badge :type="$tone">{{ ucfirst($item->status) }}</x-badge></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <x-empty-state icon="paw" title="Belum ada kampanye" />
        @endif
    </x-table-card>
</div>
@endsection
