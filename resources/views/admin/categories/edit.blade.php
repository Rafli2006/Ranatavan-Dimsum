@extends('layouts.master')

@section('title', 'Edit Kategori')

@section('content')

<div class="category-page">

    {{-- NAVBAR --}}
    <nav class="navbar navbar-dark category-navbar">
        <div class="container-fluid px-4">

            <a href="{{ route('admin.dashboard') }}"
               class="navbar-brand d-flex align-items-center gap-2">
                <span class="brand-logo">🥟</span>
                <span>
                    Ranatavan Dimsum
                    <small class="d-block brand-subtitle">ADMIN PANEL</small>
                </span>
            </a>

            <div class="ms-auto d-flex align-items-center gap-3">

                <div class="user-info text-end">
                    <span class="d-block text-white fw-semibold">
                        {{ Auth::user()->name }}
                    </span>
                    <small class="text-light opacity-75">Administrator</small>
                </div>

                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-logout">
                        Keluar
                    </button>
                </form>

            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">

            {{-- SIDEBAR --}}
            <aside class="col-md-3 col-lg-2 category-sidebar">

                <p class="sidebar-heading">MENU UTAMA</p>

                <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                    <span>⌂</span> Dashboard
                </a>

                <p class="sidebar-heading mt-4">MANAJEMEN DATA</p>

                <a href="{{ route('admin.kasir.index') }}" class="sidebar-link">
                    <span>📊</span> Data Kasir
                </a>

                <a href="{{ route('admin.kategori.index') }}" class="sidebar-link active">
                    <span>▦</span> Data Kategori
                </a>

                <div class="sidebar-link disabled-menu">
                    <span>◇</span> Data Varian
                    <small>Segera</small>
                </div>

                <a href="{{ route('admin.produk.index') }}" class="sidebar-link">
                    <span>🥟</span> Data Produk
                </a>

                <div class="sidebar-link disabled-menu">
                    <span>▤</span> Manajemen Stok
                    <small>Segera</small>
                </div>

                <p class="sidebar-heading mt-4">LAPORAN</p>

                <div class="sidebar-link disabled-menu">
                    <span>▧</span> Laporan Penjualan
                    <small>Segera</small>
                </div>

                <div class="sidebar-link disabled-menu">
                    <span>▤</span> Laporan Stok
                    <small>Segera</small>
                </div>

                <div class="sidebar-bottom">
                    <div class="sidebar-note">
                        <span>🥟</span>
                        <p class="mb-1 fw-semibold">Ranatavan Dimsum</p>
                        <small>Sistem Manajemen Penjualan</small>
                    </div>
                </div>

            </aside>

            {{-- KONTEN UTAMA --}}
            <main class="col-md-9 col-lg-10 category-content">

                {{-- HEADER --}}
                <div class="page-heading">

                    <div>
                        <span class="eyebrow">MANAJEMEN DATA</span>
                        <h2>Edit Kategori</h2>
                        <p>Perbarui informasi kategori produk.</p>
                    </div>

                    <a href="{{ route('admin.kategori.index') }}"
                       class="btn btn-back">
                        ← Kembali
                    </a>

                </div>

                {{-- FORM EDIT --}}
                <div class="category-form-wrapper">

                    <div class="form-card">

                        <div class="form-heading">
                            <div class="form-icon">✎</div>

                            <div>
                                <h5>Informasi Kategori</h5>
                                <p>Ubah informasi kategori sesuai kebutuhan.</p>
                            </div>
                        </div>

                        {{-- ERROR VALIDASI --}}
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <strong>Terjadi kesalahan!</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.kategori.update', $kategori->id) }}"
                              method="POST">

                            @csrf
                            @method('PUT')

                            {{-- NAMA KATEGORI --}}
                            <div class="form-group-custom">

                                <label for="name" class="form-label">
                                    Nama Kategori
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $kategori->name) }}"
                                    placeholder="Contoh: Dimsum Kukus"
                                    maxlength="100"
                                    required
                                >

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <small class="form-text">
                                    Masukkan nama kategori produk.
                                </small>

                            </div>

                            {{-- DESKRIPSI --}}
                            <div class="form-group-custom">

                                <label for="description" class="form-label">
                                    Deskripsi Kategori
                                </label>

                                <textarea
                                    name="description"
                                    id="description"
                                    class="form-control @error('description') is-invalid @enderror"
                                    rows="5"
                                    placeholder="Tuliskan deskripsi kategori produk..."
                                >{{ old('description', $kategori->description) }}</textarea>

                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <small class="form-text">
                                    Perbarui deskripsi kategori. Bagian ini opsional.
                                </small>

                            </div>

                            {{-- TOMBOL --}}
                            <div class="form-actions">

                                <a href="{{ route('admin.kategori.index') }}"
                                   class="btn btn-cancel">
                                    Batal
                                </a>

                                <button type="submit" class="btn btn-save">
                                    Simpan Perubahan
                                </button>

                            </div>

                        </form>

                    </div>

                    {{-- INFORMASI --}}
                    <div class="info-card">
                        <span class="info-icon">💡</span>

                        <div>
                            <strong>Informasi</strong>
                            <p>
                                Perubahan kategori akan disimpan ke database.
                                Pastikan kategori yang diubah sudah sesuai dengan
                                produk yang menggunakannya.
                            </p>
                        </div>
                    </div>

                </div>

                <div class="category-footer">
                    © {{ date('Y') }} Ranatavan Dimsum · Admin Panel
                </div>

            </main>

        </div>
    </div>

