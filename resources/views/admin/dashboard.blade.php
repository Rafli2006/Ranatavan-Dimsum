@extends('layouts.master')

@section('title', 'Dashboard Admin')

@section('content')

<div class="admin-dashboard">

    {{-- SIDEBAR --}}
    <aside class="admin-sidebar">

        <div class="sidebar-brand">
            <div class="brand-icon">🥟</div>
            <div>
                <h5>Ranatavan</h5>
                <span>DIMSUM MANAGEMENT</span>
            </div>
        </div>

        <div class="sidebar-label">MENU UTAMA</div>

        <nav class="sidebar-menu">

            <a href="{{ route('admin.dashboard') }}" class="sidebar-link active">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.kasir.index') }}" class="sidebar-link">
                <i class="bi bi-people"></i>
                <span>Data Kasir</span>
            </a>

            <a href="{{ route('admin.kategori.index') }}" class="sidebar-link">
                <i class="bi bi-tags"></i>
                <span>Data Kategori</span>
            </a>

            <a href="{{ route('admin.varian.index') }}" class="sidebar-link">
                <i class="bi bi-grid"></i>
                <span>Data Varian</span>
            </a>

            <a href="{{ route('admin.produk.index') }}" class="sidebar-link">
                <i class="bi bi-box-seam"></i>
                <span>Data Produk</span>
            </a>

        </nav>

        <div class="sidebar-label mt-4">LAINNYA</div>

        <nav class="sidebar-menu">

            <a href="{{ route('admin.stok.index') }}" class="sidebar-link">
                <i class="bi bi-boxes"></i>
                <span>Manajemen Stok</span>
            </a>

            <a href="#" class="sidebar-link disabled-link">
                <i class="bi bi-receipt"></i>
                <span>Laporan Penjualan</span>
                <small>Segera</small>
            </a>

        </nav>

        <div class="sidebar-bottom">

            <div class="sidebar-profile">
                <div class="profile-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

                <div class="profile-info">
                    <strong>{{ Auth::user()->name }}</strong>
                    <span>Administrator</span>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="logout-button">
                    <i class="bi bi-box-arrow-left"></i>
                    Keluar
                </button>
            </form>

        </div>

    </aside>

    {{-- MAIN AREA --}}
    <main class="admin-main">

        {{-- TOPBAR --}}
        <header class="admin-topbar">

            <div>
                <div class="topbar-caption">
                    RANATAVAN DIMSUM / ADMIN
                </div>

                <h5>Dashboard</h5>
            </div>

            <div class="topbar-right">

                <div class="topbar-date">
                    <i class="bi bi-calendar3"></i>
                    {{ now()->translatedFormat('d F Y') }}
                </div>

                <div class="topbar-user">

                    <div class="topbar-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                    <div>
                        <strong>{{ Auth::user()->name }}</strong>
                        <span>Administrator</span>
                    </div>

                </div>

            </div>

        </header>

        {{-- CONTENT --}}
        <div class="dashboard-content">

            {{-- WELCOME BANNER --}}
            <section class="welcome-banner">

                <div class="welcome-text">

                    <span class="welcome-tag">
                        <i class="bi bi-stars"></i>
                        ADMINISTRATOR PANEL
                    </span>

                    <h1>
                        Selamat datang, {{ Auth::user()->name }}!
                    </h1>

                    <p>
                        Selamat datang di sistem manajemen Ranatavan Dimsum.
                        Kelola produk, kategori, varian, dan data kasir
                        dengan lebih mudah melalui satu dashboard.
                    </p>

                    <a href="{{ route('admin.produk.index') }}" class="welcome-button">
                        Kelola Produk
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

                <div class="welcome-decoration">

                    <div class="decoration-circle"></div>

                    <div class="decoration-dimsum">🥟</div>

                    <span class="decoration-text">
                        FRESH • DELICIOUS • QUALITY
                    </span>

                    <div class="floating-decoration decoration-one">🥢</div>
                    <div class="floating-decoration decoration-two">✨</div>

                </div>

            </section>

            {{-- SECTION TITLE --}}
            <div class="section-heading">

                <div>
                    <span class="section-eyebrow">OVERVIEW</span>
                    <h4>Ringkasan Data</h4>
                    <p>Informasi terkini pengelolaan Ranatavan Dimsum.</p>
                </div>

                <div class="overview-date">
                    <i class="bi bi-clock-history"></i>
                    Data saat ini
                </div>

            </div>

            {{-- STATISTICS --}}
            <div class="stats-grid">

                {{-- PRODUK --}}
                <div class="stat-card">

                    <div class="stat-top">
                        <div class="stat-icon icon-orange">
                            <i class="bi bi-box-seam"></i>
                        </div>

                        <span class="stat-label">PRODUK</span>
                    </div>

                    <h2>{{ number_format($totalProducts) }}</h2>

                    <p>Total seluruh produk</p>

                    <a href="{{ route('admin.produk.index') }}">
                        Lihat produk
                        <i class="bi bi-arrow-up-right"></i>
                    </a>

                </div>

                {{-- KATEGORI --}}
                <div class="stat-card">

                    <div class="stat-top">
                        <div class="stat-icon icon-peach">
                            <i class="bi bi-tags"></i>
                        </div>

                        <span class="stat-label">KATEGORI</span>
                    </div>

                    <h2>{{ number_format($totalCategories) }}</h2>

                    <p>Total kategori produk</p>

                    <a href="{{ route('admin.kategori.index') }}">
                        Lihat kategori
                        <i class="bi bi-arrow-up-right"></i>
                    </a>

                </div>

                {{-- VARIAN --}}
                <div class="stat-card">

                    <div class="stat-top">
                        <div class="stat-icon icon-green">
                            <i class="bi bi-grid"></i>
                        </div>

                        <span class="stat-label">VARIAN</span>
                    </div>

                    <h2>{{ number_format($totalVariants) }}</h2>

                    <p>Total varian produk</p>

                    <a href="{{ route('admin.varian.index') }}">
                        Lihat varian
                        <i class="bi bi-arrow-up-right"></i>
                    </a>

                </div>

                {{-- KASIR --}}
                <div class="stat-card">

                    <div class="stat-top">
                        <div class="stat-icon icon-blue">
                            <i class="bi bi-people"></i>
                        </div>

                        <span class="stat-label">KASIR</span>
                    </div>

                    <h2>{{ number_format($totalKasir) }}</h2>

                    <p>Total akun kasir</p>

                    <a href="{{ route('admin.kasir.index') }}">
                        Lihat kasir
                        <i class="bi bi-arrow-up-right"></i>
                    </a>

                </div>

            </div>

            {{-- QUICK ACCESS --}}
            <div class="section-heading quick-heading">

                <div>
                    <span class="section-eyebrow">SHORTCUT</span>
                    <h4>Akses Cepat</h4>
                    <p>Pilih menu untuk mengelola data Ranatavan Dimsum.</p>
                </div>

            </div>

            <div class="quick-grid">

                <a href="{{ route('admin.produk.index') }}" class="quick-card">

                    <div class="quick-icon quick-orange">
                        <i class="bi bi-box-seam"></i>
                    </div>

                    <div class="quick-info">
                        <h6>Data Produk</h6>
                        <p>Tambah, ubah, dan kelola produk dimsum.</p>
                    </div>

                    <i class="bi bi-arrow-up-right quick-arrow"></i>

                </a>

                <a href="{{ route('admin.kategori.index') }}" class="quick-card">

                    <div class="quick-icon quick-peach">
                        <i class="bi bi-tags"></i>
                    </div>

                    <div class="quick-info">
                        <h6>Data Kategori</h6>
                        <p>Kelola pengelompokan produk.</p>
                    </div>

                    <i class="bi bi-arrow-up-right quick-arrow"></i>

                </a>

                <a href="{{ route('admin.varian.index') }}" class="quick-card">

                    <div class="quick-icon quick-green">
                        <i class="bi bi-grid"></i>
                    </div>

                    <div class="quick-info">
                        <h6>Data Varian</h6>
                        <p>Atur pilihan varian produk.</p>
                    </div>

                    <i class="bi bi-arrow-up-right quick-arrow"></i>

                </a>

                <a href="{{ route('admin.kasir.index') }}" class="quick-card">

                    <div class="quick-icon quick-blue">
                        <i class="bi bi-person-badge"></i>
                    </div>

                    <div class="quick-info">
                        <h6>Data Kasir</h6>
                        <p>Kelola akun pengguna kasir.</p>
                    </div>

                    <i class="bi bi-arrow-up-right quick-arrow"></i>

                </a>

            </div>

            {{-- RECENT PRODUCTS --}}
            <div class="section-heading recent-heading">

                <div>
                    <span class="section-eyebrow">PRODUCT OVERVIEW</span>
                    <h4>Produk Terbaru</h4>
                    <p>Lima produk yang terakhir ditambahkan.</p>
                </div>

                <a href="{{ route('admin.produk.index') }}" class="view-all">
                    Lihat semua
                    <i class="bi bi-arrow-right"></i>
                </a>

            </div>

            <div class="recent-table-card">

                <div class="table-responsive">

                    <table class="table recent-table align-middle mb-0">

                        <thead>
                            <tr>
                                <th>PRODUK</th>
                                <th>KATEGORI</th>
                                <th>VARIAN</th>
                                <th>HARGA</th>
                                <th>STOK</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($recentProducts as $product)

                                <tr>

                                    <td>
                                        <div class="product-name">

                                            <div class="product-mini-icon">
                                                <i class="bi bi-box-seam"></i>
                                            </div>

                                            <strong>{{ $product->name }}</strong>

                                        </div>
                                    </td>

                                    <td>
                                        {{ $product->category->name ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $product->variant->name ?? '-' }}
                                    </td>

                                    <td class="product-price">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </td>

                                    <td>
                                        {{ $product->stock }}
                                    </td>

                                    <td>

                                        @if ($product->status === 'active')

                                            <span class="status-badge status-active">
                                                <i class="bi bi-check-circle-fill"></i>
                                                Aktif
                                            </span>

                                        @else

                                            <span class="status-badge status-inactive">
                                                <i class="bi bi-x-circle-fill"></i>
                                                Nonaktif
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="6" class="empty-state">
                                        <i class="bi bi-inbox"></i>
                                        <p>Belum ada data produk.</p>
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            {{-- FOOTER --}}
            <footer class="dashboard-footer">

                <span>
                    © {{ date('Y') }} Ranatavan Dimsum
                </span>

                <span>
                    Made with <i class="bi bi-heart-fill"></i> for delicious moments
                </span>

            </footer>

        </div>

    </main>

