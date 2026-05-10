<?php

namespace App\Http\Controllers;

use App\Models\Kampanye;

class KampanyeController extends Controller
{
    public function index()
    {
        $kampanye = Kampanye::with('shelter')
            ->where('status', 'aktif')
            ->latest()
            ->get();

        return view('campaignFeed', compact('kampanye'));
    }

    public function show(Kampanye $kampanye)
    {
        return view('campaignFeed-Detail', compact('kampanye'));
    }
}
