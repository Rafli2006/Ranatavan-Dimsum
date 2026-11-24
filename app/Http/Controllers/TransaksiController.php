<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class TransaksiController extends Controller
{
    public function index()
    {
        $products = Product::with([
            'category',
            'variant',
            'sizes'
        ])
        ->where('status', 'active')
        ->get();

        return view('transaksi', compact('products'));
    }
}
