
@extends('layouts.master')

@section('title', 'Transaksi Baru')

@section('content')

{{-- NAVBAR --}}
<nav class="navbar navbar-dark px-4 py-3">
    <a href="{{ route('kasir.dashboard') }}"
       class="navbar-brand fw-bold">
        🥟 Ranatavan Dimsum
    </a>

    <div class="ms-auto d-flex align-items-center gap-3">
        <span class="text-white">
           {{ auth()->user()->name }}
        </span>

        <a href="{{ route('kasir.dashboard') }}"
           class="btn btn-light btn-sm">
            Kembali
        </a>
    </div>
</nav>

<div class="transaction-page">

    {{-- HEADER --}}
    <div class="page-header">
        <div>
            <span class="page-label">KASIR RANATAVAN DIMSUM</span>
            <h2>Transaksi Baru</h2>
            <p>Pilih produk dan ukuran pesanan pelanggan.</p>
        </div>

        <div class="date-info">
            <span>📅</span>
            {{ now()->translatedFormat('d F Y') }}
        </div>
    </div>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- DAFTAR PRODUK --}}
    <div class="section-header">
        <div>
            <h5>Menu Produk Dimsum</h5>
            <p>Pilih produk yang ingin dipesan pelanggan.</p>
        </div>

        <span class="product-total">
            {{ $products->count() }} Produk
        </span>
    </div>

    @if($products->isEmpty())

        <div class="empty-product">
            <div class="empty-icon">🥟</div>
            <h5>Belum Ada Produk</h5>
            <p>
                Belum ada produk yang tersedia untuk transaksi.
                Silakan tambahkan produk melalui Dashboard Admin.
            </p>

            <a href="{{ route('kasir.dashboard') }}"
               class="btn btn-brown">
                Kembali ke Dashboard
            </a>
        </div>

    @else

        <div class="row g-4">

            @foreach($products as $product)

                <div class="col-md-6 col-xl-4">

                    <div class="product-card">

                        {{-- GAMBAR PRODUK --}}
                        <div class="product-image">

                            @if($product->image)
                                <img
                                    src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}"
                                >
                            @else
                                <span>🥟</span>
                            @endif

                        </div>

                        {{-- INFORMASI PRODUK --}}
                        <div class="product-body">

                            <div class="product-category">
                                {{ $product->category->name ?? 'Tanpa kategori' }}
                            </div>

                            <h5>{{ $product->name }}</h5>

                            <p class="product-variant">
                                Varian: {{ $product->variant->name ?? '-' }}
                            </p>

                            @if($product->description)
                                <p class="product-description">
                                    {{ $product->description }}
                                </p>
                            @endif

                            <div class="size-heading">
                                Pilihan Ukuran
                            </div>

                            @forelse($product->sizes as $size)

                                <div class="size-row">

                                    <div>
                                        <strong>{{ $size->name }}</strong>

                                        <small>
                                            @if($size->piece_count)
                                                {{ $size->piece_count }} pcs
                                            @else
                                                {{ $size->unit }}
                                            @endif
                                        </small>
                                    </div>

                                    <div class="text-end">
                                        <strong class="size-price">
                                            Rp{{ number_format($size->price, 0, ',', '.') }}
                                        </strong>

                                        <small>
                                            Stok: {{ $size->stock }}
                                        </small>
                                    </div>

                                </div>

                            @empty

                                <div class="no-size">
                                    Belum ada ukuran aktif.
                                </div>

                            @endforelse

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @endif

    {{-- FOOTER --}}
    <div class="page-footer">
        © 2026 Ranatavan Dimsum · Sistem Informasi Penjualan
    </div>

</div>

@endsection

@push('styles')

<style>

    body {
        background: #f8f5f0;
    }

    .navbar {
        background: #70452c;
    }

    .transaction-page {
        padding: 30px;
        min-height: 100vh;
    }

    /* HEADER */

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 35px;
        gap: 15px;
    }

    .page-label {
        color: #a47c59;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 2px;
    }

    .page-header h2 {
        color: #563522;
        font-weight: 800;
        font-size: 27px;
        margin: 8px 0;
    }

    .page-header p {
        color: #9b8b7e;
        font-size: 13px;
        margin: 0;
    }

    .date-info {
        background: white;
        color: #70452c;
        padding: 12px 16px;
        border-radius: 10px;
        border: 1px solid #eee5db;
        font-size: 12px;
        font-weight: 600;
    }

    /* SECTION */

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .section-header h5 {
        color: #563522;
        font-weight: 800;
        margin-bottom: 5px;
    }

    .section-header p {
        color: #9b8b7e;
        font-size: 12px;
        margin: 0;
    }

    .product-total {
        background: #f0e4d8;
        color: #70452c;
        padding: 8px 14px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
    }

    /* PRODUCT CARD */

    .product-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        height: 100%;
        border: 1px solid #eee5db;
        box-shadow: 0 4px 15px rgba(75,46,27,.04);
        transition: .2s;
    }

    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(75,46,27,.09);
    }

    .product-image {
        height: 180px;
        background: #f2e8dd;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 65px;
        overflow: hidden;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .product-body {
        padding: 20px;
    }

    .product-category {
        display: inline-block;
        background: #f5ece3;
        color: #70452c;
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 10px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .product-body h5 {
        color: #563522;
        font-weight: 800;
        margin-bottom: 7px;
    }

    .product-variant {
        color: #9b8b7e;
        font-size: 12px;
        margin-bottom: 8px;
    }

    .product-description {
        color: #a09287;
        font-size: 11px;
        line-height: 1.6;
    }

    .size-heading {
        color: #563522;
        font-size: 12px;
        font-weight: 800;
        padding-top: 12px;
        border-top: 1px solid #f0e8df;
        margin-top: 12px;
        margin-bottom: 10px;
    }

    /* SIZE */

    .size-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #faf6f1;
        border-radius: 9px;
        padding: 12px;
        margin-bottom: 8px;
    }

    .size-row strong {
        display: block;
        color: #563522;
        font-size: 12px;
    }

    .size-row small {
        display: block;
        color: #a09287;
        font-size: 10px;
        margin-top: 4px;
    }

    .size-row .size-price {
        color: #70452c;
    }

    .no-size {
        color: #a09287;
        background: #faf6f1;
        padding: 12px;
        border-radius: 8px;
        font-size: 11px;
    }

    /* EMPTY */

    .empty-product {
        text-align: center;
        background: white;
        border-radius: 15px;
        padding: 60px 20px;
        border: 1px solid #eee5db;
    }

    .empty-icon {
        font-size: 55px;
        margin-bottom: 15px;
    }

    .empty-product h5 {
        color: #563522;
        font-weight: 800;
    }

    .empty-product p {
        color: #9b8b7e;
        font-size: 12px;
        margin-bottom: 20px;
    }

    .btn-brown {
        background: #70452c;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
    }

    .btn-brown:hover {
        background: #563522;
        color: white;
    }

    .page-footer {
        text-align: center;
        padding: 35px 0 10px;
        color: #aa9c90;
        font-size: 11px;
    }

    /* RESPONSIVE */

    @media(max-width: 767px) {

        .transaction-page {
            padding: 20px 14px;
        }

        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .date-info {
            width: 100%;
        }

        .section-header {
            align-items: flex-start;
        }

    }

</style>

@endpush
