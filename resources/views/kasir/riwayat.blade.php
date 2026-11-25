@extends('layouts.master')

@section('title', 'Riwayat Penjualan')

@section('content')

<div class="admin-dashboard cashier-dashboard cashier-history-page">

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
               class="sidebar-link {{ request()->routeIs('kasir.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('kasir.transaksi') }}"
               class="sidebar-link {{ request()->routeIs('kasir.transaksi') ? 'active' : '' }}">
                <i class="bi bi-cart-plus"></i>
                <span>Transaksi Baru</span>
            </a>

            <a href="{{ route('kasir.riwayat') }}"
               class="sidebar-link {{ request()->routeIs('kasir.riwayat*') ? 'active' : '' }}">
                <i class="bi bi-receipt"></i>
                <span>Riwayat Penjualan</span>
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
                    {{ strtoupper(substr(Auth::user()->name ?? 'K', 0, 1)) }}
                </div>

                <div class="profile-info">
                    <strong>{{ Auth::user()->name ?? 'Kasir Ranatavan' }}</strong>
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

                <h5>Riwayat Penjualan</h5>
            </div>

            <div class="topbar-right">

                <div class="topbar-date">
                    <i class="bi bi-calendar3"></i>
                    {{ now()->translatedFormat('d F Y') }}
                </div>

                <a href="{{ route('kasir.dashboard') }}" class="btn-back-orange">
                    <i class="bi bi-arrow-left"></i>
                    <span>Kembali</span>
                </a>

                <div class="topbar-user">
                    <div class="topbar-avatar">
                        {{ strtoupper(substr(Auth::user()->name ?? 'K', 0, 1)) }}
                    </div>

                    <div>
                        <strong>{{ Auth::user()->name ?? 'Kasir Ranatavan' }}</strong>
                        <span>Kasir</span>
                    </div>
                </div>

            </div>

        </header>


        {{-- CONTENT --}}
        <div class="dashboard-content">

            {{-- HEADER BANNER --}}
            <section class="cashier-welcome-banner history-banner">

                <div class="welcome-content">

                    <span class="welcome-tag">
                        <i class="bi bi-receipt-cutoff"></i>
                        SALES HISTORY
                    </span>

                    <h2>Riwayat Penjualan</h2>

                    <p>
                        Daftar transaksi yang telah diproses oleh kasir.
                        Pantau total pemasukan dan rincian pesanan pelanggan.
                    </p>

                    <div class="welcome-date">
                        <i class="bi bi-calendar-check"></i>
                        {{ now()->translatedFormat('l, d F Y') }}
                    </div>

                </div>

                <div class="welcome-decoration">
                    <div class="decoration-circle"></div>
                    <span>🧾</span>
                </div>

            </section>


            {{-- SECTION HEADING --}}
            <div class="section-heading">

                <div>
                    <span class="section-eyebrow">
                        DATA TRANSAKSI
                    </span>

                    <h3>Daftar Transaksi</h3>

                    <p>
                        Pantau total pemasukan dan rincian pesanan.
                    </p>
                </div>

                <div class="history-count-badge">
                    {{ isset($riwayat) ? $riwayat->count() : 0 }} Transaksi
                </div>

            </div>


            {{-- FILTER & TABLE CARD --}}
            <div class="history-panel-card">

                <form method="GET" action="{{ route('kasir.riwayat') }}" class="history-filter-form">
                    <input type="text"
                           name="cari"
                           value="{{ request('cari') }}"
                           class="history-input"
                           placeholder="Cari ID / kode transaksi...">

                    <input type="date"
                           name="tanggal"
                           value="{{ request('tanggal') }}"
                           class="history-input history-date-input">

                    <button type="submit" class="history-btn-primary">
                        <i class="bi bi-funnel"></i>
                        <span>Filter</span>
                    </button>

                    @if(request()->filled('cari') || request()->filled('tanggal'))
                        <a href="{{ route('kasir.riwayat') }}" class="history-btn-reset">
                            Reset
                        </a>
                    @endif
                </form>

                @if(isset($riwayat) && $riwayat->count() > 0)
                    <div class="table-responsive">
                        <table class="history-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID / Kode</th>
                                    <th>Tanggal &amp; Waktu</th>
                                    <th>Total Bayar</th>
                                    <th>Dibayar</th>
                                    <th>Kembalian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($riwayat as $index => $item)
                                    @php
                                        $kode = $item->kode_transaksi ?? $item->order_code ?? ('#' . $item->id);
                                        $total = $item->total_harga ?? $item->total ?? 0;
                                        $bayar = $item->uang_bayar ?? $item->paid_amount ?? $item->bayar ?? 0;
                                        $kembali = $item->kembalian ?? $item->change_amount ?? max(0, $bayar - $total);
                                    @endphp
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td><strong>{{ $kode }}</strong></td>
                                        <td>{{ $item->created_at ? $item->created_at->format('d/m/Y H:i') : '-' }}</td>
                                        <td><strong class="history-amount">Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
                                        <td>Rp {{ number_format($bayar, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($kembali, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="history-empty-state">
                        <div class="empty-icon-wrap">🧾</div>
                        <h4>Belum Ada Transaksi</h4>
                        <p>
                            Belum ada data riwayat penjualan yang tercatat. Buat transaksi baru terlebih dahulu.
                        </p>
                        <a href="{{ route('kasir.transaksi') }}" class="history-btn-primary">
                            <i class="bi bi-cart-plus"></i>
                            <span>Buat Transaksi Baru</span>
                        </a>
                    </div>
                @endif

            </div>


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
   RANATAVAN DIMSUM - CASHIER THEME
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
    gap: 18px;
}

.cashier-dashboard .topbar-date {
    color: #88766d;
    font-size: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.cashier-dashboard .btn-back-orange {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 14px;
    border-radius: 9px;
    background: #fff3eb;
    border: 1px solid #ffd8be;
    color: var(--orange-dark);
    font-size: 12px;
    font-weight: 700;
    text-decoration: none;
    transition: .2s;
}

.cashier-dashboard .btn-back-orange:hover {
    background: #ffe4d2;
    color: var(--brown);
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

/* BANNER */

.cashier-dashboard .cashier-welcome-banner {
    position: relative;
    overflow: hidden;
    min-height: 185px;
    padding: 28px 34px;
    border-radius: 18px;
    background: linear-gradient(115deg, #fff0e3, #ffe1c8);
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 30px;
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
    font-size: 27px;
    font-weight: 800;
    margin: 14px 0 8px;
}

.cashier-dashboard .cashier-welcome-banner p {
    color: #95766a;
    font-size: 13px;
    line-height: 1.75;
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
    margin-top: 15px;
}

.cashier-dashboard .welcome-decoration {
    position: relative;
    width: 170px;
    height: 145px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.cashier-dashboard .decoration-circle {
    position: absolute;
    width: 135px;
    height: 135px;
    border-radius: 50%;
    background: rgba(255,255,255,.55);
}

.cashier-dashboard .welcome-decoration span {
    position: relative;
    z-index: 1;
    font-size: 82px;
    transform: rotate(-10deg);
    filter: drop-shadow(0 8px 10px rgba(130,70,30,.12));
}

/* SECTION HEADING */

.cashier-dashboard .section-heading {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 18px;
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

.cashier-dashboard .history-count-badge {
    background: #fff0e3;
    border: 1px solid #ffd9bc;
    color: var(--orange-dark);
    font-size: 12px;
    font-weight: 800;
    padding: 8px 14px;
    border-radius: 999px;
}

/* PANEL CARD & FILTER */

.cashier-history-page .history-panel-card {
    background: #fff;
    border: 1px solid #f1e5dc;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 5px 18px rgba(91, 54, 31, .035);
}

.cashier-history-page .history-filter-form {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 22px;
}

.cashier-history-page .history-input {
    min-width: 220px;
    padding: 10px 14px;
    border: 1px solid #eaded5;
    border-radius: 10px;
    font-size: 13px;
    color: var(--text);
    background: #fffdfb;
}

.cashier-history-page .history-input:focus {
    outline: none;
    border-color: var(--orange);
    box-shadow: 0 0 0 3px rgba(240, 120, 40, .14);
}

.cashier-history-page .history-btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 18px;
    border: none;
    border-radius: 10px;
    background: linear-gradient(120deg, #f58b3e, #e96620);
    color: #fff;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    cursor: pointer;
    box-shadow: 0 5px 12px rgba(232,95,24,.15);
    transition: .2s;
}

.cashier-history-page .history-btn-primary:hover {
    color: #fff;
    background: linear-gradient(120deg, #e9772b, #d95512);
}

.cashier-history-page .history-btn-reset {
    display: inline-flex;
    align-items: center;
    padding: 10px 15px;
    border-radius: 10px;
    border: 1px solid #eaded5;
    background: #fff;
    color: var(--brown);
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
}

.cashier-history-page .history-btn-reset:hover {
    background: #fff5ed;
    color: var(--orange-dark);
}

/* TABLE */

.cashier-history-page .history-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
}

.cashier-history-page .history-table thead th {
    background: #fff9f4;
    color: var(--brown);
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: .7px;
    padding: 12px 14px;
    border-bottom: 1px solid #f1e5dc;
    text-align: left;
}

.cashier-history-page .history-table tbody td {
    padding: 13px 14px;
    border-bottom: 1px solid #f4ebe4;
    vertical-align: middle;
}

.cashier-history-page .history-amount {
    color: var(--orange-dark);
}

/* EMPTY STATE */

.cashier-history-page .history-empty-state {
    text-align: center;
    padding: 44px 20px;
    background: #fff9f4;
    border: 1px dashed #f0d8c5;
    border-radius: 14px;
}

.cashier-history-page .empty-icon-wrap {
    width: 64px;
    height: 64px;
    margin: 0 auto 14px;
    border-radius: 18px;
    background: #fff0e3;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
}

.cashier-history-page .history-empty-state h4 {
    color: var(--brown);
    font-size: 18px;
    font-weight: 800;
    margin-bottom: 6px;
}

.cashier-history-page .history-empty-state p {
    color: var(--muted);
    font-size: 13px;
    max-width: 440px;
    margin: 0 auto 20px;
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
        padding: 22px 18px;
        min-height: 170px;
    }

    .cashier-dashboard .cashier-welcome-banner h2 {
        font-size: 22px;
    }

    .cashier-dashboard .welcome-decoration {
        width: 80px;
    }

    .cashier-dashboard .welcome-decoration span {
        font-size: 52px;
    }

    .cashier-dashboard .decoration-circle {
        width: 80px;
        height: 80px;
    }

    .cashier-history-page .history-input {
        min-width: 100%;
    }

    .cashier-dashboard .topbar-user {
        display: none;
    }

    .cashier-dashboard .dashboard-footer {
        flex-direction: column;
        gap: 7px;
    }
}

</style>
@endpush