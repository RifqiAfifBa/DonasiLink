@props([
    'title' => null,
    'subtitle' => null,
    'actions' => null,
])

<div {{ $attributes->class('bg-white dark:bg-ink-800 border border-ink-200 dark:border-ink-700 rounded-2xl shadow-[0_1px_3px_rgba(15,23,42,0.06)] overflow-hidden') }}>
    @if($title || $actions)
        <div class="flex flex-wrap items-center justify-between gap-3 px-6 py-4 border-b border-ink-200 dark:border-ink-700">
            <div>
                @if($title)<h3 class="text-base font-semibold text-ink-900 dark:text-white">{{ $title }}</h3>@endif
                @if($subtitle)<p class="text-xs text-ink-500 dark:text-ink-400 mt-0.5">{{ $subtitle }}</p>@endif
            </div>
            @if($actions)<div class="flex items-center gap-2">{{ $actions }}</div>@endif
        </div>
    @endif
    <div class="overflow-x-auto">
        {{ $slot }}
    </div>
</div>
