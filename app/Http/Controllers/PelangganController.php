<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $pelanggans = Pelanggan::when($request->q, function ($query) use ($request) {
                $query->where('nama', 'like', '%'.$request->q.'%')
                      ->orWhere('no_hp', 'like', '%'.$request->q.'%')
                      ->orWhere('email', 'like', '%'.$request->q.'%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('pelanggan.index', compact('pelanggans'));
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'    => 'required|string|max:255',
            'no_hp'   => 'required|string|max:20',
            'email'   => 'nullable|email|max:255',
            'alamat'  => 'nullable|string',
            'no_ktp'  => 'nullable|string|max:20',
            'catatan' => 'nullable|string',
        ]);

        Pelanggan::create($validated);

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil ditambahkan.');
    }

    public function show(Pelanggan $pelanggan)
    {
        return view('pelanggan.show', compact('pelanggan'));
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $validated = $request->validate([
            'nama'    => 'required|string|max:255',
            'no_hp'   => 'required|string|max:20',
            'email'   => 'nullable|email|max:255',
            'alamat'  => 'nullable|string',
            'no_ktp'  => 'nullable|string|max:20',
            'catatan' => 'nullable|string',
        ]);

        $pelanggan->update($validated);

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil dihapus.');
    }
}