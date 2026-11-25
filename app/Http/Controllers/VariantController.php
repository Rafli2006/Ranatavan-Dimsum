<?php

namespace App\Http\Controllers;

use App\Models\Variant;
use App\Models\Category;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    public function index()
    {
        $variants = Variant::with('category')
            ->withCount('products')
            ->latest()
            ->paginate(10);

        return view('admin.variants.index', compact('variants'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.variants.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:100',
        ]);

        $exists = Variant::where('category_id', $request->category_id)
            ->where('name', $request->name)
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'name' => 'Varian tersebut sudah tersedia pada kategori yang dipilih.'
                ]);
        }

        Variant::create($request->only('category_id', 'name'));

        return redirect()->route('admin.varian.index')
            ->with('success', 'Varian berhasil ditambahkan.');
    }

    public function edit(Variant $varian)
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.variants.edit', compact('varian', 'categories'));
    }

    public function update(Request $request, Variant $varian)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:100',
        ]);

        $exists = Variant::where('category_id', $request->category_id)
            ->where('name', $request->name)
            ->where('id', '!=', $varian->id)
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'name' => 'Varian tersebut sudah tersedia pada kategori yang dipilih.'
                ]);
        }

        $varian->update($request->only('category_id', 'name'));

        return redirect()->route('admin.varian.index')
            ->with('success', 'Varian berhasil diperbarui.');
    }

    public function destroy(Variant $varian)
    {
        if ($varian->products()->exists()) {
            return redirect()->route('admin.varian.index')
                ->with('error', 'Varian tidak dapat dihapus karena masih digunakan oleh produk.');
        }

        $varian->delete();

        return redirect()->route('admin.varian.index')
            ->with('success', 'Varian berhasil dihapus.');
    }
}
