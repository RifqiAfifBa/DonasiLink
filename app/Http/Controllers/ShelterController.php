<?php

namespace App\Http\Controllers;

use App\Models\Kampanye;
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
            'gambar'          => $gambar,
        ]);

        return redirect()->route('shelter.landingpage')->with('success', 'Kampanye berhasil ditambahkan!');
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
            'image'           => 'nullable|image|max:2048',
        ]);

        $data = [
            'nama_hewan'      => $validated['nama_hewan'],
            'usia_hewan'      => $validated['usia_hewan'],
            'sedang_sakit'    => $validated['sedang_sakit'],
            'kebutuhan_hewan' => $validated['kebutuhan_hewan'],
            'deskripsi_hewan' => $validated['deskripsi_hewan'],
        ];

        if ($request->hasFile('image')) {
            $data['gambar'] = $request->file('image')->store('kampanye', 'public');
        }

        $kampanye->update($data);

        return redirect()->route('shelter.landingpage')->with('success', 'Kampanye berhasil diperbarui.');
    }

    public function uploadStruk()
    {
        return view('shelter.UploadStruckShelter');
    }

    public function storeStruk(Request $request)
    {
        $request->validate([
            'bukti_pengeluaran' => 'required|image|max:2048',
            'total_pengeluaran' => 'required|string|max:50',
            'tanggal'           => 'required|string|max:20',
            'keterangan_pengeluaran' => 'required|string',
        ]);

        $request->file('bukti_pengeluaran')->store('struk', 'public');

        return redirect()->route('shelter.landingpage')->with('success', 'Bukti pengeluaran berhasil diupload.');
    }
}
