@extends('layout.navbarUser')
@section('content')

<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('resources/views/style.css') }}">

<div class="content-wrapper">
    <div class="checkout-container">
        <div class="checkout-header">
            <h2>Konfirmasi Donasi</h2>
        </div>

        <div class="payment-info" style="margin-bottom: 16px;">
            <div class="payment-info-row">
                <span>Shelter :</span>
                <strong>{{ $shelter_name ?? 'Friends Pet' }}</strong>
            </div>
            <div class="payment-info-row">
                <span>Donatur :</span>
                <strong>{{ $donor_name ?? 'Jaka Supriyanto' }}</strong>
            </div>
            <div class="payment-info-row">
                <span>Biaya Donasi :</span>
                <strong id="donationAmountText">{{ isset($donation_amount) ? 'Rp ' . number_format($donation_amount, 0, ',', '.') : 'Rp 50.000' }}</strong>
            </div>
        </div>

        <div class="shelter-confirm-grid">
            <div class="shelter-confirm-card">
                <div class="shelter-confirm-title">Gambar Hewan</div>
                <img
                    class="shelter-confirm-image"
                    src="{{ $animal_image_url ?? asset('Asset/Pic/kucing.jpeg') }}"
                    alt="Gambar Hewan">
            </div>

            <div class="shelter-confirm-card">
                <div class="shelter-confirm-title">Deskripsi Kebutuhan Hewan</div>
                <p class="shelter-confirm-desc">{{ $animal_need_description ?? 'Kebutuhan pakan sehat untuk hewan agar tetap aktif dan sehat.' }}</p>
            </div>
        </div>

        <div class="shelter-confirm-card" style="margin-top: 16px;">
            <div class="shelter-confirm-title">Struck / Nota dari Shelter</div>
            @if(!empty($struck_image_url))
            <img class="shelter-confirm-image" src="{{ $struck_image_url }}" alt="Struck / Nota">
            @else
            <img class="shelter-confirm-image" src="{{ asset('Asset/Pic/WhatsApp Image 2026-04-25 at 12.03.01.jpeg') }}" alt="Struck / Nota">
            @endif
        </div>

        <div class="shelter-confirm-actions">
            <form method="POST" action="{{ $approve_url ?? '#' }}">
                @csrf
                <button type="submit" class="btn-approve">Setuju</button>
            </form>

            <form method="POST" action="{{ $reject_url ?? '#' }}">
                @csrf
                <button type="submit" class="btn-reject">Tidak Setuju</button>
            </form>
        </div>
    </div>
</div>

<style>
    .shelter-confirm-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .shelter-confirm-card {
        background: #fff;
        border: 1px solid #eee;
        border-radius: 12px;
        padding: 16px;
    }

    .shelter-confirm-title {
        font-weight: 700;
        margin-bottom: 12px;
        color: #333;
    }

    .shelter-confirm-image {
        width: 100%;
        max-height: 320px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #f0f0f0;
    }

    .shelter-confirm-desc {
        color: #555;
        line-height: 1.6;
        margin: 0;
    }

    .shelter-confirm-actions {
        display: flex;
        gap: 12px;
        justify-content: center;
        margin-top: 16px;
        flex-wrap: wrap;
    }

    .btn-approve,
    .btn-reject {
        border: none;
        border-radius: 12px;
        padding: 12px 22px;
        font-weight: 700;
        cursor: pointer;
        font-size: 16px;
        min-width: 160px;
    }

    .btn-approve {
        background: #6d28d9;
        color: #fff;
    }

    .btn-reject {
        background: #ef4444;
        color: #fff;
    }

    .btn-approve:hover {
        background: #5b21b6;
    }

    .btn-reject:hover {
        background: #dc2626;
    }

    @media (max-width: 900px) {
        .shelter-confirm-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

@endsection