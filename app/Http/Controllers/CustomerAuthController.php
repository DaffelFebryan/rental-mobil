<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerAuthController extends Controller
{
    /**
     * Menampilkan halaman daftar akun untuk user/pelanggan.
     * (Login TIDAK di sini lagi — login memakai satu halaman bersama di AuthController)
     */
    public function showRegister()
    {
        return view('customer-auth.register');
    }

    /**
     * Proses pendaftaran akun baru untuk user/pelanggan.
     * Role selalu otomatis 'customer'.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'customer',
        ]);

        Auth::login($user);

        return redirect()->route('customer.dashboard')
            ->with('success', 'Akun berhasil dibuat. Selamat datang, '.$user->name.'!');
    }
}