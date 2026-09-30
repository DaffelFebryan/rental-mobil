@extends('public.layout')
@section('title', $mobil->nama_mobil)
@section('content')

<div class="container py-5">
    <a href="{{ route('public.katalog') }}" class="text-decoration-none small"><i class="bi bi-arrow-left"></i> Kembali ke Katalog</a>

    <div class="row mt-3 g-4">
        <div class="col-md-6">
            <div class="car-photo" style="height:320px; border-radius:14px;">
                @if ($mobil->foto)
                    <img src="{{ asset('storage/'.$mobil->foto) }}" alt="{{ $mobil->nama_mobil }}" style="width:100%; height:100%; object-fit:cover; border-radius:14px;">
                @else
                    <i class="bi bi-car-front" style="font-size:4rem;"></i>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            @php
                $badge = ['tersedia' => 'success', 'disewa' => 'danger', 'maintenance' => 'warning'][$mobil->status];
                $label = ['tersedia' => 'Tersedia', 'disewa' => 'Sedang Disewa', 'maintenance' => 'Dalam Perawatan'][$mobil->status];
            @endphp
            <span class="badge bg-{{ $badge }} badge-status mb-2">{{ $label }}</span>
            <h2 class="fw-bold">{{ $mobil->nama_mobil }}</h2>
            <p class="text-muted">{{ $mobil->merk }} &bull; Tahun {{ $mobil->tahun }} &bull; Plat {{ $mobil->no_polisi }}</p>
            <h3 class="text-primary fw-bold mb-4">Rp {{ number_format($mobil->harga_sewa, 0, ',', '.') }} <span class="fw-normal text-muted fs-6">/ hari</span></h3>

            @if ($mobil->status === 'tersedia')
                <a href="{{ route('public.booking.form', ['mobil_id' => $mobil->id]) }}" class="btn btn-cta btn-lg w-100">
                    <i class="bi bi-calendar-check"></i> Booking Mobil Ini
                </a>
            @else
                <button class="btn btn-secondary btn-lg w-100" disabled>Mobil Sedang Tidak Tersedia</button>
                <p class="text-muted small mt-2 text-center">Silakan pilih mobil lain yang tersedia di katalog.</p>
            @endif
        </div>
    </div>

    @if ($mobilLain->isNotEmpty())
        <h4 class="section-title mt-5">Mobil Tersedia Lainnya</h4>
        <div class="row g-4">
            @foreach ($mobilLain as $ml)
                <div class="col-md-4">
                    <div class="card car-card">
                        <div class="car-photo">
                            @if ($ml->foto)
                                <img src="{{ asset('storage/'.$ml->foto) }}" alt="{{ $ml->nama_mobil }}" style="width:100%; height:100%; object-fit:cover;">
                            @else
                                <i class="bi bi-car-front"></i>
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 class="card-title mb-1">{{ $ml->nama_mobil }}</h5>
                            <p class="text-muted small mb-2">{{ $ml->merk }} &bull; {{ $ml->tahun }}</p>
                            <p class="fw-bold text-primary mb-3">Rp {{ number_format($ml->harga_sewa, 0, ',', '.') }} <span class="fw-normal text-muted small">/ hari</span></p>
                            <a href="{{ route('public.detail', $ml) }}" class="btn btn-outline-primary w-100 btn-sm">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection