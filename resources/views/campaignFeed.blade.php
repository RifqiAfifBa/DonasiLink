@extends('layout.navbarUser')
@section('content')

<div class="content-wrapper justify-content-center d-flex flex-column align-items-center pt-5 pb-5">

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
    <p class="text-muted mt-5">Belum ada kampanye aktif saat ini.</p>
    @endforelse

</div>
@endsection
