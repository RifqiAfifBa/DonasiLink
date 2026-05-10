@extends('layout.navbarUser')
@section('content')

<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="content-wrapper justify-content-center d-flex flex-column align-items-center pt-5 pb-5 text-center">
    <div class="detail-container">
        <div class="detail-header">
            @if($kampanye->gambar)
                <img class="detail-image" src="{{ Storage::url($kampanye->gambar) }}" alt="{{ $kampanye->nama_hewan }}">
            @else
                <img class="detail-image" src="{{ asset('Asset/Pic/WhatsApp Image 2026-04-25 at 12.02.13.jpeg') }}" alt="Campaign Detail">
            @endif
            <h2 class="detail-title">{{ $kampanye->nama_hewan }}</h2>

            <div class="detail-content">
                <h3>Tentang Kampanye</h3>
                <p>{{ $kampanye->deskripsi_hewan }}</p>

                <h3>Informasi Hewan</h3>
                <ul class="text-start">
                    <li><strong>Usia:</strong> {{ $kampanye->usia_hewan }}</li>
                    <li><strong>Sedang Sakit:</strong> {{ ucfirst($kampanye->sedang_sakit) }}</li>
                    <li><strong>Kebutuhan:</strong> {{ $kampanye->kebutuhan_hewan }}</li>
                    <li><strong>Shelter:</strong> {{ $kampanye->shelter->nama_shelter ?? '-' }}</li>
                </ul>

                <h3>Progress Donasi</h3>
                <div class="progress mb-2">
                    <div class="progress-bar" style="width: {{ $kampanye->persentase() }}%">
                        {{ $kampanye->persentase() }}%
                    </div>
                </div>
                <p>Terkumpul: <strong>Rp {{ number_format($kampanye->total_terkumpul, 0, ',', '.') }}</strong></p>
            </div>
        </div>
    </div>

    <div class="detail-footer">
        <a href="{{ route('kampanye.index') }}" class="btn-secondary text-center detail-btn">Kembali</a>
        <a href="{{ route('checkout.show', $kampanye->id) }}" class="btn-primary text-center detail-btn">Donasi Sekarang</a>
    </div>
</div>

@endsection
