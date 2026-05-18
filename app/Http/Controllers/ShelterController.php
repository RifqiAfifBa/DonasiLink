<?php

namespace App\Http\Controllers;

use App\Models\Kampanye;
use App\Models\Penarikan;
use Illuminate\Http\Request;

class ShelterController extends Controller
{
    public function landingpage()
    {
        // Sementara shelter_id diambil dari session, nanti setelah auth shelter aktif
        $shelterId = session('shelter_id', 1);
        $kampanye = Kampanye::where('shelter_id', $shelterId)->latest()->get();

        return view('shelter.landingpage', compact('kampanye'));
    }

    public function formShelter()
    {
        return view('shelter.formShelter');
    }

    public function storeKampanye(Request $request)
    {
        $validated = $request->validate([
            'nama_hewan'      => 'required|string|max:100',
            'usia_hewan'      => 'required|string|max:50',
            'sedang_sakit'    => 'required|in:ya,tidak',
            'kebutuhan_hewan' => 'required|string|max:200',
            'deskripsi_hewan' => 'required|string',
            'target_donasi'   => 'required|numeric|min:10000',
            'image'           => 'nullable|image|max:2048',
        ]);

        $gambar = null;
        if ($request->hasFile('image')) {
            $gambar = $request->file('image')->store('kampanye', 'public');
        }

        Kampanye::create([
            'shelter_id'      => session('shelter_id', 1),
            'nama_hewan'      => $validated['nama_hewan'],
            'usia_hewan'      => $validated['usia_hewan'],
            'sedang_sakit'    => $validated['sedang_sakit'],
            'kebutuhan_hewan' => $validated['kebutuhan_hewan'],
            'deskripsi_hewan' => $validated['deskripsi_hewan'],
            'target_donasi'   => $validated['target_donasi'],
            'gambar'          => $gambar,
        ]);

        return redirect()->route('shelter.landingpage')->with('success', 'Kampanye berhasil dipublikasikan!');
    }

    public function widthdrawShelter()
    {
        $shelterId = session('shelter_id', 1);
        $kampanye = Kampanye::where('shelter_id', $shelterId)
            ->where('total_terkumpul', '>', 0)
            ->get();

        return view('shelter.widthdrawShelter', compact('kampanye'));
    }

    public function updateForm(Kampanye $kampanye)
    {
        return view('shelter.updateFormShelter', compact('kampanye'));
    }

    public function updateKampanye(Request $request, Kampanye $kampanye)
    {
        $validated = $request->validate([
            'nama_hewan'      => 'required|string|max:100',
            'usia_hewan'      => 'required|string|max:50',
            'sedang_sakit'    => 'required|in:ya,tidak',
            'kebutuhan_hewan' => 'required|string|max:200',
            'deskripsi_hewan' => 'required|string',
            'target_donasi'   => 'required|numeric|min:10000',
            'image'           => 'nullable|image|max:2048',
        ]);

        $data = [
            'nama_hewan'      => $validated['nama_hewan'],
            'usia_hewan'      => $validated['usia_hewan'],
            'sedang_sakit'    => $validated['sedang_sakit'],
            'kebutuhan_hewan' => $validated['kebutuhan_hewan'],
            'deskripsi_hewan' => $validated['deskripsi_hewan'],
            'target_donasi'   => $validated['target_donasi'],
        ];

        if ($request->hasFile('image')) {
            $data['gambar'] = $request->file('image')->store('kampanye', 'public');
        }

        $kampanye->update($data);

        return redirect()->route('shelter.landingpage')->with('success', 'Kampanye berhasil diperbarui.');
    }

    public function riwayatPenarikan()
    {
        $shelterId = session('shelter_id', 1);
        $riwayat = Penarikan::where('shelter_id', $shelterId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('shelter.UploadStruckShelter', compact('riwayat'));
    }

    public function storePenarikan(Request $request)
    {
        $request->validate([
            'bank' => 'required|string|max:50',
            'nomor_rekening' => 'required|string|max:50',
            'nama_rekening' => 'required|string|max:100',
            'total_penarikan' => 'required|numeric|min:10000',
            'keterangan' => 'required|string',
        ]);

        Penarikan::create([
            'shelter_id' => session('shelter_id', 1),
            'bank' => $request->bank,
            'nomor_rekening' => $request->nomor_rekening,
            'nama_rekening' => $request->nama_rekening,
            'total_penarikan' => $request->total_penarikan,
            'keterangan' => $request->keterangan,
            'status' => 'Diproses',
        ]);

        return redirect()->back()->with('success', 'Pengajuan penarikan dana berhasil dikirim!');
    }
}
