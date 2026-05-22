@props(['label' => null, 'for' => null, 'required' => false, 'error' => null, 'hint' => null])

<div {{ $attributes->class('mb-5') }}>
    @if($label)
        <label @if($for) for="{{ $for }}" @endif class="block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-2">
            {{ $label }}
            @if($required)<span class="text-rose-500 ml-0.5">*</span>@endif
        </label>
    @endif
    {{ $slot }}
    @if($hint && !$error)
        <p class="mt-1.5 text-xs text-ink-500 dark:text-ink-400">{{ $hint }}</p>
    @endif
    @if($error)
        <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400"><i class="fas fa-exclamation-circle mr-1"></i>{{ $error }}</p>
    @endif
</div>
