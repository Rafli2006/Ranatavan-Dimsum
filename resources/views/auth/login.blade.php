@extends('layouts.master')

@section('title', 'Login')

@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">

        <div class="col-md-5 col-lg-4">

            <div class="card p-4">

                <div class="text-center mb-4">
                    <h3 class="fw-bold" style="color: #70452c;">
                        Ranatavan Dimsum
                    </h3>

                    <p class="text-muted mb-0">
                        Sistem Informasi Pemesanan dan Penjualan Dimsum
                    </p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('login.process') }}" method="POST">

                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email</label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            placeholder="Masukkan email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Masukkan password"
                            required
                        >
                    </div>

                    <button type="submit" class="btn btn-cokelat w-100">
                        Login
                    </button>

                </form>

                <div class="text-center mt-4">
                    <small class="text-muted">
                        © 2026 Ranatavan Dimsum
                    </small>
                </div>

            </div>

        </div>

    </div>
</div>

@endsection
