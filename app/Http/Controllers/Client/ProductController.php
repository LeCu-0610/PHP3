<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category')->where('status', 1);
        
        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }
        
        // Search by title
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        
        $products = $query->paginate(12);
        $categories = Category::where('status', 1)->get();
        
        return view('client.product.index', compact('products', 'categories'));
    }
    
    public function show($id)
    {
        $product = Product::with('category', 'comments.user', 'variants')->findOrFail($id);
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 1)
            ->limit(4)
            ->get();
            
        return view('client.product.show', compact('product', 'relatedProducts'));
    }
}
