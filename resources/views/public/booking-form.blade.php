@extends('public.layout')
@section('title', 'Booking Online')
@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="section-title text-center">Form Booking Online</h3>
            <p class="text-muted text-center mb-4">Isi data di bawah ini, tim kami akan segera menghubungi Anda untuk konfirmasi.</p>

            @if ($mobils->isEmpty())
                <div class="alert alert-warning">
                    Mohon maaf, saat ini belum ada mobil yang tersedia untuk disewa. Silakan cek kembali nanti atau hubungi kami langsung.
                </div>
            @else
                <div class="card p-4 border-0 shadow-sm">
                    <form action="{{ route('public.booking.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Pilih Mobil</label>
                                <select name="mobil_id" class="form-select" required>
                                    <option value="">-- Pilih Mobil --</option>
                                    @foreach ($mobils as $mobil)
                                        <option value="{{ $mobil->id }}" @selected(old('mobil_id', $mobilTerpilih) == $mobil->id)>
                                            {{ $mobil->nama_mobil }} ({{ $mobil->merk }}) - Rp {{ number_format($mobil->harga_sewa,0,',','.') }}/hari
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama_penyewa" class="form-control" value="{{ old('nama_penyewa') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">No. HP / WhatsApp</label>
                                <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Alamat</label>
                                <textarea name="alamat" class="form-control" rows="2" required>{{ old('alamat') }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Mulai Sewa</label>
                                <input type="date" name="tgl_mulai" class="form-control" min="{{ date('Y-m-d') }}" value="{{ old('tgl_mulai') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Selesai Sewa</label>
                                <input type="date" name="tgl_selesai" class="form-control" value="{{ old('tgl_selesai') }}" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-cta w-100 mt-4 py-2">
                            <i class="bi bi-send"></i> Kirim Permintaan Booking
                        </button>
                        <p class="text-muted small text-center mt-2 mb-0">
                            Booking Anda berstatus "pending" sampai dikonfirmasi oleh admin kami.
                        </p>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection