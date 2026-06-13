@extends('layouts.public')

@section('title', $kampanye->nama_hewan)

@push('head')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('content')
@php
$pct = $kampanye->target_donasi > 0 ? min(($kampanye->total_terkumpul / $kampanye->target_donasi) * 100, 100) : 0;
$sakit = $kampanye->sedang_sakit === 'ya';
@endphp

<section class="max-w-6xl mx-auto px-6 lg:px-8 py-10 lg:py-14">
    <nav class="flex items-center gap-2 text-sm mb-8">
        <a href="{{ route('beranda') }}" class="text-brand-600 dark:text-brand-300 font-medium hover:underline"><i class="fas fa-home mr-1"></i> Beranda</a>
        <span class="text-ink-300">/</span>
        <a href="{{ route('kampanye.index') }}" class="text-brand-600 dark:text-brand-300 font-medium hover:underline">Kampanye</a>
        <span class="text-ink-300">/</span>
        <span class="text-ink-500 dark:text-ink-400 truncate">{{ $kampanye->nama_hewan }}</span>
    </nav>

    <div class="max-w-4xl mx-auto space-y-6">
        <div class="rounded-3xl overflow-hidden shadow-xl ring-1 ring-black/5 dark:ring-white/5">
            @if($kampanye->gambar)
            <img src="{{ route('foto.show', $kampanye->gambar) }}" alt="{{ $kampanye->nama_hewan }}" class="w-full h-[400px] object-cover">
            @else
            <div class="w-full h-[400px] bg-gradient-to-br from-brand-100 to-fuchsia-100 dark:from-ink-700 dark:to-ink-800 flex items-center justify-center text-8xl text-brand-400">
                <i class="fas fa-paw"></i>
            </div>
            @endif
        </div>

        <x-card padding="p-7">
            <h3 class="flex items-center gap-2 text-base font-bold text-ink-900 dark:text-white mb-5">
                <i class="fas fa-paw text-brand-500"></i> Informasi Hewan
            </h3>
            <div class="grid sm:grid-cols-2 gap-3">
                @foreach([
                ['label' => 'Nama Hewan', 'value' => $kampanye->nama_hewan],
                ['label' => 'Usia', 'value' => $kampanye->usia_hewan],
                ['label' => 'Kondisi', 'value' => $sakit ? 'Sedang Sakit' : 'Sehat', 'tone' => $sakit ? 'danger' : 'success'],
                ['label' => 'Shelter', 'value' => $kampanye->shelter->nama_shelter ?? '-'],
                ] as $info)
                <div class="p-4 rounded-2xl bg-ink-50 dark:bg-ink-900">
                    <p class="text-[11px] font-bold uppercase tracking-wider text-ink-400 dark:text-ink-500">{{ $info['label'] }}</p>
                    <p class="mt-1 text-sm font-semibold
                            {{ ($info['tone'] ?? null) === 'danger' ? 'text-rose-600 dark:text-rose-300' : '' }}
                            {{ ($info['tone'] ?? null) === 'success' ? 'text-emerald-600 dark:text-emerald-300' : '' }}
                            {{ empty($info['tone'] ?? null) ? 'text-ink-900 dark:text-white' : '' }}">
                        {{ $info['value'] }}
                    </p>
                </div>
                @endforeach
                <div class="sm:col-span-2 p-4 rounded-2xl bg-ink-50 dark:bg-ink-900">
                    <p class="text-[11px] font-bold uppercase tracking-wider text-ink-400 dark:text-ink-500">Kebutuhan</p>
                    <p class="mt-1 text-sm font-semibold text-ink-900 dark:text-white">{{ $kampanye->kebutuhan_hewan }}</p>
                </div>
            </div>
        </x-card>

        <x-card padding="p-7">
            <h3 class="flex items-center gap-2 text-base font-bold text-ink-900 dark:text-white mb-4">
                <i class="fas fa-align-left text-brand-500"></i> Tentang Kampanye
            </h3>
            <p class="text-ink-600 dark:text-ink-300 leading-relaxed whitespace-pre-line">{{ $kampanye->deskripsi_hewan }}</p>
        </x-card>

        {{-- Transparansi Dana --}}
        <x-card padding="p-7">
            <div class="flex flex-wrap items-center justify-between gap-3 mb-5">
                <div>
                    <span class="inline-flex items-center gap-2 px-2.5 py-1 rounded-full bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300 text-[11px] font-bold uppercase tracking-wider">
                        <i class="fas fa-shield-halved"></i> Transparansi Dana
                    </span>
                    <h3 class="mt-2 flex items-center gap-2 text-base font-bold text-ink-900 dark:text-white">
                        <i class="fas fa-eye text-emerald-500"></i> Penggunaan Dana
                    </h3>
                    <p class="text-xs text-ink-500 dark:text-ink-400 mt-0.5">Setiap penarikan yang disetujui ditampilkan di sini lengkap dengan bukti pengeluarannya.</p>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-3 mb-6">
                <div class="p-3 rounded-xl bg-brand-50 dark:bg-brand-900/30 border border-brand-100 dark:border-brand-800/50">
                    <p class="text-[10px] font-bold uppercase tracking-wider text-brand-700 dark:text-brand-300">Total Donasi</p>
                    <p class="mt-1 text-sm font-extrabold text-ink-900 dark:text-white">Rp {{ number_format($kampanye->total_terkumpul, 0, ',', '.') }}</p>
                </div>
                <div class="p-3 rounded-xl bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-100 dark:border-emerald-800/50">
                    <p class="text-[10px] font-bold uppercase tracking-wider text-emerald-700 dark:text-emerald-300">Sudah Disalurkan</p>
                    <p class="mt-1 text-sm font-extrabold text-ink-900 dark:text-white">Rp {{ number_format($totalDisetujui, 0, ',', '.') }}</p>
                </div>
                <div class="p-3 rounded-xl bg-ink-100 dark:bg-ink-900 border border-ink-200 dark:border-ink-700">
                    <p class="text-[10px] font-bold uppercase tracking-wider text-ink-600 dark:text-ink-400">Sisa Saldo</p>
                    <p class="mt-1 text-sm font-extrabold text-ink-900 dark:text-white">Rp {{ number_format($sisaDana, 0, ',', '.') }}</p>
                </div>
            </div>

            @if($kampanye->penarikan->isEmpty())
            <div class="flex flex-col items-center text-center py-8 rounded-2xl bg-ink-50 dark:bg-ink-900 border border-dashed border-ink-200 dark:border-ink-700">
                <div class="w-12 h-12 rounded-full bg-emerald-100 dark:bg-emerald-900/40 text-emerald-600 dark:text-emerald-300 flex items-center justify-center mb-2">
                    <i class="fas fa-lock"></i>
                </div>
                <p class="text-sm font-semibold text-ink-900 dark:text-white">Dana masih utuh di kampanye</p>
                <p class="text-xs text-ink-500 dark:text-ink-400 mt-1 max-w-sm">Belum ada penarikan yang dicairkan. Setiap penyaluran dana akan tercatat di sini secara transparan.</p>
            </div>
            @else
            <ol class="relative space-y-5 pl-6 before:absolute before:left-2 before:top-1.5 before:bottom-1.5 before:w-px before:bg-ink-200 dark:before:bg-ink-700">
                @foreach($kampanye->penarikan as $p)
                <li class="relative">
                    <span class="absolute -left-6 top-1.5 w-4 h-4 rounded-full ring-4 ring-white dark:ring-ink-800
                                {{ $p->bukti_pengeluaran ? 'bg-emerald-500' : 'bg-amber-400' }}"></span>

                    <div class="rounded-2xl border border-ink-200 dark:border-ink-700 bg-white dark:bg-ink-900 overflow-hidden">
                        <div class="flex flex-wrap items-center justify-between gap-3 px-5 py-3 border-b border-ink-100 dark:border-ink-700 bg-ink-50 dark:bg-ink-800/40">
                            <div>
                                <p class="text-xs text-ink-500 dark:text-ink-400">{{ $p->tanggal_disetujui?->format('d M Y') ?? $p->created_at->format('d M Y') }}</p>
                                <p class="text-sm font-bold text-ink-900 dark:text-white">{{ $p->keterangan }}</p>
                                @if($p->kategori_pengeluaran)
                                <span class="inline-flex items-center gap-1 mt-1 text-[11px] font-semibold
                                    {{ $p->kategori_pengeluaran === 'Medis' ? 'text-red-600 dark:text-red-300' : '' }}
                                    {{ $p->kategori_pengeluaran === 'Pakan' ? 'text-amber-600 dark:text-amber-300' : '' }}
                                    {{ $p->kategori_pengeluaran === 'Operasional' ? 'text-blue-600 dark:text-blue-300' : '' }}">
                                    {{ $p->kategori_pengeluaran === 'Medis' ? '💊' : '' }}{{ $p->kategori_pengeluaran === 'Pakan' ? '🍖' : '' }}{{ $p->kategori_pengeluaran === 'Operasional' ? '🔧' : '' }}
                                    {{ $p->kategori_pengeluaran }}
                                </span>
                                @endif
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-extrabold text-brand-700 dark:text-brand-300">Rp {{ number_format($p->total_penarikan, 0, ',', '.') }}</p>
                                @if($p->bukti_pengeluaran)
                                <span class="inline-flex items-center gap-1 mt-0.5 px-2 py-0.5 rounded-full bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300 text-[10px] font-bold uppercase"><i class="fas fa-check-double"></i> Terverifikasi</span>
                                @else
                                <span class="inline-flex items-center gap-1 mt-0.5 px-2 py-0.5 rounded-full bg-amber-100 dark:bg-amber-900/40 text-amber-700 dark:text-amber-300 text-[10px] font-bold uppercase"><i class="fas fa-clock"></i> Menunggu Bukti</span>
                                @endif
                            </div>
                        </div>

                        @if($p->bukti_pengeluaran)
                        <div class="grid sm:grid-cols-[200px_1fr] gap-4 p-5">
                            <a href="{{ route('foto.show', $p->bukti_pengeluaran) }}"
                                data-lightbox="{{ route('foto.show', $p->bukti_pengeluaran) }}"
                                data-lightbox-alt="Bukti pengeluaran {{ $p->keterangan }}"
                                data-lightbox-caption="Bukti pengeluaran &middot; {{ $p->keterangan }} &middot; Rp {{ number_format($p->total_penarikan, 0, ',', '.') }}"
                                class="block rounded-xl overflow-hidden ring-1 ring-ink-200 dark:ring-ink-700 hover:ring-brand-400 transition-all bg-ink-100 dark:bg-ink-800 cursor-zoom-in">
                                <img src="{{ route('foto.show', $p->bukti_pengeluaran) }}" alt="Bukti pengeluaran" class="w-full h-32 object-cover">
                                <p class="text-[10px] text-center py-1.5 text-brand-600 dark:text-brand-300 font-semibold"><i class="fas fa-search-plus mr-1"></i>Lihat Bukti</p>
                            </a>
                            <div>
                                <p class="text-[11px] font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400 mb-1.5">Rincian Penggunaan</p>
                                <p class="text-sm text-ink-700 dark:text-ink-200 leading-relaxed whitespace-pre-line">{{ $p->deskripsi_penggunaan }}</p>
                                <p class="mt-3 text-[11px] text-ink-400">Dicairkan ke: <strong>{{ $p->bank }}</strong> a/n {{ $p->nama_rekening }}</p>
                            </div>
                        </div>
                        @else
                        <div class="px-5 py-4 text-xs text-ink-500 dark:text-ink-400">
                            <i class="fas fa-hourglass-half text-amber-500 mr-1"></i>
                            Dana sudah dicairkan ke <strong>{{ $p->bank }}</strong> a/n {{ $p->nama_rekening }}. Bukti pengeluaran sedang menunggu diunggah oleh shelter.
                        </div>
                        @endif
                    </div>
                </li>
                @endforeach
            </ol>
            @endif
        </x-card>

        {{-- Chart: Fund Distribution --}}
        @if($kampanye->penarikan->isNotEmpty())
        <x-chart id="fundDistributionChart" title="Distribusi Dana Kampanye" type="pie" :data="$fundDistributionData" />
        @endif

        {{-- PERKEMBANGAN HEWAN --}}
        <x-card padding="p-7">
            <div class="flex flex-wrap items-center justify-between gap-3 mb-5">
                <div>
                    <span class="inline-flex items-center gap-2 px-2.5 py-1 rounded-full bg-teal-100 dark:bg-teal-900/40 text-teal-700 dark:text-teal-300 text-[11px] font-bold uppercase tracking-wider">
                        <i class="fas fa-stethoscope"></i> Monitoring Hewan
                    </span>
                    <h3 class="mt-2 flex items-center gap-2 text-base font-bold text-ink-900 dark:text-white">
                        <i class="fas fa-heart-pulse text-teal-500"></i> Riwayat Perkembangan {{ $kampanye->nama_hewan }}
                    </h3>
                    <p class="text-xs text-ink-500 dark:text-ink-400 mt-0.5">Update terbaru kondisi hewan yang diposting oleh shelter secara transparan.</p>
                </div>
                @if($kampanye->perkembangan->isNotEmpty())
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-teal-50 dark:bg-teal-900/20 text-teal-700 dark:text-teal-300 text-xs font-bold">
                    <i class="fas fa-list-check"></i> {{ $kampanye->perkembangan->count() }} Catatan
                </span>
                @endif
            </div>

            @if($kampanye->perkembangan->isEmpty())
                <div class="flex flex-col items-center text-center py-8 rounded-2xl bg-ink-50 dark:bg-ink-900 border border-dashed border-ink-200 dark:border-ink-700">
                    <div class="w-12 h-12 rounded-full bg-teal-100 dark:bg-teal-900/40 text-teal-600 dark:text-teal-300 flex items-center justify-center mb-2">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <p class="text-sm font-semibold text-ink-900 dark:text-white">Belum ada catatan perkembangan</p>
                    <p class="text-xs text-ink-500 dark:text-ink-400 mt-1 max-w-sm">Shelter akan segera memposting update kondisi hewan ini. Pantau terus halaman ini.</p>
                </div>
            @else
                <ol class="relative space-y-4 pl-6 before:absolute before:left-2 before:top-1.5 before:bottom-1.5 before:w-px before:bg-gradient-to-b before:from-teal-400 before:via-brand-400 before:to-fuchsia-400 before:opacity-30 before:rounded-full">
                    @foreach($kampanye->perkembangan as $update)
                    <li class="relative">
                        {{-- Timeline dot --}}
                        <span class="absolute -left-6 top-3 w-4 h-4 rounded-full ring-4 ring-white dark:ring-ink-800
                            {{ $update->jenis === 'medis' ? 'bg-rose-400' : '' }}
                            {{ $update->jenis === 'pakan' ? 'bg-amber-400' : '' }}
                            {{ $update->jenis === 'perawatan' ? 'bg-blue-400' : '' }}
                            {{ $update->jenis === 'umum' ? 'bg-teal-400' : '' }}
                        "></span>

                        <div class="rounded-2xl border border-ink-200 dark:border-ink-700 bg-white dark:bg-ink-900 overflow-hidden">
                            {{-- Header --}}
                            <div class="flex flex-wrap items-center justify-between gap-3 px-5 py-3 border-b border-ink-100 dark:border-ink-700 bg-ink-50 dark:bg-ink-800/40">
                                <div>
                                    <p class="text-xs text-ink-500 dark:text-ink-400">{{ $update->tanggal_update->translatedFormat('d F Y') }}</p>
                                    <p class="text-sm font-bold text-ink-900 dark:text-white">{{ $update->judul }}</p>
                                    @if($update->nama_dokter)
                                        <p class="text-xs text-ink-400 dark:text-ink-500 mt-0.5">
                                            <i class="fas fa-user-doctor mr-1"></i>Dr. {{ $update->nama_dokter }}
                                            @if($update->nama_klinik) · {{ $update->nama_klinik }} @endif
                                        </p>
                                    @endif
                                </div>
                                <div class="flex items-center gap-2 flex-wrap">
                                    @if($update->kondisi)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold {{ $update->kondisiColor() }}">
                                            <i class="fas fa-circle text-[6px]"></i> {{ $update->kondisiLabel() }}
                                        </span>
                                    @endif
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold capitalize
                                        {{ $update->jenis === 'medis' ? 'bg-rose-100 dark:bg-rose-900/30 text-rose-700 dark:text-rose-300' : '' }}
                                        {{ $update->jenis === 'pakan' ? 'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300' : '' }}
                                        {{ $update->jenis === 'perawatan' ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300' : '' }}
                                        {{ $update->jenis === 'umum' ? 'bg-teal-100 dark:bg-teal-900/30 text-teal-700 dark:text-teal-300' : '' }}
                                    ">
                                        <i class="fas {{ $update->jenisIcon() }} text-[10px]"></i> {{ $update->jenis }}
                                    </span>
                                </div>
                            </div>

                            {{-- Catatan --}}
                            <div class="px-5 py-4">
                                <p class="text-sm text-ink-700 dark:text-ink-200 leading-relaxed whitespace-pre-line">{{ $update->catatan }}</p>
                            </div>

                            {{-- Foto sebelum & sesudah --}}
                            @if($update->foto_sebelum || $update->foto_sesudah)
                            <div class="px-5 pb-5">
                                <p class="text-[11px] font-bold uppercase tracking-wider text-ink-400 dark:text-ink-500 mb-2">Foto Dokumentasi</p>
                                <div class="grid grid-cols-2 gap-3">
                                    @if($update->foto_sebelum)
                                    <div>
                                        <p class="text-xs font-semibold text-rose-600 dark:text-rose-400 mb-1.5"><i class="fas fa-arrow-left mr-1"></i>Sebelum</p>
                                        <a href="{{ route('foto.show', $update->foto_sebelum) }}"
                                           data-lightbox="{{ route('foto.show', $update->foto_sebelum) }}"
                                           data-lightbox-alt="Sebelum: {{ $update->judul }}"
                                           class="block rounded-xl overflow-hidden ring-1 ring-ink-200 dark:ring-ink-700 hover:ring-rose-400 transition-all cursor-zoom-in">
                                            <img src="{{ route('foto.show', $update->foto_sebelum) }}" alt="Sebelum" class="w-full h-36 object-cover">
                                        </a>
                                    </div>
                                    @endif
                                    @if($update->foto_sesudah)
                                    <div>
                                        <p class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 mb-1.5"><i class="fas fa-arrow-right mr-1"></i>Sesudah / Terkini</p>
                                        <a href="{{ route('foto.show', $update->foto_sesudah) }}"
                                           data-lightbox="{{ route('foto.show', $update->foto_sesudah) }}"
                                           data-lightbox-alt="Sesudah: {{ $update->judul }}"
                                           class="block rounded-xl overflow-hidden ring-1 ring-ink-200 dark:ring-ink-700 hover:ring-emerald-400 transition-all cursor-zoom-in">
                                            <img src="{{ route('foto.show', $update->foto_sesudah) }}" alt="Sesudah" class="w-full h-36 object-cover">
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                    </li>
                    @endforeach
                </ol>
            @endif
        </x-card>

    </div>
</section>
@endsection