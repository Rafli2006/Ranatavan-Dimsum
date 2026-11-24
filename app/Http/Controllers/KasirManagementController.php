<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class KasirManagementController extends Controller
{
    // Menampilkan daftar kasir
    public function index()
    {
        $kasirs = User::where('role', 'kasir')
            ->latest()
            ->paginate(10);

        $totalKasir = User::where('role', 'kasir')->count();

        $totalAktif = User::where('role', 'kasir')
            ->where('status', 'aktif')
            ->count();

        $totalNonaktif = User::where('role', 'kasir')
            ->where('status', 'nonaktif')
            ->count();

        return view('admin.kasir.index', compact(
            'kasirs',
            'totalKasir',
            'totalAktif',
            'totalNonaktif'
        ));
    }

    // Form tambah kasir
    public function create()
    {
        return view('admin.kasir.create');
    }

    // Simpan kasir baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $validated['role'] = 'kasir';
        $validated['status'] = 'aktif';

        User::create($validated);

        return redirect()
            ->route('admin.kasir.index')
            ->with('success', 'Akun kasir berhasil ditambahkan.');
    }

    // Form edit kasir
    public function edit($id)
    {
        $kasir = User::where('role', 'kasir')->findOrFail($id);

        return view('admin.kasir.edit', compact('kasir'));
    }

    // Perbarui data kasir
    public function update(Request $request, $id)
    {
        $kasir = User::where('role', 'kasir')->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users,username,' . $kasir->id,
            'email' => 'required|email|max:100|unique:users,email,' . $kasir->id,
            'password' => 'nullable|string|min:8',
        ]);

        // Jika password kosong, gunakan password lama
        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $kasir->update($validated);

        return redirect()
            ->route('admin.kasir.index')
            ->with('success', 'Data kasir berhasil diperbarui.');
    }

    // Hapus akun kasir secara permanen
    public function destroy($id)
    {
        $kasir = User::where('role', 'kasir')->findOrFail($id);

        // Periksa riwayat transaksi
        if ($kasir->orders()->exists()) {
            return redirect()
                ->route('admin.kasir.index')
                ->with('error', 'Kasir tidak dapat dihapus karena memiliki riwayat transaksi.');
        }

        // Periksa riwayat stok
        if ($kasir->stockHistories()->exists()) {
            return redirect()
                ->route('admin.kasir.index')
                ->with('error', 'Kasir tidak dapat dihapus karena memiliki riwayat aktivitas stok.');
        }

        $kasir->delete();

        return redirect()
            ->route('admin.kasir.index')
            ->with('success', 'Akun kasir berhasil dihapus permanen.');
    }

        // Mengaktifkan atau menonaktifkan akun kasir
        public function toggleStatus($id)
        {
            $kasir = User::where('role', 'kasir')->findOrFail($id);

            if ($kasir->status === 'aktif') {
                $kasir->status = 'nonaktif';
                $pesan = 'Akun kasir berhasil dinonaktifkan.';
            } else {
                $kasir->status = 'aktif';
                $pesan = 'Akun kasir berhasil diaktifkan.';
            }

            $kasir->save();

            return redirect()
                ->route('admin.kasir.index')
                ->with('success', $pesan);
        }
}
