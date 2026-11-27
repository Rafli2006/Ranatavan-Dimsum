@extends('layouts.master')

@section('title', 'Transaksi Baru')

@section('content')

<div class="transaction-page">

    <div class="transaction-header">
        <div>
            <span class="header-label">KASIR RANATAVAN DIMSUM</span>
            <h2>Transaksi Baru</h2>
            <p>Pilih produk dan mulai transaksi penjualan.</p>
        </div>

        <a href="{{ route('kasir.dashboard') }}" class="back-button">
            <i class="bi bi-arrow-left"></i> Dashboard
        </a>
    </div>

    <div class="row g-4">

        {{-- DAFTAR PRODUK --}}
        <div class="col-lg-8">
            <div class="transaction-panel">

                <div class="panel-heading">
                    <h5>🥟 Pilih Produk</h5>
                    <span>{{ $products->count() }} Produk</span>
                </div>

                <div class="row g-3">

                    @php
                        $folderPublik = public_path('images/products');
                        $daftarFile = [];
                        if (is_dir($folderPublik)) {
                            foreach (scandir($folderPublik) ?: [] as $namaFile) {
                                if ($namaFile !== '.' && $namaFile !== '..' && is_file($folderPublik . DIRECTORY_SEPARATOR . $namaFile)) {
                                    $daftarFile[] = $namaFile;
                                }
                            }
                        }

                        // Normalisasi spasi ganda / spasi sebelum ekstensi agar file seperti "isi 3 .jpeg" tetap cocok
                        $normalisasi = function (string $teks): string {
                            $teks = strtolower($teks);
                            $teks = preg_replace('/\s*\./', '.', $teks) ?? $teks;
                            $teks = preg_replace('/\s+/', ' ', $teks) ?? $teks;
                            return trim($teks);
                        };

                        $cariFile = function (array $wajib, array $hindari = []) use ($daftarFile, $normalisasi): ?array {
                            foreach ($daftarFile as $file) {
                                $low = $normalisasi($file);
                                foreach ($wajib as $w) {
                                    $wNorm = $normalisasi($w);
                                    if ($wNorm !== '' && !str_contains($low, $wNorm)) {
                                        continue 2;
                                    }
                                }
                                foreach ($hindari as $h) {
                                    $hNorm = $normalisasi($h);
                                    if ($hNorm !== '' && str_contains($low, $hNorm)) {
                                        continue 2;
                                    }
                                }
                                return [
                                    'filename' => $file,
                                    'url' => asset('images/products/' . rawurlencode($file)),
                                ];
                            }
                            return null;
                        };
                    @endphp

                    @forelse($products as $product)
                        @foreach($product->sizes->where('is_active', true) as $size)
                            @php
                                $namaProduk = $normalisasi($product->name ?? '');
                                $namaVarian = $normalisasi($product->variant->name ?? '');
                                $namaSize = $normalisasi($size->name ?? '');
                                $pcsAngka = (int) ($size->piece_count ?? 0);
                                $gabungan = trim($namaProduk . ' ' . $namaVarian . ' ' . $namaSize . ' ' . ($pcsAngka > 0 ? $pcsAngka : ''));

                                $isEnam = str_contains($gabungan, '6')
                                    || str_contains($gabungan, 'besar')
                                    || str_contains($gabungan, 'large');

                                $angkaTarget = $isEnam ? '6' : '3';
                                $angkaLain = $isEnam ? '3' : '6';

                                $hasilFile = null;

                                if (str_contains($gabungan, 'bakar') && str_contains($gabungan, 'mentai')) {
                                    $hasilFile = $cariFile(['bakar', 'mentai']);
                                } elseif (str_contains($gabungan, 'bakar')) {
                                    $hasilFile = $cariFile(['bakar'], ['mentai']);
                                } elseif (str_contains($gabungan, 'goreng') && str_contains($gabungan, 'mentai')) {
                                    $hasilFile = $cariFile(['goreng', 'mentai', 'isi ' . $angkaTarget], [$angkaLain])
                                        ?? $cariFile(['goreng', 'mentai', $angkaTarget], [$angkaLain])
                                        ?? $cariFile(['goreng', 'mentai']);
                                } elseif (str_contains($gabungan, 'goreng')) {
                                    $hasilFile = $cariFile(['goreng', 'isi ' . $angkaTarget], ['mentai', $angkaLain])
                                        ?? $cariFile(['goreng', $angkaTarget], ['mentai', $angkaLain])
                                        ?? $cariFile(['goreng'], ['mentai']);
                                } elseif (str_contains($gabungan, 'mentai')) {
                                    $hasilFile = $cariFile(['mentai', 'isi ' . $angkaTarget], ['goreng', 'bakar', $angkaLain])
                                        ?? $cariFile(['mentai', $angkaTarget], ['goreng', 'bakar', $angkaLain]);
                                } elseif (str_contains($gabungan, 'ori')) {
                                    $hasilFile = $cariFile(['ori', 'isi ' . $angkaTarget], ['goreng', 'bakar', $angkaLain])
                                        ?? $cariFile(['ori', $angkaTarget], ['goreng', 'bakar', $angkaLain]);
                                }

                                $urlGambarTampil = $hasilFile['url']
                                    ?? ($product->image ? asset('storage/' . $product->image) : null);

                                $hargaSatuan = (float) ($size->price ?? 0);
                                $stokAngka = (int) ($size->stock ?? 0);
                                $estimasiPerPcs = $pcsAngka > 0 ? (int) round($hargaSatuan / $pcsAngka) : null;
                                $nilaiStok = (int) round($hargaSatuan * $stokAngka);

                                if (str_contains($gabungan, 'bakar')) {
                                    $metodeMasak = 'Dipanggang / Dibakar';
                                    $saranPenyajian = 'Disajikan hangat langsung setelah dibakar agar aroma smoky keluar maksimal.';
                                } elseif (str_contains($gabungan, 'goreng')) {
                                    $metodeMasak = 'Digoreng Crispy';
                                    $saranPenyajian = 'Nikmat disantap selagi hangat dengan tekstur luar renyah dan isian lembut.';
                                } else {
                                    $metodeMasak = 'Dikukus Lembut';
                                    $saranPenyajian = 'Dikukus fresh sehingga tekstur daging dan kulit tetap lembut dan juicy.';
                                }

                                if (str_contains($gabungan, 'mentai')) {
                                    $profilRasa = 'Gurih creamy saus mentai dengan sentuhan savory & sedikit pedas.';
                                } else {
                                    $profilRasa = 'Original gurih seimbang khas dimsum yang cocok dipadukan dengan saus.';
                                }

                                $deskripsiDb = trim((string) ($product->description ?? $product->deskripsi ?? ''));
                            @endphp

                            <div class="col-md-6 col-xl-4">

                                <div class="product-card">

                                    <div class="product-image">
                                        @if($urlGambarTampil)
                                            <img src="{{ $urlGambarTampil }}"
                                                 alt="{{ $product->name }}">
                                        @else
                                            <span>🥟</span>
                                        @endif
                                    </div>

                                    <div class="product-info">
                                        <h6>{{ $product->name }}</h6>

                                        <div class="size-info">
                                            {{ $size->name }}
                                            @if($pcsAngka > 0)
                                                · {{ $pcsAngka }} pcs
                                            @endif
                                        </div>

                                        <strong>
                                            Rp {{ number_format($hargaSatuan, 0, ',', '.') }}
                                        </strong>

                                        <small>
                                            Stok: {{ $stokAngka }}
                                        </small>

                                        <button
                                            type="button"
                                            class="add-product"
                                            data-id="{{ $size->id }}"
                                            data-product="{{ $product->name }}"
                                            data-category="{{ $product->category->name ?? 'Dimsum' }}"
                                            data-variant="{{ $product->variant->name ?? '-' }}"
                                            data-size="{{ $size->name }}"
                                            data-pcs="{{ $pcsAngka > 0 ? $pcsAngka : 0 }}"
                                            data-price="{{ $hargaSatuan }}"
                                            data-per-pcs="{{ $estimasiPerPcs ?? 0 }}"
                                            data-stock="{{ $stokAngka }}"
                                            data-stock-value="{{ $nilaiStok }}"
                                            data-cooking="{{ $metodeMasak }}"
                                            data-flavor="{{ $profilRasa }}"
                                            data-serving="{{ $saranPenyajian }}"
                                            data-image="{{ $urlGambarTampil ?? '' }}"
                                            data-description="{{ $deskripsiDb }}"
                                            {{ $stokAngka < 1 ? 'disabled' : '' }}
                                        >
                                            <i class="bi bi-plus-lg"></i>
                                            Tambahkan
                                        </button>
                                    </div>

                                </div>

                            </div>

                        @endforeach
                    @empty
                        <div class="col-12">
                            <div class="empty-product">
                                Belum ada produk yang tersedia.
                            </div>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>

        {{-- KERANJANG --}}
        <div class="col-lg-4">
            <div class="cart-panel">

                <div class="panel-heading">
                    <h5><i class="bi bi-cart3"></i> Keranjang</h5>
                    <span id="cart-count">0 item</span>
                </div>

                <div id="cart-items">
                    <div class="empty-cart">
                        <i class="bi bi-basket"></i>
                        <p>Keranjang masih kosong</p>
                        <small>Silakan pilih produk terlebih dahulu.</small>
                    </div>
                </div>

                <div class="cart-summary">
                    <div class="summary-row">
                        <span>Total Item</span>
                        <strong id="total-items">0</strong>
                    </div>

                    <div class="summary-row total-row">
                        <span>Total Belanja</span>
                        <strong id="grand-total">Rp 0</strong>
                    </div>

                    <button type="button" id="checkout-button" disabled>
                        Lanjut Pembayaran
                        <i class="bi bi-arrow-right"></i>
                    </button>

                    <button type="button" id="clear-cart">
                        Kosongkan Keranjang
                    </button>
                </div>

            </div>
        </div>

    </div>

</div>

{{-- MODAL DETAIL SAAT MENCET TAMBAHKAN --}}
<div id="product-detail-modal" class="product-modal-backdrop" aria-hidden="true">
    <div class="product-modal-card" role="dialog" aria-modal="true" aria-labelledby="detail-modal-title">
        <div class="product-modal-header">
            <div>
                <span class="header-label">DETAIL PRODUK</span>
                <h5 id="detail-modal-title">Nama Produk</h5>
                <div id="detail-subtitle" class="detail-subtitle">-</div>
            </div>
            <button type="button" id="close-detail-modal" class="close-modal-btn" aria-label="Tutup">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <div class="product-modal-body">
            <div id="detail-modal-media" class="detail-modal-media">
                <span>🥟</span>
            </div>

            <div class="detail-section">
                <div class="detail-section-title">Analisis Porsi & Stok</div>
                <div class="detail-stats-grid">
                    <div class="detail-stat-box">
                        <span>Harga Satuan</span>
                        <strong id="detail-price-text">Rp 0</strong>
                    </div>
                    <div class="detail-stat-box">
                        <span>Estimasi / Pcs</span>
                        <strong id="detail-per-pcs">-</strong>
                    </div>
                    <div class="detail-stat-box">
                        <span>Stok Tersedia</span>
                        <strong id="detail-stock-text">0</strong>
                    </div>
                    <div class="detail-stat-box">
                        <span>Total Nilai Stok</span>
                        <strong id="detail-stock-value">Rp 0</strong>
                    </div>
                </div>
            </div>

            <div class="detail-section">
                <div class="detail-section-title">Karakteristik & Penyajian</div>
                <div class="detail-list-card">
                    <div class="detail-list-row">
                        <span>Metode Olahan</span>
                        <strong id="detail-cooking">-</strong>
                    </div>
                    <div class="detail-list-row">
                        <span>Profil Rasa</span>
                        <strong id="detail-flavor">-</strong>
                    </div>
                    <div class="detail-list-row">
                        <span>Saran Penyajian</span>
                        <strong id="detail-serving">-</strong>
                    </div>
                </div>
            </div>

            <div id="detail-db-desc-wrap" class="detail-section" style="display:none;">
                <div class="detail-section-title">Catatan Produk</div>
                <div class="detail-note-box">
                    <p id="detail-db-desc">-</p>
                </div>
            </div>
        </div>

        <div class="product-modal-footer">
            <button type="button" id="back-to-products-btn" class="secondary-modal-btn">
                <i class="bi bi-arrow-left"></i>
                Kembali ke Pilihan Produk
            </button>
            <button type="button" id="detail-add-to-cart" class="primary-modal-btn">
                <i class="bi bi-plus-lg"></i>
                Tambahkan
            </button>
        </div>
    </div>
</div>

<style>
.transaction-page {
    padding: 25px;
    background: #fffaf5;
    min-height: 100vh;
    color: #573923;
}

.transaction-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.header-label {
    color: #e97927;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1.5px;
}

.transaction-header h2 {
    font-weight: 800;
    margin: 7px 0;
}

.transaction-header p {
    color: #a08d7e;
    font-size: 13px;
}

.back-button {
    padding: 10px 15px;
    background: white;
    border: 1px solid #f2dfcf;
    border-radius: 10px;
    color: #75452b;
    text-decoration: none;
}

.transaction-panel,
.cart-panel {
    background: white;
    border: 1px solid #f1e5da;
    border-radius: 17px;
    padding: 20px;
    box-shadow: 0 5px 20px rgba(90,50,20,.04);
}

.panel-heading {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.panel-heading h5 {
    font-size: 16px;
    font-weight: 800;
    margin: 0;
}

.panel-heading span {
    font-size: 11px;
    color: #e97927;
    font-weight: 700;
}

.product-card {
    height: 100%;
    overflow: hidden;
    border: 1px solid #f0e5db;
    border-radius: 13px;
    transition: .2s;
}

.product-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(100,50,20,.09);
}

.product-image {
    height: 135px;
    background: #fff0e2;
    display: grid;
    place-items: center;
    overflow: hidden;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    mix-blend-mode: multiply;
}

.product-image span {
    font-size: 45px;
}

.product-info {
    padding: 13px;
}

.product-info h6 {
    font-size: 13px;
    font-weight: 800;
    margin-bottom: 5px;
}

.size-info {
    font-size: 10px;
    color: #9b6b47;
    margin-bottom: 6px;
}

.product-info strong {
    display: block;
    color: #e96d1d;
    font-size: 14px;
}

.product-info small {
    display: block;
    color: #8c9a79;
    margin-top: 5px;
}

.add-product {
    width: 100%;
    padding: 9px;
    border: none;
    border-radius: 8px;
    background: #fff0e3;
    color: #e56d20;
    font-size: 11px;
    font-weight: 800;
    margin-top: 12px;
    cursor: pointer;
}

.add-product:hover:not(:disabled) {
    background: #ed792a;
    color: white;
}

.add-product:disabled {
    opacity: .5;
    cursor: not-allowed;
}

.cart-panel {
    position: sticky;
    top: 20px;
}

.empty-cart,
.empty-product {
    text-align: center;
    padding: 35px 10px;
    color: #aa9888;
}

.empty-cart i {
    font-size: 40px;
    color: #e9a36f;
}

.empty-cart p {
    font-weight: 800;
    margin: 12px 0 4px;
    color: #755039;
}

.empty-cart small {
    font-size: 10px;
}

.cart-item {
    padding: 12px 0;
    border-bottom: 1px solid #f2e9e0;
}

.cart-item strong {
    display: block;
    font-size: 12px;
}

.cart-item small {
    color: #a08d7e;
    font-size: 10px;
}

.cart-item-controls {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 9px;
}

.quantity-controls {
    display: flex;
    align-items: center;
    gap: 10px;
}

.quantity-controls button {
    border: none;
    background: #fff0e3;
    color: #df6b20;
    border-radius: 6px;
    width: 25px;
    height: 25px;
}

.remove-item {
    color: #dc5b45;
    border: none;
    background: none;
}

.cart-summary {
    border-top: 1px solid #f1e5da;
    padding-top: 18px;
    margin-top: 15px;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    font-size: 12px;
    margin-bottom: 13px;
}

.total-row {
    font-size: 14px;
    font-weight: 800;
    color: #df6c1e;
}

#checkout-button,
#clear-cart {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 9px;
    font-size: 12px;
    font-weight: 800;
}

#checkout-button {
    background: #ed792a;
    color: white;
}

#checkout-button:disabled {
    opacity: .45;
    cursor: not-allowed;
}

#clear-cart {
    background: #fff0e3;
    color: #d56b2c;
    margin-top: 9px;
}

/* Modal Detail Produk */
.product-modal-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(45, 25, 10, 0.5);
    display: none;
    align-items: center;
    justify-content: center;
    padding: 16px;
    z-index: 1050;
}

.product-modal-backdrop.is-open {
    display: flex;
}

.product-modal-card {
    width: 100%;
    max-width: 540px;
    max-height: 90vh;
    overflow-y: auto;
    background: #ffffff;
    border: 1px solid #f1e5da;
    border-radius: 18px;
    box-shadow: 0 18px 40px rgba(60, 30, 10, 0.22);
    color: #573923;
}

.product-modal-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 18px 20px;
    border-bottom: 1px solid #f3e8de;
}

.product-modal-header h5 {
    margin: 4px 0 3px;
    font-size: 17px;
    font-weight: 800;
}

.detail-subtitle {
    font-size: 11px;
    color: #9b6b47;
    font-weight: 600;
}

.close-modal-btn {
    width: 34px;
    height: 34px;
    border: 1px solid #f0dfd0;
    border-radius: 9px;
    background: #fff8f2;
    color: #75452b;
    display: grid;
    place-items: center;
    cursor: pointer;
}

.product-modal-body {
    padding: 18px 20px;
}

.detail-modal-media {
    min-height: 220px;
    padding: 14px;
    border-radius: 13px;
    background: #fff0e2;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    margin-bottom: 16px;
}

.detail-modal-media img {
    max-width: 100% !important;
    max-height: 235px !important;
    width: auto !important;
    height: auto !important;
    object-fit: contain !important;
    display: block;
    mix-blend-mode: multiply;
}

.detail-modal-media span {
    font-size: 56px;
}

.detail-section {
    margin-bottom: 14px;
}

.detail-section:last-child {
    margin-bottom: 0;
}

.detail-section-title {
    font-size: 11px;
    font-weight: 800;
    color: #e97927;
    text-transform: uppercase;
    letter-spacing: .6px;
    margin-bottom: 8px;
}

.detail-stats-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 10px;
}

.detail-stat-box {
    background: #fffaf5;
    border: 1px solid #f3e7dc;
    border-radius: 10px;
    padding: 10px 12px;
}

.detail-stat-box span {
    display: block;
    font-size: 10px;
    color: #9f8b7b;
    margin-bottom: 3px;
}

.detail-stat-box strong {
    font-size: 13px;
    font-weight: 800;
    color: #573923;
}

.detail-list-card {
    background: #fffaf5;
    border: 1px solid #f3e7dc;
    border-radius: 11px;
    padding: 4px 12px;
}

.detail-list-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 12px;
    padding: 9px 0;
    border-bottom: 1px dashed #eddcc9;
    font-size: 12px;
}

.detail-list-row:last-child {
    border-bottom: none;
}

.detail-list-row span {
    color: #968171;
    flex-shrink: 0;
}

.detail-list-row strong {
    text-align: right;
    color: #573923;
    font-weight: 700;
}

.detail-note-box {
    background: #fff7ef;
    border: 1px solid #f0dfd0;
    border-radius: 10px;
    padding: 10px 12px;
}

.detail-note-box p {
    margin: 0;
    font-size: 12px;
    line-height: 1.5;
}

