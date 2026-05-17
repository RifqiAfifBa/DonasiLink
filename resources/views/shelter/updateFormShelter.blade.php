@extends('layout.navbarShelter')
@section('content')

<style>
    body { font-family:'Inter',sans-serif; background: var(--bg-primary); color: var(--text-primary); }

    .form-page { max-width:900px; margin:0 auto; padding:48px 24px; }

    .breadcrumb-nav { display:flex; align-items:center; gap:8px; margin-bottom:32px; font-size:13px; }
    .breadcrumb-nav a { color: var(--accent-secondary); text-decoration:none; font-weight:500; }
    .breadcrumb-nav a:hover { text-decoration:underline; }
    .breadcrumb-nav .sep { color: var(--text-secondary); opacity: 0.5; }
    .breadcrumb-nav .cur { color: var(--text-secondary); }

    .form-page-title { font-size:28px; font-weight:800; color: var(--text-primary); margin-bottom:6px; }
    .form-page-desc  { font-size:14px; color: var(--text-secondary); margin-bottom:36px; }

    .alert-err {
        padding:14px 18px; border-radius:12px; font-size:13px; font-weight:500;
        display:flex; align-items:flex-start; gap:10px; margin-bottom:24px;
        background:#fff1f2; color:#9f1239; border:1px solid #fecdd3;
    }
    .alert-err ul { margin:0; padding-left:16px; }

    .form-card {
        background: var(--bg-secondary); border-radius:20px; padding:36px;
        border: 1px solid var(--border-color);
        box-shadow: 0 4px 24px var(--shadow);
    }

    .field-section { margin-bottom:28px; }
    .field-section-label {
        font-size:11px; font-weight:700; color: var(--accent-secondary); text-transform:uppercase;
        letter-spacing:0.8px; margin-bottom:16px; padding-bottom:8px;
        border-bottom: 1px solid var(--border-color); display:flex; align-items:center; gap:8px;
    }

    /* Image Upload */
    .upload-zone {
        border: 2px dashed var(--border-color); border-radius:16px;
        background: var(--bg-primary); cursor:pointer; transition:all 0.2s; position:relative; overflow:hidden;
    }
    .upload-zone:hover { border-color: var(--accent-secondary); opacity: 0.9; }
    .upload-zone input[type="file"] {
        position:absolute; inset:0; opacity:0; cursor:pointer; z-index:2; width:100%; height:100%;
    }
    .upload-zone-inner {
        display:flex; flex-direction:column; align-items:center; justify-content:center;
        padding:32px 24px; text-align:center; pointer-events:none;
    }
    .upload-icon { font-size:40px; margin-bottom:10px; }
    .upload-zone h4 { font-size:14px; font-weight:700; color: var(--text-primary); margin-bottom:4px; }
    .upload-zone p  { font-size:12px; color: var(--text-secondary); opacity: 0.7; margin:0; }
    #img-preview {
        width:100%; height:240px; object-fit:cover;
        border-radius:14px; display:block;
    }
    .current-img {
        width:100%; height:240px; object-fit:cover; border-radius:14px; display:block;
    }
    .img-overlay {
        position:absolute; bottom:0; left:0; right:0; z-index:3; pointer-events:none;
        background:linear-gradient(to top, rgba(43,27,47,0.7) 0%, transparent 100%);
        padding:16px; border-radius:0 0 14px 14px;
    }
    .img-overlay-text { color:#fff; font-size:13px; font-weight:600; }
    .img-overlay-sub  { color:rgba(255,255,255,0.7); font-size:11px; margin-top:2px; }

    .field-row-2 { display:grid; grid-template-columns:1fr 1fr; gap:18px; }
    .field-group { margin-bottom:18px; }
    .field-label { display:block; font-size:13px; font-weight:600; color: var(--text-primary); margin-bottom:6px; }
    .field-label .req { color:#e74c3c; margin-left:3px; }
    .field-hint { font-size:11px; color: var(--text-secondary); opacity: 0.6; font-weight:400; margin-left:6px; }
    .field-input, .field-select, .field-textarea {
        width:100%; padding:13px 16px;
        border: 1.5px solid var(--border-color); border-radius:12px;
        font-size:14px; font-family:'Inter',sans-serif;
        color: var(--text-primary); background: var(--bg-primary);
        transition:all 0.2s; outline:none;
    }
    .field-input:focus, .field-select:focus, .field-textarea:focus {
        border-color: var(--accent-secondary); box-shadow: 0 0 0 3px rgba(155,89,182,0.1); background: var(--bg-secondary);
    }
    .field-input:hover, .field-select:hover, .field-textarea:hover { border-color:#c9a6d4; }
    .field-input::placeholder, .field-textarea::placeholder { color:#ccc; }
    .field-select {
        appearance:none;
        background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='%23c9a6d4'%3E%3Cpath fill-rule='evenodd' d='M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z' clip-rule='evenodd'/%3E%3C/svg%3E");
        background-repeat:no-repeat; background-position:right 14px center; background-size:18px; padding-right:40px;
    }
    .field-textarea { resize:vertical; min-height:120px; }
    .char-count { font-size:11px; color: var(--text-secondary); opacity: 0.6; text-align:right; margin-top:4px; }

    .money-wrap { position:relative; }
    .money-prefix {
        position:absolute; left:14px; top:50%; transform:translateY(-50%);
        color: var(--text-secondary); opacity: 0.6; font-size:14px; font-weight:600; pointer-events:none;
    }
    .money-wrap .field-input { padding-left:48px; }

    /* Health status */
    .status-options { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
    .status-opt input[type="radio"] { display:none; }
    .status-opt label {
        display:flex; align-items:center; gap:10px;
        border: 2px solid var(--border-color); border-radius:12px; padding:14px 18px;
        cursor:pointer; transition:all 0.2s; font-size:14px; font-weight:500; color: var(--text-secondary);
    }
    .status-opt label .opt-icon { font-size:22px; }
    .status-opt input[type="radio"]:checked + label { border-color: var(--accent-secondary); background: var(--bg-primary); color: var(--text-primary); font-weight:600; }
    .status-opt input[type="radio"]#status_sehat:checked + label { border-color:#22c55e; background: rgba(34, 197, 94, 0.1); color:#166534; }

    /* Actions */
    .form-actions { display:flex; gap:12px; margin-top:8px; }
    .btn-submit {
        flex:1; padding:16px; background: var(--text-primary); color: var(--bg-secondary);
        border:none; border-radius:12px; font-size:15px; font-weight:700;
        cursor:pointer; transition:all 0.25s;
    }
    .btn-submit:hover { opacity: 0.9; transform:translateY(-1px); }
    .btn-cancel {
        padding:16px 28px; background: var(--bg-secondary); color: var(--text-secondary);
        border: 1px solid var(--border-color);
        border-radius:12px; font-size:15px; font-weight:600;
        text-decoration:none; transition:all 0.2s; display:inline-flex; align-items:center;
    }
    .btn-cancel:hover { color: var(--accent-secondary); }

    @media(max-width:640px){ .field-row-2{grid-template-columns:1fr;} .form-card{padding:24px 18px;} }
</style>

<div class="form-page">
    <!-- Breadcrumb -->
    <nav class="breadcrumb-nav">
        <a href="{{ route('shelter.landingpage') }}"><i class="fas fa-home me-1"></i>Dashboard</a>
        <span class="sep">/</span>
        <span class="cur">Edit Kampanye</span>
    </nav>

    <h1 class="form-page-title">✏️ Edit Kampanye</h1>
    <p class="form-page-desc">Perbarui informasi kampanye untuk <strong>{{ $kampanye->nama_hewan }}</strong></p>

    @if($errors->any())
        <div class="alert-err">
            <i class="fas fa-exclamation-circle" style="margin-top:2px;flex-shrink:0"></i>
            <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="form-card">
        <form action="{{ route('shelter.updateKampanye', $kampanye->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- ── FOTO HEWAN ── --}}
            <div class="field-section">
                <div class="field-section-label"><i class="fas fa-image"></i>Foto Hewan</div>
                <div class="upload-zone" id="uploadZone">
                    <input type="file" name="image" id="imageInput" accept="image/*" onchange="previewImg(this)">

                    @if($kampanye->gambar)
                        {{-- Tampilkan foto saat ini --}}
                        <img src="{{ Storage::url($kampanye->gambar) }}" class="current-img" id="img-preview" alt="{{ $kampanye->nama_hewan }}">
                        <div class="img-overlay" id="imgOverlay">
                            <div class="img-overlay-text"><i class="fas fa-camera me-1"></i>Klik untuk ganti foto</div>
                            <div class="img-overlay-sub">Kosongkan jika tidak ingin mengganti foto</div>
                        </div>
                    @else
                        <img src="" id="img-preview" alt="Preview" style="display:none;width:100%;height:240px;object-fit:cover;border-radius:14px;">
                        <div class="upload-zone-inner" id="uploadPlaceholder">
                            <div class="upload-icon">🖼️</div>
                            <h4>Klik untuk upload foto baru</h4>
                            <p>Format: JPG, PNG, WEBP • Maks 2MB</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- ── INFO HEWAN ── --}}
            <div class="field-section">
                <div class="field-section-label"><i class="fas fa-paw"></i>Informasi Hewan</div>

                <div class="field-row-2">
                    <div class="field-group">
                        <label class="field-label" for="nama_hewan">Nama Hewan <span class="req">*</span></label>
                        <input type="text" id="nama_hewan" name="nama_hewan" class="field-input"
                            placeholder="cth: Milo, Buddy..." value="{{ old('nama_hewan', $kampanye->nama_hewan) }}" required>
                    </div>
                    <div class="field-group">
                        <label class="field-label" for="usia_hewan">Usia Hewan <span class="req">*</span></label>
                        <input type="text" id="usia_hewan" name="usia_hewan" class="field-input"
                            placeholder="cth: 2 tahun, 6 bulan..." value="{{ old('usia_hewan', $kampanye->usia_hewan) }}" required>
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label" for="kebutuhan_hewan">Kebutuhan Hewan <span class="req">*</span></label>
                    <input type="text" id="kebutuhan_hewan" name="kebutuhan_hewan" class="field-input"
                        placeholder="cth: Obat-obatan, Vaksin, Operasi..."
                        value="{{ old('kebutuhan_hewan', $kampanye->kebutuhan_hewan) }}" required>
                </div>

                <div class="field-group">
                    <label class="field-label">Kondisi Kesehatan <span class="req">*</span></label>
                    <div class="status-options">
                        <div class="status-opt">
                            <input type="radio" name="sedang_sakit" id="status_sakit" value="ya"
                                {{ old('sedang_sakit', $kampanye->sedang_sakit) == 'ya' ? 'checked' : '' }}>
                            <label for="status_sakit">
                                <span class="opt-icon">🤒</span>
                                <div>
                                    <div style="font-weight:600;color:#c2688c">Sedang Sakit</div>
                                    <div style="font-size:12px;color:#aaa">Butuh perawatan medis</div>
                                </div>
                            </label>
                        </div>
                        <div class="status-opt">
                            <input type="radio" name="sedang_sakit" id="status_sehat" value="tidak"
                                {{ old('sedang_sakit', $kampanye->sedang_sakit) == 'tidak' ? 'checked' : '' }}>
                            <label for="status_sehat">
                                <span class="opt-icon">😊</span>
                                <div>
                                    <div style="font-weight:600;color:#388e3c">Sehat</div>
                                    <div style="font-size:12px;color:#aaa">Kebutuhan dasar</div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label" for="deskripsi_hewan">
                        Deskripsi <span class="req">*</span>
                    </label>
                    <textarea id="deskripsi_hewan" name="deskripsi_hewan" class="field-textarea"
                        rows="5" required maxlength="1000" oninput="updateCharCount(this)">{{ old('deskripsi_hewan', $kampanye->deskripsi_hewan) }}</textarea>
                    <div class="char-count"><span id="charCount">0</span>/1000 karakter</div>
                </div>
            </div>

            {{-- ── TARGET DONASI ── --}}
            <div class="field-section">
                <div class="field-section-label"><i class="fas fa-bullseye"></i>Target Donasi</div>
                <div class="field-group">
                    <label class="field-label" for="target_donasi">Jumlah Target <span class="req">*</span></label>
                    <div class="money-wrap">
                        <span class="money-prefix">Rp</span>
                        <input type="number" id="target_donasi" name="target_donasi" class="field-input"
                            placeholder="500000" min="10000"
                            value="{{ old('target_donasi', $kampanye->target_donasi) }}" required>
                    </div>
                    @if($kampanye->total_terkumpul > 0)
                        <p style="font-size:12px;color:#7c3f8e;margin-top:6px;">
                            💰 Sudah terkumpul: <strong>Rp {{ number_format($kampanye->total_terkumpul, 0, ',', '.') }}</strong>
                        </p>
                    @endif
                </div>
            </div>

            {{-- ── ACTIONS ── --}}
            <div class="form-actions">
                <a href="{{ route('shelter.landingpage') }}" class="btn-cancel">
                    <i class="fas fa-arrow-left me-1"></i>Batal
                </a>
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save me-2"></i>Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewImg(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('img-preview');
            const placeholder = document.getElementById('uploadPlaceholder');
            const overlay = document.getElementById('imgOverlay');
            
            preview.src = e.target.result;
            preview.style.display = 'block';
            preview.style.width = '100%';
            preview.style.height = '240px';
            preview.style.objectFit = 'cover';
            preview.style.borderRadius = '14px';
            
            if (placeholder) placeholder.style.display = 'none';
            if (overlay) overlay.style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function updateCharCount(el) {
    document.getElementById('charCount').textContent = el.value.length;
}

document.addEventListener('DOMContentLoaded', function() {
    // Init char count
    const ta = document.getElementById('deskripsi_hewan');
    if (ta) document.getElementById('charCount').textContent = ta.value.length;
});
</script>

@endsection