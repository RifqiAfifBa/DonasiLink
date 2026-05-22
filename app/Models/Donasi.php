<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kampanye;
use App\Models\Donatur;

class Donasi extends Model
{
    protected $table = 'donasi';

    protected $fillable = [
        'kampanye_id', 'donatur_id', 'nama_donatur', 'email_donatur',
        'no_telepon', 'jumlah', 'metode_pembayaran', 'status',
    ];

    public function kampanye()
    {
        return $this->belongsTo(Kampanye::class);
    }

    public function donatur()
    {
        return $this->belongsTo(Donatur::class);
    }
}
