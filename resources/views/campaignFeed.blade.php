@extends('layout.navbarUser')
@section('content')

<style>
    body { font-family: 'Inter', sans-serif; background: var(--bg-primary); color: var(--text-primary); }
    .feed-wrapper { max-width: 1200px; margin: 0 auto; padding: 48px 24px; }
    .feed-header { margin-bottom: 40px; }
    .feed-label {
        display: inline-flex; align-items: center; gap: 8px;
        background: rgba(201,166,212,0.15); border: 1px solid rgba(201,166,212,0.25);
        border-radius: 30px; padding: 5px 16px; color: #7c3f8e;
        font-size: 12px; font-weight: 600; margin-bottom: 12px;
    }
    .feed-header h1 { font-size: 34px; font-weight: 800; color: #1a0f1f; margin-bottom: 8px; }
    .feed-header p  { font-size: 15px; color: #888; }

    .feed-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }
    .camp-card {
        background: var(--bg-secondary); border-radius: 18px; overflow: hidden;
        border: 1px solid var(--border-color);
        box-shadow: 0 4px 20px var(--shadow);
        transition: all 0.3s; display: flex; flex-direction: column;
    }
    .camp-card:hover { transform: translateY(-6px); box-shadow: 0 16px 48px var(--shadow); }
    .camp-card-img  { width: 100%; height: 200px; object-fit: cover; display: block; }
    .camp-card-placeholder {
        width: 100%; height: 200px;
        background: linear-gradient(135deg, #f0e8f5, #e4d4f0);
        display: flex; align-items: center; justify-content: center; font-size: 60px;
    }
    .camp-card-body { padding: 22px; flex: 1; display: flex; flex-direction: column; }
    .camp-shelter { font-size: 12px; color: #9b59b6; font-weight: 600; margin-bottom: 8px; }
    .camp-title   { font-size: 18px; font-weight: 700; color: var(--text-primary); margin-bottom: 10px; }
    .camp-desc    { font-size: 13px; color: #888; line-height: 1.65; margin-bottom: 18px; flex: 1; }
    .camp-status  {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 11px; font-weight: 600; padding: 4px 10px;
        border-radius: 20px; margin-bottom: 14px;
    }
    .camp-status.sakit { background: #fff1f2; color: #be123c; }
    .camp-status.sehat { background: #f0fdf4; color: #166534; }
    .camp-progress-wrap { margin-bottom: 8px; }
    .camp-progress-bar { width: 100%; height: 7px; background: #f0e8f5; border-radius: 4px; overflow: hidden; }
    .camp-progress-fill { height: 100%; background: linear-gradient(90deg, #c9a6d4, #9b59b6); border-radius: 4px; transition: width 0.6s ease; }
    .camp-progress-info { display: flex; justify-content: space-between; font-size: 12px; color: #aaa; margin-top: 6px; margin-bottom: 16px; }
    .camp-progress-info strong { color: #9b59b6; font-weight: 700; }
    .btn-detail {
        display: block; width: 100%; text-align: center;
        padding: 12px; border-radius: 10px;
        background: linear-gradient(135deg, #c9a6d4 0%, #9b59b6 100%);
        color: #fff; font-size: 14px; font-weight: 600;
        text-decoration: none; transition: all 0.25s; margin-top: auto;
    }
    .btn-detail:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(155,89,182,0.3); color: #fff; }

    .empty-state { text-align: center; padding: 80px 20px; grid-column: 1/-1; }
    .empty-state i { font-size: 64px; color: #ddd; margin-bottom: 16px; display: block; }
    .empty-state p { color: #aaa; font-size: 16px; }

    @media (max-width: 992px) { .feed-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 576px) { .feed-grid { grid-template-columns: 1fr; } .feed-wrapper { padding: 32px 16px; } }
</style>

<div class="feed-wrapper">
    <div class="feed-header">
        <div class="feed-label"><i class="fas fa-paw me-1"></i>Semua Kampanye</div>
        <h1>Kampanye Donasi Aktif</h1>
        <p>Temukan hewan yang membutuhkan bantuan Anda dan mulai berdonasi</p>
    </div>

    <div class="feed-grid">
        @forelse($kampanye as $item)
        <div class="camp-card">
            @if($item->gambar)
                <img src="{{ Storage::url($item->gambar) }}" class="camp-card-img" alt="{{ $item->nama_hewan }}">
            @else
                <div class="camp-card-placeholder">🐾</div>
            @endif
            <div class="camp-card-body">
                <p class="camp-shelter">
                    <i class="fas fa-home me-1"></i>{{ $item->shelter->nama_shelter ?? 'Shelter' }}
                </p>
                <h3 class="camp-title">{{ $item->nama_hewan }}</h3>
                <p class="camp-desc">{{ Str::limit($item->deskripsi_hewan, 90) }}</p>

                @if($item->sedang_sakit === 'ya')
                    <span class="camp-status sakit"><i class="fas fa-heartbeat"></i>Sedang Sakit</span>
                @else
                    <span class="camp-status sehat"><i class="fas fa-check-circle"></i>Sehat</span>
                @endif

                @php $pct = $item->target_donasi > 0 ? min(($item->total_terkumpul/$item->target_donasi)*100, 100) : 0; @endphp
                <div class="camp-progress-wrap">
                    <div class="camp-progress-bar">
                        <div class="camp-progress-fill" style="width:{{ $pct }}%"></div>
                    </div>
                    <div class="camp-progress-info">
                        <span>Terkumpul: <strong>Rp {{ number_format($item->total_terkumpul, 0, ',', '.') }}</strong></span>
                        <span>{{ number_format($pct, 0) }}%</span>
                    </div>
                </div>

                <a href="{{ route('kampanye.show', $item->id) }}" class="btn-detail">
                    <i class="fas fa-heart me-1"></i>Donasi Sekarang
                </a>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <i class="fas fa-paw"></i>
            <p>Belum ada kampanye aktif saat ini.</p>
        </div>
        @endforelse
    </div>
</div>

@endsection
