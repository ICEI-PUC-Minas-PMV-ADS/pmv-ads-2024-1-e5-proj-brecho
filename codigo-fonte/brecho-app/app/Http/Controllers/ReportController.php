<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;

class ReportController extends Controller
{
    //
    public function generate_report(Request $request)
    {
        if ($request->user() && $request->user()->is_admin) {
            $orders = Order::all();
            $order_detail = OrderDetail::all();
            $products = Product::all();

            return view('reports', ['orders' => $orders, 'order_detail' => $order_detail, 'products' => $products]);
        }

        abort(403, 'Unauthorized action.');
    }
}
