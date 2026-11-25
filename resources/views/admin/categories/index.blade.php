@extends('layouts.master')

@section('title', 'Data Kategori')

@section('content')

<div class="category-page">

    {{-- NAVBAR --}}
    <nav class="navbar navbar-dark category-navbar">
        <div class="container-fluid px-4">

            <a href="{{ route('admin.dashboard') }}"
               class="navbar-brand d-flex align-items-center gap-2">
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
                   class="sidebar-link active">
                    <span>▦</span> Data Kategori
                </a>

                <a href="{{ route('admin.varian.index') }}"
                   class="sidebar-link">
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

            {{-- KONTEN --}}
            <main class="col-md-9 col-lg-10 admin-content">

                {{-- HEADER --}}
                <div class="page-heading">

                    <div>
                        <span class="eyebrow">MANAJEMEN DATA</span>
                        <h2>Data Kategori</h2>
                        <p>
                            Kelola kategori produk Ranatavan Dimsum.
                        </p>
                    </div>

                    <a href="{{ route('admin.kategori.create') }}"
                       class="btn btn-add">
                        + Tambah Kategori
                    </a>

                </div>

                {{-- NOTIFIKASI --}}
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- RINGKASAN --}}
                <div class="row g-3 mb-4">

                    <div class="col-md-4">
                        <div class="summary-card">
                            <div class="summary-icon">▦</div>
                            <div>
                                <p>Total Kategori</p>
                                <h3>{{ $categories->total() }}</h3>
                                <small>Kategori terdaftar</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="summary-card">
                            <div class="summary-icon">🥟</div>
                            <div>
                                <p>Total Produk</p>
                                <h3>{{ \App\Models\Product::count() }}</h3>
                                <small>Produk terdaftar</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="summary-card">
                            <div class="summary-icon">◇</div>
                            <div>
                                <p>Total Varian</p>
                                <h3>{{ \App\Models\Variant::count() }}</h3>
                                <small>Varian terdaftar</small>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- TABEL KATEGORI --}}
                <div class="category-card">

                    <div class="table-heading">
                        <div>
                            <h5>Daftar Kategori Produk</h5>
                            <p>Informasi seluruh kategori yang tersedia</p>
                        </div>
                    </div>

                    <div class="table-responsive">

                        <table class="table align-middle category-table">

                            <thead>
                                <tr>
                                    <th width="70">No.</th>
                                    <th>Nama Kategori</th>
                                    <th>Deskripsi</th>
                                    <th class="text-center">Produk</th>
                                    <th class="text-center">Varian</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($categories as $index => $category)

                                    <tr>

                                        <td>
                                            {{ $categories->firstItem() + $index }}
                                        </td>

                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="category-icon">🥟</span>
                                                <strong>{{ $category->name }}</strong>
                                            </div>
                                        </td>

                                        <td>
                                            {{ $category->description ?: '-' }}
                                        </td>

                                        <td class="text-center">
                                            <span class="count-badge">
                                                {{ $category->products_count }}
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            <span class="count-badge">
                                                {{ $category->variants_count }}
                                            </span>
                                        </td>

                                        <td class="text-center">

                                            <div class="d-flex justify-content-center gap-2">

                                                <a href="{{ route('admin.kategori.edit', $category->id) }}"
                                                   class="btn btn-edit">
                                                    Edit
                                                </a>

                                                <form action="{{ route('admin.kategori.destroy', $category->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            class="btn btn-delete">
                                                        Hapus
                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <div class="empty-icon">▦</div>
                                            <h6>Belum Ada Kategori</h6>
                                            <p class="text-muted small">
                                                Silakan tambahkan kategori produk terlebih dahulu.
                                            </p>
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    <div class="pagination-wrapper">
                        {{ $categories->links() }}
                    </div>

                </div>

                <div class="category-footer">
                    © {{ date('Y') }} Ranatavan Dimsum · Admin Panel
                </div>

            </main>

        </div>
    </div>

