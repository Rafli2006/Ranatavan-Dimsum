@extends('layouts.master')

@section('title', 'Dashboard Kasir')

@section('content')

<div class="admin-dashboard cashier-dashboard">

    {{-- SIDEBAR --}}
    <aside class="admin-sidebar">

        <div class="sidebar-brand">
            <div class="brand-icon">🥟</div>
            <div>
                <h5>Ranatavan</h5>
                <span>DIMSUM MANAGEMENT</span>
            </div>
        </div>

        <div class="sidebar-label">MENU KASIR</div>

        <nav class="sidebar-menu">

            <a href="{{ route('kasir.dashboard') }}"
               class="sidebar-link active">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>

            <a href="#" class="sidebar-link disabled-link">
                <i class="bi bi-cart-plus"></i>
                <span>Transaksi Baru</span>
                <small>Segera</small>
            </a>

            <a href="#" class="sidebar-link disabled-link">
                <i class="bi bi-receipt"></i>
                <span>Riwayat Penjualan</span>
                <small>Segera</small>
            </a>

        </nav>

        <div class="sidebar-label mt-4">INFORMASI</div>

        <div class="cashier-sidebar-note">
            <div class="note-icon">
                <i class="bi bi-cup-hot"></i>
            </div>

            <div>
                <strong>Selamat Bekerja!</strong>
                <p>
                    Berikan pelayanan terbaik kepada pelanggan
                    Ranatavan Dimsum.
                </p>
            </div>
        </div>

        <div class="sidebar-bottom">

            <div class="sidebar-profile">
                <div class="profile-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

                <div class="profile-info">
                    <strong>{{ Auth::user()->name }}</strong>
                    <span>Kasir</span>
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


    {{-- MAIN CONTENT --}}
    <main class="admin-main">

        {{-- TOPBAR --}}
        <header class="admin-topbar">

            <div>
                <div class="topbar-caption">
                    RANATAVAN DIMSUM / CASHIER
                </div>

                <h5>Dashboard Kasir</h5>
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
                        <span>Kasir</span>
                    </div>
                </div>

            </div>

        </header>


        {{-- DASHBOARD CONTENT --}}
        <div class="dashboard-content">

            {{-- WELCOME BANNER --}}
            <section class="cashier-welcome-banner">

                <div class="welcome-content">

                    <span class="welcome-tag">
                        <i class="bi bi-stars"></i>
                        CASHIER OVERVIEW
                    </span>

                    <h2>
                        Selamat Datang,
                        {{ Auth::user()->name }}!
                    </h2>

                    <p>
                        Siap melayani pelanggan hari ini?
                        Kelola pesanan dan berikan pelayanan terbaik
                        bersama Ranatavan Dimsum.
                    </p>

                    <div class="welcome-date">
                        <i class="bi bi-calendar-check"></i>
                        {{ now()->translatedFormat('l, d F Y') }}
                    </div>

                </div>

                <div class="welcome-decoration">
                    <div class="decoration-circle"></div>
                    <span>🥟</span>
                </div>

            </section>


            {{-- SECTION HEADING --}}
            <div class="section-heading">

                <div>
                    <span class="section-eyebrow">
                        AKTIVITAS KASIR
                    </span>

                    <h3>Menu Kasir</h3>

                    <p>
                        Pilih aktivitas yang ingin kamu lakukan.
                    </p>
                </div>

                <div class="section-heading-icon">
                    <i class="bi bi-grid"></i>
                </div>

            </div>


            {{-- MENU CARDS --}}
            <div class="cashier-menu-grid">

                {{-- TRANSAKSI BARU --}}
                <div class="cashier-menu-card">

                    <div class="menu-card-top">

                        <div class="menu-card-icon transaction-icon">
                            <i class="bi bi-cart-plus"></i>
                        </div>

                        <span class="menu-card-number">01</span>

                    </div>

                    <span class="menu-card-label">
                        PENJUALAN
                    </span>

                    <h4>Transaksi Baru</h4>

                    <p>
                        Buat pesanan pelanggan, pilih produk dimsum,
                        tentukan jumlah pesanan, dan proses pembayaran
                        dengan mudah.
                    </p>

                    <a href="#" class="cashier-menu-button primary-menu-button">
                        <span>Mulai Transaksi</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>


                {{-- RIWAYAT PENJUALAN --}}
                <div class="cashier-menu-card">

                    <div class="menu-card-top">

                        <div class="menu-card-icon history-icon">
                            <i class="bi bi-receipt-cutoff"></i>
                        </div>

                        <span class="menu-card-number">02</span>

                    </div>

                    <span class="menu-card-label">
                        DATA PENJUALAN
                    </span>

                    <h4>Riwayat Penjualan</h4>

                    <p>
                        Periksa transaksi yang telah dilakukan
                        dan lihat informasi pesanan pelanggan
                        sebelumnya.
                    </p>

                    <a href="#" class="cashier-menu-button secondary-menu-button">
                        <span>Lihat Riwayat</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

            </div>


            {{-- INFORMATION --}}
            <section class="cashier-information">

                <div class="information-icon">
                    <i class="bi bi-info-lg"></i>
                </div>

                <div class="information-content">
                    <h5>Informasi Penting</h5>

                    <p>
                        Pastikan jumlah produk dan harga sudah sesuai
                        sebelum menyelesaikan transaksi. Stok produk
                        akan diperbarui setelah pembayaran berhasil.
                        Selalu periksa kembali pesanan pelanggan.
                    </p>
                </div>

                <div class="information-decoration">
                    <i class="bi bi-shield-check"></i>
                </div>

            </section>


            {{-- FOOTER --}}
            <footer class="dashboard-footer">
                <span>
                    © {{ date('Y') }} Ranatavan Dimsum
                </span>

                <span>
                    Cashier Management System
                </span>
            </footer>

        </div>

    </main>

