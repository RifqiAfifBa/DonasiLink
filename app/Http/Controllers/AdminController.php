<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shelter;
use App\Models\Donatur;
use App\Models\Kampanye;
use App\Models\Donasi;

class AdminController extends Controller
{
    private function checkAdmin()
    {
        return session('role') === 'admin';
    }

    public function dashboard()
    {
        if (!$this->checkAdmin()) return redirect()->route('login');

        return view('admin.dashboard', [
            'totalShelter'  => Shelter::count(),
            'totalDonatur'  => Donatur::count(),
            'totalKampanye' => Kampanye::count(),
            'totalDonasi'   => Donasi::count(),
            'shelters'      => Shelter::with('kampanye')->get(),
            'kampanye'      => Kampanye::with('shelter')->latest()->get(),
        ]);
    }

    public function shelters()
    {
        if (!$this->checkAdmin()) return redirect()->route('login');

        return view('admin.shelters', [
            'shelters' => Shelter::with('kampanye')->get(),
        ]);
    }

    public function kampanye()
    {
        if (!$this->checkAdmin()) return redirect()->route('login');

        return view('admin.kampanye', [
            'kampanye' => Kampanye::with('shelter')->latest()->get(),
        ]);
    }

    public function donasi()
    {
        if (!$this->checkAdmin()) return redirect()->route('login');

        return view('admin.donasi', [
            'donasi' => Donasi::with('kampanye')->latest()->get(),
        ]);
    }
}
