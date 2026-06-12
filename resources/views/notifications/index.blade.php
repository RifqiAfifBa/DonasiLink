@php
    $layout = match(session('role')) {
        'donatur' => 'layouts.donatur',
        'shelter' => 'layouts.shelter',
        'admin'   => 'layouts.admin',
        default   => 'layouts.public',
    };
    $title = match(session('role')) {
        'donatur' => 'Notifikasi Donatur',
        'shelter' => 'Notifikasi Shelter',
        'admin'   => 'Notifikasi Admin',
        default   => 'Notifikasi',
    };
@endphp

@extends($layout)

@section('title', $title)

@if(session('role') === 'admin')
@section('page-title', 'Notifikasi')
@section('page-subtitle', 'Semua notifikasi sistem')
@endif

@php
$typeIcons = [
    'donasi_berhasil' => ['icon' => 'hand-holding-heart', 'bg' => 'bg-emerald-100 dark:bg-emerald-900/40', 'fg' => 'text-emerald-700 dark:text-emerald-300'],
    'penarikan_disetujui' => ['icon' => 'check-circle', 'bg' => 'bg-blue-100 dark:bg-blue-900/40', 'fg' => 'text-blue-700 dark:text-blue-300'],
    'penarikan_ditolak' => ['icon' => 'times-circle', 'bg' => 'bg-rose-100 dark:bg-rose-900/40', 'fg' => 'text-rose-700 dark:text-rose-300'],
    'penarikan_diajukan' => ['icon' => 'file-invoice', 'bg' => 'bg-amber-100 dark:bg-amber-900/40', 'fg' => 'text-amber-700 dark:text-amber-300'],
    'bukti_diunggah' => ['icon' => 'image', 'bg' => 'bg-purple-100 dark:bg-purple-900/40', 'fg' => 'text-purple-700 dark:text-purple-300'],
    'rekonsiliasi_selesai' => ['icon' => 'balance-scale', 'bg' => 'bg-teal-100 dark:bg-teal-900/40', 'fg' => 'text-teal-700 dark:text-teal-300'],
    'kampanye_selesai' => ['icon' => 'flag-checkered', 'bg' => 'bg-cyan-100 dark:bg-cyan-900/40', 'fg' => 'text-cyan-700 dark:text-cyan-300'],
    'dampak_diunggah' => ['icon' => 'leaf', 'bg' => 'bg-green-100 dark:bg-green-900/40', 'fg' => 'text-green-700 dark:text-green-300'],
    'notifikasi_dampak' => ['icon' => 'chart-line', 'bg' => 'bg-indigo-100 dark:bg-indigo-900/40', 'fg' => 'text-indigo-700 dark:text-indigo-300'],
];
@endphp

@section('content')
<div class="max-w-4xl mx-auto px-6 lg:px-8 py-8 lg:py-10">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-extrabold text-ink-900 dark:text-white">Notifikasi</h1>
            <p class="text-sm text-ink-500 dark:text-ink-400 mt-1">Semua notifikasi Anda</p>
        </div>
        @if($notifications->whereNull('read_at')->count() > 0)
        <form action="{{ route('notifications.markAllAsRead') }}" method="POST">
            @csrf
            <x-button type="submit" variant="ghost" size="sm" icon="check-double">
                Tandai Semua Dibaca
            </x-button>
        </form>
        @endif
    </div>

    @if($notifications->count() > 0)
    <div class="space-y-3">
        @foreach($notifications as $notif)
        @php $meta = $typeIcons[$notif->type] ?? ['icon' => 'bell', 'bg' => 'bg-ink-100 dark:bg-ink-800', 'fg' => 'text-ink-700 dark:text-ink-300']; @endphp
        <div class="relative flex items-start gap-4 p-5 rounded-2xl border transition-all
                    {{ $notif->read_at
                       ? 'bg-white dark:bg-ink-800 border-ink-200 dark:border-ink-700'
                       : 'bg-brand-50 dark:bg-brand-900/20 border-brand-200 dark:border-brand-800' }}">
            @if(!$notif->read_at)
            <span class="absolute top-5 right-5 w-2.5 h-2.5 rounded-full bg-brand-500"></span>
            @endif
            <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 {{ $meta['bg'] }} {{ $meta['fg'] }}">
                <i class="fas fa-{{ $meta['icon'] }}"></i>
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-bold text-ink-900 dark:text-white">{{ $notif->title }}</p>
                        <p class="text-sm text-ink-600 dark:text-ink-300 mt-1">{{ $notif->message }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 mt-3">
                    <span class="text-xs text-ink-400 dark:text-ink-500">
                        <i class="far fa-clock mr-1"></i>{{ $notif->created_at->diffForHumans() }}
                    </span>
                    @if(!$notif->read_at)
                    <form action="{{ route('notifications.markAsRead', $notif) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-xs font-semibold text-brand-600 dark:text-brand-300 hover:underline">Tandai dibaca</button>
                    </form>
                    @endif
                    <form action="{{ route('notifications.destroy', $notif) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs text-ink-400 hover:text-rose-600 dark:hover:text-rose-300">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $notifications->links() }}
    </div>
    @else
    <div class="text-center py-16">
        <div class="w-20 h-20 rounded-full bg-ink-100 dark:bg-ink-800 flex items-center justify-center mx-auto">
            <i class="fas fa-bell text-3xl text-ink-400 dark:text-ink-500"></i>
        </div>
        <h3 class="mt-4 text-lg font-bold text-ink-900 dark:text-white">Belum Ada Notifikasi</h3>
        <p class="mt-2 text-sm text-ink-500 dark:text-ink-400">Anda akan menerima notifikasi saat ada aktivitas penting.</p>
    </div>
    @endif
</div>
@endsection
