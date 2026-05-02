@extends('layout.navbarUser')
@section('content')
<style>
    .content-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
        margin: 20px auto;
        width: 100%;
        box-sizing: border-box;
        overflow-x: hidden;
    }

    .card-custom {
        width: 100%;
        max-width: 600px;
        padding: 20px;
        box-sizing: border-box;
    }

    @media (max-width: 768px) {
        .content-wrapper {
            padding: 15px;
            margin: 15px auto;
        }

        .card-custom {
            padding: 15px;
        }
    }
</style>

<div class="content-wrapper">

    <div class="card-custom d-flex align-items-center mb-4">
        <img src="{{ asset('Asset/Pic/WhatsApp Image 2026-04-25 at 12.03.01.jpeg') }}" width="100">
        <div class="ms-3 flex-grow-1">
            <h5>Pakan Sehat</h5>
            <p>Lorem ipsum dolor sit amet...</p>
        </div>
        <a href="#">Detail →</a>
    </div>

    <div class="card-custom d-flex align-items-center mb-4">
        <img src="{{ asset('Asset/Pic/WhatsApp Image 2026-04-25 at 12.03.01.jpeg') }}" width="100">
        <div class="ms-3 flex-grow-1">
            <h5>Hamil Sehat</h5>
            <p>Lorem ipsum dolor sit amet...</p>
        </div>
        <a href="#">Detail →</a>
    </div>

    <div class="card-custom d-flex align-items-center">
        <img src="{{ asset('Asset/Pic/WhatsApp Image 2026-04-25 at 12.03.01.jpeg') }}" width="100">
        <div class="ms-3 flex-grow-1">
            <h5>Vitamin Bulanan</h5>
            <p>Lorem ipsum dolor sit amet...</p>
        </div>
        <a href="#">Detail →</a>
    </div>
</div>
@endsection