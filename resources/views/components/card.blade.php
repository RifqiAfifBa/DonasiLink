@props(['padding' => 'p-6'])

<div {{ $attributes->class([
    'bg-white dark:bg-ink-800 border border-ink-200 dark:border-ink-700 rounded-2xl shadow-[0_1px_3px_rgba(15,23,42,0.06)]',
    $padding,
]) }}>
    {{ $slot }}
</div>
