@extends('layouts.shelter')

@section('title', 'Perkembangan ' . $kampanye->nama_hewan)

@section('content')
<div class="max-w-4xl mx-auto px-6 lg:px-8 py-8 lg:py-10 space-y-6">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm">
        <a href="{{ route('shelter.landingpage') }}" class="text-brand-600 dark:text-brand-300 font-medium hover:underline"><i class="fas fa-home mr-1"></i>Dashboard</a>
        <span class="text-ink-300">/</span>
        <span class="text-ink-500 dark:text-ink-400 truncate">Update Perkembangan: {{ $kampanye->nama_hewan }}</span>
    </nav>

    {{-- Header --}}
    <div class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-teal-100 dark:bg-teal-900/40 text-teal-700 dark:text-teal-200 text-xs font-bold uppercase tracking-wider">
                <i class="fas fa-stethoscope"></i> Monitoring Hewan
            </span>
            <h1 class="mt-3 text-3xl font-extrabold text-ink-900 dark:text-white">
                Perkembangan <span class="bg-gradient-to-r from-teal-600 to-brand-600 bg-clip-text text-transparent">{{ $kampanye->nama_hewan }}</span>
            </h1>
            <p class="mt-1 text-ink-500 dark:text-ink-400">
                Riwayat medis, kondisi, dan foto perkembangan hewan. Setiap update akan dikirim sebagai notifikasi ke donatur.
            </p>
        </div>
        <x-button :href="route('shelter.perkembangan.create', $kampanye->id)" variant="primary" size="lg" icon="plus">
            Tambah Update
        </x-button>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <x-alert type="success">{{ session('success') }}</x-alert>
    @endif
    @if(session('error'))
        <x-alert type="danger">{{ session('error') }}</x-alert>
    @endif

    {{-- Info Card Kampanye --}}
    <div class="flex items-center gap-4 p-4 rounded-2xl bg-teal-50 dark:bg-teal-900/20 border border-teal-200 dark:border-teal-800/50">
        @if($kampanye->gambar)
            <img src="{{ route('foto.show', $kampanye->gambar) }}" alt="{{ $kampanye->nama_hewan }}" class="w-16 h-16 rounded-2xl object-cover shrink-0 ring-2 ring-teal-300 dark:ring-teal-700">
        @else
            <div class="w-16 h-16 rounded-2xl bg-teal-200 dark:bg-teal-800 flex items-center justify-center text-2xl text-teal-600 dark:text-teal-300 shrink-0">
                <i class="fas fa-paw"></i>
            </div>
        @endif
        <div class="flex-1 min-w-0">
            <p class="text-xs text-ink-500 dark:text-ink-400">Kampanye Aktif</p>
            <p class="font-bold text-ink-900 dark:text-white truncate">{{ $kampanye->nama_hewan }} — {{ $kampanye->usia_hewan }}</p>
            <p class="text-xs text-ink-500 dark:text-ink-400 mt-0.5">
                {{ $perkembangan->count() }} catatan perkembangan
                · <a href="{{ route('kampanye.show', $kampanye->id) }}" class="text-brand-600 dark:text-brand-300 hover:underline" target="_blank">Lihat halaman publik <i class="fas fa-external-link-alt text-[10px]"></i></a>
            </p>
        </div>
    </div>

    {{-- Timeline Perkembangan --}}
    @if($perkembangan->count() > 0)
        <div class="relative">
            {{-- Garis vertikal timeline --}}
            <div class="absolute left-6 top-6 bottom-6 w-0.5 bg-gradient-to-b from-teal-400 via-brand-400 to-fuchsia-400 opacity-30 rounded-full"></div>

            <ol class="space-y-5">
                @foreach($perkembangan as $update)
                <li class="flex gap-5">
                    {{-- Dot & Icon --}}
                    <div class="relative shrink-0">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center shadow-md
                            {{ $update->jenis === 'medis'     ? 'bg-rose-100 dark:bg-rose-900/40 text-rose-600 dark:text-rose-300' : '' }}
                            {{ $update->jenis === 'pakan'     ? 'bg-amber-100 dark:bg-amber-900/40 text-amber-600 dark:text-amber-300' : '' }}
                            {{ $update->jenis === 'perawatan' ? 'bg-blue-100 dark:bg-blue-900/40 text-blue-600 dark:text-blue-300' : '' }}
                            {{ $update->jenis === 'umum'      ? 'bg-teal-100 dark:bg-teal-900/40 text-teal-600 dark:text-teal-300' : '' }}
                        ">
                            <i class="fas {{ $update->jenisIcon() }} text-lg"></i>
                        </div>
                    </div>

                    {{-- Card Konten --}}
                    <div class="flex-1 min-w-0 bg-white dark:bg-ink-800 border border-ink-200 dark:border-ink-700 rounded-2xl shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                        {{-- Header card --}}
                        <div class="flex flex-wrap items-center justify-between gap-3 px-5 py-3 border-b border-ink-100 dark:border-ink-700 bg-ink-50 dark:bg-ink-800/50">
                            <div>
                                <h3 class="text-base font-bold text-ink-900 dark:text-white">{{ $update->judul }}</h3>
                                <p class="text-xs text-ink-500 dark:text-ink-400 mt-0.5">
                                    {{ $update->tanggal_update->translatedFormat('d F Y') }}
                                    @if($update->nama_dokter)
                                        · Dr. {{ $update->nama_dokter }}
                                        @if($update->nama_klinik) · {{ $update->nama_klinik }} @endif
                                    @endif
                                </p>
                            </div>
                            <div class="flex items-center gap-2">
                                @if($update->kondisi)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold {{ $update->kondisiColor() }}">
                                        <i class="fas fa-circle text-[6px]"></i> {{ $update->kondisiLabel() }}
                                    </span>
                                @endif
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-ink-100 dark:bg-ink-700 text-ink-600 dark:text-ink-300 capitalize">
                                    {{ $update->jenis }}
                                </span>
                            </div>
                        </div>

                        {{-- Catatan --}}
                        <div class="px-5 py-4">
                            <p class="text-sm text-ink-700 dark:text-ink-200 leading-relaxed whitespace-pre-line">{{ $update->catatan }}</p>
                        </div>

                        {{-- Foto Sebelum / Sesudah --}}
                        @if($update->foto_sebelum || $update->foto_sesudah)
                            <div class="px-5 pb-4">
                                <p class="text-[11px] font-bold uppercase tracking-wider text-ink-400 dark:text-ink-500 mb-2">Foto Dokumentasi</p>
                                <div class="grid grid-cols-2 gap-3">
                                    @if($update->foto_sebelum)
                                        <div>
                                            <p class="text-xs font-semibold text-ink-500 dark:text-ink-400 mb-1.5"><i class="fas fa-arrow-left mr-1 text-rose-500"></i>Sebelum</p>
                                            <a href="{{ route('foto.show', $update->foto_sebelum) }}"
                                               data-lightbox="{{ route('foto.show', $update->foto_sebelum) }}"
                                               data-lightbox-alt="Foto sebelum: {{ $update->judul }}"
                                               class="block rounded-xl overflow-hidden ring-1 ring-ink-200 dark:ring-ink-700 hover:ring-rose-400 transition-all cursor-zoom-in">
                                                <img src="{{ route('foto.show', $update->foto_sebelum) }}" alt="Sebelum" class="w-full h-32 object-cover">
                                            </a>
                                        </div>
                                    @endif
                                    @if($update->foto_sesudah)
                                        <div>
                                            <p class="text-xs font-semibold text-ink-500 dark:text-ink-400 mb-1.5"><i class="fas fa-arrow-right mr-1 text-emerald-500"></i>Sesudah / Terbaru</p>
                                            <a href="{{ route('foto.show', $update->foto_sesudah) }}"
                                               data-lightbox="{{ route('foto.show', $update->foto_sesudah) }}"
                                               data-lightbox-alt="Foto sesudah: {{ $update->judul }}"
                                               class="block rounded-xl overflow-hidden ring-1 ring-ink-200 dark:ring-ink-700 hover:ring-emerald-400 transition-all cursor-zoom-in">
                                                <img src="{{ route('foto.show', $update->foto_sesudah) }}" alt="Sesudah" class="w-full h-32 object-cover">
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        {{-- Aksi --}}
                        <div class="flex justify-end items-center gap-2 px-5 py-3 border-t border-ink-100 dark:border-ink-700 bg-ink-50/50 dark:bg-ink-800/30">
                            <x-button :href="route('shelter.perkembangan.edit', [$kampanye->id, $update->id])" variant="secondary" size="sm" icon="pen">
                                Edit
                            </x-button>
                            <form action="{{ route('shelter.perkembangan.destroy', [$kampanye->id, $update->id]) }}" method="POST"
                                  onsubmit="return confirm('Hapus update ini? Tindakan tidak dapat dibatalkan.')">
                                @csrf
                                @method('DELETE')
                                <x-button type="submit" variant="ghost" size="sm" icon="trash" class="text-rose-600 hover:text-rose-700">
                                    Hapus
                                </x-button>
                            </form>
                        </div>
                    </div>
                </li>
                @endforeach
            </ol>
        </div>
    @else
        <x-card padding="p-0">
            <x-empty-state icon="stethoscope" title="Belum Ada Catatan Perkembangan"
                message="Mulai posting update perkembangan hewan agar donatur dapat memantau kondisinya secara real-time.">
                <x-button :href="route('shelter.perkembangan.create', $kampanye->id)" variant="primary" size="lg" icon="plus">
                    Tambah Update Pertama
                </x-button>
            </x-empty-state>
        </x-card>
    @endif

</div>
@endsection
