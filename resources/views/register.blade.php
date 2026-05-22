@extends('layouts.auth')

@section('title', 'Daftar')

@section('content')
<div class="grid lg:grid-cols-2 w-full">
    <aside class="hidden lg:flex relative overflow-hidden bg-gradient-to-br from-ink-900 via-brand-900 to-brand-700 px-12 py-16 flex-col justify-center">
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-brand-500/20 blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-80 h-80 rounded-full bg-fuchsia-500/15 blur-3xl"></div>

        <div class="relative z-10 max-w-lg">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 border border-white/15 text-brand-200 text-xs font-semibold backdrop-blur-sm">
                <i class="fas fa-sparkles"></i> Bergabung Gratis
            </span>
            <h1 class="mt-8 text-4xl xl:text-5xl font-extrabold text-white leading-tight">
                Mulai perjalanan
                <span class="bg-gradient-to-r from-brand-300 to-fuchsia-300 bg-clip-text text-transparent">kebaikan</span>
                Anda
            </h1>
            <p class="mt-5 text-base text-brand-200/80 leading-relaxed">
                Daftar dalam 1 menit dan mulai membantu hewan yang membutuhkan.
            </p>

            <div class="mt-10 space-y-3">
                @foreach([
                    ['n' => 1, 'title' => 'Buat Akun', 'desc' => 'Isi data diri Anda dengan mudah'],
                    ['n' => 2, 'title' => 'Pilih Kampanye', 'desc' => 'Temukan hewan yang perlu bantuan Anda'],
                    ['n' => 3, 'title' => 'Berdonasi & Pantau', 'desc' => 'Lihat dampak nyata dari donasi Anda'],
                ] as $step)
                    <div class="flex items-start gap-4 p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm">
                        <div class="shrink-0 w-9 h-9 rounded-xl btn-gradient flex items-center justify-center text-white font-bold text-sm shadow-md">
                            {{ $step['n'] }}
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-white">{{ $step['title'] }}</p>
                            <p class="text-xs text-brand-200/70">{{ $step['desc'] }}</p>
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

            <h2 class="text-3xl font-extrabold text-ink-900 dark:text-white">Buat Akun Baru</h2>
            <p class="mt-2 text-sm text-ink-500 dark:text-ink-400">Isi formulir di bawah untuk memulai.</p>

            @if($errors->any())
                <x-alert type="danger" class="mt-6">{{ $errors->first() }}</x-alert>
            @endif

            <form action="{{ route('register.post') }}" method="POST" class="mt-7">
                @csrf
                <div class="grid sm:grid-cols-2 gap-4">
                    <x-form.group label="Username" for="username" required>
                        <x-form.input name="username" id="username" icon="at" placeholder="username_kamu" :value="old('username')" required />
                    </x-form.group>
                    <x-form.group :label="__('No. Telepon')" for="no_telepon" hint="opsional">
                        <x-form.input name="no_telepon" id="no_telepon" icon="phone" placeholder="08xx-xxxx-xxxx" :value="old('no_telepon')" />
                    </x-form.group>
                </div>

                <x-form.group label="Alamat Email" for="email" required>
                    <x-form.input type="email" name="email" id="email" icon="envelope" placeholder="email@contoh.com" :value="old('email')" required />
                </x-form.group>

                <div class="grid sm:grid-cols-2 gap-4">
                    <x-form.group label="Password" for="password" required>
                        <div class="relative">
                            <x-form.input type="password" name="password" id="password" icon="lock" placeholder="Min. 6 karakter" class="pr-12" required />
                            <button type="button"
                                    onclick="(function(b){const i=document.getElementById('password');const ic=b.querySelector('i');const isPw=i.type==='password';i.type=isPw?'text':'password';ic.classList.toggle('fa-eye',!isPw);ic.classList.toggle('fa-eye-slash',isPw);})(this)"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-ink-400 hover:text-brand-600 dark:hover:text-brand-300" tabindex="-1" aria-label="Toggle password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </x-form.group>
                    <x-form.group label="Konfirmasi Password" for="password_confirmation" required>
                        <div class="relative">
                            <x-form.input type="password" name="password_confirmation" id="password_confirmation" icon="lock" placeholder="Ulangi password" class="pr-12" required />
                            <button type="button"
                                    onclick="(function(b){const i=document.getElementById('password_confirmation');const ic=b.querySelector('i');const isPw=i.type==='password';i.type=isPw?'text':'password';ic.classList.toggle('fa-eye',!isPw);ic.classList.toggle('fa-eye-slash',isPw);})(this)"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-ink-400 hover:text-brand-600 dark:hover:text-brand-300" tabindex="-1" aria-label="Toggle password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </x-form.group>
                </div>

                <x-button type="submit" variant="primary" size="lg" icon="user-plus" class="w-full mt-2">
                    Buat Akun Sekarang
                </x-button>
            </form>

            <p class="text-center text-sm text-ink-500 dark:text-ink-400 mt-6">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-semibold text-brand-600 dark:text-brand-300 hover:underline">Masuk di sini</a>
            </p>
        </div>
    </section>
</div>
@endsection
