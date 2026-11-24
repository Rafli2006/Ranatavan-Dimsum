@extends('layouts.master')

@section('title', 'Dashboard Admin')

@section('content')

<div class="admin-page">

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-dark admin-navbar">
        <div class="container-fluid px-4">

            <a class="navbar-brand d-flex align-items-center gap-2"
               href="{{ route('admin.dashboard') }}">
                <span class="brand-logo">🥟</span>
                <span>
                    Ranatavan Dimsum
                    <small class="d-block brand-subtitle">ADMIN PANEL</small>
                </span>
            </a>

            <div class="ms-auto d-flex align-items-center gap-3">
                <div class="user-info text-end">
                    <span class="d-block text-white fw-semibold">
                        {{ Auth::user()->name }}
                    </span>
                    <small class="text-light opacity-75">Administrator</small>
                </div>

                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-logout">
                        Keluar
                    </button>
                </form>
            </div>

        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">

            {{-- SIDEBAR --}}
            <aside class="col-md-3 col-lg-2 admin-sidebar">

                <p class="sidebar-heading">MENU UTAMA</p>

                <a href="{{ route('admin.dashboard') }}"
                   class="sidebar-link active">
                    <span>⌂</span> Dashboard
                </a>

                <p class="sidebar-heading mt-4">MANAJEMEN DATA</p>

                <a href="{{ route('admin.kasir.index') }}"
                   class="sidebar-link">
                    <span>📊</span> Data Kasir
                </a>


                <div class="sidebar-link disabled-menu">
                    <span>▦</span> Data Kategori
                    <small>Segera</small>
                </div>

                <div class="sidebar-link disabled-menu">
                    <span>◇</span> Data Varian
                    <small>Segera</small>
                </div>

                <a href="{{ route('admin.produk.index') }}"
                   class="sidebar-link">
                    <span>🥟</span> Data Produk
                </a>

                <div class="sidebar-link disabled-menu">
                    <span>▤</span> Manajemen Stok
                    <small>Segera</small>
                </div>

                <p class="sidebar-heading mt-4">LAPORAN</p>

                <div class="sidebar-link disabled-menu">
                    <span>▧</span> Laporan Penjualan
                    <small>Segera</small>
                </div>

                <div class="sidebar-link disabled-menu">
                    <span>▤</span> Laporan Stok
                    <small>Segera</small>
                </div>

                <div class="sidebar-bottom">
                    <div class="sidebar-note">
                        <span>🥟</span>
                        <p class="mb-1 fw-semibold">Ranatavan Dimsum</p>
                        <small>Sistem Manajemen Penjualan</small>
                    </div>
                </div>

            </aside>

            {{-- KONTEN --}}
            <main class="col-md-9 col-lg-10 admin-content">

                {{-- JUDUL HALAMAN --}}
                <div class="page-heading">
                    <div>
                        <span class="eyebrow">OVERVIEW</span>
                        <h2>Dashboard Admin</h2>
                        <p>
                            Selamat datang, {{ Auth::user()->name }}!
                            Senang melihat Anda kembali.
                        </p>
                    </div>

                    <div class="date-label">
                        <span>📅</span>
                        {{ now()->translatedFormat('d F Y') }}
                    </div>
                </div>

                {{-- WELCOME BANNER --}}
                <div class="welcome-banner">
                    <div>
                        <span class="welcome-label">
                            ADMINISTRATOR PANEL
                        </span>

                        <h3>Kelola Ranatavan Dimsum</h3>

                        <p>
                            Pantau dan kelola data produk, kategori, varian,
                            stok, serta laporan penjualan dalam satu tempat.
                        </p>
                    </div>

                    <div class="welcome-decoration">🥟</div>
                </div>

                {{-- STATISTIK --}}
                <div class="section-heading">
                    <div>
                        <h5>Ringkasan Sistem</h5>
                        <p>Informasi umum pengelolaan toko</p>
                    </div>
                </div>

                <div class="row g-3">

                    <div class="col-sm-6 col-xl-3">
                        <div class="stat-card">
                            <div class="stat-icon icon-brown">🥟</div>
                            <div>
                                <p>Total Produk</p>
                                <h3>-</h3>
                                <small>Produk terdaftar</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="stat-card">
                            <div class="stat-icon icon-gold">▦</div>
                            <div>
                                <p>Total Kategori</p>
                                <h3>-</h3>
                                <small>Kategori produk</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="stat-card">
                            <div class="stat-icon icon-green">♙</div>
                            <div>
                                <p>Total Kasir</p>
                                <h3>-</h3>
                                <small>Akun kasir terdaftar</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="stat-card">
                            <div class="stat-icon icon-cream">▤</div>
                            <div>
                                <p>Total Penjualan</p>
                                <h3>-</h3>
                                <small>Transaksi tercatat</small>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- MENU CEPAT --}}
                <div class="section-heading mt-4">
                    <div>
                        <h5>Akses Menu</h5>
                        <p>Pilih menu untuk mengelola sistem</p>
                    </div>
                </div>

                <div class="row g-3">

                    {{-- DATA PRODUK --}}
                    <div class="col-md-6 col-xl-3">
                        <a href="{{ route('admin.produk.index') }}"
                           class="quick-card text-decoration-none d-block">

                            <span class="quick-icon">🥟</span>

                            <h6>Data Produk</h6>

                            <p>
                                Kelola produk, ukuran, harga, dan stok dimsum.
                            </p>

                            <span class="quick-status">
                                Buka menu produk →
                            </span>
                        </a>
                    </div>

                    {{-- KATEGORI DAN VARIAN --}}
                    <div class="col-md-6 col-xl-3">
                        <div class="quick-card">
                            <span class="quick-icon">▦</span>
                            <h6>Kategori & Varian</h6>
                            <p>
                                Atur kategori dan varian produk yang tersedia.
                            </p>
                            <span class="quick-status">
                                Segera tersedia
                            </span>
                        </div>
                    </div>

                    {{-- STOK --}}
                    <div class="col-md-6 col-xl-3">
                        <div class="quick-card">
                            <span class="quick-icon">▤</span>
                            <h6>Manajemen Stok</h6>
                            <p>
                                Pantau persediaan dan perubahan stok produk.
                            </p>
                            <span class="quick-status">
                                Segera tersedia
                            </span>
                        </div>
                    </div>

                    {{-- LAPORAN --}}
                    <div class="col-md-6 col-xl-3">
                        <div class="quick-card">
                            <span class="quick-icon">▧</span>
                            <h6>Laporan</h6>
                            <p>
                                Lihat informasi penjualan dan persediaan.
                            </p>
                            <span class="quick-status">
                                Segera tersedia
                            </span>
                        </div>
                    </div>

                </div>

                <div class="admin-footer">
                    © {{ date('Y') }} Ranatavan Dimsum · Admin Dashboard
                </div>

            </main>
        </div>
    </div>

