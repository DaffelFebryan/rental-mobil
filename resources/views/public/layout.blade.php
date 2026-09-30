<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Beranda') - Rental Mobil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        * { font-family: 'Segoe UI', system-ui, sans-serif; }
        body { background:#f8fafc; }
        .navbar-custom { background: #1e293b; padding: .9rem 0; }
        .navbar-custom .navbar-brand { color:#fff; font-weight:700; font-size:1.3rem; }
        .navbar-custom .nav-link { color:#cbd5e1 !important; font-weight:500; margin: 0 .3rem; }
        .navbar-custom .nav-link:hover, .navbar-custom .nav-link.active { color:#fff !important; }
        .btn-cta { background: linear-gradient(135deg, #2563eb, #1d4ed8); color:#fff; border:none; border-radius: 8px; font-weight:600; }
        .btn-cta:hover { color:#fff; opacity:.92; }
        .hero { background: linear-gradient(135deg, #0f172a, #1e293b 60%, #334155); color:#fff; padding: 5rem 0 6rem; }
        .car-card { border:none; border-radius:14px; overflow:hidden; box-shadow:0 4px 16px rgba(0,0,0,.06); transition: transform .15s ease; height:100%; }
        .car-card:hover { transform: translateY(-4px); box-shadow:0 10px 30px rgba(0,0,0,.1); }
        .car-card .car-photo { height:180px; background:#e2e8f0; display:flex; align-items:center; justify-content:center; color:#94a3b8; font-size:2.5rem; }
        .badge-status { font-weight:600; }
        footer { background:#0f172a; color:#94a3b8; padding: 2.5rem 0 1.5rem; margin-top: 4rem; }
        footer a { color:#cbd5e1; text-decoration:none; }
        footer a:hover { color:#fff; }
        .section-title { font-weight:700; margin-bottom: 2rem; }
        .profile-dropdown .dropdown-toggle::after { display:none; }
        .profile-dropdown .btn-profile {
            background:rgba(255,255,255,.08); border:1px solid rgba(255,255,255,.15);
            color:#fff; border-radius:8px; padding:.4rem .9rem; font-weight:600; font-size:.9rem;
        }
        .profile-dropdown .btn-profile:hover { background:rgba(255,255,255,.15); }
        .profile-dropdown .dropdown-menu { border:none; box-shadow:0 10px 30px rgba(0,0,0,.15); border-radius:10px; padding:.5rem; min-width:200px; }
        .profile-dropdown .dropdown-item { border-radius:6px; padding:.55rem .8rem; font-size:.9rem; }
        .profile-dropdown .dropdown-item:hover { background:#f1f5f9; }
        .profile-dropdown .dropdown-item.text-danger:hover { background:#fee2e2; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}"><i class="bi bi-car-front-fill"></i> Rental Mobil</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain" style="border-color:#475569;">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMain">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('public.katalog') ? 'active' : '' }}" href="{{ route('public.katalog') }}">Katalog Mobil</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('public.tentang') ? 'active' : '' }}" href="{{ route('public.tentang') }}">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('public.kontak') ? 'active' : '' }}" href="{{ route('public.kontak') }}">Kontak</a></li>

                    <li class="nav-item dropdown profile-dropdown ms-lg-2">
                        <a class="btn btn-profile dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> Profil
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            @auth
                                <li class="px-3 py-2 border-bottom mb-1">
                                    <div class="fw-semibold text-dark">{{ auth()->user()->name }}</div>
                                    <div class="text-muted small">{{ auth()->user()->email }}</div>
                                </li>
                                @if (in_array(auth()->user()->role, ['admin', 'staff']))
                                    <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2"></i> Admin Panel</a></li>
                                @else
                                    <li><a class="dropdown-item" href="{{ route('customer.dashboard') }}"><i class="bi bi-grid"></i> Dashboard Saya</a></li>
                                @endif
                                <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="bi bi-person"></i> Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> Login</a></li>
                                <li><a class="dropdown-item" href="{{ route('customer.register') }}"><i class="bi bi-person-plus"></i> Daftar</a></li>
                            @endauth
                        </ul>
                    </li>

                    <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                        <a href="{{ route('public.booking.form') }}" class="btn btn-cta btn-sm">Booking Sekarang</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @if (session('success'))
        <div class="container mt-3"><div class="alert alert-success"><i class="bi bi-check-circle"></i> {{ session('success') }}</div></div>
    @endif
    @if (session('error'))
        <div class="container mt-3"><div class="alert alert-danger"><i class="bi bi-exclamation-circle"></i> {{ session('error') }}</div></div>
    @endif
    @if ($errors->any())
        <div class="container mt-3">
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @yield('content')

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5 class="text-white"><i class="bi bi-car-front-fill"></i> Rental Mobil</h5>
                    <p class="small">Solusi sewa mobil harian terpercaya dengan armada terawat dan harga bersahabat.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h6 class="text-white">Tautan</h6>
                    <p class="mb-1"><a href="{{ route('public.katalog') }}">Katalog Mobil</a></p>
                    <p class="mb-1"><a href="{{ route('public.tentang') }}">Tentang Kami</a></p>
                    <p class="mb-1"><a href="{{ route('public.kontak') }}">Kontak</a></p>
                </div>
                <div class="col-md-4 mb-3">
                    <h6 class="text-white">Kontak Kami</h6>
                    <p class="small mb-1"><i class="bi bi-telephone"></i> 0812-3456-7890</p>
                    <p class="small mb-1"><i class="bi bi-envelope"></i> info@rentalmobil.com</p>
                    <p class="small mb-1"><i class="bi bi-geo-alt"></i> Jl. Contoh No. 123, Kota Anda</p>
                </div>
            </div>
            <hr style="border-color:#334155;">
            <p class="text-center small mb-0">&copy; {{ date('Y') }} Rental Mobil. Semua hak dilindungi.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>