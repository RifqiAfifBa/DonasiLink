<?php

namespace App\Http\Controllers;

use App\Models\Kampanye;
use App\Models\Penarikan;
use App\Models\Admin;
use App\Models\Foto;
use Illuminate\Http\Request;
use App\Services\NotificationService;
use App\Services\ActivityLogger;

class ShelterController extends Controller
{
    private function checkShelter()
    {
        if (!session('shelter_id')) {
            return redirect()->route('login')->withErrors(['email' => 'Silakan login sebagai shelter terlebih dahulu.']);
        }
        return null;
    }

    public function landingpage()
    {
        if ($redirect = $this->checkShelter()) return $redirect;
        $shelterId = session('shelter_id');
        $kampanye = Kampanye::where('shelter_id', $shelterId)->latest()->get();

        return view('shelter.landingpage', compact('kampanye'));
    }

    public function formShelter()
    {
        if ($redirect = $this->checkShelter()) return $redirect;
        return view('shelter.formShelter');
    }

    public function storeKampanye(Request $request)
    {
        if ($redirect = $this->checkShelter()) return $redirect;

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
            $gambar = Foto::simpanDariUpload($request->file('image'), 'kampanye');
        }

        $kampanye = Kampanye::create([
            'shelter_id'      => session('shelter_id'),
            'nama_hewan'      => $validated['nama_hewan'],
            'usia_hewan'      => $validated['usia_hewan'],
            'sedang_sakit'    => $validated['sedang_sakit'],
            'kebutuhan_hewan' => $validated['kebutuhan_hewan'],
            'deskripsi_hewan' => $validated['deskripsi_hewan'],
            'target_donasi'   => $validated['target_donasi'],
            'gambar'          => $gambar,
        ]);

        // Log activity
        ActivityLogger::log(
            'create_campaign',
            "Membuat kampanye baru untuk '{$validated['nama_hewan']}' dengan target Rp " . number_format($validated['target_donasi'], 0, ',', '.'),
            'kampanye',
            $kampanye->id
        );

        // Notify all admins about new campaign
        $shelter = \App\Models\Shelter::find(session('shelter_id'));
        if ($shelter) {
            NotificationService::notifyAllAdmins(
                'kampanye_selesai',
                'Kampanye Baru Dibuat',
                "Shelter '{$shelter->nama_shelter}' telah membuat kampanye baru untuk '{$validated['nama_hewan']}' dengan target Rp " . number_format($validated['target_donasi'], 0, ',', '.') . ".",
                'Kampanye',
                null,
                ['shelter_name' => $shelter->nama_shelter, 'target' => $validated['target_donasi']]
            );
        }

