@extends('layouts.master')

@section('title', 'Dashboard Kasir')

@section('content')

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="#">Ranatavan Dimsum | Kasir</a>

        <div class="ms-auto d-flex align-items-center gap-3">
            <span class="text-white">
                {{ Auth::user()->name }}
            </span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-light btn-sm">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">

        <div class="col-md-3 col-lg-2 sidebar">
            <h6 class="text-white mb-4">MENU KASIR</h6>

            <a href="{{ route('kasir.dashboard') }}">Dashboard</a>
            <a href="#">Transaksi Baru</a>
            <a href="#">Riwayat Penjualan</a>
        </div>

        <div class="col-md-9 col-lg-10 content">

            <h3 class="fw-bold mb-2">Dashboard Kasir</h3>

            <p class="text-muted">
                Selamat datang, {{ Auth::user()->name }}!
                Selamat bekerja dan melayani pelanggan Ranatavan Dimsum.
            </p>

            <div class="row g-3 mt-3">

                <div class="col-md-6">
                    <div class="card p-4">
                        <h5 class="fw-bold">Transaksi Baru</h5>

                        <p class="text-muted">
                            Buat pesanan baru dan proses pembayaran pelanggan.
                        </p>

                        <a href="#" class="btn btn-cokelat">
                            Mulai Transaksi
                        </a>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card p-4">
                        <h5 class="fw-bold">Riwayat Penjualan</h5>

                        <p class="text-muted">
                            Lihat daftar transaksi yang pernah dilakukan.
                        </p>

                        <a href="#" class="btn btn-outline-secondary">
                            Lihat Riwayat
                        </a>
                    </div>
                </div>

            </div>

            <div class="card p-4 mt-4">
                <h5 class="fw-bold">Informasi</h5>

                <p class="text-muted mb-0">
                    Pastikan setiap transaksi dicatat dengan benar.
                    Stok produk akan diperbarui setelah pembayaran berhasil.
                </p>
            </div>

        </div>
    </div>
</div>

@endsection
