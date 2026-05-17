@extends('layout.navbarAdmin')
@section('page-title', 'Manajemen Shelter')
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
    .shelter-avatar {
        width: 38px; height: 38px;
        border-radius: 10px;
        background: #CCB3D1;
        display: flex; align-items: center; justify-content: center;
        color: #2b1b2f;
        font-weight: 700;
        font-size: 15px;
    }
</style>

<div class="admin-table-card">
    <table class="table table-hover mb-0">
        <thead>
            <tr>
                <th>#</th>
                <th>Shelter</th>
                <th>Username</th>
                <th>Lokasi</th>
                <th>Target Donasi</th>
                <th>Terkumpul</th>
                <th>Kampanye</th>
            </tr>
        </thead>
        <tbody>
            @forelse($shelters as $i => $shelter)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>
                    <div class="d-flex align-items-center gap-3">
                        <div class="shelter-avatar">{{ strtoupper(substr($shelter->Nama_shelter, 0, 1)) }}</div>
                        <strong>{{ $shelter->Nama_shelter }}</strong>
                    </div>
                </td>
                <td>{{ $shelter->username ?? '-' }}</td>
                <td>{{ $shelter->Lokasi }}</td>
                <td>Rp {{ number_format($shelter->target_donasi, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($shelter->terkumpul, 0, ',', '.') }}</td>
                <td>{{ $shelter->kampanye->count() }} kampanye</td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center text-muted py-5">Belum ada shelter terdaftar.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
