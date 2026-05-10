<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\Kampanye;
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

        Donasi::create([
            'kampanye_id'      => $kampanye->id,
            'nama_donatur'     => $validated['donor_name'],
            'email_donatur'    => $validated['donor_email'],
            'no_telepon'       => $validated['donor_phone'],
            'jumlah'           => $validated['jumlah'],
            'metode_pembayaran' => $validated['payment_method'],
            'status'           => 'pending',
        ]);

        $kampanye->increment('total_terkumpul', $validated['jumlah']);

        return redirect()->route('beranda')->with('success', 'Terima kasih! Donasi Anda sedang diproses.');
    }
}