</div>

@endsection

@push('styles')
<style>

/* DASAR */
.category-page {
    min-height: 100vh;
    background: #f8f5f0;
}

/* NAVBAR */
.category-navbar {
    background: #563522;
    min-height: 70px;
}

.brand-logo {
    width: 42px;
    height: 42px;
    display: grid;
    place-items: center;
    background: rgba(255,255,255,.13);
    border-radius: 12px;
    font-size: 23px;
}

.brand-subtitle {
    color: #dfbd9a;
    font-size: 9px;
    letter-spacing: 2px;
    margin-top: 4px;
}

.user-avatar {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: #d9b58e;
    color: #563522;
    display: grid;
    place-items: center;
    font-weight: bold;
}

.btn-logout {
    background: #fff7ec;
    color: #70452c;
    border-radius: 8px;
    font-size: 12px;
    font-weight: bold;
}

.btn-logout:hover {
    background: #eadbcd;
    color: #563522;
}

/* SIDEBAR */
.category-sidebar {
    background: #70452c;
    min-height: calc(100vh - 70px);
    padding: 28px 16px;
    display: flex;
    flex-direction: column;
}

.sidebar-heading {
    color: #d9b99a;
    font-size: 10px;
    font-weight: bold;
    letter-spacing: 1.5px;
    padding: 0 10px;
    margin-bottom: 12px;
}

.sidebar-link {
    display: flex;
    align-items: center;
    gap: 12px;
    color: #f8eee4;
    text-decoration: none;
    font-size: 13px;
    padding: 12px;
    border-radius: 9px;
    margin-bottom: 5px;
    transition: .2s;
}

.sidebar-link span {
    width: 22px;
    text-align: center;
    font-size: 17px;
}

.sidebar-link:hover,
.sidebar-link.active {
    background: #946747;
    color: white;
}

.disabled-menu {
    display: flex;
    align-items: center;
    gap: 12px;
    color: #f8eee4;
    font-size: 13px;
    padding: 12px;
    opacity: .65;
}

.disabled-menu small {
    margin-left: auto;
    font-size: 9px;
}

.sidebar-bottom {
    margin-top: auto;
    padding-top: 35px;
}

.sidebar-note {
    padding: 15px;
    background: rgba(255,255,255,.09);
    border-radius: 12px;
    color: white;
    font-size: 12px;
}

.sidebar-note > span {
    font-size: 23px;
}

.sidebar-note small {
    color: #e0c7ae;
    font-size: 10px;
}

/* KONTEN */
.category-content {
    padding: 32px;
}

.page-heading {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    margin-bottom: 28px;
}

