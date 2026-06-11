@props([
    'icon' => 'inbox',
    'title' => 'Belum ada data',
    'message' => null,
])

<div {{ $attributes->class('flex flex-col items-center justify-center text-center py-12 px-6') }}>
    <div class="w-16 h-16 rounded-full bg-brand-50 dark:bg-ink-700/60 flex items-center justify-center mb-4">
        <i class="fas fa-{{ $icon }} text-2xl text-brand-500 dark:text-brand-300"></i>
    </div>
    <h3 class="text-lg font-semibold text-ink-800 dark:text-ink-100">{{ $title }}</h3>
    @if($message)
        <p class="mt-1 text-sm text-ink-500 dark:text-ink-400 max-w-sm">{{ $message }}</p>
    @endif
    @if($slot->isNotEmpty())
        <div class="mt-5">{{ $slot }}</div>
    @endif
</div>
