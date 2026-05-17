@extends('layout.navbarUser')
@section('content')

<style>
    body { font-family: 'Inter', sans-serif; background: var(--bg-primary); color: var(--text-primary); }

    .detail-page { max-width: 1100px; margin: 0 auto; padding: 48px 24px; }

    /* Breadcrumb */
    .breadcrumb-nav { display: flex; align-items: center; gap: 8px; margin-bottom: 36px; font-size: 13px; }
    .breadcrumb-nav a { color: #9b59b6; text-decoration: none; font-weight: 500; }
    .breadcrumb-nav a:hover { text-decoration: underline; }
    .breadcrumb-nav .sep { color: #ccc; }
    .breadcrumb-nav .current { color: #888; }

    /* Main Grid */
    .detail-grid { display: grid; grid-template-columns: 1fr 400px; gap: 32px; align-items: start; }

    /* Left Column */
    .detail-img-wrap {
        border-radius: 20px; overflow: hidden;
        box-shadow: 0 8px 32px rgba(43,27,47,0.12); margin-bottom: 28px;
    }
    .detail-img-wrap img { width: 100%; height: 400px; object-fit: cover; display: block; }
    .detail-img-placeholder {
        width: 100%; height: 400px;
        background: linear-gradient(135deg, #f0e8f5, #e4d4f0);
        display: flex; align-items: center; justify-content: center; font-size: 96px;
    }

    .info-card {
        background: var(--bg-secondary); border-radius: 18px; padding: 28px;
        border: 1px solid var(--border-color);
        box-shadow: 0 2px 16px var(--shadow); margin-bottom: 20px;
    }
    .info-card h3 {
        font-size: 16px; font-weight: 700; color: var(--text-primary);
        margin-bottom: 18px; display: flex; align-items: center; gap: 8px;
    }
    .info-card h3 i { color: #9b59b6; }

    .animal-info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
    .animal-info-item { background: var(--bg-primary); border-radius: 12px; padding: 14px 16px; }
    .animal-info-item .label { font-size: 11px; font-weight: 600; color: #b8a0c5; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
    .animal-info-item .value { font-size: 14px; font-weight: 600; color: var(--text-primary); }
    .animal-info-item .value.sakit { color: #be123c; }
    .animal-info-item .value.sehat { color: #166534; }

    .desc-text { font-size: 15px; color: var(--text-secondary); line-height: 1.85; }

    /* Right Column - Sticky Donate Card */
    .donate-sticky { position: sticky; top: 88px; }
    .donate-card {
        background: var(--bg-secondary); border-radius: 20px; padding: 28px;
        border: 1px solid var(--border-color);
        box-shadow: 0 8px 32px var(--shadow);
    }
    .shelter-tag {
        display: inline-flex; align-items: center; gap: 6px;
        background: rgba(155,89,182,0.1); border-radius: 20px;
        padding: 5px 12px; color: #7c3f8e;
        font-size: 12px; font-weight: 600; margin-bottom: 12px;
    }
    .donate-title { font-size: 24px; font-weight: 800; color: var(--text-primary); margin-bottom: 20px; line-height: 1.2; }
    .status-badge {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; margin-bottom: 20px;
    }
    .status-badge.sakit { background: #fff1f2; color: #be123c; border: 1px solid #fecdd3; }
    .status-badge.sehat { background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; }

    .progress-section { margin-bottom: 24px; }
    .progress-numbers { display: flex; justify-content: space-between; margin-bottom: 10px; }
    .progress-collected { font-size: 22px; font-weight: 800; color: #9b59b6; }
    .progress-target  { font-size: 13px; color: #aaa; }
    .progress-bar-outer { width: 100%; height: 10px; background: #f0e8f5; border-radius: 5px; overflow: hidden; }
    .progress-bar-inner { height: 100%; background: linear-gradient(90deg, #c9a6d4, #9b59b6); border-radius: 5px; }
    .progress-meta { display: flex; justify-content: space-between; margin-top: 8px; font-size: 12px; color: #bbb; }
    .progress-meta strong { color: #9b59b6; }

    .btn-donate-now {
        display: block; width: 100%; text-align: center; padding: 16px;
        background: linear-gradient(135deg, #c9a6d4 0%, #9b59b6 100%);
        color: #fff; border-radius: 12px; font-size: 16px; font-weight: 700;
        text-decoration: none; transition: all 0.25s;
        box-shadow: 0 8px 24px rgba(155,89,182,0.3); margin-bottom: 12px;
    }
    .btn-donate-now:hover { transform: translateY(-2px); box-shadow: 0 14px 36px rgba(155,89,182,0.4); color: #fff; }
    .btn-back {
        display: block; width: 100%; text-align: center; padding: 13px;
        background: var(--bg-primary); color: var(--text-secondary); border-radius: 12px;
        font-size: 14px; font-weight: 600; text-decoration: none; transition: all 0.2s;
        border: 1px solid var(--border-color);
    }
    .btn-back:hover { opacity: 0.9; color: var(--accent-secondary); }

    .share-section { margin-top: 20px; padding-top: 20px; border-top: 1px solid #f0e8f5; }
    .share-label { font-size: 12px; color: #aaa; font-weight: 500; margin-bottom: 10px; }
    .share-info { font-size: 13px; color: #888; text-align: center; }

    @media (max-width: 992px) {
        .detail-grid { grid-template-columns: 1fr; }
        .donate-sticky { position: static; }
        .detail-img-wrap img, .detail-img-placeholder { height: 280px; }
    }
    @media (max-width: 576px) { .detail-page { padding: 24px 16px; } .animal-info-grid { grid-template-columns: 1fr; } }
</style>

<div class="detail-page">
    <!-- Breadcrumb -->
    <nav class="breadcrumb-nav">
        <a href="{{ route('beranda') }}"><i class="fas fa-home me-1"></i>Beranda</a>
        <span class="sep">/</span>
        <a href="{{ route('kampanye.index') }}">Kampanye</a>
        <span class="sep">/</span>
        <span class="current">{{ $kampanye->nama_hewan }}</span>
    </nav>

    <div class="detail-grid">
        <!-- Left -->
        <div class="detail-left">
            <div class="detail-img-wrap">
                @if($kampanye->gambar)
                    <img src="{{ Storage::url($kampanye->gambar) }}" alt="{{ $kampanye->nama_hewan }}">
                @else
                    <div class="detail-img-placeholder">🐾</div>
                @endif
            </div>

            <!-- Animal Info -->
            <div class="info-card">
                <h3><i class="fas fa-paw"></i>Informasi Hewan</h3>
                <div class="animal-info-grid">
                    <div class="animal-info-item">
                        <div class="label">Nama Hewan</div>
                        <div class="value">{{ $kampanye->nama_hewan }}</div>
                    </div>
                    <div class="animal-info-item">
                        <div class="label">Usia</div>
                        <div class="value">{{ $kampanye->usia_hewan }}</div>
                    </div>
                    <div class="animal-info-item">
                        <div class="label">Kondisi Kesehatan</div>
                        <div class="value {{ $kampanye->sedang_sakit === 'ya' ? 'sakit' : 'sehat' }}">
                            @if($kampanye->sedang_sakit === 'ya')
                                <i class="fas fa-heartbeat me-1"></i>Sedang Sakit
                            @else
                                <i class="fas fa-check-circle me-1"></i>Sehat
                            @endif
                        </div>
                    </div>
                    <div class="animal-info-item">
                        <div class="label">Shelter</div>
                        <div class="value">{{ $kampanye->shelter->nama_shelter ?? '-' }}</div>
                    </div>
                    <div class="animal-info-item" style="grid-column:1/-1">
                        <div class="label">Kebutuhan</div>
                        <div class="value">{{ $kampanye->kebutuhan_hewan }}</div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="info-card">
                <h3><i class="fas fa-align-left"></i>Tentang Kampanye</h3>
                <p class="desc-text">{{ $kampanye->deskripsi_hewan }}</p>
            </div>
        </div>

        <!-- Right - Sticky Donate -->
        <div class="detail-right">
            <div class="donate-sticky">
                <div class="donate-card">
                    <div class="shelter-tag">
                        <i class="fas fa-home"></i>{{ $kampanye->shelter->nama_shelter ?? 'Shelter' }}
                    </div>
                    <h2 class="donate-title">{{ $kampanye->nama_hewan }}</h2>

                    @if($kampanye->sedang_sakit === 'ya')
                        <span class="status-badge sakit"><i class="fas fa-heartbeat"></i>Sedang Membutuhkan Perawatan</span>
                    @else
                        <span class="status-badge sehat"><i class="fas fa-check-circle"></i>Dalam Kondisi Baik</span>
                    @endif

                    <div class="progress-section">
                        @php $pct = $kampanye->target_donasi > 0 ? min(($kampanye->total_terkumpul/$kampanye->target_donasi)*100, 100) : 0; @endphp
                        <div class="progress-numbers">
                            <span class="progress-collected">
                                Rp {{ number_format($kampanye->total_terkumpul, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="progress-bar-outer">
                            <div class="progress-bar-inner" style="width:{{ $pct }}%"></div>
                        </div>
                        <div class="progress-meta">
                            <span>Target: <strong>Rp {{ number_format($kampanye->target_donasi, 0, ',', '.') }}</strong></span>
                            <span><strong>{{ number_format($pct, 0) }}%</strong> tercapai</span>
                        </div>
                    </div>

                    <a href="{{ route('checkout.show', $kampanye->id) }}" class="btn-donate-now">
                        <i class="fas fa-heart me-2"></i>Donasi Sekarang
                    </a>
                    <a href="{{ route('kampanye.index') }}" class="btn-back">
                        <i class="fas fa-arrow-left me-1"></i>Kembali ke Daftar Kampanye
                    </a>

                    <div class="share-section">
                        <p class="share-info">
                            <i class="fas fa-shield-alt me-1" style="color:#9b59b6"></i>
                            Donasi Anda 100% transparan dan terverifikasi
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
