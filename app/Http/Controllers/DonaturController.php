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

        // Riwayat donasi: utamakan donatur_id (linked saat checkout), fallback ke email match.
        $riwayatDonasi = Donasi::where(function ($q) use ($donatur) {
                $q->where('donatur_id', $donatur->id)
                  ->orWhere('email_donatur', $donatur->email);
            })
            ->with('kampanye')
            ->latest()
            ->get();

        // Statistik: hitung donasi pending/berhasil (tidak termasuk gagal).
        $valid = $riwayatDonasi->whereNotIn('status', ['gagal']);
        $totalDonasi      = $valid->sum('jumlah');
        $jumlahDonasi     = $valid->count();
        $kampanyeDidonasi = $valid->pluck('kampanye_id')->unique()->count();

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