</div>

@endsection


@push('styles')
<style>

/* ==========================================
   RANATAVAN DIMSUM - CASHIER DASHBOARD
   MODERN ORANGE & WHITE
========================================== */

.cashier-dashboard {
    --orange: #f07828;
    --orange-dark: #d95d16;
    --orange-light: #ff9d52;
    --peach: #fff1e5;
    --brown: #713d25;
    --text: #38271f;
    --muted: #9b8980;

    display: flex;
    min-height: 100vh;
    background: #fff9f4;
    color: var(--text);
    font-family: 'DM Sans', Arial, sans-serif;
}


/* SIDEBAR */

.cashier-dashboard .admin-sidebar {
    width: 258px;
    min-width: 258px;
    min-height: 100vh;
    background: #fff;
    border-right: 1px solid #f4e5d9;
    padding: 27px 17px 18px;
    display: flex;
    flex-direction: column;
}

.cashier-dashboard .sidebar-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 0 9px;
    margin-bottom: 42px;
}

.cashier-dashboard .brand-icon {
    width: 47px;
    height: 47px;
    border-radius: 15px;
    background: linear-gradient(135deg, #ff9d52, #e85f18);
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 25px;
    box-shadow: 0 6px 15px rgba(240, 120, 40, .2);
}

.cashier-dashboard .sidebar-brand h5 {
    font-size: 18px;
    font-weight: 800;
    color: var(--brown);
    margin: 0;
}

.cashier-dashboard .sidebar-brand span {
    font-size: 9px;
    letter-spacing: 1.3px;
    color: var(--muted);
    font-weight: 700;
}

.cashier-dashboard .sidebar-label {
    color: #b4a49b;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1.5px;
    padding: 0 12px;
    margin-bottom: 12px;
}

.cashier-dashboard .sidebar-menu {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.cashier-dashboard .sidebar-link {
    display: flex;
    align-items: center;
    gap: 12px;
    min-height: 45px;
    padding: 0 13px;
    border-radius: 10px;
    text-decoration: none;
    color: #79675e;
    font-size: 13px;
    font-weight: 600;
    transition: .2s;
}

.cashier-dashboard .sidebar-link i {
    font-size: 17px;
}

.cashier-dashboard .sidebar-link:hover {
    color: var(--orange-dark);
    background: #fff5ed;
}

.cashier-dashboard .sidebar-link.active {
    color: #fff;
    background: linear-gradient(120deg, #f58b3e, #e96620);
    box-shadow: 0 5px 12px rgba(232, 95, 24, .2);
}

.cashier-dashboard .disabled-link {
    opacity: .55;
    cursor: not-allowed;
}

.cashier-dashboard .disabled-link small {
    margin-left: auto;
    font-size: 9px;
    background: #f4eee9;
    padding: 3px 6px;
    border-radius: 5px;
}


/* SIDEBAR INFORMATION */

.cashier-dashboard .cashier-sidebar-note {
    display: flex;
    align-items: flex-start;
    gap: 11px;
    background: #fff5ed;
    border: 1px solid #ffe5d3;
    border-radius: 12px;
    padding: 15px 12px;
    margin: 5px 4px 0;
}

.cashier-dashboard .note-icon {
    width: 34px;
    height: 34px;
    flex-shrink: 0;
    background: #ffe4d0;
    color: var(--orange-dark);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 17px;
}

.cashier-dashboard .cashier-sidebar-note strong {
    display: block;
    font-size: 11px;
    color: var(--brown);
    margin-bottom: 5px;
}

.cashier-dashboard .cashier-sidebar-note p {
    color: #9b8274;
    font-size: 10px;
    line-height: 1.6;
    margin: 0;
}


/* PROFILE */

.cashier-dashboard .sidebar-bottom {
    margin-top: auto;
    padding-top: 25px;
}

.cashier-dashboard .sidebar-profile {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 8px;
    border-top: 1px solid #f3e9e2;
}

.cashier-dashboard .profile-avatar,
.cashier-dashboard .topbar-avatar {
    width: 38px;
    height: 38px;
    border-radius: 12px;
    background: var(--peach);
    color: var(--orange-dark);
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: 800;
}

.cashier-dashboard .profile-info {
    display: flex;
    flex-direction: column;
    min-width: 0;
}

.cashier-dashboard .profile-info strong {
    font-size: 12px;
    color: var(--brown);
}

.cashier-dashboard .profile-info span {
    font-size: 10px;
    color: var(--muted);
}

.cashier-dashboard .logout-button {
    width: 100%;
    border: 0;
    background: #fff3eb;
    color: #c65b27;
    border-radius: 9px;
    padding: 11px;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
    transition: .2s;
}

.cashier-dashboard .logout-button:hover {
    background: #ffe4d2;
}


/* MAIN AREA */

.cashier-dashboard .admin-main {
    flex: 1;
    min-width: 0;
}

.cashier-dashboard .admin-topbar {
    min-height: 83px;
    background: #fff;
    border-bottom: 1px solid #f4e5d9;
    padding: 15px 36px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}

.cashier-dashboard .topbar-caption {
    font-size: 9px;
    color: #b19b8e;
    font-weight: 800;
    letter-spacing: 1.5px;
    margin-bottom: 5px;
}

.cashier-dashboard .admin-topbar h5 {
    color: var(--brown);
    font-size: 19px;
    font-weight: 800;
    margin: 0;
}

.cashier-dashboard .topbar-right {
    display: flex;
    align-items: center;
    gap: 25px;
}

.cashier-dashboard .topbar-date {
    color: #88766d;
    font-size: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.cashier-dashboard .topbar-user {
    display: flex;
    align-items: center;
    gap: 10px;
}

.cashier-dashboard .topbar-user strong {
    display: block;
    font-size: 12px;
    color: var(--brown);
}

.cashier-dashboard .topbar-user span {
    display: block;
    font-size: 10px;
    color: var(--muted);
}


/* CONTENT */

.cashier-dashboard .dashboard-content {
    max-width: 1600px;
    padding: 30px 36px;
    margin: auto;
}


/* WELCOME BANNER */

.cashier-dashboard .cashier-welcome-banner {
    position: relative;
    overflow: hidden;
    min-height: 215px;
    padding: 32px 38px;
    border-radius: 18px;
    background: linear-gradient(115deg, #fff0e3, #ffe1c8);
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 35px;
}

.cashier-dashboard .welcome-content {
    position: relative;
    z-index: 2;
    max-width: 650px;
}

.cashier-dashboard .welcome-tag {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    color: #d96524;
    background: rgba(255,255,255,.7);
    border: 1px solid rgba(240,120,40,.12);
    border-radius: 30px;
    padding: 7px 12px;
    font-size: 9px;
    font-weight: 800;
    letter-spacing: 1px;
}

.cashier-dashboard .cashier-welcome-banner h2 {
    color: var(--brown);
    font-size: 29px;
    font-weight: 800;
    margin: 16px 0 9px;
}

.cashier-dashboard .cashier-welcome-banner p {
    color: #95766a;
    font-size: 13px;
    line-height: 1.8;
    margin: 0;
    max-width: 560px;
}

.cashier-dashboard .welcome-date {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #b36a3d;
    font-size: 11px;
    font-weight: 700;
    margin-top: 17px;
}

.cashier-dashboard .welcome-decoration {
    position: relative;
    width: 190px;
    height: 160px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.cashier-dashboard .decoration-circle {
    position: absolute;
    width: 145px;
    height: 145px;
    border-radius: 50%;
    background: rgba(255,255,255,.55);
}

.cashier-dashboard .welcome-decoration span {
    position: relative;
    z-index: 1;
    font-size: 95px;
    transform: rotate(-12deg);
    filter: drop-shadow(0 8px 10px rgba(130,70,30,.12));
}


/* SECTION HEADING */

.cashier-dashboard .section-heading {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.cashier-dashboard .section-eyebrow {
    color: var(--orange);
    font-size: 9px;
    font-weight: 800;
    letter-spacing: 1.5px;
}

.cashier-dashboard .section-heading h3 {
    color: var(--brown);
    font-size: 21px;
    font-weight: 800;
    margin: 5px 0;
}

.cashier-dashboard .section-heading p {
    color: var(--muted);
    font-size: 12px;
    margin: 0;
}

.cashier-dashboard .section-heading-icon {
    width: 43px;
    height: 43px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff0e3;
    color: var(--orange-dark);
    font-size: 19px;
}


/* MENU GRID */

.cashier-dashboard .cashier-menu-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 22px;
}

.cashier-dashboard .cashier-menu-card {
    background: #fff;
    border: 1px solid #f1e5dc;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 5px 18px rgba(91, 54, 31, .035);
    transition: .25s;
}

.cashier-dashboard .cashier-menu-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px rgba(91, 54, 31, .09);
    border-color: #f5d5bd;
}

.cashier-dashboard .menu-card-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.cashier-dashboard .menu-card-icon {
    width: 55px;
    height: 55px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 25px;
}

.cashier-dashboard .transaction-icon {
    background: #fff0e3;
    color: #e66e27;
}

.cashier-dashboard .history-icon {
    background: #fff4e8;
    color: #bc7940;
}

.cashier-dashboard .menu-card-number {
    font-size: 25px;
    font-weight: 800;
    color: #f1e7df;
}

.cashier-dashboard .menu-card-label {
    color: #b27c59;
    font-size: 9px;
    font-weight: 800;
    letter-spacing: 1.5px;
}

.cashier-dashboard .cashier-menu-card h4 {
    color: var(--brown);
    font-size: 20px;
    font-weight: 800;
    margin: 9px 0;
}

.cashier-dashboard .cashier-menu-card p {
    color: #968a80;
    font-size: 12px;
    line-height: 1.8;
    min-height: 65px;
    margin-bottom: 22px;
}

.cashier-dashboard .cashier-menu-button {
    min-height: 44px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 0 15px;
    border-radius: 9px;
    text-decoration: none;
    font-size: 12px;
    font-weight: 700;
    transition: .2s;
}

.cashier-dashboard .primary-menu-button {
    color: #fff;
    background: linear-gradient(120deg, #f58b3e, #e96620);
    box-shadow: 0 5px 12px rgba(232,95,24,.15);
}

.cashier-dashboard .primary-menu-button:hover {
    color: #fff;
    background: linear-gradient(120deg, #e9772b, #d95512);
}

.cashier-dashboard .secondary-menu-button {
    color: var(--brown);
    background: #fff;
    border: 1px solid #eaded5;
}

.cashier-dashboard .secondary-menu-button:hover {
    color: var(--orange-dark);
    background: #fff5ed;
    border-color: #f5d5bd;
}


/* INFORMATION */

.cashier-dashboard .cashier-information {
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: flex-start;
    gap: 15px;
    background: #fff4e9;
    border: 1px solid #ffe2c9;
    border-radius: 13px;
    padding: 20px;
    margin-top: 28px;
}

.cashier-dashboard .information-icon {
    width: 37px;
    height: 37px;
    flex-shrink: 0;
    border-radius: 11px;
    background: #ffe4d0;
    color: var(--orange-dark);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 19px;
}

.cashier-dashboard .information-content {
    position: relative;
    z-index: 1;
}

.cashier-dashboard .information-content h5 {
    color: var(--brown);
    font-size: 13px;
    font-weight: 800;
    margin: 2px 0 7px;
}

.cashier-dashboard .information-content p {
    color: #957b6d;
    font-size: 11px;
    line-height: 1.8;
    margin: 0;
}

.cashier-dashboard .information-decoration {
    position: absolute;
    right: 25px;
    top: 50%;
    transform: translateY(-50%);
    color: rgba(240,120,40,.12);
    font-size: 65px;
}


/* FOOTER */

.cashier-dashboard .dashboard-footer {
    display: flex;
    justify-content: space-between;
    gap: 15px;
    border-top: 1px solid #f0e5dc;
    padding-top: 20px;
    margin-top: 40px;
    color: #a7958a;
    font-size: 10px;
}


/* RESPONSIVE */

@media (max-width: 1000px) {

    .cashier-dashboard .admin-sidebar {
        width: 225px;
        min-width: 225px;
    }

    .cashier-dashboard .dashboard-content {
        padding: 25px 22px;
    }

    .cashier-dashboard .admin-topbar {
        padding: 15px 22px;
    }

}

@media (max-width: 700px) {

    .cashier-dashboard {
        flex-direction: column;
    }

    .cashier-dashboard .admin-sidebar {
        width: 100%;
        min-width: 100%;
        min-height: auto;
        padding: 17px;
    }

    .cashier-dashboard .sidebar-brand {
        margin-bottom: 20px;
    }

    .cashier-dashboard .sidebar-menu {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .cashier-dashboard .sidebar-bottom {
        margin-top: 15px;
    }

    .cashier-dashboard .admin-topbar {
        padding: 15px;
    }

    .cashier-dashboard .topbar-date {
        display: none;
    }

    .cashier-dashboard .dashboard-content {
        padding: 18px 14px;
    }

    .cashier-dashboard .cashier-welcome-banner {
        padding: 25px 20px;
        min-height: 190px;
    }

    .cashier-dashboard .cashier-welcome-banner h2 {
        font-size: 23px;
    }

    .cashier-dashboard .cashier-welcome-banner p {
        font-size: 12px;
    }

    .cashier-dashboard .welcome-decoration {
        width: 85px;
    }

    .cashier-dashboard .welcome-decoration span {
        font-size: 58px;
    }

    .cashier-dashboard .decoration-circle {
        width: 85px;
        height: 85px;
    }

    .cashier-dashboard .cashier-menu-grid {
        grid-template-columns: 1fr;
    }

    .cashier-dashboard .cashier-menu-card p {
        min-height: auto;
    }

    .cashier-dashboard .topbar-user {
        display: none;
    }

    .cashier-dashboard .dashboard-footer {
        flex-direction: column;
        gap: 7px;
    }

}

@media (max-width: 420px) {

    .cashier-dashboard .welcome-decoration {
        display: none;
    }

    .cashier-dashboard .section-heading-icon {
        display: none;
    }

}

</style>
@endpush
