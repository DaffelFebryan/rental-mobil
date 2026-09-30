@extends('public.layout')
@section('title', 'Katalog Mobil')
@section('content')

<div class="container py-5">
    <h3 class="section-title">Katalog Mobil</h3>

    <div class="card p-3 mb-4 border-0 shadow-sm">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label small">Cari</label>
                <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Nama atau merk mobil...">
            </div>
            <div class="col-md-3">
                <label class="form-label small">Harga Maksimal / Hari</label>
                <input type="number" name="harga_max" value="{{ request('harga_max') }}" class="form-control" placeholder="Contoh: 500000">
            </div>
            <div class="col-md-3">
                <label class="form-label small">Status</label>
                <select name="status_filter" class="form-select">
                    <option value="">Semua Mobil</option>
                    <option value="tersedia" @selected(request('status_filter') === 'tersedia')>Hanya yang Tersedia</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-cta w-100">Cari</button>
            </div>
        </form>
    </div>

    <div class="row g-4">
        @forelse ($mobils as $mobil)
            <div class="col-md-4">
                <div class="card car-card">
                    <div class="car-photo">
                        @if ($mobil->foto)
                            <img src="{{ asset('storage/'.$mobil->foto) }}" alt="{{ $mobil->nama_mobil }}" style="width:100%; height:100%; object-fit:cover;">
                        @else
                            <i class="bi bi-car-front"></i>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <h5 class="card-title mb-1">{{ $mobil->nama_mobil }}</h5>
                            @php
                                $badge = ['tersedia' => 'success', 'disewa' => 'danger', 'maintenance' => 'warning'][$mobil->status];
                                $label = ['tersedia' => 'Tersedia', 'disewa' => 'Disewa', 'maintenance' => 'Perawatan'][$mobil->status];
                            @endphp
                            <span class="badge bg-{{ $badge }} badge-status">{{ $label }}</span>
                        </div>
                        <p class="text-muted small mb-2">{{ $mobil->merk }} &bull; {{ $mobil->tahun }}</p>
                        <p class="fw-bold text-primary mb-3">Rp {{ number_format($mobil->harga_sewa, 0, ',', '.') }} <span class="fw-normal text-muted small">/ hari</span></p>
                        <a href="{{ route('public.detail', $mobil) }}" class="btn btn-outline-primary w-100 btn-sm">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-5">
                Tidak ada mobil yang sesuai dengan pencarian kamu.
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $mobils->links() }}
    </div>
</div>

@endsection