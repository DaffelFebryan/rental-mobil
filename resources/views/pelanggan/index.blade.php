@extends('layouts.app')
@section('title', 'Manajemen Pelanggan')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Manajemen Pelanggan</h3>
    <a href="{{ route('pelanggan.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Pelanggan</a>
</div>
<div class="card p-3 mb-3">
    <form method="GET" class="row g-2">
        <div class="col-md-4">
            <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari nama, no HP, atau email...">
        </div>
        <div class="col-md-2"><button class="btn btn-outline-secondary w-100">Cari</button></div>
    </form>
</div>
<div class="card p-3">
    <table class="table table-hover align-middle">
        <thead>
            <tr><th>#</th><th>Nama</th><th>No HP</th><th>Email</th><th>No KTP</th><th class="text-end">Aksi</th></tr>
        </thead>
        <tbody>
        @forelse ($pelanggans as $pelanggan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pelanggan->nama }}</td>
                <td>{{ $pelanggan->no_hp }}</td>
                <td>{{ $pelanggan->email ?? '-' }}</td>
                <td>{{ $pelanggan->no_ktp ?? '-' }}</td>
                <td class="text-end">
                    <a href="{{ route('pelanggan.show', $pelanggan) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('pelanggan.edit', $pelanggan) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('pelanggan.destroy', $pelanggan) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data pelanggan ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center text-muted">Belum ada data pelanggan.</td></tr>
        @endforelse
        </tbody>
    </table>
    {{ $pelanggans->links() }}
</div>
@endsection