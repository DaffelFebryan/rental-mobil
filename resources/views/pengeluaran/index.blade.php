@extends('layouts.app')
@section('title', 'Pengeluaran')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Pengeluaran</h3>
    <a href="{{ route('pengeluaran.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Pengeluaran</a>
</div>

<div class="card p-3 mb-3">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-3">
            <label class="form-label small">Pilih Bulan</label>
            <input type="month" name="bulan" value="{{ $bulan }}" class="form-control">
        </div>
        <div class="col-md-2">
            <button class="btn btn-outline-secondary w-100">Filter</button>
        </div>
        <div class="col-md-4 ms-auto text-end">
            <div class="text-muted small">Total Pengeluaran Bulan Ini</div>
            <div class="fs-4 fw-bold text-danger">Rp {{ number_format($totalBulanIni, 0, ',', '.') }}</div>
        </div>
    </form>
</div>

<div class="card p-3">
    <table class="table table-hover align-middle">
        <thead>
            <tr><th>#</th><th>Tanggal</th><th>Kategori</th><th>Keterangan</th><th>Jumlah</th><th class="text-end">Aksi</th></tr>
        </thead>
        <tbody>
        @forelse ($pengeluarans as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->tanggal }}</td>
                <td><span class="badge bg-secondary">{{ $p->kategori }}</span></td>
                <td>{{ $p->keterangan }}</td>
                <td>Rp {{ number_format($p->jumlah, 0, ',', '.') }}</td>
                <td class="text-end">
                    <form action="{{ route('pengeluaran.destroy', $p) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data pengeluaran ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center text-muted">Belum ada data pengeluaran bulan ini.</td></tr>
        @endforelse
        </tbody>
    </table>
    {{ $pengeluarans->links() }}
</div>
@endsection