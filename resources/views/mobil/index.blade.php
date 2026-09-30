@extends('layouts.app')
@section('title', 'Daftar Mobil')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Daftar Mobil</h3>
    <a href="{{ route('mobil.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Mobil</a>
</div>
<div class="card p-3 mb-3">
    <form method="GET" class="row g-2">
        <div class="col-md-4">
            <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari nama, merk, atau no polisi...">
        </div>
        <div class="col-md-2"><button class="btn btn-outline-secondary w-100">Cari</button></div>
    </form>
</div>
<div class="card p-3">
    <table class="table table-hover align-middle">
        <thead>
            <tr><th>#</th><th>Nama Mobil</th><th>Merk</th><th>No Polisi</th><th>Tahun</th><th>Harga/Hari</th><th>Status</th><th class="text-end">Aksi</th></tr>
        </thead>
        <tbody>
        @forelse ($mobils as $mobil)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $mobil->nama_mobil }}</td>
                <td>{{ $mobil->merk }}</td>
                <td>{{ $mobil->no_polisi }}</td>
                <td>{{ $mobil->tahun }}</td>
                <td>Rp {{ number_format($mobil->harga_sewa, 0, ',', '.') }}</td>
                <td>
                    @php
                        $badge = ['tersedia' => 'success', 'disewa' => 'danger', 'maintenance' => 'warning'][$mobil->status];
                    @endphp
                    <span class="badge bg-{{ $badge }}">{{ $mobil->status }}</span>
                </td>
                <td class="text-end">
                    <a href="{{ route('mobil.edit', $mobil) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('mobil.destroy', $mobil) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data mobil ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="8" class="text-center text-muted">Belum ada data mobil.</td></tr>
        @endforelse
        </tbody>
    </table>
    {{ $mobils->links() }}
</div>
@endsection