</div>

@endsection

@push('styles')
<style>

.category-page {
    min-height: 100vh;
    background: #f8f5f0;
}

.category-navbar {
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

.category-navbar .navbar-brand {
    font-size: 16px;
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

.sidebar-link span {
    width: 22px;
    text-align: center;
    font-size: 17px;
}

.sidebar-link:hover,
.sidebar-link.active {
    background: #946747;
    color: white;
}

.disabled-menu {
    display: flex;
    align-items: center;
    gap: 12px;
    color: #f8eee4;
    font-size: 13px;
    padding: 12px;
    opacity: .65;
}

.disabled-menu small {
    margin-left: auto;
    font-size: 9px;
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

.eyebrow {
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

.btn-add {
    background: #70452c;
    color: white;
    padding: 11px 18px;
    border-radius: 9px;
    font-size: 12px;
    font-weight: bold;
}

.btn-add:hover {
    background: #563522;
    color: white;
}

.summary-card {
    background: white;
    border: 1px solid #f0e8df;
    border-radius: 14px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
    height: 100%;
}

.summary-icon {
    width: 48px;
    height: 48px;
    min-width: 48px;
    border-radius: 13px;
    background: #f4e9dd;
    display: grid;
    place-items: center;
    color: #70452c;
    font-size: 22px;
}

.summary-card p {
    color: #92867c;
    font-size: 12px;
    margin-bottom: 4px;
}

.summary-card h3 {
    color: #563522;
    font-weight: 800;
    margin-bottom: 3px;
}

.summary-card small {
    color: #b0a398;
    font-size: 10px;
}

.category-card {
    background: white;
    border: 1px solid #f0e8df;
    border-radius: 15px;
    padding: 22px;
    box-shadow: 0 4px 15px rgba(75,46,27,.04);
}

.table-heading {
    margin-bottom: 20px;
}

.table-heading h5 {
    color: #563522;
    font-weight: 800;
    margin-bottom: 5px;
}

.table-heading p {
    color: #a09287;
    font-size: 12px;
    margin: 0;
}

.category-table thead th {
    background: #f8f5f0;
    color: #70452c;
    font-size: 11px;
    padding: 15px 12px;
    white-space: nowrap;
    border-bottom: 1px solid #eee3d7;
}

.category-table tbody td {
    color: #75675c;
    font-size: 12px;
    padding: 16px 12px;
    border-color: #f3eee8;
}

.category-icon {
    width: 35px;
    height: 35px;
    background: #f4e9dd;
    display: grid;
    place-items: center;
    border-radius: 9px;
    font-size: 18px;
}

.count-badge {
    display: inline-block;
    background: #f4e9dd;
    color: #70452c;
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: bold;
    font-size: 11px;
}

.btn-edit,
.btn-delete {
    padding: 7px 12px;
    font-size: 11px;
    font-weight: bold;
    border-radius: 7px;
}

.btn-edit {
    background: #f5eadc;
    color: #70452c;
}

.btn-edit:hover {
    background: #e9d6c1;
    color: #563522;
}

.btn-delete {
    background: #fbe9e7;
    color: #b4483f;
}

.btn-delete:hover {
    background: #f2d2ce;
    color: #92362f;
}

.empty-icon {
    font-size: 40px;
    color: #c9a789;
    margin-bottom: 10px;
}

.empty-icon + h6 {
    color: #563522;
    font-weight: bold;
}

.pagination-wrapper {
    margin-top: 20px;
}

.pagination-wrapper .page-link {
    color: #70452c;
}

.pagination-wrapper .active > .page-link {
    background: #70452c;
    border-color: #70452c;
    color: white;
}

.category-footer {
    text-align: center;
    color: #aa9c90;
    font-size: 11px;
    padding: 30px 0 5px;
}

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

    .user-info {
        display: none;
    }

}

</style>
@endpush
