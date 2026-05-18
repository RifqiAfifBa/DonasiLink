@extends('layout.navbarAdmin')

@section('page-title', 'Manajemen Penarikan Dana')

@section('content')
<div class="row">
    <div class="col-12">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0" style="background: var(--bg-secondary); border-radius: 12px; overflow: hidden;">
            <div class="card-header border-0 py-3" style="background: rgba(204, 179, 209, 0.1);">
                <h5 class="mb-0" style="color: var(--accent-secondary); font-weight: 600;">Daftar Pengajuan Penarikan</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" style="color: var(--text-primary); vertical-align: middle;">
                        <thead style="background: var(--bg-primary);">
                            <tr>
                                <th class="border-0 px-4 py-3" style="color: var(--text-secondary); font-weight: 600; font-size: 14px;">Tanggal</th>
                                <th class="border-0 px-4 py-3" style="color: var(--text-secondary); font-weight: 600; font-size: 14px;">Detail Shelter</th>
                                <th class="border-0 px-4 py-3" style="color: var(--text-secondary); font-weight: 600; font-size: 14px;">Rekening & Keterangan</th>
                                <th class="border-0 px-4 py-3" style="color: var(--text-secondary); font-weight: 600; font-size: 14px;">Nominal</th>
                                <th class="border-0 px-4 py-3 text-center" style="color: var(--text-secondary); font-weight: 600; font-size: 14px;">Status & Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($riwayat as $item)
                            <tr style="border-bottom: 1px solid var(--border-color, #e8e0ed);">
                                <td class="px-4 py-3">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-3">
                                    <div style="font-weight: 600;">{{ $item->shelter ? $item->shelter->nama_shelter : 'Shelter #'.$item->shelter_id }}</div>
                                    <div style="font-size: 12px; color: var(--text-secondary);">ID: {{ $item->shelter_id }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    <div style="font-weight: 600;">{{ $item->bank }} - {{ $item->nomor_rekening }}</div>
                                    <div style="font-size: 13px; color: var(--text-secondary);">a/n {{ $item->nama_rekening }}</div>
                                    <div style="font-size: 12px; margin-top: 4px; padding: 4px 8px; background: rgba(0,0,0,0.03); border-radius: 4px;">{{ $item->keterangan }}</div>
                                </td>
                                <td class="px-4 py-3" style="font-weight: 700; color: var(--accent-secondary);">
                                    Rp {{ number_format($item->total_penarikan, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @if($item->status == 'Diproses')
                                        <div class="d-flex justify-content-center gap-2">
                                            <form action="{{ route('admin.penarikan.accept', $item->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 fw-bold" title="Setujui Penarikan">
                                                    <i class="fas fa-check me-1"></i> Terima
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.penarikan.reject', $item->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3 fw-bold" title="Tolak Penarikan">
                                                    <i class="fas fa-times me-1"></i> Tolak
                                                </button>
                                            </form>
                                        </div>
                                    @elseif($item->status == 'Berhasil')
                                        <span class="badge rounded-pill bg-success px-3 py-2">Berhasil Disetujui</span>
                                    @else
                                        <span class="badge rounded-pill bg-danger px-3 py-2">Ditolak</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5" style="color: var(--text-secondary);">
                                    <i class="fas fa-inbox fa-3x mb-3" style="color: var(--border-color, #e8e0ed);"></i>
                                    <p>Belum ada pengajuan penarikan dana.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
