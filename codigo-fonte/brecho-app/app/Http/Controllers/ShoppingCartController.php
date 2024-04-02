<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user) {
            $cart = ShoppingCart::where('user_id', $user->id)->get();
            $products = [];
            $total = 0;

            foreach ($cart as $item) {
                $product = Product::where('id', $item->product_id)->first();
                $product->quantity = $item->quantity;
                $total += $product->price * $item->quantity;
                array_push($products, $product);
            }

            return view('shopping-cart', ['products' => $products, 'total' => $total]);
        }

        return view('shopping-cart', ['products' => [], 'total' => 0]);
    }

    public function addToCart(Request $request)
    {
        $user = $request->user();
        $product_id = $request->product_id;
        $quantity = $request->quantity;

        $product = Product::where('id', $product_id)->first();
        $cart = ShoppingCart::where('user_id', $user->id)->where('product_id', $product['id'])->first();

        if ($cart) {
            return response()->json(['message' => 'Product already in cart']);
        } else {
            ShoppingCart::create([
                'user_id' => $user->id,
                'product_id' => $product['id'],
                'quantity' => $quantity
            ]);
        }

        return response()->json(['message' => 'Product added to cart']);
    }

    public function removeFromCart(Request $request)
    {
        $user = $request->user();
        $product_id = $request->product_id;

        $cart = ShoppingCart::where('user_id', $user->id)->where('product_id', $product_id)->first();

        if ($cart) {
            $cart->delete();
        }

        return redirect()->route('shopping-cart');
    }

    public function checkout(Request $request)
    {
        $user = $request->user();
        $cart = ShoppingCart::where('user_id', $user->id)->get();
        $total = 0;

        foreach ($cart as $item) {
            $total += $item->product->price * $item->quantity;

            $product = Product::where('id', $item->product_id)->first();
            $product->quantity -= 1;
            $product->save();
        }

        // Create order
        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'pending',
            'date' => date('Y-m-d H:i:s'),
            'address' => $request->address,
            'number' => $request->number,
            'complement' => $request->complement,
            'district' => $request->bairro,
            'city' => $request->city,
            'state' => $request->state,
            'total' =>  $total
        ]);


        // Create order detail
        foreach ($cart as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price
            ]);

            $item->delete();
        }

        $request->session()->flash('success', 'Pedido realizado com sucesso!');

        return redirect()->route('shopping-cart');
    }
}
