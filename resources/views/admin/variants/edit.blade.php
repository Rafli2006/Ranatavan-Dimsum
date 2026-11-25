@extends('layouts.master')

@section('title', 'Edit Varian')

@section('content')

<div class="admin-dashboard category-form-page variant-form-page">

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
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.kasir.index') }}" class="sidebar-link">
                <i class="bi bi-people"></i>
                <span>Data Kasir</span>
            </a>

            <a href="{{ route('admin.kategori.index') }}" class="sidebar-link">
                <i class="bi bi-tags"></i>
                <span>Data Kategori</span>
            </a>

            <a href="{{ route('admin.varian.index') }}" class="sidebar-link active">
                <i class="bi bi-grid"></i>
                <span>Data Varian</span>
            </a>

            <a href="{{ route('admin.produk.index') }}" class="sidebar-link">
                <i class="bi bi-box-seam"></i>
                <span>Data Produk</span>
            </a>
        </nav>

        <div class="sidebar-label mt-4">LAINNYA</div>

        <nav class="sidebar-menu">
            <a href="#" class="sidebar-link disabled-link">
                <i class="bi bi-boxes"></i>
                <span>Manajemen Stok</span>
                <small>Segera</small>
            </a>

            <a href="#" class="sidebar-link disabled-link">
                <i class="bi bi-receipt"></i>
                <span>Laporan Penjualan</span>
                <small>Segera</small>
            </a>
        </nav>

        <div class="sidebar-bottom">
            <div class="sidebar-profile">
                <div class="profile-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

                <div class="profile-info">
                    <strong>{{ Auth::user()->name }}</strong>
                    <span>Administrator</span>
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

    {{-- MAIN --}}
    <main class="admin-main">

        {{-- TOPBAR --}}
        <header class="admin-topbar">
            <div>
                <div class="topbar-caption">RANATAVAN DIMSUM / ADMIN</div>
                <h5>Edit Varian</h5>
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
                        <span>Administrator</span>
                    </div>
                </div>
            </div>
        </header>

        {{-- CONTENT --}}
        <div class="dashboard-content">

            <div class="breadcrumb-custom">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <i class="bi bi-chevron-right"></i>
                <a href="{{ route('admin.varian.index') }}">Data Varian</a>
                <i class="bi bi-chevron-right"></i>
                <span>Edit Varian</span>
            </div>

            {{-- BANNER --}}
            <section class="form-banner">
                <div class="form-banner-content">
                    <span class="form-tag">
                        <i class="bi bi-pencil-square"></i>
                        MANAJEMEN DATA
                    </span>

                    <h1>Edit Varian</h1>

                    <p>
                        Perbarui informasi varian produk
                        Ranatavan Dimsum.
                    </p>
                </div>

                <div class="form-banner-decoration">✏️</div>

                <a href="{{ route('admin.varian.index') }}" class="back-button">
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>
            </section>

            {{-- ERRORS --}}
            @if($errors->any())
                <div class="alert alert-danger form-alert">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <div>
                        <strong>Periksa kembali data yang dimasukkan.</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- FORM --}}
            <div class="form-layout">

                <section class="form-card">

                    <div class="form-card-heading">
                        <div class="form-heading-icon">
                            <i class="bi bi-pencil-square"></i>
                        </div>

                        <div>
                            <h5>Informasi Varian</h5>
                            <p>Perbarui informasi varian sesuai kebutuhan.</p>
                        </div>
                    </div>

                    <form action="{{ route('admin.varian.update', $variant->id) }}"
                          method="POST">

                        @csrf
                        @method('PUT')

                        {{-- KATEGORI --}}
                        <div class="form-group-custom">
                            <label for="category_id" class="form-label">
                                Kategori Produk
                                <span class="required-mark">*</span>
                            </label>

                            <div class="input-icon-wrapper">
                                <i class="bi bi-tags"></i>

                                <select
                                    name="category_id"
                                    id="category_id"
                                    class="form-control @error('category_id') is-invalid @enderror"
                                    required
                                >
                                    <option value="">-- Pilih Kategori --</option>

                                    @foreach($categories as $category)
                                        <option
                                            value="{{ $category->id }}"
                                            {{ old('category_id', $variant->category_id) == $category->id ? 'selected' : '' }}
                                        >
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            @error('category_id')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror

                            <small class="form-help">
                                Pilih kategori yang sesuai dengan varian ini.
                            </small>
                        </div>

                        {{-- NAMA VARIAN --}}
                        <div class="form-group-custom">
                            <label for="name" class="form-label">
                                Nama Varian
                                <span class="required-mark">*</span>
                            </label>

                            <div class="input-icon-wrapper">
                                <i class="bi bi-grid"></i>

                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $variant->name) }}"
                                    placeholder="Contoh: Original, Keju, Pedas"
                                    maxlength="100"
                                    required
                                >
                            </div>

                            @error('name')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror

                            <small class="form-help">
                                Perbarui nama varian produk.
                            </small>
                        </div>

                        {{-- ACTIONS --}}
                        <div class="form-actions">
                            <a href="{{ route('admin.varian.index') }}" class="cancel-button">
                                <i class="bi bi-x-lg"></i>
                                Batal
                            </a>

                            <button type="submit" class="save-button">
                                <i class="bi bi-check-circle-fill"></i>
                                Simpan Perubahan
                            </button>
                        </div>

                    </form>
                </section>

                {{-- INFO --}}
                <aside class="form-info-card">
                    <div class="info-card-icon">
                        <i class="bi bi-lightbulb-fill"></i>
                    </div>

                    <h6>Informasi Perubahan</h6>

                    <p>
                        Informasi varian yang diperbarui akan disimpan
                        ke database setelah tombol Simpan Perubahan ditekan.
                    </p>

                    <div class="example-heading">
                        Varian saat ini:
                    </div>

                    <div class="example-category">
                        <i class="bi bi-grid-fill"></i>
                        <strong>{{ $variant->name }}</strong>
                    </div>

                    <div class="example-heading mt-3">
                        Kategori saat ini:
                    </div>

                    <div class="example-category">
                        <i class="bi bi-tags-fill"></i>
                        {{ $variant->category->name ?? 'Tidak ada kategori' }}
                    </div>

                    <div class="info-note">
                        <i class="bi bi-info-circle-fill"></i>
                        Pastikan perubahan kategori dan nama varian sudah sesuai.
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
/* POSISI NAVBAR DAN HALAMAN */
html, body {
    margin: 0 !important;
    padding: 0 !important;
}

