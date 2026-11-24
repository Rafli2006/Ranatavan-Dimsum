@extends('layouts.master')

@section('title', 'Dashboard Kasir')

@section('content')

<div class="cashier-page">

    {{-- NAVBAR --}}
    <nav class="navbar navbar-dark cashier-navbar">
        <div class="container-fluid px-4">

            <a class="navbar-brand d-flex align-items-center gap-2"
               href="{{ route('kasir.dashboard') }}">
                <span class="cashier-logo">🥟</span>
                <span>
                    Ranatavan Dimsum
                    <small class="d-block cashier-subtitle">CASHIER PANEL</small>
                </span>
            </a>

            <div class="ms-auto d-flex align-items-center gap-3">
                <div class="cashier-user text-end">
                    <span class="d-block text-white fw-semibold">
                        {{ Auth::user()->name }}
                    </span>
                    <small class="text-light opacity-75">Kasir</small>
                </div>

                <div class="cashier-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn cashier-logout">
                        Keluar
                    </button>
                </form>
            </div>

        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">

            {{-- SIDEBAR --}}
            <aside class="col-md-3 col-lg-2 cashier-sidebar">

                <p class="cashier-menu-title">MENU KASIR</p>

                <a href="{{ route('kasir.dashboard') }}"
                   class="cashier-link active">
                    <span>⌂</span> Dashboard
                </a>

                <a href="#" class="cashier-link">
                    <span>▣</span> Transaksi Baru
                </a>

                <a href="#" class="cashier-link">
                    <span>▤</span> Riwayat Penjualan
                </a>

                <div class="cashier-sidebar-note">
                    <span>☕</span>
                    <p class="fw-semibold mb-1">Selamat Bekerja!</p>
                    <small>Berikan pelayanan terbaik kepada pelanggan.</small>
                </div>

            </aside>

            {{-- KONTEN --}}
            <main class="col-md-9 col-lg-10 cashier-content">

                <div class="cashier-heading">
                    <div>
                        <span class="cashier-eyebrow">CASHIER OVERVIEW</span>
                        <h2>Dashboard Kasir</h2>
                        <p>
                            Selamat datang, {{ Auth::user()->name }}!
                            Siap melayani pelanggan hari ini?
                        </p>
                    </div>

                    <div class="cashier-date">
                        📅 {{ now()->translatedFormat('d F Y') }}
                    </div>
                </div>

                {{-- BANNER --}}
                <div class="cashier-banner">
                    <div>
                        <span class="cashier-banner-label">RANATAVAN DIMSUM</span>
                        <h3>Selamat Bekerja!</h3>
                        <p>
                            Layani pelanggan dengan ramah dan pastikan
                            setiap transaksi dicatat dengan benar.
                        </p>
                    </div>

                    <div class="cashier-banner-icon">🥟</div>
                </div>

                {{-- MENU TRANSAKSI --}}
                <div class="cashier-section-heading">
                    <h5>Menu Kasir</h5>
                    <p>Pilih aktivitas yang ingin dilakukan</p>
                </div>

                <div class="row g-4">

                    <div class="col-lg-6">
                        <div class="cashier-action-card">
                            <div class="cashier-action-icon">🛒</div>

                            <span class="cashier-action-label">PENJUALAN</span>

                            <h4>Transaksi Baru</h4>

                            <p>
                                Buat pesanan pelanggan, pilih produk dimsum,
                                tentukan jumlah pesanan, dan proses pembayaran.
                            </p>

                            <a href="#" class="btn cashier-primary-btn">
                                Mulai Transaksi <span>→</span>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="cashier-action-card">
                            <div class="cashier-action-icon">📋</div>

                            <span class="cashier-action-label">DATA PENJUALAN</span>

                            <h4>Riwayat Penjualan</h4>

                            <p>
                                Periksa transaksi yang telah dilakukan
                                dan lihat informasi pesanan pelanggan.
                            </p>

                            <a href="#" class="btn cashier-secondary-btn">
                                Lihat Riwayat <span>→</span>
                            </a>
                        </div>
                    </div>

                </div>

                {{-- INFORMASI --}}
                <div class="cashier-information">
                    <div class="cashier-information-icon">ℹ</div>
                    <div>
                        <h6>Informasi Penting</h6>
                        <p>
                            Pastikan jumlah produk dan harga sudah sesuai
                            sebelum menyelesaikan transaksi. Stok produk
                            akan diperbarui setelah pembayaran berhasil.
                        </p>
                    </div>
                </div>

                <div class="cashier-footer">
                    © {{ date('Y') }} Ranatavan Dimsum · Cashier Dashboard
                </div>

            </main>

        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .cashier-page {
        min-height: 100vh;
        background: #f8f5f0;
    }

    .cashier-navbar {
        min-height: 70px;
        background: #563522;
        box-shadow: 0 3px 12px rgba(50,30,15,.12);
    }

    .cashier-logo {
        width: 40px;
        height: 40px;
        display: grid;
        place-items: center;
        background: rgba(255,255,255,.13);
        border-radius: 12px;
        font-size: 22px;
    }

    .cashier-navbar .navbar-brand {
        font-size: 16px;
        line-height: 1.2;
    }

    .cashier-subtitle {
        color: #dfbd9a;
        font-size: 9px;
        letter-spacing: 2px;
        margin-top: 4px;
    }

    .cashier-avatar {
        width: 37px;
        height: 37px;
        border-radius: 50%;
        background: #d9b58e;
        color: #563522;
        display: grid;
        place-items: center;
        font-weight: bold;
    }

    .cashier-logout {
        background: #fff7ec;
        color: #70452c;
        font-size: 12px;
        font-weight: bold;
        border-radius: 8px;
        padding: 8px 14px;
    }

    .cashier-logout:hover {
        background: #e9d6c1;
        color: #563522;
    }

    .cashier-sidebar {
        background: #70452c;
        min-height: calc(100vh - 70px);
        padding: 28px 16px;
    }

    .cashier-menu-title {
        color: #d9b99a;
        font-size: 10px;
        letter-spacing: 1.5px;
        font-weight: bold;
        padding: 0 10px;
        margin-bottom: 13px;
    }

    .cashier-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 13px 12px;
        color: #f8eee4;
        text-decoration: none;
        border-radius: 9px;
        font-size: 13px;
        margin-bottom: 6px;
        transition: .2s;
    }

    .cashier-link span {
        width: 22px;
        text-align: center;
        font-size: 17px;
    }

    .cashier-link:hover,
    .cashier-link.active {
        background: #946747;
        color: white;
    }

    .cashier-sidebar-note {
        background: rgba(255,255,255,.09);
        border-radius: 12px;
        color: white;
        padding: 16px;
        margin-top: 45px;
        font-size: 12px;
    }

    .cashier-sidebar-note > span {
        font-size: 24px;
    }

    .cashier-sidebar-note small {
        color: #e0c7ae;
        font-size: 10px;
        line-height: 1.6;
    }

    .cashier-content {
        padding: 30px;
    }

    .cashier-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 25px;
    }

    .cashier-eyebrow {
        color: #a47c59;
        font-size: 10px;
        letter-spacing: 2px;
        font-weight: bold;
    }

    .cashier-heading h2 {
        color: #563522;
        font-weight: 800;
        font-size: 27px;
        margin: 6px 0;
    }

    .cashier-heading p {
        color: #96887d;
        font-size: 13px;
        margin: 0;
    }

    .cashier-date {
        background: white;
        border: 1px solid #eee3d7;
        border-radius: 10px;
        padding: 10px 14px;
        color: #70452c;
        font-size: 12px;
    }

    .cashier-banner {
        background: linear-gradient(120deg, #805337, #563522);
        border-radius: 16px;
        padding: 30px 32px;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
    }

    .cashier-banner-label {
        color: #e9c69e;
        font-size: 10px;
        font-weight: bold;
        letter-spacing: 2px;
    }

    .cashier-banner h3 {
        font-size: 26px;
        font-weight: 800;
        margin: 10px 0;
    }

    .cashier-banner p {
        color: #ead9c8;
        font-size: 13px;
        margin: 0;
        line-height: 1.7;
    }

    .cashier-banner-icon {
        font-size: 85px;
        padding: 0 25px;
    }

    .cashier-section-heading {
        margin-bottom: 17px;
    }

    .cashier-section-heading h5 {
        color: #563522;
        font-weight: 800;
        margin-bottom: 4px;
    }

    .cashier-section-heading p {
        color: #a09287;
        font-size: 12px;
    }

    .cashier-action-card {
        height: 100%;
        background: white;
        border: 1px solid #f0e8df;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(75,46,27,.04);
        transition: .2s;
    }

    .cashier-action-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 9px 22px rgba(75,46,27,.09);
    }

    .cashier-action-icon {
        width: 55px;
        height: 55px;
        display: grid;
        place-items: center;
        background: #f4e9dd;
        border-radius: 14px;
        font-size: 27px;
        margin-bottom: 18px;
    }

    .cashier-action-label {
        color: #a47c59;
        font-size: 10px;
        font-weight: bold;
        letter-spacing: 1.5px;
    }

    .cashier-action-card h4 {
        color: #563522;
        font-size: 21px;
        font-weight: 800;
        margin: 9px 0;
    }

    .cashier-action-card p {
        color: #968a80;
        font-size: 12px;
        line-height: 1.8;
        min-height: 65px;
    }

    .cashier-primary-btn,
    .cashier-secondary-btn {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 15px;
        border-radius: 9px;
        font-size: 12px;
        font-weight: bold;
    }

    .cashier-primary-btn {
        background: #70452c;
        color: white;
    }

    .cashier-primary-btn:hover {
        background: #563522;
        color: white;
    }

    .cashier-secondary-btn {
        border: 1px solid #d9c7b5;
        color: #70452c;
    }

    .cashier-secondary-btn:hover {
        background: #f4e9dd;
        color: #563522;
    }

    .cashier-information {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        background: #f1e7da;
        border: 1px solid #e6d5c2;
        border-radius: 13px;
        padding: 20px;
        margin-top: 28px;
    }

    .cashier-information-icon {
        width: 35px;
        height: 35px;
        flex-shrink: 0;
        background: #70452c;
        color: white;
        display: grid;
        place-items: center;
        border-radius: 50%;
        font-weight: bold;
    }

    .cashier-information h6 {
        color: #563522;
        font-weight: bold;
    }

    .cashier-information p {
        color: #816b59;
        font-size: 12px;
        line-height: 1.7;
        margin: 0;
    }

    .cashier-footer {
        text-align: center;
        color: #aa9c90;
        font-size: 11px;
        padding: 30px 0 5px;
    }

    @media (max-width: 767px) {
        .cashier-sidebar {
            min-height: auto;
        }

        .cashier-content {
            padding: 20px 15px;
        }

        .cashier-heading {
            flex-direction: column;
            align-items: flex-start;
        }

        .cashier-banner-icon {
            display: none;
        }

        .cashier-user {
            display: none;
        }
    }
</style>
@endpush
