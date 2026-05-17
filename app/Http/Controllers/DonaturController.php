<?php

namespace App\Http\Controllers;

use App\Models\Donatur;
use App\Models\Donasi;
use App\Models\Kampanye;

class DonaturController extends Controller
{
    public function dashboard()
    {
        $donaturId = session('donatur_id');

        if (!$donaturId) {
            return redirect()->route('login')->withErrors(['email' => 'Silakan login terlebih dahulu.']);
        }

        $donatur = Donatur::findOrFail($donaturId);

        // Riwayat donasi berdasarkan email donatur
        $riwayatDonasi = Donasi::where('email_donatur', $donatur->email)
            ->with('kampanye')
            ->latest()
            ->get();

        // Statistik donatur
        $totalDonasi = $riwayatDonasi->where('status', 'berhasil')->sum('jumlah');
        $jumlahDonasi = $riwayatDonasi->where('status', 'berhasil')->count();
        $kampanyeDidonasi = $riwayatDonasi->where('status', 'berhasil')->pluck('kampanye_id')->unique()->count();

        // Kampanye aktif untuk quick donate
        $kampanyeAktif = Kampanye::where('status', 'aktif')
            ->with('shelter')
            ->latest()
            ->take(4)
            ->get();

        return view('donatur.dashboard', compact(
            'donatur',
            'riwayatDonasi',
            'totalDonasi',
            'jumlahDonasi',
            'kampanyeDidonasi',
            'kampanyeAktif'
        ));
    }
}
