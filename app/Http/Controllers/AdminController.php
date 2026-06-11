<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Shelter;
use App\Models\Donatur;
use App\Models\Kampanye;
use App\Models\Donasi;
use App\Models\Penarikan;
use App\Helpers\ChartHelper;
use App\Services\NotificationService;

class AdminController extends Controller
{
    private function checkAdmin()
    {
        return session('role') === 'admin';
    }

    public function dashboard()
    {
        if (!$this->checkAdmin()) return redirect()->route('login');

        // Chart data: transaction volume
        $transactionVolumeData = ChartHelper::getTransactionVolumeData(6);

        return view('admin.dashboard', [
            'totalShelter'  => Shelter::count(),
            'totalDonatur'  => Donatur::count(),
            'totalKampanye' => Kampanye::count(),
            'totalDonasi'   => Donasi::count(),
            'shelters'      => Shelter::with('kampanye')->get(),
            'kampanye'      => Kampanye::with('shelter')->latest()->get(),
            'transactionVolumeData' => $transactionVolumeData,
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

    public function penarikan()
    {
        if (!$this->checkAdmin()) return redirect()->route('login');

        // Fetch penarikan sorted by the ones needing attention first (Diproses)
        $riwayat = Penarikan::with(['shelter', 'kampanye'])
            ->orderByRaw("CASE status WHEN 'Diproses' THEN 1 WHEN 'Berhasil' THEN 2 WHEN 'Gagal' THEN 3 ELSE 4 END")
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.penarikan', compact('riwayat'));
    }

    public function acceptPenarikan(Penarikan $penarikan)
    {
        if (!$this->checkAdmin()) return redirect()->route('login');

        $penarikan->update([
            'status'            => 'Berhasil',
            'tanggal_disetujui' => $penarikan->tanggal_disetujui ?? now(),
        ]);

        // Create notifications
        $shelter = $penarikan->shelter;
        $kampanye = $penarikan->kampanye;

        // Notify shelter that withdrawal is approved
        NotificationService::notifyShelter(
            $shelter,
            'penarikan_disetujui',
            'Penarikan Dana Disetujui',
            "Penarikan dana untuk kampanye '{$kampanye->nama_hewan}' sebesar Rp " . number_format($penarikan->total_penarikan, 0, ',', '.') . " telah disetujui. Silakan unggah bukti pengeluaran.",
            'Penarikan',
            $penarikan->id,
            ['kampanye_id' => $kampanye->id, 'total' => $penarikan->total_penarikan]
        );

        // Notify all admins
        NotificationService::notifyAllAdmins(
            'penarikan_disetujui',
            'Penarikan Dana Disetujui',
            "Penarikan untuk {$shelter->nama_shelter} ({$kampanye->nama_hewan}) telah disetujui.",
            'Penarikan',
            $penarikan->id
        );

        return redirect()->back()->with('success', 'Penarikan disetujui. Shelter wajib mengunggah bukti pengeluaran.');
    }

    public function rejectPenarikan(Penarikan $penarikan)
    {
        if (!$this->checkAdmin()) return redirect()->route('login');

        $penarikan->update(['status' => 'Gagal']);

        // Create notifications
        $shelter = $penarikan->shelter;
        $kampanye = $penarikan->kampanye;

        // Notify shelter that withdrawal is rejected
        NotificationService::notifyShelter(
            $shelter,
            'penarikan_ditolak',
            'Penarikan Dana Ditolak',
            "Penarikan dana untuk kampanye '{$kampanye->nama_hewan}' sebesar Rp " . number_format($penarikan->total_penarikan, 0, ',', '.') . " telah ditolak. Silakan hubungi admin untuk informasi lebih lanjut.",
            'Penarikan',
            $penarikan->id
        );

        // Notify all admins
        NotificationService::notifyAllAdmins(
            'penarikan_ditolak',
            'Penarikan Dana Ditolak',
            "Penarikan untuk {$shelter->nama_shelter} ({$kampanye->nama_hewan}) telah ditolak.",
            'Penarikan',
            $penarikan->id
        );

        return redirect()->back()->with('success', 'Penarikan telah ditolak.');
    }

    public function users()
    {
        if (!$this->checkAdmin()) return redirect()->route('login');

        $adminUsernames = Admin::pluck('username')->all();

        return view('admin.users', [
            'admins'           => Admin::orderBy('username')->get(),
            'shelters'         => Shelter::orderBy('nama_shelter')->get(),
            'donaturs'         => Donatur::orderBy('username')->get(),
            'adminUsernames'   => $adminUsernames,
            'currentAdminId'   => session('admin_id'),
        ]);
    }

    public function storeUser(Request $request)
    {
        if (!$this->checkAdmin()) return redirect()->route('login');

        $role = $request->input('role');

        if ($role === 'admin') {
            $data = $request->validate([
                'username' => 'required|string|max:25|unique:admin,username',
                'password' => 'required|string|min:6',
            ], [
                'username.unique' => 'Username admin sudah digunakan.',
                'password.min'    => 'Password minimal 6 karakter.',
            ]);
            Admin::create([
                'username' => $data['username'],
                'password' => Hash::make($data['password']),
            ]);
            $msg = "Admin {$data['username']} berhasil dibuat.";
        } elseif ($role === 'shelter') {
            $data = $request->validate([
                'nama_shelter' => 'required|string|max:255',
                'lokasi'       => 'required|string|max:255',
                'username'     => 'required|string|max:255|unique:shelter,username',
                'password'     => 'required|string|min:6',
            ], [
                'username.unique' => 'Username shelter sudah digunakan.',
            ]);
            Shelter::create([
                'nama_shelter' => $data['nama_shelter'],
                'lokasi'       => $data['lokasi'],
                'username'     => $data['username'],
                'password'     => Hash::make($data['password']),
            ]);
            $msg = "Shelter {$data['nama_shelter']} berhasil dibuat.";
        } elseif ($role === 'donatur') {
            $data = $request->validate([
                'username'   => 'required|string|max:50|unique:donatur,username',
                'email'      => 'required|email|unique:donatur,email',
                'no_telepon' => 'nullable|string|max:20',
                'password'   => 'required|string|min:6',
            ], [
                'username.unique' => 'Username donatur sudah digunakan.',
                'email.unique'    => 'Email sudah terdaftar.',
            ]);
            Donatur::create([
                'username'   => $data['username'],
                'email'      => $data['email'],
                'no_telepon' => $data['no_telepon'] ?? null,
                'password'   => Hash::make($data['password']),
            ]);
            $msg = "Donatur {$data['username']} berhasil dibuat.";
        } else {
            return back()->withErrors(['role' => 'Role tidak valid.']);
        }

        return redirect()->route('admin.users')->with('success', $msg);
    }

    public function promoteToAdmin(string $type, int $id)
    {
        if (!$this->checkAdmin()) return redirect()->route('login');

        $user = match ($type) {
            'shelter' => Shelter::findOrFail($id),
            'donatur' => Donatur::findOrFail($id),
            default   => abort(404),
        };

        if (Admin::where('username', $user->username)->exists()) {
            return back()->with('error', "Username '{$user->username}' sudah memiliki akses admin.");
        }

        Admin::create([
            'username' => $user->username,
            'password' => $user->password,
        ]);

        return redirect()->route('admin.users')->with('success', "Akun {$user->username} sekarang memiliki akses admin.");
    }

    public function destroyUser(string $type, int $id)
    {
        if (!$this->checkAdmin()) return redirect()->route('login');

        if ($type === 'admin') {
            $admin = Admin::findOrFail($id);
            if ($admin->id == session('admin_id')) {
                return back()->with('error', 'Tidak dapat menghapus akun Anda sendiri.');
            }
            if (Admin::count() <= 1) {
                return back()->with('error', 'Tidak dapat menghapus admin terakhir.');
            }
            $admin->delete();
            $msg = "Admin {$admin->username} dihapus.";
        } elseif ($type === 'shelter') {
            $s = Shelter::findOrFail($id);
            $s->delete();
            $msg = "Shelter {$s->nama_shelter} dihapus.";
        } elseif ($type === 'donatur') {
            $d = Donatur::findOrFail($id);
            $d->delete();
            $msg = "Donatur {$d->username} dihapus.";
        } else {
            abort(404);
        }

        return redirect()->route('admin.users')->with('success', $msg);
    }
}