body {
    overflow-x: hidden;
}

#app {
    margin: 0 !important;
    padding: 0 !important;
}

.category-form-page.variant-form-page {
    --orange: #f07828;
    --orange-dark: #d95d16;
    --peach: #fff1e5;
    --brown: #713d25;

    position: relative;
    top: 0;
    margin: 0 !important;
    padding: 0 !important;
    width: 100%;
    min-height: 100vh;
    display: flex;
    background: #fff9f4;
    color: #38271f;
    font-family: 'DM Sans', Arial, sans-serif;
}

/* SIDEBAR */
.variant-form-page .admin-sidebar {
    width: 258px;
    min-width: 258px;
    min-height: 100vh;
    background: #fff;
    border-right: 1px solid #f4e5d9;
    padding: 27px 17px 18px;
    display: flex;
    flex-direction: column;
    box-sizing: border-box;
}

.variant-form-page .sidebar-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 0 9px 30px;
}

.variant-form-page .brand-icon {
    width: 47px;
    height: 47px;
    border-radius: 15px;
    display: grid;
    place-items: center;
    background: linear-gradient(135deg, #ff9d52, #f07828);
    font-size: 26px;
    box-shadow: 0 5px 12px rgba(240,120,40,.2);
}

.variant-form-page .sidebar-brand h5 {
    font-family: 'Playfair Display', Georgia, serif;
    font-weight: 700;
    font-size: 19px;
    margin: 0;
    color: var(--brown);
}

.variant-form-page .sidebar-brand span {
    display: block;
    color: #b58b70;
    font-size: 9px;
    letter-spacing: 1.4px;
    margin-top: 3px;
    font-weight: 800;
}

.variant-form-page .sidebar-label {
    padding: 0 11px;
    color: #b5a49a;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1.5px;
    margin-bottom: 10px;
}

.variant-form-page .sidebar-menu {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.variant-form-page .sidebar-link {
    min-height: 45px;
    padding: 0 12px;
    display: flex;
    align-items: center;
    gap: 12px;
    color: #79665a;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    border-radius: 10px;
    transition: .2s;
}

.variant-form-page .sidebar-link i {
    font-size: 17px;
    width: 20px;
    text-align: center;
}

.variant-form-page .sidebar-link:hover {
    background: #fff1e5;
    color: var(--orange-dark);
}

.variant-form-page .sidebar-link.active {
    background: linear-gradient(110deg, #f07828, #ff9d52);
    color: white;
    box-shadow: 0 6px 14px rgba(240,120,40,.22);
}

.variant-form-page .disabled-link {
    opacity: .45;
    pointer-events: none;
}

.variant-form-page .disabled-link small {
    margin-left: auto;
    font-size: 9px;
    background: #f5eee8;
    padding: 3px 6px;
    border-radius: 5px;
}

.variant-form-page .sidebar-bottom {
    margin-top: auto;
    padding-top: 20px;
    border-top: 1px solid #f1e7df;
}

.variant-form-page .sidebar-profile {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 0 5px 16px;
}

.variant-form-page .profile-avatar,
.variant-form-page .topbar-avatar {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    display: grid;
    place-items: center;
    background: #ffead8;
    color: var(--orange-dark);
    font-weight: 800;
}

.variant-form-page .profile-info strong,
.variant-form-page .topbar-user strong {
    display: block;
    font-size: 12px;
    color: var(--brown);
}

.variant-form-page .profile-info span,
.variant-form-page .topbar-user span {
    display: block;
    color: #a08f82;
    font-size: 10px;
    margin-top: 3px;
}

.variant-form-page .logout-button {
    width: 100%;
    border: 1px solid #f5dfd0;
    border-radius: 9px;
    padding: 10px;
    background: white;
    color: #bd6340;
    font-size: 12px;
    font-weight: 700;
    text-align: left;
    transition: .2s;
}

.variant-form-page .logout-button i {
    margin-right: 8px;
}

.variant-form-page .logout-button:hover {
    background: #fff1e5;
    border-color: #f3b18a;
}

/* MAIN */
.variant-form-page .admin-main {
    flex: 1;
    min-width: 0;
    margin: 0;
    padding: 0;
}

.variant-form-page .admin-topbar {
    min-height: 83px;
    background: white;
    border-bottom: 1px solid #f4e5d9;
    padding: 15px 36px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-sizing: border-box;
}

.variant-form-page .topbar-caption {
    font-size: 9px;
    letter-spacing: 1.4px;
    color: #bd9278;
    font-weight: 800;
    margin-bottom: 5px;
}

.variant-form-page .admin-topbar h5 {
    margin: 0;
    color: var(--brown);
    font-size: 19px;
    font-weight: 800;
}

.variant-form-page .topbar-right {
    display: flex;
    align-items: center;
    gap: 25px;
}

.variant-form-page .topbar-date {
    color: #8e7e72;
    font-size: 12px;
}

.variant-form-page .topbar-date i {
    margin-right: 6px;
    color: var(--orange);
}

.variant-form-page .topbar-user {
    display: flex;
    align-items: center;
    gap: 9px;
    padding-left: 20px;
    border-left: 1px solid #f1e7df;
}

.variant-form-page .topbar-avatar {
    width: 36px;
    height: 36px;
}

.variant-form-page .dashboard-content {
    padding: 30px 36px;
    max-width: 1600px;
    margin: auto;
}

/* BREADCRUMB */
.variant-form-page .breadcrumb-custom {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 9px;
    margin-bottom: 20px;
    font-size: 11px;
    color: #a39488;
}

.variant-form-page .breadcrumb-custom a {
    color: #d9793b;
    text-decoration: none;
}

.variant-form-page .breadcrumb-custom a:hover {
    color: #bd5317;
}

.variant-form-page .breadcrumb-custom i {
    font-size: 9px;
}

/* BANNER */
.variant-form-page .form-banner {
    position: relative;
    overflow: hidden;
    min-height: 165px;
    border-radius: 19px;
    padding: 27px 30px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: linear-gradient(110deg, #fff 45%, #fff0e3);
    border: 1px solid #f3e4d8;
    margin-bottom: 25px;
    box-sizing: border-box;
}

.variant-form-page .form-banner-content {
    position: relative;
    z-index: 2;
}

.variant-form-page .form-tag {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    color: var(--orange);
    font-size: 9px;
    font-weight: 800;
    letter-spacing: 1.5px;
    margin-bottom: 10px;
}

.variant-form-page .form-banner h1 {
    color: var(--brown);
    font-size: 27px;
    font-weight: 800;
    margin: 0 0 8px;
}

.variant-form-page .form-banner p {
    color: #9a8b80;
    font-size: 12px;
    margin: 0;
}

.variant-form-page .form-banner-decoration {
    position: absolute;
    right: 30%;
    top: 50%;
    transform: translateY(-50%) rotate(-15deg);
    font-size: 90px;
    opacity: .07;
}

.variant-form-page .back-button {
    position: relative;
    z-index: 2;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 16px;
    border: 1px solid #f1ddcd;
    border-radius: 9px;
    background: white;
    color: #9a5932;
    text-decoration: none;
    font-size: 11px;
    font-weight: 800;
    transition: .2s;
}

.variant-form-page .back-button:hover {
    background: #fff1e5;
    color: #bd5317;
}

/* FORM */
.variant-form-page .form-layout {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 270px;
    gap: 20px;
    align-items: start;
}

.variant-form-page .form-card,
.variant-form-page .form-info-card {
    background: white;
    border: 1px solid #f2e5dc;
    border-radius: 15px;
    box-shadow: 0 5px 18px rgba(120,65,30,.035);
}

.variant-form-page .form-card {
    padding: 27px;
}

.variant-form-page .form-card-heading {
    display: flex;
    align-items: center;
    gap: 13px;
    padding-bottom: 21px;
    margin-bottom: 25px;
    border-bottom: 1px solid #f2e8e0;
}

.variant-form-page .form-heading-icon {
    width: 45px;
    height: 45px;
    display: grid;
    place-items: center;
    background: #fff0e3;
    color: #e87932;
    border-radius: 12px;
    font-size: 19px;
}

.variant-form-page .form-card-heading h5 {
    color: #493125;
    font-size: 15px;
    font-weight: 800;
    margin: 0 0 5px;
}

.variant-form-page .form-card-heading p {
    color: #9a8b80;
    font-size: 11px;
    margin: 0;
}

.variant-form-page .form-group-custom {
    margin-bottom: 24px;
}

.variant-form-page .form-label {
    display: block;
    color: #49372b;
    font-size: 12px;
    font-weight: 800;
    margin-bottom: 9px;
}

.variant-form-page .required-mark {
    color: #e45d46;
}

.variant-form-page .input-icon-wrapper {
    position: relative;
}

.variant-form-page .input-icon-wrapper > i {
    position: absolute;
    top: 14px;
    left: 14px;
    color: #d68a59;
    font-size: 14px;
    z-index: 2;
}

.variant-form-page .form-control {
    width: 100%;
    border: 1px solid #eaded3;
    border-radius: 9px;
    padding: 12px 14px 12px 40px;
    font-size: 12px;
    color: #49372b;
    background: #fffdfb;
    transition: .2s;
    box-sizing: border-box;
}

.variant-form-page .form-control::placeholder {
    color: #b8aaa0;
}

.variant-form-page .form-control:focus {
    border-color: #f07828;
    box-shadow: 0 0 0 3px rgba(240,120,40,.10);
    background: white;
}

.variant-form-page select.form-control {
    appearance: auto;
    cursor: pointer;
}

.variant-form-page .form-help {
    display: block;
    margin-top: 8px;
    color: #a39488;
    font-size: 10px;
}

.variant-form-page .form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    border-top: 1px solid #f2e8e0;
    padding-top: 21px;
    margin-top: 8px;
}

.variant-form-page .cancel-button,
.variant-form-page .save-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 17px;
    border-radius: 9px;
    font-size: 11px;
    font-weight: 800;
    text-decoration: none;
    transition: .2s;
    cursor: pointer;
}

.variant-form-page .cancel-button {
    border: 1px solid #eaded3;
    background: #fff;
    color: #8c7464;
}

.variant-form-page .cancel-button:hover {
    background: #f8eee6;
    color: #713d25;
}

.variant-form-page .save-button {
    border: none;
    background: linear-gradient(110deg, #f07828, #ff9d52);
    color: white;
    box-shadow: 0 5px 12px rgba(240,120,40,.18);
}

.variant-form-page .save-button:hover {
    background: linear-gradient(110deg, #d95d16, #f07828);
    color: white;
    transform: translateY(-2px);
}

/* INFO */
.variant-form-page .form-info-card {
    padding: 22px;
}

.variant-form-page .info-card-icon {
    width: 43px;
    height: 43px;
    display: grid;
    place-items: center;
    border-radius: 12px;
    background: #fff0e3;
    color: #e87932;
    font-size: 19px;
    margin-bottom: 15px;
}

.variant-form-page .form-info-card h6 {
    color: #493125;
    font-size: 13px;
    font-weight: 800;
    margin-bottom: 9px;
}

.variant-form-page .form-info-card > p {
    color: #998a7f;
    font-size: 11px;
    line-height: 1.7;
    margin-bottom: 20px;
}

.variant-form-page .example-heading {
    color: #a18b7b;
    font-size: 10px;
    font-weight: 800;
    margin-bottom: 10px;
}

.variant-form-page .example-category {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px;
    margin-bottom: 7px;
    background: #fff9f4;
    border: 1px solid #f4e8df;
    border-radius: 8px;
    color: #725340;
    font-size: 10px;
    font-weight: 600;
}

.variant-form-page .example-category i {
    color: #e87932;
}

.variant-form-page .info-note {
    display: flex;
    gap: 8px;
    margin-top: 17px;
    padding: 11px;
    border-radius: 8px;
    background: #fff5e8;
    color: #a06d42;
    font-size: 10px;
    line-height: 1.6;
}

.variant-form-page .info-note i {
    flex-shrink: 0;
    margin-top: 1px;
}

.variant-form-page .form-alert {
    border-radius: 10px;
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 12px;
    margin-bottom: 20px;
}

.variant-form-page .form-alert > i {
    margin-top: 2px;
}

.variant-form-page .dashboard-footer {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    padding: 23px 0 5px;
    margin-top: 25px;
    border-top: 1px solid #f0e3d9;
    color: #a39488;
    font-size: 10px;
}

.variant-form-page .dashboard-footer i {
    color: #ed7542;
    font-size: 9px;
}

/* RESPONSIVE */
@media (max-width: 1100px) {
    .variant-form-page .form-layout {
        grid-template-columns: minmax(0, 1fr) 230px;
    }

    .variant-form-page .dashboard-content {
        padding: 25px 22px;
    }
}

@media (max-width: 850px) {
    .variant-form-page .admin-sidebar {
        width: 215px;
        min-width: 215px;
    }

    .variant-form-page .form-layout {
        grid-template-columns: 1fr;
    }

    .variant-form-page .form-info-card {
        display: none;
    }

    .variant-form-page .topbar-date {
        display: none;
    }
}

@media (max-width: 600px) {
    .variant-form-page {
        display: block;
    }

    .variant-form-page .admin-sidebar {
        width: 100%;
        min-width: 0;
        min-height: auto;
    }

    .variant-form-page .sidebar-menu {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .variant-form-page .admin-topbar {
        padding: 15px 18px;
    }

    .variant-form-page .topbar-user {
        display: none;
    }

    .variant-form-page .dashboard-content {
        padding: 18px 14px;
    }

    .variant-form-page .form-banner {
        align-items: flex-start;
        flex-direction: column;
        gap: 15px;
        padding: 22px;
    }

    .variant-form-page .form-banner h1 {
        font-size: 23px;
    }

    .variant-form-page .form-banner-decoration {
        right: 10px;
        top: 25%;
        font-size: 65px;
    }

    .variant-form-page .form-card {
        padding: 20px;
    }

    .variant-form-page .form-actions {
        flex-direction: column-reverse;
    }

    .variant-form-page .cancel-button,
    .variant-form-page .save-button {
        width: 100%;
    }

    .variant-form-page .dashboard-footer {
        flex-direction: column;
    }
}
</style>
@endpush
