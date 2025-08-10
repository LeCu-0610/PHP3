<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())
            ->with(['product', 'product.category'])
            ->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('client.cart.index')->with('error', 'Giỏ hàng trống!');
        }
        
        $total = $cartItems->sum(function($item) {
            return $item->quantity * $item->price;
        });
        
        return view('client.checkout.index', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:500',
            'billing_address' => 'required|string|max:500',
            'phone' => 'required|string|max:20',
            'note' => 'nullable|string|max:1000',
        ]);

        $cartItems = Cart::where('user_id', Auth::id())
            ->with(['product', 'variant'])
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('client.cart.index')->with('error', 'Giỏ hàng trống!');
        }

        try {
            DB::beginTransaction();

            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'ORD-' . time() . '-' . Auth::id(),
                'total_amount' => $cartItems->sum(function($item) {
                    return $item->quantity * $item->price;
                }),
                'status' => 'pending',
                'shipping_address' => $request->shipping_address,
                'billing_address' => $request->billing_address,
                'phone' => $request->phone,
                'note' => $request->note,
            ]);

            foreach ($cartItems as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'variant_id' => $item->variant_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'variant_info' => $item->variant_info,
                ]);

                if ($item->variant_id) {
                    $variant = $item->variant;
                    $variant->decrement('quantity', $item->quantity);
                }
            }

            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            return redirect()->route('client.order.show', $order->id)
                ->with('success', 'Đặt hàng thành công!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Có lỗi xảy ra khi đặt hàng!');
        }
    }
}
