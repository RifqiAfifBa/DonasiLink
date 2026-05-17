@extends('layout.navbarShelter')
@section('content')

<style>
    body { font-family:'Inter',sans-serif; background: var(--bg-primary); color: var(--text-primary); }

    .lp-wrapper { max-width:1200px; margin:0 auto; padding:40px 24px; }

    /* Page Header */
    .lp-header {
        display:flex; align-items:center; justify-content:space-between;
        margin-bottom:36px; flex-wrap:wrap; gap:16px;
    }
    .lp-header-left h1 { font-size:28px; font-weight:800; color: var(--text-primary); margin:0 0 4px; }
    .lp-header-left p  { font-size:14px; color: var(--text-secondary); margin:0; }
    .btn-new-camp {
        display:inline-flex; align-items:center; gap:8px;
        background: var(--text-primary); color: var(--bg-secondary); padding:12px 24px; border-radius:30px;
        font-size:14px; font-weight:700; text-decoration:none; transition:all 0.25s;
        box-shadow: 0 4px 16px var(--shadow);
    }
    .btn-new-camp:hover { opacity: 0.9; transform:translateY(-1px); }

    /* Alert */
    .lp-alert {
        padding:14px 18px; border-radius:12px; font-size:14px; font-weight:500;
        display:flex; align-items:center; gap:10px; margin-bottom:24px;
    }
    .lp-alert.success { background:#f0fdf4; color:#166534; border:1px solid #bbf7d0; }

    /* Stats Row */
    .stats-row { display:grid; grid-template-columns:repeat(3,1fr); gap:20px; margin-bottom:36px; }
    .stat-card {
        background: var(--bg-secondary); border-radius:16px; padding:24px;
        border: 1px solid var(--border-color);
        box-shadow: 0 2px 12px var(--shadow); text-align:center;
    }
    .stat-card .s-val { font-size:30px; font-weight:800; color: var(--text-primary); margin:0 0 4px; }
    .stat-card .s-lbl { font-size:13px; color: var(--text-secondary); margin:0; }
    .stat-card .s-icon { font-size:28px; margin-bottom:10px; }

    /* Campaign Grid */
    .camp-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:22px; }
    .camp-card {
        background: var(--bg-secondary); border-radius:18px; overflow:hidden;
        border: 1px solid var(--border-color);
        box-shadow: 0 4px 18px var(--shadow); transition:all 0.3s;
        display:flex; flex-direction:column;
    }
    .camp-card:hover { transform:translateY(-4px); box-shadow: 0 14px 40px var(--shadow); }
    .camp-card-img { width:100%; height:180px; object-fit:cover; display:block; }
    .camp-card-img-ph {
        width:100%; height:180px; background:linear-gradient(135deg,#f3edf7,#e8d8f0);
        display:flex; align-items:center; justify-content:center; font-size:52px;
    }
    .camp-card-body { padding:18px; flex:1; display:flex; flex-direction:column; }
    .camp-name { font-size:17px; font-weight:700; color: var(--text-primary); margin-bottom:6px; }
    .camp-desc { font-size:13px; color: var(--text-secondary); line-height:1.6; margin-bottom:12px; flex:1; }
    .camp-raised {
        font-size:14px; font-weight:600; color: var(--accent-secondary); margin-bottom:12px;
        background: var(--bg-primary); border-radius:8px; padding:8px 12px; display:inline-block;
        border: 1px solid var(--border-color);
    }
    .camp-prog-bar { width:100%; height:7px; background: var(--bg-primary); border-radius:4px; overflow:hidden; margin-bottom:14px; }
    .camp-prog-fill { height:100%; background: linear-gradient(90deg, var(--accent-primary), var(--accent-secondary)); border-radius:4px; }
    .camp-actions { display:flex; gap:8px; }
    .btn-card-edit {
        flex:1; text-align:center; padding:10px;
        background: var(--bg-primary); color: var(--accent-secondary); border-radius:10px;
        font-size:13px; font-weight:600; text-decoration:none; transition:all 0.2s;
        border: 1px solid var(--border-color);
    }
    .btn-card-edit:hover { opacity: 0.8; }
    .btn-card-view {
        flex:1; text-align:center; padding:10px;
        background: var(--text-primary); color: var(--bg-secondary); border-radius:10px;
        font-size:13px; font-weight:600; text-decoration:none; transition:all 0.2s;
    }
    .btn-card-view:hover { opacity: 0.9; }

    /* Empty State */
    .empty-state {
        grid-column:1/-1; text-align:center; padding:80px 20px;
        background: var(--bg-secondary); border-radius:20px; border:2px dashed var(--border-color);
    }
    .empty-state .big-icon { font-size:64px; margin-bottom:16px; }
    .empty-state h3 { font-size:20px; font-weight:700; color: var(--text-primary); margin-bottom:8px; }
    .empty-state p { font-size:14px; color: var(--text-secondary); margin-bottom:24px; }

    @media(max-width:992px){ .camp-grid{grid-template-columns:repeat(2,1fr);} .stats-row{grid-template-columns:1fr;} }
    @media(max-width:576px){ .camp-grid{grid-template-columns:1fr;} .lp-wrapper{padding:24px 16px;} }
</style>

<div class="lp-wrapper">
    <!-- Header -->
    <div class="lp-header">
        <div class="lp-header-left">
            <h1>🏠 Dashboard Shelter</h1>
            <p>Kelola kampanye donasi hewan Anda di sini</p>
        </div>
        <a href="{{ route('shelter.form') }}" class="btn-new-camp">
            <i class="fas fa-plus"></i> Buat Kampanye Baru
        </a>
    </div>

    @if(session('success'))
        <div class="lp-alert success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Stats -->
    <div class="stats-row">
        <div class="stat-card">
            <div class="s-icon">📋</div>
            <div class="s-val">{{ $kampanye->count() }}</div>
            <div class="s-lbl">Total Kampanye</div>
        </div>
        <div class="stat-card">
            <div class="s-icon">💰</div>
            <div class="s-val">Rp {{ number_format($kampanye->sum('total_terkumpul'), 0, ',', '.') }}</div>
            <div class="s-lbl">Total Dana Terkumpul</div>
        </div>
        <div class="stat-card">
            <div class="s-icon">✅</div>
            <div class="s-val">{{ $kampanye->where('status','aktif')->count() }}</div>
            <div class="s-lbl">Kampanye Aktif</div>
        </div>
    </div>

    <!-- Campaign Grid -->
    <div class="camp-grid">
        @forelse($kampanye as $item)
        <div class="camp-card">
            @if($item->gambar)
                <img src="{{ Storage::url($item->gambar) }}" class="camp-card-img" alt="{{ $item->nama_hewan }}">
            @else
                <div class="camp-card-img-ph">🐾</div>
            @endif
            <div class="camp-card-body">
                <h3 class="camp-name">{{ $item->nama_hewan }}</h3>
                <p class="camp-desc">{{ Str::limit($item->deskripsi_hewan, 80) }}</p>
                <div class="camp-raised">💰 Rp {{ number_format($item->total_terkumpul, 0, ',', '.') }}</div>
                @php $pct = $item->target_donasi > 0 ? min(($item->total_terkumpul/$item->target_donasi)*100,100) : 0; @endphp
                <div class="camp-prog-bar"><div class="camp-prog-fill" style="width:{{ $pct }}%"></div></div>
                <div class="camp-actions">
                    <a href="{{ route('shelter.updateForm', $item->id) }}" class="btn-card-edit">
                        <i class="fas fa-edit me-1"></i>Edit
                    </a>
                    <a href="{{ route('kampanye.show', $item->id) }}" class="btn-card-view" target="_blank">
                        <i class="fas fa-eye me-1"></i>Lihat
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <div class="big-icon">🐾</div>
            <h3>Belum Ada Kampanye</h3>
            <p>Mulai bantu hewan dengan membuat kampanye donasi pertama Anda</p>
            <a href="{{ route('shelter.form') }}" class="btn-new-camp">
                <i class="fas fa-plus me-1"></i> Buat Kampanye Pertama
            </a>
        </div>
        @endforelse
    </div>
</div>

@endsection
