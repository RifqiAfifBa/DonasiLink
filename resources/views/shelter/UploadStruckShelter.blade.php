@extends('layout.navbarShelter')

@section('content')

<div class="shelter-page-wrapper">
    <div class="shelter-form-wrapper" style="max-width: 1000px;">
        <div class="shelter-form-title">
            <h1>Riwayat Penarikan</h1>
            <p style="color: var(--text-secondary); margin-top: 8px;">Daftar riwayat penarikan dana kampanye Anda.</p>
        </div>
        
        <div class="table-responsive" style="margin-top: 30px;">
            <table class="table" style="color: var(--text-primary); border-collapse: separate; border-spacing: 0 10px;">
                <thead>
                    <tr>
                        <th style="border-bottom: none; color: var(--text-secondary); font-weight: 600; padding: 0 15px;">Tanggal</th>
                        <th style="border-bottom: none; color: var(--text-secondary); font-weight: 600; padding: 0 15px;">Keterangan</th>
                        <th style="border-bottom: none; color: var(--text-secondary); font-weight: 600; padding: 0 15px;">Rekening Tujuan</th>
                        <th style="border-bottom: none; color: var(--text-secondary); font-weight: 600; padding: 0 15px;">Jumlah</th>
                        <th style="border-bottom: none; color: var(--text-secondary); font-weight: 600; padding: 0 15px;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayat as $item)
                    <tr style="background: var(--bg-secondary); box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                        <td style="padding: 20px 15px; border-radius: 10px 0 0 10px; border: none;">{{ $item->created_at->format('d/m/Y') }}</td>
                        <td style="padding: 20px 15px; border: none;">{{ $item->keterangan }}</td>
                        <td style="padding: 20px 15px; border: none;">
                            <div style="font-weight: 600;">{{ $item->bank }}</div>
                            <div style="font-size: 12px; color: var(--text-secondary);">{{ $item->nomor_rekening }} a/n {{ $item->nama_rekening }}</div>
                        </td>
                        <td style="padding: 20px 15px; border: none; font-weight: 700; color: var(--accent-secondary);">Rp {{ number_format($item->total_penarikan, 0, ',', '.') }}</td>
                        <td style="padding: 20px 15px; border-radius: 0 10px 10px 0; border: none;">
                            @if($item->status == 'Berhasil')
                                <span style="background: rgba(40, 167, 69, 0.1); color: #28a745; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Berhasil</span>
                            @elseif($item->status == 'Gagal')
                                <span style="background: rgba(220, 53, 69, 0.1); color: #dc3545; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Gagal</span>
                            @else
                                <span style="background: rgba(255, 193, 7, 0.1); color: #ffc107; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Diproses</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 30px; color: var(--text-secondary);">Belum ada riwayat penarikan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection