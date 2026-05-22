@extends('layouts.public')

@section('title', 'Kampanye')

@section('content')
<section class="max-w-7xl mx-auto px-6 lg:px-8 py-12 lg:py-16">
    <div>
        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-100 dark:bg-brand-900/40 text-brand-700 dark:text-brand-200 text-xs font-bold uppercase tracking-wider">
            <i class="fas fa-paw"></i> Semua Kampanye
        </span>
        <h1 class="mt-3 text-3xl sm:text-4xl font-extrabold text-ink-900 dark:text-white">Kampanye Donasi Aktif</h1>
        <p class="mt-2 text-ink-500 dark:text-ink-400">Temukan hewan yang membutuhkan bantuan Anda dan mulai berdonasi.</p>
    </div>

    <div class="mt-10 grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($kampanye as $item)
            @include('partials.campaign-card', ['item' => $item])
        @empty
            <div class="col-span-full">
                <x-empty-state icon="paw" title="Belum ada kampanye aktif" message="Pantau terus untuk update kampanye terbaru." />
            </div>
        @endforelse
    </div>
</section>
@endsection
