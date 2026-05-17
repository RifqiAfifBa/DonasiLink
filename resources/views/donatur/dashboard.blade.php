@extends('layout.navbarDonatur')
@section('content')

<style>
    /* Dashboard Container */
    .donatur-dashboard {
        max-width: 1200px;
        margin: 0 auto;
        padding: 32px 24px;
    }

    /* Welcome Header */
    .welcome-section {
        background: linear-gradient(135deg, #2b1b2f 0%, #4a2d54 50%, #3d2b42 100%);
        border-radius: 20px;
        padding: 36px 40px;
        margin-bottom: 28px;
        color: #fff;
        position: relative;
        overflow: hidden;
    }

    .welcome-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(204, 179, 209, 0.15) 0%, transparent 70%);
        border-radius: 50%;
    }

    .welcome-section::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: 20%;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(204, 179, 209, 0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .welcome-section h1 {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 6px;
        position: relative;
        z-index: 1;
    }

    .welcome-section p {
        font-size: 15px;
        color: rgba(255, 255, 255, 0.8);
        margin: 0;
        position: relative;
        z-index: 1;
    }

    .welcome-section .welcome-emoji {
        font-size: 32px;
        margin-right: 12px;
    }

    /* Stat Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 28px;
    }

    .stat-card {
        background: var(--bg-secondary);
        border-radius: 16px;
        padding: 24px;
        display: flex;
        align-items: center;
        gap: 18px;
        box-shadow: 0 2px 12px var(--shadow);
        transition: all 0.3s ease;
        border: 1px solid var(--border-color);
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(43, 27, 47, 0.1);
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        color: #fff;
        flex-shrink: 0;
    }

    .stat-icon.purple { background: linear-gradient(135deg, #7c3f8e, #9b59b6); }
    .stat-icon.pink   { background: linear-gradient(135deg, #c2688c, #e88aad); }
    .stat-icon.teal   { background: linear-gradient(135deg, #2a9d8f, #4ecdc4); }

    .stat-info h3 {
        font-size: 26px;
        font-weight: 800;
        color: var(--text-primary);
        margin: 0;
        line-height: 1;
    }

    .stat-info p {
        color: var(--text-secondary);
        opacity: 0.7;
        font-size: 13px;
        margin: 4px 0 0;
        font-weight: 500;
    }

    /* Content Grid */
    .content-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        margin-bottom: 28px;
    }

    /* Card Styles */
    .dashboard-card {
        background: var(--bg-secondary);
        border-radius: 16px;
        box-shadow: 0 2px 12px var(--shadow);
        overflow: hidden;
        border: 1px solid var(--border-color);
    }

    .card-header-custom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 24px 16px;
        border-bottom: 1px solid var(--border-color);
    }

    .card-header-custom h2 {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0;
    }

    .card-header-custom .view-all {
        font-size: 13px;
        color: var(--accent-secondary);
        text-decoration: none;
        font-weight: 600;
        transition: color 0.2s;
    }

    .card-header-custom .view-all:hover {
        color: #9b59b6;
    }

    .card-body-custom {
        padding: 16px 24px 24px;
    }

    /* Riwayat Donasi List */
    .donasi-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .donasi-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px 0;
        border-bottom: 1px solid var(--border-color);
        transition: background 0.2s;
    }

    .donasi-item:last-child {
        border-bottom: none;
    }

    .donasi-item:hover {
        background: var(--bg-primary);
        margin: 0 -24px;
        padding-left: 24px;
        padding-right: 24px;
    }

    .donasi-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .donasi-icon.berhasil {
        background: #d1fae5;
        color: #065f46;
    }

    .donasi-icon.pending {
        background: #fef3c7;
        color: #92400e;
    }

    .donasi-icon.gagal {
        background: #fee2e2;
        color: #991b1b;
    }

    .donasi-detail {
        flex: 1;
        min-width: 0;
    }

    .donasi-detail h4 {
        font-size: 14px;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .donasi-detail span {
        font-size: 12px;
        color: var(--text-secondary);
        opacity: 0.6;
    }

    .donasi-amount {
        text-align: right;
        flex-shrink: 0;
    }

    .donasi-amount strong {
        display: block;
        font-size: 14px;
        color: var(--text-primary);
        font-weight: 700;
    }

    .donasi-amount .status-badge {
        display: inline-block;
        padding: 2px 8px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        margin-top: 2px;
    }

    .status-badge.berhasil {
        background: #d1fae5;
        color: #065f46;
    }

    .status-badge.pending {
        background: #fef3c7;
        color: #92400e;
    }

    .status-badge.gagal {
        background: #fee2e2;
        color: #991b1b;
    }

    /* Kampanye Card */
    .kampanye-quick-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .kampanye-quick-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 12px;
        background: var(--bg-primary);
        border-radius: 12px;
        transition: all 0.25s ease;
        text-decoration: none;
        border: 1px solid var(--border-color);
    }

    .kampanye-quick-item:hover {
        background: var(--bg-secondary);
        border-color: var(--accent-primary);
        transform: translateX(4px);
    }

    .kampanye-quick-item img {
        width: 52px;
        height: 52px;
        border-radius: 10px;
        object-fit: cover;
        flex-shrink: 0;
    }

    .kampanye-quick-item .kq-info {
        flex: 1;
        min-width: 0;
    }

    .kampanye-quick-item .kq-info h4 {
        font-size: 14px;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0 0 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .kampanye-quick-item .kq-info .kq-progress {
        width: 100%;
        height: 6px;
        background: var(--bg-primary);
        border-radius: 3px;
        overflow: hidden;
    }

    .kampanye-quick-item .kq-info .kq-progress-bar {
        height: 100%;
        background: linear-gradient(90deg, var(--accent-primary), var(--accent-secondary));
        border-radius: 3px;
        transition: width 0.5s ease;
    }

    .kampanye-quick-item .kq-info .kq-meta {
        font-size: 11px;
        color: var(--text-secondary);
        opacity: 0.7;
        margin-top: 4px;
    }

    .kampanye-quick-item .kq-donate-btn {
        background: linear-gradient(135deg, #c9a6d4 0%, #d8b5e0 100%);
        color: #fff;
        border: none;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        white-space: nowrap;
    }

    .kampanye-quick-item .kq-donate-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(201, 166, 212, 0.4);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: var(--text-secondary);
        opacity: 0.6;
    }

    .empty-state i {
        font-size: 40px;
        color: var(--border-color);
        margin-bottom: 12px;
    }

    .empty-state p {
        font-size: 14px;
        margin: 0;
    }

    .empty-state a {
        display: inline-block;
        margin-top: 12px;
        background: linear-gradient(135deg, #c9a6d4 0%, #d8b5e0 100%);
        color: #fff;
        padding: 10px 24px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.25s;
    }

    .empty-state a:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(201, 166, 212, 0.35);
    }

    /* Responsive */
    @media (max-width: 992px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }

        .content-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 576px) {
        .donatur-dashboard {
            padding: 20px 16px;
        }

        .welcome-section {
            padding: 24px 20px;
        }

        .welcome-section h1 {
            font-size: 22px;
        }

        .stat-card {
            padding: 18px;
        }
    }
