<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmed;

class CartController extends Controller
{
    // Prikaz korpe
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Dodavanje u korpu
    public function add(Product $product)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Produkt u korpu dodat!');
    }

    // Update količine (koristićemo AJAX ili običan Submit)
    public function update(Request $request)
    {
        if($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            return response()->json(['success' => true]);
        }
    }

    // Brisanje iz korpe
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return response()->json(['success' => true]);
        }
    }

    public function placeOrder(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'address' => 'required',
            'zip' => 'required',
            'city' => 'required',
            'payment_method' => 'required'
        ]);

        $cart = session('cart');
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // 1. Kreiraj glavnu porudžbinu
        $order = Order::create([
            'user_id' => auth()->id(),
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'zip' => $validated['zip'],
            'city' => $validated['city'],
            'total_price' => $total,
            'payment_method' => $validated['payment_method'],
            'status'         => 'pending',
        ]);

        // 2. Kreiraj stavke porudžbine
        foreach ($cart as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_name' => $details['name'],
                'quantity' => $details['quantity'],
                'price' => $details['price'],
            ]);
        }

        session()->forget('cart');

        // Slanje mejla kupcu
        Mail::to($order->email)->send(new OrderConfirmed($order));

        return redirect()->route('products.index')->with('success', 'Vielen Dank! Ihre Bestellung #' . $order->id . ' ist eingegangen.');
    }

    public function checkout()
    {
        // Provera: Ako je korpa prazna, ne daj mu na checkout, vrati ga u shop
        if(!session('cart') || count(session('cart')) == 0) {
            return redirect()->route('products.index')->with('error', 'Vaša korpa je prazna!');
        }
        
        return view('cart.checkout');
    }
}