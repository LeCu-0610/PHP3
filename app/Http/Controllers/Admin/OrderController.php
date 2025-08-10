<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'orderDetails.product', 'orderDetails.variant'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.order.index', compact('orders'));
    }
    
    public function show($id)
    {
        $order = Order::with(['user', 'orderDetails.product', 'orderDetails.variant'])
            ->findOrFail($id);
            
        return view('admin.order.show', compact('order'));
    }
    
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);
        
        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }
}
