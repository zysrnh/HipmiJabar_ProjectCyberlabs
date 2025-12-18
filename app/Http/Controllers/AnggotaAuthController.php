<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Anggota;

class AnggotaAuthController extends Controller
{
    // Tampilkan halaman login (pakai view yang sama dengan admin)
    public function showLoginForm()
    {
        // Jika sudah login, redirect ke profile
        if (Auth::guard('anggota')->check()) {
            return redirect()->route('profile-anggota');
        }

        // Pakai view login yang unified
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Cek apakah email terdaftar
        $anggota = Anggota::where('email', $request->email)->first();

        if (!$anggota) {
            return back()
                ->withInput($request->only('email'))
                ->with('error', 'Email tidak terdaftar.');
        }

        // Cek password
        if (!Hash::check($request->password, $anggota->password)) {
            return back()
                ->withInput($request->only('email'))
                ->with('error', 'Password salah.');
        }

        // Login berhasil
        Auth::guard('anggota')->login($anggota, $request->filled('remember'));

        $request->session()->regenerate();

        return redirect()
            ->route('profile-anggota')
            ->with('success', 'Selamat datang, ' . $anggota->nama_usaha . '!');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::guard('anggota')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('home')
            ->with('success', 'Berhasil logout.');
    }
}