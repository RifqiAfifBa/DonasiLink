@props(['type' => 'neutral'])

@php
    $styles = [
        'neutral'  => 'bg-ink-100 text-ink-700 dark:bg-ink-800 dark:text-ink-200',
        'brand'    => 'bg-brand-100 text-brand-700 dark:bg-brand-900/40 dark:text-brand-200',
        'success'  => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-200',
        'danger'   => 'bg-rose-100 text-rose-800 dark:bg-rose-900/40 dark:text-rose-200',
        'warning'  => 'bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-200',
        'info'     => 'bg-sky-100 text-sky-800 dark:bg-sky-900/40 dark:text-sky-200',
    ];
@endphp

<span {{ $attributes->class([
    'inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold',
    $styles[$type] ?? $styles['neutral'],
]) }}>
    {{ $slot }}
</span>
