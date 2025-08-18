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
        $order = Order::findOrFail($id);
        return view('dashboard.order.detail', compact('order'));
    }
}
