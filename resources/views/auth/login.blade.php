@extends('layouts.master')

@section('title', 'Login')

@section('content')

<div class="login-page">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100 py-4">

            <div class="col-12 col-md-10 col-lg-9 col-xl-8">

                <div class="login-card">

                    <div class="row g-0">

                        {{-- BAGIAN KIRI --}}
                        <div class="col-md-6">
                            <div class="login-brand">

                                <div class="brand-icon">
                                    🥟
                                </div>

                                <p class="brand-label">
                                    WELCOME TO
                                </p>

                                <h1>
                                    Ranatavan
                                    <span>Dimsum</span>
                                </h1>

                                <div class="brand-line"></div>

                                <p class="brand-description">
                                    Nikmati kelezatan dimsum dengan cita rasa
                                    istimewa. Kelola pemesanan dan penjualan
                                    dengan mudah melalui satu sistem.
                                </p>

                                <div class="brand-decoration">
                                    <span>✦</span>
                                    <span>✧</span>
                                    <span>✦</span>
                                </div>

                                <div class="brand-footer">
                                    FRESH • DELICIOUS • SPECIAL
                                </div>

                            </div>
                        </div>

                        {{-- BAGIAN KANAN --}}
                        <div class="col-md-6">
                            <div class="login-form-section">

                                <div class="form-heading">
                                    <span class="form-subtitle">
                                        SISTEM INFORMASI
                                    </span>

                                    <h2>Selamat Datang!</h2>

                                    <p>
                                        Silakan masuk untuk melanjutkan
                                        ke halaman utama.
                                    </p>
                                </div>

                                {{-- PESAN ERROR --}}
                                @if ($errors->any())
                                    <div class="alert alert-danger login-alert">
                                        @foreach ($errors->all() as $error)
                                            <div>{{ $error }}</div>
                                        @endforeach
                                    </div>
                                @endif

                                {{-- FORM LOGIN --}}
                                <form action="{{ route('login.process') }}" method="POST">

                                    @csrf

                                    <div class="mb-4">
                                        <label for="email" class="form-label">
                                            Email
                                        </label>

                                        <div class="input-group custom-input">
                                            <span class="input-group-text">
                                                ✉
                                            </span>

                                            <input
                                                type="email"
                                                id="email"
                                                name="email"
                                                class="form-control"
                                                placeholder="Masukkan email"
                                                value="{{ old('email') }}"
                                                required
                                                autofocus
                                            >
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="password" class="form-label">
                                            Password
                                        </label>

                                        <div class="input-group custom-input">
                                            <span class="input-group-text">
                                                🔒
                                            </span>

                                            <input
                                                type="password"
                                                id="password"
                                                name="password"
                                                class="form-control"
                                                placeholder="Masukkan password"
                                                required
                                            >
                                        </div>
                                    </div>

                                    <button type="submit" class="btn-login">
                                        <span>Masuk Sekarang</span>
                                        <span class="login-arrow">→</span>
                                    </button>

                                </form>

                                <div class="login-divider"></div>

                                <div class="login-copyright">
                                    <p>
                                        © {{ date('Y') }} Ranatavan Dimsum
                                    </p>

                                    <small>
                                        Sistem Informasi Pemesanan dan Penjualan Dimsum
                                    </small>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .login-page {
        min-height: 100vh;
        background:
            radial-gradient(circle at 10% 15%, #ead9c5 0, transparent 30%),
            radial-gradient(circle at 90% 85%, #e8d4bd 0, transparent 30%),
            #f8f3eb;
        font-family: Arial, sans-serif;
    }

    .login-card {
        background: #fffdf9;
        border-radius: 22px;
        overflow: hidden;
        box-shadow: 0 18px 55px rgba(75, 46, 27, 0.15);
    }

    /* BAGIAN BRAND */

    .login-brand {
        min-height: 540px;
        height: 100%;
        background: linear-gradient(145deg, #805337, #563522);
        color: white;
        padding: 55px 38px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .login-brand::before {
        content: "";
        position: absolute;
        width: 260px;
        height: 260px;
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 50%;
        top: -100px;
        right: -100px;
    }

    .login-brand::after {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        border: 1px solid rgba(255,255,255,0.10);
        border-radius: 50%;
        bottom: -110px;
        left: -100px;
    }

    .brand-icon {
        width: 85px;
        height: 85px;
        border-radius: 22px;
        background: rgba(255,255,255,0.13);
        border: 1px solid rgba(255,255,255,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 43px;
        margin-bottom: 32px;
    }

    .brand-label {
        color: #e8c8a4;
        font-size: 11px;
        letter-spacing: 4px;
        font-weight: bold;
        margin-bottom: 12px;
    }

    .login-brand h1 {
        font-size: 37px;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 5px;
    }

    .login-brand h1 span {
        display: block;
        color: #e9c69e;
    }

    .brand-line {
        width: 55px;
        height: 4px;
        background: #d6aa7b;
        border-radius: 5px;
        margin: 24px 0;
    }

    .brand-description {
        color: #eadfd4;
        font-size: 13px;
        line-height: 1.9;
        max-width: 300px;
    }

    .brand-decoration {
        display: flex;
        gap: 15px;
        color: #e8c49c;
        font-size: 22px;
        margin-top: 35px;
    }

    .brand-footer {
        color: #d9b99a;
        font-size: 10px;
        letter-spacing: 2px;
        margin-top: 35px;
    }

    /* BAGIAN FORM */

    .login-form-section {
        padding: 55px 38px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        min-height: 540px;
    }

    .form-subtitle {
        color: #a17a59;
        font-size: 10px;
        letter-spacing: 3px;
        font-weight: bold;
    }

    .form-heading h2 {
        color: #563522;
        font-size: 27px;
        font-weight: 800;
        margin-top: 12px;
        margin-bottom: 10px;
    }

    .form-heading p {
        color: #92877e;
        font-size: 13px;
        margin-bottom: 30px;
        line-height: 1.7;
    }

    .login-form-section .form-label {
        color: #62442f;
        font-size: 13px;
        font-weight: bold;
        margin-bottom: 9px;
    }

    .custom-input {
        border: 1px solid #e9dfd4;
        border-radius: 10px;
        overflow: hidden;
        background: #fffdf9;
        transition: 0.2s;
    }

    .custom-input:focus-within {
        border-color: #805337;
        box-shadow: 0 0 0 3px rgba(128,83,55,0.10);
    }

    .custom-input .input-group-text {
        background: #f8f1e9;
        border: none;
        color: #805337;
        padding-left: 15px;
        padding-right: 12px;
    }

    .custom-input .form-control {
        border: none;
        background: transparent;
        padding: 13px 12px;
        font-size: 13px;
        box-shadow: none;
    }

    .custom-input .form-control:focus {
        background: transparent;
    }

    .custom-input .form-control::placeholder {
        color: #b7aaa0;
    }

    .btn-login {
        width: 100%;
        border: none;
        border-radius: 10px;
        padding: 14px 18px;
        background: linear-gradient(135deg, #805337, #563522);
        color: white;
        font-size: 14px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: 0.25s;
    }

    .btn-login:hover {
        background: linear-gradient(135deg, #68432c, #432818);
        transform: translateY(-2px);
        box-shadow: 0 8px 18px rgba(86,53,34,0.2);
    }

    .login-arrow {
        font-size: 20px;
    }

    .login-alert {
        font-size: 12px;
        border-radius: 9px;
    }

    .login-divider {
        height: 1px;
        background: #eee5db;
        margin-top: 35px;
        margin-bottom: 20px;
    }

    .login-copyright {
        text-align: center;
    }

    .login-copyright p {
        color: #805337;
        font-weight: bold;
        font-size: 12px;
        margin-bottom: 5px;
    }

    .login-copyright small {
        color: #a99b90;
        font-size: 10px;
    }

    /* RESPONSIVE */

    @media (max-width: 767px) {
        .login-page {
            padding: 15px 0;
        }

        .login-brand {
            min-height: auto;
            padding: 35px 28px;
        }

        .brand-icon {
            width: 65px;
            height: 65px;
            font-size: 32px;
            margin-bottom: 20px;
        }

        .login-brand h1 {
            font-size: 30px;
        }

        .brand-decoration,
        .brand-footer {
            display: none;
        }

        .login-form-section {
            min-height: auto;
            padding: 35px 28px;
        }

        .form-heading h2 {
            font-size: 24px;
        }
    }
</style>
@endpush
