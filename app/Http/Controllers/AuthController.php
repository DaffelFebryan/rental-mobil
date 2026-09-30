<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login (SATU halaman untuk admin/staff maupun user/pelanggan).
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Proses login. Setelah berhasil, arahkan sesuai ROLE:
     * - admin / staff -> Panel Admin (/admin)
     * - customer      -> Dashboard User (/akun/dashboard)
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            if (in_array($user->role, ['admin', 'staff'])) {
                return redirect()->route('dashboard')
                    ->with('success', 'Berhasil login. Selamat datang, '.$user->name.'!');
            }

            return redirect()->route('customer.dashboard')
                ->with('success', 'Berhasil login. Selamat datang, '.$user->name.'!');
        }

        throw ValidationException::withMessages([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ]);
    }

    /**
     * Menampilkan halaman register untuk akun ADMIN/STAFF.
     * (Untuk pelanggan biasa, pendaftaran ada di CustomerAuthController / route customer.register)
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Proses register akun admin/staff.
     * User pertama yang daftar otomatis jadi admin, selanjutnya staff.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $role = User::whereIn('role', ['admin', 'staff'])->count() === 0 ? 'admin' : 'staff';

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => $role,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')
            ->with('success', 'Akun berhasil dibuat. Selamat datang, '.$user->name.'!');
    }

    /**
     * Proses logout (berlaku untuk semua role).
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Anda berhasil logout.');
    }
}