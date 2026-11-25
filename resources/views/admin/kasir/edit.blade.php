@extends('layouts.master')

@section('title', 'Edit Data Kasir')

@section('content')

<div class="admin-dashboard category-dashboard">

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

            <a href="{{ route('admin.kasir.index') }}" class="sidebar-link active">
                <i class="bi bi-people"></i>
                <span>Data Kasir</span>
            </a>

            <a href="{{ route('admin.kategori.index') }}" class="sidebar-link">
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


    {{-- MAIN CONTENT --}}
    <main class="admin-main">

        {{-- TOPBAR --}}
        <header class="admin-topbar">
            <div>
                <div class="topbar-caption">RANATAVAN DIMSUM / ADMIN</div>
                <h5>Edit Data Kasir</h5>
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


        {{-- DASHBOARD CONTENT --}}
        <div class="dashboard-content">

            {{-- PAGE BANNER --}}
            <section class="category-banner">
                <div class="banner-content">
                    <span class="category-tag">
                        <i class="bi bi-person-gear"></i>
                        MANAJEMEN PENGGUNA
                    </span>

                    <h2>Edit Data Kasir</h2>

                    <p>
                        Perbarui informasi akun kasir Ranatavan Dimsum.
                        Pastikan data yang dimasukkan sudah benar.
                    </p>
                </div>

                <div class="banner-decoration">🥟</div>
            </section>


            {{-- FORM --}}
            <section class="kasir-form-section">

                <div class="form-heading">
                    <div>
                        <span class="form-heading-label">FORMULIR PENGGUNA</span>
                        <h3>Informasi Akun Kasir</h3>
                        <p>Ubah informasi akun kasir di bawah ini.</p>
                    </div>

                    <a href="{{ route('admin.kasir.index') }}" class="btn-form-back">
                        <i class="bi bi-arrow-left"></i>
                        Kembali
                    </a>
                </div>


                {{-- ERROR VALIDATION --}}
                @if ($errors->any())
                    <div class="kasir-alert">
                        <div class="alert-icon">
                            <i class="bi bi-exclamation-circle-fill"></i>
                        </div>

                        <div>
                            <strong>Periksa kembali data yang dimasukkan.</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif


                <form action="{{ route('admin.kasir.update', $kasir->id) }}"
                      method="POST"
                      class="kasir-form">

                    @csrf
                    @method('PUT')


                    {{-- DATA DIRI --}}
                    <div class="kasir-form-card">

                        <div class="form-card-heading">
                            <div class="form-card-icon">
                                <i class="bi bi-person-vcard"></i>
                            </div>

                            <div>
                                <h4>Informasi Pribadi</h4>
                                <p>Informasi dasar pengguna kasir.</p>
                            </div>
                        </div>

                        <div class="form-fields">

                            <div class="kasir-field">
                                <label for="name">
                                    Nama Lengkap
                                    <span>*</span>
                                </label>

                                <div class="input-icon">
                                    <i class="bi bi-person"></i>
                                    <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        value="{{ old('name', $kasir->name) }}"
                                        placeholder="Masukkan nama lengkap"
                                        required
                                    >
                                </div>

                                @error('name')
                                    <small class="field-error">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="kasir-field">
                                <label for="username">
                                    Username
                                    <span>*</span>
                                </label>

                                <div class="input-icon">
                                    <i class="bi bi-person-badge"></i>
                                    <input
                                        type="text"
                                        id="username"
                                        name="username"
                                        value="{{ old('username', $kasir->username) }}"
                                        placeholder="Masukkan username"
                                        required
                                    >
                                </div>

                                @error('username')
                                    <small class="field-error">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="kasir-field">
                                <label for="email">
                                    Alamat Email
                                    <span>*</span>
                                </label>

                                <div class="input-icon">
                                    <i class="bi bi-envelope"></i>
                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        value="{{ old('email', $kasir->email) }}"
                                        placeholder="contoh@email.com"
                                        required
                                    >
                                </div>

                                @error('email')
                                    <small class="field-error">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                    </div>


                    {{-- KEAMANAN AKUN --}}
                    <div class="kasir-form-card">

                        <div class="form-card-heading">
                            <div class="form-card-icon security-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>

                            <div>
                                <h4>Keamanan Akun</h4>
                                <p>Atur ulang password jika diperlukan.</p>
                            </div>
                        </div>

                        <div class="kasir-field">
                            <label for="password">
                                Password Baru
                                <span class="optional-label">Opsional</span>
                            </label>

                            <div class="input-icon">
                                <i class="bi bi-lock"></i>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="Kosongkan jika tidak ingin mengganti password"
                                    minlength="8"
                                >
                            </div>

                            <small class="field-hint">
                                <i class="bi bi-info-circle"></i>
                                Isi minimal 8 karakter jika ingin mengganti password.
                            </small>

                            @error('password')
                                <small class="field-error">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>


                    {{-- INFORMASI --}}
                    <div class="kasir-info-card">
                        <div class="info-icon">
                            <i class="bi bi-info-circle-fill"></i>
                        </div>

                        <div>
                            <strong>Informasi Perubahan Akun</strong>
                            <p>
                                Perubahan hanya berlaku pada informasi akun kasir ini.
                                Password lama tetap digunakan apabila kolom password
                                dikosongkan.
                            </p>
                        </div>
                    </div>


                    {{-- ACTION BUTTON --}}
                    <div class="kasir-form-actions">
                        <a href="{{ route('admin.kasir.index') }}" class="btn-cancel">
                            Batal
                        </a>

                        <button type="submit" class="btn-save-kasir">
                            <i class="bi bi-check-circle"></i>
                            Simpan Perubahan
                        </button>
                    </div>

                </form>
            </section>


            {{-- FOOTER --}}
            <footer class="dashboard-footer">
                <span>© {{ date('Y') }} Ranatavan Dimsum</span>
                <span>Admin Management System</span>
            </footer>

        </div>
    </main>
