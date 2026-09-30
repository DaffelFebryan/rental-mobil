<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Mobil;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $bookings = Booking::with('mobil')
            ->when($request->status, fn ($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('booking.index', compact('bookings'));
    }

    public function create()
    {
        $mobils = Mobil::where('status', 'tersedia')->get();

        return view('booking.create', compact('mobils'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mobil_id'     => 'required|exists:mobils,id',
            'nama_penyewa' => 'required|string|max:255',
            'no_hp'        => 'required|string|max:20',
            'alamat'       => 'required|string',
            'tgl_mulai'    => 'required|date',
            'tgl_selesai'  => 'required|date|after_or_equal:tgl_mulai',
        ]);

        $mobil = Mobil::findOrFail($validated['mobil_id']);
        $lama = \Carbon\Carbon::parse($validated['tgl_mulai'])->diffInDays(\Carbon\Carbon::parse($validated['tgl_selesai'])) + 1;
        $validated['total_harga'] = $lama * $mobil->harga_sewa;
        $validated['status'] = 'pending';

        Booking::create($validated);
        $mobil->update(['status' => 'disewa']);

        return redirect()->route('booking.index')->with('success', 'Booking berhasil dibuat.');
    }

    public function show(Booking $booking)
    {
        $booking->load('mobil', 'pengembalian');

        return view('booking.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $mobils = Mobil::all();

        return view('booking.edit', compact('booking', 'mobils'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'nama_penyewa' => 'required|string|max:255',
            'no_hp'        => 'required|string|max:20',
            'alamat'       => 'required|string',
            'tgl_mulai'    => 'required|date',
            'tgl_selesai'  => 'required|date|after_or_equal:tgl_mulai',
            'status'       => 'required|in:pending,disetujui,berlangsung,selesai,dibatalkan',
        ]);

        $lama = \Carbon\Carbon::parse($validated['tgl_mulai'])->diffInDays(\Carbon\Carbon::parse($validated['tgl_selesai'])) + 1;
        $validated['total_harga'] = $lama * $booking->mobil->harga_sewa;

        $booking->update($validated);

        // Jika booking dibatalkan, kembalikan status mobil menjadi tersedia
        if ($validated['status'] === 'dibatalkan') {
            $booking->mobil->update(['status' => 'tersedia']);
        }

        return redirect()->route('booking.index')->with('success', 'Status booking berhasil diperbarui.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('booking.index')->with('success', 'Booking berhasil dihapus.');
    }
}