<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Pengembalian;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Pengembalian::with('booking.mobil')->latest()->paginate(10);

        return view('pengembalian.index', compact('pengembalians'));
    }

    public function create()
    {
        // Hanya booking yang sedang berlangsung/disetujui dan belum ada pengembalian
        $bookings = Booking::whereIn('status', ['disetujui', 'berlangsung'])
            ->whereDoesntHave('pengembalian')
            ->with('mobil')
            ->get();

        return view('pengembalian.create', compact('bookings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_id'    => 'required|exists:bookings,id',
            'tgl_kembali'   => 'required|date',
            'denda'         => 'nullable|integer|min:0',
            'kondisi_mobil' => 'required|string|max:255',
            'keterangan'    => 'nullable|string',
        ]);

        $validated['denda'] = $validated['denda'] ?? 0;

        $pengembalian = Pengembalian::create($validated);

        $booking = Booking::find($validated['booking_id']);
        $booking->update(['status' => 'selesai']);
        $booking->mobil->update(['status' => 'tersedia']);

        return redirect()->route('pengembalian.index')->with('success', 'Pengembalian mobil berhasil dicatat.');
    }

    public function destroy(Pengembalian $pengembalian)
    {
        $pengembalian->delete();

        return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian berhasil dihapus.');
    }
}
