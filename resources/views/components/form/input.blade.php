@props([
    'type' => 'text',
    'name' => '',
    'id' => null,
    'icon' => null,
    'error' => null,
    'value' => null,
])

@php
    $id = $id ?? $name;
    $hasError = !empty($error);
    $base = 'block w-full rounded-xl border bg-white dark:bg-ink-900 text-ink-900 dark:text-ink-100 placeholder:text-ink-400 dark:placeholder:text-ink-500 text-sm transition-all duration-150 focus:outline-none focus:ring-4';
    $state = $hasError
        ? 'border-rose-400 focus:border-rose-500 focus:ring-rose-100 dark:focus:ring-rose-900/40'
        : 'border-ink-200 dark:border-ink-700 focus:border-brand-500 focus:ring-brand-100 dark:focus:ring-brand-900/40';
    $padding = $icon ? 'pl-11 pr-4 py-3' : 'px-4 py-3';
@endphp

<div class="relative">
    @if($icon)
        <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-ink-400 dark:text-ink-500">
            <i class="fas fa-{{ $icon }} text-sm"></i>
        </span>
    @endif
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $id }}"
        @if(!is_null($value)) value="{{ $value }}" @endif
        {{ $attributes->class([$base, $state, $padding]) }}
    />
</div>
@if($hasError)
    <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400"><i class="fas fa-exclamation-circle mr-1"></i>{{ $error }}</p>
@endif
