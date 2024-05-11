<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\UserBookmarks;
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

    public function show(Request $request, $id)
    {
        $product = Product::find($id);

        if(!$product) {
            return redirect()->route('index');
        }

        $product->in_cart = $product->productInCart($request->user()->id);

        $product->average_rating = $product->averageRating();
        $reviews = $product->reviews()->paginate(5);

        foreach ($reviews as $review) {
            $review->user = $review->user()->first();
        }

        return view('product', ['product' => $product, 'reviews' => $reviews, 'average_rating' => $product->averageRating()]);
    }

    public function review(Request $request, $id)
    {
        $product = Product::find($id);

        if(!$product) {
            return view('product', ['product' => $product, 'reviews' => $product->reviews()->paginate(5), 'average_rating' => $product->averageRating()]);

        }

        $review = $product->reviews()->where('user_id', $request->user()->id)->first();

        if($review) {
            return view('product', ['product' => $product, 'reviews' => $product->reviews()->paginate(5), 'average_rating' => $product->averageRating()]);
        }

        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string'
        ]);
        $product->reviews()->create([
            'user_id' => $request->user()->id,
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        return view('product', ['product' => $product, 'reviews' => $product->reviews()->paginate(5), 'average_rating' => $product->averageRating()]);
    }

    public function add_bookmark(Request $request)
    {
        $user = $request->user();
        $product = Product::find($request->product_id);

        $bookmark = UserBookmarks::where('user_id', $user->id)->where('product_id', $product->id)->first();

        if($bookmark) {
            return response()->json(['message' => 'O produto já está nos favoritos!']);
        }

        UserBookmarks::create([
            'user_id' => $user->id,
            'product_id' => $product->id
        ]);

        return response()->json(['message' => 'Produto adicionado aos favoritos!']);
    }

    public function remove_bookmark(Request $request)
    {
        $user = $request->user();
        $product = Product::find($request->product_id);

        $bookmark = UserBookmarks::where('user_id', $user->id)->where('product_id', $product->id)->first();

        if(!$bookmark) {
            return response()->json(['message' => 'O produto não está nos favoritos!']);
        }

        $bookmark->delete();

        return response()->json(['message' => 'Produto removido dos favoritos!']);
    }

    public function user_bookmarks(Request $request)
    {
        $user = $request->user();
        $bookmarkedProducts = $user->bookmarks()->get();

        $products = [];

        foreach ($bookmarkedProducts as $bookmark) {
            $product = Product::where('id', $bookmark->product_id)->where('quantity', '>', 0)->first();

            array_push($products, $product);
        }

        return view('user-bookmarks', ['products' => $products]);
    }

}
