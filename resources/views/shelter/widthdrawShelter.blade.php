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

    <!-- Modal Popup untuk Upload Bukti Pengeluaran -->
    <div id="withdrawModal" class="shelter-modal">
        <div class="shelter-modal-content">
            <!-- Modal Header -->
            <div class="shelter-modal-header">
                <h2>Upload Bukti Pengeluaran</h2>
                <button class="shelter-modal-close" id="closeModal">&times;</button>
            </div>

            <!-- Modal Body - Form -->
            <div class="shelter-modal-body">
                <form id="uploadBuktiForm" class="shelter-form">
                    @csrf

                    <!-- Image Upload Section -->
                    <div class="shelter-upload-section">
                        <div class="shelter-upload-box" onclick="document.getElementById('buktiImage').click()">
                            <input type="file" id="buktiImage" name="bukti_pengeluaran" class="shelter-file-input" accept="image/*">
                            <div class="shelter-upload-content">
                                <svg class="shelter-upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="shelter-upload-text">Upload Bukti</span>
                            </div>
                        </div>
                    </div>

                    <!-- Form Fields -->
                    <div class="shelter-form-fields">
                        <div class="shelter-form-group">
                            <label>Total Pengeluaran (Rp)</label>
                            <input type="text" name="total_pengeluaran" placeholder="Contoh: 500000" class="shelter-input" required>
                        </div>

                        <div class="shelter-form-group">
                            <label>Tanggal (DD/MM/YYYY)</label>
                            <input type="text" name="tanggal" placeholder="Contoh: 10/05/2026" class="shelter-input" required>
                        </div>

                        <div class="shelter-form-group">
                            <label>Keterangan Pengeluaran</label>
                            <textarea name="keterangan_pengeluaran" placeholder="Jelaskan detail pengeluaran..." rows="4" class="shelter-input" required></textarea>
                        </div>
                    </div>

                    <!-- Modal Actions -->
                    <div class="shelter-modal-actions">
                        <button type="button" class="shelter-btn-cancel" id="cancelBtn">Batal</button>
                        <button type="submit" class="shelter-btn-submit">Kirim Bukti</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Get modal elements
    const modal = document.getElementById('withdrawModal');
    const closeBtn = document.getElementById('closeModal');
    const cancelBtn = document.getElementById('cancelBtn');
    const withdrawBtns = document.querySelectorAll('.shelter-withdraw-btn');
    const uploadForm = document.getElementById('uploadBuktiForm');

    // Open modal when withdraw button is clicked
    withdrawBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            modal.classList.add('shelter-modal-active');
            document.body.style.overflow = 'hidden';
        });
    });

    // Close modal function
    function closeModalFunc() {
        modal.classList.remove('shelter-modal-active');
        document.body.style.overflow = 'auto';
        uploadForm.reset();
    }

    // Close modal events
    closeBtn.addEventListener('click', closeModalFunc);
    cancelBtn.addEventListener('click', closeModalFunc);

    // Close modal when clicking outside
    window.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModalFunc();
        }
    });

    // Handle form submission
    uploadForm.addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Bukti pengeluaran berhasil dikirim!');
        closeModalFunc();
    });
</script>

@endsection