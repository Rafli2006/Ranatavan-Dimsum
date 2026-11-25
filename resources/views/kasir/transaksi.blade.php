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

                    @forelse($products as $product)
                        @foreach($product->sizes->where('is_active', true) as $size)

                            <div class="col-md-6 col-xl-4">

                                <div class="product-card">

                                    <div class="product-image">
                                        @if($product->image)
                                            <img src="{{ asset('storage/'.$product->image) }}"
                                                 alt="{{ $product->name }}">
                                        @else
                                            <span>🥟</span>
                                        @endif
                                    </div>

                                    <div class="product-info">
                                        <h6>{{ $product->name }}</h6>

                                        <p>
                                            {{ $product->category->name ?? 'Dimsum' }}
                                            ·
                                            {{ $product->variant->name ?? '' }}
                                        </p>

                                        <div class="size-info">
                                            {{ $size->name }}
                                            @if($size->piece_count)
                                                · {{ $size->piece_count }} pcs
                                            @endif
                                        </div>

                                        <strong>
                                            Rp {{ number_format($size->price, 0, ',', '.') }}
                                        </strong>

                                        <small>
                                            Stok: {{ $size->stock }}
                                        </small>

                                        <button
                                            type="button"
                                            class="add-product"
                                            data-id="{{ $size->id }}"
                                            data-product="{{ $product->name }}"
                                            data-size="{{ $size->name }}"
                                            data-price="{{ $size->price }}"
                                            data-stock="{{ $size->stock }}"
                                            {{ $size->stock < 1 ? 'disabled' : '' }}
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

.product-info p {
    font-size: 10px;
    color: #a18d7d;
    margin-bottom: 8px;
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
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const cart = {};

    const rupiah = number =>
        'Rp ' + Number(number).toLocaleString('id-ID');

    const cartItems = document.getElementById('cart-items');

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

    document.querySelectorAll('.add-product').forEach(button => {
        button.addEventListener('click', function () {

            const id = this.dataset.id;
            const stock = Number(this.dataset.stock);

            if (!cart[id]) {
                cart[id] = {
                    id: id,
                    name: this.dataset.product,
                    size: this.dataset.size,
                    price: Number(this.dataset.price),
                    stock: stock,
                    quantity: 0
                };
            }

            if (cart[id].quantity >= stock) {
                alert('Jumlah melebihi stok yang tersedia.');
                return;
            }

            cart[id].quantity++;
            renderCart();
        });
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
