@extends('layouts.master')

@section('title', 'Data Varian')

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
                   class="sidebar-link">
                    <span>⌂</span> Dashboard
                </a>

                <p class="sidebar-heading mt-4">MANAJEMEN DATA</p>

                <a href="{{ route('admin.kasir.index') }}"
                   class="sidebar-link">
                    <span>📊</span> Data Kasir
                </a>

                <a href="{{ route('admin.kategori.index') }}"
                   class="sidebar-link">
                    <span>▦</span> Data Kategori
                </a>

                <a href="{{ route('admin.varian.index') }}"
                   class="sidebar-link active">
                    <span>◇</span> Data Varian
                </a>

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

            {{-- KONTEN UTAMA --}}
            <main class="col-md-9 col-lg-10 admin-content">

                {{-- JUDUL HALAMAN --}}
                <div class="page-heading">

                    <div>
                        <span class="eyebrow">MANAJEMEN DATA</span>

                        <h2>Data Varian</h2>

                        <p>
                            Kelola berbagai varian produk Ranatavan Dimsum.
                        </p>
                    </div>

                    <div class="date-label">
                        📅 {{ now()->translatedFormat('d F Y') }}
                    </div>

                </div>

                {{-- NOTIFIKASI --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- BANNER --}}
                <div class="welcome-banner">

                    <div>
                        <span class="welcome-label">
                            VARIANT MANAGEMENT
                        </span>

                        <h3>Kelola Varian Produk</h3>

                        <p>
                            Atur nama varian dan kategori produk agar
                            pengelolaan produk Ranatavan Dimsum lebih mudah.
                        </p>
                    </div>

                    <div class="welcome-decoration">🏷️</div>

                </div>

                {{-- STATISTIK --}}
                <div class="section-heading">
                    <div>
                        <h5>Ringkasan Data</h5>
                        <p>Informasi jumlah data varian saat ini</p>
                    </div>
                </div>

                <div class="row g-3 mb-4">

                    <div class="col-sm-6 col-xl-4">
                        <div class="stat-card">
                            <div class="stat-icon icon-brown">🏷️</div>

                            <div>
                                <p>Total Varian</p>
                                <h3>{{ $variants->total() }}</h3>
                                <small>Varian terdaftar</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-4">
                        <div class="stat-card">
                            <div class="stat-icon icon-gold">▦</div>

                            <div>
                                <p>Total Kategori</p>
                                <h3>{{ \App\Models\Category::count() }}</h3>
                                <small>Kategori tersedia</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-4">
                        <div class="stat-card">
                            <div class="stat-icon icon-green">🥟</div>

                            <div>
                                <p>Total Produk</p>
                                <h3>{{ \App\Models\Product::count() }}</h3>
                                <small>Produk terdaftar</small>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- TABEL DATA VARIAN --}}
                <div class="content-card">

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

                        <div>
                            <h5 class="fw-bold mb-1">Daftar Varian</h5>

                            <p class="text-muted small mb-0">
                                Daftar seluruh varian berdasarkan kategori produk.
                            </p>
                        </div>

                        <a href="{{ route('admin.varian.create') }}"
                           class="btn btn-cokelat">
                            + Tambah Varian
                        </a>

                    </div>

                    <div class="table-responsive">

                        <table class="table table-hover align-middle">

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

                                        <td>
                                            {{ $variants->firstItem() + $loop->index }}
                                        </td>

                                        <td>
                                            <span class="category-badge">
                                                {{ $variant->category->name ?? '-' }}
                                            </span>
                                        </td>

                                        <td class="fw-semibold">
                                            {{ $variant->name }}
                                        </td>

                                        <td>
                                            <span class="product-count">
                                                {{ $variant->products_count }} Produk
                                            </span>
                                        </td>

                                        <td>
                                            <div class="d-flex justify-content-center gap-2">

                                                <a href="{{ route('admin.varian.edit', $variant->id) }}"
                                                   class="btn btn-sm btn-edit">
                                                    Edit
                                                </a>

                                                <form action="{{ route('admin.varian.destroy', $variant->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus varian ini?')">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            class="btn btn-sm btn-delete">
                                                        Hapus
                                                    </button>

                                                </form>

                                            </div>
                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="5" class="text-center py-5">

                                            <div style="font-size:40px;">🏷️</div>

                                            <h6 class="fw-bold mt-2">
                                                Belum Ada Data Varian
                                            </h6>

                                            <p class="text-muted small mb-0">
                                                Silakan tambahkan varian produk terlebih dahulu.
                                            </p>

                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    {{-- PAGINATION --}}
                    <div class="mt-3">
                        {{ $variants->links() }}
                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="admin-footer">
                    © {{ date('Y') }} Ranatavan Dimsum · Admin Panel
                </div>

            </main>

        </div>
    </div>

</div>

@endsection

@push('styles')
<style>

    /* HALAMAN */
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
        min-width: 0;
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
        font-size: 75px;
        opacity: .85;
        padding: 0 25px;
    }

    /* SECTION */
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

    /* STATISTIK */
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

    /* TABEL */
    .content-card {
        background: white;
        border-radius: 14px;
        padding: 25px;
        box-shadow: 0 3px 12px rgba(0,0,0,.05);
    }

    .table thead th {
        background: #70452c;
        color: white;
        font-size: 12px;
        padding: 14px;
        white-space: nowrap;
    }

    .table td {
        padding: 14px;
        font-size: 13px;
        vertical-align: middle;
        color: #665448;
    }

    .table tbody tr:hover {
        background: #fcf8f3;
    }

    .category-badge {
        display: inline-block;
        background: #f4e9dd;
        color: #70452c;
        padding: 6px 11px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

    .product-count {
        background: #e8eee4;
        color: #60764d;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

    /* TOMBOL */
    .btn-cokelat {
        background: #70452c;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 17px;
        font-size: 13px;
    }

    .btn-cokelat:hover {
        background: #563522;
        color: white;
    }

    .btn-edit {
        background: #f2d99b;
        color: #76551d;
        border: none;
    }

    .btn-edit:hover {
        background: #e7c879;
        color: #563522;
    }

    .btn-delete {
        background: #f3d7d4;
        color: #a33e35;
        border: none;
    }

    .btn-delete:hover {
        background: #e9bdb8;
        color: #812b25;
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

        .content-card {
            padding: 16px;
        }
    }

</style>
@endpush
