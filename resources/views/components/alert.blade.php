@props([
    'type' => 'info',
    'icon' => null,
    'dismissible' => false,
])

@php
    $styles = [
        'success' => 'bg-emerald-50 text-emerald-800 border-emerald-200 dark:bg-emerald-950/40 dark:text-emerald-200 dark:border-emerald-800/60',
        'danger'  => 'bg-rose-50 text-rose-800 border-rose-200 dark:bg-rose-950/40 dark:text-rose-200 dark:border-rose-800/60',
        'warning' => 'bg-amber-50 text-amber-800 border-amber-200 dark:bg-amber-950/40 dark:text-amber-200 dark:border-amber-800/60',
        'info'    => 'bg-sky-50 text-sky-800 border-sky-200 dark:bg-sky-950/40 dark:text-sky-200 dark:border-sky-800/60',
    ];
    $icons = [
        'success' => 'check-circle',
        'danger'  => 'exclamation-circle',
        'warning' => 'exclamation-triangle',
        'info'    => 'info-circle',
    ];
    $resolvedIcon = $icon ?? ($icons[$type] ?? 'info-circle');
@endphp

<div {{ $attributes->class([
    'flex items-start gap-3 px-4 py-3 rounded-xl border text-sm font-medium',
    $styles[$type] ?? $styles['info'],
]) }} role="alert">
    <i class="fas fa-{{ $resolvedIcon }} mt-0.5 shrink-0"></i>
    <div class="flex-1">{{ $slot }}</div>
    @if($dismissible)
        <button type="button" onclick="this.parentElement.remove()" class="text-current opacity-60 hover:opacity-100" aria-label="Tutup">
            <i class="fas fa-times"></i>
        </button>
    @endif
</div>
