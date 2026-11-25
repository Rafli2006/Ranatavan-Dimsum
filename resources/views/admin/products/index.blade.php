@extends('layouts.master')

@section('title', 'Data Produk')

@section('content')

<div class="product-page">

    {{-- HEADER --}}
    <div class="product-header">
        <div class="header-content">
            <span class="header-label">
                <i class="bi bi-box-seam"></i>
                MANAJEMEN PRODUK
            </span>

            <h2>Data Produk Dimsum</h2>

            <p>
                Kelola produk, ukuran, harga, dan persediaan
                Ranatavan Dimsum dengan mudah.
            </p>
        </div>

        <div class="header-actions">
            <a href="{{ route('admin.dashboard') }}" class="btn-dashboard">
                <i class="bi bi-arrow-left"></i>
                Dashboard
            </a>

            <a href="{{ route('admin.produk.create') }}" class="btn-add-product">
                <i class="bi bi-plus-lg"></i>
                Tambah Produk
            </a>
        </div>
    </div>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show custom-alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger custom-alert">
            <strong>
                <i class="bi bi-exclamation-circle-fill me-2"></i>
                Terjadi kesalahan:
            </strong>

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
            <div class="summary-icon orange">
                <i class="bi bi-box-seam"></i>
            </div>

            <div class="summary-info">
                <span>Total Produk</span>
                <h3>{{ $products->total() }}</h3>
                <small>Produk terdaftar</small>
            </div>

            <div class="summary-decoration">🥟</div>
        </div>

        <div class="summary-card">
            <div class="summary-icon peach">
                <i class="bi bi-grid"></i>
            </div>

            <div class="summary-info">
                <span>Produk Ditampilkan</span>
                <h3>{{ $products->count() }}</h3>
                <small>Pada halaman ini</small>
            </div>

            <div class="summary-decoration">📦</div>
        </div>

        <div class="summary-card">
            <div class="summary-icon green">
                <i class="bi bi-rulers"></i>
            </div>

            <div class="summary-info">
                <span>Jenis Ukuran</span>
                <h3>{{ $products->sum(fn($product) => $product->sizes->where('is_active', true)->count()) }}</h3>
                <small>Ukuran aktif pada halaman ini</small>
            </div>

            <div class="summary-decoration">🛒</div>
        </div>

    </div>

    {{-- TABEL PRODUK --}}
    <div class="product-table-card">

        <div class="table-card-header">
            <div class="table-heading">
                <div class="table-heading-icon">
                    <i class="bi bi-list-ul"></i>
                </div>

                <div>
                    <h5>Daftar Produk</h5>
                    <p>Informasi lengkap produk yang tersedia di toko.</p>
                </div>
            </div>

            <div class="product-count">
                <i class="bi bi-box-seam"></i>
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

                            /*
                            |--------------------------------------------------------------------------
                            | PEMETAAN GAMBAR PRODUK
                            |--------------------------------------------------------------------------
                            */

                            $productName = mb_strtolower(trim($product->name));
                            $variantName = mb_strtolower(trim($product->variant->name ?? ''));

                            $productSearch = $productName . ' ' . $variantName;

                            $productImage = null;

                            // Dimsum Kukus Mentai: selalu gunakan foto isi 6
                            if (
                                str_contains($productSearch, 'kukus') &&
                                str_contains($productSearch, 'mentai')
                            ) {
                                $productImage = 'dimsum mentai isi 6.jpeg';

                            // Dimsum Kukus Ori: selalu gunakan foto isi 6
                            } elseif (
                                str_contains($productSearch, 'kukus') &&
                                (
                                    str_contains($productSearch, 'ori') ||
                                    str_contains($productSearch, 'original')
                                )
                            ) {
                                $productImage = 'dimsum ori isi 6.jpeg';

                            // Dimsum Goreng Mentai
                            } elseif (
                                str_contains($productSearch, 'goreng') &&
                                str_contains($productSearch, 'mentai')
                            ) {
                                $productImage = 'dimsum goreng mentai isi 3 dan 6.jpeg';

                            // Dimsum Goreng
                            } elseif (str_contains($productSearch, 'goreng')) {
                                $productImage = 'dimsum goreng isi 3 dan 6.jpeg';

                            // Dimsum Bakar
                            } elseif (str_contains($productSearch, 'bakar')) {
                                $productImage = 'dimsum bakar.jpeg';

                            // Dimsum Mentai biasa
                            } elseif (str_contains($productSearch, 'mentai')) {
                                $productImage = 'dimsum mentai isi 6.jpeg';

                            // Dimsum Ori biasa
                            } elseif (
                                str_contains($productSearch, 'ori') ||
                                str_contains($productSearch, 'original')
                            ) {
                                $productImage = 'dimsum ori isi 6.jpeg';
                            }

                            $imagePath = $productImage
                                ? public_path('images/products/' . $productImage)
                                : null;

                            $imageExists = $imagePath && file_exists($imagePath);
                        @endphp

                        <tr>

                            {{-- NOMOR --}}
                            <td class="number-column">
                                {{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}
                            </td>

                            {{-- NAMA PRODUK DAN FOTO --}}
                            <td>
                                <div class="product-name">

                                    <div class="product-image-wrapper">
                                        @if($imageExists)
                                            <img
                                                src="{{ asset('images/products/' . $productImage) }}"
                                                alt="{{ $product->name }}"
                                                class="product-image"
                                                loading="lazy"
                                            >
                                        @else
                                            <div class="product-image-fallback">
                                                🥟
                                            </div>
                                        @endif
                                    </div>

                                    <div class="product-detail">
                                        <strong>{{ $product->name }}</strong>

                                        <small>
                                            {{ $product->description ?: 'Produk Ranatavan Dimsum' }}
                                        </small>
                                    </div>

                                </div>
                            </td>

                            {{-- KATEGORI --}}
                            <td>
                                <span class="category-label">
                                    <i class="bi bi-tag-fill"></i>
                                    {{ $product->category->name ?? '-' }}
                                </span>
                            </td>

                            {{-- VARIAN --}}
                            <td>
                                <span class="variant-text">
                                    {{ $product->variant->name ?? '-' }}
                                </span>
                            </td>

                            {{-- UKURAN DAN HARGA --}}
                            <td>
                                @forelse($activeSizes as $size)
                                    <div class="size-info">
                                        <span>{{ $size->name }}</span>

                                        <strong>
                                            Rp{{ number_format($size->price, 0, ',', '.') }}
                                        </strong>
                                    </div>
                                @empty
                                    <span class="empty-text">
                                        Belum ada ukuran aktif
                                    </span>
                                @endforelse
                            </td>

                            {{-- STOK --}}
                            <td>
                                @forelse($activeSizes as $size)
                                    <div class="stock-info">
                                        <i class="bi bi-box"></i>
                                        {{ number_format($size->stock) }}
                                        <small>stok</small>
                                    </div>
                                @empty
                                    <span class="empty-text">-</span>
                                @endforelse
                            </td>

                            {{-- STATUS --}}
                            <td>
                                @if($product->status === 'tersedia' && $activeSizes->isNotEmpty())
                                    <span class="status-badge available">
                                        <i class="bi bi-check-circle-fill"></i>
                                        Tersedia
                                    </span>
                                @else
                                    <span class="status-badge unavailable">
                                        <i class="bi bi-x-circle-fill"></i>
                                        Tidak tersedia
                                    </span>
                                @endif
                            </td>

                            {{-- AKSI --}}
                            <td>
                                <div class="action-buttons">

                                    <a href="{{ route('admin.produk.edit', $product->id) }}"
                                       class="btn-edit">
                                        <i class="bi bi-pencil-square"></i>
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.produk.destroy', $product->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menonaktifkan produk ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn-delete">
                                            <i class="bi bi-slash-circle"></i>
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

                                    <div class="empty-illustration">🥟</div>

                                    <h5>Belum Ada Produk</h5>

                                    <p>
                                        Kamu belum menambahkan produk dimsum.
                                        Mulai tambahkan produk pertama sekarang.
                                    </p>

                                    <a href="{{ route('admin.produk.create') }}"
                                       class="btn-add-product">
                                        <i class="bi bi-plus-lg"></i>
                                        Tambah Produk
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
        <span class="footer-logo">🥟</span>
        <span>Ranatavan Dimsum</span>
        <span class="footer-divider">·</span>
        <span>Manajemen Produk</span>
    </div>

</div>

@endsection

@push('styles')
<style>

/* =====================================
   PRODUCT PAGE - MODERN ORANGE & WHITE
===================================== */

.product-page {
    min-height: 100vh;
    background: #fffaf6;
    padding: 30px;
}

/* HEADER */

.product-header {
    position: relative;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 25px;
    padding: 28px 30px;
    margin-bottom: 25px;
    background: linear-gradient(115deg, #ffffff 55%, #fff0e3);
    border: 1px solid #f7e4d4;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(112, 69, 44, .04);
}

.product-header::after {
    content: "🥟";
    position: absolute;
    right: 230px;
    bottom: -30px;
    font-size: 105px;
    opacity: .07;
    transform: rotate(-15deg);
    pointer-events: none;
}

.header-content {
    position: relative;
    z-index: 1;
}

.header-label {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    color: #ed7628;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 2px;
}

.product-header h2 {
    color: #713d25;
    font-size: 28px;
    font-weight: 800;
    margin: 9px 0 7px;
}

.product-header p {
    color: #9b887b;
    font-size: 13px;
    margin: 0;
}

.header-actions {
    display: flex;
    align-items: center;
    gap: 11px;
    position: relative;
    z-index: 2;
    flex-shrink: 0;
}

.btn-dashboard,
.btn-add-product {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    text-decoration: none;
    border-radius: 11px;
    padding: 12px 17px;
    font-size: 12px;
    font-weight: 700;
    transition: .25s ease;
    white-space: nowrap;
}

.btn-dashboard {
    background: #ffffff;
    color: #75472e;
    border: 1px solid #ead8ca;
}

.btn-dashboard:hover {
    background: #fff0e4;
    color: #d95d16;
    border-color: #f5bd91;
    transform: translateY(-2px);
}

.btn-add-product {
    background: linear-gradient(135deg, #f07828, #e85f18);
    color: #ffffff;
    border: 1px solid #e96820;
    box-shadow: 0 5px 13px rgba(240, 120, 40, .18);
}

.btn-add-product:hover {
    background: linear-gradient(135deg, #e96820, #d95112);
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 7px 16px rgba(240, 120, 40, .28);
}

/* ALERT */

.custom-alert {
    border-radius: 12px;
    font-size: 13px;
    margin-bottom: 22px;
    border: none;
    box-shadow: 0 3px 12px rgba(0, 0, 0, .035);
}

/* SUMMARY */

.summary-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
    margin-bottom: 25px;
}

.summary-card {
    position: relative;
    display: flex;
    align-items: center;
    gap: 15px;
    min-height: 115px;
    padding: 21px;
    background: #ffffff;
    border: 1px solid #f2e6dc;
    border-radius: 17px;
    overflow: hidden;
    box-shadow: 0 4px 16px rgba(112, 69, 44, .045);
    transition: .25s ease;
}

.summary-card:hover {
    transform: translateY(-4px);
    border-color: #f6c6a3;
    box-shadow: 0 9px 22px rgba(112, 69, 44, .09);
}

.summary-icon {
    width: 51px;
    height: 51px;
    min-width: 51px;
    display: grid;
    place-items: center;
    border-radius: 15px;
    font-size: 22px;
}

.summary-icon.orange {
    color: #ed7628;
    background: #fff0e3;
}

.summary-icon.peach {
    color: #d77c37;
    background: #fff4e6;
}

.summary-icon.green {
    color: #54815a;
    background: #eaf4e9;
}

.summary-info {
    position: relative;
    z-index: 1;
}

.summary-info span {
    color: #968579;
    font-size: 12px;
    font-weight: 600;
}

.summary-info h3 {
    color: #713d25;
    font-size: 26px;
    font-weight: 800;
    margin: 3px 0;
}

.summary-info small {
    color: #b1a398;
    font-size: 10px;
}

.summary-decoration {
    position: absolute;
    right: 15px;
    bottom: 8px;
    font-size: 38px;
    opacity: .13;
    transform: rotate(-12deg);
}

/* TABLE CARD */

.product-table-card {
    background: #ffffff;
    border: 1px solid #f0e4da;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(112, 69, 44, .045);
}

.table-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    padding: 22px 25px;
    border-bottom: 1px solid #f3ebe5;
}

.table-heading {
    display: flex;
    align-items: center;
    gap: 12px;
}

.table-heading-icon {
    width: 42px;
    height: 42px;
    display: grid;
    place-items: center;
    border-radius: 12px;
    background: #fff0e3;
    color: #ed7628;
    font-size: 19px;
}

.table-card-header h5 {
    color: #713d25;
    font-size: 16px;
    font-weight: 800;
    margin: 0 0 5px;
}

.table-card-header p {
    color: #a09287;
    font-size: 11px;
    margin: 0;
}

.product-count {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 9px 14px;
    border-radius: 20px;
    background: #fff0e3;
    color: #df6b20;
    font-size: 11px;
    font-weight: 800;
    white-space: nowrap;
}

/* TABLE */

.product-table {
    margin-bottom: 0;
    min-width: 1050px;
}

.product-table thead th {
    padding: 16px 13px;
    background: linear-gradient(110deg, #f07828, #ed6820);
    color: #ffffff;
    border: none;
    font-size: 11px;
    font-weight: 700;
    white-space: nowrap;
}

.product-table tbody td {
    padding: 16px 13px;
    border-bottom: 1px solid #f4eee8;
    color: #6f5748;
    font-size: 12px;
    vertical-align: middle;
}

.product-table tbody tr {
    transition: background .2s ease;
}

.product-table tbody tr:hover {
    background: #fffaf6;
}

.product-table tbody tr:last-child td {
    border-bottom: none;
}

.number-column {
    color: #ad9b8d !important;
    font-weight: 700;
}

/* PRODUCT IMAGE */

.product-name {
    display: flex;
    align-items: center;
    gap: 11px;
    min-width: 190px;
}

.product-image-wrapper {
    width: 58px;
    height: 58px;
    min-width: 58px;
    display: grid;
    place-items: center;
    overflow: hidden;
    background: #fff0e3;
    border: 1px solid #fbe2d0;
    border-radius: 13px;
}

.product-image {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .3s ease;
}

.product-image-wrapper:hover .product-image {
    transform: scale(1.1);
}

.product-image-fallback {
    width: 100%;
    height: 100%;
    display: grid;
    place-items: center;
    background: #fff0e3;
    font-size: 27px;
}

.product-detail strong {
    display: block;
    color: #713d25;
    font-size: 12px;
    font-weight: 800;
}

.product-detail small {
    display: block;
    max-width: 180px;
    margin-top: 4px;
    color: #a9998d;
    font-size: 10px;
    line-height: 1.5;
}

/* CATEGORY AND VARIANT */

.category-label {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 7px 10px;
    border-radius: 8px;
    background: #fff0e3;
    color: #d96b25;
    font-size: 10px;
    font-weight: 800;
    white-space: nowrap;
}

.variant-text {
    color: #765642;
    font-size: 11px;
    font-weight: 600;
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
    color: #a08d7e;
    font-size: 10px;
}

.size-info strong {
    color: #e56c21;
    font-size: 12px;
    font-weight: 800;
}

/* STOCK */

.stock-info {
    display: flex;
    align-items: center;
    gap: 5px;
    color: #713d25;
    font-size: 12px;
    font-weight: 800;
    margin-bottom: 9px;
}

.stock-info:last-child {
    margin-bottom: 0;
}

.stock-info i {
    color: #e98742;
}

.stock-info small {
    color: #a9998d;
    font-size: 9px;
    font-weight: 400;
}

.empty-text {
    color: #ad9e93;
    font-size: 10px;
}

/* STATUS */

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 7px 10px;
    border-radius: 20px;
    font-size: 10px;
    font-weight: 800;
    white-space: nowrap;
}

.status-badge.available {
    color: #43804b;
    background: #eaf5e9;
}

.status-badge.unavailable {
    color: #a36a45;
    background: #fff0e5;
}

/* ACTION */

.action-buttons {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 7px;
}

.btn-edit,
.btn-delete {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    border: none;
    border-radius: 8px;
    padding: 8px 11px;
    font-size: 10px;
    font-weight: 800;
    text-decoration: none;
    cursor: pointer;
    transition: .2s ease;
    white-space: nowrap;
}

.btn-edit {
    color: #d66b22;
    background: #fff0e3;
}

.btn-edit:hover {
    color: #ffffff;
    background: #ed7628;
    transform: translateY(-1px);
}

.btn-delete {
    color: #b95345;
    background: #fff0ed;
}

.btn-delete:hover {
    color: #ffffff;
    background: #d65b4c;
    transform: translateY(-1px);
}

/* EMPTY STATE */

.empty-state {
    padding: 60px 20px;
    text-align: center;
}

.empty-illustration {
    width: 90px;
    height: 90px;
    display: grid;
    place-items: center;
    margin: 0 auto 17px;
    border-radius: 50%;
    background: #fff0e3;
    font-size: 47px;
}

.empty-state h5 {
    color: #713d25;
    font-size: 17px;
    font-weight: 800;
    margin-bottom: 8px;
}

.empty-state p {
    max-width: 350px;
    margin: 0 auto 20px;
    color: #a09287;
    font-size: 12px;
    line-height: 1.7;
}

.empty-state .btn-add-product {
    display: inline-flex;
}

/* PAGINATION */

.pagination-wrapper {
    padding: 20px 25px;
    border-top: 1px solid #f3ebe5;
}

.pagination {
    margin-bottom: 0;
    gap: 4px;
}

.pagination .page-link {
    color: #d96b25;
    border-color: #f0e3d9;
    border-radius: 7px;
    font-size: 12px;
}

.pagination .page-link:hover {
    color: #ffffff;
    background: #f07828;
    border-color: #f07828;
}

.pagination .active .page-link {
    color: #ffffff;
    background: #f07828;
    border-color: #f07828;
}

/* FOOTER */

.product-footer {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 7px;
    padding: 27px 0 5px;
    color: #a9998d;
    font-size: 11px;
}

.footer-logo {
    font-size: 17px;
}

.footer-divider {
    color: #ed7628;
    font-weight: 800;
}

/* RESPONSIVE */

@media (max-width: 992px) {
    .product-page {
        padding: 22px;
    }

    .product-header {
        align-items: flex-start;
    }

    .header-actions {
        flex-wrap: wrap;
    }

    .summary-grid {
        gap: 12px;
    }

    .summary-card {
        padding: 16px;
    }

    .summary-decoration {
        display: none;
    }
}

@media (max-width: 768px) {
    .product-page {
        padding: 18px 13px;
    }

    .product-header {
        flex-direction: column;
        align-items: flex-start;
        padding: 23px 20px;
    }

    .product-header h2 {
        font-size: 23px;
    }

    .product-header::after {
        right: 15px;
        font-size: 75px;
    }

    .header-actions {
        width: 100%;
    }

    .header-actions a {
        flex: 1;
    }

    .summary-grid {
        grid-template-columns: 1fr;
    }

    .summary-card {
        min-height: 95px;
    }

    .summary-decoration {
        display: block;
    }

    .table-card-header {
        padding: 17px;
        align-items: flex-start;
    }

    .product-count {
        font-size: 10px;
        padding: 8px 10px;
    }

    .pagination-wrapper {
        padding: 16px;
        overflow-x: auto;
    }
}

@media (max-width: 420px) {
    .header-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .table-card-header {
        flex-direction: column;
    }

    .product-footer {
        flex-wrap: wrap;
        font-size: 10px;
    }
}

</style>
@endpush
