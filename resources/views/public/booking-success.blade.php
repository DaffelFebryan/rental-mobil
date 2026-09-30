@extends('public.layout')
@section('title', 'Booking Berhasil')
@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <i class="bi bi-check-circle-fill text-success" style="font-size:4rem;"></i>
            <h3 class="fw-bold mt-3">Permintaan Booking Terkirim!</h3>
            <p class="text-muted">
                Terima kasih, permintaan booking Anda sudah kami terima dan sedang menunggu konfirmasi dari tim kami.
                Kami akan segera menghubungi Anda melalui nomor HP/WhatsApp yang telah Anda daftarkan.
            </p>
            <div class="d-flex gap-2 justify-content-center mt-4">
                <a href="{{ route('home') }}" class="btn btn-outline-dark">Kembali ke Beranda</a>
                <a href="{{ route('public.katalog') }}" class="btn btn-cta">Lihat Mobil Lain</a>
            </div>
        </div>
    </div>
</div>

@endsection