        return redirect()->route('shelter.landingpage')->with('success', 'Kampanye berhasil dipublikasikan!');
    }

    public function withdrawShelter()
    {
        if ($redirect = $this->checkShelter()) return $redirect;
        $shelterId = session('shelter_id');
        $kampanye = Kampanye::where('shelter_id', $shelterId)
            ->where('total_terkumpul', '>', 0)
            ->get()
            ->map(function ($k) {
                $disetujui = Penarikan::where('kampanye_id', $k->id)
                    ->where('status', 'Berhasil')
                    ->sum('total_penarikan');
                $k->sisa_dana = max(0, $k->total_terkumpul - $disetujui);
                return $k;
            })
            ->filter(fn($k) => $k->sisa_dana > 0)
            ->values();

        return view('shelter.withdrawShelter', compact('kampanye'));
    }

    public function updateForm(Kampanye $kampanye)
    {
        if ($redirect = $this->checkShelter()) return $redirect;
        return view('shelter.updateFormShelter', compact('kampanye'));
    }

    public function updateKampanye(Request $request, Kampanye $kampanye)
    {
        if ($redirect = $this->checkShelter()) return $redirect;
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
            $data['gambar'] = Foto::simpanDariUpload($request->file('image'), 'kampanye');
        }

        $kampanye->update($data);

        // Log activity
        ActivityLogger::log(
            'update_campaign',
            "Memperbarui kampanye '{$kampanye->nama_hewan}'",
            'kampanye',
            $kampanye->id
        );

        return redirect()->route('shelter.landingpage')->with('success', 'Kampanye berhasil diperbarui.');
    }

    public function riwayatPenarikan()
    {
        if ($redirect = $this->checkShelter()) return $redirect;
        $shelterId = session('shelter_id');
        $riwayat = Penarikan::with('kampanye')
            ->where('shelter_id', $shelterId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('shelter.UploadStrukShelter', compact('riwayat'));
    }

    public function storePenarikan(Request $request)
    {
        if ($redirect = $this->checkShelter()) return $redirect;
        $shelterId = session('shelter_id');

        $validated = $request->validate([
            'kampanye_id'           => 'required|exists:kampanye,id',
            'bank'                  => 'required|string|max:50',
            'nomor_rekening'        => 'required|string|max:50',
            'nama_rekening'         => 'required|string|max:100',
            'total_penarikan'       => 'required|numeric|min:10000',
            'keterangan'            => 'required|string',
            'kategori_pengeluaran'  => 'required|in:Medis,Pakan,Operasional',
        ], [
            'kategori_pengeluaran.required' => 'Pilih kategori pengeluaran.',
            'kategori_pengeluaran.in'       => 'Kategori harus Medis, Pakan, atau Operasional.',
        ]);

        $kampanye = Kampanye::where('id', $validated['kampanye_id'])
            ->where('shelter_id', $shelterId)
            ->first();

        if (!$kampanye) {
            return back()->with('error', 'Kampanye tidak valid atau bukan milik shelter Anda.');
        }

        $totalDisetujui = Penarikan::where('kampanye_id', $kampanye->id)
            ->where('status', 'Berhasil')
            ->sum('total_penarikan');
        $sisaDana = max(0, $kampanye->total_terkumpul - $totalDisetujui);

        if ($validated['total_penarikan'] > $sisaDana) {
            return back()->with('error', 'Nominal melebihi sisa dana kampanye yang dapat ditarik (Rp ' . number_format($sisaDana, 0, ',', '.') . ').');
        }

        $penarikan = Penarikan::create([
            'shelter_id'            => $shelterId,
            'kampanye_id'           => $kampanye->id,
            'bank'                  => $validated['bank'],
            'nomor_rekening'        => $validated['nomor_rekening'],
            'nama_rekening'         => $validated['nama_rekening'],
            'total_penarikan'       => $validated['total_penarikan'],
            'keterangan'            => $validated['keterangan'],
            'kategori_pengeluaran'  => $validated['kategori_pengeluaran'],
            'status'                => 'Diproses',
        ]);

        // Log activity
        ActivityLogger::log(
            'submit_withdrawal',
            "Mengajukan penarikan dana untuk kampanye '{$kampanye->nama_hewan}' sebesar Rp " . number_format($penarikan->total_penarikan, 0, ',', '.'),
            'penarikan',
            $penarikan->id
        );

        // Load relationships for notifications
        $penarikan->load(['shelter']);

        // Notify all admins about withdrawal request
        NotificationService::notifyAllAdmins(
            'penarikan_diajukan',
            'Pengajuan Penarikan Dana Baru',
            "Shelter '{$penarikan->shelter->nama_shelter}' mengajukan penarikan dana untuk kampanye '{$kampanye->nama_hewan}' sebesar Rp " . number_format($penarikan->total_penarikan, 0, ',', '.') . ".",
            'Penarikan',
            $penarikan->id
        );

        return redirect()->route('shelter.uploadStruk')
            ->with('success', 'Pengajuan penarikan dana berhasil dikirim. Menunggu persetujuan admin.');
    }

    public function uploadBuktiForm(Penarikan $penarikan)
    {
        if ($redirect = $this->checkShelter()) return $redirect;
        $shelterId = session('shelter_id');
        if ($penarikan->shelter_id != $shelterId) {
            abort(403, 'Anda tidak memiliki akses ke penarikan ini.');
        }
        if ($penarikan->status !== 'Berhasil') {
            return redirect()->route('shelter.uploadStruk')
                ->with('error', 'Bukti hanya dapat diunggah setelah penarikan disetujui.');
        }

        $penarikan->load('kampanye');
        return view('shelter.uploadBukti', compact('penarikan'));
    }

    public function storeBukti(Request $request, Penarikan $penarikan)
    {
        if ($redirect = $this->checkShelter()) return $redirect;
        $shelterId = session('shelter_id');
        if ($penarikan->shelter_id != $shelterId) {
            abort(403);
        }
        if ($penarikan->status !== 'Berhasil') {
            return back()->with('error', 'Bukti hanya dapat diunggah setelah penarikan disetujui.');
        }

        $validated = $request->validate([
            'bukti_pengeluaran'    => 'required|image|max:4096',
            'deskripsi_penggunaan' => 'required|string|min:20|max:2000',
        ], [
            'bukti_pengeluaran.required' => 'Foto bukti pengeluaran wajib diunggah.',
            'bukti_pengeluaran.image'    => 'File harus berupa gambar (JPG, PNG, WEBP).',
            'bukti_pengeluaran.max'      => 'Ukuran gambar maksimal 4 MB.',
            'deskripsi_penggunaan.min'   => 'Deskripsi penggunaan dana minimal 20 karakter.',
        ]);

        $path = Foto::simpanDariUpload($request->file('bukti_pengeluaran'), 'bukti-pengeluaran');

        $penarikan->update([
            'bukti_pengeluaran'    => $path,
            'deskripsi_penggunaan' => $validated['deskripsi_penggunaan'],
            'tanggal_selesai'      => now(),
        ]);

        // Log activity
        ActivityLogger::log(
            'upload_proof',
            "Mengunggah bukti pengeluaran untuk penarikan dana kampanye '{$penarikan->kampanye->nama_hewan}' sebesar Rp " . number_format($penarikan->total_penarikan, 0, ',', '.'),
            'penarikan',
            $penarikan->id
        );

        // Load relationships for notifications
        $penarikan->load(['kampanye', 'shelter']);

        // Notify all admins about proof upload
        NotificationService::notifyAllAdmins(
            'bukti_diunggah',
            'Bukti Pengeluaran Diunggah',
            "Shelter '{$penarikan->shelter->nama_shelter}' telah mengunggah bukti pengeluaran untuk kampanye '{$penarikan->kampanye->nama_hewan}' sebesar Rp " . number_format($penarikan->total_penarikan, 0, ',', '.') . ".",
            'Penarikan',
            $penarikan->id
        );

        // Notify donors about impact evidence
        NotificationService::notifyDonorsOfImpact(
            $penarikan->kampanye_id,
            'Bukti Dampak Diunggah',
            "Shelter '{$penarikan->shelter->nama_shelter}' telah mengunggah bukti penggunaan dana untuk kampanye '{$penarikan->kampanye->nama_hewan}'. Lihat transparansi dana untuk detail selengkapnya.",
            ['penarikan_id' => $penarikan->id, 'shelter_name' => $penarikan->shelter->nama_shelter]
        );

        return redirect()->route('shelter.uploadStruk')
            ->with('success', 'Bukti pengeluaran berhasil diunggah. Donatur sekarang dapat melihat transparansi dana ini.');
    }
}
