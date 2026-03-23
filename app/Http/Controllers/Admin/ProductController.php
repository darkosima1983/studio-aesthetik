<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Traits\ImageUploadTrait; 
use Illuminate\Http\Request;    
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    use ImageUploadTrait; 


    public function adminIndex()
    {
        $products = Product::all();
        // Vraća view koji smo ranije pravili sa tabelom, edit i delete dugmićima
        return view('admin.products.index', compact('products'));
    }

    // 1. Prikaz forme za kreiranje novog proizvoda
    public function create()
    {
        return view('admin.products.create');
    }

    // 2. Prikaz forme za izmenu postojećeg proizvoda
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // 3. Čuvanje izmena (Update)
    public function update(StoreProductRequest $request, Product $product)
    {
        // Uzimamo već proverene podatke
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            // Obriši staru sliku pre nego što staviš novu
            if ($product->image) {
                $this->deleteImage($product->image);
            }
            // Upload nove slike preko Traita
            $validated['image'] = $this->uploadImageWebp($request->file('image'), 'products');
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produkt wurde erfolgreich aktualisiert.');
    }
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            // Koristimo našu novu WebP metodu
            $validated['image'] = $this->uploadImageWebp($request->file('image'), 'products');
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produkt wurde als WebP gespeichert!');
    }

    public function destroy(Product $product)
    {
        // Koristimo našu delete metodu iz traita
        $this->deleteImage($product->image);
        
        $product->delete();
        return back()->with('success', 'Produkt gelöscht.');
    }
}
