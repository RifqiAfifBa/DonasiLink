@extends('layouts.admin')

@section('title', 'Manajemen Shelter')
@section('page-title', 'Manajemen Shelter')
@section('page-subtitle', 'Daftar shelter terverifikasi')

@section('content')
<x-table-card title="Semua Shelter" :subtitle="$shelters->count() . ' shelter terdaftar'">
    @if($shelters->count() > 0)
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-ink-200 dark:border-ink-700">
                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400 w-12">#</th>
                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Shelter</th>
                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Username</th>
                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Lokasi</th>
                    <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Target</th>
                    <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Terkumpul</th>
                    <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Kampanye</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-ink-100 dark:divide-ink-700">
                @foreach($shelters as $i => $shelter)
                    <tr class="hover:bg-ink-50 dark:hover:bg-ink-900/40 transition-colors">
                        <td class="px-6 py-4 text-ink-500 dark:text-ink-400">{{ $i + 1 }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <span class="w-10 h-10 rounded-xl btn-gradient flex items-center justify-center text-white font-bold text-sm shadow-md">
                                    {{ strtoupper(substr($shelter->Nama_shelter, 0, 1)) }}
                                </span>
                                <span class="font-semibold text-ink-900 dark:text-white">{{ $shelter->Nama_shelter }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-ink-700 dark:text-ink-200">{{ $shelter->username ?? '-' }}</td>
                        <td class="px-6 py-4 text-ink-700 dark:text-ink-200">{{ $shelter->Lokasi }}</td>
                        <td class="px-6 py-4 text-right text-ink-700 dark:text-ink-200">Rp {{ number_format($shelter->target_donasi, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-right font-semibold text-brand-700 dark:text-brand-300">Rp {{ number_format($shelter->terkumpul, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-right text-ink-700 dark:text-ink-200">{{ $shelter->kampanye->count() }} kampanye</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <x-empty-state icon="home" title="Belum ada shelter terdaftar" />
    @endif
</x-table-card>
@endsection
