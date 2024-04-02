<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if($request->search) {
            $products = Product::where('quantity', '>', 0)->where('name', 'like', '%' . $request->search . '%')->paginate(10);

            if($request->user()) {
                foreach ($products as $product) {
                    $product->in_cart = $product->productInCart($request->user()->id);
                }
            }

            return view('index', ['products' => $products]);
        }

        $products = Product::where('quantity', '>', 0)->paginate(10);

        if($request->user()) {
            foreach ($products as $product) {
                $product->in_cart = $product->productInCart($request->user()->id);
            }
        }

        return view('index', ['products' => $products]);
    }
}
