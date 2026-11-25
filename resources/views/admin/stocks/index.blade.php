
@extends('layouts.master')

@section('title', 'Manajemen Stok')

@section('content')

<div class="container-fluid py-4 px-4">

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h2 class="page-title mb-1">Manajemen Stok</h2>
            <p class="page-subtitle">Kelola persediaan produk Ranatavan Dimsum.</p>
        </div>

        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-cokelat">
            <i class="bi bi-arrow-left"></i> Dashboard
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- RINGKASAN --}}
    <div class="row g-3 mb-4">

        <div class="col-md-6">
            <div class="card card-body">
                <div class="text-muted">Total Persediaan</div>
                <h2 class="mt-2 mb-0">
                    {{ number_format($totalStock) }}
                    <small class="fs-6">unit</small>
                </h2>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-body">
                <div class="text-muted">Stok Menipis (5 atau kurang)</div>
                <h2 class="mt-2 mb-0 text-danger">
                    {{ number_format($lowStock) }}
                    <small class="fs-6">ukuran produk</small>
                </h2>
            </div>
        </div>

    </div>

    {{-- DAFTAR STOK --}}
    <div class="card mb-4">

        <div class="card-header">
            <i class="bi bi-box-seam me-2"></i>
            Daftar Stok Produk
        </div>

        <div class="card-body table-responsive">

            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
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
                                    <strong>{{ $product->name }}</strong>
                                </td>

                                <td>{{ $size->name }}</td>

                                <td>
                                    Rp {{ number_format($size->price, 0, ',', '.') }}
                                </td>

                                <td>
                                    <strong>{{ $size->stock }}</strong>
                                    {{ $size->unit }}
                                </td>

                                <td>
                                    @if($size->stock == 0)
                                        <span class="badge bg-danger">Habis</span>
                                    @elseif($size->stock <= 5)
                                        <span class="badge bg-warning text-dark">Menipis</span>
                                    @else
                                        <span class="badge bg-success">Tersedia</span>
                                    @endif
                                </td>

                                <td>
                                    <button
                                        class="btn btn-sm btn-cokelat"
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
                            <td colspan="7" class="text-center py-4">
                                Belum ada produk.
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>
    </div>

    {{-- RIWAYAT STOK --}}
    <div class="card">

        <div class="card-header">
            <i class="bi bi-clock-history me-2"></i>
            Riwayat Perubahan Stok
        </div>

        <div class="card-body table-responsive">

            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>No</th>
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

                            <td>
                                {{ $history->created_at->format('d/m/Y H:i') }}
                            </td>

                            <td>{{ $history->product->name ?? '-' }}</td>

                            <td>{{ $history->productSize->name ?? '-' }}</td>

                            <td>
                                @if($history->type == 'masuk')
                                    <span class="badge bg-success">Masuk</span>
                                @else
                                    <span class="badge bg-danger">Keluar</span>
                                @endif
                            </td>

                            <td>{{ $history->quantity }}</td>

                            <td>{{ $history->stock_before }}</td>

                            <td>{{ $history->stock_after }}</td>

                            <td>{{ $history->user->name ?? '-' }}</td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                Belum ada riwayat perubahan stok.
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>
    </div>

</div>

{{-- MODAL KELOLA STOK --}}
@foreach($products as $product)
    @foreach($product->sizes->where('is_active', true) as $size)

        <div class="modal fade" id="modalStok{{ $size->id }}" tabindex="-1">

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Kelola Stok Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="{{ route('admin.stok.update') }}" method="POST">
                        @csrf

                        <div class="modal-body">

                            <div class="mb-3">
                                <label class="form-label">Nama Produk</label>
                                <input type="text" class="form-control"
                                    value="{{ $product->name }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ukuran</label>
                                <input type="text" class="form-control"
                                    value="{{ $size->name }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Stok Saat Ini</label>
                                <input type="text" class="form-control"
                                    value="{{ $size->stock }} {{ $size->unit }}" readonly>
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
                                <label class="form-label">Jumlah</label>

                                <input type="number" name="quantity"
                                    class="form-control" min="1" required
                                    placeholder="Masukkan jumlah stok">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Keterangan</label>

                                <textarea name="description"
                                    class="form-control" rows="3"
                                    placeholder="Contoh: Pembelian bahan baku"></textarea>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">
                                Batal
                            </button>

                            <button type="submit" class="btn btn-cokelat">
                                Simpan Perubahan
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    @endforeach
@endforeach

@endsection