.product-modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    padding: 14px 20px 18px;
    border-top: 1px solid #f3e8de;
}

.secondary-modal-btn,
.primary-modal-btn {
    padding: 10px 15px;
    border-radius: 9px;
    font-size: 12px;
    font-weight: 800;
    cursor: pointer;
}

.secondary-modal-btn {
    background: #fff5ec;
    border: 1px solid #edd9c8;
    color: #75452b;
}

.primary-modal-btn {
    background: #ed792a;
    border: none;
    color: #ffffff;
}

.primary-modal-btn:disabled {
    opacity: .45;
    cursor: not-allowed;
}

@media(max-width: 768px) {
    .transaction-page {
        padding: 15px;
    }

    .transaction-header {
        align-items: flex-start;
        gap: 10px;
    }

    .cart-panel {
        position: static;
    }

    .detail-stats-grid {
        grid-template-columns: 1fr;
    }

    .detail-list-row {
        flex-direction: column;
        gap: 3px;
    }

    .detail-list-row strong {
        text-align: left;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const cart = {};
    let selectedProductItem = null;

    const rupiah = number =>
        'Rp ' + Number(number).toLocaleString('id-ID');

    const cartItems = document.getElementById('cart-items');
    const detailModal = document.getElementById('product-detail-modal');
    const detailMedia = document.getElementById('detail-modal-media');
    const detailAddButton = document.getElementById('detail-add-to-cart');

    function renderCart() {

        const items = Object.values(cart);

        const totalQuantity = items.reduce(
            (sum, item) => sum + item.quantity, 0
        );

        const totalPrice = items.reduce(
            (sum, item) => sum + item.price * item.quantity, 0
        );

        document.getElementById('cart-count').textContent =
            totalQuantity + ' item';

        document.getElementById('total-items').textContent =
            totalQuantity;

        document.getElementById('grand-total').textContent =
            rupiah(totalPrice);

        document.getElementById('checkout-button').disabled =
            items.length === 0;

        if (items.length === 0) {
            cartItems.innerHTML = `
                <div class="empty-cart">
                    <i class="bi bi-basket"></i>
                    <p>Keranjang masih kosong</p>
                    <small>Silakan pilih produk terlebih dahulu.</small>
                </div>
            `;
            return;
        }

        cartItems.innerHTML = items.map(item => `
            <div class="cart-item">
                <strong>${escapeHtml(item.name)}</strong>
                <small>${escapeHtml(item.size)} · ${rupiah(item.price)}</small>

                <div class="cart-item-controls">
                    <div class="quantity-controls">
                        <button type="button" data-action="minus" data-id="${item.id}">−</button>
                        <strong>${item.quantity}</strong>
                        <button type="button" data-action="plus" data-id="${item.id}">+</button>
                    </div>

                    <strong>${rupiah(item.price * item.quantity)}</strong>

                    <button class="remove-item" type="button"
                        data-action="remove" data-id="${item.id}">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        `).join('');
    }

    function escapeHtml(value) {
        return String(value).replace(/[&<>"']/g, char => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        })[char]);
    }

    function addToCart(payload) {
        const id = String(payload.id);
        const stock = Number(payload.stock);

        if (!cart[id]) {
            cart[id] = {
                id: id,
                name: payload.product,
                size: payload.size,
                price: Number(payload.price),
                stock: stock,
                quantity: 0
            };
        }

        if (cart[id].quantity >= stock) {
            alert('Jumlah melebihi stok yang tersedia.');
            return false;
        }

        cart[id].quantity++;
        renderCart();
        return true;
    }

    function openDetailAndAddModal(buttonEl) {
        const dataset = buttonEl.dataset;
        const cardImg = buttonEl.closest('.product-card')?.querySelector('.product-image img');
        const resolvedImageUrl = (cardImg && cardImg.getAttribute('src'))
            ? cardImg.getAttribute('src')
            : (dataset.image || '');

        selectedProductItem = {
            id: dataset.id,
            product: dataset.product,
            size: dataset.size,
            price: Number(dataset.price),
            stock: Number(dataset.stock)
        };

        const pcsNum = Number(dataset.pcs || 0);
        const perPcsNum = Number(dataset.perPcs || 0);
        const stockNum = Number(dataset.stock || 0);
        const stockValueNum = Number(dataset.stockValue || 0);

        document.getElementById('detail-modal-title').textContent = dataset.product || 'Detail Produk';
        document.getElementById('detail-subtitle').textContent =
            `${dataset.category || 'Dimsum'} · Varian ${dataset.variant || '-'} · ${dataset.size || '-'}${pcsNum > 0 ? ' (' + pcsNum + ' pcs)' : ''}`;

        document.getElementById('detail-price-text').textContent = rupiah(dataset.price || 0);
        document.getElementById('detail-per-pcs').textContent =
            perPcsNum > 0 ? `~${rupiah(perPcsNum)}` : 'Per porsi';
        document.getElementById('detail-stock-text').textContent =
            stockNum > 0 ? `${stockNum} pcs/porsi` : 'Habis (0)';
        document.getElementById('detail-stock-value').textContent = rupiah(stockValueNum);

        document.getElementById('detail-cooking').textContent = dataset.cooking || '-';
        document.getElementById('detail-flavor').textContent = dataset.flavor || '-';
        document.getElementById('detail-serving').textContent = dataset.serving || '-';

        const descWrap = document.getElementById('detail-db-desc-wrap');
        const descText = document.getElementById('detail-db-desc');
        if (dataset.description && dataset.description.trim() !== '') {
            descText.textContent = dataset.description.trim();
            descWrap.style.display = 'block';
        } else {
            descWrap.style.display = 'none';
        }

        if (resolvedImageUrl) {
            detailMedia.innerHTML = `<img src="${escapeHtml(resolvedImageUrl)}" alt="${escapeHtml(dataset.product || '')}">`;
        } else {
            detailMedia.innerHTML = `<span>🥟</span>`;
        }

        detailAddButton.disabled = stockNum < 1;
        detailModal.classList.add('is-open');
        detailModal.setAttribute('aria-hidden', 'false');
    }

    function backToProductList() {
        detailModal.classList.remove('is-open');
        detailModal.setAttribute('aria-hidden', 'true');
        selectedProductItem = null;
    }

    document.querySelectorAll('.add-product').forEach(button => {
        button.addEventListener('click', function () {
            openDetailAndAddModal(this);
        });
    });

    detailAddButton.addEventListener('click', function () {
        if (!selectedProductItem) return;
        const added = addToCart(selectedProductItem);
        if (added) {
            backToProductList();
        }
    });

    document.getElementById('back-to-products-btn').addEventListener('click', backToProductList);
    document.getElementById('close-detail-modal').addEventListener('click', backToProductList);

    detailModal.addEventListener('click', function (event) {
        if (event.target === detailModal) {
            backToProductList();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && detailModal.classList.contains('is-open')) {
            backToProductList();
        }
    });

    cartItems.addEventListener('click', function (event) {

        const button = event.target.closest('[data-action]');
        if (!button) return;

        const id = button.dataset.id;
        const action = button.dataset.action;

        if (!cart[id]) return;

        if (action === 'plus') {
            if (cart[id].quantity < cart[id].stock) {
                cart[id].quantity++;
            } else {
                alert('Stok tidak mencukupi.');
            }
        }

        if (action === 'minus') {
            cart[id].quantity--;

            if (cart[id].quantity <= 0) {
                delete cart[id];
            }
        }

        if (action === 'remove') {
            delete cart[id];
        }

        renderCart();
    });

    document.getElementById('clear-cart').addEventListener('click', function () {
        Object.keys(cart).forEach(id => delete cart[id]);
        renderCart();
    });

    document.getElementById('checkout-button').addEventListener('click', function () {
        alert('Keranjang sudah siap. Tahap berikutnya kita hubungkan ke proses pembayaran.');
    });

});
</script>

@endsection