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
                    <button class="btn-custom me-3">Quick Donate</button>
                    <button class="btn-custom">Impact Story</button>
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

<!-- LIST -->
<div class="container mb-5 justify-content-center d-flex flex-column align-items-center">

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