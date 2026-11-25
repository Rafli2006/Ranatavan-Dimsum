@extends('layouts.master')

@section('title', 'Tambah Kasir')

@section('content')
<div class="admin-dashboard category-form-page">
    {{-- SIDEBAR --}}
    <aside class="admin-sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">🥟</div>
            <div>
                <h5>Ranatavan</h5>
                <span>DIMSUM MANAGEMENT</span>
            </div>
        </div>

        <div class="sidebar-label">MENU UTAMA</div>
        <nav class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                <i class="bi bi-grid-1x2-fill"></i><span>Dashboard</span>
            </a>
            <a href="{{ route('admin.kasir.index') }}" class="sidebar-link active">
                <i class="bi bi-people"></i><span>Data Kasir</span>
            </a>
            <a href="{{ route('admin.kategori.index') }}" class="sidebar-link">
                <i class="bi bi-tags"></i><span>Data Kategori</span>
            </a>
            <a href="{{ route('admin.varian.index') }}" class="sidebar-link">
                <i class="bi bi-grid"></i><span>Data Varian</span>
            </a>
            <a href="{{ route('admin.produk.index') }}" class="sidebar-link">
                <i class="bi bi-box-seam"></i><span>Data Produk</span>
            </a>
        </nav>

        <div class="sidebar-label mt-4">LAINNYA</div>
        <nav class="sidebar-menu">
            <a href="#" class="sidebar-link disabled-link">
                <i class="bi bi-boxes"></i><span>Manajemen Stok</span><small>Segera</small>
            </a>
            <a href="#" class="sidebar-link disabled-link">
                <i class="bi bi-receipt"></i><span>Laporan Penjualan</span><small>Segera</small>
            </a>
        </nav>

        <div class="sidebar-bottom">
            <div class="sidebar-profile">
                <div class="profile-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                <div class="profile-info">
                    <strong>{{ Auth::user()->name }}</strong>
                    <span>Administrator</span>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-button">
                    <i class="bi bi-box-arrow-left"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN --}}
    <main class="admin-main">
        <header class="admin-topbar">
            <div>
                <div class="topbar-caption">RANATAVAN DIMSUM / ADMIN</div>
                <h5>Tambah Kasir</h5>
            </div>
            <div class="topbar-right">
                <div class="topbar-date">
                    <i class="bi bi-calendar3"></i>
                    {{ now()->translatedFormat('d F Y') }}
                </div>
                <div class="topbar-user">
                    <div class="topbar-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                    <div>
                        <strong>{{ Auth::user()->name }}</strong>
                        <span>Administrator</span>
                    </div>
                </div>
            </div>
        </header>

        <div class="dashboard-content">
            {{-- BREADCRUMB --}}
            <div class="breadcrumb-custom">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <i class="bi bi-chevron-right"></i>
                <a href="{{ route('admin.kasir.index') }}">Data Kasir</a>
                <i class="bi bi-chevron-right"></i>
                <span>Tambah Kasir</span>
            </div>

            {{-- BANNER --}}
            <section class="form-banner">
                <div class="form-banner-content">
                    <span class="form-tag">
                        <i class="bi bi-plus-circle-fill"></i> MANAJEMEN PENGGUNA
                    </span>
                    <h1>Tambah Kasir</h1>
                    <p>Tambahkan akun kasir baru untuk Ranatavan Dimsum.</p>
                </div>
                <div class="form-banner-decoration">👤</div>
                <a href="{{ route('admin.kasir.index') }}" class="back-button">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </section>

            {{-- VALIDATION ERRORS --}}
            @if ($errors->any())
                <div class="alert alert-danger form-alert">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <div>
                        <strong>Periksa kembali data yang dimasukkan.</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="form-layout">
                <section class="form-card">
                    <div class="form-card-heading">
                        <div class="form-heading-icon"><i class="bi bi-person-vcard-fill"></i></div>
                        <div>
                            <h5>Informasi Akun Kasir</h5>
                            <p>Lengkapi identitas pengguna kasir.</p>
                        </div>
                    </div>

                    <form action="{{ route('admin.kasir.store') }}" method="POST">
                        @csrf

                        <div class="form-group-custom">
                            <label for="name" class="form-label">
                                Nama Lengkap <span class="required-mark">*</span>
                            </label>
                            <div class="input-icon-wrapper">
                                <i class="bi bi-person"></i>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}"
                                    placeholder="Masukkan nama lengkap" required>
                            </div>
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-help">Masukkan nama lengkap kasir.</small>
                        </div>

                        <div class="form-group-custom">
                            <label for="username" class="form-label">
                                Username <span class="required-mark">*</span>
                            </label>
                            <div class="input-icon-wrapper">
                                <i class="bi bi-at"></i>
                                <input type="text" name="username" id="username"
                                    class="form-control @error('username') is-invalid @enderror"
                                    value="{{ old('username') }}"
                                    placeholder="Contoh: budi" required>
                            </div>
                            @error('username')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-help">Username digunakan saat login.</small>
                        </div>

                        <div class="form-group-custom">
                            <label for="email" class="form-label">
                                Email <span class="required-mark">*</span>
                            </label>
                            <div class="input-icon-wrapper">
                                <i class="bi bi-envelope"></i>
                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}"
                                    placeholder="contoh@email.com" required>
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-help">Masukkan alamat email yang aktif.</small>
                        </div>

                        <div class="form-group-custom">
                            <label for="password" class="form-label">
                                Password <span class="required-mark">*</span>
                            </label>
                            <div class="input-icon-wrapper">
                                <i class="bi bi-lock"></i>
                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Minimal 8 karakter"
                                    minlength="8" required>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-help">
                                Password minimal 8 karakter dan akan di-hash otomatis oleh Laravel.
                            </small>
                        </div>

                        <div class="form-actions">
                            <a href="{{ route('admin.kasir.index') }}" class="cancel-button">
                                <i class="bi bi-x-lg"></i> Batal
                            </a>
                            <button type="submit" class="save-button">
                                <i class="bi bi-check-circle-fill"></i> Simpan Akun Kasir
                            </button>
                        </div>
                    </form>
                </section>

                <aside class="form-info-card">
                    <div class="info-card-icon"><i class="bi bi-lightbulb-fill"></i></div>
                    <h6>Informasi Akun Kasir</h6>
                    <p>
                        Akun kasir digunakan untuk masuk ke sistem Ranatavan Dimsum
                        dan membantu proses operasional penjualan.
                    </p>

                    <div class="example-heading">Informasi akses:</div>
                    <div class="example-category">
                        <i class="bi bi-person-check-fill"></i> Role: Kasir
                    </div>
                    <div class="example-category">
                        <i class="bi bi-toggle-on"></i> Status: Aktif
                    </div>
                    <div class="info-note">
                        <i class="bi bi-info-circle-fill"></i>
                        Akun yang dibuat otomatis memiliki role Kasir dan status Aktif.
                    </div>
                </aside>
            </div>

            <footer class="dashboard-footer">
                <span>© {{ date('Y') }} Ranatavan Dimsum</span>
                <span>Made with <i class="bi bi-heart-fill"></i> for delicious moments</span>
            </footer>
        </div>
    </main>
