@extends('layouts.master')

@section('title', 'Login')

@section('content')

<div class="login-page">

    {{-- BACKGROUND --}}
    <div class="login-decoration decoration-one"></div>
    <div class="login-decoration decoration-two"></div>

    <div class="container-fluid login-container">
        <div class="row justify-content-center align-items-center min-vh-100 py-4">

            <div class="col-12 col-xl-11 col-xxl-10">

                <div class="login-card">
                    <div class="row g-0">

                        {{-- =====================================
                            BAGIAN KIRI
                        ====================================== --}}
                        <div class="col-lg-6">

                            <div class="login-left">

                                {{-- DEKORASI LENTERA --}}
                                <div class="lantern lantern-one">🏮</div>
                                <div class="lantern lantern-two">🏮</div>

                                {{-- LOGO BESAR ASLI --}}
                                <div class="main-logo-area">
                                    <div class="main-logo-circle">
                                        <img
                                            src="{{ asset('images/logo/logo.jpeg') }}"
                                            alt="Logo Ranatavan Dimsum"
                                        >
                                    </div>
                                </div>

                                {{-- TEKS BRAND --}}
                                <div class="brand-content">

                                    <h1>
                                        Delicious
                                        <span>Moments</span>
                                        Start Here.
                                    </h1>

                                    <div class="brand-underline"></div>

                                    <p>
                                        Sajian dimsum istimewa dengan cita rasa
                                        yang selalu menghadirkan kebahagiaan.
                                    </p>

                                    <div class="brand-features">
                                        <div>
                                            <i class="bi bi-check-circle-fill"></i>
                                            Fresh Ingredients
                                        </div>

                                        <div>
                                            <i class="bi bi-check-circle-fill"></i>
                                            Quality Taste
                                        </div>

                                        <div>
                                            <i class="bi bi-check-circle-fill"></i>
                                            Easy Management
                                        </div>
                                    </div>

                                </div>

                                {{-- FOTO DIMSUM --}}
                                <div class="food-gallery">

                                    <div class="food-image food-image-one">
                                        <img
                                            src="https://images.unsplash.com/photo-1563245372-f21724e3856d?auto=format&fit=crop&w=900&q=85"
                                            alt="Dimsum kukus"
                                        >
                                    </div>

                                    <div class="food-image food-image-two">
                                        <img
                                            src="https://images.unsplash.com/photo-1541696432-82c6da8ce7bf?auto=format&fit=crop&w=900&q=85"
                                            alt="Hidangan dimsum"
                                        >
                                    </div>

                                    <div class="delicious-sticker">
                                        <strong>100%</strong>
                                        <span>DELICIOUS</span>
                                    </div>

                                </div>

                                {{-- BOTTOM --}}
                                <div class="brand-bottom">
                                    <span>🥟 FRESH</span>
                                    <i></i>
                                    <span>🥟 DELICIOUS</span>
                                    <i></i>
                                    <span>🥟 SPECIAL</span>
                                </div>

                                <div class="left-circle circle-one"></div>
                                <div class="left-circle circle-two"></div>

                            </div>

                        </div>

                        {{-- =====================================
                            BAGIAN KANAN
                        ====================================== --}}
                        <div class="col-lg-6">

                            <div class="login-right">

                                {{-- DEKORASI --}}
                                <div class="form-decoration form-decoration-one"></div>
                                <div class="form-decoration form-decoration-two"></div>

                                <div class="login-content">

                                    {{-- LOGO KECIL ASLI --}}
                                    <div class="form-logo">
                                        <div class="form-logo-circle">
                                            <img
                                                src="{{ asset('images/logo/logo.jpeg') }}"
                                                alt="Logo Ranatavan Dimsum"
                                            >
                                        </div>
                                    </div>

                                    <div class="form-heading">
                                        <h2>Login ke Akun Anda</h2>

                                        <p>
                                            Kelola bisnis dimsum dengan mudah
                                            dan efisien.
                                        </p>
                                    </div>

                                    {{-- ERROR LOGIN --}}
                                    @if ($errors->any())
                                        <div class="alert alert-danger login-alert">
                                            <div class="d-flex gap-2">
                                                <i class="bi bi-exclamation-circle-fill"></i>

                                                <div>
                                                    <strong>Login gagal!</strong>

                                                    @foreach ($errors->all() as $error)
                                                        <div>{{ $error }}</div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    {{-- FORM LOGIN --}}
                                    <form
                                        action="{{ route('login.process') }}"
                                        method="POST"
                                        class="login-form"
                                    >

                                        @csrf

                                        {{-- EMAIL --}}
                                        <div class="input-group-custom">

                                            <div class="input-icon">
                                                <i class="bi bi-person-fill"></i>
                                            </div>

                                            <input
                                                type="email"
                                                id="email"
                                                name="email"
                                                placeholder="Alamat Email"
                                                value="{{ old('email') }}"
                                                autocomplete="username"
                                                required
                                                autofocus
                                            >

                                        </div>

                                        {{-- PASSWORD --}}
                                        <div class="input-group-custom">

                                            <div class="input-icon">
                                                <i class="bi bi-lock-fill"></i>
                                            </div>

                                            <input
                                                type="password"
                                                id="password"
                                                name="password"
                                                placeholder="Password"
                                                autocomplete="current-password"
                                                required
                                            >

                                            <button
                                                type="button"
                                                class="password-toggle"
                                                id="togglePassword"
                                                aria-label="Tampilkan password"
                                            >
                                                <i class="bi bi-eye-slash"></i>
                                            </button>

                                        </div>

                                        {{-- TOMBOL LOGIN --}}
                                        <button type="submit" class="btn-login">
                                            <i class="bi bi-box-arrow-in-right"></i>
                                            Login
                                        </button>

                                    </form>

                                    {{-- PEMISAH --}}
                                    <div class="login-separator">
                                        <span></span>
                                        <p>atau</p>
                                        <span></span>
                                    </div>

                                    {{-- KEMBALI KE BERANDA --}}
                                    <a href="{{ url('/') }}" class="btn-home">
                                        <i class="bi bi-house-fill"></i>
                                        Kembali ke Beranda
                                    </a>

                                    {{-- FOOTER --}}
                                    <div class="login-footer">
                                        <p>
                                            Ranatavan Dimsum
                                            <span>•</span>
                                            Good Food, Good Mood
                                            <i class="bi bi-heart-fill"></i>
                                        </p>
                                    </div>

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

    :root {
        --orange: #ff7900;
        --orange-dark: #e95d00;
        --brown: #54270f;
        --cream: #fff8ef;
    }

    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        background: #fff5e9;
    }

    .login-page {
        min-height: 100vh;
        position: relative;
        overflow: hidden;
        padding: 20px 0;
        background:
            radial-gradient(circle at 0% 0%, #ffdfb9, transparent 35%),
            radial-gradient(circle at 100% 100%, #ffd7a8, transparent 35%),
            #fff8ef;
        font-family: 'DM Sans', Arial, sans-serif;
    }

    .login-container {
        position: relative;
        z-index: 2;
    }

    /* =====================================
       MAIN CARD
    ====================================== */

    .login-card {
        overflow: hidden;
        border-radius: 27px;
        background: white;
        box-shadow: 0 25px 70px rgba(92, 44, 15, .18);
    }

    /* =====================================
       LEFT SECTION
    ====================================== */

    .login-left {
        min-height: 750px;
        height: 100%;
        position: relative;
        overflow: hidden;
        padding: 30px 38px 25px;
        display: flex;
        flex-direction: column;
        background:
            linear-gradient(
                145deg,
                rgba(255, 160, 70, .93),
                rgba(226, 91, 0, .94)
            ),
            url('https://images.unsplash.com/photo-1552566626-52f8b828add9?auto=format&fit=crop&w=1200&q=85') center/cover;
        color: white;
    }

    .lantern {
        position: absolute;
        z-index: 1;
        font-size: 48px;
        opacity: .9;
        filter: drop-shadow(0 7px 12px rgba(80, 30, 0, .2));
    }

    .lantern-one {
        top: 5px;
        left: 8px;
    }

    .lantern-two {
        top: 15px;
        right: 8px;
        font-size: 38px;
    }

    /* LOGO UTAMA */

    .main-logo-area {
        position: relative;
        z-index: 3;
        display: flex;
        justify-content: center;
        margin-top: 12px;
    }

    .main-logo-circle {
        width: 245px;
        height: 245px;
        border-radius: 50%;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        background: transparent;
        box-shadow: 0 12px 30px rgba(76, 30, 5, .18);
    }

    .main-logo-circle img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        mix-blend-mode: multiply;
        display: block;
    }

    /* BRAND TEXT */

    .brand-content {
        position: relative;
        z-index: 3;
        text-align: left;
        margin-top: 22px;
    }

    .brand-content h1 {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: clamp(34px, 4vw, 48px);
        font-weight: 900;
        line-height: 1.08;
        color: white;
        margin: 0;
        text-shadow: 0 3px 12px rgba(80, 30, 0, .16);
    }

    .brand-content h1 span {
        display: block;
        color: #71320e;
    }

    .brand-underline {
        width: 135px;
        height: 5px;
        border-radius: 20px;
        background: #ffcc66;
        margin: 15px 0;
    }

    .brand-content p {
        color: #fff4e7;
        font-size: 12px;
        line-height: 1.8;
        max-width: 370px;
    }

    .brand-features {
        display: flex;
        flex-wrap: wrap;
        gap: 9px 15px;
        margin-top: 15px;
    }

    .brand-features div {
        font-size: 10px;
        font-weight: 700;
        color: white;
    }

    .brand-features i {
        color: #ffdf9a;
        margin-right: 4px;
    }

    /* FOOD GALLERY */

    .food-gallery {
        height: 220px;
        position: relative;
        z-index: 3;
        margin-top: 25px;
    }

    .food-image {
        position: absolute;
        overflow: hidden;
        border: 5px solid rgba(255,255,255,.65);
        border-radius: 22px;
        box-shadow: 0 12px 30px rgba(75, 30, 5, .24);
    }

    .food-image img {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
    }

    .food-image-one {
        width: 62%;
        height: 195px;
        left: 0;
        bottom: 0;
        transform: rotate(-3deg);
    }

    .food-image-two {
        width: 52%;
        height: 165px;
        right: 0;
        top: 0;
        transform: rotate(3deg);
    }

    .delicious-sticker {
        position: absolute;
        z-index: 4;
        left: 4%;
        bottom: 5px;
        width: 95px;
        height: 95px;
        border-radius: 50%;
        background: #c92c16;
        border: 4px solid #ffcf61;
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        transform: rotate(-12deg);
        box-shadow: 0 6px 15px rgba(80, 20, 0, .2);
    }

    .delicious-sticker strong {
        font-size: 23px;
        font-weight: 900;
    }

    .delicious-sticker span {
        font-size: 9px;
        font-weight: 900;
    }

    /* BOTTOM BRAND */

    .brand-bottom {
        position: relative;
        z-index: 3;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: auto;
        padding-top: 20px;
        color: white;
        font-size: 10px;
        font-weight: 900;
        letter-spacing: .7px;
    }

    .brand-bottom i {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: #ffdf9a;
    }

    .left-circle {
        position: absolute;
        border: 1px solid rgba(255,255,255,.2);
        border-radius: 50%;
        pointer-events: none;
    }

    .circle-one {
        width: 300px;
        height: 300px;
        right: -150px;
        top: 120px;
    }

    .circle-two {
        width: 200px;
        height: 200px;
        right: -100px;
        top: 170px;
    }

    /* =====================================
       RIGHT SECTION
    ====================================== */

    .login-right {
        min-height: 750px;
        height: 100%;
        position: relative;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 45px;
        background:
            radial-gradient(circle at 100% 0%, #ffe5cb, transparent 35%),
            radial-gradient(circle at 0% 100%, #fff0df, transparent 30%),
            #fffdf9;
    }

    .login-content {
        width: 100%;
        max-width: 470px;
        position: relative;
        z-index: 2;
    }

    .form-decoration {
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
    }

    .form-decoration-one {
        width: 180px;
        height: 180px;
        background: rgba(255, 135, 28, .12);
        right: -80px;
        top: -65px;
    }

    .form-decoration-two {
        width: 130px;
        height: 130px;
        border: 15px solid rgba(255, 135, 28, .08);
        left: -70px;
        bottom: 30px;
    }

    /* LOGO KECIL */

    .form-logo {
        display: flex;
        justify-content: center;
        margin-bottom: 22px;
    }

    .form-logo-circle {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        background: transparent;
        box-shadow: 0 5px 18px rgba(100, 50, 15, .12);
    }

    .form-logo-circle img {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
        border-radius: 50%;
        mix-blend-mode: multiply;
    }

    /* FORM HEADING */

    .form-heading {
        text-align: center;
        margin-bottom: 27px;
    }

    .form-heading h2 {
        color: #51260f;
        font-size: 30px;
        font-weight: 900;
        margin: 0 0 10px;
    }

    .form-heading p {
        color: #8e7568;
        font-size: 14px;
        line-height: 1.7;
        margin: 0;
    }

    /* ERROR */

    .login-alert {
        font-size: 12px;
        border-radius: 12px;
        margin-bottom: 20px;
    }

    /* INPUT */

    .login-form {
        width: 100%;
    }

    .input-group-custom {
        width: 100%;
        height: 64px;
        display: flex;
        align-items: center;
        border: 1.5px solid #ddcfc4;
        border-radius: 17px;
        background: rgba(255,255,255,.8);
        margin-bottom: 20px;
        overflow: hidden;
        transition: .25s ease;
    }

    .input-group-custom:focus-within {
        border-color: #f47b16;
        box-shadow: 0 0 0 4px rgba(244, 123, 22, .1);
        background: white;
    }

    .input-icon {
        width: 68px;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #92796b;
        font-size: 23px;
        flex-shrink: 0;
    }

    .input-group-custom input {
        width: 100%;
        height: 100%;
        border: none;
        outline: none;
        background: transparent;
        color: #54301e;
        font-size: 15px;
        padding: 0 8px;
        box-shadow: none;
    }

    .input-group-custom input::placeholder {
        color: #917c70;
    }

    .password-toggle {
        width: 55px;
        height: 100%;
        flex-shrink: 0;
        border: none;
        background: transparent;
        color: #92796b;
        font-size: 21px;
    }

    .password-toggle:hover {
        color: #ed6b10;
    }

    /* LOGIN BUTTON */

    .btn-login {
        width: 100%;
        height: 64px;
        border: none;
        border-radius: 17px;
        background: linear-gradient(110deg, #ff8a00, #ff6900);
        color: white;
        font-size: 19px;
        font-weight: 900;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 13px;
        margin-top: 25px;
        box-shadow: 0 9px 20px rgba(238, 105, 0, .24);
        transition: .25s ease;
    }

    .btn-login:hover {
        color: white;
        transform: translateY(-3px);
        background: linear-gradient(110deg, #f77900, #e95100);
        box-shadow: 0 13px 25px rgba(238, 105, 0, .32);
    }

    /* SEPARATOR */

    .login-separator {
        display: flex;
        align-items: center;
        gap: 20px;
        margin: 25px 0;
    }

    .login-separator span {
        height: 1px;
        flex: 1;
        background: #dfd1c7;
    }

    .login-separator p {
        margin: 0;
        color: #92796b;
        font-size: 14px;
    }

    /* HOME BUTTON */

    .btn-home {
        width: 100%;
        min-height: 57px;
        border: 1.5px solid #ff7900;
        border-radius: 17px;
        color: #642c10;
        background: rgba(255,255,255,.8);
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        font-size: 15px;
        font-weight: 800;
        transition: .25s ease;
    }

    .btn-home:hover {
        background: #fff0e3;
        color: #e65e00;
        transform: translateY(-2px);
    }

    .btn-home i {
        font-size: 19px;
    }

    /* FOOTER */

    .login-footer {
        text-align: center;
        margin-top: 32px;
    }

    .login-footer p {
        color: #713c25;
        font-size: 13px;
        margin: 0;
    }

    .login-footer span {
        margin: 0 5px;
        color: #e67b30;
    }

    .login-footer i {
        color: #ed4037;
        margin-left: 4px;
    }

    /* =====================================
       RESPONSIVE
    ====================================== */

    @media (max-width: 991px) {

        .login-left {
            min-height: 700px;
        }

        .login-right {
            min-height: 650px;
        }

    }

    @media (max-width: 575px) {

        .login-page {
            padding: 10px;
        }

        .login-card {
            border-radius: 20px;
        }

        .login-left {
            min-height: auto;
            padding: 25px 22px;
        }

        .main-logo-circle {
            width: 180px;
            height: 180px;
        }

        .brand-content {
            margin-top: 25px;
        }

        .brand-content h1 {
            font-size: 35px;
        }

        .food-gallery {
            height: 180px;
        }

        .food-image-one {
            height: 160px;
        }

        .food-image-two {
            height: 135px;
        }

        .delicious-sticker {
            width: 75px;
            height: 75px;
        }

        .delicious-sticker strong {
            font-size: 19px;
        }

        .login-right {
            min-height: auto;
            padding: 40px 23px;
        }

        .form-logo-circle {
            width: 85px;
            height: 85px;
        }

        .form-heading h2 {
            font-size: 25px;
        }

        .form-heading p {
            font-size: 12px;
        }

        .input-group-custom {
            height: 57px;
        }

        .btn-login {
            height: 57px;
        }

    }

    @media (prefers-reduced-motion: reduce) {
        .login-page *,
        .login-page *::before,
        .login-page *::after {
            transition: none !important;
        }
    }

</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const passwordInput = document.getElementById('password');
        const toggleButton = document.getElementById('togglePassword');

        if (passwordInput && toggleButton) {

            toggleButton.addEventListener('click', function () {

                const isPassword = passwordInput.type === 'password';

                passwordInput.type = isPassword ? 'text' : 'password';

                toggleButton.innerHTML = isPassword
                    ? '<i class="bi bi-eye"></i>'
                    : '<i class="bi bi-eye-slash"></i>';

                toggleButton.setAttribute(
                    'aria-label',
                    isPassword ? 'Sembunyikan password' : 'Tampilkan password'
                );

            });

        }

    });
</script>
@endpush