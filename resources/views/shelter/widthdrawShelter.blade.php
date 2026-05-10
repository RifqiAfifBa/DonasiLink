@extends('layout.navbarShelter')

@section('content')

<div class="shelter-page-wrapper">
    <!-- Header -->
    <div class="shelter-header">
        <div class="shelter-header-content">
            <span class="shelter-logo">$ DonasiLink</span>
            <div class="shelter-nav">
                <a href="#" class="shelter-nav-link">Dashboard</a>
                <a href="#" class="shelter-nav-link">Withdrawal Tracking</a>
            </div>
        </div>
    </div>

    <!-- Withdrawal List -->
    <div class="shelter-list-wrapper">
        <div class="shelter-withdrawal-list">
            <!-- Item 1 -->
            <div class="shelter-withdrawal-item">
                <div class="shelter-item-content">
                    <img src="{{ asset('Asset/Pic/meerkat.jpg') }}" alt="Pakan Sehat" class="shelter-item-image">
                    <div class="shelter-item-info">
                        <h3 class="shelter-item-title">Pakan Sehat</h3>
                        <p class="shelter-item-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
                    </div>
                    <div class="shelter-item-price">Rp40.000</div>
                </div>
                <button class="shelter-withdraw-btn">Withdraw Now</button>
            </div>

            <!-- Item 2 -->
            <div class="shelter-withdrawal-item">
                <div class="shelter-item-content">
                    <img src="{{ asset('Asset/Pic/meerkat.jpg') }}" alt="Pakan Sehat" class="shelter-item-image">
                    <div class="shelter-item-info">
                        <h3 class="shelter-item-title">Pakan Sehat</h3>
                        <p class="shelter-item-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
                    </div>
                    <div class="shelter-item-price">Rp40.000</div>
                </div>
                <button class="shelter-withdraw-btn">Withdraw Now</button>
            </div>

            <!-- Item 3 -->
            <div class="shelter-withdrawal-item">
                <div class="shelter-item-content">
                    <img src="{{ asset('Asset/Pic/meerkat.jpg') }}" alt="Pakan Sehat" class="shelter-item-image">
                    <div class="shelter-item-info">
                        <h3 class="shelter-item-title">Pakan Sehat</h3>
                        <p class="shelter-item-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
                    </div>
                    <div class="shelter-item-price">Rp40.000</div>
                </div>
                <button class="shelter-withdraw-btn">Withdraw Now</button>
            </div>

            <!-- Item 4 -->
            <div class="shelter-withdrawal-item">
                <div class="shelter-item-content">
                    <img src="{{ asset('Asset/Pic/meerkat.jpg') }}" alt="Pakan Sehat" class="shelter-item-image">
                    <div class="shelter-item-info">
                        <h3 class="shelter-item-title">Pakan Sehat</h3>
                        <p class="shelter-item-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
                    </div>
                    <div class="shelter-item-price">Rp40.000</div>
                </div>
                <button class="shelter-withdraw-btn">Withdraw Now</button>
            </div>

            <!-- Item 5 -->
            <div class="shelter-withdrawal-item">
                <div class="shelter-item-content">
                    <img src="{{ asset('Asset/Pic/meerkat.jpg') }}" alt="Pakan Sehat" class="shelter-item-image">
                    <div class="shelter-item-info">
                        <h3 class="shelter-item-title">Pakan Sehat</h3>
                        <p class="shelter-item-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
                    </div>
                    <div class="shelter-item-price">Rp40.000</div>
                </div>
                <button class="shelter-withdraw-btn">Withdraw Now</button>
            </div>
        </div>
    </div>
</div>

@endsection