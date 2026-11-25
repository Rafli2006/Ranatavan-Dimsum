@extends('layouts.master')

@section('title', 'Tambah Produk')

@section('content')

<div class="create-page">

    {{-- HEADER --}}
    <div class="page-header">
        <div class="header-content">
            <span class="header-label">
                <i class="bi bi-box-seam"></i>
                MANAJEMEN PRODUK
            </span>

            <h2>Tambah Produk Baru</h2>

            <p>
                Tambahkan produk dimsum baru ke katalog Ranatavan Dimsum.
                Lengkapi informasi produk dengan benar.
            </p>
        </div>

        <a href="{{ route('admin.produk.index') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>
    </div>

    {{-- ERROR VALIDASI --}}
    @if($errors->any())
        <div class="alert alert-danger custom-alert">
            <strong>
                <i class="bi bi-exclamation-circle-fill me-2"></i>
                Periksa kembali data yang dimasukkan:
            </strong>

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
                <div class="heading-icon orange">
                    <i class="bi bi-clipboard-data"></i>
                </div>

                <div>
                    <h5>Informasi Produk</h5>
                    <p>Masukkan kategori, varian, dan deskripsi produk.</p>
                </div>
            </div>

            <div class="row g-4">

                {{-- KATEGORI --}}
                <div class="col-md-6">
                    <label class="form-label">
                        Kategori Produk <span>*</span>
                    </label>

                    <div class="input-icon-wrapper">
                        <i class="bi bi-tags"></i>

                        <select name="category_id"
                                id="category_id"
                                class="form-select"
                                required>

                            <option value="">-- Pilih Kategori --</option>

                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <small class="field-help">
                        Pilih kategori yang sesuai dengan produk.
                    </small>
                </div>

                {{-- VARIAN --}}
                <div class="col-md-6">
                    <label class="form-label">
                        Varian Produk <span>*</span>
                    </label>

                    <div class="input-icon-wrapper">
                        <i class="bi bi-grid"></i>

                        <select name="variant_id"
                                id="variant_id"
                                class="form-select"
                                required>

                            <option value="">-- Pilih Kategori Dahulu --</option>

                        </select>
                    </div>

                    <small class="field-help">
                        Pilihan varian mengikuti kategori yang dipilih.
                    </small>
                </div>

                {{-- DESKRIPSI --}}
                <div class="col-12">
                    <label class="form-label">
                        Deskripsi Produk
                    </label>

                    <textarea name="description"
                              class="form-control description-input"
                              rows="4"
                              placeholder="Ceritakan sedikit tentang produk dimsum ini...">{{ old('description') }}</textarea>

                    <small class="field-help">
                        Deskripsi bersifat opsional.
                    </small>
                </div>

            </div>
        </div>

        {{-- UKURAN PRODUK --}}
        <div class="form-card mb-4">

            <div class="size-section-header">

                <div class="card-heading mb-0">
                    <div class="heading-icon peach">
                        <i class="bi bi-boxes"></i>
                    </div>

                    <div>
                        <h5>Ukuran dan Persediaan</h5>
                        <p>
                            Atur ukuran, harga jual, dan stok setiap ukuran produk.
                        </p>
                    </div>
                </div>

                <button type="button"
                        class="btn-add-size"
                        id="addSize">

                    <i class="bi bi-plus-lg"></i>
                    Tambah Ukuran
                </button>

            </div>

            <div class="size-information">
                <i class="bi bi-info-circle-fill"></i>
                Satu produk dapat memiliki beberapa pilihan ukuran dengan harga dan stok berbeda.
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
                            <div class="size-title">
                                <span class="size-number">{{ $loop->iteration }}</span>

                                <strong>Detail Ukuran Produk</strong>
                            </div>

                            <button type="button"
                                    class="btn-remove-size"
                                    onclick="removeSize(this)">

                                <i class="bi bi-trash3"></i>
                                Hapus
                            </button>
                        </div>

                        <div class="row g-3">

                            {{-- NAMA UKURAN --}}
                            <div class="col-md-4">
                                <label class="form-label">
                                    Nama Ukuran <span>*</span>
                                </label>

                                <input type="text"
                                       name="sizes[{{ $index }}][name]"
                                       class="form-control"
                                       value="{{ $size['name'] ?? '' }}"
                                       placeholder="Contoh: Small, Medium, Large"
                                       required>
                            </div>

                            {{-- SATUAN --}}
                            <div class="col-md-2">
                                <label class="form-label">
                                    Satuan <span>*</span>
                                </label>

                                <input type="text"
                                       name="sizes[{{ $index }}][unit]"
                                       class="form-control"
                                       value="{{ $size['unit'] ?? 'pcs' }}"
                                       placeholder="pcs"
                                       required>
                            </div>

                            {{-- JUMLAH ISI --}}
                            <div class="col-md-2">
                                <label class="form-label">
                                    Jumlah Isi
                                </label>

                                <input type="number"
                                       name="sizes[{{ $index }}][piece_count]"
                                       class="form-control"
                                       value="{{ $size['piece_count'] ?? '' }}"
                                       min="1"
                                       placeholder="Contoh: 5">
                            </div>

                            {{-- HARGA --}}
                            <div class="col-md-2">
                                <label class="form-label">
                                    Harga (Rp) <span>*</span>
                                </label>

                                <div class="price-input">
                                    <input type="number"
                                           name="sizes[{{ $index }}][price]"
                                           class="form-control"
                                           value="{{ $size['price'] ?? '' }}"
                                           min="0"
                                           placeholder="15000"
                                           required>
                                </div>
                            </div>

                            {{-- STOK --}}
                            <div class="col-md-2">
                                <label class="form-label">
                                    Stok <span>*</span>
                                </label>

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

            <div class="form-note">
                <i class="bi bi-lightbulb-fill"></i>

                <div>
                    <strong>Petunjuk pengisian</strong>

                    <p>
                        Nama ukuran, satuan, harga, dan stok wajib diisi.
                        Jumlah isi boleh dikosongkan jika tidak diperlukan.
                    </p>
                </div>
            </div>

        </div>

        {{-- TOMBOL SIMPAN --}}
        <div class="form-footer">

            <a href="{{ route('admin.produk.index') }}"
               class="btn-cancel">
                <i class="bi bi-x-lg"></i>
                Batal
            </a>

            <button type="submit" class="btn-save">
                <i class="bi bi-check2-circle"></i>
                Simpan Produk
            </button>

        </div>

    </form>

    {{-- FOOTER --}}
    <div class="create-footer">
        <span>🥟</span>
        Ranatavan Dimsum
        <span class="footer-dot">·</span>
        Form Tambah Produk
    </div>

