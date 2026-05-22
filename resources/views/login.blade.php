@extends('layouts.auth')

@section('title', 'Masuk')

@section('content')
<div class="grid lg:grid-cols-2 w-full">
    <aside class="hidden lg:flex relative overflow-hidden bg-gradient-to-br from-ink-900 via-brand-900 to-brand-700 px-12 py-16 flex-col justify-center">
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-brand-500/20 blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-80 h-80 rounded-full bg-fuchsia-500/15 blur-3xl"></div>

        <div class="relative z-10 max-w-lg">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 border border-white/15 text-brand-200 text-xs font-semibold backdrop-blur-sm">
                <i class="fas fa-paw"></i> Platform Donasi Hewan
            </span>
            <h1 class="mt-8 text-4xl xl:text-5xl font-extrabold text-white leading-tight">
                Selamat datang di
                <span class="bg-gradient-to-r from-brand-300 to-fuchsia-300 bg-clip-text text-transparent">DonasiLink</span>
            </h1>
            <p class="mt-5 text-base text-brand-200/80 leading-relaxed">
                Bergabunglah dengan ribuan donatur yang telah membantu hewan-hewan yang membutuhkan.
            </p>

            <div class="mt-10 space-y-3">
                @foreach([
                    ['icon' => 'shield-halved', 'title' => 'Aman & Terpercaya', 'desc' => 'Setiap donasi diverifikasi dan transparan'],
                    ['icon' => 'chart-line',    'title' => 'Pantau Donasi Anda', 'desc' => 'Dashboard lengkap riwayat donasi'],
                    ['icon' => 'heart',         'title' => 'Dampak Nyata',       'desc' => 'Lihat langsung perubahan yang Anda buat'],
                ] as $feat)
                    <div class="flex items-center gap-4 p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm">
                        <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-brand-400/30 to-brand-600/30 flex items-center justify-center text-brand-200">
                            <i class="fas fa-{{ $feat['icon'] }}"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-white">{{ $feat['title'] }}</p>
                            <p class="text-xs text-brand-200/70">{{ $feat['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </aside>

    <section class="flex flex-col justify-center px-6 sm:px-10 lg:px-16 py-12 bg-white dark:bg-ink-900">
        <div class="w-full max-w-md mx-auto">
            <a href="{{ route('beranda') }}" class="inline-flex items-center gap-2 text-sm font-medium text-ink-500 hover:text-brand-600 dark:text-ink-400 dark:hover:text-brand-300 transition-colors mb-8">
                <i class="fas fa-arrow-left"></i> Kembali ke Beranda
            </a>

            <h2 class="text-3xl font-extrabold text-ink-900 dark:text-white">Masuk ke Akun</h2>
            <p class="mt-2 text-sm text-ink-500 dark:text-ink-400">Masukkan email atau username dan password Anda.</p>

            @if(session('success'))
                <x-alert type="success" class="mt-6">{{ session('success') }}</x-alert>
            @endif
            @if($errors->any())
                <x-alert type="danger" class="mt-6">{{ $errors->first() }}</x-alert>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="mt-7 space-y-5">
                @csrf
                <x-form.group label="Email / Username" for="email" required>
                    <x-form.input name="email" id="email" icon="user" placeholder="Masukkan email atau username" :value="old('email')" required />
                </x-form.group>

                <x-form.group label="Password" for="password" required>
                    <div class="relative" x-data>
                        <x-form.input type="password" name="password" id="password" icon="lock" placeholder="Masukkan password Anda" class="pr-12" required />
                        <button type="button"
                                onclick="(function(b){const i=document.getElementById('password');const ic=b.querySelector('i');const isPw=i.type==='password';i.type=isPw?'text':'password';ic.classList.toggle('fa-eye',!isPw);ic.classList.toggle('fa-eye-slash',isPw);})(this)"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-ink-400 hover:text-brand-600 dark:hover:text-brand-300 transition-colors"
                                tabindex="-1" aria-label="Toggle password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </x-form.group>

                <label class="flex items-center gap-2 text-sm text-ink-600 dark:text-ink-300 cursor-pointer">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded border-ink-300 text-brand-600 focus:ring-brand-500">
                    Ingat saya
                </label>

                <x-button type="submit" variant="primary" size="lg" icon="sign-in-alt" class="w-full">
                    Masuk
                </x-button>
            </form>

            <div class="relative my-7">
                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-ink-200 dark:border-ink-700"></div></div>
                <div class="relative flex justify-center"><span class="px-3 bg-white dark:bg-ink-900 text-xs text-ink-400">atau</span></div>
            </div>

            <p class="text-center text-sm text-ink-500 dark:text-ink-400">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-semibold text-brand-600 dark:text-brand-300 hover:underline">Daftar sekarang</a>
            </p>
        </div>
    </section>
</div>
@endsection
