
@extends('layouts.master')

@section('title', 'Tambah Produk')

@section('content')
<div class="create-page">

    {{-- HEADER --}}
    <div class="page-header">
        <div>
            <span class="header-label">MANAJEMEN PRODUK</span>
            <h2>Tambah Produk Baru</h2>
            <p>Tambahkan produk dimsum baru ke katalog Ranatavan Dimsum.</p>
        </div>

        <a href="{{ route('admin.produk.index') }}" class="btn-back">
            ← Kembali
        </a>
    </div>

    {{-- ERROR VALIDASI --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Periksa kembali data yang dimasukkan:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.produk.store') }}" method="POST">
        @csrf

        {{-- INFORMASI PRODUK --}}
        <div class="form-card mb-4">
            <div class="card-heading">
                <div class="heading-icon">🥟</div>
                <div>
                    <h5>Informasi Produk</h5>
                    <p>Masukkan kategori dan varian produk.</p>
                </div>
            </div>

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">Kategori Produk <span>*</span></label>

                    <select name="category_id" id="category_id"
                            class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>

                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Varian Produk <span>*</span></label>

                    <select name="variant_id" id="variant_id"
                            class="form-select" required>
                        <option value="">-- Pilih Kategori Dahulu --</option>
                    </select>

                    <small class="text-muted">
                        Pilihan varian mengikuti kategori yang dipilih.
                    </small>
                </div>

                <div class="col-12">
                    <label class="form-label">Deskripsi Produk</label>

                    <textarea name="description" class="form-control"
                              rows="3"
                              placeholder="Masukkan deskripsi produk...">{{ old('description') }}</textarea>
                </div>

            </div>
        </div>

        {{-- UKURAN PRODUK --}}
        <div class="form-card mb-4">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
                <div class="card-heading mb-0">
                    <div class="heading-icon">📦</div>
                    <div>
                        <h5>Ukuran dan Persediaan</h5>
                        <p>Tambahkan ukuran, harga, dan stok produk.</p>
                    </div>
                </div>

                <button type="button" class="btn-add-size" id="addSize">
                    + Tambah Ukuran
                </button>
            </div>

            <div id="sizeContainer">

                @php
                    $oldSizes = old('sizes', [
                        [
                            'name' => '',
                            'unit' => 'pcs',
                            'piece_count' => '',
                            'price' => '',
                            'stock' => ''
                        ]
                    ]);
                @endphp

                @foreach($oldSizes as $index => $size)

                    <div class="size-item">

                        <div class="size-header">
                            <strong>Ukuran Produk <span class="size-number">{{ $loop->iteration }}</span></strong>

                            <button type="button" class="btn-remove-size"
                                    onclick="removeSize(this)">
                                Hapus
                            </button>
                        </div>

                        <div class="row g-3">

                            <div class="col-md-4">
                                <label class="form-label">Nama Ukuran <span>*</span></label>
                                <input type="text"
                                       name="sizes[{{ $index }}][name]"
                                       class="form-control"
                                       value="{{ $size['name'] ?? '' }}"
                                       placeholder="Contoh: Small, Medium, Large"
                                       required>
                            </div>

                            <div class="col-md-2">
                                <label class="form-label">Satuan <span>*</span></label>
                                <input type="text"
                                       name="sizes[{{ $index }}][unit]"
                                       class="form-control"
                                       value="{{ $size['unit'] ?? 'pcs' }}"
                                       placeholder="pcs"
                                       required>
                            </div>

                            <div class="col-md-2">
                                <label class="form-label">Jumlah Isi</label>
                                <input type="number"
                                       name="sizes[{{ $index }}][piece_count]"
                                       class="form-control"
                                       value="{{ $size['piece_count'] ?? '' }}"
                                       min="1"
                                       placeholder="Contoh: 5">
                            </div>

                            <div class="col-md-2">
                                <label class="form-label">Harga (Rp) <span>*</span></label>
                                <input type="number"
                                       name="sizes[{{ $index }}][price]"
                                       class="form-control"
                                       value="{{ $size['price'] ?? '' }}"
                                       min="0"
                                       placeholder="15000"
                                       required>
                            </div>

                            <div class="col-md-2">
                                <label class="form-label">Stok <span>*</span></label>
                                <input type="number"
                                       name="sizes[{{ $index }}][stock]"
                                       class="form-control"
                                       value="{{ $size['stock'] ?? '' }}"
                                       min="0"
                                       placeholder="20"
                                       required>
                            </div>

                        </div>
                    </div>

                @endforeach

            </div>

            <small class="text-muted">
                * Nama ukuran, satuan, harga, dan stok wajib diisi.
                Jumlah isi boleh dikosongkan.
            </small>
        </div>

        {{-- TOMBOL SIMPAN --}}
        <div class="form-footer">
            <a href="{{ route('admin.produk.index') }}" class="btn-cancel">
                Batal
            </a>

            <button type="submit" class="btn-save">
                Simpan Produk
            </button>
        </div>

    </form>
</div>
@endsection


@push('styles')
<style>
    .create-page {
        min-height: 100vh;
        background: #f8f5f0;
        padding: 30px;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 28px;
    }

    .header-label {
        color: #a47c59;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 2px;
    }

    .page-header h2 {
        color: #563522;
        font-size: 27px;
        font-weight: 800;
        margin: 7px 0;
    }

    .page-header p {
        color: #96887d;
        font-size: 13px;
        margin: 0;
    }

    .btn-back {
        background: white;
        color: #70452c;
        text-decoration: none;
        border: 1px solid #e8ddd2;
        padding: 11px 18px;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 700;
    }

    .form-card {
        background: white;
        padding: 25px;
        border: 1px solid #eee5db;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(75,46,27,.04);
    }

    .card-heading {
        display: flex;
        align-items: center;
        gap: 13px;
        margin-bottom: 25px;
    }

    .heading-icon {
        width: 45px;
        height: 45px;
        display: grid;
        place-items: center;
        background: #f5ece3;
        border-radius: 12px;
        font-size: 21px;
    }

    .card-heading h5 {
        color: #563522;
        font-size: 15px;
        font-weight: 800;
        margin: 0 0 5px;
    }

    .card-heading p {
        color: #a09287;
        font-size: 11px;
        margin: 0;
    }

    .form-label {
        color: #655347;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .form-label span {
        color: #c45b4c;
    }

    .form-control, .form-select {
        border: 1px solid #e8ddd2;
        border-radius: 9px;
        padding: 11px 13px;
        font-size: 12px;
    }

    .form-control:focus, .form-select:focus {
        border-color: #946747;
        box-shadow: 0 0 0 3px rgba(112,69,44,.1);
    }

    .form-card small {
        font-size: 10px;
        display: block;
        margin-top: 6px;
    }

    .btn-add-size {
        background: #70452c;
        color: white;
        border: none;
        padding: 10px 16px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 700;
    }

    .btn-add-size:hover {
        background: #563522;
    }

    .size-item {
        background: #fdfaf7;
        border: 1px solid #eee5db;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 15px;
    }

    .size-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
    }

    .size-header strong {
        color: #70452c;
        font-size: 12px;
    }

    .btn-remove-size {
        background: #f8e8e5;
        color: #a64e42;
        border: none;
        padding: 6px 11px;
        border-radius: 7px;
        font-size: 10px;
        font-weight: 700;
    }

    .form-footer {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        padding-bottom: 25px;
    }

    .btn-cancel, .btn-save {
        border: none;
        border-radius: 9px;
        padding: 12px 22px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
    }

    .btn-cancel {
        background: white;
        color: #70452c;
        border: 1px solid #e8ddd2;
    }

    .btn-save {
        background: #70452c;
        color: white;
    }

    .btn-save:hover {
        background: #563522;
    }

    @media(max-width: 767px) {
        .create-page {
            padding: 20px 14px;
        }

        .page-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .form-card {
            padding: 18px;
        }
    }
</style>
@endpush


@push('scripts')
<script>
    // Data kategori dan varian dari database
    const categories = @json($categories->map(function ($category) {
        return [
            'id' => $category->id,
            'variants' => $category->variants->map(function ($variant) {
                return [
                    'id' => $variant->id,
                    'name' => $variant->name
                ];
            })->values()
        ];
    })->values());

    const categorySelect = document.getElementById('category_id');
    const variantSelect = document.getElementById('variant_id');

    function updateVariants(selectedVariant = '') {
        const category = categories.find(
            item => String(item.id) === String(categorySelect.value)
        );

        variantSelect.innerHTML = '<option value="">-- Pilih Varian --</option>';

        if (!category) {
            variantSelect.innerHTML = '<option value="">-- Pilih Kategori Dahulu --</option>';
            return;
        }

        category.variants.forEach(variant => {
            const option = document.createElement('option');
            option.value = variant.id;
            option.textContent = variant.name;

            if (String(variant.id) === String(selectedVariant)) {
                option.selected = true;
            }

            variantSelect.appendChild(option);
        });

        if (category.variants.length === 0) {
            variantSelect.innerHTML = '<option value="">Belum ada varian</option>';
        }
    }

    categorySelect.addEventListener('change', function () {
        updateVariants();
    });

    // Mengembalikan pilihan lama jika validasi gagal
    updateVariants(@json(old('variant_id', '')));


    // Tambah ukuran produk
    let sizeIndex = {{ count($oldSizes) }};

    document.getElementById('addSize').addEventListener('click', function () {
        const container = document.getElementById('sizeContainer');

        const html = `
            <div class="size-item">
                <div class="size-header">
                    <strong>Ukuran Produk</strong>
                    <button type="button" class="btn-remove-size"
                            onclick="removeSize(this)">Hapus</button>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Nama Ukuran <span>*</span></label>
                        <input type="text" name="sizes[${sizeIndex}][name]"
                               class="form-control" placeholder="Contoh: Small"
                               required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Satuan <span>*</span></label>
                        <input type="text" name="sizes[${sizeIndex}][unit]"
                               class="form-control" value="pcs" required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Jumlah Isi</label>
                        <input type="number" name="sizes[${sizeIndex}][piece_count]"
                               class="form-control" min="1" placeholder="5">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Harga (Rp) <span>*</span></label>
                        <input type="number" name="sizes[${sizeIndex}][price]"
                               class="form-control" min="0" placeholder="15000"
                               required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Stok <span>*</span></label>
                        <input type="number" name="sizes[${sizeIndex}][stock]"
                               class="form-control" min="0" placeholder="20"
                               required>
                    </div>
                </div>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', html);
        sizeIndex++;
        updateSizeNumbers();
    });

    // Hapus ukuran
    function removeSize(button) {
        const items = document.querySelectorAll('.size-item');

        if (items.length <= 1) {
            alert('Minimal harus ada satu ukuran produk.');
            return;
        }

        button.closest('.size-item').remove();
        updateSizeNumbers();
    }

    // Mengatur nomor ukuran
    function updateSizeNumbers() {
        document.querySelectorAll('.size-item').forEach((item, index) => {
            const number = item.querySelector('.size-number');

            if (number) {
                number.textContent = index + 1;
            }
        });
    }
</script>
@endpush
