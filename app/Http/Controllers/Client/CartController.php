<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())
            ->with(['product', 'product.category'])
            ->get();
        
        $total = $cartItems->sum(function($item) {
            return $item->quantity * $item->price;
        });
        
        return view('client.cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'variant_id' => 'nullable|exists:product_variants,id',
        ]);

        $product = Product::findOrFail($request->product_id);
        $variant = null;
        $price = $product->price;
        $variantInfo = '';

        if ($request->variant_id) {
            $variant = ProductVariant::findOrFail($request->variant_id);
            $price = $variant->final_price;
            $variantInfo = "Màu: {$variant->color}, Size: {$variant->size}";
            
            if ($variant->quantity < $request->quantity) {
                return back()->with('error', 'Số lượng sản phẩm không đủ!');
            }
        }

        $existingCart = Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->where('variant_id', $request->variant_id)
            ->first();

        if ($existingCart) {
            $existingCart->update([
                'quantity' => $existingCart->quantity + $request->quantity,
                'price' => $price,
                'variant_info' => $variantInfo
            ]);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'variant_id' => $request->variant_id,
                'quantity' => $request->quantity,
                'price' => $price,
                'variant_info' => $variantInfo
            ]);
        }

        if ($request->has('buy_now')) {
            return redirect()->route('client.checkout.index')->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
        }
        
        return back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = Cart::where('user_id', Auth::id())->findOrFail($id);
        
        if ($cartItem->variant_id) {
            $variant = ProductVariant::find($cartItem->variant_id);
            if ($variant && $variant->quantity < $request->quantity) {
                if ($request->expectsJson()) {
                    return response()->json(['success' => false, 'message' => 'Số lượng sản phẩm không đủ!']);
                }
                return back()->with('error', 'Số lượng sản phẩm không đủ!');
            }
        }

        $cartItem->update(['quantity' => $request->quantity]);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Đã cập nhật giỏ hàng!']);
        }
        return back()->with('success', 'Đã cập nhật giỏ hàng!');
    }

    public function remove($id)
    {
        $cartItem = Cart::where('user_id', Auth::id())->findOrFail($id);
        $cartItem->delete();

        return back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }

    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();
        return back()->with('success', 'Đã xóa tất cả sản phẩm trong giỏ hàng!');
    }
}