</div>
@endsection

@push('styles')
<style>
.category-form-page {
    --orange:#f07828; --orange-dark:#d95d16; --brown:#713d25;
    min-height:100vh; display:flex; background:#fff9f4;
    color:#38271f; font-family:'DM Sans',Arial,sans-serif;
}
.category-form-page .admin-sidebar {
    width:258px; min-width:258px; background:#fff;
    border-right:1px solid #f4e5d9; padding:27px 17px 18px;
    display:flex; flex-direction:column;
}
.category-form-page .sidebar-brand {
    display:flex; align-items:center; gap:12px; padding:0 9px 30px;
}
.category-form-page .brand-icon {
    width:47px; height:47px; border-radius:15px; display:grid;
    place-items:center; background:linear-gradient(135deg,#ff9d52,#f07828);
    font-size:26px; box-shadow:0 5px 12px rgba(240,120,40,.2);
}
.category-form-page .sidebar-brand h5 {
    font-family:'Playfair Display',Georgia,serif; font-weight:700;
    font-size:19px; margin:0; color:var(--brown);
}
.category-form-page .sidebar-brand span {
    display:block; color:#b58b70; font-size:9px; letter-spacing:1.4px;
    margin-top:3px; font-weight:800;
}
.category-form-page .sidebar-label {
    padding:0 11px; color:#b5a49a; font-size:10px;
    font-weight:800; letter-spacing:1.5px; margin-bottom:10px;
}
.category-form-page .sidebar-menu {display:flex; flex-direction:column; gap:6px;}
.category-form-page .sidebar-link {
    min-height:45px; padding:0 12px; display:flex; align-items:center;
    gap:12px; color:#79665a; text-decoration:none; font-size:13px;
    font-weight:600; border-radius:10px; transition:.2s;
}
.category-form-page .sidebar-link i {font-size:17px; width:20px; text-align:center;}
.category-form-page .sidebar-link:hover {background:#fff1e5; color:var(--orange-dark);}
.category-form-page .sidebar-link.active {
    background:linear-gradient(110deg,#f07828,#ff9d52); color:white;
    box-shadow:0 6px 14px rgba(240,120,40,.22);
}
.category-form-page .disabled-link {opacity:.45; pointer-events:none;}
.category-form-page .disabled-link small {
    margin-left:auto; font-size:9px; background:#f5eee8;
    padding:3px 6px; border-radius:5px;
}
.category-form-page .sidebar-bottom {
    margin-top:auto; padding-top:20px; border-top:1px solid #f1e7df;
}
.category-form-page .sidebar-profile {
    display:flex; align-items:center; gap:10px; padding:0 5px 16px;
}
.category-form-page .profile-avatar,.category-form-page .topbar-avatar {
    width:38px; height:38px; border-radius:50%; display:grid;
    place-items:center; background:#ffead8; color:var(--orange-dark); font-weight:800;
}
.category-form-page .profile-info strong,.category-form-page .topbar-user strong {
    display:block; font-size:12px; color:var(--brown);
}
.category-form-page .profile-info span,.category-form-page .topbar-user span {
    display:block; color:#a08f82; font-size:10px; margin-top:3px;
}
.category-form-page .logout-button {
    width:100%; border:1px solid #f5dfd0; border-radius:9px;
    padding:10px; background:white; color:#bd6340; font-size:12px;
    font-weight:700; text-align:left; transition:.2s;
}
.category-form-page .logout-button i {margin-right:8px;}
.category-form-page .logout-button:hover {background:#fff1e5; border-color:#f3b18a;}
.category-form-page .admin-main {flex:1; min-width:0;}
.category-form-page .admin-topbar {
    min-height:83px; background:white; border-bottom:1px solid #f4e5d9;
    padding:15px 36px; display:flex; align-items:center; justify-content:space-between;
}
.category-form-page .topbar-caption {
    font-size:9px; letter-spacing:1.4px; color:#bd9278;
    font-weight:800; margin-bottom:5px;
}
.category-form-page .admin-topbar h5 {
    margin:0; color:var(--brown); font-size:19px; font-weight:800;
}
.category-form-page .topbar-right {display:flex; align-items:center; gap:25px;}
.category-form-page .topbar-date {color:#8e7e72; font-size:12px;}
.category-form-page .topbar-date i {margin-right:6px; color:var(--orange);}
.category-form-page .topbar-user {
    display:flex; align-items:center; gap:9px;
    padding-left:20px; border-left:1px solid #f1e7df;
}
.category-form-page .topbar-avatar {width:36px; height:36px;}
.category-form-page .dashboard-content {
    padding:30px 36px; max-width:1600px; margin:auto;
}
.category-form-page .breadcrumb-custom {
    display:flex; align-items:center; flex-wrap:wrap; gap:9px;
    margin-bottom:20px; font-size:11px; color:#a39488;
}
.category-form-page .breadcrumb-custom a {color:#d9793b; text-decoration:none;}
.category-form-page .breadcrumb-custom a:hover {color:#bd5317;}
.category-form-page .breadcrumb-custom i {font-size:9px;}
.category-form-page .form-banner {
    position:relative; overflow:hidden; min-height:165px; border-radius:19px;
    padding:27px 30px; display:flex; align-items:center; justify-content:space-between;
    background:linear-gradient(110deg,#fff 45%,#fff0e3);
    border:1px solid #f3e4d8; margin-bottom:25px;
}
.category-form-page .form-banner-content {position:relative; z-index:2;}
.category-form-page .form-tag {
    display:inline-flex; align-items:center; gap:7px; color:var(--orange);
    font-size:9px; font-weight:800; letter-spacing:1.5px; margin-bottom:10px;
}
.category-form-page .form-banner h1 {
    color:var(--brown); font-size:27px; font-weight:800; margin:0 0 8px;
}
.category-form-page .form-banner p {color:#9a8b80; font-size:12px; margin:0;}
.category-form-page .form-banner-decoration {
    position:absolute; right:30%; top:50%; transform:translateY(-50%) rotate(-15deg);
    font-size:90px; opacity:.07;
}
.category-form-page .back-button {
    position:relative; z-index:2; display:inline-flex; align-items:center; gap:8px;
    padding:11px 16px; border:1px solid #f1ddcd; border-radius:9px;
    background:white; color:#9a5932; text-decoration:none; font-size:11px;
    font-weight:800; transition:.2s;
}
.category-form-page .back-button:hover {background:#fff1e5; color:#bd5317;}
.category-form-page .form-layout {
    display:grid; grid-template-columns:minmax(0,1fr) 270px;
    gap:20px; align-items:start;
}
.category-form-page .form-card,.category-form-page .form-info-card {
    background:white; border:1px solid #f2e5dc; border-radius:15px;
    box-shadow:0 5px 18px rgba(120,65,30,.035);
}
.category-form-page .form-card {padding:27px;}
.category-form-page .form-card-heading {
    display:flex; align-items:center; gap:13px; padding-bottom:21px;
    margin-bottom:25px; border-bottom:1px solid #f2e8e0;
}
.category-form-page .form-heading-icon,.category-form-page .info-card-icon {
    width:45px; height:45px; display:grid; place-items:center;
    background:#fff0e3; color:#e87932; border-radius:12px; font-size:19px;
}
.category-form-page .form-card-heading h5 {
    color:#493125; font-size:15px; font-weight:800; margin:0 0 5px;
}
.category-form-page .form-card-heading p {color:#9a8b80; font-size:11px; margin:0;}
.category-form-page .form-group-custom {margin-bottom:22px;}
.category-form-page .form-label {
    display:block; color:#49372b; font-size:12px; font-weight:800; margin-bottom:9px;
}
.category-form-page .required-mark {color:#e45d46;}
.category-form-page .input-icon-wrapper {position:relative;}
.category-form-page .input-icon-wrapper > i {
    position:absolute; top:14px; left:14px; color:#d68a59;
    font-size:14px; z-index:2;
}
.category-form-page .form-control {
    width:100%; min-height:44px; border:1px solid #eaded3; border-radius:9px;
    padding:12px 14px 12px 40px; font-size:12px; color:#49372b;
    background:#fffdfb; transition:.2s;
}
.category-form-page .form-control::placeholder {color:#b8aaa0;}
.category-form-page .form-control:focus {
    border-color:#f07828; box-shadow:0 0 0 3px rgba(240,120,40,.10); background:white;
}
.category-form-page .form-help {
    display:block; margin-top:8px; color:#a39488; font-size:10px;
}
.category-form-page .form-actions {
    display:flex; justify-content:flex-end; gap:10px;
    border-top:1px solid #f2e8e0; padding-top:21px; margin-top:8px;
}
.category-form-page .cancel-button,.category-form-page .save-button {
    display:inline-flex; align-items:center; justify-content:center; gap:8px;
    padding:12px 17px; border-radius:9px; font-size:11px;
    font-weight:800; text-decoration:none; transition:.2s; cursor:pointer;
}
.category-form-page .cancel-button {
    border:1px solid #eaded3; background:#fff; color:#8c7464;
}
.category-form-page .cancel-button:hover {background:#f8eee6; color:#713d25;}
.category-form-page .save-button {
    border:none; background:linear-gradient(110deg,#f07828,#ff9d52);
    color:white; box-shadow:0 5px 12px rgba(240,120,40,.18);
}
.category-form-page .save-button:hover {
    background:linear-gradient(110deg,#d95d16,#f07828);
    color:white; transform:translateY(-2px);
}
.category-form-page .form-info-card {padding:22px;}
.category-form-page .info-card-icon {margin-bottom:15px;}
.category-form-page .form-info-card h6 {
    color:#493125; font-size:13px; font-weight:800; margin-bottom:9px;
}
.category-form-page .form-info-card > p {
    color:#998a7f; font-size:11px; line-height:1.7; margin-bottom:20px;
}
.category-form-page .example-heading {
    color:#a18b7b; font-size:10px; font-weight:800; margin-bottom:10px;
}
.category-form-page .example-category {
    display:flex; align-items:center; gap:8px; padding:10px;
    margin-bottom:7px; background:#fff9f4; border:1px solid #f4e8df;
    border-radius:8px; color:#725340; font-size:10px; font-weight:600;
}
.category-form-page .example-category i {color:#e87932;}
.category-form-page .info-note {
    display:flex; gap:8px; margin-top:17px; padding:11px; border-radius:8px;
    background:#fff5e8; color:#a06d42; font-size:10px; line-height:1.6;
}
.category-form-page .info-note i {flex-shrink:0; margin-top:1px;}
.category-form-page .form-alert {
    border-radius:10px; display:flex; align-items:flex-start; gap:10px;
    font-size:12px; margin-bottom:20px;
}
.category-form-page .form-alert > i {margin-top:2px;}
.category-form-page .dashboard-footer {
    display:flex; justify-content:space-between; gap:10px;
    padding:23px 0 5px; margin-top:25px; border-top:1px solid #f0e3d9;
    color:#a39488; font-size:10px;
}
.category-form-page .dashboard-footer i {color:#ed7542; font-size:9px;}
@media(max-width:1100px) {
    .category-form-page .form-layout {grid-template-columns:minmax(0,1fr) 230px;}
    .category-form-page .dashboard-content {padding:25px 22px;}
}
@media(max-width:850px) {
    .category-form-page .admin-sidebar {width:215px; min-width:215px;}
    .category-form-page .form-layout {grid-template-columns:1fr;}
    .category-form-page .form-info-card {display:none;}
    .category-form-page .topbar-date {display:none;}
}
@media(max-width:600px) {
    .category-form-page {display:block;}
    .category-form-page .admin-sidebar {width:100%; min-width:0;}
    .category-form-page .sidebar-menu {display:grid; grid-template-columns:repeat(2,minmax(0,1fr));}
    .category-form-page .admin-topbar {padding:15px 18px;}
    .category-form-page .topbar-user {display:none;}
    .category-form-page .dashboard-content {padding:18px 14px;}
    .category-form-page .form-banner {
        align-items:flex-start; flex-direction:column; gap:15px; padding:22px;
    }
    .category-form-page .form-banner h1 {font-size:23px;}
    .category-form-page .form-banner-decoration {right:10px; top:25%; font-size:65px;}
    .category-form-page .form-card {padding:20px;}
    .category-form-page .form-actions {flex-direction:column-reverse;}
    .category-form-page .cancel-button,.category-form-page .save-button {width:100%;}
    .category-form-page .dashboard-footer {flex-direction:column;}
}
</style>
@endpush
