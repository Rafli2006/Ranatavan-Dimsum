
@extends('layouts.master')

@section('title', 'Edit Produk')

@section('content')

@php
    $sizes = old('sizes', $produk->sizes->map(function ($size) {
        return [
            'name' => $size->name,
            'unit' => $size->unit,
            'piece_count' => $size->piece_count,
            'price' => $size->price,
            'stock' => $size->stock,
        ];
    })->toArray());

    if (empty($sizes)) {
        $sizes = [
            [
                'name' => '',
                'unit' => 'pcs',
                'piece_count' => '',
                'price' => '',
                'stock' => 0,
            ]
        ];
    }

    $selectedCategory = old('category_id', $produk->category_id);
    $selectedVariant = old('variant_id', $produk->variant_id);
@endphp

<div class="container-fluid edit-product-page">

    {{-- HEADER --}}
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <span class="page-label">MANAJEMEN PRODUK</span>
            <h4 class="fw-bold mb-1">Edit Produk</h4>
            <p class="text-muted mb-0">
                Perbarui informasi dan stok produk dimsum
            </p>
        </div>

        <a href="{{ route('admin.produk.index') }}" class="btn btn-back">
            Kembali
        </a>
    </div>

    {{-- PESAN ERROR --}}
    @if ($errors->any())
        <div class="alert alert-danger rounded-3 mb-4">
            <strong>Data belum berhasil disimpan.</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- INFORMASI PRODUK --}}
        <div class="card edit-card mb-4">
            <div class="card-body">

                <div class="section-heading mb-4">
                    <div class="section-icon">01</div>
                    <div>
                        <h5>Informasi Produk</h5>
                        <p>Atur kategori, varian, dan deskripsi produk</p>
                    </div>
                </div>

                <div class="row g-4">

                    <div class="col-md-6">
                        <label class="form-label">Kategori Produk</label>
                        <select name="category_id" id="category_id"
                            class="form-select" required>
                            <option value="">Pilih Kategori</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $selectedCategory == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Varian Produk</label>
                        <select name="variant_id" id="variant_id"
                            class="form-select" required>
                            <option value="">Pilih Varian</option>

                            @foreach ($categories as $category)
                                @foreach ($category->variants as $variant)
                                    <option
                                        value="{{ $variant->id }}"
                                        data-category="{{ $category->id }}"
                                        {{ $selectedVariant == $variant->id ? 'selected' : '' }}>
                                        {{ $variant->name }}
                                    </option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Deskripsi Produk</label>
                        <textarea
                            name="description"
                            class="form-control"
                            rows="4"
                            placeholder="Masukkan deskripsi produk...">{{ old('description', $produk->description) }}</textarea>
                    </div>

                </div>
            </div>
        </div>

        {{-- UKURAN DAN HARGA --}}
        <div class="card edit-card mb-4">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                    <div class="section-heading">
                        <div class="section-icon">02</div>
                        <div>
                            <h5>Ukuran dan Harga</h5>
                            <p>Atur ukuran, harga, dan stok setiap produk</p>
                        </div>
                    </div>

                    <button type="button" class="btn btn-add" id="addSize">
                        + Tambah Ukuran
                    </button>
                </div>

                <div id="sizeContainer">

                    @foreach ($sizes as $i => $size)
                        <div class="size-row mb-3">

                            <div class="size-header d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="size-number">{{ $i + 1 }}</span>
                                    <strong>Ukuran Produk</strong>
                                </div>

                                <button type="button"
                                    class="btn btn-remove remove-size">
                                    Hapus
                                </button>
                            </div>

                            <div class="row g-3">

                                <div class="col-md-4">
                                    <label class="form-label">Nama Ukuran</label>
                                    <input
                                        type="text"
                                        name="sizes[{{ $i }}][name]"
                                        class="form-control"
                                        value="{{ $size['name'] }}"
                                        placeholder="Contoh: Small"
                                        required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Satuan</label>
                                    <input
                                        type="text"
                                        name="sizes[{{ $i }}][unit]"
                                        class="form-control"
                                        value="{{ $size['unit'] }}"
                                        placeholder="Contoh: pcs"
                                        required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Jumlah Isi</label>
                                    <input
                                        type="number"
                                        name="sizes[{{ $i }}][piece_count]"
                                        class="form-control"
                                        value="{{ $size['piece_count'] }}"
                                        min="1"
                                        placeholder="Opsional">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Harga Produk (Rp)</label>
                                    <input
                                        type="number"
                                        name="sizes[{{ $i }}][price]"
                                        class="form-control"
                                        value="{{ $size['price'] }}"
                                        min="0"
                                        step="0.01"
                                        placeholder="Masukkan harga"
                                        required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Stok Produk</label>
                                    <input
                                        type="number"
                                        name="sizes[{{ $i }}][stock]"
                                        class="form-control"
                                        value="{{ $size['stock'] }}"
                                        min="0"
                                        placeholder="Masukkan stok"
                                        required>
                                </div>

                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

        {{-- TOMBOL AKSI --}}
        <div class="action-footer d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <strong>Pastikan data sudah benar</strong>
                <p class="text-muted mb-0">
                    Periksa kembali sebelum menyimpan perubahan.
                </p>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('admin.produk.index') }}" class="btn btn-cancel">
                    Batal
                </a>

                <button type="submit" class="btn btn-save">
                    Simpan Perubahan
                </button>
            </div>
        </div>

    </form>
