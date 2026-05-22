@extends('layouts.app')

@section('body')
    <div class="flex min-h-screen bg-ink-50 dark:bg-ink-900">
        @include('partials.navbar-admin')

        <div class="flex-1 flex flex-col lg:ml-64">
            <header class="sticky top-0 z-30 bg-white/90 dark:bg-ink-800/90 backdrop-blur-sm border-b border-ink-200 dark:border-ink-700 px-6 lg:px-8 h-16 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <button type="button" onclick="document.getElementById('adminSidebar').classList.toggle('-translate-x-full')" class="lg:hidden w-9 h-9 rounded-lg flex items-center justify-center text-ink-600 hover:bg-ink-100 dark:text-ink-300 dark:hover:bg-ink-700">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div>
                        <h1 class="text-base font-bold text-ink-900 dark:text-white">@yield('page-title', 'Dashboard')</h1>
                        @hasSection('page-subtitle')
                            <p class="text-xs text-ink-500 dark:text-ink-400">@yield('page-subtitle')</p>
                        @endif
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <x-theme-toggle />
                    <span class="hidden sm:inline-flex items-center gap-2 text-xs text-ink-500 dark:text-ink-400 px-3 py-1.5 rounded-lg bg-ink-100 dark:bg-ink-700">
                        <i class="fas fa-calendar-alt"></i> {{ now()->format('d M Y') }}
                    </span>
                </div>
            </header>

            <main class="flex-1 p-6 lg:p-8">
                @yield('content')
            </main>
        </div>
    </div>
@endsection
