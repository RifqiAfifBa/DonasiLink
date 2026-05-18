@extends('layout.navbarShelter')

@section('content')

<div class="shelter-page-wrapper">


    <!-- Withdrawal List -->
    <div class="shelter-list-wrapper">
        <div class="shelter-withdrawal-list">

            @forelse($kampanye as $item)
            <div class="shelter-withdrawal-item">
                <div class="shelter-item-content">
                    @if($item->gambar)
                        <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->nama_hewan }}" class="shelter-item-image">
                    @else
                        <img src="{{ asset('Asset/Pic/kucing.jpeg') }}" alt="{{ $item->nama_hewan }}" class="shelter-item-image">
                    @endif
                    <div class="shelter-item-info">
                        <h3 class="shelter-item-title">{{ $item->nama_hewan }}</h3>
                        <p class="shelter-item-desc">{{ Str::limit($item->deskripsi_hewan, 80) }}</p>
                    </div>
                    <div class="shelter-item-price">Rp {{ number_format($item->total_terkumpul, 0, ',', '.') }}</div>
                </div>
                <a href="{{ route('shelter.uploadStruk') }}" class="shelter-withdraw-btn">Withdraw Now</a>
            </div>
            @empty
            <p class="text-muted p-4">Belum ada kampanye dengan dana terkumpul.</p>
            @endforelse

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
    const modal = document.getElementById('withdrawModal');
    const closeBtn = document.getElementById('closeModal');
    const cancelBtn = document.getElementById('cancelBtn');
    const withdrawBtns = document.querySelectorAll('.shelter-withdraw-btn');
    const uploadForm = document.getElementById('uploadBuktiForm');

    withdrawBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            modal.classList.add('shelter-modal-active');
            document.body.style.overflow = 'hidden';
        });
    });

    function closeModalFunc() {
        modal.classList.remove('shelter-modal-active');
        document.body.style.overflow = 'auto';
        uploadForm.reset();
    }

    closeBtn.addEventListener('click', closeModalFunc);
    cancelBtn.addEventListener('click', closeModalFunc);

    window.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModalFunc();
        }
    });

    uploadForm.addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Bukti pengeluaran berhasil dikirim!');
        closeModalFunc();
    });
</script>

@endsection
