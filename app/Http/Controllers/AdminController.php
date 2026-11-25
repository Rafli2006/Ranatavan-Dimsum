<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Variant;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProducts = Product::count();

        $totalCategories = Category::count();

        $totalVariants = Variant::count();

        $totalKasir = User::where('role', 'kasir')->count();

        $recentProducts = Product::with(['category', 'variant'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalVariants',
            'totalKasir',
            'recentProducts'
        ));
    }
}