</div>

@endsection


@push('styles')
<style>

/* ======================================
   CREATE PRODUCT - MODERN ORANGE & WHITE
====================================== */

.create-page {
    min-height: 100vh;
    background: #fffaf6;
    padding: 30px;
}

/* HEADER */

.page-header {
    position: relative;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    padding: 28px 30px;
    margin-bottom: 25px;
    background: linear-gradient(115deg, #ffffff 55%, #fff0e3);
    border: 1px solid #f7e4d4;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(112, 69, 44, .04);
}

.page-header::after {
    content: "🥟";
    position: absolute;
    right: 100px;
    bottom: -35px;
    font-size: 115px;
    opacity: .07;
    transform: rotate(-15deg);
    pointer-events: none;
}

.header-content {
    position: relative;
    z-index: 1;
}

.header-label {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    color: #ed7628;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 2px;
}

.page-header h2 {
    color: #713d25;
    font-size: 28px;
    font-weight: 800;
    margin: 9px 0 7px;
}

.page-header p {
    color: #9b887b;
    font-size: 13px;
    margin: 0;
    max-width: 600px;
}

.btn-back {
    position: relative;
    z-index: 2;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 18px;
    background: #ffffff;
    color: #75472e;
    border: 1px solid #ead8ca;
    border-radius: 11px;
    text-decoration: none;
    font-size: 12px;
    font-weight: 700;
    white-space: nowrap;
    transition: .25s ease;
}

.btn-back:hover {
    background: #fff0e4;
    color: #d95d16;
    border-color: #f5bd91;
    transform: translateY(-2px);
}

/* ALERT */

.custom-alert {
    padding: 16px 19px;
    border: none;
    border-radius: 12px;
    font-size: 12px;
    box-shadow: 0 3px 12px rgba(0, 0, 0, .035);
}

/* FORM CARD */

.form-card {
    padding: 27px;
    background: #ffffff;
    border: 1px solid #f0e4da;
    border-radius: 18px;
    box-shadow: 0 5px 20px rgba(112, 69, 44, .045);
}

/* CARD HEADING */

.card-heading {
    display: flex;
    align-items: center;
    gap: 13px;
    margin-bottom: 27px;
}

.heading-icon {
    width: 47px;
    height: 47px;
    min-width: 47px;
    display: grid;
    place-items: center;
    border-radius: 14px;
    font-size: 21px;
}

.heading-icon.orange {
    color: #ed7628;
    background: #fff0e3;
}

.heading-icon.peach {
    color: #d77c37;
    background: #fff4e6;
}

.card-heading h5 {
    color: #713d25;
    font-size: 16px;
    font-weight: 800;
    margin: 0 0 5px;
}

.card-heading p {
    color: #a09287;
    font-size: 11px;
    margin: 0;
}

/* INPUT */

.form-label {
    display: block;
    color: #765744;
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 9px;
}

.form-label span {
    color: #e65f4d;
}

.form-control,
.form-select {
    min-height: 44px;
    padding: 11px 13px;
    border: 1px solid #eaded4;
    border-radius: 10px;
    background-color: #ffffff;
    color: #654b3b;
    font-size: 12px;
    transition: .2s ease;
}

.form-control::placeholder {
    color: #c0b2a7;
}

.form-control:focus,
.form-select:focus {
    border-color: #f07828;
    box-shadow: 0 0 0 3px rgba(240, 120, 40, .12);
}

.input-icon-wrapper {
    position: relative;
}

.input-icon-wrapper > i {
    position: absolute;
    top: 50%;
    left: 13px;
    z-index: 2;
    color: #e98742;
    transform: translateY(-50%);
    pointer-events: none;
}

.input-icon-wrapper .form-select {
    padding-left: 39px;
}

.description-input {
    min-height: 105px;
    resize: vertical;
    line-height: 1.7;
}

.field-help {
    display: block;
    margin-top: 7px;
    color: #a9998d;
    font-size: 10px;
}

/* SIZE HEADER */

.size-section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    flex-wrap: wrap;
    margin-bottom: 22px;
}