.eyebrow {
    color: #a47c59;
    font-size: 10px;
    font-weight: bold;
    letter-spacing: 2px;
}

.page-heading h2 {
    color: #563522;
    font-weight: 800;
    font-size: 27px;
    margin: 7px 0;
}

.page-heading p {
    color: #96887d;
    font-size: 13px;
    margin: 0;
}

.btn-back {
    background: white;
    color: #70452c;
    border: 1px solid #e9d9c8;
    padding: 10px 17px;
    border-radius: 9px;
    font-size: 12px;
    font-weight: bold;
}

.btn-back:hover {
    background: #f4e9dd;
    color: #563522;
}

/* FORM */
.category-form-wrapper {
    max-width: 780px;
    margin: 0 auto;
}

.form-card {
    background: white;
    border: 1px solid #eee4da;
    border-radius: 16px;
    padding: 32px;
    box-shadow: 0 5px 20px rgba(75,46,27,.06);
}

.form-heading {
    display: flex;
    align-items: center;
    gap: 16px;
    padding-bottom: 22px;
    margin-bottom: 28px;
    border-bottom: 1px solid #eee8e1;
}

.form-icon {
    width: 50px;
    height: 50px;
    flex-shrink: 0;
    display: grid;
    place-items: center;
    background: #f5eadd;
    color: #70452c;
    border-radius: 13px;
    font-size: 23px;
}

.form-heading h5 {
    color: #563522;
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 5px;
}

.form-heading p {
    color: #9b8d81;
    font-size: 12px;
    margin: 0;
}

.form-group-custom {
    margin-bottom: 27px;
}

.form-label {
    display: block;
    color: #563522;
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 10px;
}

.form-control {
    border: 1px solid #e5d9cd;
    border-radius: 9px;
    padding: 13px 15px;
    font-size: 13px;
    background: #fffdfb;
    transition: .2s;
}

.form-control::placeholder {
    color: #b9aca0;
}

.form-control:focus {
    border-color: #a47c59;
    box-shadow: 0 0 0 3px rgba(112,69,44,.10);
    background: white;
}

textarea.form-control {
    resize: vertical;
    min-height: 125px;
}

.form-text {
    display: block;
    color: #a09287;
    font-size: 11px;
    margin-top: 8px;
}

/* TOMBOL */
.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    border-top: 1px solid #eee8e1;
    padding-top: 23px;
    margin-top: 10px;
}

.btn-cancel,
.btn-save {
    min-width: 145px;
    padding: 12px 18px;
    border-radius: 9px;
    font-size: 12px;
    font-weight: 700;
    transition: .2s;
}

.btn-cancel {
    background: #f5eee7;
    color: #70452c;
    border: 1px solid #eadbcd;
}

.btn-cancel:hover {
    background: #eadbcd;
    color: #563522;
}

.btn-save {
    background: #70452c;
    color: white;
    border: 1px solid #70452c;
}

.btn-save:hover {
    background: #563522;
    color: white;
}

/* INFORMASI */
.info-card {
    display: flex;
    gap: 13px;
    background: #f5eadc;
    border: 1px solid #ead7c3;
    border-radius: 12px;
    padding: 18px;
    margin-top: 20px;
    color: #70452c;
    font-size: 13px;
}

.info-icon {
    font-size: 22px;
}

.info-card p {
    margin: 5px 0 0;
    font-size: 11px;
    line-height: 1.7;
}

/* FOOTER */
.category-footer {
    text-align: center;
    color: #aa9c90;
    font-size: 11px;
    padding: 30px 0 5px;
}

/* RESPONSIVE */
@media (max-width: 767px) {

    .category-sidebar {
        min-height: auto;
    }

    .category-content {
        padding: 22px 15px;
    }

    .page-heading {
        align-items: flex-start;
        flex-direction: column;
    }

    .user-info {
        display: none;
    }

}

@media (max-width: 576px) {

    .form-card {
        padding: 20px;
    }

    .form-actions {
        flex-direction: column-reverse;
    }

    .form-actions .btn {
        width: 100%;
    }

}

</style>
@endpush
