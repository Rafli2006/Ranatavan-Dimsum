@extends('layouts.master')

@section('title', 'Data Kasir')

@section('content')

<div class="admin-dashboard category-dashboard">

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

            <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.kasir.index') }}" class="sidebar-link active">
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

            <a href="#" class="sidebar-link disabled-link">
                <i class="bi bi-boxes"></i>
                <span>Manajemen Stok</span>
                <small>Segera</small>
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

                <h5>Data Kasir</h5>
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

            {{-- PAGE BANNER --}}
            <section class="category-banner">

                <div class="category-banner-content">

                    <span class="category-tag">
                        <i class="bi bi-people-fill"></i>
                        MANAJEMEN PENGGUNA
                    </span>

                    <h1>Data Kasir</h1>

                    <p>
                        Kelola dan atur akun kasir Ranatavan Dimsum
                        dengan mudah melalui halaman ini.
                    </p>

                </div>

                <div class="category-banner-decoration">
                    👨‍🍳
                </div>

                <a href="{{ route('admin.kasir.create') }}"
                   class="add-category-button">
                    <i class="bi bi-plus-lg"></i>
                    Tambah Kasir
                </a>

            </section>

            {{-- NOTIFICATION --}}
            @if (session('success'))
                <div class="alert alert-success category-alert">
                    <i class="bi bi-check-circle-fill"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger category-alert">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger category-alert">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <div>
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mb-0 mt-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- SECTION HEADING --}}
            <div class="section-heading">

                <div>
                    <span class="section-eyebrow">OVERVIEW</span>
                    <h4>Ringkasan Data</h4>
                    <p>Informasi keseluruhan akun kasir Ranatavan Dimsum.</p>
                </div>

                <div class="overview-date">
                    <i class="bi bi-clock-history"></i>
                    Data saat ini
                </div>

            </div>

            {{-- STATISTICS --}}
            <div class="stats-grid kasir-stats-grid">

                <div class="stat-card">

                    <div class="stat-top">
                        <div class="stat-icon icon-orange">
                            <i class="bi bi-people-fill"></i>
                        </div>

                        <span class="stat-label">TOTAL KASIR</span>
                    </div>

                    <h2>{{ number_format($totalKasir) }}</h2>

                    <p>Total akun kasir terdaftar</p>

                    <a href="#daftar-kasir">
                        Lihat daftar kasir
                        <i class="bi bi-arrow-down"></i>
                    </a>

                </div>

                <div class="stat-card">

                    <div class="stat-top">
                        <div class="stat-icon icon-green">
                            <i class="bi bi-person-check-fill"></i>
                        </div>

                        <span class="stat-label">KASIR AKTIF</span>
                    </div>

                    <h2>{{ number_format($totalAktif) }}</h2>

                    <p>Akun kasir dapat login</p>

                    <a href="#daftar-kasir">
                        Lihat daftar kasir
                        <i class="bi bi-arrow-down"></i>
                    </a>

                </div>

                <div class="stat-card">

                    <div class="stat-top">
                        <div class="stat-icon icon-red">
                            <i class="bi bi-person-x-fill"></i>
                        </div>

                        <span class="stat-label">KASIR NONAKTIF</span>
                    </div>

                    <h2>{{ number_format($totalNonaktif) }}</h2>

                    <p>Akun kasir tidak dapat login</p>

                    <a href="#daftar-kasir">
                        Lihat daftar kasir
                        <i class="bi bi-arrow-down"></i>
                    </a>

                </div>

            </div>

            {{-- KASIR TABLE --}}
            <section class="category-table-card" id="daftar-kasir">

                <div class="table-card-heading">

                    <div class="table-heading-icon">
                        <i class="bi bi-list-ul"></i>
                    </div>

                    <div>
                        <h5>Daftar Akun Kasir</h5>
                        <p>
                            Informasi seluruh pengguna yang memiliki
                            hak akses sebagai kasir.
                        </p>
                    </div>

                </div>

                <div class="table-responsive">

                    <table class="table category-table kasir-table align-middle mb-0">

                        <thead>
                            <tr>
                                <th>NO.</th>
                                <th>NAMA KASIR</th>
                                <th>USERNAME</th>
                                <th>EMAIL</th>
                                <th>STATUS</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($kasirs as $index => $kasir)

                                <tr>

                                    <td>
                                        <span class="number-badge">
                                            {{ ($kasirs->firstItem() ?? 1) + $index }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="category-name">

                                            <div class="category-mini-icon">
                                                <i class="bi bi-person-fill"></i>
                                            </div>

                                            <strong>{{ $kasir->name }}</strong>

                                        </div>
                                    </td>

                                    <td>
                                        <span class="kasir-username">
                                            {{ $kasir->username ?? '-' }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="category-description">
                                            {{ $kasir->email }}
                                        </span>
                                    </td>

                                    <td>
                                        @if ($kasir->status === 'aktif')
                                            <span class="kasir-status status-active">
                                                <i class="bi bi-circle-fill"></i>
                                                Aktif
                                            </span>
                                        @else
                                            <span class="kasir-status status-inactive">
                                                <i class="bi bi-circle-fill"></i>
                                                Nonaktif
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="action-buttons">

                                            {{-- EDIT --}}
                                            <a href="{{ route('admin.kasir.edit', $kasir->id) }}"
                                               class="action-button edit-button">
                                                <i class="bi bi-pencil-square"></i>
                                                Edit
                                            </a>

                                            {{-- AKTIF / NONAKTIF --}}
                                            <form
                                                action="{{ route('admin.kasir.toggleStatus', $kasir->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin mengubah status akun kasir ini?')">

                                                @csrf
                                                @method('PATCH')

                                                @if ($kasir->status === 'aktif')
                                                    <button type="submit"
                                                            class="action-button status-disable">
                                                        <i class="bi bi-person-x-fill"></i>
                                                        Nonaktifkan
                                                    </button>
                                                @else
                                                    <button type="submit"
                                                            class="action-button status-enable">
                                                        <i class="bi bi-person-check-fill"></i>
                                                        Aktifkan
                                                    </button>
                                                @endif

                                            </form>

                                            {{-- HAPUS --}}
                                            <button type="button"
                                                    class="action-button delete-button"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#hapusKasir{{ $kasir->id }}">
                                                <i class="bi bi-trash3"></i>
                                                Hapus
                                            </button>

                                        </div>

                                        {{-- MODAL HAPUS --}}
                                        <div class="modal fade"
                                             id="hapusKasir{{ $kasir->id }}"
                                             tabindex="-1"
                                             aria-hidden="true">

                                            <div class="modal-dialog modal-dialog-centered">

                                                <div class="modal-content border-0 rounded-4">

                                                    <div class="modal-body text-center p-4">

                                                        <div class="delete-icon">
                                                            <i class="bi bi-trash3-fill"></i>
                                                        </div>

                                                        <h5 class="delete-title">
                                                            Hapus Akun Kasir?
                                                        </h5>

                                                        <p class="delete-description">
                                                            Apakah kamu yakin ingin menghapus akun
                                                            <strong>{{ $kasir->name }}</strong>?
                                                            Tindakan ini tidak dapat dibatalkan.
                                                        </p>

                                                        <div class="d-flex justify-content-center gap-2">

                                                            <button type="button"
                                                                    class="btn-cancel"
                                                                    data-bs-dismiss="modal">
                                                                Batal
                                                            </button>

                                                            <form action="{{ route('admin.kasir.destroy', $kasir->id) }}"
                                                                  method="POST">

                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit"
                                                                        class="btn-confirm-delete">
                                                                    <i class="bi bi-trash"></i>
                                                                    Ya, Hapus
                                                                </button>

                                                            </form>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="6">

                                        <div class="empty-state">
                                            <i class="bi bi-people"></i>

                                            <h6>Belum Ada Data Kasir</h6>

                                            <p>
                                                Silakan tambahkan akun kasir
                                                pertama kamu.
                                            </p>

                                            <a href="{{ route('admin.kasir.create') }}"
                                               class="add-category-button empty-add-button">
                                                <i class="bi bi-plus-lg"></i>
                                                Tambah Kasir
                                            </a>
                                        </div>

                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{-- PAGINATION --}}
                @if ($kasirs->hasPages())

                    <div class="category-pagination">

                        <div class="pagination-info">
                            Menampilkan
                            <strong>{{ $kasirs->firstItem() }}</strong>
                            sampai
                            <strong>{{ $kasirs->lastItem() }}</strong>
                            dari
                            <strong>{{ $kasirs->total() }}</strong>
                            kasir
                        </div>

                        <div>
                            {{ $kasirs->links() }}
                        </div>

                    </div>

                @endif

            </section>

            {{-- FOOTER --}}
            <footer class="dashboard-footer">

                <span>
                    © {{ date('Y') }} Ranatavan Dimsum
                </span>

                <span>
                    Made with <i class="bi bi-heart-fill"></i>
                    for delicious moments
                </span>

            </footer>

        </div>

    </main>

</div>

@endsection

@push('styles')
<style>

/* =====================================
   DATA KASIR
   Mengikuti desain Data Kategori
===================================== */

.category-dashboard {
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

/* SIDEBAR */

.category-dashboard .admin-sidebar {
    width: 258px;
    min-width: 258px;
    background: #fff;
    border-right: 1px solid #f4e5d9;
    padding: 27px 17px 18px;
    display: flex;
    flex-direction: column;
}

.category-dashboard .sidebar-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 0 9px 30px;
}

.category-dashboard .brand-icon {
    width: 47px;
    height: 47px;
    border-radius: 15px;
    display: grid;
    place-items: center;
    background: linear-gradient(135deg, #ff9d52, #f07828);
    font-size: 26px;
    box-shadow: 0 5px 12px rgba(240,120,40,.2);
}

.category-dashboard .sidebar-brand h5 {
    font-family: 'Playfair Display', Georgia, serif;
    font-weight: 700;
    font-size: 19px;
    margin: 0;
    color: var(--brown);
}

.category-dashboard .sidebar-brand span {
    display: block;
    color: #b58b70;
    font-size: 9px;
    letter-spacing: 1.4px;
    margin-top: 3px;
    font-weight: 800;
}

.category-dashboard .sidebar-label {
    padding: 0 11px;
    color: #b5a49a;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1.5px;
    margin-bottom: 10px;
}

.category-dashboard .sidebar-menu {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.category-dashboard .sidebar-link {
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

.category-dashboard .sidebar-link i {
    font-size: 17px;
    width: 20px;
    text-align: center;
}

.category-dashboard .sidebar-link:hover {
    background: #fff1e5;
    color: var(--orange-dark);
}

.category-dashboard .sidebar-link.active {
    background: linear-gradient(110deg, #f07828, #ff9d52);
    color: white;
    box-shadow: 0 6px 14px rgba(240,120,40,.22);
}

.category-dashboard .disabled-link {
    opacity: .45;
    cursor: not-allowed;
    pointer-events: none;
}

.category-dashboard .disabled-link small {
    margin-left: auto;
    font-size: 9px;
    background: #f5eee8;
    padding: 3px 6px;
    border-radius: 5px;
}

.category-dashboard .sidebar-bottom {
    margin-top: auto;
    padding-top: 20px;
    border-top: 1px solid #f1e7df;
}

.category-dashboard .sidebar-profile {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 0 5px 16px;
}

.category-dashboard .profile-avatar,
.category-dashboard .topbar-avatar {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    display: grid;
    place-items: center;
    background: #ffead8;
    color: var(--orange-dark);
    font-weight: 800;
}

.category-dashboard .profile-info strong,
.category-dashboard .topbar-user strong {
    display: block;
    font-size: 12px;
    color: var(--brown);
}

.category-dashboard .profile-info span,
.category-dashboard .topbar-user span {
    display: block;
    color: #a08f82;
    font-size: 10px;
    margin-top: 3px;
}

.category-dashboard .logout-button {
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

.category-dashboard .logout-button i {
    margin-right: 8px;
}

.category-dashboard .logout-button:hover {
    background: #fff1e5;
    border-color: #f3b18a;
    color: #b94723;
}

/* MAIN AND TOPBAR */

.category-dashboard .admin-main {
    flex: 1;
    min-width: 0;
}

.category-dashboard .admin-topbar {
    min-height: 83px;
    background: white;
    border-bottom: 1px solid #f4e5d9;
    padding: 15px 36px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.category-dashboard .topbar-caption {
    font-size: 9px;
    letter-spacing: 1.4px;
    color: #bd9278;
    font-weight: 800;
    margin-bottom: 5px;
}

.category-dashboard .admin-topbar h5 {
    margin: 0;
    color: var(--brown);
    font-size: 19px;
    font-weight: 800;
}

.category-dashboard .topbar-right {
    display: flex;
    align-items: center;
    gap: 25px;
}

.category-dashboard .topbar-date {
    color: #8e7e72;
    font-size: 12px;
}

.category-dashboard .topbar-date i {
    margin-right: 6px;
    color: var(--orange);
}

.category-dashboard .topbar-user {
    display: flex;
    align-items: center;
    gap: 9px;
    padding-left: 20px;
    border-left: 1px solid #f1e7df;
}

.category-dashboard .topbar-avatar {
    width: 36px;
    height: 36px;
}

/* CONTENT */

.category-dashboard .dashboard-content {
    padding: 30px 36px;
    max-width: 1600px;
    margin: auto;
}

/* BANNER */

.category-banner {
    position: relative;
    overflow: hidden;
    min-height: 174px;
    border-radius: 19px;
    padding: 28px 30px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: linear-gradient(110deg, #fff 45%, #fff0e3);
    border: 1px solid #f3e4d8;
    box-shadow: 0 8px 20px rgba(120,65,30,.035);
}

.category-banner-content {
    position: relative;
    z-index: 2;
}

.category-tag {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    color: var(--orange);
    font-size: 9px;
    font-weight: 800;
    letter-spacing: 1.5px;
    margin-bottom: 10px;
}

.category-banner h1 {
    color: var(--brown);
    font-size: 28px;
    font-weight: 800;
    margin: 0 0 8px;
}

.category-banner p {
    color: #9a8b80;
    font-size: 12px;
    margin: 0;
}

.category-banner-decoration {
    position: absolute;
    right: 34%;
    top: 50%;
    transform: translateY(-50%) rotate(-15deg);
    font-size: 95px;
    opacity: .055;
}

.add-category-button {
    position: relative;
    z-index: 2;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    padding: 13px 19px;
    border: none;
    border-radius: 10px;
    background: linear-gradient(110deg, #f07828, #ff9d52);
    color: white;
    font-size: 11px;
    font-weight: 800;
    text-decoration: none;
    box-shadow: 0 6px 14px rgba(240,120,40,.18);
    transition: .2s;
    white-space: nowrap;
}

.add-category-button:hover {
    background: linear-gradient(110deg, #d95d16, #f07828);
    color: white;
    transform: translateY(-2px);
}

/* ALERT */

.category-alert {
    margin-top: 18px;
    border-radius: 10px;
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 12px;
}

/* SECTION HEADING */

.category-dashboard .section-heading {
    display: flex;
    justify-content: space-between;
    align-items: end;
    margin: 31px 0 17px;
}

.category-dashboard .section-eyebrow {
    display: block;
    color: var(--orange);
    font-size: 9px;
    font-weight: 800;
    letter-spacing: 1.5px;
    margin-bottom: 5px;
}

.category-dashboard .section-heading h4 {
    color: var(--brown);
    font-size: 18px;
    font-weight: 800;
    margin: 0 0 5px;
}

.category-dashboard .section-heading p {
    color: #9a8b80;
    font-size: 11px;
    margin: 0;
}

.category-dashboard .overview-date {
    color: #a18c7d;
    background: white;
    border: 1px solid #f2e4d9;
    padding: 8px 12px;
    border-radius: 8px;
    font-size: 10px;
}

.category-dashboard .overview-date i {
    color: var(--orange);
    margin-right: 5px;
}

/* STATISTICS */

.category-dashboard .stats-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 16px;
}

.category-dashboard .stat-card {
    position: relative;
    overflow: hidden;
    background: white;
    border: 1px solid #f3e6dc;
    border-radius: 14px;
    padding: 19px;
    min-width: 0;
    transition: .2s;
}

.category-dashboard .stat-card::after {
    content: '';
    position: absolute;
    width: 75px;
    height: 75px;
    border-radius: 50%;
    background: #fff5ed;
    right: -25px;
    bottom: -35px;
}

.category-dashboard .stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 22px rgba(120,65,30,.08);
    border-color: #f3c6a8;
}

.category-dashboard .stat-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.category-dashboard .stat-icon {
    width: 42px;
    height: 42px;
    display: grid;
    place-items: center;
    border-radius: 12px;
    font-size: 19px;
}

.category-dashboard .stat-label {
    color: #b1a397;
    font-size: 9px;
    font-weight: 800;
    letter-spacing: 1px;
}

.category-dashboard .icon-orange {
    background: #ffeadb;
    color: #e96d22;
}

.category-dashboard .icon-green {
    background: #eaf2e5;
    color: #718b5c;
}

.category-dashboard .icon-red {
    background: #f9e9e5;
    color: #b64c3f;
}

.category-dashboard .stat-card h2 {
    color: #493125;
    font-size: 29px;
    font-weight: 800;
    margin: 16px 0 2px;
}

.category-dashboard .stat-card p {
    color: #9b8d82;
    font-size: 11px;
    margin: 0 0 15px;
}

.category-dashboard .stat-card > a {
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

/* TABLE CARD */

.category-table-card {
    margin-top: 25px;
    overflow: hidden;
    background: white;
    border: 1px solid #f2e5dc;
    border-radius: 15px;
}

.table-card-heading {
    display: flex;
    align-items: center;
    gap: 13px;
    padding: 21px 20px;
}

.table-heading-icon {
    width: 44px;
    height: 44px;
    flex-shrink: 0;
    display: grid;
    place-items: center;
    background: #fff0e3;
    color: #e87932;
    border-radius: 12px;
    font-size: 19px;
}

.table-card-heading h5 {
    color: #493125;
    font-size: 14px;
    font-weight: 800;
    margin: 0 0 5px;
}

.table-card-heading p {
    color: #9a8b80;
    font-size: 10px;
    margin: 0;
}

/* TABLE */

.category-table {
    min-width: 850px;
    margin: 0;
}

.category-table thead th {
    padding: 16px 13px;
    background: #fff5ed;
    color: #a18b7b;
    font-size: 9px;
    font-weight: 800;
    letter-spacing: .8px;
    border-bottom: 1px solid #f1e3d8;
    white-space: nowrap;
}

.category-table tbody td {
    padding: 15px 13px;
    color: #75675c;
    font-size: 11px;
    border-bottom: 1px solid #f6eee8;
    vertical-align: middle;
}

.category-table tbody tr:last-child td {
    border-bottom: 0;
}

.category-table tbody tr:hover {
    background: #fffbf7;
}

.number-badge {
    width: 30px;
    height: 30px;
    display: inline-grid;
    place-items: center;
    background: #fff0e3;
    color: #e96d22;
    border-radius: 9px;
    font-size: 10px;
    font-weight: 800;
}

.category-name {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #49372b;
    min-width: 150px;
}

.category-name strong {
    font-size: 11px;
}

.category-mini-icon {
    width: 37px;
    height: 37px;
    display: grid;
    place-items: center;
    background: #fff0e3;
    color: #e87932;
    border-radius: 10px;
    font-size: 16px;
    flex-shrink: 0;
}

.category-description {
    color: #9a8b80;
    line-height: 1.5;
}

/* STATUS KASIR */

.kasir-table {
    min-width: 950px;
}

.kasir-username {
    color: #806b5b;
    font-weight: 600;
}

.kasir-status {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 11px;
    border-radius: 20px;
    font-size: 10px;
    font-weight: 800;
    white-space: nowrap;
}

.kasir-status i {
    font-size: 6px;
}

.status-active {
    background: #eaf2e5;
    color: #718b5c;
}

.status-inactive {
    background: #fff0ee;
    color: #c45b4e;
}

/* ACTION BUTTONS */

.action-buttons {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 7px;
    flex-wrap: wrap;
}

.action-buttons form {
    margin: 0;
}

.action-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    padding: 9px 11px;
    border: none;
    border-radius: 9px;
    font-size: 10px;
    font-weight: 800;
    text-decoration: none;
    transition: .2s;
    white-space: nowrap;
    cursor: pointer;
}

.edit-button {
    background: #fff0e3;
    color: #e87932;
}

.edit-button:hover {
    background: #ffe0c8;
    color: #bd5317;
    transform: translateY(-2px);
}

.delete-button {
    background: #fff0ee;
    color: #d65c50;
}

.delete-button:hover {
    background: #ffe0dc;
    color: #b9382c;
    transform: translateY(-2px);
}

.status-disable {
    background: #fff0ee;
    color: #c45b4e;
}

.status-disable:hover {
    background: #ffe0dc;
    color: #b9382c;
}

.status-enable {
    background: #eaf2e5;
    color: #718b5c;
}

.status-enable:hover {
    background: #dcebd3;
    color: #506e3d;
}

/* EMPTY STATE */

.empty-state {
    padding: 45px 20px;
    text-align: center;
    color: #a99a8d;
}

.empty-state > i {
    font-size: 35px;
    color: #e99a67;
}

.empty-state h6 {
    margin: 12px 0 5px;
    color: #49372b;
    font-size: 14px;
    font-weight: 800;
}

.empty-state p {
    font-size: 11px;
    margin-bottom: 16px;
}

.empty-add-button {
    display: inline-flex;
}

/* PAGINATION */

.category-pagination {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    padding: 17px 20px;
    border-top: 1px solid #f4e8df;
}

.pagination-info {
    color: #9a8b80;
    font-size: 10px;
}

.pagination-info strong {
    color: #713d25;
}

.category-pagination .pagination {
    margin: 0;
}

.category-pagination .page-link {
    color: #d96b27;
    border-color: #f2e4d9;
    font-size: 11px;
}

.category-pagination .page-item.active .page-link {
    background: #f07828;
    border-color: #f07828;
    color: white;
}

/* DELETE MODAL */

.delete-icon {
    width: 70px;
    height: 70px;
    margin: 0 auto 17px;
    border-radius: 50%;
    background: #fff0ee;
    color: #d65c50;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
}

.delete-title {
    color: #493125;
    font-weight: 800;
    font-size: 17px;
}

.delete-description {
    color: #978577;
    font-size: 12px;
    line-height: 1.7;
    margin-bottom: 22px;
}

.btn-cancel,
.btn-confirm-delete {
    padding: 10px 17px;
    border: none;
    border-radius: 8px;
    font-size: 11px;
    font-weight: 700;
}

.btn-cancel {
    background: #f4e9dd;
    color: #70452c;
}

.btn-confirm-delete {
    background: #b64c3f;
    color: white;
}

/* FOOTER */

.category-dashboard .dashboard-footer {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    padding: 23px 0 5px;
    margin-top: 25px;
    border-top: 1px solid #f0e3d9;
    color: #a39488;
    font-size: 10px;
}

.category-dashboard .dashboard-footer i {
    color: #ed7542;
    font-size: 9px;
}

/* RESPONSIVE */

@media (max-width: 1200px) {
    .category-dashboard .stats-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 850px) {
    .category-dashboard .admin-sidebar {
        width: 215px;
        min-width: 215px;
    }

    .category-dashboard .dashboard-content {
        padding: 24px 20px;
    }

    .category-dashboard .admin-topbar {
        padding: 15px 20px;
    }

    .category-dashboard .topbar-date {
        display: none;
    }
}

@media (max-width: 600px) {
    .category-dashboard {
        display: block;
    }

    .category-dashboard .admin-sidebar {
        width: 100%;
        min-width: 0;
        padding: 15px;
    }

    .category-dashboard .sidebar-brand {
        padding-bottom: 15px;
    }

    .category-dashboard .sidebar-menu {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .category-dashboard .sidebar-label {
        margin-top: 12px;
    }

    .category-dashboard .sidebar-link {
        font-size: 11px;
        padding: 9px;
    }

    .category-dashboard .sidebar-bottom {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .category-dashboard .sidebar-profile {
        padding: 0;
    }

    .category-dashboard .sidebar-bottom form {
        width: 110px;
    }

    .category-dashboard .admin-topbar {
        min-height: 65px;
    }

    .category-dashboard .topbar-user {
        display: none;
    }

    .category-dashboard .dashboard-content {
        padding: 18px 14px;
    }

    .category-banner {
        min-height: 190px;
        align-items: flex-start;
        flex-direction: column;
        gap: 17px;
        padding: 22px 20px;
    }

    .category-banner h1 {
        font-size: 23px;
    }

    .category-banner-decoration {
        right: 10px;
        top: 25%;
        font-size: 65px;
    }

    .category-dashboard .stats-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
    }

    .category-dashboard .stat-card {
        padding: 14px;
    }

    .category-dashboard .stat-card h2 {
        font-size: 24px;
    }

    .category-dashboard .section-heading h4 {
        font-size: 16px;
    }

    .category-dashboard .overview-date {
        display: none;
    }

    .category-pagination {
        justify-content: center;
    }

    .category-dashboard .dashboard-footer {
        font-size: 9px;
    }
}

@media (max-width: 380px) {
    .category-dashboard .stats-grid {
        grid-template-columns: 1fr;
    }

    .category-dashboard .dashboard-footer {
        flex-direction: column;
    }
}

</style>
@endpush
