@extends('layout.navbarLogin')
@section('content')
<section class="hero">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-md-6">
                <h1>Donasi Link</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
            </div>

            <div class="col-md-6">
                <img src="{{ asset('Asset/Pic/kucing.jpeg') }}">
                <div class="mt-4 justify-content-center d-flex gap-5">
                    <a href="{{ route('kampanye.index') }}" class="btn-custom me-3">Quick Donate</a>
                    <a href="{{ route('impact-story') }}" class="btn-custom">Impact Story</a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- FEATURES -->
<section class="features">
    <div class="container">
        <div class="row">

            <div class="col-md-4">
                <img src="{{ asset('Asset/Pic/money-bag.png') }}">
                <h5>Transparancy</h5>
                <p>Lorem ipsum dolor sit amet...</p>
            </div>

            <div class="col-md-4">
                <img src="{{ asset('Asset/Pic/dog-food.png') }}">
                <h5>For Animal</h5>
                <p>Lorem ipsum dolor sit amet...</p>
            </div>

            <div class="col-md-4">
                <img src="{{ asset('Asset/Pic/healthcare.png') }}">
                <h5>Healty</h5>
                <p>Lorem ipsum dolor sit amet...</p>
            </div>

        </div>
    </div>
</section>

<!-- LIST KAMPANYE -->
<div class="container mb-5 justify-content-center d-flex flex-column align-items-center">

    @forelse($kampanye as $item)
    <div class="card-custom d-flex align-items-center mb-4">
        @if($item->gambar)
            <img src="{{ Storage::url($item->gambar) }}" width="100" alt="{{ $item->nama_hewan }}">
        @else
            <img src="{{ asset('Asset/Pic/WhatsApp Image 2026-04-25 at 12.03.01.jpeg') }}" width="100">
        @endif
        <div class="ms-3 flex-grow-1">
            <h5>{{ $item->nama_hewan }}</h5>
            <p>{{ Str::limit($item->deskripsi_hewan, 80) }}</p>
        </div>
        <a href="{{ route('kampanye.show', $item->id) }}">Detail →</a>
    </div>
    @empty
    <p class="text-muted">Belum ada kampanye aktif.</p>
    @endforelse

</div>
@endsection
