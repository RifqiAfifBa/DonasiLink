<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    protected $fillable = [
        'donatur_id',
        'shelter_id',
        'admin_id',
        'type',
        'title',
        'message',
        'related_model',
        'related_id',
        'data',
        'read_at',
    ];

    protected $casts = [
        'data' => 'json',
        'read_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function donatur()
    {
        return $this->belongsTo(Donatur::class);
    }

    public function shelter()
    {
        return $this->belongsTo(Shelter::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function markAsRead()
    {
        $this->update(['read_at' => now()]);
    }

    public function isRead()
    {
        return !is_null($this->read_at);
    }
}
