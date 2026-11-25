
@extends('layouts.master')

@section('title', 'Manajemen Stok')

@section('content')

<div class="stock-page">

    {{-- HEADER --}}
    <div class="stock-header">
        <div>
            <span class="header-label">
                <i class="bi bi-boxes"></i>
                MANAJEMEN PERSEDIAAN
            </span>

            <h2>Manajemen Stok</h2>

            <p>
                Pantau dan kelola persediaan produk Ranatavan Dimsum.
            </p>
        </div>

        <div class="header-actions">
            <a href="{{ route('admin.dashboard') }}" class="btn-dashboard">
                <i class="bi bi-arrow-left"></i> Dashboard
            </a>
        </div>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong><i class="bi bi-exclamation-circle me-2"></i> Perhatian</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- RINGKASAN --}}
    <div class="stock-summary">

        <div class="stock-summary-card">
            <div class="summary-icon orange">
                <i class="bi bi-box-seam"></i>
            </div>
            <div>
                <span>Total Persediaan</span>
                <h3>{{ number_format($totalStock) }}</h3>
                <small>Unit seluruh ukuran aktif</small>
            </div>
            <div class="summary-decoration">📦</div>
        </div>

        <div class="stock-summary-card">
            <div class="summary-icon peach">
                <i class="bi bi-exclamation-triangle"></i>
            </div>
            <div>
                <span>Stok Menipis</span>
                <h3>{{ number_format($lowStock) }}</h3>
                <small>Ukuran dengan stok maksimal 5</small>
            </div>
            <div class="summary-decoration">⚠️</div>
        </div>

        <div class="stock-summary-card">
            <div class="summary-icon green">
                <i class="bi bi-clock-history"></i>
            </div>
            <div>
                <span>Riwayat Terbaru</span>
                <h3>{{ $histories->count() }}</h3>
                <small>Perubahan stok terakhir</small>
            </div>
            <div class="summary-decoration">📋</div>
        </div>

    </div>

    {{-- DAFTAR STOK --}}
    <div class="stock-table-card">

        <div class="table-card-header">
            <div class="table-heading">
                <div class="table-heading-icon">
                    <i class="bi bi-boxes"></i>
                </div>
                <div>
                    <h5>Daftar Persediaan Produk</h5>
                    <p>Informasi stok berdasarkan ukuran produk.</p>
                </div>
            </div>

            <div class="product-count">
                <i class="bi bi-box"></i>
                {{ $products->count() }} Produk
            </div>
        </div>

        <div class="table-responsive">
            <table class="table stock-table align-middle">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Produk</th>
                        <th>Ukuran</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @php $no = 1; @endphp

                    @forelse($products as $product)
                        @foreach($product->sizes->where('is_active', true) as $size)
                            <tr>
                                <td>{{ $no++ }}</td>

                                <td>
                                    <div class="stock-product">
                                        <div class="stock-product-icon">🥟</div>
                                        <strong>{{ $product->name }}</strong>
                                    </div>
                                </td>

                                <td>
                                    <span class="size-label">{{ $size->name }}</span>
                                </td>

                                <td>
                                    Rp{{ number_format($size->price, 0, ',', '.') }}
                                </td>

                                <td>
                                    <strong class="stock-number">
                                        {{ number_format($size->stock) }}
                                    </strong>
                                    <small>unit</small>
                                </td>

                                <td>
                                    @if($size->stock <= 0)
                                        <span class="stock-status empty">
                                            <i class="bi bi-x-circle-fill"></i> Habis
                                        </span>
                                    @elseif($size->stock <= 5)
                                        <span class="stock-status low">
                                            <i class="bi bi-exclamation-circle-fill"></i> Menipis
                                        </span>
                                    @else
                                        <span class="stock-status available">
                                            <i class="bi bi-check-circle-fill"></i> Tersedia
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <button class="btn-stock"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalStok{{ $size->id }}">
                                        <i class="bi bi-pencil-square"></i>
                                        Kelola
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <div>🥟</div>
                                    <h5>Belum Ada Persediaan</h5>
                                    <p>Produk belum memiliki ukuran aktif.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- RIWAYAT --}}
    <div class="stock-table-card history-card">

        <div class="table-card-header">
            <div class="table-heading">
                <div class="table-heading-icon">
                    <i class="bi bi-clock-history"></i>
                </div>
                <div>
                    <h5>Riwayat Perubahan Stok</h5>
                    <p>Catatan aktivitas penambahan dan pengurangan stok.</p>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table stock-table align-middle">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Produk</th>
                        <th>Ukuran</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                        <th>Sebelum</th>
                        <th>Sesudah</th>
                        <th>Petugas</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($histories as $history)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $history->created_at->format('d/m/Y H:i') }}</td>

                            <td>{{ $history->product->name ?? '-' }}</td>

                            <td>{{ $history->productSize->name ?? '-' }}</td>

                            <td>
                                @if($history->type == 'masuk')
                                    <span class="stock-status available">Masuk</span>
                                @else
                                    <span class="stock-status empty">Keluar</span>
                                @endif
                            </td>

                            <td><strong>{{ $history->quantity }}</strong></td>
                            <td>{{ $history->stock_before }}</td>
                            <td>{{ $history->stock_after }}</td>
                            <td>{{ $history->user->name ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">
                                <div class="empty-state">
                                    <div>📋</div>
                                    <h5>Belum Ada Riwayat</h5>
                                    <p>Aktivitas perubahan stok akan muncul di sini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL KELOLA STOK --}}
    @foreach($products as $product)
        @foreach($product->sizes->where('is_active', true) as $size)

            <div class="modal fade" id="modalStok{{ $size->id }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content stock-modal">

                        <div class="modal-header">
                            <div>
                                <span class="header-label">PERSEDIAAN PRODUK</span>
                                <h5 class="modal-title">Kelola Stok</h5>
                            </div>
                            <button type="button" class="btn-close"
                                data-bs-dismiss="modal"></button>
                        </div>

                        <form action="{{ route('admin.stok.update') }}" method="POST">
                            @csrf

                            <div class="modal-body">

                                <div class="modal-product-info">
                                    <div class="modal-product-icon">🥟</div>
                                    <div>
                                        <strong>{{ $product->name }}</strong>
                                        <small>{{ $size->name }}</small>
                                    </div>
                                </div>

                                <div class="current-stock">
                                    <span>Stok Saat Ini</span>
                                    <h3>{{ number_format($size->stock) }} unit</h3>
                                </div>

                                <input type="hidden" name="product_size_id"
                                    value="{{ $size->id }}">

                                <div class="mb-3">
                                    <label class="form-label">Jenis Perubahan</label>
                                    <select name="type" class="form-select" required>
                                        <option value="masuk">Tambah Stok</option>
                                        <option value="keluar">Kurangi Stok</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Jumlah Stok</label>
                                    <input type="number" name="quantity"
                                        class="form-control" min="1" required
                                        placeholder="Masukkan jumlah">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Keterangan</label>
                                    <textarea name="description"
                                        class="form-control" rows="3"
                                        placeholder="Tuliskan keterangan perubahan stok"></textarea>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn-cancel"
                                    data-bs-dismiss="modal">Batal</button>

                                <button type="submit" class="btn-save-stock">
                                    <i class="bi bi-check-lg"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        @endforeach
    @endforeach

    {{-- FOOTER --}}
    <div class="stock-footer">
        🥟 <strong>Ranatavan Dimsum</strong>
        <span>·</span>
        Manajemen Stok
    </div>

</div>

@endsection

@push('styles')
<style>
.stock-page {
    min-height: 100vh;
    background: #fffaf6;
    padding: 30px;
}

.stock-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    padding: 28px 30px;
    margin-bottom: 25px;
    border: 1px solid #f0e3d8;
    border-radius: 18px;
    background: linear-gradient(115deg, #fff 55%, #fff0e3);
}

.header-label {
    display: inline-block;
    color: #bd7541;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1.5px;
    margin-bottom: 9px;
}

.stock-header h2 {
    color: #563321;
    font-family: 'Playfair Display', serif;
    font-size: 29px;
    font-weight: 700;
    margin-bottom: 7px;
}

.stock-header p {
    color: #998477;
    font-size: 13px;
    margin: 0;
}

.btn-dashboard, .btn-stock, .btn-save-stock, .btn-cancel {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    padding: 10px 16px;
    border-radius: 9px;
    font-size: 12px;
    font-weight: 700;
    text-decoration: none;
    transition: .2s;
}

.btn-dashboard {
    color: #70452c;
    border: 1px solid #dfc8b5;
    background: white;
}

.btn-dashboard:hover {
    color: white;
    background: #70452c;
}

.stock-summary {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
    margin-bottom: 25px;
}

.stock-summary-card {
    position: relative;
    display: flex;
    align-items: center;
    gap: 16px;
    overflow: hidden;
    padding: 22px;
    background: white;
    border: 1px solid #f0e8df;
    border-radius: 16px;
    box-shadow: 0 5px 20px rgba(74,48,29,.04);
}

.summary-icon, .table-heading-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    width: 48px;
    height: 48px;
    border-radius: 13px;
    font-size: 21px;
}

.summary-icon.orange {
    background: #fff0df;
    color: #d88742;
}

.summary-icon.peach {
    background: #fff0eb;
    color: #d36e54;
}

.summary-icon.green {
    background: #e9f5ed;
    color: #438b60;
}

.stock-summary-card span {
    color: #918477;
    font-size: 12px;
}

.stock-summary-card h3 {
    color: #563321;
    font-size: 25px;
    font-weight: 800;
    margin: 3px 0;
}

.stock-summary-card small {
    color: #a99b8e;
    font-size: 10px;
}

.summary-decoration {
    position: absolute;
    right: 15px;
    bottom: 8px;
    font-size: 35px;
    opacity: .13;
}

.stock-table-card {
    overflow: hidden;
    margin-bottom: 24px;
    background: white;
    border: 1px solid #f0e8df;
    border-radius: 16px;
    box-shadow: 0 5px 22px rgba(74,48,29,.045);
}

.table-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    padding: 20px 23px;
    border-bottom: 1px solid #f1e9e1;
}

.table-heading {
    display: flex;
    align-items: center;
    gap: 13px;
}

.table-heading-icon {
    width: 42px;
    height: 42px;
    background: #fff0e3;
    color: #bd7541;
}

.table-heading h5 {
    color: #563321;
    font-size: 14px;
    font-weight: 800;
    margin: 0 0 4px;
}

.table-heading p {
    color: #a09184;
    font-size: 11px;
    margin: 0;
}

.product-count {
    padding: 8px 12px;
    border-radius: 8px;
    background: #fff5ec;
    color: #a96837;
    font-size: 11px;
    font-weight: 700;
}

.stock-table {
    min-width: 850px;
}

.stock-table thead th {
    background: #faf4ed;
    color: #80573b;
    padding: 15px 14px;
    border-bottom: 1px solid #f0e8df;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: .5px;
    text-transform: uppercase;
    white-space: nowrap;
}

.stock-table tbody td {
    padding: 14px;
    color: #716358;
    font-size: 12px;
    border-color: #f4eee8;
}

.stock-product {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #563321;
}

.stock-product-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 35px;
    height: 35px;
    border-radius: 9px;
    background: #fff2e6;
    font-size: 19px;
}

.size-label {
    padding: 5px 9px;
    border-radius: 7px;
    color: #93613d;
    background: #faf0e6;
    font-size: 11px;
    font-weight: 700;
}

.stock-number {
    color: #563321;
    font-size: 14px;
}

.stock-status {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 6px 9px;
    border-radius: 7px;
    font-size: 10px;
    font-weight: 700;
    white-space: nowrap;
}

.stock-status.available {
    color: #39805a;
    background: #eaf5ed;
}

.stock-status.low {
    color: #a66d1f;
    background: #fff4dc;
}

.stock-status.empty {
    color: #bd554c;
    background: #fcebea;
}

.btn-stock {
    border: 1px solid #e8d3c0;
    background: #fff6ed;
    color: #8a5734;
    padding: 8px 11px;
}

.btn-stock:hover {
    background: #70452c;
    color: white;
    border-color: #70452c;
}

.empty-state {
    padding: 40px 15px;
    text-align: center;
}

.empty-state div {
    font-size: 38px;
    margin-bottom: 10px;
}

.empty-state h5 {
    color: #563321;
    font-weight: 700;
}

.empty-state p {
    color: #a09184;
    font-size: 12px;
}

.stock-modal {
    border: none;
    border-radius: 16px;
    overflow: hidden;
}

.stock-modal .modal-header {
    padding: 20px 23px;
    background: #fff7ef;
    border-bottom: 1px solid #f0e8df;
}

.stock-modal .modal-title {
    color: #563321;
    font-weight: 800;
}

.stock-modal .modal-body {
    padding: 22px;
}

.modal-product-info {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 18px;
}

.modal-product-icon {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 45px;
    height: 45px;
    background: #fff0e3;
    border-radius: 12px;
    font-size: 24px;
}

.modal-product-info strong,
.modal-product-info small {
    display: block;
}

.modal-product-info strong {
    color: #563321;
    font-size: 13px;
}

.modal-product-info small {
    color: #a09184;
    font-size: 11px;
}

.current-stock {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 11px;
    background: #faf4ed;
}

.current-stock span {
    color: #998477;
    font-size: 11px;
}

.current-stock h3 {
    color: #70452c;
    font-size: 24px;
    font-weight: 800;
    margin: 4px 0 0;
}

.stock-modal .form-label {
    color: #70452c;
    font-size: 12px;
    font-weight: 700;
}

.stock-modal .form-control,
.stock-modal .form-select {
    font-size: 12px;
    border-color: #eadfd4;
    border-radius: 9px;
}

.stock-modal .modal-footer {
    padding: 15px 22px;
    border-top: 1px solid #f0e8df;
}

.btn-cancel {
    color: #806d5e;
    background: white;
    border: 1px solid #e5dcd3;
}

.btn-save-stock {
    color: white;
    background: #70452c;
    border: 1px solid #70452c;
}

.btn-save-stock:hover {
    background: #4e3020;
    color: white;
}

.stock-footer {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 9px;
    padding: 20px 0 5px;
    color: #a99b8e;
    font-size: 11px;
}

.stock-footer strong {
    color: #80573b;
}

@media(max-width: 900px) {
    .stock-summary {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media(max-width: 600px) {
    .stock-page {
        padding: 17px 12px;
    }

    .stock-header {
        padding: 21px;
        align-items: flex-start;
    }

    .stock-header h2 {
        font-size: 23px;
    }

    .stock-summary {
        grid-template-columns: 1fr;
    }

    .table-card-header {
        align-items: flex-start;
        flex-direction: column;
    }
}
</style>
@endpush
