
@extends('layouts.master')

@section('title', 'Data Kasir')

@section('content')
<div class="kasir-page">

    {{-- HEADER --}}
    <div class="kasir-header">
        <div>
            <span class="header-label">MANAJEMEN PENGGUNA</span>
            <h2>Data Kasir</h2>
            <p>Kelola akun kasir Ranatavan Dimsum.</p>
        </div>

        <div class="header-actions">
            <a href="{{ route('admin.dashboard') }}" class="btn-dashboard">
                <i class="bi bi-arrow-left"></i> Dashboard
            </a>

            <a href="{{ route('admin.kasir.create') }}" class="btn-add">
                <i class="bi bi-plus-lg"></i> Tambah Kasir
            </a>
        </div>
    </div>

    {{-- NOTIFIKASI --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-circle-fill me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- RINGKASAN --}}
    <div class="row g-3 summary-row">

        <div class="col-md-4">
            <div class="summary-card">
                <div class="summary-icon icon-brown">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div>
                    <span>Total Kasir</span>
                    <h3>{{ $totalKasir }}</h3>
                    <small>Seluruh akun kasir</small>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="summary-card">
                <div class="summary-icon icon-green">
                    <i class="bi bi-person-check-fill"></i>
                </div>
                <div>
                    <span>Kasir Aktif</span>
                    <h3>{{ $totalAktif }}</h3>
                    <small>Akun dapat login</small>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="summary-card">
                <div class="summary-icon icon-red">
                    <i class="bi bi-person-x-fill"></i>
                </div>
                <div>
                    <span>Kasir Nonaktif</span>
                    <h3>{{ $totalNonaktif }}</h3>
                    <small>Akun tidak dapat login</small>
                </div>
            </div>
        </div>

    </div>

    {{-- TABEL --}}
    <div class="table-card">

        <div class="table-heading">
            <div>
                <h5>Daftar Akun Kasir</h5>
                <p>Informasi seluruh pengguna dengan hak akses kasir.</p>
            </div>

            <span class="total-badge">
                {{ $totalKasir }} Kasir
            </span>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0">

                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Kasir</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($kasirs as $index => $kasir)
                        <tr>
                            <td>{{ $kasirs->firstItem() + $index }}</td>

                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">
                                        {{ strtoupper(substr($kasir->name, 0, 1)) }}
                                    </div>
                                    <strong>{{ $kasir->name }}</strong>
                                </div>
                            </td>

                            <td>{{ $kasir->username ?? '-' }}</td>

                            <td>{{ $kasir->email }}</td>

                            <td>
                                @if ($kasir->status === 'aktif')
                                    <span class="status-badge status-active">
                                        <i class="bi bi-circle-fill"></i> Aktif
                                    </span>
                                @else
                                    <span class="status-badge status-inactive">
                                        <i class="bi bi-circle-fill"></i> Nonaktif
                                    </span>
                                @endif
                            </td>

                            <td>
                                <div class="action-buttons">

                                <a href="{{ route('admin.kasir.edit', $kasir->id) }}"
                                    class="btn-edit">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>

                                {{-- Tombol aktif/nonaktif --}}
                                <form action="{{ route('admin.kasir.toggleStatus', $kasir->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin mengubah status akun kasir ini?')">
                                    @csrf
                                    @method('PATCH')

                                    @if ($kasir->status === 'aktif')
                                        <button type="submit" class="btn-status btn-status-disable">
                                            <i class="bi bi-person-x-fill"></i>
                                            Nonaktifkan
                                        </button>
                                    @else
                                        <button type="submit" class="btn-status btn-status-enable">
                                            <i class="bi bi-person-check-fill"></i>
                                            Aktifkan
                                        </button>
                                    @endif
                                </form>

                                <button type="button"
                                    class="btn-delete"
                                    data-bs-toggle="modal"
                                    data-bs-target="#hapusKasir{{ $kasir->id }}">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>

                            </div>
                            </td>
                        </tr>

                        {{-- MODAL KONFIRMASI HAPUS --}}
                        <div class="modal fade"
                            id="hapusKasir{{ $kasir->id }}"
                            tabindex="-1"
                            aria-hidden="true">

                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 rounded-4">

                                    <div class="modal-body text-center p-4">

                                        <div class="delete-icon">
                                            <i class="bi bi-trash3-fill"></i>
                                        </div>

                                        <h5 class="delete-title">
                                            Hapus Akun Kasir?
                                        </h5>

                                        <p class="delete-description">
                                            Apakah kamu yakin ingin menghapus akun
                                            <strong>{{ $kasir->name }}</strong>?
                                            Tindakan ini tidak dapat dibatalkan.
                                        </p>

                                        <div class="d-flex justify-content-center gap-2">

                                            <button type="button"
                                                class="btn-cancel"
                                                data-bs-dismiss="modal">
                                                Batal
                                            </button>

                                            <form action="{{ route('admin.kasir.destroy', $kasir->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn-confirm-delete">
                                                    <i class="bi bi-trash"></i> Ya, Hapus
                                                </button>
                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    @empty
                        <tr>
                            <td colspan="6" class="empty-state">
                                <div class="empty-icon">
                                    <i class="bi bi-people"></i>
                                </div>
                                <h5>Belum Ada Data Kasir</h5>
                                <p>Tambahkan akun kasir untuk mulai mengelola pengguna.</p>

                                <a href="{{ route('admin.kasir.create') }}" class="btn-add">
                                    <i class="bi bi-plus-lg"></i> Tambah Kasir
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        {{-- PAGINATION --}}
        @if ($kasirs->hasPages())
            <div class="pagination-wrapper">
                {{ $kasirs->links() }}
            </div>
        @endif

    </div>
</div>
@endsection

@push('styles')
<style>
    .kasir-page {
        max-width: 1500px;
        margin: auto;
        padding: 25px 20px 40px;
    }

    .kasir-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 28px;
    }

    .header-label {
        color: #946747;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.5px;
    }

    .kasir-header h2 {
        color: #54321f;
        font-size: 29px;
        font-weight: 800;
        margin: 8px 0 4px;
    }

    .kasir-header p {
        color: #9a897c;
        font-size: 14px;
        margin: 0;
    }

    .header-actions {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .btn-dashboard, .btn-add {
        display: inline-block;
        padding: 12px 17px;
        border-radius: 10px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-dashboard {
        background: white;
        color: #70452c;
        border: 1px solid #ddcbb9;
    }

    .btn-dashboard:hover {
        background: #f4e9dd;
        color: #54321f;
    }

    .btn-add {
        background: #70452c;
        color: white;
        border: 1px solid #70452c;
    }

    .btn-add:hover {
        background: #54321f;
        color: white;
    }

    .summary-row {
        margin-bottom: 25px;
    }

    .summary-card {
        display: flex;
        align-items: center;
        gap: 16px;
        min-height: 125px;
        padding: 22px;
        background: white;
        border: 1px solid #eee4da;
        border-radius: 15px;
        box-shadow: 0 3px 12px rgba(80, 50, 30, .04);
    }

    .summary-icon {
        width: 53px;
        height: 53px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        font-size: 23px;
    }

    .icon-brown {
        background: #f4e6d8;
        color: #70452c;
    }

    .icon-green {
        background: #e8f0e5;
        color: #52734b;
    }

    .icon-red {
        background: #f8e9e5;
        color: #b64c3f;
    }

    .summary-card span {
        color: #927c6b;
        font-size: 13px;
    }

    .summary-card h3 {
        color: #54321f;
        font-size: 26px;
        font-weight: 800;
        margin: 3px 0;
    }

    .summary-card small {
        color: #aa9b8f;
        font-size: 11px;
    }

    .table-card {
        background: white;
        border: 1px solid #eee4da;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 3px 12px rgba(80, 50, 30, .04);
    }

    .table-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 23px 25px;
    }

    .table-heading h5 {
        color: #54321f;
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .table-heading p {
        color: #9a897c;
        font-size: 12px;
        margin: 0;
    }

    .total-badge {
        padding: 8px 14px;
        background: #f5ece3;
        color: #70452c;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }

    .table-card thead th {
        background: #70452c;
        color: white;
        padding: 16px 14px;
        font-size: 12px;
        white-space: nowrap;
    }

    .table-card tbody td {
        padding: 16px 14px;
        color: #594333;
        font-size: 13px;
        border-bottom: 1px solid #f0e9e2;
    }

    .table-card tbody tr:hover {
        background: #fdfaf7;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 11px;
        white-space: nowrap;
    }

    .user-info strong {
        color: #54321f;
    }

    .user-avatar {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: #f1e2d3;
        color: #70452c;
        font-size: 15px;
        font-weight: 700;
    }

    .status-badge {
        display: inline-block;
        padding: 7px 11px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-badge i {
        font-size: 7px;
        margin-right: 3px;
    }

    .status-active {
        background: #e9f1e6;
        color: #52734b;
    }

    .status-inactive {
        background: #f9e9e5;
        color: #ae5548;
    }

    .action-buttons {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        flex-wrap: wrap;
    }

    .btn-edit, .btn-delete {
        display: inline-block;
        padding: 8px 11px;
        border: none;
        border-radius: 7px;
        font-size: 11px;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
    }

    .btn-edit {
        background: #f8efd9;
        color: #946a27;
    }

    .btn-edit:hover {
        background: #f0e2bd;
        color: #79531e;
    }

    .btn-delete {
        background: #f8e9e5;
        color: #b64c3f;
    }

    .btn-delete:hover {
        background: #f1d5cf;
        color: #98392e;
    }

    .empty-state {
        text-align: center;
        padding: 55px 20px !important;
    }

    .empty-icon {
        color: #b99575;
        font-size: 42px;
        margin-bottom: 10px;
    }

    .empty-state h5 {
        color: #54321f;
        font-weight: 700;
    }

    .empty-state p {
        color: #9a897c;
        margin-bottom: 20px;
    }

    .pagination-wrapper {
        padding: 18px 22px;
        display: flex;
        justify-content: flex-end;
    }

    .delete-icon {
        width: 75px;
        height: 75px;
        margin: 0 auto 18px;
        border-radius: 50%;
        background: #f9e9e5;
        color: #b64c3f;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
    }

    .delete-title {
        color: #54321f;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .delete-description {
        color: #8e8176;
        font-size: 13px;
        line-height: 1.7;
        margin-bottom: 23px;
    }

    .btn-cancel, .btn-confirm-delete {
        padding: 10px 18px;
        border: none;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-cancel {
        background: #f4e9dd;
        color: #70452c;
    }

    .btn-cancel:hover {
        background: #ead8c6;
    }

    .btn-confirm-delete {
        background: #b64c3f;
        color: white;
    }

    .btn-confirm-delete:hover {
        background: #98392e;
    }

   
/* Tombol status kasir - berlaku untuk semua ukuran layar */
.action-buttons {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    flex-wrap: wrap;
}

.action-buttons form {
    display: inline-flex;
    margin: 0;
}

.btn-status {
    display: inline-flex !important;
    align-items: center;
    justify-content: center;
    gap: 5px;
    padding: 8px 11px !important;
    border: none !important;
    border-radius: 7px !important;
    outline: none !important;
    font-family: inherit;
    font-size: 11px !important;
    font-weight: 600;
    white-space: nowrap;
    cursor: pointer;
    appearance: none;
    -webkit-appearance: none;
    box-shadow: none !important;
    transition: all .2s ease;
}

/* Nonaktifkan */
.btn-status-disable {
    background-color: #f8e9e5 !important;
    color: #b64c3f !important;
    transition: background-color .2s ease;
}

.btn-status-disable:hover,
.btn-status-disable:focus,
.btn-status-disable:active {
    background-color: #f3ded8 !important;
    color: #b64c3f !important;
    box-shadow: none !important;
    outline: none !important;
}

/* Aktifkan */
.btn-status-enable {
    background-color: #e8f0e5 !important;
    color: #52734b !important;
    transition: background-color .2s ease;
}

.btn-status-enable:hover,
.btn-status-enable:focus,
.btn-status-enable:active {
    background-color: #dce9d7 !important;
    color: #52734b !important;
    box-shadow: none !important;
    outline: none !important;
}

/* Responsive */
@media (max-width: 768px) {
    .kasir-page {
        padding: 15px 5px 30px;
    }

    .kasir-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .header-actions {
        width: 100%;
        flex-wrap: wrap;
    }

    .table-heading {
        padding: 18px;
    }
}

    
    
</style>
@endpush
