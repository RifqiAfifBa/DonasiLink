<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kampanye;

class Donasi extends Model
{
    protected $table = 'donasi';

    protected $fillable = [
        'kampanye_id', 'nama_donatur', 'email_donatur',
        'no_telepon', 'jumlah', 'metode_pembayaran', 'status',
    ];

    public function kampanye()
    {
        return $this->belongsTo(Kampanye::class);
    }
}
