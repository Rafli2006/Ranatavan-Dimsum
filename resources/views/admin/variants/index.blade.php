@extends('layouts.master')

@section('title', 'Data Varian')

@section('content')

<div class="admin-dashboard variant-dashboard">

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

            <a href="{{ route('admin.kasir.index') }}" class="sidebar-link">
                <i class="bi bi-people"></i>
                <span>Data Kasir</span>
            </a>

            <a href="{{ route('admin.kategori.index') }}" class="sidebar-link">
                <i class="bi bi-tags"></i>
                <span>Data Kategori</span>
            </a>

            <a href="{{ route('admin.varian.index') }}" class="sidebar-link active">
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

    {{-- MAIN --}}
    <main class="admin-main">

        {{-- TOPBAR --}}
        <header class="admin-topbar">
            <div>
                <div class="topbar-caption">RANATAVAN DIMSUM / ADMIN</div>
                <h5>Data Varian</h5>
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

            {{-- BREADCRUMB --}}
            <div class="breadcrumb-custom">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <i class="bi bi-chevron-right"></i>
                <span>Data Varian</span>
            </div>

            {{-- NOTIFIKASI --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show form-alert">
                    <i class="bi bi-check-circle-fill"></i>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show form-alert">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <div>{{ session('error') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- BANNER --}}
            <section class="variant-banner">
                <div class="banner-content">
                    <span class="banner-tag">
                        <i class="bi bi-grid"></i>
                        VARIANT MANAGEMENT
                    </span>

                    <h1>Kelola Varian Produk</h1>

                    <p>
                        Atur berbagai varian produk berdasarkan kategori
                        agar pengelolaan Ranatavan Dimsum lebih mudah
                        dan terstruktur.
                    </p>
                </div>

                <div class="banner-decoration">🏷️</div>
            </section>

            {{-- RINGKASAN --}}
            <div class="section-heading">
                <div>
                    <h5>Ringkasan Data</h5>
                    <p>Informasi jumlah data dalam pengelolaan varian.</p>
                </div>
            </div>

            <div class="row g-3 mb-4">

                <div class="col-sm-6 col-xl-4">
                    <div class="stat-card">
                        <div class="stat-icon orange-icon">
                            <i class="bi bi-grid"></i>
                        </div>
                        <div>
                            <p>Total Varian</p>
                            <h3>{{ $variants->total() }}</h3>
                            <small>Varian terdaftar</small>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-4">
                    <div class="stat-card">
                        <div class="stat-icon peach-icon">
                            <i class="bi bi-tags"></i>
                        </div>
                        <div>
                            <p>Total Kategori</p>
                            <h3>{{ \App\Models\Category::count() }}</h3>
                            <small>Kategori tersedia</small>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-4">
                    <div class="stat-card">
                        <div class="stat-icon green-icon">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <div>
                            <p>Total Produk</p>
                            <h3>{{ \App\Models\Product::count() }}</h3>
                            <small>Produk terdaftar</small>
                        </div>
                    </div>
                </div>

            </div>

            {{-- DAFTAR VARIAN --}}
            <section class="content-card">

                <div class="content-card-heading">
                    <div>
                        <div class="card-heading-icon">
                            <i class="bi bi-grid"></i>
                        </div>
                        <div>
                            <h5>Daftar Varian</h5>
                            <p>Daftar seluruh varian berdasarkan kategori produk.</p>
                        </div>
                    </div>

                    <a href="{{ route('admin.varian.create') }}" class="add-button">
                        <i class="bi bi-plus-circle"></i>
                        Tambah Varian
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table variant-table align-middle">

                        <thead>
                            <tr>
                                <th width="65">No</th>
                                <th>Kategori</th>
                                <th>Nama Varian</th>
                                <th>Jumlah Produk</th>
                                <th width="180" class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($variants as $variant)
                                <tr>
                                    <td class="number-cell">
                                        {{ $variants->firstItem() + $loop->index }}
                                    </td>

                                    <td>
                                        <span class="category-badge">
                                            <i class="bi bi-tag-fill"></i>
                                            {{ $variant->category->name ?? '-' }}
                                        </span>
                                    </td>

                                    <td>
                                        <strong class="variant-name">
                                            {{ $variant->name }}
                                        </strong>
                                    </td>

                                    <td>
                                        <span class="product-count">
                                            <i class="bi bi-box-seam"></i>
                                            {{ $variant->products_count }} Produk
                                        </span>
                                    </td>

                                    <td>
                                        <div class="action-buttons">

                                            <a href="{{ route('admin.varian.edit', $variant->id) }}"
                                               class="action-edit">
                                                <i class="bi bi-pencil-square"></i>
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.varian.destroy', $variant->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus varian ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="action-delete">
                                                    <i class="bi bi-trash"></i>
                                                    Hapus
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="empty-state">
                                            <div class="empty-icon">
                                                <i class="bi bi-grid"></i>
                                            </div>

                                            <h6>Belum Ada Data Varian</h6>

                                            <p>
                                                Silakan tambahkan varian produk
                                                terlebih dahulu.
                                            </p>

                                            <a href="{{ route('admin.varian.create') }}"
                                               class="add-button">
                                                <i class="bi bi-plus-circle"></i>
                                                Tambah Varian
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

                {{-- PAGINATION --}}
                @if($variants->hasPages())
                    <div class="pagination-wrapper">
                        {{ $variants->links() }}
                    </div>
                @endif

                <div class="table-footer">
                    Menampilkan {{ $variants->firstItem() ?? 0 }}
                    sampai {{ $variants->lastItem() ?? 0 }}
                    dari {{ $variants->total() }} data varian
                </div>

            </section>

            {{-- FOOTER --}}
            <footer class="dashboard-footer">
                <span>© {{ date('Y') }} Ranatavan Dimsum</span>
                <span>Made with <i class="bi bi-heart-fill"></i> for delicious moments</span>
            </footer>

        </div>
    </main>
</div>

@endsection

@push('styles')
<style>

/* =====================================
   VARIANT DASHBOARD
===================================== */

.variant-dashboard {
    --orange: #f07828;
    --orange-dark: #d95d16;
    --light-orange: #ff9d52;
    --peach: #fff1e5;
    --brown: #713d25;

    min-height: 100vh;
    display: flex;
    background: #fff9f4;
    color: #38271f;
    font-family: 'DM Sans', Arial, sans-serif;

    /* PERBAIKAN: menghilangkan jarak atas */
    margin-top: -24px;
}

/* SIDEBAR */

.variant-dashboard .admin-sidebar {
    width: 258px;
    min-width: 258px;
    background: #fff;
    border-right: 1px solid #f4e5d9;
    padding: 27px 17px 18px;
    display: flex;
    flex-direction: column;
}

.variant-dashboard .sidebar-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 0 9px 30px;
}

.variant-dashboard .brand-icon {
    width: 47px;
    height: 47px;
    border-radius: 15px;
    display: grid;
    place-items: center;
    background: linear-gradient(135deg, #ff9d52, #f07828);
    font-size: 26px;
    box-shadow: 0 5px 12px rgba(240,120,40,.2);
}

.variant-dashboard .sidebar-brand h5 {
    font-family: 'Playfair Display', Georgia, serif;
    font-weight: 700;
    font-size: 19px;
    margin: 0;
    color: var(--brown);
}

.variant-dashboard .sidebar-brand span {
    display: block;
    color: #b58b70;
    font-size: 9px;
    letter-spacing: 1.4px;
    margin-top: 3px;
    font-weight: 800;
}

.variant-dashboard .sidebar-label {
    padding: 0 11px;
    color: #b5a49a;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1.5px;
    margin-bottom: 10px;
}

.variant-dashboard .sidebar-menu {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.variant-dashboard .sidebar-link {
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
    transition: .2s;
}

.variant-dashboard .sidebar-link i {
    font-size: 17px;
    width: 20px;
    text-align: center;
}

.variant-dashboard .sidebar-link:hover {
    background: #fff1e5;
    color: var(--orange-dark);
}

.variant-dashboard .sidebar-link.active {
    background: linear-gradient(110deg, #f07828, #ff9d52);
    color: white;
    box-shadow: 0 6px 14px rgba(240,120,40,.22);
}

.variant-dashboard .disabled-link {
    opacity: .45;
    pointer-events: none;
}

.variant-dashboard .disabled-link small {
    margin-left: auto;
    font-size: 9px;
    background: #f5eee8;
    padding: 3px 6px;
    border-radius: 5px;
}

.variant-dashboard .sidebar-bottom {
    margin-top: auto;
    padding-top: 20px;
    border-top: 1px solid #f1e7df;
}

.variant-dashboard .sidebar-profile {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 0 5px 16px;
}

.variant-dashboard .profile-avatar,
.variant-dashboard .topbar-avatar {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    display: grid;
    place-items: center;
    background: #ffead8;
    color: var(--orange-dark);
    font-weight: 800;
}

.variant-dashboard .profile-info strong,
.variant-dashboard .topbar-user strong {
    display: block;
    font-size: 12px;
    color: var(--brown);
}

.variant-dashboard .profile-info span,
.variant-dashboard .topbar-user span {
    display: block;
    color: #a08f82;
    font-size: 10px;
    margin-top: 3px;
}

.variant-dashboard .logout-button {
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

.variant-dashboard .logout-button i {
    margin-right: 8px;
}

.variant-dashboard .logout-button:hover {
    background: #fff1e5;
    border-color: #f3b18a;
}

/* MAIN & TOPBAR */

.variant-dashboard .admin-main {
    flex: 1;
    min-width: 0;
}

.variant-dashboard .admin-topbar {
    min-height: 83px;
    background: white;
    border-bottom: 1px solid #f4e5d9;
    padding: 15px 36px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.variant-dashboard .topbar-caption {
    font-size: 9px;
    letter-spacing: 1.4px;
    color: #bd9278;
    font-weight: 800;
    margin-bottom: 5px;
}

.variant-dashboard .admin-topbar h5 {
    margin: 0;
    color: var(--brown);
    font-size: 19px;
    font-weight: 800;
}

.variant-dashboard .topbar-right {
    display: flex;
    align-items: center;
    gap: 25px;
}

.variant-dashboard .topbar-date {
    color: #8e7e72;
    font-size: 12px;
}

.variant-dashboard .topbar-date i {
    margin-right: 6px;
    color: var(--orange);
}

.variant-dashboard .topbar-user {
    display: flex;
    align-items: center;
    gap: 9px;
    padding-left: 20px;
    border-left: 1px solid #f1e7df;
}

.variant-dashboard .topbar-avatar {
    width: 36px;
    height: 36px;
}

/* CONTENT */

.variant-dashboard .dashboard-content {
    padding: 30px 36px;
    max-width: 1600px;
    margin: auto;
}

/* BREADCRUMB */

.variant-dashboard .breadcrumb-custom {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 9px;
    margin-bottom: 20px;
    font-size: 11px;
    color: #a39488;
}

.variant-dashboard .breadcrumb-custom a {
    color: #d9793b;
    text-decoration: none;
}

.variant-dashboard .breadcrumb-custom a:hover {
    color: #bd5317;
}

.variant-dashboard .breadcrumb-custom i {
    font-size: 9px;
}

/* BANNER */

.variant-dashboard .variant-banner {
    position: relative;
    overflow: hidden;
    min-height: 165px;
    border-radius: 19px;
    padding: 27px 30px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: linear-gradient(110deg, #fff 45%, #fff0e3);
    border: 1px solid #f3e4d8;
    margin-bottom: 27px;
}

.variant-dashboard .banner-content {
    position: relative;
    z-index: 2;
}

.variant-dashboard .banner-tag {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    color: var(--orange);
    font-size: 9px;
    font-weight: 800;
    letter-spacing: 1.5px;
    margin-bottom: 10px;
}

.variant-dashboard .variant-banner h1 {
    color: var(--brown);
    font-size: 27px;
    font-weight: 800;
    margin: 0 0 8px;
}

.variant-dashboard .variant-banner p {
    color: #9a8b80;
    font-size: 12px;
    max-width: 570px;
    line-height: 1.7;
    margin: 0;
}

.variant-dashboard .banner-decoration {
    position: absolute;
    right: 8%;
    top: 50%;
    transform: translateY(-50%) rotate(-12deg);
    font-size: 95px;
    opacity: .09;
}

/* SECTION HEADING */

.variant-dashboard .section-heading {
    margin-bottom: 15px;
}

.variant-dashboard .section-heading h5 {
    color: var(--brown);
    font-size: 15px;
    font-weight: 800;
    margin-bottom: 4px;
}

.variant-dashboard .section-heading p {
    color: #a28b7c;
    font-size: 11px;
    margin: 0;
}

/* STAT CARDS */

.variant-dashboard .stat-card {
    height: 100%;
    min-height: 105px;
    background: white;
    border: 1px solid #f3e7dc;
    border-radius: 14px;
    padding: 19px 17px;
    display: flex;
    align-items: center;
    gap: 14px;
    box-shadow: 0 4px 15px rgba(113,61,37,.035);
    transition: .2s;
}

.variant-dashboard .stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(113,61,37,.08);
}

.variant-dashboard .stat-icon {
    width: 47px;
    min-width: 47px;
    height: 47px;
    border-radius: 13px;
    display: grid;
    place-items: center;
    font-size: 21px;
}

.variant-dashboard .orange-icon {
    background: #fff0e3;
    color: #e87932;
}

.variant-dashboard .peach-icon {
    background: #fff4e9;
    color: #c88742;
}

.variant-dashboard .green-icon {
    background: #eaf4e8;
    color: #58834f;
}

.variant-dashboard .stat-card p {
    color: #9d8b7e;
    font-size: 11px;
    margin-bottom: 4px;
}

.variant-dashboard .stat-card h3 {
    color: var(--brown);
    font-size: 23px;
    font-weight: 800;
    margin-bottom: 2px;
}

.variant-dashboard .stat-card small {
    color: #b2a297;
    font-size: 10px;
}

/* CONTENT CARD */

.variant-dashboard .content-card {
    background: white;
    border: 1px solid #f2e5dc;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 5px 18px rgba(120,65,30,.035);
}

.variant-dashboard .content-card-heading {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
    padding-bottom: 20px;
    margin-bottom: 18px;
    border-bottom: 1px solid #f2e8e0;
}

.variant-dashboard .content-card-heading > div {
    display: flex;
    align-items: center;
    gap: 12px;
}

.variant-dashboard .card-heading-icon {
    width: 43px;
    height: 43px;
    border-radius: 12px;
    display: grid;
    place-items: center;
    background: #fff0e3;
    color: #e87932;
    font-size: 19px;
}

.variant-dashboard .content-card-heading h5 {
    color: #493125;
    font-size: 14px;
    font-weight: 800;
    margin: 0 0 5px;
}

.variant-dashboard .content-card-heading p {
    color: #9a8b80;
    font-size: 10px;
    margin: 0;
}

.variant-dashboard .add-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 11px 16px;
    border: none;
    border-radius: 9px;
    background: linear-gradient(110deg, #f07828, #ff9d52);
    color: white;
    text-decoration: none;
    font-size: 11px;
    font-weight: 800;
    box-shadow: 0 5px 12px rgba(240,120,40,.18);
    transition: .2s;
}

.variant-dashboard .add-button:hover {
    background: linear-gradient(110deg, #d95d16, #f07828);
    color: white;
    transform: translateY(-2px);
}

/* TABLE */

.variant-dashboard .variant-table {
    margin-bottom: 0;
}

.variant-dashboard .variant-table thead th {
    background: #fff3e9;
    color: #9a552f;
    font-size: 10px;
    font-weight: 800;
    padding: 14px 13px;
    white-space: nowrap;
    border-bottom: 1px solid #f4dfce;
}

.variant-dashboard .variant-table td {
    padding: 14px 13px;
    font-size: 11px;
    color: #745b4a;
    border-color: #f5eee8;
}

.variant-dashboard .variant-table tbody tr {
    transition: .2s;
}

.variant-dashboard .variant-table tbody tr:hover {
    background: #fffaf6;
}

.variant-dashboard .number-cell {
    color: #a39488 !important;
    font-weight: 700;
}

.variant-dashboard .variant-name {
    color: #713d25;
    font-size: 12px;
}

.variant-dashboard .category-badge,
.variant-dashboard .product-count {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 10px;
    border-radius: 20px;
    font-size: 10px;
    font-weight: 700;
    white-space: nowrap;
}

.variant-dashboard .category-badge {
    background: #fff0e4;
    color: #c3652d;
}

.variant-dashboard .product-count {
    background: #eaf4e8;
    color: #56804e;
}

/* ACTION BUTTONS */

.variant-dashboard .action-buttons {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 6px;
}

.variant-dashboard .action-edit,
.variant-dashboard .action-delete {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    padding: 7px 9px;
    border: none;
    border-radius: 7px;
    text-decoration: none;
    font-size: 10px;
    font-weight: 700;
    white-space: nowrap;
    cursor: pointer;
    transition: .2s;
}

.variant-dashboard .action-edit {
    background: #fff0d8;
    color: #a66b18;
}

.variant-dashboard .action-edit:hover {
    background: #f9dfad;
    color: #80500d;
}

.variant-dashboard .action-delete {
    background: #ffeded;
    color: #c34c43;
}

.variant-dashboard .action-delete:hover {
    background: #fbd4d1;
    color: #9d3029;
}

/* EMPTY STATE */

.variant-dashboard .empty-state {
    text-align: center;
    padding: 38px 15px;
}

.variant-dashboard .empty-icon {
    width: 65px;
    height: 65px;
    display: grid;
    place-items: center;
    margin: 0 auto 14px;
    border-radius: 20px;
    background: #fff0e3;
    color: #ed985d;
    font-size: 28px;
}

.variant-dashboard .empty-state h6 {
    color: #713d25;
    font-weight: 800;
    font-size: 13px;
    margin-bottom: 7px;
}

.variant-dashboard .empty-state p {
    color: #a39488;
    font-size: 11px;
    margin-bottom: 17px;
}

/* PAGINATION */

.variant-dashboard .pagination-wrapper {
    display: flex;
    justify-content: flex-end;
    margin-top: 20px;
}

.variant-dashboard .table-footer {
    color: #a39488;
    font-size: 10px;
    margin-top: 13px;
}

/* FOOTER */

.variant-dashboard .dashboard-footer {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    padding: 23px 0 5px;
    margin-top: 25px;
    border-top: 1px solid #f0e3d9;
    color: #a39488;
    font-size: 10px;
}

.variant-dashboard .dashboard-footer i {
    color: #ed7542;
    font-size: 9px;
}

/* ALERT */

.variant-dashboard .form-alert {
    display: flex;
    align-items: center;
    gap: 10px;
    border-radius: 10px;
    font-size: 12px;
    margin-bottom: 18px;
}

.variant-dashboard .form-alert > i {
    flex-shrink: 0;
}

/* RESPONSIVE */

@media (max-width: 1100px) {
    .variant-dashboard .dashboard-content {
        padding: 25px 22px;
    }

    .variant-dashboard .admin-topbar {
        padding: 15px 22px;
    }
}

@media (max-width: 850px) {
    .variant-dashboard .admin-sidebar {
        width: 215px;
        min-width: 215px;
    }

    .variant-dashboard .topbar-date {
        display: none;
    }
}

@media (max-width: 600px) {
    .variant-dashboard {
        display: block;
        margin-top: -24px;
    }

    .variant-dashboard .admin-sidebar {
        width: 100%;
        min-width: 0;
    }

    .variant-dashboard .sidebar-menu {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .variant-dashboard .admin-topbar {
        padding: 15px 18px;
    }

    .variant-dashboard .topbar-user {
        display: none;
    }

    .variant-dashboard .dashboard-content {
        padding: 18px 14px;
    }

    .variant-dashboard .variant-banner {
        padding: 22px;
    }

    .variant-dashboard .variant-banner h1 {
        font-size: 23px;
    }

    .variant-dashboard .banner-decoration {
        right: 10px;
        font-size: 65px;
    }

    .variant-dashboard .content-card {
        padding: 17px;
    }

    .variant-dashboard .content-card-heading {
        align-items: flex-start;
        flex-direction: column;
    }

    .variant-dashboard .add-button {
        width: 100%;
    }

    .variant-dashboard .action-buttons {
        flex-direction: column;
    }

    .variant-dashboard .action-edit,
    .variant-dashboard .action-delete {
        width: 75px;
    }

    .variant-dashboard .dashboard-footer {
        flex-direction: column;
    }
}

</style>
@endpush
```