@extends('layouts.admin')

@section('title', 'Log Aktivitas')
@section('page-title', 'Log Aktivitas')
@section('page-subtitle', 'Riwayat aktivitas pengguna dalam sistem')

@section('content')
<x-table-card title="Log Aktivitas" :subtitle="$logs->total() . ' aktivitas'">
    @if($logs->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-ink-200 dark:border-ink-700">
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400 w-12">#</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Waktu</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Pengguna</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Aksi</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Deskripsi</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">IP Address</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ink-100 dark:divide-ink-700">
                    @foreach($logs as $i => $log)
                        <tr class="hover:bg-ink-50 dark:hover:bg-ink-900/40 transition-colors">
                            <td class="px-6 py-4 text-ink-500 dark:text-ink-400">{{ $logs->firstItem() + $i }}</td>
                            <td class="px-6 py-4 text-ink-500 dark:text-ink-400 text-xs whitespace-nowrap">{{ $log->created_at->format('d M Y H:i:s') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($log->user_type)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium
                                        {{ $log->user_type === 'admin' ? 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-300' : '' }}
                                        {{ $log->user_type === 'shelter' ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300' : '' }}
                                        {{ $log->user_type === 'donatur' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300' : '' }}">
                                        {{ ucfirst($log->user_type) }}
                                    </span>
                                    <span class="ml-2 font-semibold text-ink-900 dark:text-white">{{ $log->user_name ?? '#' . $log->user_id }}</span>
                                @else
                                    <span class="text-ink-400 italic">Guest</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium
                                    {{ $log->action === 'login' || $log->action === 'register' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300' : '' }}
                                    {{ $log->action === 'logout' ? 'bg-rose-100 text-rose-700 dark:bg-rose-900/30 dark:text-rose-300' : '' }}
                                    {{ $log->action === 'donate' ? 'bg-brand-100 text-brand-700 dark:bg-brand-900/30 dark:text-brand-300' : '' }}
                                    {{ $log->action === 'create_campaign' ? 'bg-cyan-100 text-cyan-700 dark:bg-cyan-900/30 dark:text-cyan-300' : '' }}
                                    {{ $log->action === 'update_campaign' ? 'bg-sky-100 text-sky-700 dark:bg-sky-900/30 dark:text-sky-300' : '' }}
                                    {{ $log->action === 'submit_withdrawal' ? 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300' : '' }}
                                    {{ $log->action === 'approve_withdrawal' ? 'bg-teal-100 text-teal-700 dark:bg-teal-900/30 dark:text-teal-300' : '' }}
                                    {{ $log->action === 'reject_withdrawal' ? 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300' : '' }}
                                    {{ $log->action === 'upload_proof' ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-300' : '' }}
                                    {{ $log->action === 'create_user' ? 'bg-violet-100 text-violet-700 dark:bg-violet-900/30 dark:text-violet-300' : '' }}
                                    {{ $log->action === 'delete_user' ? 'bg-rose-100 text-rose-700 dark:bg-rose-900/30 dark:text-rose-300' : '' }}
                                    {{ $log->action === 'promote_user' ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-300' : '' }}">
                                    @php
                                        $labels = [
                                            'login' => 'Login',
                                            'logout' => 'Logout',
                                            'register' => 'Registrasi',
                                            'donate' => 'Donasi',
                                            'create_campaign' => 'Buat Kampanye',
                                            'update_campaign' => 'Update Kampanye',
                                            'submit_withdrawal' => 'Ajukan Penarikan',
                                            'approve_withdrawal' => 'Setujui Penarikan',
                                            'reject_withdrawal' => 'Tolak Penarikan',
                                            'upload_proof' => 'Upload Bukti',
                                            'create_user' => 'Buat Pengguna',
                                            'delete_user' => 'Hapus Pengguna',
                                            'promote_user' => 'Promosi Admin',
                                        ];
                                    @endphp
                                    {{ $labels[$log->action] ?? ucfirst(str_replace('_', ' ', $log->action)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-ink-700 dark:text-ink-200 max-w-xs truncate">{{ $log->description }}</td>
                            <td class="px-6 py-4 text-ink-400 dark:text-ink-500 text-xs font-mono">{{ $log->ip_address ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-ink-200 dark:border-ink-700">
            {{ $logs->links() }}
        </div>
    @else
        <x-empty-state icon="history" title="Belum ada log aktivitas" description="Log akan muncul saat pengguna mulai beraktivitas." />
    @endif
</x-table-card>
@endsection