</div>

@endsection

@push('styles')
<style>

    .admin-page {
        min-height: 100vh;
        background: #f8f5f0;
    }

    /* NAVBAR */
    .admin-navbar {
        background: #563522;
        min-height: 70px;
        box-shadow: 0 3px 12px rgba(50,30,15,.12);
    }

    .brand-logo {
        background: rgba(255,255,255,.13);
        width: 40px;
        height: 40px;
        display: grid;
        place-items: center;
        border-radius: 12px;
        font-size: 23px;
    }

    .admin-navbar .navbar-brand {
        font-size: 16px;
        line-height: 1.2;
    }

    .brand-subtitle {
        color: #dfbd9a;
        font-size: 9px;
        letter-spacing: 2px;
        margin-top: 4px;
    }

    .user-avatar {
        width: 37px;
        height: 37px;
        border-radius: 50%;
        background: #d9b58e;
        color: #563522;
        display: grid;
        place-items: center;
        font-weight: bold;
    }

    .btn-logout {
        background: #fff7ec;
        color: #70452c;
        border-radius: 8px;
        font-size: 12px;
        font-weight: bold;
        padding: 8px 14px;
    }

    .btn-logout:hover {
        background: #e9d6c1;
        color: #563522;
    }

    /* SIDEBAR */
    .sidebar a {
    display: flex;
    align-items: center;
    gap: 12px;
    }

    .sidebar a span {
        white-space: nowrap;
    }

    .sidebar a i {
        width: 20px;
        min-width: 20px;
        text-align: center;
        font-size: 16px;
    }

    .admin-sidebar {
        background: #70452c;
        min-height: calc(100vh - 70px);
        padding: 28px 16px;
        display: flex;
        flex-direction: column;
    }

    .sidebar-heading {
        color: #d9b99a;
        font-size: 10px;
        font-weight: bold;
        letter-spacing: 1.5px;
        padding: 0 10px;
        margin-bottom: 12px;
    }

    .sidebar-link {
        display: flex;
        align-items: center;
        gap: 12px;
        color: #f8eee4;
        text-decoration: none;
        font-size: 13px;
        padding: 12px;
        border-radius: 9px;
        margin-bottom: 5px;
        transition: .2s;
    }

    a.sidebar-link:hover,
    .sidebar-link.active {
        background: #946747;
        color: white;
    }

    .sidebar-link span {
        width: 22px;
        text-align: center;
        font-size: 17px;
    }

    .disabled-menu {
        opacity: .65;
        cursor: not-allowed;
        justify-content: flex-start;
    }

    .disabled-menu small {
        margin-left: auto;
        font-size: 9px;
        color: #e0c7ae;
    }

    .sidebar-bottom {
        margin-top: auto;
        padding-top: 35px;
    }

    .sidebar-note {
        padding: 15px;
        background: rgba(255,255,255,.09);
        border-radius: 12px;
        color: white;
        font-size: 12px;
    }

    .sidebar-note > span {
        font-size: 23px;
    }

    .sidebar-note small {
        color: #e0c7ae;
        font-size: 10px;
    }

    /* KONTEN */
    .admin-content {
        padding: 30px;
    }

    .page-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 25px;
    }

    .eyebrow,
    .welcome-label {
        color: #a47c59;
        font-size: 10px;
        font-weight: bold;
        letter-spacing: 2px;
    }

    .page-heading h2 {
        color: #563522;
        font-weight: 800;
        font-size: 27px;
        margin: 6px 0;
    }

    .page-heading p {
        color: #96887d;
        font-size: 13px;
        margin: 0;
    }

    .date-label {
        background: white;
        border: 1px solid #eee3d7;
        color: #70452c;
        padding: 10px 14px;
        border-radius: 10px;
        font-size: 12px;
    }

    /* BANNER */
    .welcome-banner {
        background: linear-gradient(120deg, #805337, #563522);
        border-radius: 16px;
        padding: 28px 32px;
        color: white;
        display: flex;
        align-items: center;
        justify-content: space-between;
        overflow: hidden;
        margin-bottom: 30px;
    }

    .welcome-label {
        color: #e2c4a5;
    }

    .welcome-banner h3 {
        font-weight: 800;
        margin: 10px 0;
    }

    .welcome-banner p {
        color: #ead9c8;
        font-size: 13px;
        max-width: 570px;
        margin: 0;
        line-height: 1.7;
    }

    .welcome-decoration {
        font-size: 85px;
        opacity: .85;
        padding: 0 25px;
    }

    /* STATISTIK */
    .section-heading {
        margin-bottom: 15px;
    }

    .section-heading h5 {
        color: #563522;
        font-weight: 800;
        margin-bottom: 4px;
    }

    .section-heading p {
        color: #a09287;
        font-size: 12px;
        margin: 0;
    }

    .stat-card {
        background: white;
        border: 1px solid #f0e8df;
        border-radius: 14px;
        padding: 20px 16px;
        display: flex;
        align-items: center;
        gap: 14px;
        height: 100%;
        box-shadow: 0 4px 15px rgba(75,46,27,.04);
    }

    .stat-icon {
        min-width: 48px;
        width: 48px;
        height: 48px;
        border-radius: 13px;
        display: grid;
        place-items: center;
        font-size: 22px;
    }

    .icon-brown {
        background: #f1e4d7;
        color: #70452c;
    }

    .icon-gold {
        background: #f8efd9;
        color: #a47c37;
    }

    .icon-green {
        background: #e8eee4;
        color: #60764d;
    }

    .icon-cream {
        background: #f5eae0;
        color: #8b6144;
    }

    .stat-card p {
        color: #92867c;
        font-size: 12px;
        margin-bottom: 5px;
    }

    .stat-card h3 {
        color: #563522;
        font-weight: 800;
        margin-bottom: 3px;
    }

    .stat-card small {
        color: #b0a398;
        font-size: 10px;
    }

    /* KARTU MENU */
    .quick-card {
        background: white;
        border: 1px solid #f0e8df;
        border-radius: 14px;
        padding: 20px;
        height: 100%;
        transition: .2s;
    }

    a.quick-card {
        cursor: pointer;
    }

    a.quick-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(75,46,27,.12);
        border-color: #c9a789;
    }

    .quick-icon {
        display: grid;
        place-items: center;
        width: 43px;
        height: 43px;
        border-radius: 12px;
        background: #f4e9dd;
        color: #70452c;
        font-size: 21px;
        margin-bottom: 15px;
    }

    .quick-card h6 {
        color: #563522;
        font-weight: bold;
    }

    .quick-card p {
        color: #968a80;
        font-size: 11px;
        line-height: 1.7;
        min-height: 38px;
    }

    .quick-status {
        color: #a17a59;
        font-size: 10px;
        font-weight: bold;
    }

    /* FOOTER */
    .admin-footer {
        text-align: center;
        color: #aa9c90;
        font-size: 11px;
        padding: 30px 0 5px;
    }

    /* RESPONSIVE */
    @media (max-width: 767px) {

        .admin-sidebar {
            min-height: auto;
        }

        .admin-content {
            padding: 20px 15px;
        }

        .page-heading {
            align-items: flex-start;
            flex-direction: column;
        }

        .welcome-decoration {
            display: none;
        }

        .welcome-banner {
            padding: 23px;
        }

        .user-info {
            display: none;
        }
    }

</style>
@endpush
