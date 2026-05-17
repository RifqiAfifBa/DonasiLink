@extends('layout.navbarAdmin')
@section('page-title', 'Manajemen Donasi')
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
    .badge-berhasil { background: #d1fae5; color: #065f46; }
    .badge-pending  { background: #fef3c7; color: #92400e; }
    .badge-gagal    { background: #fee2e2; color: #991b1b; }
</style>

<div class="admin-table-card">
    <table class="table table-hover mb-0">
        <thead>
            <tr>
                <th>#</th>
                <th>Donatur</th>
                <th>Kampanye</th>
                <th>Jumlah</th>
                <th>Metode</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($donasi as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>
                    <strong>{{ $item->nama_donatur }}</strong>
                    <br><small class="text-muted">{{ $item->email_donatur }}</small>
                </td>
                <td>{{ $item->kampanye->nama_hewan ?? '-' }}</td>
                <td><strong>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</strong></td>
                <td>{{ str_replace('_', ' ', ucfirst($item->metode_pembayaran)) }}</td>
                <td>
                    <span class="badge-status badge-{{ $item->status }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </td>
                <td>{{ $item->created_at->format('d M Y') }}</td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center text-muted py-5">Belum ada data donasi.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
