<?php

namespace App\Http\Controllers;

use App\Models\Product;

class KasirController extends Controller
{
    public function dashboard()
    {
        return view('kasir.dashboard');
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
