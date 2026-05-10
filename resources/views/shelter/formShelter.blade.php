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

    <!-- Form Container -->
    <div class="shelter-form-wrapper">
        <form action="#" method="POST" enctype="multipart/form-data" class="shelter-form">
            @csrf

            <!-- Image Upload Section -->
            <div class="shelter-upload-section">
                <div class="shelter-upload-box">
                    <input type="file" name="image" id="image" class="shelter-file-input" accept="image/*">
                    <div class="shelter-upload-content">
                        <svg class="shelter-upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="shelter-upload-text">Upload Image</span>
                    </div>
                </div>
            </div>

            <!-- Form Fields -->
            <div class="shelter-form-fields">
                <div class="shelter-form-group">
                    <input type="text" name="nama_hewan" placeholder="Nama Hewan" class="shelter-input" required>
                </div>

                <div class="shelter-form-group">
                    <input type="text" name="usia_hewan" placeholder="Usia Hewan" class="shelter-input" required>
                </div>

                <div class="shelter-form-group">
                    <select name="sedang_sakit" class="shelter-input" required>
                        <option value="">Sedang Sakit (Ya / Tidak)</option>
                        <option value="ya">Ya</option>
                        <option value="tidak">Tidak</option>
                    </select>
                </div>

                <div class="shelter-form-group">
                    <input type="text" name="kebutuhan_hewan" placeholder="Kebutuhan Hewan" class="shelter-input" required>
                </div>

                <div class="shelter-form-group">
                    <textarea name="deskripsi_hewan" placeholder="Deskripsi Hewan" rows="6" class="shelter-input" required></textarea>
                </div>
            </div>

            <!-- Saldo Section -->
            <div class="shelter-saldo-section">
                <button type="button" class="shelter-saldo-btn">Saldo Minimal</button>
                <button type="button" class="shelter-saldo-btn">Saldo Maksimal</button>
            </div>

            <!-- Action Buttons -->
            <div class="shelter-form-actions">
                <button type="submit" class="shelter-btn-primary">UPLOAD</button>
                <a href="#" class="shelter-btn-secondary">KEMBALI</a>
            </div>
        </form>
    </div>
</div>

@endsection