<?php

namespace App\Http\Controllers;

use App\Models\Kantin;
use App\Models\Pembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $data = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        // cek kantin dulu, karena penjual boleh belanja juga
        if (Auth::guard('kantin')->attempt($data)) {
            $kantin = Auth::guard('kantin')->user();

            // siapkan akun pembeli untuk penjual ini kalau belum ada
            $pembeli = Pembeli::where('username', $kantin->username)->first();

            if ($pembeli == null) {
                $pembeli = Pembeli::create([
                    'nama_pembeli' => $kantin->nama_penjual,
                    'username' => $kantin->username,
                    'password' => $request->password,
                ]);
            }

            Auth::guard('pembeli')->login($pembeli);
            $request->session()->regenerate();

            return redirect()->route('pilih.mode');
        }

        // kalau bukan penjual, coba sebagai pembeli
        if (Auth::guard('pembeli')->attempt($data)) {
            $request->session()->regenerate();

            return redirect()->route('pembeli.menu');
        }

        return back()
            ->withErrors(['username' => 'Username atau password salah'])
            ->withInput($request->only('username'));
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'peran' => 'required|in:pembeli,kantin',
            'password' => 'required|min:6|confirmed',
        ]);

        // daftar sebagai pembeli
        if ($request->peran == 'pembeli') {
            $request->validate([
                'nama_pembeli' => 'required|max:100',
                'username' => 'required|max:50|unique:pembeli,username',
            ]);

            if (Kantin::where('username', $request->username)->exists()) {
                return back()->withErrors(['username' => 'Username sudah dipakai'])->withInput();
            }

            $pembeli = Pembeli::create([
                'nama_pembeli' => $request->nama_pembeli,
                'username' => $request->username,
                'password' => $request->password,
            ]);

            Auth::guard('pembeli')->login($pembeli);
            $request->session()->regenerate();

            return redirect()->route('pembeli.menu');
        }

        // daftar sebagai kantin
        $request->validate([
            'nama_kantin' => 'required|max:100',
            'nama_penjual' => 'required|max:100',
            'username' => 'required|max:50|unique:kantin,username',
        ]);

        if (Pembeli::where('username', $request->username)->exists()) {
            return back()->withErrors(['username' => 'Username sudah dipakai'])->withInput();
        }

        $kantin = Kantin::create([
            'nama_kantin' => $request->nama_kantin,
            'nama_penjual' => $request->nama_penjual,
            'username' => $request->username,
            'password' => $request->password,
        ]);

        // penjual juga langsung punya akun pembeli
        $pembeli = Pembeli::create([
            'nama_pembeli' => $request->nama_penjual,
            'username' => $request->username,
            'password' => $request->password,
        ]);

        Auth::guard('kantin')->login($kantin);
        Auth::guard('pembeli')->login($pembeli);
        $request->session()->regenerate();

        return redirect()->route('pilih.mode');
    }

    public function logout(Request $request)
    {
        Auth::guard('pembeli')->logout();
        Auth::guard('kantin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}