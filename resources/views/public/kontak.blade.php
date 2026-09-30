@extends('public.layout')
@section('title', 'Kontak')
@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="section-title text-center">Hubungi Kami</h3>
            <div class="row g-4 mt-2">
                <div class="col-md-4">
                    <div class="card p-4 text-center border-0 shadow-sm h-100">
                        <i class="bi bi-telephone-fill fs-2 text-primary mb-2"></i>
                        <h6 class="fw-bold">Telepon / WhatsApp</h6>
                        <p class="text-muted small mb-0">0812-3456-7890</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4 text-center border-0 shadow-sm h-100">
                        <i class="bi bi-envelope-fill fs-2 text-primary mb-2"></i>
                        <h6 class="fw-bold">Email</h6>
                        <p class="text-muted small mb-0">info@rentalmobil.com</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4 text-center border-0 shadow-sm h-100">
                        <i class="bi bi-geo-alt-fill fs-2 text-primary mb-2"></i>
                        <h6 class="fw-bold">Alamat</h6>
                        <p class="text-muted small mb-0">Jl. Contoh No. 123, Kota Anda</p>
                    </div>
                </div>
            </div>

            <div class="card p-4 border-0 shadow-sm mt-4 text-center">
                <p class="mb-2">Punya pertanyaan lebih lanjut? Langsung chat kami di WhatsApp!</p>
                <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-success">
                    <i class="bi bi-whatsapp"></i> Chat via WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>

@endsection