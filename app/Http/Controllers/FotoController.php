<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    /**
     * Tampilkan foto. Diutamakan dari database (foto.content) supaya tetap muncul
     * di lingkungan lain meski file fisiknya tidak ikut ter-clone, dengan fallback
     * ke disk publik untuk file lama yang belum bermigrasi.
     */
    public function show(string $path)
    {
        $foto = Foto::where('path', $path)->first();

        if ($foto) {
            return response($foto->content, 200)->header('Content-Type', $foto->mime_type);
        }

        if (Storage::disk('public')->exists($path)) {
            return response()->file(Storage::disk('public')->path($path));
        }

        abort(404);
    }
}