.size-section-header .card-heading {
    margin-bottom: 0;
}

.btn-add-size {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    padding: 11px 16px;
    border: none;
    border-radius: 10px;
    background: linear-gradient(135deg, #f07828, #e85f18);
    color: #ffffff;
    font-size: 11px;
    font-weight: 800;
    box-shadow: 0 4px 12px rgba(240, 120, 40, .17);
    transition: .25s ease;
}

.btn-add-size:hover {
    background: linear-gradient(135deg, #e96820, #d95112);
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(240, 120, 40, .25);
}

/* SIZE INFORMATION */

.size-information {
    display: flex;
    align-items: flex-start;
    gap: 9px;
    padding: 12px 15px;
    margin-bottom: 20px;
    background: #fff5e9;
    border: 1px solid #f8e6d2;
    border-radius: 10px;
    color: #a46d40;
    font-size: 11px;
    line-height: 1.6;
}

.size-information i {
    color: #ed7628;
    font-size: 14px;
    margin-top: 1px;
}

/* SIZE ITEM */

.size-item {
    padding: 21px;
    margin-bottom: 16px;
    background: #fffaf6;
    border: 1px solid #f1e3d8;
    border-radius: 14px;
    transition: .2s ease;
}

.size-item:hover {
    border-color: #f4c9aa;
    box-shadow: 0 4px 13px rgba(112, 69, 44, .04);
}

.size-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    margin-bottom: 19px;
    padding-bottom: 13px;
    border-bottom: 1px solid #f0e5dc;
}

.size-title {
    display: flex;
    align-items: center;
    gap: 10px;
}

.size-title strong {
    color: #713d25;
    font-size: 12px;
    font-weight: 800;
}

.size-number {
    width: 28px;
    height: 28px;
    display: grid;
    place-items: center;
    border-radius: 9px;
    background: #fff0e3;
    color: #e56c21;
    font-size: 12px;
    font-weight: 800;
}

.btn-remove-size {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 11px;
    border: none;
    border-radius: 8px;
    background: #fff0ed;
    color: #b95345;
    font-size: 10px;
    font-weight: 800;
    transition: .2s ease;
}

.btn-remove-size:hover {
    background: #d65b4c;
    color: #ffffff;
}

/* FORM NOTE */

.form-note {
    display: flex;
    align-items: flex-start;
    gap: 11px;
    padding: 14px 16px;
    margin-top: 20px;
    background: #f8faf4;
    border: 1px solid #e9efdf;
    border-radius: 11px;
}

.form-note > i {
    color: #829653;
    font-size: 17px;
    margin-top: 1px;
}

.form-note strong {
    display: block;
    color: #627b43;
    font-size: 11px;
    margin-bottom: 4px;
}

.form-note p {
    color: #8b9b76;
    font-size: 10px;
    margin: 0;
    line-height: 1.6;
}

/* FOOTER BUTTONS */

.form-footer {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 12px;
    padding: 3px 0 15px;
}

.btn-cancel,
.btn-save {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 13px 23px;
    border-radius: 10px;
    font-size: 12px;
    font-weight: 800;
    text-decoration: none;
    transition: .25s ease;
    cursor: pointer;
}

.btn-cancel {
    color: #75472e;
    background: #ffffff;
    border: 1px solid #ead8ca;
}

.btn-cancel:hover {
    color: #d95d16;
    background: #fff0e4;
    border-color: #f5bd91;
}

.btn-save {
    color: #ffffff;
    background: linear-gradient(135deg, #f07828, #e85f18);
    border: 1px solid #e96820;
    box-shadow: 0 5px 13px rgba(240, 120, 40, .18);
}

.btn-save:hover {
    color: #ffffff;
    background: linear-gradient(135deg, #e96820, #d95112);
    transform: translateY(-2px);
    box-shadow: 0 7px 16px rgba(240, 120, 40, .26);
}

/* FOOTER */

.create-footer {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 7px;
    padding: 22px 0 5px;
    color: #a9998d;
    font-size: 11px;
}

.create-footer > span:first-child {
    font-size: 17px;
}

.footer-dot {
    color: #ed7628;
    font-weight: 800;
}

/* RESPONSIVE */

@media(max-width: 992px) {
    .create-page {
        padding: 22px;
    }

    .form-card {
        padding: 23px;
    }
}

@media(max-width: 767px) {
    .create-page {
        padding: 18px 13px;
    }

    .page-header {
        flex-direction: column;
        align-items: flex-start;
        padding: 23px 20px;
    }

    .page-header h2 {
        font-size: 23px;
    }

    .page-header::after {
        right: 5px;
        font-size: 80px;
    }

    .btn-back {
        width: 100%;
    }

    .form-card {
        padding: 19px;
    }

    .size-section-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .btn-add-size {
        width: 100%;
    }

    .size-item {
        padding: 15px;
    }

    .form-footer {
        flex-direction: column-reverse;
        align-items: stretch;
    }

    .btn-cancel,
    .btn-save {
        width: 100%;
    }
}

@media(max-width: 420px) {
    .card-heading h5 {
        font-size: 14px;
    }

    .card-heading p {
        font-size: 10px;
    }

    .size-header {
        align-items: flex-start;
    }
}

</style>
@endpush


@push('scripts')
<script>

// ======================================
// KATEGORI DAN VARIAN
// ======================================

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

    variantSelect.innerHTML = '';

    if (!category) {
        variantSelect.innerHTML =
            '<option value="">-- Pilih Kategori Dahulu --</option>';
        return;
    }

    variantSelect.innerHTML =
        '<option value="">-- Pilih Varian --</option>';

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
        variantSelect.innerHTML =
            '<option value="">Belum ada varian</option>';
    }

}

categorySelect.addEventListener('change', function () {
    updateVariants();
});

// Mengembalikan pilihan lama ketika validasi gagal
updateVariants(@json(old('variant_id', '')));


// ======================================
// TAMBAH UKURAN PRODUK
// ======================================

let sizeIndex = {{ count($oldSizes) }};

document.getElementById('addSize').addEventListener('click', function () {

    const container = document.getElementById('sizeContainer');

    const html = `
        <div class="size-item">

            <div class="size-header">

                <div class="size-title">
                    <span class="size-number"></span>
                    <strong>Detail Ukuran Produk</strong>
                </div>

                <button type="button"
                        class="btn-remove-size"
                        onclick="removeSize(this)">

                    <i class="bi bi-trash3"></i>
                    Hapus
                </button>

            </div>

            <div class="row g-3">

                <div class="col-md-4">
                    <label class="form-label">
                        Nama Ukuran <span>*</span>
                    </label>

                    <input type="text"
                           name="sizes[${sizeIndex}][name]"
                           class="form-control"
                           placeholder="Contoh: Small, Medium, Large"
                           required>
                </div>

                <div class="col-md-2">
                    <label class="form-label">
                        Satuan <span>*</span>
                    </label>

                    <input type="text"
                           name="sizes[${sizeIndex}][unit]"
                           class="form-control"
                           value="pcs"
                           placeholder="pcs"
                           required>
                </div>

                <div class="col-md-2">
                    <label class="form-label">
                        Jumlah Isi
                    </label>

                    <input type="number"
                           name="sizes[${sizeIndex}][piece_count]"
                           class="form-control"
                           min="1"
                           placeholder="Contoh: 5">
                </div>

                <div class="col-md-2">
                    <label class="form-label">
                        Harga (Rp) <span>*</span>
                    </label>

                    <input type="number"
                           name="sizes[${sizeIndex}][price]"
                           class="form-control"
                           min="0"
                           placeholder="15000"
                           required>
                </div>

                <div class="col-md-2">
                    <label class="form-label">
                        Stok <span>*</span>
                    </label>

                    <input type="number"
                           name="sizes[${sizeIndex}][stock]"
                           class="form-control"
                           min="0"
                           placeholder="20"
                           required>
                </div>

            </div>

        </div>
    `;

    container.insertAdjacentHTML('beforeend', html);

    sizeIndex++;

    updateSizeNumbers();

});


// ======================================
// HAPUS UKURAN PRODUK
// ======================================

function removeSize(button) {

    const items = document.querySelectorAll('.size-item');

    if (items.length <= 1) {
        alert('Minimal harus ada satu ukuran produk.');
        return;
    }

    button.closest('.size-item').remove();

    updateSizeNumbers();

}


// ======================================
// NOMOR URUT UKURAN OTOMATIS
// ======================================

function updateSizeNumbers() {

    document.querySelectorAll('.size-item').forEach((item, index) => {

        const number = item.querySelector('.size-number');

        if (number) {
            number.textContent = index + 1;
        }

    });

}

updateSizeNumbers();

</script>
@endpush
