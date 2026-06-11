<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Foto extends Model
{
    protected $table = 'foto';

    protected $fillable = [
        'path', 'mime_type', 'content',
    ];

    /**
     * Simpan file upload ke disk publik sekaligus ke tabel foto (sebagai isi biner),
     * supaya foto ikut tersimpan di database dan tetap tampil meski file di storage tidak ada.
     */
    public static function simpanDariUpload(UploadedFile $file, string $folder): string
    {
        $path = $file->store($folder, 'public');

        static::updateOrCreate(
            ['path' => $path],
            [
                'mime_type' => $file->getMimeType(),
                'content'   => file_get_contents($file->getRealPath()),
            ]
        );

        return $path;
    }
}
