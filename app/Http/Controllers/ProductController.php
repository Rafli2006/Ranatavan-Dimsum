<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Category;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'variant', 'sizes'])
            ->latest()
            ->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::with('variants')->orderBy('name')->get();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'variant_id' => 'required|exists:variants,id',
            'description' => 'nullable|string',
            'sizes' => 'required|array|min:1',
            'sizes.*.name' => 'required|string|max:30|distinct',
            'sizes.*.unit' => 'required|string|max:20',
            'sizes.*.piece_count' => 'nullable|integer|min:1',
            'sizes.*.price' => 'required|numeric|min:0',
            'sizes.*.stock' => 'required|integer|min:0',
        ]);

        $variant = Variant::where('id', $validated['variant_id'])
            ->where('category_id', $validated['category_id'])
            ->first();

        if (!$variant) {
            return back()
                ->withInput()
                ->withErrors(['variant_id' => 'Varian tidak sesuai dengan kategori yang dipilih.']);
        }

        DB::transaction(function () use ($validated) {
            $category = Category::findOrFail($validated['category_id']);
            $variant = Variant::findOrFail($validated['variant_id']);

            $totalStock = collect($validated['sizes'])->sum('stock');
            $lowestPrice = collect($validated['sizes'])->min('price');

            $product = Product::create([
                'category_id' => $category->id,
                'variant_id' => $variant->id,
                'name' => 'Dimsum ' . $category->name . ' ' . $variant->name,
                'description' => $validated['description'] ?? null,
                'price' => $lowestPrice,
                'cost_price' => null,
                'stock' => $totalStock,
                'status' => $totalStock > 0 ? 'tersedia' : 'tidak tersedia',
            ]);

            foreach ($validated['sizes'] as $size) {
                $product->sizes()->create([
                    'name' => $size['name'],
                    'unit' => $size['unit'],
                    'piece_count' => $size['piece_count'] ?? null,
                    'price' => $size['price'],
                    'stock' => $size['stock'],
                    'is_active' => true,
                ]);
            }
        });

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $produk)
    {
        $produk->load('sizes');

        $categories = Category::with('variants')->orderBy('name')->get();

        return view('admin.products.edit', compact('produk', 'categories'));
    }

    public function update(Request $request, Product $produk)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'variant_id' => 'required|exists:variants,id',
            'description' => 'nullable|string',
            'sizes' => 'required|array|min:1',
            'sizes.*.name' => 'required|string|max:30|distinct',
            'sizes.*.unit' => 'required|string|max:20',
            'sizes.*.piece_count' => 'nullable|integer|min:1',
            'sizes.*.price' => 'required|numeric|min:0',
            'sizes.*.stock' => 'required|integer|min:0',
        ]);

        $variant = Variant::where('id', $validated['variant_id'])
            ->where('category_id', $validated['category_id'])
            ->first();

        if (!$variant) {
            return back()
                ->withInput()
                ->withErrors(['variant_id' => 'Varian tidak sesuai dengan kategori yang dipilih.']);
        }

        DB::transaction(function () use ($validated, $produk) {
            $category = Category::findOrFail($validated['category_id']);
            $variant = Variant::findOrFail($validated['variant_id']);

            $totalStock = collect($validated['sizes'])->sum('stock');
            $lowestPrice = collect($validated['sizes'])->min('price');

            $produk->update([
                'category_id' => $category->id,
                'variant_id' => $variant->id,
                'name' => 'Dimsum ' . $category->name . ' ' . $variant->name,
                'description' => $validated['description'] ?? null,
                'price' => $lowestPrice,
                'stock' => $totalStock,
                'status' => $totalStock > 0 ? 'tersedia' : 'tidak tersedia',
            ]);

            // Nonaktifkan ukuran lama terlebih dahulu.
            // Data ukuran lama tidak dihapus agar riwayat transaksi tetap aman.
            $produk->sizes()->update(['is_active' => false]);

            foreach ($validated['sizes'] as $size) {
                $produk->sizes()->updateOrCreate(
                    [
                        'name' => $size['name'],
                    ],
                    [
                        'unit' => $size['unit'],
                        'piece_count' => $size['piece_count'] ?? null,
                        'price' => $size['price'],
                        'stock' => $size['stock'],
                        'is_active' => true,
                    ]
                );
            }
        });

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $produk)
    {
        // Produk tidak dihapus permanen agar riwayat transaksi
        // dan histori stok tetap tersimpan.
        DB::transaction(function () use ($produk) {
            $produk->update([
                'status' => 'tidak tersedia',
            ]);

            $produk->sizes()->update([
                'is_active' => false,
            ]);
        });

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk berhasil dinonaktifkan.');
    }
}
