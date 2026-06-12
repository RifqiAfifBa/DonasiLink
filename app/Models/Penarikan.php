<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penarikan extends Model
{
    protected $table = 'penarikan';

    protected $fillable = [
        'shelter_id',
        'kampanye_id',
        'bank',
        'nomor_rekening',
        'nama_rekening',
        'total_penarikan',
        'keterangan',
        'kategori_pengeluaran',
        'bukti_pengeluaran',
        'deskripsi_penggunaan',
        'status',
        'tanggal_disetujui',
        'tanggal_selesai',
    ];

    public static array $kategoriList = ['Medis', 'Pakan', 'Operasional'];

    protected $casts = [
        'tanggal_disetujui' => 'datetime',
        'tanggal_selesai'   => 'datetime',
        'total_penarikan'   => 'decimal:2',
    ];

    public function shelter()
    {
        return $this->belongsTo(Shelter::class);
    }

    public function kampanye()
    {
        return $this->belongsTo(Kampanye::class);
    }

    public function isPending(): bool
    {
        return $this->status === 'Diproses';
    }

    public function isApproved(): bool
    {
        return $this->status === 'Berhasil' && empty($this->bukti_pengeluaran);
    }

    public function isCompleted(): bool
    {
        return $this->status === 'Berhasil' && !empty($this->bukti_pengeluaran);
    }

    public function isRejected(): bool
    {
        return $this->status === 'Gagal';
    }

    public function statusLabel(): string
    {
        return match (true) {
            $this->isPending()   => 'Diproses',
            $this->isApproved()  => 'Disetujui',
            $this->isCompleted() => 'Selesai',
            $this->isRejected()  => 'Ditolak',
            default              => $this->status,
        };
    }
}
