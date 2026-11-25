@extends('layouts.master')

@section('title', 'Tambah Kategori')

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
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.kasir.index') }}" class="sidebar-link">
                <i class="bi bi-people"></i>
                <span>Data Kasir</span>
            </a>

            <a href="{{ route('admin.kategori.index') }}" class="sidebar-link active">
                <i class="bi bi-tags"></i>
                <span>Data Kategori</span>
            </a>

            <a href="{{ route('admin.varian.index') }}" class="sidebar-link">
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
                <h5>Tambah Kategori</h5>
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

            {{-- BREADCRUMB --}}
            <div class="breadcrumb-custom">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <i class="bi bi-chevron-right"></i>
                <a href="{{ route('admin.kategori.index') }}">Data Kategori</a>
                <i class="bi bi-chevron-right"></i>
                <span>Tambah Kategori</span>
            </div>

            {{-- PAGE BANNER --}}
            <section class="form-banner">
                <div class="form-banner-content">
                    <span class="form-tag">
                        <i class="bi bi-plus-circle-fill"></i>
                        MANAJEMEN DATA
                    </span>

                    <h1>Tambah Kategori</h1>

                    <p>
                        Tambahkan kategori produk baru untuk mengelompokkan
                        menu Ranatavan Dimsum.
                    </p>
                </div>

                <div class="form-banner-decoration">🏷️</div>

                <a href="{{ route('admin.kategori.index') }}" class="back-button">
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>
            </section>

            {{-- VALIDATION ERRORS --}}
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

            {{-- FORM LAYOUT --}}
            <div class="form-layout">

                <section class="form-card">

                    <div class="form-card-heading">
                        <div class="form-heading-icon">
                            <i class="bi bi-tags-fill"></i>
                        </div>

                        <div>
                            <h5>Informasi Kategori</h5>
                            <p>Lengkapi informasi kategori produk berikut.</p>
                        </div>
                    </div>

                    <form action="{{ route('admin.kategori.store') }}" method="POST">
                        @csrf

                        {{-- NAMA --}}
                        <div class="form-group-custom">

                            <label for="name" class="form-label">
                                Nama Kategori
                                <span class="required-mark">*</span>
                            </label>

                            <div class="input-icon-wrapper">
                                <i class="bi bi-tag"></i>

                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}"
                                    placeholder="Contoh: Dimsum Kukus"
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
                                Masukkan nama kategori produk yang ingin dibuat.
                            </small>
                        </div>

                        {{-- DESKRIPSI --}}
                        <div class="form-group-custom">

                            <label for="description" class="form-label">
                                Deskripsi Kategori
                                <span class="optional-mark">Opsional</span>
                            </label>

                            <div class="textarea-icon-wrapper">
                                <i class="bi bi-card-text"></i>

                                <textarea
                                    name="description"
                                    id="description"
                                    class="form-control @error('description') is-invalid @enderror"
                                    rows="5"
                                    placeholder="Tuliskan deskripsi kategori produk..."
                                >{{ old('description') }}</textarea>
                            </div>

                            @error('description')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror

                            <small class="form-help">
                                Berikan penjelasan singkat mengenai kategori produk.
                            </small>
                        </div>

                        {{-- ACTIONS --}}
                        <div class="form-actions">

                            <a href="{{ route('admin.kategori.index') }}" class="cancel-button">
                                <i class="bi bi-x-lg"></i>
                                Batal
                            </a>

                            <button type="submit" class="save-button">
                                <i class="bi bi-check-circle-fill"></i>
                                Simpan Kategori
                            </button>

                        </div>
                    </form>

                </section>

                {{-- INFO CARD --}}
                <aside class="form-info-card">

                    <div class="info-card-icon">
                        <i class="bi bi-lightbulb-fill"></i>
                    </div>

                    <h6>Informasi Kategori</h6>

                    <p>
                        Kategori digunakan untuk mengelompokkan produk
                        agar data produk lebih mudah dikelola.
                    </p>

                    <div class="example-heading">
                        Contoh kategori:
                    </div>

                    <div class="example-category">
                        <i class="bi bi-check-circle-fill"></i>
                        Dimsum Kukus
                    </div>

                    <div class="example-category">
                        <i class="bi bi-check-circle-fill"></i>
                        Dimsum Goreng
                    </div>

                    <div class="example-category">
                        <i class="bi bi-check-circle-fill"></i>
                        Dimsum Bakar
                    </div>

                    <div class="info-note">
                        <i class="bi bi-info-circle-fill"></i>
                        Pastikan nama kategori belum digunakan sebelumnya.
                    </div>

                </aside>

            </div>

            {{-- FOOTER --}}
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
    --orange: #f07828;
    --orange-dark: #d95d16;
    --peach: #fff1e5;
    --brown: #713d25;
    min-height: 100vh;
    display: flex;
    background: #fff9f4;
    color: #38271f;
    font-family: 'DM Sans', Arial, sans-serif;
}

/* SIDEBAR */
.category-form-page .admin-sidebar {
    width: 258px;
    min-width: 258px;
    background: #fff;
    border-right: 1px solid #f4e5d9;
    padding: 27px 17px 18px;
    display: flex;
    flex-direction: column;
}

.category-form-page .sidebar-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 0 9px 30px;
}

.category-form-page .brand-icon {
    width: 47px;
    height: 47px;
    border-radius: 15px;
    display: grid;
    place-items: center;
    background: linear-gradient(135deg, #ff9d52, #f07828);
    font-size: 26px;
    box-shadow: 0 5px 12px rgba(240,120,40,.2);
}

.category-form-page .sidebar-brand h5 {
    font-family: 'Playfair Display', Georgia, serif;
    font-weight: 700;
    font-size: 19px;
    margin: 0;
    color: var(--brown);
}

.category-form-page .sidebar-brand span {
    display: block;
    color: #b58b70;
    font-size: 9px;
    letter-spacing: 1.4px;
    margin-top: 3px;
    font-weight: 800;
}

.category-form-page .sidebar-label {
    padding: 0 11px;
    color: #b5a49a;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1.5px;
    margin-bottom: 10px;
}

.category-form-page .sidebar-menu {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.category-form-page .sidebar-link {
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

.category-form-page .sidebar-link i {
    font-size: 17px;
    width: 20px;
    text-align: center;
}

.category-form-page .sidebar-link:hover {
    background: #fff1e5;
    color: var(--orange-dark);
}

.category-form-page .sidebar-link.active {
    background: linear-gradient(110deg, #f07828, #ff9d52);
    color: white;
    box-shadow: 0 6px 14px rgba(240,120,40,.22);
}

.category-form-page .disabled-link {
    opacity: .45;
    pointer-events: none;
}

.category-form-page .disabled-link small {
    margin-left: auto;
    font-size: 9px;
    background: #f5eee8;
    padding: 3px 6px;
    border-radius: 5px;
}

.category-form-page .sidebar-bottom {
    margin-top: auto;
    padding-top: 20px;
    border-top: 1px solid #f1e7df;
}

.category-form-page .sidebar-profile {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 0 5px 16px;
}

.category-form-page .profile-avatar,
.category-form-page .topbar-avatar {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    display: grid;
    place-items: center;
    background: #ffead8;
    color: var(--orange-dark);
    font-weight: 800;
}

.category-form-page .profile-info strong,
.category-form-page .topbar-user strong {
    display: block;
    font-size: 12px;
    color: var(--brown);
}

.category-form-page .profile-info span,
.category-form-page .topbar-user span {
    display: block;
    color: #a08f82;
    font-size: 10px;
    margin-top: 3px;
}

.category-form-page .logout-button {
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

.category-form-page .logout-button i {
    margin-right: 8px;
}

.category-form-page .logout-button:hover {
    background: #fff1e5;
    border-color: #f3b18a;
}

/* MAIN */
.category-form-page .admin-main {
    flex: 1;
    min-width: 0;
}

.category-form-page .admin-topbar {
    min-height: 83px;
    background: white;
    border-bottom: 1px solid #f4e5d9;
    padding: 15px 36px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.category-form-page .topbar-caption {
    font-size: 9px;
    letter-spacing: 1.4px;
    color: #bd9278;
    font-weight: 800;
    margin-bottom: 5px;
}

.category-form-page .admin-topbar h5 {
    margin: 0;
    color: var(--brown);
    font-size: 19px;
    font-weight: 800;
}

.category-form-page .topbar-right {
    display: flex;
    align-items: center;
    gap: 25px;
}

.category-form-page .topbar-date {
    color: #8e7e72;
    font-size: 12px;
}

.category-form-page .topbar-date i {
    margin-right: 6px;
    color: var(--orange);
}

.category-form-page .topbar-user {
    display: flex;
    align-items: center;
    gap: 9px;
    padding-left: 20px;
    border-left: 1px solid #f1e7df;
}

.category-form-page .topbar-avatar {
    width: 36px;
    height: 36px;
}

.category-form-page .dashboard-content {
    padding: 30px 36px;
    max-width: 1600px;
    margin: auto;
}

/* BREADCRUMB */
.breadcrumb-custom {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 9px;
    margin-bottom: 20px;
    font-size: 11px;
    color: #a39488;
}

.breadcrumb-custom a {
    color: #d9793b;
    text-decoration: none;
}

.breadcrumb-custom a:hover {
    color: #bd5317;
}

.breadcrumb-custom i {
    font-size: 9px;
}

/* BANNER */
.form-banner {
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
}

.form-banner-content {
    position: relative;
    z-index: 2;
}

.form-tag {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    color: var(--orange);
    font-size: 9px;
    font-weight: 800;
    letter-spacing: 1.5px;
    margin-bottom: 10px;
}

.form-banner h1 {
    color: var(--brown);
    font-size: 27px;
    font-weight: 800;
    margin: 0 0 8px;
}

.form-banner p {
    color: #9a8b80;
    font-size: 12px;
    margin: 0;
}

.form-banner-decoration {
    position: absolute;
    right: 30%;
    top: 50%;
    transform: translateY(-50%) rotate(-15deg);
    font-size: 90px;
    opacity: .07;
}

.back-button {
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

.back-button:hover {
    background: #fff1e5;
    color: #bd5317;
}

/* FORM LAYOUT */
.form-layout {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 270px;
    gap: 20px;
    align-items: start;
}

.form-card,
.form-info-card {
    background: white;
    border: 1px solid #f2e5dc;
    border-radius: 15px;
    box-shadow: 0 5px 18px rgba(120,65,30,.035);
}

.form-card {
    padding: 27px;
}

.form-card-heading {
    display: flex;
    align-items: center;
    gap: 13px;
    padding-bottom: 21px;
    margin-bottom: 25px;
    border-bottom: 1px solid #f2e8e0;
}

.form-heading-icon {
    width: 45px;
    height: 45px;
    display: grid;
    place-items: center;
    background: #fff0e3;
    color: #e87932;
    border-radius: 12px;
    font-size: 19px;
}

.form-card-heading h5 {
    color: #493125;
    font-size: 15px;
    font-weight: 800;
    margin: 0 0 5px;
}

.form-card-heading p {
    color: #9a8b80;
    font-size: 11px;
    margin: 0;
}

.form-group-custom {
    margin-bottom: 24px;
}

.form-label {
    display: block;
    color: #49372b;
    font-size: 12px;
    font-weight: 800;
    margin-bottom: 9px;
}

.required-mark {
    color: #e45d46;
}

.optional-mark {
    margin-left: 6px;
    color: #b09c8e;
    font-size: 9px;
    font-weight: 500;
}

.input-icon-wrapper,
.textarea-icon-wrapper {
    position: relative;
}

.input-icon-wrapper > i,
.textarea-icon-wrapper > i {
    position: absolute;
    top: 14px;
    left: 14px;
    color: #d68a59;
    font-size: 14px;
    z-index: 2;
}

.category-form-page .form-control {
    width: 100%;
    border: 1px solid #eaded3;
    border-radius: 9px;
    padding: 12px 14px 12px 40px;
    font-size: 12px;
    color: #49372b;
    background: #fffdfb;
    transition: .2s;
}

.category-form-page .form-control::placeholder {
    color: #b8aaa0;
}

.category-form-page .form-control:focus {
    border-color: #f07828;
    box-shadow: 0 0 0 3px rgba(240,120,40,.10);
    background: white;
}

.category-form-page textarea.form-control {
    min-height: 130px;
    resize: vertical;
    line-height: 1.7;
}

.form-help {
    display: block;
    margin-top: 8px;
    color: #a39488;
    font-size: 10px;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    border-top: 1px solid #f2e8e0;
    padding-top: 21px;
    margin-top: 8px;
}

.cancel-button,
.save-button {
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

.cancel-button {
    border: 1px solid #eaded3;
    background: #fff;
    color: #8c7464;
}

.cancel-button:hover {
    background: #f8eee6;
    color: #713d25;
}

.save-button {
    border: none;
    background: linear-gradient(110deg, #f07828, #ff9d52);
    color: white;
    box-shadow: 0 5px 12px rgba(240,120,40,.18);
}

.save-button:hover {
    background: linear-gradient(110deg, #d95d16, #f07828);
    color: white;
    transform: translateY(-2px);
}

/* INFO */
.form-info-card {
    padding: 22px;
}

.info-card-icon {
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

.form-info-card h6 {
    color: #493125;
    font-size: 13px;
    font-weight: 800;
    margin-bottom: 9px;
}

.form-info-card > p {
    color: #998a7f;
    font-size: 11px;
    line-height: 1.7;
    margin-bottom: 20px;
}

.example-heading {
    color: #a18b7b;
    font-size: 10px;
    font-weight: 800;
    margin-bottom: 10px;
}

.example-category {
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

.example-category i {
    color: #e87932;
}

.info-note {
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

.info-note i {
    flex-shrink: 0;
    margin-top: 1px;
}

.form-alert {
    border-radius: 10px;
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 12px;
    margin-bottom: 20px;
}

.form-alert > i {
    margin-top: 2px;
}

.category-form-page .dashboard-footer {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    padding: 23px 0 5px;
    margin-top: 25px;
    border-top: 1px solid #f0e3d9;
    color: #a39488;
    font-size: 10px;
}

.category-form-page .dashboard-footer i {
    color: #ed7542;
    font-size: 9px;
}

/* RESPONSIVE */
@media (max-width: 1100px) {
    .form-layout {
        grid-template-columns: minmax(0, 1fr) 230px;
    }

    .category-form-page .dashboard-content {
        padding: 25px 22px;
    }
}

@media (max-width: 850px) {
    .category-form-page .admin-sidebar {
        width: 215px;
        min-width: 215px;
    }

    .form-layout {
        grid-template-columns: 1fr;
    }

    .form-info-card {
        display: none;
    }

    .category-form-page .topbar-date {
        display: none;
    }
}

@media (max-width: 600px) {
    .category-form-page {
        display: block;
    }

    .category-form-page .admin-sidebar {
        width: 100%;
        min-width: 0;
    }

    .category-form-page .sidebar-menu {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .category-form-page .admin-topbar {
        padding: 15px 18px;
    }

    .category-form-page .topbar-user {
        display: none;
    }

    .category-form-page .dashboard-content {
        padding: 18px 14px;
    }

    .form-banner {
        align-items: flex-start;
        flex-direction: column;
        gap: 15px;
        padding: 22px;
    }

    .form-banner h1 {
        font-size: 23px;
    }

    .form-banner-decoration {
        right: 10px;
        top: 25%;
        font-size: 65px;
    }

    .form-card {
        padding: 20px;
    }

    .form-actions {
        flex-direction: column-reverse;
    }

    .cancel-button,
    .save-button {
        width: 100%;
    }

    .category-form-page .dashboard-footer {
        flex-direction: column;
    }
}
</style>
@endpush
