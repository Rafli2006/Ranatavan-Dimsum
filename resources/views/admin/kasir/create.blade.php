
@extends('layouts.master')

@section('title', 'Tambah Kasir')

@section('content')
<div class="kasir-form-page">

    <div class="page-header">
        <div>
            <span class="header-label">MANAJEMEN PENGGUNA</span>
            <h2>Tambah Kasir</h2>
            <p>Tambahkan akun kasir baru untuk Ranatavan Dimsum.</p>
        </div>

        <a href="{{ route('admin.kasir.index') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger rounded-3">
            <strong>Periksa kembali data berikut:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.kasir.store') }}" method="POST">
        @csrf

        {{-- INFORMASI AKUN --}}
        <div class="form-card">

            <div class="section-title">
                <div class="section-icon">
                    <i class="bi bi-person-vcard-fill"></i>
                </div>
                <div>
                    <h5>Informasi Akun Kasir</h5>
                    <p>Lengkapi identitas pengguna kasir.</p>
                </div>
            </div>

            <div class="row g-4 mt-2">

                <div class="col-md-6">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama lengkap"
                        required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Username</label>
                    <input type="text"
                        name="username"
                        class="form-control"
                        value="{{ old('username') }}"
                        placeholder="Contoh: budi"
                        required>
                </div>

                <div class="col-md-12">
                    <label class="form-label">Email</label>
                    <input type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email') }}"
                        placeholder="contoh@email.com"
                        required>
                </div>

            </div>
        </div>

        {{-- PASSWORD --}}
        <div class="form-card">

            <div class="section-title">
                <div class="section-icon">
                    <i class="bi bi-shield-lock-fill"></i>
                </div>
                <div>
                    <h5>Keamanan Akun</h5>
                    <p>Buat password untuk akun kasir.</p>
                </div>
            </div>

            <div class="mt-4">
                <label class="form-label">Password</label>
                <input type="password"
                    name="password"
                    class="form-control"
                    placeholder="Minimal 8 karakter"
                    minlength="8"
                    required>

                <small class="form-help">
                    Password minimal 8 karakter dan akan di-hash otomatis oleh Laravel.
                </small>
            </div>
        </div>

        {{-- INFORMASI ROLE --}}
        <div class="form-card info-card">
            <div class="info-content">
                <div class="info-icon">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div>
                    <strong>Akses Akun Kasir</strong>
                    <p>
                        Akun yang dibuat otomatis memiliki role Kasir dan status Aktif.
                    </p>
                </div>
            </div>
        </div>

        {{-- TOMBOL --}}
        <div class="form-footer">
            <a href="{{ route('admin.kasir.index') }}" class="btn-cancel">
                Batal
            </a>

            <button type="submit" class="btn-save">
                <i class="bi bi-save"></i> Simpan Akun Kasir
            </button>
        </div>

    </form>
</div>
@endsection

@push('styles')
<style>
    .kasir-form-page {
        max-width: 1100px;
        margin: auto;
        padding: 25px 20px 40px;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 28px;
    }

    .header-label {
        color: #946747;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.5px;
    }

    .page-header h2 {
        color: #54321f;
        font-size: 28px;
        font-weight: 800;
        margin: 8px 0 4px;
    }

    .page-header p {
        color: #9a897c;
        font-size: 14px;
        margin: 0;
    }

    .btn-back, .btn-cancel {
        display: inline-block;
        background: white;
        border: 1px solid #ddcbb9;
        color: #70452c;
        padding: 11px 18px;
        border-radius: 9px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-back:hover, .btn-cancel:hover {
        background: #f4e9dd;
        color: #54321f;
    }

    .form-card {
        background: white;
        border: 1px solid #eee4da;
        border-radius: 15px;
        padding: 28px;
        margin-bottom: 22px;
        box-shadow: 0 3px 12px rgba(80, 50, 30, .04);
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .section-icon {
        width: 45px;
        height: 45px;
        flex-shrink: 0;
        background: #f4e9dd;
        color: #70452c;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 19px;
    }

    .section-title h5 {
        color: #54321f;
        font-weight: 700;
        font-size: 17px;
        margin-bottom: 4px;
    }

    .section-title p {
        color: #9a897c;
        font-size: 12px;
        margin: 0;
    }

    .form-label {
        color: #594333;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .form-control {
        min-height: 46px;
        border: 1px solid #e6dcd1;
        border-radius: 9px;
        padding: 10px 13px;
        font-size: 14px;
        background: #fffdfb;
    }

    .form-control:focus {
        border-color: #946747;
        box-shadow: 0 0 0 3px rgba(112,69,44,.10);
    }

    .form-help {
        display: block;
        color: #9a897c;
        font-size: 11px;
        margin-top: 8px;
    }

    .info-card {
        background: #fcf9f5;
    }

    .info-content {
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .info-icon {
        width: 42px;
        height: 42px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e8f0e5;
        color: #52734b;
        border-radius: 11px;
        font-size: 19px;
    }

    .info-content strong {
        color: #54321f;
        font-size: 14px;
    }

    .info-content p {
        color: #958477;
        font-size: 12px;
        margin: 4px 0 0;
    }

    .form-footer {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .btn-save {
        background: #70452c;
        color: white;
        border: none;
        padding: 11px 20px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-save:hover {
        background: #54321f;
        color: white;
    }

    @media (max-width: 768px) {
        .kasir-form-page {
            padding: 15px 5px 30px;
        }

        .form-card {
            padding: 19px;
        }

        .page-header {
            align-items: flex-start;
        }
    }
</style>
@endpush
