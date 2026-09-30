<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class CustomerDashboardController extends Controller
{
    /**
     * Menampilkan Dashboard User (untuk role 'customer').
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // Coba cocokkan riwayat booking berdasarkan nomor HP yang sama dengan
        // yang pernah dipakai saat booking online (karena booking tidak wajib login).
        $riwayatBooking = Booking::with('mobil')
            ->where('nama_penyewa', 'like', '%'.$user->name.'%')
            ->latest()
            ->take(5)
            ->get();

        return view('customer.dashboard', compact('user', 'riwayatBooking'));
    }
}