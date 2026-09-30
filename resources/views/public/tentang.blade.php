@extends('public.layout')
@section('title', 'Tentang Kami')
@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="section-title">Tentang Kami</h3>
            <p>
                Rental Mobil hadir untuk memberikan solusi transportasi yang mudah, cepat, dan terpercaya
                bagi kebutuhan perjalanan Anda — baik untuk keperluan pribadi, keluarga, maupun bisnis.
            </p>
            <p>
                Dengan armada yang terawat dan proses booking yang simpel, kami berkomitmen memberikan
                pengalaman sewa mobil terbaik dengan harga yang bersahabat.
            </p>

            <div class="row g-4 mt-3">
                <div class="col-md-4">
                    <div class="card p-4 text-center border-0 shadow-sm h-100">
                        <i class="bi bi-shield-check fs-2 text-primary mb-2"></i>
                        <h6 class="fw-bold">Terpercaya</h6>
                        <p class="text-muted small mb-0">Armada terawat & aman untuk perjalanan Anda.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4 text-center border-0 shadow-sm h-100">
                        <i class="bi bi-cash-coin fs-2 text-primary mb-2"></i>
                        <h6 class="fw-bold">Harga Bersahabat</h6>
                        <p class="text-muted small mb-0">Tarif kompetitif tanpa biaya tersembunyi.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4 text-center border-0 shadow-sm h-100">
                        <i class="bi bi-lightning-charge fs-2 text-primary mb-2"></i>
                        <h6 class="fw-bold">Proses Cepat</h6>
                        <p class="text-muted small mb-0">Booking online kapan saja, di mana saja.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection