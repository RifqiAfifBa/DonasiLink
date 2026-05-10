<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Donatur;
use App\Models\Shelter;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        // Coba login sebagai donatur
        $donatur = Donatur::where('email', $validated['email'])->first();
        if ($donatur && Hash::check($validated['password'], $donatur->password)) {
            session(['donatur_id' => $donatur->id, 'donatur_nama' => $donatur->username, 'role' => 'donatur']);
            return redirect()->route('beranda');
        }

        // Coba login sebagai shelter
        $shelter = Shelter::where('username', $validated['email'])->first();
        if ($shelter && Hash::check($validated['password'], $shelter->password)) {
            session(['shelter_id' => $shelter->id, 'shelter_nama' => $shelter->nama_shelter, 'role' => 'shelter']);
            return redirect()->route('shelter.landingpage');
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login');
    }
}
