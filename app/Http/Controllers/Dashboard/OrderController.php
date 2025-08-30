<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 20;
        $orders = Order::orderBy("created_at", "desc")->paginate($perPage);

        return view('dashboard.order.index', compact('orders'));
    }

    public function detail($id)
    {
        // Use eager loading with the `with()` method to fetch the order along with
        // its related user and all of its order items and their related products.
        // This reduces database queries from N+1 to just 3, regardless of how many items are in the order.
        $order = Order::with(['user', 'orderItems.product'])->findOrFail($id);

        return view('dashboard.order.detail', compact('order'));
    }
}
