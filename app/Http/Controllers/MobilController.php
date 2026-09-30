<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class MobilController extends Controller
{
    public function index(Request $request)
    {
        $mobils = Mobil::when($request->q, function ($query) use ($request) {
                $query->where('nama_mobil', 'like', '%'.$request->q.'%')
                      ->orWhere('merk', 'like', '%'.$request->q.'%')
                      ->orWhere('no_polisi', 'like', '%'.$request->q.'%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('mobil.index', compact('mobils'));
    }

    public function create()
    {
        return view('mobil.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_mobil'    => 'required|string|max:255',
            'merk'          => 'required|string|max:255',
            'no_polisi'     => 'required|string|max:20|unique:mobils,no_polisi',
            'tahun'         => 'required|integer|min:1990|max:'.(date('Y') + 1),
            'harga_sewa'    => 'required|integer|min:0',
            'status'        => 'required|in:tersedia,disewa,maintenance',
            'foto'          => 'nullable|image|max:2048',
            'biaya_servis'  => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('mobil', 'public');
        }

        $biayaServis = $validated['biaya_servis'] ?? null;
        unset($validated['biaya_servis']);

        $mobil = Mobil::create($validated);

        $this->catatBiayaServisJikaAda($mobil, $biayaServis);

        return redirect()->route('mobil.index')->with('success', 'Data mobil berhasil ditambahkan.');
    }

    public function edit(Mobil $mobil)
    {
        return view('mobil.edit', compact('mobil'));
    }

    public function update(Request $request, Mobil $mobil)
    {
        $validated = $request->validate([
            'nama_mobil'    => 'required|string|max:255',
            'merk'          => 'required|string|max:255',
            'no_polisi'     => 'required|string|max:20|unique:mobils,no_polisi,'.$mobil->id,
            'tahun'         => 'required|integer|min:1990|max:'.(date('Y') + 1),
            'harga_sewa'    => 'required|integer|min:0',
            'status'        => 'required|in:tersedia,disewa,maintenance',
            'foto'          => 'nullable|image|max:2048',
            'biaya_servis'  => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('mobil', 'public');
        }

        $biayaServis = $validated['biaya_servis'] ?? null;
        unset($validated['biaya_servis']);

        $mobil->update($validated);

        $this->catatBiayaServisJikaAda($mobil, $biayaServis);

        return redirect()->route('mobil.index')->with('success', 'Data mobil berhasil diperbarui.');
    }

    public function destroy(Mobil $mobil)
    {
        $mobil->delete();

        return redirect()->route('mobil.index')->with('success', 'Data mobil berhasil dihapus.');
    }

    /**
     * Kalau status mobil "maintenance" dan biaya servis diisi (> 0),
     * otomatis catat sebagai Pengeluaran (mengurangi Laba Bersih di Dashboard).
     */
    private function catatBiayaServisJikaAda(Mobil $mobil, ?int $biayaServis): void
    {
        if ($mobil->status === 'maintenance' && $biayaServis && $biayaServis > 0) {
            Pengeluaran::create([
                'kategori'   => 'Perawatan Mobil',
                'keterangan' => 'Servis/perbaikan '.$mobil->nama_mobil.' ('.$mobil->no_polisi.')',
                'jumlah'     => $biayaServis,
                'tanggal'    => now()->format('Y-m-d'),
            ]);
        }
    }
}