@extends('layout.navbarShelter')

@section('content')

<div class="shelter-page-wrapper">

    @if(session('success'))
    <div class="alert alert-success" style="margin: 20px auto; max-width: 1000px;">
        {{ session('success') }}
    </div>
    @endif


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
                <h2>Formulir Penarikan Dana</h2>
                <button class="shelter-modal-close" id="closeModal">&times;</button>
            </div>

            <!-- Modal Body - Form -->
            <div class="shelter-modal-body">
                <form id="uploadBuktiForm" class="shelter-form" action="{{ route('shelter.storePenarikan') }}" method="POST">
                    @csrf

                    <!-- Form Fields -->
                    <div class="shelter-form-fields">
                        <div class="shelter-form-group">
                            <label>Bank Tujuan</label>
                            <select name="bank" class="shelter-input" required style="width: 100%; padding: 12px; border: 1px solid var(--border-color, #ccc); border-radius: 8px; background: var(--bg-secondary, #fff); color: var(--text-primary);">
                                <option value="" disabled selected>Pilih Bank</option>
                                <option value="BCA">BCA</option>
                                <option value="Mandiri">Mandiri</option>
                                <option value="BNI">BNI</option>
                                <option value="BRI">BRI</option>
                            </select>
                        </div>

                        <div class="shelter-form-group">
                            <label>Nomor Rekening</label>
                            <input type="text" name="nomor_rekening" placeholder="Contoh: 1234567890" class="shelter-input" required>
                        </div>

                        <div class="shelter-form-group">
                            <label>Nama Pemilik Rekening</label>
                            <input type="text" name="nama_rekening" placeholder="Contoh: John Doe" class="shelter-input" required>
                        </div>

                        <div class="shelter-form-group">
                            <label>Total Penarikan (Rp)</label>
                            <input type="text" name="total_penarikan" placeholder="Contoh: 500000" class="shelter-input" required>
                        </div>

                        <div class="shelter-form-group">
                            <label>Keterangan Penarikan</label>
                            <textarea name="keterangan" placeholder="Jelaskan tujuan penarikan dana ini..." rows="3" class="shelter-input" required></textarea>
                        </div>
                    </div>

                    <!-- Modal Actions -->
                    <div class="shelter-modal-actions">
                        <button type="button" class="shelter-btn-cancel" id="cancelBtn">Batal</button>
                        <button type="submit" class="shelter-btn-submit">Ajukan Penarikan</button>
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
</script>

@endsection
