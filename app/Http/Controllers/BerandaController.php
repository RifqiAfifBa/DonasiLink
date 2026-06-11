<?php

namespace App\Http\Controllers;

use App\Models\Kampanye;

class BerandaController extends Controller
{
    public function index()
    {
        $kampanye = Kampanye::with('shelter')
            ->where('status', 'aktif')
            ->latest()
            ->take(3)
            ->get();

        return view('beranda', compact('kampanye'));
    }
}
