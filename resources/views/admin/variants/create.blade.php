@extends('layouts.master')

@section('title', 'Tambah Varian')

@section('content')
<style>
    body {
        background: #f8f5f0;
    }

    .page-wrapper {
        display: flex;
        min-height: 100vh;
    }

    .sidebar {
        width: 250px;
        background: #563522;
        color: white;
        padding: 25px 15px;
        flex-shrink: 0;
    }

    .sidebar h5 {
        padding: 0 12px 20px;
        border-bottom: 1px solid rgba(255,255,255,.2);
        margin-bottom: 20px;
    }

    .sidebar-link {
        display: block;
        padding: 12px 15px;
        margin-bottom: 7px;
        border-radius: 8px;
        color: #f5e9dc;
        text-decoration: none;
    }

    .sidebar-link:hover,
    .sidebar-link.active {
        background: #8b5e3c;
        color: white;
    }

    .main-content {
        flex: 1;
        padding: 30px;
        min-width: 0;
    }

    .form-card {
        background: white;
        border-radius: 14px;
        padding: 30px;
        max-width: 750px;
        box-shadow: 0 3px 12px rgba(0,0,0,.05);
    }

    .form-label {
        font-weight: 600;
        color: #563522;
    }

    .form-control,
    .form-select {
        padding: 11px 13px;
        border-radius: 8px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #8b5e3c;
        box-shadow: 0 0 0 .2rem rgba(112,69,44,.12);
    }

    .btn-cokelat {
        background: #70452c;
        color: white;
        border: none;
        padding: 10px 22px;
    }

    .btn-cokelat:hover {
        background: #563522;
        color: white;
    }

    @media (max-width: 768px) {
        .page-wrapper {
            display: block;
        }

        .sidebar {
            width: 100%;
        }

        .main-content {
            padding: 18px;
        }
    }
</style>

<div class="page-wrapper">

    <aside class="sidebar">
        <h5>🍜 Ranatavan Dimsum</h5>

        <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
            🏠 Dashboard
        </a>

        <a href="{{ route('admin.kasir.index') }}" class="sidebar-link">
            👥 Data Kasir
        </a>

        <a href="{{ route('admin.kategori.index') }}" class="sidebar-link">
            📁 Data Kategori
        </a>

        <a href="{{ route('admin.varian.index') }}" class="sidebar-link active">
            🏷️ Data Varian
        </a>

        <a href="{{ route('admin.produk.index') }}" class="sidebar-link">
            📦 Data Produk
        </a>
    </aside>

    <main class="main-content">

        <div class="mb-4">
            <h3 class="fw-bold" style="color:#563522;">Tambah Varian</h3>
            <p class="text-muted mb-0">
                Tambahkan varian baru sesuai kategori produk.
            </p>
        </div>

        <div class="form-card">

            <div class="mb-4">
                <h5 class="fw-bold mb-1">Form Tambah Varian</h5>
                <small class="text-muted">
                    Lengkapi informasi varian di bawah ini.
                </small>
            </div>

            <form action="{{ route('admin.varian.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="category_id" class="form-label">
                        Kategori Produk <span class="text-danger">*</span>
                    </label>

                    <select name="category_id"
                            id="category_id"
                            class="form-select @error('category_id') is-invalid @enderror"
                            required>
                        <option value="">-- Pilih Kategori --</option>

                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <small class="text-muted">
                        Pilih kategori tempat varian ini akan digunakan.
                    </small>
                </div>

                <div class="mb-4">
                    <label for="name" class="form-label">
                        Nama Varian <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                           name="name"
                           id="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}"
                           placeholder="Contoh: Original, Mentai, Keju"
                           maxlength="100"
                           required>

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between flex-wrap gap-2 pt-3 border-top">
                    <a href="{{ route('admin.varian.index') }}"
                       class="btn btn-outline-secondary px-4">
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-cokelat">
                        Simpan Varian
                    </button>
                </div>

            </form>
        </div>

    </main>
</div>
@endsection
