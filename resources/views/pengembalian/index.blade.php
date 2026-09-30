@extends('layouts.app')
@section('title', 'Pengembalian')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Pengembalian Mobil</h3>
    <a href="{{ route('pengembalian.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Catat Pengembalian</a>
</div>
<div class="card p-3">
    <table class="table table-hover align-middle">
        <thead>
            <tr><th>#</th><th>Penyewa</th><th>Mobil</th><th>Tgl Kembali</th><th>Denda</th><th>Kondisi Mobil</th><th class="text-end">Aksi</th></tr>
        </thead>
        <tbody>
        @forelse ($pengembalians as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->booking->nama_penyewa }}</td>
                <td>{{ $p->booking->mobil->nama_mobil }}</td>
                <td>{{ $p->tgl_kembali }}</td>
                <td>Rp {{ number_format($p->denda,0,',','.') }}</td>
                <td>{{ $p->kondisi_mobil }}</td>
                <td class="text-end">
                    <form action="{{ route('pengembalian.destroy', $p) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data pengembalian ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="7" class="text-center text-muted">Belum ada data pengembalian.</td></tr>
        @endforelse
        </tbody>
    </table>
    {{ $pengembalians->links() }}
</div>
@endsection