@extends('layout.navbarAdmin')
@section('page-title', 'Dashboard')
@section('content')

<style>
    .stat-card {
        background: var(--bg-secondary);
        border-radius: 14px;
        padding: 24px;
        display: flex;
        align-items: center;
        gap: 18px;
        box-shadow: 0 2px 8px var(--shadow);
        border: 1px solid var(--border-color);
        margin-bottom: 24px;
    }
    .stat-icon {
        width: 56px; height: 56px;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 22px;
        color: #fff;
        flex-shrink: 0;
    }
    .stat-icon.purple  { background: #7c3f8e; }
    .stat-icon.pink    { background: #c2688c; }
    .stat-icon.teal    { background: #2a9d8f; }
    .stat-icon.orange  { background: #e76f51; }
    .stat-info h3 { font-size: 28px; font-weight: 700; color: var(--text-primary); margin: 0; }
    .stat-info p  { color: var(--text-secondary); opacity: 0.7; font-size: 13px; margin: 2px 0 0; }

    .section-title { font-size: 16px; font-weight: 700; color: var(--text-primary); margin-bottom: 16px; }

    .admin-table-card {
        background: var(--bg-secondary);
        border-radius: 14px;
        box-shadow: 0 2px 8px var(--shadow);
        border: 1px solid var(--border-color);
        overflow: hidden;
        margin-bottom: 28px;
    }
    .admin-table-card table { margin: 0; }
    .admin-table-card thead th {
        background: var(--bg-primary);
        color: var(--text-primary);
        opacity: 0.8;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
        padding: 14px 18px;
    }
    .admin-table-card tbody td {
        padding: 13px 18px;
        font-size: 14px;
        color: var(--text-primary);
        border-color: var(--border-color);
        vertical-align: middle;
    }
    .admin-table-card tbody tr:hover { background: var(--bg-primary); }

    .badge-status {
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }
    .badge-aktif    { background: #d1fae5; color: #065f46; }
    .badge-selesai  { background: #dbeafe; color: #1e40af; }
    .badge-nonaktif { background: #fee2e2; color: #991b1b; }
</style>

{{-- Stat Cards --}}
<div class="row">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon purple"><i class="fas fa-home"></i></div>
            <div class="stat-info">
                <h3>{{ $totalShelter }}</h3>
                <p>Total Shelter</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon pink"><i class="fas fa-users"></i></div>
            <div class="stat-info">
                <h3>{{ $totalDonatur }}</h3>
                <p>Total Donatur</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon teal"><i class="fas fa-paw"></i></div>
            <div class="stat-info">
                <h3>{{ $totalKampanye }}</h3>
                <p>Total Kampanye</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon orange"><i class="fas fa-hand-holding-heart"></i></div>
            <div class="stat-info">
                <h3>{{ $totalDonasi }}</h3>
                <p>Total Donasi</p>
            </div>
        </div>
    </div>
</div>

{{-- Tabel Shelter --}}
<p class="section-title">Daftar Shelter</p>
<div class="admin-table-card">
    <table class="table table-hover mb-0">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Shelter</th>
                <th>Username</th>
                <th>Lokasi</th>
                <th>Kampanye</th>
            </tr>
        </thead>
        <tbody>
            @forelse($shelters as $i => $shelter)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td><strong>{{ $shelter->Nama_shelter }}</strong></td>
                <td>{{ $shelter->username ?? '-' }}</td>
                <td>{{ $shelter->Lokasi }}</td>
                <td>{{ $shelter->kampanye->count() }}</td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center text-muted py-4">Belum ada shelter terdaftar.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Tabel Kampanye --}}
<p class="section-title">Daftar Kampanye</p>
<div class="admin-table-card">
    <table class="table table-hover mb-0">
        <thead>
            <tr>
                <th>#</th>
                <th>Hewan</th>
                <th>Shelter</th>
                <th>Target</th>
                <th>Terkumpul</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kampanye as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td><strong>{{ $item->nama_hewan }}</strong></td>
                <td>{{ $item->shelter->Nama_shelter ?? '-' }}</td>
                <td>Rp {{ number_format($item->target_donasi, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($item->total_terkumpul, 0, ',', '.') }}</td>
                <td>
                    <span class="badge-status {{ $item->status === 'aktif' ? 'badge-aktif' : ($item->status === 'selesai' ? 'badge-selesai' : 'badge-nonaktif') }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center text-muted py-4">Belum ada kampanye.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
