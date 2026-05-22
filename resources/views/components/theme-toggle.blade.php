@props(['variant' => 'switch'])

@if($variant === 'switch')
    <label class="relative inline-flex items-center cursor-pointer select-none" aria-label="Toggle dark mode">
        <input type="checkbox" class="sr-only peer" data-theme-toggle>
        <span class="w-11 h-6 bg-ink-200 dark:bg-ink-700 rounded-full peer-checked:bg-brand-600 transition-colors duration-300"></span>
        <span class="absolute left-1 top-1 w-4 h-4 rounded-full bg-white shadow flex items-center justify-center text-[9px] text-amber-500 peer-checked:translate-x-5 peer-checked:text-brand-600 transition-transform duration-300">
            <i class="fas fa-sun peer-checked:hidden"></i>
        </span>
    </label>
@else
    <button type="button" data-theme-toggle class="w-9 h-9 rounded-lg flex items-center justify-center text-ink-600 hover:text-brand-600 hover:bg-brand-50 dark:text-ink-300 dark:hover:bg-ink-700 dark:hover:text-brand-300 transition-colors" aria-label="Toggle dark mode">
        <i class="fas fa-moon dark:hidden"></i>
        <i class="fas fa-sun hidden dark:inline"></i>
    </button>
@endif
