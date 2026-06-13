<?php

namespace App\Http\Controllers;

use App\Models\Kampanye;
use App\Helpers\ChartHelper;

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
        $kampanye->load(['shelter', 'penarikan' => function ($q) {
            $q->where('status', 'Berhasil')->orderBy('tanggal_disetujui', 'desc');
        }, 'perkembangan']);

        $totalDisetujui = $kampanye->penarikan->sum('total_penarikan');
        $totalTerpakai  = $kampanye->penarikan->whereNotNull('bukti_pengeluaran')->sum('total_penarikan');
        $sisaDana       = max(0, $kampanye->total_terkumpul - $totalDisetujui);

        // Chart data: fund distribution
        $fundDistributionData = ChartHelper::getCampaignFundDistribution($kampanye);

        return view('campaignFeed-Detail', compact('kampanye', 'totalDisetujui', 'totalTerpakai', 'sisaDana', 'fundDistributionData'));
    }
}
