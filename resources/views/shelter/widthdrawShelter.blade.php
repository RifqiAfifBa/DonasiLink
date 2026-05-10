@extends('layout.navbarShelter')

@section('content')

<div class="shelter-page-wrapper">
    <!-- Header -->
    <div class="shelter-header">
        <div class="shelter-header-content">
            <span class="shelter-logo">$ DonasiLink</span>
            <div class="shelter-nav">
                <a href="{{ route('shelter.landingpage') }}" class="shelter-nav-link">Dashboard</a>
                <a href="{{ route('shelter.withdraw') }}" class="shelter-nav-link active">Withdrawal Tracking</a>
            </div>
        </div>
    </div>

    <!-- Withdrawal List -->
    <div class="shelter-list-wrapper">
        <div class="shelter-withdrawal-list">

            @forelse($kampanye as $item)
            <div class="shelter-withdrawal-item">
                <div class="shelter-item-content">
                    @if($item->gambar)
                        <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->nama_hewan }}" class="shelter-item-image">
                    @else
                        <img src="{{ asset('Asset/Pic/kucing.jpeg') }}" alt="{{ $item->nama_hewan }}" class="shelter-item-image">
                    @endif
                    <div class="shelter-item-info">
                        <h3 class="shelter-item-title">{{ $item->nama_hewan }}</h3>
                        <p class="shelter-item-desc">{{ Str::limit($item->deskripsi_hewan, 80) }}</p>
                    </div>
                    <div class="shelter-item-price">Rp {{ number_format($item->total_terkumpul, 0, ',', '.') }}</div>
                </div>
                <a href="{{ route('shelter.uploadStruk') }}" class="shelter-withdraw-btn">Withdraw Now</a>
            </div>
            @empty
            <p class="text-muted p-4">Belum ada kampanye dengan dana terkumpul.</p>
            @endforelse

        </div>
    </div>
</div>

@endsection
