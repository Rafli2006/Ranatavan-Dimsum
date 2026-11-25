<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductSize;
use App\Models\StockHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'variant', 'sizes'])
            ->latest()
            ->get();

        $totalStock = ProductSize::where('is_active', true)->sum('stock');

        $lowStock = ProductSize::where('is_active', true)
            ->where('stock', '<=', 5)
            ->count();

        $histories = StockHistory::with([
            'product',
            'productSize',
            'user'
        ])->latest('created_at')
          ->take(10)
          ->get();

        return view('admin.stocks.index', compact(
            'products',
            'totalStock',
            'lowStock',
            'histories'
        ));
    }

    public function updateStock(Request $request)
    {
        $validated = $request->validate([
            'product_size_id' => 'required|exists:product_sizes,id',
            'type' => 'required|in:masuk,keluar',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($validated) {

            $size = ProductSize::where('id', $validated['product_size_id'])
                ->lockForUpdate()
                ->firstOrFail();

            $stockBefore = $size->stock;
            $quantity = (int) $validated['quantity'];

            if ($validated['type'] === 'masuk') {
                $stockAfter = $stockBefore + $quantity;
            } else {
                if ($quantity > $stockBefore) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'quantity' => 'Stok tidak mencukupi untuk dikurangi.'
                    ]);
                }

                $stockAfter = $stockBefore - $quantity;
            }

            $size->update([
                'stock' => $stockAfter,
            ]);

            $product = Product::findOrFail($size->product_id);

            $totalStock = $product->sizes()->sum('stock');

            $product->update([
                'stock' => $totalStock,
                'status' => $totalStock > 0
                    ? 'tersedia'
                    : 'tidak tersedia',
            ]);

            StockHistory::create([
                'product_id' => $product->id,
                'product_size_id' => $size->id,
                'user_id' => auth()->id(),
                'type' => $validated['type'],
                'quantity' => $quantity,
                'stock_before' => $stockBefore,
                'stock_after' => $stockAfter,
                'description' => $validated['description'] ?? null,
            ]);
        });

        return redirect()
            ->route('admin.stok.index')
            ->with('success', 'Stok berhasil diperbarui.');
    }
}