</style>

<div class="donatur-dashboard">
    {{-- Welcome Section --}}
    <div class="welcome-section">
        <h1><span class="welcome-emoji">👋</span>Halo, {{ $donatur->username }}!</h1>
        <p>Selamat datang kembali di dashboard donatur. Terima kasih atas kebaikan Anda!</p>
    </div>

    {{-- Stat Cards --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon purple">
                <i class="fas fa-hand-holding-heart"></i>
            </div>
            <div class="stat-info">
                <h3>Rp {{ number_format($totalDonasi, 0, ',', '.') }}</h3>
                <p>Total Donasi Anda</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon pink">
                <i class="fas fa-receipt"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $jumlahDonasi }}</h3>
                <p>Jumlah Donasi</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon teal">
                <i class="fas fa-paw"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $kampanyeDidonasi }}</h3>
                <p>Kampanye Didukung</p>
            </div>
        </div>
    </div>

    {{-- Content Grid --}}
    <div class="content-grid">
        {{-- Riwayat Donasi --}}
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h2><i class="fas fa-history me-2"></i>Riwayat Donasi</h2>
            </div>
            <div class="card-body-custom">
                @if($riwayatDonasi->count() > 0)
                <ul class="donasi-list">
                    @foreach($riwayatDonasi->take(5) as $donasi)
                    <li class="donasi-item">
                        <div class="donasi-icon {{ $donasi->status }}">
                            @if($donasi->status === 'berhasil')
                                <i class="fas fa-check"></i>
                            @elseif($donasi->status === 'pending')
                                <i class="fas fa-clock"></i>
                            @else
                                <i class="fas fa-times"></i>
                            @endif
                        </div>
                        <div class="donasi-detail">
                            <h4>{{ $donasi->kampanye->nama_hewan ?? 'Kampanye' }}</h4>
                            <span>{{ $donasi->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="donasi-amount">
                            <strong>Rp {{ number_format($donasi->jumlah, 0, ',', '.') }}</strong>
                            <span class="status-badge {{ $donasi->status }}">{{ ucfirst($donasi->status) }}</span>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @else
                <div class="empty-state">
                    <i class="fas fa-inbox d-block"></i>
                    <p>Belum ada riwayat donasi</p>
                    <a href="{{ route('kampanye.index') }}">Mulai Berdonasi</a>
                </div>
                @endif
            </div>
        </div>

        {{-- Kampanye Aktif --}}
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h2><i class="fas fa-fire me-2" style="color: #e76f51;"></i>Kampanye Aktif</h2>
                <a href="{{ route('kampanye.index') }}" class="view-all">Lihat Semua →</a>
            </div>
            <div class="card-body-custom">
                @if($kampanyeAktif->count() > 0)
                <div class="kampanye-quick-list">
                    @foreach($kampanyeAktif as $item)
                    <div class="kampanye-quick-item">
                        @if($item->gambar)
                            <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->nama_hewan }}">
                        @else
                            <div style="width:52px;height:52px;border-radius:10px;background:linear-gradient(135deg,#c9a6d4,#d8b5e0);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="fas fa-paw" style="color:#fff;font-size:20px;"></i>
                            </div>
                        @endif
                        <div class="kq-info">
                            <h4>{{ $item->nama_hewan }}</h4>
                            @php
                                $percent = $item->target_donasi > 0 ? min(($item->total_terkumpul / $item->target_donasi) * 100, 100) : 0;
                            @endphp
                            <div class="kq-progress">
                                <div class="kq-progress-bar" style="width: {{ $percent }}%"></div>
                            </div>
                            <div class="kq-meta">
                                Rp {{ number_format($item->total_terkumpul, 0, ',', '.') }}
                                / Rp {{ number_format($item->target_donasi, 0, ',', '.') }}
                            </div>
                        </div>
                        <a href="{{ route('checkout.show', $item->id) }}" class="kq-donate-btn">
                            <i class="fas fa-heart me-1"></i>Donasi
                        </a>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="empty-state">
                    <i class="fas fa-paw d-block"></i>
                    <p>Belum ada kampanye aktif</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
