@props([
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
    'type' => 'button',
    'icon' => null,
])

@php
    $base = 'inline-flex items-center justify-center gap-2 font-semibold rounded-xl transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 disabled:opacity-50 disabled:cursor-not-allowed';

    $variants = [
        'primary'   => 'btn-gradient text-white shadow-[0_8px_20px_-6px_rgba(124,58,237,0.45)] hover:shadow-[0_12px_28px_-8px_rgba(124,58,237,0.55)] hover:-translate-y-0.5',
        'secondary' => 'bg-white text-brand-700 border border-brand-200 hover:bg-brand-50 dark:bg-ink-800 dark:text-brand-200 dark:border-ink-700 dark:hover:bg-ink-700',
        'outline'   => 'bg-transparent text-brand-700 border border-brand-600 hover:bg-brand-50 dark:text-brand-300 dark:border-brand-400 dark:hover:bg-ink-800',
        'ghost'     => 'bg-transparent text-ink-700 hover:bg-ink-100 dark:text-ink-200 dark:hover:bg-ink-800',
        'danger'    => 'bg-rose-600 text-white hover:bg-rose-700 shadow-sm',
        'success'   => 'bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm',
        'dark'      => 'bg-ink-900 text-white hover:bg-ink-800 dark:bg-white dark:text-ink-900 dark:hover:bg-ink-100',
    ];

    $sizes = [
        'sm' => 'px-3 py-1.5 text-sm',
        'md' => 'px-5 py-2.5 text-sm',
        'lg' => 'px-6 py-3.5 text-base',
        'xl' => 'px-8 py-4 text-base',
    ];

    $classes = trim($base . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md']));
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->class($classes) }}>
        @if($icon)<i class="fas fa-{{ $icon }}"></i>@endif
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->class($classes) }}>
        @if($icon)<i class="fas fa-{{ $icon }}"></i>@endif
        {{ $slot }}
    </button>
@endif
