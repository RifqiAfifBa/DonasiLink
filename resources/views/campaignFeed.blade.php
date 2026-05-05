@extends('layout.navbarUser')
@section('content')

<div class="content-wrapper justify-content-center d-flex flex-column align-items-center pt-5 pb-5">

    <div class="card-custom d-flex align-items-center mb-4">
        <img src="{{ asset('Asset/Pic/WhatsApp Image 2026-04-25 at 12.03.01.jpeg') }}" width="100">
        <div class="ms-3 flex-grow-1">
            <h5>Pakan Sehat</h5>
            <p>Lorem ipsum dolor sit amet...</p>
        </div>
        <a href="CampaignFeed-Detail">Detail →</a>
    </div>

    <div class="card-custom d-flex align-items-center mb-4">
        <img src="{{ asset('Asset/Pic/WhatsApp Image 2026-04-25 at 12.03.01.jpeg') }}" width="100">
        <div class="ms-3 flex-grow-1">
            <h5>Hamil Sehat</h5>
            <p>Lorem ipsum dolor sit amet...</p>
        </div>
        <a href="CampaignFeed-Detail">Detail →</a>
    </div>

    <div class="card-custom d-flex align-items-center">
        <img src="{{ asset('Asset/Pic/WhatsApp Image 2026-04-25 at 12.03.01.jpeg') }}" width="100">
        <div class="ms-3 flex-grow-1">
            <h5>Vitamin Bulanan</h5>
            <p>Lorem ipsum dolor sit amet...</p>
        </div>
        <a href="CampaignFeed-Detail">Detail →</a>
    </div>
</div>
@endsection