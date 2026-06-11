<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Kampanye;

class Shelter extends Authenticatable
{
    protected $table = 'shelter';

    protected $fillable = ['nama_shelter', 'lokasi', 'username', 'password'];

    protected $hidden = ['password'];

    public function kampanye()
    {
        return $this->hasMany(Kampanye::class);
    }
}
