<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Donatur;
use App\Models\Shelter;
use App\Models\Admin;
use App\Services\ActivityLogger;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'username'   => 'required|string|max:50|unique:donatur,username',
            'email'      => 'required|email|unique:donatur,email',
            'no_telepon' => 'nullable|string|max:20',
            'password'   => 'required|string|min:6|confirmed',
        ], [
            'username.unique'  => 'Username sudah digunakan.',
            'email.unique'     => 'Email sudah terdaftar.',
            'password.min'     => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $donatur = Donatur::create([
            'username'   => $validated['username'],
            'email'      => $validated['email'],
            'no_telepon' => $validated['no_telepon'] ?? null,
            'password'   => Hash::make($validated['password']),
        ]);

        ActivityLogger::log(
            'register',
            "Donatur '{$donatur->username}' mendaftarkan akun baru",
            'donatur',
            $donatur->id
        );

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Silakan masuk.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string',
        ]);

        $input    = $request->input('email');
        $password = $request->input('password');

        // Login sebagai admin
        $admin = Admin::where('username', $input)->first();
        if ($admin && Hash::check($password, $admin->password)) {
            session(['admin_id' => $admin->id, 'admin_nama' => $admin->username, 'role' => 'admin']);
            ActivityLogger::log('login', "Admin '{$admin->username}' login", 'admin', $admin->id);
            return redirect()->route('admin.dashboard');
        }

        // Login sebagai shelter
        $shelter = Shelter::where('username', $input)->first();
        if ($shelter && Hash::check($password, $shelter->password)) {
            session(['shelter_id' => $shelter->id, 'shelter_nama' => $shelter->nama_shelter, 'role' => 'shelter']);
            ActivityLogger::log('login', "Shelter '{$shelter->nama_shelter}' login", 'shelter', $shelter->id);
            return redirect()->route('shelter.landingpage');
        }

        // Login sebagai donatur
        $donatur = Donatur::where('email', $input)->orWhere('username', $input)->first();
        if ($donatur && Hash::check($password, $donatur->password)) {
            session(['donatur_id' => $donatur->id, 'donatur_nama' => $donatur->username, 'role' => 'donatur']);
            ActivityLogger::log('login', "Donatur '{$donatur->username}' login", 'donatur', $donatur->id);
            return redirect()->route('donatur.dashboard');
        }

        // Login sebagai shelter
        $shelter = Shelter::where('username', $input)->first();
        if ($shelter && Hash::check($password, $shelter->password)) {
            session(['shelter_id' => $shelter->id, 'shelter_nama' => $shelter->nama_shelter, 'role' => 'shelter']);
            return redirect()->route('shelter.landingpage');
        }

        // Login sebagai donatur
        $donatur = Donatur::where('email', $input)->orWhere('username', $input)->first();
        if ($donatur && Hash::check($password, $donatur->password)) {
            session(['donatur_id' => $donatur->id, 'donatur_nama' => $donatur->username, 'role' => 'donatur']);

            $intended = session()->pull('intended_url');
            if ($intended) {
                return redirect($intended);
            }

            return redirect()->route('donatur.dashboard');
        }

        return back()->withErrors(['email' => 'Email atau username / password salah.'])->withInput();
    }

    public function logout(Request $request)
    {
        $role = session('role');
        $name = session($role . '_nama') ?? session($role . '_id');
        ActivityLogger::log('logout', ucfirst($role) . " '{$name}' logout", $role, session($role . '_id'));
        $request->session()->flush();
        return redirect()->route('login');
    }
}
