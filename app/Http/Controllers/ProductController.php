<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Javan prikaz za klijente
    public function index()
    {
        // Uzimamo sve proizvode iz baze (koje si ubacio preko seedera)
        $products = \App\Models\Product::all();

        // Šaljemo ih u view
        return view('products.index', compact('products'));
    }

    // Admin čuvanje proizvoda
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            // Čuva sliku u storage/app/public/products i vraća putanju
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produkt wurde erfolgreich erstellt.');
    }

    public function destroy(Product $product)
    {
        // Brišemo i sliku sa servera ako postoji
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        return back()->with('success', 'Produkt gelöscht.');
    }
}

