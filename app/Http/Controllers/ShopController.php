<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Prikaz svih proizvoda kupcima
     */
    public function index()
    {
        // Uzimamo samo proizvode koji imaju bar 1 komad na stanju (opciono)
        $products = Product::where('stock', '>', 0)
                           ->orderBy('created_at', 'desc')
                           ->get();

        return view('products.index', compact('products'));
    }

    /**
     * Detalji jednog proizvoda (ako želiš "View Details" stranicu)
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}