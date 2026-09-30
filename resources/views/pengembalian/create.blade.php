@extends('layouts.app')
@section('title', 'Catat Pengembalian')
@section('content')
<h3 class="mb-4">Catat Pengembalian Mobil</h3>
<div class="card p-4">
    @if ($bookings->isEmpty())
        <div class="alert alert-warning mb-0">
            Tidak ada booking yang siap dikembalikan saat ini. Pastikan ada booking dengan status
            <strong>disetujui</strong> atau <strong>berlangsung</strong> yang belum dicatat pengembaliannya.
        </div>
    @else
        <form action="{{ route('pengembalian.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label">Booking (Penyewa - Mobil)</label>
                    <select name="booking_id" class="form-select" required>
                        <option value="">-- Pilih Booking --</option>
                        @foreach ($bookings as $b)
                            <option value="{{ $b->id }}" @selected(old('booking_id') == $b->id)>
                                {{ $b->nama_penyewa }} - {{ $b->mobil->nama_mobil }} ({{ $b->mobil->no_polisi }}) | {{ $b->tgl_mulai }} s/d {{ $b->tgl_selesai }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal Kembali</label>
                    <input type="date" name="tgl_kembali" class="form-control" value="{{ old('tgl_kembali', date('Y-m-d')) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Denda (Rp)</label>
                    <input type="number" name="denda" class="form-control" min="0" value="{{ old('denda', 0) }}">
                    <div class="form-text">Isi 0 kalau tidak ada denda/keterlambatan.</div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kondisi Mobil</label>
                    <input type="text" name="kondisi_mobil" class="form-control" placeholder="Baik / Ada lecet / dll" value="{{ old('kondisi_mobil') }}" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="3" placeholder="Catatan tambahan (opsional)">{{ old('keterangan') }}</textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">
                <i class="bi bi-check-circle"></i> Simpan
            </button>
            <a href="{{ route('pengembalian.index') }}" class="btn btn-light mt-3">Batal</a>
        </form>
    @endif
</div>
@endsection