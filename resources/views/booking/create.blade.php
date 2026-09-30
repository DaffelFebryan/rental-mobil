@extends('layouts.app')
@section('title', 'Booking Baru')
@section('content')
<h3 class="mb-4">Booking Baru</h3>
<div class="card p-4">
    <form action="{{ route('booking.store') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Pilih Mobil (tersedia)</label>
                <select name="mobil_id" class="form-select" required>
                    <option value="">-- Pilih Mobil --</option>
                    @foreach ($mobils as $mobil)
                        <option value="{{ $mobil->id }}" @selected(old('mobil_id') == $mobil->id)>
                            {{ $mobil->nama_mobil }} ({{ $mobil->no_polisi }}) - Rp {{ number_format($mobil->harga_sewa,0,',','.') }}/hari
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nama Penyewa</label>
                <input type="text" name="nama_penyewa" class="form-control" value="{{ old('nama_penyewa') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">No HP</label>
                <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Alamat</label>
                <input type="text" name="alamat" class="form-control" value="{{ old('alamat') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Tanggal Mulai</label>
                <input type="date" name="tgl_mulai" class="form-control" value="{{ old('tgl_mulai') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Tanggal Selesai</label>
                <input type="date" name="tgl_selesai" class="form-control" value="{{ old('tgl_selesai') }}" required>
            </div>
        </div>
        <button class="btn btn-primary mt-3">Simpan Booking</button>
        <a href="{{ route('booking.index') }}" class="btn btn-light mt-3">Batal</a>
    </form>
</div>
@endsection