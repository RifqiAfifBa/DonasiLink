@props([
    'label' => '',
    'value' => '',
    'icon' => 'chart-line',
    'tone' => 'brand',
    'trend' => null,
])

@php
    $tones = [
        'brand'   => 'bg-gradient-to-br from-brand-500 to-brand-700 text-white',
        'success' => 'bg-gradient-to-br from-emerald-500 to-emerald-700 text-white',
        'danger'  => 'bg-gradient-to-br from-rose-500 to-rose-700 text-white',
        'warning' => 'bg-gradient-to-br from-amber-500 to-amber-600 text-white',
        'info'    => 'bg-gradient-to-br from-sky-500 to-sky-700 text-white',
        'dark'    => 'bg-gradient-to-br from-ink-700 to-ink-900 text-white',
    ];
@endphp

<div {{ $attributes->class('group relative overflow-hidden bg-white dark:bg-ink-800 border border-ink-200 dark:border-ink-700 rounded-2xl p-5 shadow-[0_1px_3px_rgba(15,23,42,0.06)] hover:shadow-[0_10px_25px_rgba(124,58,237,0.12)] hover:-translate-y-0.5 transition-all duration-300') }}>
    <div class="flex items-start justify-between gap-4">
        <div class="min-w-0 flex-1">
            <p class="text-xs font-semibold uppercase tracking-wider text-ink-500 dark:text-ink-400">{{ $label }}</p>
            <p class="mt-2 text-2xl font-bold text-ink-900 dark:text-white truncate">{{ $value }}</p>
            @if($trend)
                <p class="mt-1 text-xs font-medium text-ink-500 dark:text-ink-400">{{ $trend }}</p>
            @endif
        </div>
        <div class="shrink-0 w-12 h-12 rounded-xl flex items-center justify-center {{ $tones[$tone] ?? $tones['brand'] }} shadow-md">
            <i class="fas fa-{{ $icon }} text-lg"></i>
        </div>
    </div>
    {{ $slot }}
</div>
