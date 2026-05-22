<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Shelter;
use App\Models\Donasi;

class Kampanye extends Model
{
    protected $table = 'kampanye';

    protected $fillable = [
        'shelter_id', 'nama_hewan', 'usia_hewan', 'sedang_sakit',
        'kebutuhan_hewan', 'deskripsi_hewan', 'gambar',
        'target_donasi', 'total_terkumpul', 'status',
    ];

    public function shelter()
    {
        return $this->belongsTo(Shelter::class);
    }

    public function donasi()
    {
        return $this->hasMany(Donasi::class);
    }

    public function penarikan()
    {
        return $this->hasMany(Penarikan::class);
    }

    public function persentase(): int
    {
        if ($this->target_donasi <= 0) return 0;
        return (int) min(100, ($this->total_terkumpul / $this->target_donasi) * 100);
    }
}
