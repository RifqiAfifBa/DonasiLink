<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Donasi;

class Donatur extends Authenticatable
{
    protected $table = 'donatur';

    protected $fillable = ['username', 'email', 'password', 'no_telepon'];

    protected $hidden = ['password'];

    public function donasi()
    {
        return $this->hasMany(Donasi::class, 'email_donatur', 'email');
    }
}
