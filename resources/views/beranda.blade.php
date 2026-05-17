@extends('layout.navbarLogin')
@section('content')
<style>
    body { font-family:'Inter',sans-serif; background: var(--bg-primary); color: var(--text-primary); }

    /* ── HERO ── */
    .hero {
        background: var(--navbar-bg);
        padding: 72px 0 0;
        overflow: hidden;
        position: relative;
    }
    .hero-inner {
        max-width:1200px; margin:0 auto; padding:0 32px;
        display:grid; grid-template-columns:1fr 1fr; gap:48px; align-items:flex-end;
    }
    .hero-left { padding-bottom: 56px; }
    .hero-label {
        display:inline-flex; align-items:center; gap:6px;
        background:rgba(255,255,255,0.2); border-radius:30px;
        padding:5px 16px; font-size:12px; font-weight:600; color:var(--text-primary);
        margin-bottom:20px;
    }
    .hero-title {
        font-size:46px; font-weight:800; color:var(--text-primary); line-height:1.15;
        margin-bottom:18px; letter-spacing:-1px;
    }
    .hero-desc { font-size:16px; color:var(--text-secondary); line-height:1.75; margin-bottom:36px; max-width:480px; }
    .hero-cta { display:flex; gap:14px; flex-wrap:wrap; }
    .btn-cta-primary {
        background:var(--text-primary); color:var(--bg-secondary); padding:14px 32px; border-radius:30px;
        font-size:15px; font-weight:700; text-decoration:none; transition:all 0.25s;
        display:inline-flex; align-items:center; gap:8px;
    }
    .btn-cta-primary:hover { opacity: 0.9; transform:translateY(-1px); }
    .btn-cta-outline {
        background:rgba(255,255,255,0.2); color:var(--text-primary); border:2px solid var(--border-color);
        padding:13px 32px; border-radius:30px; font-size:15px; font-weight:600;
        text-decoration:none; transition:all 0.25s; display:inline-flex; align-items:center; gap:8px;
    }
    .btn-cta-outline:hover { background:rgba(255,255,255,0.4); }
    .hero-right {
        display:flex; align-items:flex-end; justify-content:center;
    }
    .hero-img {
        width:100%; max-width:460px; border-radius:20px 20px 0 0;
        object-fit:cover; height:420px; display:block;
        box-shadow: 0 -8px 40px rgba(43,27,47,0.15);
    }

    /* Stats Bar */
    .stats-bar {
        background:var(--text-primary); padding:28px 0;
    }
    .stats-bar-inner {
        max-width:1200px; margin:0 auto; padding:0 32px;
        display:grid; grid-template-columns:repeat(3,1fr); gap:20px;
    }
    .stat-item { text-align:center; }
    .stat-item h3 { font-size:32px; font-weight:800; color:var(--accent-primary); margin:0 0 4px; }
    .stat-item p  { font-size:13px; color:var(--text-secondary); opacity: 0.8; margin:0; }

    /* ── FEATURES ── */
    .features { background:var(--bg-secondary); padding:80px 0; }
    .features-inner { max-width:1200px; margin:0 auto; padding:0 32px; }
    .section-head { text-align:center; margin-bottom:48px; }
    .section-tag {
        display:inline-block; background:var(--bg-primary); color:var(--accent-secondary);
        font-size:12px; font-weight:700; padding:5px 16px; border-radius:30px; margin-bottom:12px;
        text-transform:uppercase; letter-spacing:0.5px;
    }
    .section-title { font-size:34px; font-weight:800; color:var(--text-primary); margin-bottom:10px; }
    .section-desc  { font-size:15px; color:var(--text-secondary); }
    .features-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:24px; }
    .feat-card {
        background:var(--bg-primary); border-radius:20px; padding:32px;
        border:1px solid var(--border-color); transition:all 0.3s;
    }
    .feat-card:hover { transform:translateY(-4px); box-shadow:0 12px 40px var(--shadow); }
    .feat-icon {
        width:56px; height:56px; border-radius:16px; margin-bottom:20px;
        display:flex; align-items:center; justify-content:center; font-size:24px;
        background:var(--accent-primary);
    }
    .feat-card h3 { font-size:18px; font-weight:700; color:var(--text-primary); margin-bottom:10px; }
    .feat-card p  { font-size:14px; color:var(--text-secondary); line-height:1.7; margin:0; }

    /* ── CAMPAIGNS ── */
    .campaigns { background:var(--bg-primary); padding:80px 0; }
    .campaigns-inner { max-width:1200px; margin:0 auto; padding:0 32px; }
    .camps-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:24px; margin-top:48px; }
    .camp-card {
        background:var(--bg-secondary); border-radius:20px; overflow:hidden;
        box-shadow:0 4px 20px var(--shadow);
        border:1px solid var(--border-color); transition:all 0.3s;
    }
    .camp-card:hover { transform:translateY(-5px); box-shadow:0 16px 48px var(--shadow); }
    .camp-img { width:100%; height:196px; object-fit:cover; display:block; }
    .camp-img-ph {
        width:100%; height:196px; background:linear-gradient(135deg, var(--bg-primary), var(--accent-primary));
        display:flex; align-items:center; justify-content:center; font-size:56px;
    }
    .camp-body { padding:20px; }
    .camp-shelter { font-size:12px; color:var(--accent-secondary); font-weight:600; margin-bottom:6px; }
    .camp-name  { font-size:17px; font-weight:700; color:var(--text-primary); margin-bottom:6px; }
    .camp-desc  { font-size:13px; color:var(--text-secondary); line-height:1.6; margin-bottom:14px; }
    .camp-status {
        display:inline-flex; align-items:center; gap:5px;
        font-size:11px; font-weight:700; padding:4px 12px; border-radius:30px; margin-bottom:14px;
    }
    .camp-status.sakit { background:#fce8ee; color:#c2688c; }
    .camp-status.sehat { background:#e8f5e9; color:#388e3c; }
    .prog-bar { width:100%; height:8px; background:var(--bg-primary); border-radius:4px; overflow:hidden; margin-bottom:8px; }
    .prog-fill { height:100%; background:linear-gradient(90deg,var(--accent-primary),var(--accent-secondary)); border-radius:4px; }
    .prog-info { display:flex; justify-content:space-between; font-size:12px; color:var(--text-secondary); opacity: 0.8; margin-bottom:16px; }
    .prog-info strong { color:var(--accent-secondary); }
    .btn-donate {
        display:block; width:100%; text-align:center; padding:12px;
        background:var(--accent-primary); color:var(--text-primary); border-radius:30px;
        font-size:14px; font-weight:700; text-decoration:none; transition:all 0.2s;
    }
    .btn-donate:hover { opacity: 0.9; transform:translateY(-1px); }
    .empty-camp { grid-column:1/-1; text-align:center; padding:60px 20px; color:var(--text-secondary); }
    .view-all-wrap { text-align:center; margin-top:40px; }
    .btn-view-all {
        display:inline-flex; align-items:center; gap:8px;
        background:var(--text-primary); color:var(--bg-secondary); padding:14px 36px; border-radius:30px;
        font-size:14px; font-weight:600; text-decoration:none; transition:all 0.2s;
    }
    .btn-view-all:hover { opacity: 0.9; transform:translateY(-1px); }

    @media(max-width:992px){
        .hero-inner,.features-grid,.camps-grid{grid-template-columns:1fr;}
        .hero-right{display:none;}
        .hero-title{font-size:34px;}
        .stats-bar-inner{grid-template-columns:1fr;}
    }
</style>

{{-- HERO --}}
<section class="hero">
    <div class="hero-inner">
        <div class="hero-left">
            <div class="hero-label">🐾 Platform Donasi Hewan</div>
            <h1 class="hero-title">Bantu Mereka<br>Menemukan<br>Kebahagiaan Kembali</h1>
            <p class="hero-desc">DonasiLink menghubungkan Anda dengan shelter hewan yang membutuhkan bantuan. Transparansi penuh, dampak nyata untuk hewan-hewan tercinta.</p>
            <div class="hero-cta">
                <a href="{{ route('kampanye.index') }}" class="btn-cta-primary">
                    ❤️ Donasi Sekarang
                </a>
                <a href="{{ route('impact-story') }}" class="btn-cta-outline">
                    📖 Impact Story
                </a>
            </div>
        </div>
        <div class="hero-right">
            <img src="{{ asset('Asset/Pic/kucing.jpeg') }}" class="hero-img" alt="Hewan yang membutuhkan">
        </div>
    </div>
</section>

{{-- STATS --}}
<div class="stats-bar">
    <div class="stats-bar-inner">
        <div class="stat-item"><h3>100+</h3><p>Hewan Terselamatkan</p></div>
        <div class="stat-item"><h3>50+</h3><p>Donatur Aktif</p></div>
        <div class="stat-item"><h3>10+</h3><p>Shelter Terverifikasi</p></div>
    </div>
</div>

{{-- FEATURES --}}
<section class="features">
    <div class="features-inner">
        <div class="section-head">
            <div class="section-tag">✨ Mengapa DonasiLink?</div>
            <h2 class="section-title">Platform yang Anda Percaya</h2>
            <p class="section-desc">Setiap donasi Anda tersalurkan dengan tepat dan transparan</p>
        </div>
        <div class="features-grid">
            <div class="feat-card">
                <div class="feat-icon">🛡️</div>
                <h3>100% Transparan</h3>
                <p>Setiap rupiah donasi Anda dapat dipantau secara real-time dengan laporan keuangan terbuka.</p>
            </div>
            <div class="feat-card">
                <div class="feat-icon">🐕</div>
                <h3>Untuk Hewan Nyata</h3>
                <p>Semua kampanye terverifikasi langsung dari shelter mitra kami. Hewan yang ditampilkan benar-benar membutuhkan.</p>
            </div>
            <div class="feat-card">
                <div class="feat-icon">📊</div>
                <h3>Pantau Dampak</h3>
                <p>Dapatkan update perkembangan hewan yang Anda donasikan dan lihat impact story dari donatur lain.</p>
            </div>
        </div>
    </div>
</section>

{{-- CAMPAIGNS --}}
<section class="campaigns">
    <div class="campaigns-inner">
        <div class="section-head">
            <div class="section-tag">🐾 Kampanye Terkini</div>
            <h2 class="section-title">Mereka Menunggu Bantuan Anda</h2>
            <p class="section-desc">Pilih kampanye dan mulai berdonasi hari ini</p>
        </div>
        <div class="camps-grid">
            @forelse($kampanye as $item)
            <div class="camp-card">
                @if($item->gambar)
                    <img src="{{ Storage::url($item->gambar) }}" class="camp-img" alt="{{ $item->nama_hewan }}">
                @else
                    <div class="camp-img-ph">🐾</div>
                @endif
                <div class="camp-body">
                    <p class="camp-shelter">🏠 {{ $item->shelter->nama_shelter ?? 'Shelter' }}</p>
                    <h3 class="camp-name">{{ $item->nama_hewan }}</h3>
                    <p class="camp-desc">{{ Str::limit($item->deskripsi_hewan, 80) }}</p>
                    @if($item->sedang_sakit === 'ya')
                        <span class="camp-status sakit">💊 Sedang Sakit</span>
                    @else
                        <span class="camp-status sehat">✅ Sehat</span>
                    @endif
                    @php $pct = $item->target_donasi > 0 ? min(($item->total_terkumpul/$item->target_donasi)*100,100) : 0; @endphp
                    <div class="prog-bar"><div class="prog-fill" style="width:{{ $pct }}%"></div></div>
                    <div class="prog-info">
                        <span>Terkumpul: <strong>Rp {{ number_format($item->total_terkumpul,0,',','.') }}</strong></span>
                        <span>{{ number_format($pct,0) }}%</span>
                    </div>
                    <a href="{{ route('kampanye.show', $item->id) }}" class="btn-donate">Donasi Sekarang</a>
                </div>
            </div>
            @empty
            <div class="empty-camp"><p style="font-size:48px;margin-bottom:12px">🐾</p><p>Belum ada kampanye aktif.</p></div>
            @endforelse
        </div>
        <div class="view-all-wrap">
            <a href="{{ route('kampanye.index') }}" class="btn-view-all">Lihat Semua Kampanye →</a>
        </div>
    </div>
</section>

@endsection
