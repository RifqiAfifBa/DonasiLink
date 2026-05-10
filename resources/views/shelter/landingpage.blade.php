@extends('layout.navbarShelter')
@section('content')

<div class="container p-5">
    <h1 style="color: #333; font-size: 2rem; margin-bottom: 0.5rem;">Shelter Campaigns</h1>
    <p style="color: #666; margin-bottom: 2rem;">Daftar kampanye donasi untuk shelter hewan</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Shelter Items Grid -->
    <div class="shelter-grid" id="shelterGrid">
        @forelse($kampanye as $item)
        <div class="shelter-card">
            <div class="shelter-card-image">
                @if($item->gambar)
                    <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->nama_hewan }}">
                @else
                    <img src="https://via.placeholder.com/400x200?text=No+Image" alt="{{ $item->nama_hewan }}">
                @endif
            </div>
            <div class="shelter-card-content">
                <h3 class="shelter-card-title">{{ $item->nama_hewan }}</h3>
                <p class="shelter-card-description">{{ Str::limit($item->deskripsi_hewan, 100) }}</p>
                <p><strong>Terkumpul:</strong> Rp {{ number_format($item->total_terkumpul, 0, ',', '.') }}</p>
                <div class="shelter-card-footer">
                    <a href="{{ route('kampanye.show', $item->id) }}" class="detail-link">
                        Detail <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <p class="text-muted">Belum ada kampanye. Tambahkan kampanye baru.</p>
        @endforelse
    </div>
</div>

<!-- Floating Action Button -->
<a href="{{ route('shelter.form') }}" class="fab" id="fabBtn" title="Tambah Kampanye">
    <i class="fas fa-plus"></i>
</a>

@endsection
