@extends('layout.navbarAdmin')
@section('page-title', 'Manajemen Kampanye')
@section('content')

<style>
    .admin-table-card {
        background: var(--bg-secondary);
        border-radius: 14px;
        box-shadow: 0 2px 8px var(--shadow);
        border: 1px solid var(--border-color);
        overflow: hidden;
    }
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
    .progress-bar-wrap {
        background: #f0ebf5;
        border-radius: 10px;
        height: 8px;
        width: 100px;
        overflow: hidden;
    }
    .progress-bar-fill {
        height: 100%;
        background: #7c3f8e;
        border-radius: 10px;
    }
</style>

<div class="admin-table-card">
    <table class="table table-hover mb-0">
        <thead>
            <tr>
                <th>#</th>
                <th>Hewan</th>
                <th>Shelter</th>
                <th>Target</th>
                <th>Progress</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kampanye as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>
                    <strong>{{ $item->nama_hewan }}</strong>
                    <br><small class="text-muted">{{ Str::limit($item->deskripsi_hewan, 50) }}</small>
                </td>
                <td>{{ $item->shelter->Nama_shelter ?? '-' }}</td>
                <td>Rp {{ number_format($item->target_donasi, 0, ',', '.') }}</td>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <div class="progress-bar-wrap">
                            <div class="progress-bar-fill" style="width: {{ $item->persentase() }}%"></div>
                        </div>
                        <small>{{ $item->persentase() }}%</small>
                    </div>
                    <small class="text-muted">Rp {{ number_format($item->total_terkumpul, 0, ',', '.') }}</small>
                </td>
                <td>
                    <span class="badge-status {{ $item->status === 'aktif' ? 'badge-aktif' : ($item->status === 'selesai' ? 'badge-selesai' : 'badge-nonaktif') }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center text-muted py-5">Belum ada kampanye.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