</div>

@endsection


@push('styles')
<style>

/* =====================================
   RANATAVAN DIMSUM - EDIT KASIR
   MODERN ORANGE & WHITE
===================================== */

.category-dashboard {
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
.category-dashboard .admin-sidebar {
    width: 258px;
    min-width: 258px;
    min-height: 100vh;
    background: #fff;
    border-right: 1px solid #f4e5d9;
    padding: 27px 17px 18px;
    display: flex;
    flex-direction: column;
}

.category-dashboard .sidebar-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 0 9px;
    margin-bottom: 42px;
}

.category-dashboard .brand-icon {
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

.category-dashboard .sidebar-brand h5 {
    font-size: 18px;
    font-weight: 800;
    color: var(--brown);
    margin: 0;
}

.category-dashboard .sidebar-brand span {
    font-size: 9px;
    letter-spacing: 1.3px;
    color: var(--muted);
    font-weight: 700;
}

.category-dashboard .sidebar-label {
    color: #b4a49b;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1.5px;
    padding: 0 12px;
    margin-bottom: 12px;
}

.category-dashboard .sidebar-menu {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.category-dashboard .sidebar-link {
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

.category-dashboard .sidebar-link i {
    font-size: 17px;
}

.category-dashboard .sidebar-link:hover {
    color: var(--orange-dark);
    background: #fff5ed;
}

.category-dashboard .sidebar-link.active {
    color: #fff;
    background: linear-gradient(120deg, #f58b3e, #e96620);
    box-shadow: 0 5px 12px rgba(232, 95, 24, .2);
}

.category-dashboard .disabled-link {
    opacity: .55;
    cursor: not-allowed;
}

.category-dashboard .disabled-link small {
    margin-left: auto;
    font-size: 9px;
    background: #f4eee9;
    padding: 3px 6px;
    border-radius: 5px;
}

.category-dashboard .sidebar-bottom {
    margin-top: auto;
    padding-top: 25px;
}

.category-dashboard .sidebar-profile {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 8px;
    border-top: 1px solid #f3e9e2;
}

.category-dashboard .profile-avatar,
.category-dashboard .topbar-avatar {
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

.category-dashboard .profile-info {
    display: flex;
    flex-direction: column;
    min-width: 0;
}

.category-dashboard .profile-info strong {
    font-size: 12px;
    color: var(--brown);
}

.category-dashboard .profile-info span {
    font-size: 10px;
    color: var(--muted);
}

.category-dashboard .logout-button {
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

.category-dashboard .logout-button:hover {
    background: #ffe4d2;
}


/* MAIN AREA */
.category-dashboard .admin-main {
    flex: 1;
    min-width: 0;
}

.category-dashboard .admin-topbar {
    min-height: 83px;
    background: #fff;
    border-bottom: 1px solid #f4e5d9;
    padding: 15px 36px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}

.category-dashboard .topbar-caption {
    font-size: 9px;
    color: #b19b8e;
    font-weight: 800;
    letter-spacing: 1.5px;
    margin-bottom: 5px;
}

.category-dashboard .admin-topbar h5 {
    color: var(--brown);
    font-size: 19px;
    font-weight: 800;
    margin: 0;
}

.category-dashboard .topbar-right {
    display: flex;
    align-items: center;
    gap: 25px;
}

.category-dashboard .topbar-date {
    color: #88766d;
    font-size: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.category-dashboard .topbar-user {
    display: flex;
    align-items: center;
    gap: 10px;
}

.category-dashboard .topbar-user strong {
    display: block;
    font-size: 12px;
    color: var(--brown);
}

.category-dashboard .topbar-user span {
    display: block;
    font-size: 10px;
    color: var(--muted);
}


/* CONTENT */
.category-dashboard .dashboard-content {
    max-width: 1600px;
    padding: 30px 36px;
    margin: auto;
}


/* BANNER */
.category-dashboard .category-banner {
    position: relative;
    overflow: hidden;
    min-height: 180px;
    padding: 30px 35px;
    border-radius: 18px;
    background: linear-gradient(115deg, #fff0e3, #ffe1c8);
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 30px;
}

.category-dashboard .banner-content {
    position: relative;
    z-index: 1;
}

.category-dashboard .category-tag {
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

.category-dashboard .category-banner h2 {
    color: var(--brown);
    font-size: 29px;
    font-weight: 800;
    margin: 14px 0 7px;
}

.category-dashboard .category-banner p {
    color: #95766a;
    font-size: 13px;
    margin: 0;
}

.category-dashboard .banner-decoration {
    font-size: 95px;
    opacity: .75;
    transform: rotate(-12deg);
    margin-right: 35px;
}


/* FORM SECTION */
.category-dashboard .kasir-form-section {
    max-width: 950px;
    margin: 0 auto;
}

.category-dashboard .form-heading {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    margin-bottom: 22px;
}

.category-dashboard .form-heading-label {
    font-size: 9px;
    font-weight: 800;
    letter-spacing: 1.5px;
    color: var(--orange);
}

.category-dashboard .form-heading h3 {
    font-size: 21px;
    font-weight: 800;
    color: var(--brown);
    margin: 5px 0;
}

.category-dashboard .form-heading p {
    color: var(--muted);
    font-size: 12px;
    margin: 0;
}

.category-dashboard .btn-form-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    color: var(--brown);
    background: #fff;
    border: 1px solid #f0dfd2;
    border-radius: 9px;
    padding: 10px 15px;
    font-size: 12px;
    font-weight: 700;
    transition: .2s;
}

.category-dashboard .btn-form-back:hover {
    background: var(--peach);
    color: var(--orange-dark);
}


/* ALERT */
.category-dashboard .kasir-alert {
    display: flex;
    gap: 12px;
    background: #fff1ed;
    border: 1px solid #ffd5c9;
    color: #a94430;
    border-radius: 11px;
    padding: 15px 17px;
    margin-bottom: 20px;
    font-size: 12px;
}

.category-dashboard .alert-icon {
    font-size: 19px;
}

.category-dashboard .kasir-alert strong {
    font-size: 12px;
}

.category-dashboard .kasir-alert ul {
    margin: 7px 0 0;
    padding-left: 17px;
}


/* FORM CARD */
.category-dashboard .kasir-form {
    display: flex;
    flex-direction: column;
    gap: 18px;
}

.category-dashboard .kasir-form-card {
    background: #fff;
    border: 1px solid #f1e5dc;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 5px 18px rgba(91, 54, 31, .035);
}

.category-dashboard .form-card-heading {
    display: flex;
    align-items: center;
    gap: 13px;
    padding-bottom: 20px;
    margin-bottom: 20px;
    border-bottom: 1px solid #f5eee9;
}

.category-dashboard .form-card-icon {
    width: 43px;
    height: 43px;
    border-radius: 12px;
    background: #fff0e3;
    color: var(--orange-dark);
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 19px;
}

.category-dashboard .security-icon {
    background: #fff5e9;
    color: #c77b32;
}

.category-dashboard .form-card-heading h4 {
    color: var(--brown);
    font-size: 15px;
    font-weight: 800;
    margin: 0 0 4px;
}

.category-dashboard .form-card-heading p {
    font-size: 11px;
    color: var(--muted);
    margin: 0;
}

.category-dashboard .form-fields {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 20px;
}

.category-dashboard .kasir-field {
    display: flex;
    flex-direction: column;
    min-width: 0;
}

.category-dashboard .kasir-field label {
    color: #634638;
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 9px;
}

.category-dashboard .kasir-field label span {
    color: #e65e35;
}

.category-dashboard .kasir-field label .optional-label {
    color: #9c887d;
    font-weight: 500;
    font-size: 10px;
    margin-left: 5px;
}

.category-dashboard .input-icon {
    position: relative;
}

.category-dashboard .input-icon > i {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #c19a83;
    font-size: 15px;
    pointer-events: none;
}

.category-dashboard .input-icon input {
    width: 100%;
    height: 46px;
    padding: 0 14px 0 42px;
    border: 1px solid #eaded5;
    border-radius: 9px;
    background: #fffdfb;
    outline: none;
    color: var(--text);
    font-size: 12px;
    transition: .2s;
}

.category-dashboard .input-icon input::placeholder {
    color: #b9aaa1;
}

.category-dashboard .input-icon input:focus {
    border-color: var(--orange);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(240,120,40,.1);
}

.category-dashboard .field-error {
    color: #d94d37;
    font-size: 10px;
    margin-top: 6px;
}

.category-dashboard .field-hint {
    color: #a08e83;
    font-size: 10px;
    margin-top: 8px;
}


/* INFO CARD */
.category-dashboard .kasir-info-card {
    display: flex;
    gap: 13px;
    padding: 17px 19px;
    border-radius: 11px;
    background: #fff4e9;
    border: 1px solid #ffe2c9;
}

.category-dashboard .info-icon {
    color: var(--orange);
    font-size: 19px;
}

.category-dashboard .kasir-info-card strong {
    display: block;
    color: var(--brown);
    font-size: 12px;
    margin-bottom: 5px;
}

.category-dashboard .kasir-info-card p {
    color: #957b6d;
    font-size: 11px;
    line-height: 1.7;
    margin: 0;
}


/* BUTTONS */
.category-dashboard .kasir-form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 11px;
    padding-top: 5px;
}

.category-dashboard .btn-cancel,
.category-dashboard .btn-save-kasir {
    min-height: 43px;
    padding: 0 20px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    border-radius: 9px;
    font-size: 12px;
    font-weight: 700;
    text-decoration: none;
    cursor: pointer;
    transition: .2s;
}

.category-dashboard .btn-cancel {
    background: #fff;
    border: 1px solid #eaded5;
    color: #806c61;
}

.category-dashboard .btn-cancel:hover {
    background: #f8f1ec;
    color: var(--brown);
}

.category-dashboard .btn-save-kasir {
    border: none;
    color: #fff;
    background: linear-gradient(120deg, #f58b3e, #e96620);
    box-shadow: 0 5px 12px rgba(232,95,24,.18);
}

.category-dashboard .btn-save-kasir:hover {
    background: linear-gradient(120deg, #e9772b, #d95512);
    transform: translateY(-1px);
}


/* FOOTER */
.category-dashboard .dashboard-footer {
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
@media (max-width: 850px) {
    .category-dashboard .admin-sidebar {
        width: 215px;
        min-width: 215px;
    }

    .category-dashboard .dashboard-content {
        padding: 24px 20px;
    }

    .category-dashboard .admin-topbar {
        padding: 15px 20px;
    }

    .category-dashboard .topbar-date {
        display: none;
    }
}

@media (max-width: 600px) {
    .category-dashboard {
        flex-direction: column;
    }

    .category-dashboard .admin-sidebar {
        width: 100%;
        min-width: 100%;
        min-height: auto;
        padding: 17px;
    }

    .category-dashboard .sidebar-brand {
        margin-bottom: 20px;
    }

    .category-dashboard .sidebar-menu {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .category-dashboard .sidebar-label {
        margin-top: 15px;
    }

    .category-dashboard .sidebar-bottom {
        margin-top: 15px;
    }

    .category-dashboard .admin-topbar {
        padding: 15px;
    }

    .category-dashboard .topbar-user {
        display: none;
    }

    .category-dashboard .dashboard-content {
        padding: 18px 14px;
    }

    .category-dashboard .category-banner {
        padding: 24px 20px;
        min-height: 155px;
    }

    .category-dashboard .category-banner h2 {
        font-size: 23px;
    }

    .category-dashboard .category-banner p {
        max-width: 85%;
        line-height: 1.6;
    }

    .category-dashboard .banner-decoration {
        font-size: 55px;
        margin-right: 0;
    }

    .category-dashboard .form-heading {
        align-items: flex-start;
        flex-direction: column;
    }

    .category-dashboard .form-fields {
        grid-template-columns: 1fr;
    }

    .category-dashboard .kasir-form-card {
        padding: 19px;
    }

    .category-dashboard .kasir-form-actions {
        flex-direction: column-reverse;
    }

    .category-dashboard .btn-cancel,
    .category-dashboard .btn-save-kasir {
        width: 100%;
    }

    .category-dashboard .dashboard-footer {
        flex-direction: column;
        gap: 7px;
    }
}

</style>
@endpush
