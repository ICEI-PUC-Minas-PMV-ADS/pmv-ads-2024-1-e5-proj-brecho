<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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

        if(count($cart) == 0) {
            $request->session()->flash('error', 'Carrinho vazio!');
            return redirect()->route('shopping-cart');
        }

        foreach ($cart as $item) {
            $total += $item->product->price * $item->quantity;

            $product = Product::where('id', $item->product_id)->first();

            if($product->quantity > 0) {
                $product->quantity -= 1;
            }

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
            'cep' => $request->cep,
            'total' =>  $total
        ]);


        // Create order detail
        foreach ($cart as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
                'total' => $item->product->price * $item->quantity
            ]);

            $item->delete();
        }

        $request->session()->flash('success', 'Pedido realizado com sucesso!');

        $message = 'Realizei um pedido no valor de *R$' . $total . '* no site da loja.%0ADesejo os seguintes produtos:%0A';
        foreach ($cart as $item) {
            $message .= '- ' . $item->product->name . ' - ' . $item->quantity . ' unid - ' . 'R$ ' . $item->product->price * $item->quantity . '.%0A';
        }

        return Redirect::away("https://api.whatsapp.com/send?phone=$user->phone&text=$message");
    }

    public function increaseQuantity(Request $request)
    {
        $user = $request->user();
        $product_id = $request->product_id;

        $total_quantity = Product::where('id', $product_id)->first()->quantity;

        $cart = ShoppingCart::where('user_id', $user->id)->where('product_id', $product_id)->first();

        $cart->quantity += 1;

        if($cart->quantity > $total_quantity) {
            $request->session()->flash('error', 'Quantidade máxima atingida!');
        }

        if ($cart && $cart->quantity <= $total_quantity) {
            $cart->save();
        }

        return redirect()->route('shopping-cart');
    }

    public function decreaseQuantity(Request $request)
    {
        $user = $request->user();
        $product_id = $request->product_id;

        $cart = ShoppingCart::where('user_id', $user->id)->where('product_id', $product_id)->first();

        if ($cart && $cart->quantity > 1) {
            $cart->quantity -= 1;
            $cart->save();
        }

        return redirect()->route('shopping-cart');
    }
}