</div>

@endsection


{{-- CSS --}}
@push('styles')
<style>
    .edit-product-page {
        max-width: 1200px;
        margin: auto;
        padding: 25px 20px 40px;
    }

    .page-label {
        display: inline-block;
        color: #946747;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.5px;
        margin-bottom: 7px;
    }

    .page-header h4 {
        color: #54321f;
        font-size: 27px;
    }

    .page-header p {
        color: #918477;
        font-size: 14px;
    }

    .edit-card {
        border: 1px solid #eee4da;
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 4px 15px rgba(80, 50, 30, 0.05);
        overflow: hidden;
    }

    .edit-card .card-body {
        padding: 28px;
    }

    .section-heading {
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .section-icon {
        width: 42px;
        height: 42px;
        background: #f4e9dd;
        color: #70452c;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        font-weight: 700;
        font-size: 14px;
    }

    .section-heading h5 {
        color: #54321f;
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .section-heading p {
        color: #9a8e82;
        font-size: 13px;
        margin-bottom: 0;
    }

    .form-label {
        color: #594333;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .form-control,
    .form-select {
        min-height: 44px;
        border: 1px solid #e6dcd1;
        border-radius: 9px;
        padding: 10px 13px;
        color: #49372a;
        background-color: #fffdfb;
        font-size: 14px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #946747;
        box-shadow: 0 0 0 3px rgba(112, 69, 44, 0.10);
    }

    textarea.form-control {
        min-height: 110px;
    }

    .btn-back,
    .btn-cancel {
        color: #70452c;
        border: 1px solid #d9c5b3;
        background: white;
        border-radius: 9px;
        padding: 10px 18px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
    }

    .btn-back:hover,
    .btn-cancel:hover {
        background: #f7eee6;
        color: #54321f;
    }

    .btn-add {
        background: #70452c;
        color: white;
        border: none;
        border-radius: 9px;
        padding: 10px 17px;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-add:hover,
    .btn-save:hover {
        background: #54321f;
        color: white;
    }

    .size-row {
        background: #fcf9f5;
        border: 1px solid #eadfd4;
        border-radius: 13px;
        padding: 22px;
    }

    .size-header strong {
        color: #70452c;
        font-size: 14px;
    }

    .size-number {
        width: 28px;
        height: 28px;
        border-radius: 8px;
        background: #70452c;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
    }

    .btn-remove {
        background: #fff;
        border: 1px solid #e8c8c1;
        color: #b54b3d;
        border-radius: 7px;
        padding: 6px 12px;
        font-size: 12px;
    }

    .btn-remove:hover {
        background: #fff0ed;
        color: #a33125;
    }

    .action-footer {
        padding: 20px 23px;
        background: #fff;
        border: 1px solid #eee4da;
        border-radius: 13px;
        box-shadow: 0 3px 12px rgba(80, 50, 30, 0.04);
    }

    .action-footer strong {
        color: #54321f;
        font-size: 14px;
    }

    .action-footer p {
        font-size: 12px;
        margin-top: 4px;
    }

    .btn-save {
        background: #70452c;
        color: white;
        border: none;
        border-radius: 9px;
        padding: 11px 21px;
        font-size: 14px;
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .edit-product-page {
            padding: 15px 5px 30px;
        }

        .edit-card .card-body {
            padding: 18px;
        }

        .page-header h4 {
            font-size: 22px;
        }

        .size-row {
            padding: 16px;
        }

        .action-footer {
            align-items: stretch !important;
        }

        .action-footer > div:last-child {
            width: 100%;
        }

        .action-footer .btn {
            flex: 1;
        }
    }
</style>
@endpush


{{-- JAVASCRIPT --}}
@push('scripts')
<script>
    // Filter varian berdasarkan kategori
    const categorySelect = document.getElementById('category_id');
    const variantSelect = document.getElementById('variant_id');

    function filterVariants(resetSelection = false) {
        const categoryId = categorySelect.value;

        Array.from(variantSelect.options).forEach(option => {
            if (option.value === '') {
                option.hidden = false;
                return;
            }

            option.hidden = option.dataset.category !== categoryId;
        });

        if (resetSelection) {
            variantSelect.value = '';
        } else {
            const selectedOption =
                variantSelect.options[variantSelect.selectedIndex];

            if (selectedOption && selectedOption.hidden) {
                variantSelect.value = '';
            }
        }
    }

    categorySelect.addEventListener('change', function () {
        filterVariants(true);
    });

    filterVariants();


    // Tambah ukuran produk
    const sizeContainer = document.getElementById('sizeContainer');

    let sizeIndex = {{ count($sizes) }};

    document.getElementById('addSize').addEventListener('click', function () {
        const html = `
            <div class="size-row mb-3">

                <div class="size-header d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <span class="size-number">${sizeIndex + 1}</span>
                        <strong>Ukuran Produk</strong>
                    </div>

                    <button type="button" class="btn btn-remove remove-size">
                        Hapus
                    </button>
                </div>

                <div class="row g-3">

                    <div class="col-md-4">
                        <label class="form-label">Nama Ukuran</label>
                        <input type="text"
                            name="sizes[${sizeIndex}][name]"
                            class="form-control"
                            placeholder="Contoh: Small"
                            required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Satuan</label>
                        <input type="text"
                            name="sizes[${sizeIndex}][unit]"
                            class="form-control"
                            placeholder="Contoh: pcs"
                            required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Jumlah Isi</label>
                        <input type="number"
                            name="sizes[${sizeIndex}][piece_count]"
                            class="form-control"
                            min="1"
                            placeholder="Opsional">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Harga Produk (Rp)</label>
                        <input type="number"
                            name="sizes[${sizeIndex}][price]"
                            class="form-control"
                            min="0"
                            step="0.01"
                            placeholder="Masukkan harga"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Stok Produk</label>
                        <input type="number"
                            name="sizes[${sizeIndex}][stock]"
                            class="form-control"
                            min="0"
                            placeholder="Masukkan stok"
                            required>
                    </div>

                </div>
            </div>
        `;

        sizeContainer.insertAdjacentHTML('beforeend', html);
        sizeIndex++;
    });


    // Hapus ukuran produk
    sizeContainer.addEventListener('click', function (event) {
        if (event.target.classList.contains('remove-size')) {

            const rows = sizeContainer.querySelectorAll('.size-row');

            if (rows.length <= 1) {
                alert('Minimal harus ada satu ukuran produk.');
                return;
            }

            event.target.closest('.size-row').remove();
        }
    });
</script>
@endpush
