<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with(['orderDetails.product'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('client.order.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->with(['orderDetails.product', 'orderDetails.variant'])
            ->findOrFail($id);
        
        return view('client.order.show', compact('order'));
    }

    public function cancel($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->findOrFail($id);
        
        $order->update(['status' => 'cancelled']);
        
        return back()->with('success', 'Đã hủy đơn hàng!');
    }
}
