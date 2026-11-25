<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Schema;

class KasirController extends Controller
{
    public function dashboard()
    {
        $today = now()->toDateString();

        $totalProdukTersedia = Product::where('status', 'tersedia')->count();

        $todayOrdersQuery = Order::whereDate('created_at', $today);

        // Jika tabel orders punya kolom user_id / kasir_id dan ingin difilter per kasir,
        // pastikan nama kolomnya sesuai di migrasi sebelum mengaktifkannya.
        $jumlahTransaksiHariIni = (clone $todayOrdersQuery)->count();

        $totalKolom = Schema::hasColumn('orders', 'total_harga')
            ? 'total_harga'
            : (Schema::hasColumn('orders', 'total') ? 'total' : null);

        $omzetHariIni = $totalKolom
            ? (clone $todayOrdersQuery)->sum($totalKolom)
            : 0;

        $transaksiTerbaru = Order::latest()->take(5)->get();

        return view('kasir.dashboard', compact(
            'totalProdukTersedia',
            'jumlahTransaksiHariIni',
            'omzetHariIni',
            'transaksiTerbaru'
        ));
    }

    public function transaksiBaru()
    {
        $products = Product::with([
            'category',
            'variant',
            'sizes' => function ($query) {
                $query->where('is_active', true);
            }
        ])
        ->where('status', 'tersedia')
        ->orderBy('name')
        ->get();

        return view('kasir.transaksi', compact('products'));
    }
}