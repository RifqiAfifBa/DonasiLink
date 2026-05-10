@extends('layout.navbarUser')
@section('content')

<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="admin-page-wrapper">
    <!-- Header Section -->
    <div class="admin-header">
        <div class="admin-header-content">
            <h1 class="admin-subtitle">ADMINISTRATIVE PANEL</h1>
            <h2 class="admin-title">Withdrawal Confirmation</h2>
        </div>
    </div>

    <!-- Main Content -->
    <div class="admin-container">
        <!-- Withdrawal Cards Grid -->
        <div class="admin-grid">
            <!-- Card 1 - Pending Approval -->
            <div class="admin-card">
                <div class="admin-card-badge admin-badge-pending">
                    <span class="admin-badge-dot"></span>
                    Pending Approval
                </div>

                <div class="admin-card-info">
                    <div class="admin-info-row">
                        <span class="admin-info-label">Shelter :</span>
                        <span class="admin-info-value">Friends Pet</span>
                    </div>
                    <div class="admin-info-row">
                        <span class="admin-info-label">Donatur :</span>
                        <span class="admin-info-value">Jaka Supriyanto</span>
                    </div>
                </div>

                <div class="admin-card-image">
                    <img src="{{ asset('Asset/Pic/WhatsApp Image 2026-04-25 at 12.02.13.jpeg') }}" alt="Animal">
                </div>

                <div class="admin-card-footer">
                    <span class="admin-card-amount">Rp65.000</span>
                </div>
            </div>

            <!-- Card 2 - Pending Approval -->
            <div class="admin-card">
                <div class="admin-card-badge admin-badge-pending">
                    <span class="admin-badge-dot"></span>
                    Pending Approval
                </div>

                <div class="admin-card-info">
                    <div class="admin-info-row">
                        <span class="admin-info-label">Shelter :</span>
                        <span class="admin-info-value">Friends Pet</span>
                    </div>
                    <div class="admin-info-row">
                        <span class="admin-info-label">Donatur :</span>
                        <span class="admin-info-value">Jaka Supriyanto</span>
                    </div>
                </div>

                <div class="admin-card-image">
                    <img src="{{ asset('Asset/Pic/WhatsApp Image 2026-04-25 at 12.02.13.jpeg') }}" alt="Animal">
                </div>

                <div class="admin-card-footer">
                    <span class="admin-card-amount">Rp65.000</span>
                </div>
            </div>

            <!-- Card 3 - Approval -->
            <div class="admin-card">
                <div class="admin-card-badge admin-badge-approval">
                    <span class="admin-badge-dot"></span>
                    Approval
                </div>

                <div class="admin-card-info">
                    <div class="admin-info-row">
                        <span class="admin-info-label">Shelter :</span>
                        <span class="admin-info-value">Friends Pet</span>
                    </div>
                    <div class="admin-info-row">
                        <span class="admin-info-label">Donatur :</span>
                        <span class="admin-info-value">Jaka Supriyanto</span>
                    </div>
                </div>

                <div class="admin-card-image">
                    <img src="{{ asset('Asset/Pic/WhatsApp Image 2026-04-25 at 12.02.13.jpeg') }}" alt="Animal">
                </div>

                <div class="admin-card-footer">
                    <span class="admin-card-amount">Rp65.000</span>
                </div>
            </div>

            <!-- Card 4 - Approval -->
            <div class="admin-card">
                <div class="admin-card-badge admin-badge-approval">
                    <span class="admin-badge-dot"></span>
                    Approval
                </div>

                <div class="admin-card-info">
                    <div class="admin-info-row">
                        <span class="admin-info-label">Shelter :</span>
                        <span class="admin-info-value">Friends Pet</span>
                    </div>
                    <div class="admin-info-row">
                        <span class="admin-info-label">Donatur :</span>
                        <span class="admin-info-value">Jaka Supriyanto</span>
                    </div>
                </div>

                <div class="admin-card-image">
                    <img src="{{ asset('Asset/Pic/WhatsApp Image 2026-04-25 at 12.02.13.jpeg') }}" alt="Animal">
                </div>

                <div class="admin-card-footer">
                    <span class="admin-card-amount">Rp65.000</span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection