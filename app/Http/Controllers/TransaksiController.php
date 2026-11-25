<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query()->latest();

        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        if ($request->filled('cari')) {
            $cari = $request->cari;
            $query->where(function ($q) use ($cari) {
                $q->where('id', 'like', "%{$cari}%")
                  ->orWhere('kode_transaksi', 'like', "%{$cari}%")
                  ->orWhere('order_code', 'like', "%{$cari}%");
            });
        }

        $riwayat = $query->get();

        return view('kasir.riwayat', compact('riwayat'));
    }
}