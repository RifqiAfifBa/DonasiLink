@props(['for' => null, 'required' => false])

<label @if($for) for="{{ $for }}" @endif {{ $attributes->class('block text-sm font-semibold text-ink-700 dark:text-ink-200 mb-2') }}>
    {{ $slot }}
    @if($required)<span class="text-rose-500 ml-0.5">*</span>@endif
</label>
