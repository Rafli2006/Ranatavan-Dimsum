@extends('layouts.master')

@section('title', 'Data Produk')

@section('content')

<div class="product-page">

   {{-- HEADER --}}
<div class="product-header">
    <div>
        <span class="header-label">MANAJEMEN PRODUK</span>
        <h2>Data Produk Dimsum</h2>
        <p>Kelola produk, ukuran, harga, dan persediaan Ranatavan Dimsum.</p>
    </div>

    <div class="header-actions">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-dashboard">
            <i class="bi bi-arrow-left"></i>
            Dashboard
        </a>

        <a href="{{ route('admin.produk.create') }}" class="btn-add-product">
            <span>＋</span> Tambah Produk
        </a>
    </div>
</div>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
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
    <div class="summary-grid">

        <div class="summary-card">
            <div class="summary-icon brown">🥟</div>
            <div>
                <span>Total Produk</span>
                <h3>{{ $products->total() }}</h3>
                <small>Produk terdaftar</small>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon gold">📦</div>
            <div>
                <span>Produk Ditampilkan</span>
                <h3>{{ $products->count() }}</h3>
                <small>Pada halaman ini</small>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon green">🛒</div>
            <div>
                <span>Jenis Ukuran</span>
                <h3>{{ $products->sum(fn($product) => $product->sizes->where('is_active', true)->count()) }}</h3>
                <small>Ukuran aktif pada halaman ini</small>
            </div>
        </div>

    </div>

    {{-- TABEL PRODUK --}}
    <div class="product-table-card">

        <div class="table-card-header">
            <div>
                <h5>Daftar Produk</h5>
                <p>Informasi lengkap produk yang tersedia di toko.</p>
            </div>

            <div class="product-count">
                {{ $products->total() }} Produk
            </div>
        </div>

        <div class="table-responsive">
            <table class="table product-table align-middle">

                <thead>
                    <tr>
                        <th width="55">No.</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Varian</th>
                        <th>Ukuran & Harga</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($products as $product)

                        @php
                            $activeSizes = $product->sizes->where('is_active', true);
                            $totalStock = $activeSizes->sum('stock');
                        @endphp

                        <tr>

                            <td class="text-muted">
                                {{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}
                            </td>

                            <td>
                                <div class="product-name">
                                    <div class="product-emoji">🥟</div>
                                    <div>
                                        <strong>{{ $product->name }}</strong>
                                        <small>
                                            {{ $product->description ?: 'Produk Ranatavan Dimsum' }}
                                        </small>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="category-label">
                                    {{ $product->category->name ?? '-' }}
                                </span>
                            </td>

                            <td>
                                {{ $product->variant->name ?? '-' }}
                            </td>

                            <td>
                                @forelse($activeSizes as $size)
                                    <div class="size-info">
                                        <span>{{ $size->name }}</span>
                                        <strong>
                                            Rp{{ number_format($size->price, 0, ',', '.') }}
                                        </strong>
                                    </div>
                                @empty
                                    <span class="text-muted">Belum ada ukuran aktif</span>
                                @endforelse
                            </td>

                            <td>
                                @forelse($activeSizes as $size)
                                    <div class="stock-info">
                                        {{ number_format($size->stock) }}
                                        <small>stok</small>
                                    </div>
                                @empty
                                    -
                                @endforelse
                            </td>

                            <td>
                                @if($product->status === 'tersedia' && $activeSizes->isNotEmpty())
                                    <span class="status-badge available">
                                        ● Tersedia
                                    </span>
                                @else
                                    <span class="status-badge unavailable">
                                        ● Tidak tersedia
                                    </span>
                                @endif
                            </td>

                            <td>
                                <div class="action-buttons">

                                    <a href="{{ route('admin.produk.edit', $product->id) }}"
                                       class="btn-edit">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.produk.destroy', $product->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menonaktifkan produk ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn-delete">
                                            Nonaktifkan
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <div class="empty-icon">🥟</div>
                                    <h5>Belum Ada Produk</h5>
                                    <p>
                                        Kamu belum menambahkan produk dimsum.
                                        Mulai tambahkan produk pertama sekarang.
                                    </p>

                                    <a href="{{ route('admin.produk.create') }}"
                                       class="btn-add-product">
                                        ＋ Tambah Produk
                                    </a>
                                </div>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>
        </div>

        {{-- PAGINATION --}}
        @if($products->hasPages())
            <div class="pagination-wrapper">
                {{ $products->links() }}
            </div>
        @endif

    </div>

    {{-- FOOTER --}}
    <div class="product-footer">
        <span>🥟</span>
        Ranatavan Dimsum · Manajemen Produk
    </div>

</div>

@endsection

@push('styles')
<style>

    .product-page {
        min-height: 100vh;
        background: #f8f5f0;
        padding: 30px;
    }

    /* HEADER */
    .product-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 28px;
    }

    .header-actions {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .btn-dashboard {
        background-color: #fff;
        color: #70452c;
        border: 1px solid #d9c5b3;
        padding: 12px 18px;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
    }

    .btn-dashboard:hover {
        background-color: #f4e9dd;
        color: #54321f;
    }

    @media (max-width: 768px) {
        .product-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 18px;
        }

        .header-actions {
            width: 100%;
            flex-wrap: wrap;
        }
    }

    .header-label {
        color: #a47c59;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 2px;
    }

    .product-header h2 {
        color: #563522;
        font-size: 27px;
        font-weight: 800;
        margin: 7px 0;
    }

    .product-header p {
        color: #96887d;
        font-size: 13px;
        margin: 0;
    }

    .btn-add-product {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #70452c;
        color: white;
        text-decoration: none;
        border: none;
        border-radius: 10px;
        padding: 12px 19px;
        font-size: 13px;
        font-weight: 700;
        transition: .2s;
    }

    .btn-add-product:hover {
        background: #563522;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 14px rgba(86,53,34,.2);
    }

    .btn-add-product span {
        font-size: 18px;
    }

    /* SUMMARY */
    .summary-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-bottom: 25px;
    }

    .summary-card {
        background: white;
        border: 1px solid #f0e8df;
        border-radius: 15px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: 0 4px 15px rgba(75,46,27,.035);
    }

    .summary-icon {
        width: 52px;
        height: 52px;
        min-width: 52px;
        display: grid;
        place-items: center;
        border-radius: 14px;
        font-size: 23px;
    }

    .summary-icon.brown {
        background: #f1e4d7;
    }

    .summary-icon.gold {
        background: #f8efd9;
    }

    .summary-icon.green {
        background: #e8eee4;
    }

    .summary-card span {
        color: #92867c;
        font-size: 12px;
    }

    .summary-card h3 {
        color: #563522;
        font-weight: 800;
        font-size: 25px;
        margin: 3px 0;
    }

    .summary-card small {
        color: #b0a398;
        font-size: 10px;
    }

    /* TABLE CARD */
    .product-table-card {
        background: white;
        border: 1px solid #eee5db;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 18px rgba(75,46,27,.04);
    }

    .table-card-header {
        padding: 23px 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        border-bottom: 1px solid #f1eae3;
    }

    .table-card-header h5 {
        color: #563522;
        font-size: 16px;
        font-weight: 800;
        margin-bottom: 5px;
    }

    .table-card-header p {
        color: #a09287;
        font-size: 11px;
        margin: 0;
    }

    .product-count {
        background: #f5ece3;
        color: #70452c;
        padding: 8px 13px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    /* TABLE */
    .product-table {
        margin-bottom: 0;
        min-width: 1000px;
    }

    .product-table thead th {
        background: #70452c;
        color: white;
        border: none;
        padding: 16px 13px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .product-table tbody td {
        padding: 16px 13px;
        border-bottom: 1px solid #f2ece6;
        color: #655347;
        font-size: 12px;
    }

    .product-table tbody tr:hover {
        background: #fdfaf7;
    }

    .product-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* PRODUCT NAME */
    .product-name {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 190px;
    }

    .product-emoji {
        width: 40px;
        height: 40px;
        min-width: 40px;
        display: grid;
        place-items: center;
        background: #f5ece3;
        border-radius: 11px;
        font-size: 21px;
    }

    .product-name strong {
        display: block;
        color: #563522;
        font-size: 12px;
    }

    .product-name small {
        display: block;
        color: #aa9c90;
        font-size: 10px;
        margin-top: 4px;
        max-width: 180px;
    }

    .category-label {
        background: #f5ece3;
        color: #70452c;
        padding: 6px 9px;
        border-radius: 7px;
        font-size: 10px;
        font-weight: 700;
    }

    /* SIZE AND PRICE */
    .size-info {
        display: flex;
        flex-direction: column;
        gap: 3px;
        margin-bottom: 9px;
    }

    .size-info:last-child {
        margin-bottom: 0;
    }

    .size-info span {
        color: #9b8879;
        font-size: 10px;
    }

    .size-info strong {
        color: #70452c;
        font-size: 12px;
    }

    .stock-info {
        color: #563522;
        font-weight: 800;
        margin-bottom: 9px;
    }

    .stock-info small {
        color: #aa9c90;
        font-size: 9px;
        font-weight: normal;
    }

    .status-badge {
        display: inline-block;
        padding: 7px 9px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-badge.available {
        color: #55764d;
        background: #e9f1e5;
    }

    .status-badge.unavailable {
        color: #92704e;
        background: #f5ece3;
    }

    /* ACTION */
    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 7px;
        align-items: flex-start;
    }

    .btn-edit,
    .btn-delete {
        border: none;
        border-radius: 7px;
        padding: 7px 11px;
        font-size: 10px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: .2s;
        white-space: nowrap;
    }

    .btn-edit {
        background: #f8efd9;
        color: #98702f;
    }

    .btn-edit:hover {
        background: #eadbb8;
        color: #704d20;
    }

    .btn-delete {
        background: #f8e8e5;
        color: #a64e42;
    }

    .btn-delete:hover {
        background: #f0d5d0;
        color: #8b3028;
    }

    /* EMPTY STATE */
    .empty-state {
        padding: 55px 20px;
        text-align: center;
    }

    .empty-icon {
        font-size: 55px;
        margin-bottom: 12px;
    }

    .empty-state h5 {
        color: #563522;
        font-weight: 800;
    }

    .empty-state p {
        color: #a09287;
        font-size: 12px;
        margin-bottom: 20px;
    }

    .empty-state .btn-add-product {
        display: inline-flex;
    }

    /* PAGINATION */
    .pagination-wrapper {
        padding: 20px 25px;
        border-top: 1px solid #f1eae3;
    }

    .pagination {
        margin-bottom: 0;
    }

    .pagination .page-link {
        color: #70452c;
        border-color: #eee5db;
    }

    .pagination .active .page-link {
        background: #70452c;
        border-color: #70452c;
        color: white;
    }

    /* FOOTER */
    .product-footer {
        text-align: center;
        color: #aa9c90;
        font-size: 11px;
        padding: 28px 0 5px;
    }

    /* RESPONSIVE */
    @media(max-width: 767px) {
        .product-page {
            padding: 20px 14px;
        }

        .product-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .summary-grid {
            grid-template-columns: 1fr;
        }

        .table-card-header {
            padding: 18px;
        }
    }

</style>
@endpush