</div>

@endsection

@push('styles')
<style>

/* =====================================
   GLOBAL DASHBOARD
===================================== */

.admin-dashboard {
    --orange: #f07828;
    --orange-dark: #d95d16;
    --orange-light: #ff9d52;
    --peach: #fff1e5;
    --brown: #713d25;
    --text: #38271f;
    --muted: #9b8980;

    min-height: 100vh;
    display: flex;
    background: #fff9f4;
    color: var(--text);
    font-family: 'DM Sans', Arial, sans-serif;
}

/* =====================================
   SIDEBAR
===================================== */

.admin-sidebar {
    width: 258px;
    min-width: 258px;
    background: #fff;
    border-right: 1px solid #f4e5d9;
    padding: 27px 17px 18px;
    display: flex;
    flex-direction: column;
}

.sidebar-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 0 9px 30px;
}

.brand-icon {
    width: 47px;
    height: 47px;
    border-radius: 15px;
    display: grid;
    place-items: center;
    background: linear-gradient(135deg, #ff9d52, #f07828);
    font-size: 26px;
    box-shadow: 0 5px 12px rgba(240,120,40,.2);
}

.sidebar-brand h5 {
    font-family: 'Playfair Display', Georgia, serif;
    font-weight: 700;
    font-size: 19px;
    margin: 0;
    color: var(--brown);
}

.sidebar-brand span {
    display: block;
    color: #b58b70;
    font-size: 9px;
    letter-spacing: 1.4px;
    margin-top: 3px;
    font-weight: 800;
}

.sidebar-label {
    padding: 0 11px;
    color: #b5a49a;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1.5px;
    margin-bottom: 10px;
}

.sidebar-menu {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.sidebar-link {
    min-height: 45px;
    padding: 0 12px;
    display: flex;
    align-items: center;
    gap: 12px;
    color: #79665a;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    border-radius: 10px;
    transition: .2s ease;
}

.sidebar-link i {
    font-size: 17px;
    width: 20px;
    text-align: center;
}

.sidebar-link:hover {
    background: #fff1e5;
    color: var(--orange-dark);
}

.sidebar-link.active {
    background: linear-gradient(110deg, #f07828, #ff9d52);
    color: white;
    box-shadow: 0 6px 14px rgba(240,120,40,.22);
}

.disabled-link {
    opacity: .45;
    cursor: not-allowed;
    pointer-events: none;
}

.disabled-link small {
    margin-left: auto;
    font-size: 9px;
    background: #f5eee8;
    padding: 3px 6px;
    border-radius: 5px;
}

.sidebar-bottom {
    margin-top: auto;
    padding-top: 20px;
    border-top: 1px solid #f1e7df;
}

.sidebar-profile {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 0 5px 16px;
}

.profile-avatar,
.topbar-avatar {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    display: grid;
    place-items: center;
    background: #ffead8;
    color: var(--orange-dark);
    font-weight: 800;
}

.profile-info strong,
.topbar-user strong {
    display: block;
    font-size: 12px;
    color: var(--brown);
}

.profile-info span,
.topbar-user span {
    display: block;
    color: #a08f82;
    font-size: 10px;
    margin-top: 3px;
}

.logout-button {
    width: 100%;
    border: 1px solid #f5dfd0;
    border-radius: 9px;
    padding: 10px;
    background: white;
    color: #bd6340;
    font-size: 12px;
    font-weight: 700;
    text-align: left;
    transition: .2s;
}

.logout-button i {
    margin-right: 8px;
}

.logout-button:hover {
    background: #fff1e5;
    border-color: #f3b18a;
    color: #b94723;
}

/* =====================================
   TOPBAR
===================================== */

.admin-main {
    flex: 1;
    min-width: 0;
}

.admin-topbar {
    min-height: 83px;
    background: white;
    border-bottom: 1px solid #f4e5d9;
    padding: 15px 36px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.topbar-caption {
    font-size: 9px;
    letter-spacing: 1.4px;
    color: #bd9278;
    font-weight: 800;
    margin-bottom: 5px;
}

.admin-topbar h5 {
    margin: 0;
    color: var(--brown);
    font-size: 19px;
    font-weight: 800;
}

.topbar-right {
    display: flex;
    align-items: center;
    gap: 25px;
}

.topbar-date {
    color: #8e7e72;
    font-size: 12px;
}

.topbar-date i {
    margin-right: 6px;
    color: var(--orange);
}

.topbar-user {
    display: flex;
    align-items: center;
    gap: 9px;
    padding-left: 20px;
    border-left: 1px solid #f1e7df;
}

.topbar-avatar {
    width: 36px;
    height: 36px;
}

/* =====================================
   DASHBOARD CONTENT
===================================== */

.dashboard-content {
    padding: 30px 36px;
    max-width: 1600px;
    margin: auto;
}

/* =====================================
   WELCOME BANNER
===================================== */

.welcome-banner {
    position: relative;
    overflow: hidden;
    min-height: 235px;
    border-radius: 19px;
    padding: 31px 37px;
    display: flex;
    align-items: center;
    background: linear-gradient(110deg, #ed6c1c, #ff9d52);
    color: white;
    box-shadow: 0 12px 25px rgba(240,120,40,.17);
}

.welcome-text {
    position: relative;
    z-index: 2;
    max-width: 650px;
}

.welcome-tag {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 7px 11px;
    border-radius: 30px;
    background: rgba(255,255,255,.2);
    color: white;
    font-size: 9px;
    font-weight: 800;
    letter-spacing: 1.3px;
}

.welcome-banner h1 {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: clamp(24px, 3vw, 34px);
    font-weight: 700;
    margin: 16px 0 9px;
}

.welcome-banner p {
    max-width: 570px;
    color: #fff3e9;
    font-size: 12px;
    line-height: 1.8;
    margin-bottom: 17px;
}

.welcome-button {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 11px 17px;
    background: white;
    color: #d95d16;
    border-radius: 9px;
    text-decoration: none;
    font-size: 11px;
    font-weight: 800;
    transition: .2s;
}

.welcome-button:hover {
    background: #fff0e3;
    color: #a94415;
    transform: translateY(-2px);
}

.welcome-decoration {
    position: absolute;
    right: 55px;
    top: 0;
    height: 100%;
    width: 260px;
    display: grid;
    place-items: center;
}

.decoration-circle {
    position: absolute;
    width: 190px;
    height: 190px;
    border: 1px solid rgba(255,255,255,.3);
    border-radius: 50%;
    box-shadow:
        0 0 0 25px rgba(255,255,255,.07),
        0 0 0 50px rgba(255,255,255,.04);
}

.decoration-dimsum {
    position: relative;
    font-size: 105px;
    filter: drop-shadow(0 12px 10px rgba(110,50,10,.2));
}

.decoration-text {
    position: absolute;
    bottom: 24px;
    color: #fff0df;
    font-size: 9px;
    letter-spacing: 2px;
}

.floating-decoration {
    position: absolute;
    font-size: 28px;
}

.decoration-one {
    top: 32px;
    right: 20px;
    transform: rotate(-20deg);
}

.decoration-two {
    top: 45px;
    left: 5px;
    font-size: 22px;
}

/* =====================================
   SECTION HEADING
===================================== */

.section-heading {
    display: flex;
    justify-content: space-between;
    align-items: end;
    margin: 31px 0 17px;
}

.section-eyebrow {
    display: block;
    color: var(--orange);
    font-size: 9px;
    font-weight: 800;
    letter-spacing: 1.5px;
    margin-bottom: 5px;
}

.section-heading h4 {
    color: var(--brown);
    font-size: 18px;
    font-weight: 800;
    margin: 0 0 5px;
}

.section-heading p {
    color: #9a8b80;
    font-size: 11px;
    margin: 0;
}

.overview-date {
    color: #a18c7d;
    background: white;
    border: 1px solid #f2e4d9;
    padding: 8px 12px;
    border-radius: 8px;
    font-size: 10px;
}

.overview-date i {
    color: var(--orange);
    margin-right: 5px;
}

/* =====================================
   STATISTICS
===================================== */

.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 16px;
}

.stat-card {
    position: relative;
    overflow: hidden;
    background: white;
    border: 1px solid #f3e6dc;
    border-radius: 14px;
    padding: 19px;
    min-width: 0;
    transition: .2s;
}

.stat-card::after {
    content: '';
    position: absolute;
    width: 75px;
    height: 75px;
    border-radius: 50%;
    background: #fff5ed;
    right: -25px;
    bottom: -35px;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 22px rgba(120,65,30,.08);
    border-color: #f3c6a8;
}

.stat-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.stat-icon,
.quick-icon {
    width: 42px;
    height: 42px;
    display: grid;
    place-items: center;
    border-radius: 12px;
    font-size: 19px;
}

.stat-label {
    color: #b1a397;
    font-size: 9px;
    font-weight: 800;
    letter-spacing: 1px;
}

.icon-orange, .quick-orange {
    background: #ffeadb;
    color: #e96d22;
}

.icon-peach, .quick-peach {
    background: #fff1e5;
    color: #d78b53;
}

.icon-green, .quick-green {
    background: #eaf2e5;
    color: #718b5c;
}

.icon-blue, .quick-blue {
    background: #eaf0f8;
    color: #6d86a4;
}

.stat-card h2 {
    color: #493125;
    font-size: 29px;
    font-weight: 800;
    margin: 16px 0 2px;
}

.stat-card p {
    color: #9b8d82;
    font-size: 11px;
    margin: 0 0 15px;
}

.stat-card > a {
    position: relative;
    z-index: 1;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #df702c;
    font-size: 10px;
    font-weight: 800;
    text-decoration: none;
}

.stat-card > a:hover {
    color: #a94415;
}

/* =====================================
   QUICK ACCESS
===================================== */

.quick-heading {
    margin-top: 34px;
}

.quick-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 13px;
}

.quick-card {
    display: flex;
    align-items: center;
    gap: 11px;
    min-width: 0;
    padding: 16px 13px;
    background: white;
    border: 1px solid #f2e5dc;
    border-radius: 12px;
    text-decoration: none;
    transition: .2s;
}

.quick-card:hover {
    border-color: #f1bd9b;
    transform: translateY(-3px);
    box-shadow: 0 8px 17px rgba(120,65,30,.07);
}

.quick-icon {
    flex-shrink: 0;
    width: 38px;
    height: 38px;
    font-size: 17px;
}

.quick-info {
    min-width: 0;
}

.quick-info h6 {
    color: #49372b;
    font-size: 11px;
    font-weight: 800;
    margin: 0 0 4px;
}

.quick-info p {
    color: #a09286;
    font-size: 9px;
    line-height: 1.5;
    margin: 0;
}

.quick-arrow {
    margin-left: auto;
    color: #d38a5b;
    font-size: 13px;
    flex-shrink: 0;
}

/* =====================================
   RECENT PRODUCTS TABLE
===================================== */

.recent-heading {
    margin-top: 35px;
}

.view-all {
    color: #df702c;
    font-size: 11px;
    font-weight: 800;
    text-decoration: none;
}

.view-all:hover {
    color: #a94415;
}

.recent-table-card {
    overflow: hidden;
    background: white;
    border: 1px solid #f2e5dc;
    border-radius: 13px;
}

.recent-table {
    min-width: 700px;
}

.recent-table thead th {
    padding: 15px 17px;
    background: #fff5ed;
    color: #a18b7b;
    font-size: 9px;
    font-weight: 800;
    letter-spacing: .8px;
    border-bottom: 1px solid #f1e3d8;
    white-space: nowrap;
}

.recent-table tbody td {
    padding: 14px 17px;
    color: #75675c;
    font-size: 11px;
    border-bottom: 1px solid #f6eee8;
}

.recent-table tbody tr:last-child td {
    border-bottom: 0;
}

.recent-table tbody tr:hover {
    background: #fffbf7;
}

.product-name {
    display: flex;
    align-items: center;
    gap: 9px;
    color: #4b382c;
}

.product-name strong {
    font-size: 11px;
}

.product-mini-icon {
    width: 32px;
    height: 32px;
    display: grid;
    place-items: center;
    background: #fff0e3;
    color: #e87932;
    border-radius: 8px;
}

.product-price {
    color: #d96822 !important;
    font-weight: 800;
    white-space: nowrap;
}

.status-badge {
    display: inline-block;
    padding: 5px 9px;
    border-radius: 20px;
    font-size: 9px;
    font-weight: 800;
    white-space: nowrap;
}

.status-active {
    color: #54805d;
    background: #e9f3e9;
}

.status-inactive {
    color: #a36b56;
    background: #f8eae3;
}

.empty-state {
    padding: 35px !important;
    text-align: center;
    color: #a99a8d !important;
}

.empty-state i {
    font-size: 25px;
    color: #e99a67;
}

.empty-state p {
    margin: 8px 0 0;
}

/* =====================================
   FOOTER
===================================== */

.dashboard-footer {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    padding: 23px 0 5px;
    margin-top: 25px;
    border-top: 1px solid #f0e3d9;
    color: #a39488;
    font-size: 10px;
}

.dashboard-footer i {
    color: #ed7542;
    font-size: 9px;
}

/* =====================================
   RESPONSIVE
===================================== */

@media (max-width: 1200px) {

    .stats-grid,
    .quick-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .welcome-decoration {
        right: 15px;
        opacity: .7;
    }

}

@media (max-width: 850px) {

    .admin-sidebar {
        width: 215px;
        min-width: 215px;
    }

    .dashboard-content {
        padding: 24px 20px;
    }

    .admin-topbar {
        padding: 15px 20px;
    }

    .topbar-date {
        display: none;
    }

}

@media (max-width: 600px) {

    .admin-dashboard {
        display: block;
    }

    .admin-sidebar {
        width: 100%;
        min-width: 0;
        padding: 15px;
    }

    .sidebar-brand {
        padding-bottom: 15px;
    }

    .sidebar-menu {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .sidebar-label {
        margin-top: 12px;
    }

    .sidebar-link {
        font-size: 11px;
        padding: 9px;
    }

    .sidebar-bottom {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .sidebar-profile {
        padding: 0;
    }

    .sidebar-bottom form {
        width: 110px;
    }

    .admin-topbar {
        min-height: 65px;
    }

    .topbar-user {
        display: none;
    }

    .dashboard-content {
        padding: 18px 14px;
    }

    .welcome-banner {
        min-height: 215px;
        padding: 23px 20px;
    }

    .welcome-banner p {
        max-width: 100%;
    }

    .welcome-decoration {
        opacity: .16;
        right: -60px;
    }

    .stats-grid,
    .quick-grid {
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .stat-card {
        padding: 14px;
    }

    .stat-card h2 {
        font-size: 24px;
    }

    .quick-card {
        align-items: flex-start;
        flex-wrap: wrap;
    }

    .quick-info {
        width: calc(100% - 50px);
    }

    .quick-arrow {
        display: none;
    }

    .section-heading h4 {
        font-size: 16px;
    }

    .overview-date {
        display: none;
    }

    .dashboard-footer {
        font-size: 9px;
    }

}

@media (max-width: 380px) {

    .stats-grid,
    .quick-grid {
        grid-template-columns: 1fr;
    }

    .welcome-banner h1 {
        font-size: 23px;
    }

}

</style>
@endpush
