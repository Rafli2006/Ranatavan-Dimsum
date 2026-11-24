@extends('layouts.master')

@section('title', 'Dashboard Admin')

@section('content')

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="#">Ranatavan Dimsum | Admin</a>

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
            <h6 class="text-white mb-4">MENU ADMIN</h6>

            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="#">Data Kasir</a>
            <a href="#">Data Kategori</a>
            <a href="#">Data Varian</a>
            <a href="#">Data Produk</a>
            <a href="#">Manajemen Stok</a>
            <a href="#">Laporan Penjualan</a>
            <a href="#">Laporan Stok</a>
        </div>

        <div class="col-md-9 col-lg-10 content">

            <h3 class="fw-bold mb-2">Dashboard Admin</h3>
            <p class="text-muted">
                Selamat datang, {{ Auth::user()->name }}!
                Kelola sistem penjualan Ranatavan Dimsum di sini.
            </p>

            <div class="row g-3 mt-3">

                <div class="col-md-6 col-xl-3">
                    <div class="card p-3">
                        <p class="text-muted mb-2">Total Produk</p>
                        <h3 class="fw-bold" style="color:#70452c;">-</h3>
                        <small>Data produk dimsum</small>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card p-3">
                        <p class="text-muted mb-2">Total Kategori</p>
                        <h3 class="fw-bold" style="color:#70452c;">-</h3>
                        <small>Kategori produk</small>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card p-3">
                        <p class="text-muted mb-2">Total Kasir</p>
                        <h3 class="fw-bold" style="color:#70452c;">-</h3>
                        <small>Akun kasir terdaftar</small>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card p-3">
                        <p class="text-muted mb-2">Total Penjualan</p>
                        <h3 class="fw-bold" style="color:#70452c;">-</h3>
                        <small>Transaksi berhasil</small>
                    </div>
                </div>

            </div>

            <div class="card p-4 mt-4">
                <h5 class="fw-bold">Informasi Sistem</h5>
                <p class="text-muted mb-0">
                    Gunakan menu di sebelah kiri untuk mengelola
                    data kasir, kategori, varian, produk, stok,
                    dan laporan penjualan.
                </p>
            </div>

        </div>
    </div>
</div>

@endsection
