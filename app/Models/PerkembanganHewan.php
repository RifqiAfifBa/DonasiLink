<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerkembanganHewan extends Model
{
    protected $table = 'perkembangan_hewan';

    protected $fillable = [
        'kampanye_id',
        'judul',
        'catatan',
        'jenis',
        'kondisi',
        'foto_sebelum',
        'foto_sesudah',
        'nama_dokter',
        'nama_klinik',
        'tanggal_update',
    ];

    protected $casts = [
        'tanggal_update' => 'date',
    ];

    public function kampanye()
    {
        return $this->belongsTo(Kampanye::class);
    }

    /**
     * Label warna berdasarkan kondisi hewan
     */
    public function kondisiColor(): string
    {
        return match ($this->kondisi) {
            'membaik'  => 'text-emerald-600 dark:text-emerald-300 bg-emerald-50 dark:bg-emerald-900/30',
            'stabil'   => 'text-blue-600 dark:text-blue-300 bg-blue-50 dark:bg-blue-900/30',
            'kritis'   => 'text-rose-600 dark:text-rose-300 bg-rose-50 dark:bg-rose-900/30',
            'sembuh'   => 'text-teal-600 dark:text-teal-300 bg-teal-50 dark:bg-teal-900/30',
            default    => 'text-ink-600 dark:text-ink-300 bg-ink-50 dark:bg-ink-900/30',
        };
    }

    /**
     * Icon berdasarkan jenis update
     */
    public function jenisIcon(): string
    {
        return match ($this->jenis) {
            'medis'     => 'fa-kit-medical',
            'pakan'     => 'fa-bowl-food',
            'perawatan' => 'fa-shower',
            default     => 'fa-notes-medical',
        };
    }

    /**
     * Label kondisi yang ramah dibaca
     */
    public function kondisiLabel(): string
    {
        return match ($this->kondisi) {
            'membaik' => 'Membaik',
            'stabil'  => 'Stabil',
            'kritis'  => 'Kritis',
            'sembuh'  => 'Sudah Sembuh',
            default   => '-',
        };
    }
}
