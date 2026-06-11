<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\Kampanye;
use App\Models\Admin;
use App\Models\Donatur;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function show(Kampanye $kampanye)
    {
        return view('checkout', compact('kampanye'));
    }

    public function store(Request $request, Kampanye $kampanye)
    {
        $validated = $request->validate([
            'donor_name'     => 'required|string|max:100',
            'donor_email'    => 'required|email',
            'donor_phone'    => 'required|string|max:20',
            'jumlah'         => 'required|numeric|min:1000',
            'payment_method' => 'required|in:bank_transfer,e_wallet,credit_card',
        ]);

        $donasi = Donasi::create([
            'kampanye_id'       => $kampanye->id,
            'donatur_id'        => session('role') === 'donatur' ? session('donatur_id') : null,
            'nama_donatur'      => $validated['donor_name'],
            'email_donatur'     => $validated['donor_email'],
            'no_telepon'        => $validated['donor_phone'],
            'jumlah'            => $validated['jumlah'],
            'metode_pembayaran' => $validated['payment_method'],
            'status'            => 'pending',
        ]);

        $kampanye->increment('total_terkumpul', $validated['jumlah']);

        // Create notification for registered donor if exists
        if ($donasi->donatur_id) {
            $donatur = Donatur::find($donasi->donatur_id);
            if ($donatur) {
                NotificationService::notifyDonatur(
                    $donatur,
                    'donasi_berhasil',
                    'Donasi Berhasil Diproses',
                    "Donasi Anda sebesar Rp " . number_format($validated['jumlah'], 0, ',', '.') . " untuk kampanye '{$kampanye->nama_hewan}' telah berhasil diproses.",
                    'Donasi',
                    $donasi->id,
                    ['kampanye_id' => $kampanye->id, 'jumlah' => $validated['jumlah']]
                );
            }
        }

        // Notify all admins about new donation
        NotificationService::notifyAllAdmins(
            'donasi_berhasil',
            'Donasi Baru Diterima',
            "Donasi sebesar Rp " . number_format($validated['jumlah'], 0, ',', '.') . " dari {$validated['donor_name']} untuk kampanye '{$kampanye->nama_hewan}' telah berhasil diproses.",
            'Donasi',
            $donasi->id
        );

        return redirect()->route('kampanye.show', $kampanye->id)->with('donation_success', [
            'nama_hewan'  => $kampanye->nama_hewan,
            'donor_name'  => $validated['donor_name'],
            'jumlah'      => $validated['jumlah'],
            'metode'      => $validated['payment_method'],
        ]);
    }
}
