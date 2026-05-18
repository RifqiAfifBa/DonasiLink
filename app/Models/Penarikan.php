<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penarikan extends Model
{
    protected $table = 'penarikan';

    protected $fillable = [
        'shelter_id',
        'bank',
        'nomor_rekening',
        'nama_rekening',
        'total_penarikan',
        'keterangan',
        'status'
    ];

    public function shelter()
    {
        return $this->belongsTo(Shelter::class);
    }
}
