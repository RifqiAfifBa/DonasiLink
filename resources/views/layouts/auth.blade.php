@extends('layouts.app')

@section('body')
    <div class="min-h-screen flex flex-col">
        <header class="border-b border-ink-200 dark:border-ink-800 bg-white/80 dark:bg-ink-900/80 backdrop-blur-sm">
            <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
                <a href="{{ route('beranda') }}" class="flex items-center gap-2 text-xl font-extrabold text-ink-900 dark:text-white">
                    <span class="w-9 h-9 rounded-xl btn-gradient flex items-center justify-center text-white shadow-md">
                        <i class="fas fa-paw text-sm"></i>
                    </span>
                    DonasiLink
                </a>
                <x-theme-toggle />
            </div>
        </header>
        <main class="flex-1 flex">
            @yield('content')
        </main>
    </div>
@endsection
