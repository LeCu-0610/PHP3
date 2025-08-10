<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'nullable|unique:products,slug',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'variants.*.color' => 'nullable|string',
            'variants.*.size' => 'nullable|string',
            'variants.*.quantity' => 'nullable|integer|min:0',
            'variants.*.price' => 'nullable|numeric|min:0',
            'variants.*.sale_price' => 'nullable|numeric|min:0',
            'variants.*.sku' => 'nullable|string|unique:product_variants,sku',
            'variants.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Nếu slug trống thì tự tạo từ title
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        // Xử lý upload ảnh chính
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time() . '_' . $thumbnail->getClientOriginalName();
            $thumbnailPath = $thumbnail->storeAs('products', $thumbnailName, 'public');
            $data['thumbnail'] = $thumbnailPath;
        }

        // Tạo sản phẩm
        $product = Product::create($data);

        // Xử lý variants
        if ($request->has('variants')) {
            foreach ($request->variants as $index => $variantData) {
                // Bỏ qua variant trống
                if (empty($variantData['color']) && empty($variantData['size']) && empty($variantData['price'])) {
                    continue;
                }

                $variantData['product_id'] = $product->id;

                // Xử lý upload ảnh variant
                if (isset($variantData['image']) && $variantData['image'] instanceof \Illuminate\Http\UploadedFile) {
                    $variantImage = $variantData['image'];
                    $variantImageName = time() . '_variant_' . $index . '_' . $variantImage->getClientOriginalName();
                    $variantImagePath = $variantImage->storeAs('product-variants', $variantImageName, 'public');
                    $variantData['image'] = $variantImagePath;
                } else {
                    unset($variantData['image']);
                }

                // Tạo variant
                \App\Models\ProductVariant::create($variantData);
            }
        }

        return redirect()->route('admin.product')->with('success', 'Thêm sản phẩm thành công!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'nullable|unique:products,slug,' . $id,
            'price' => 'required|numeric',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($id);
        $data = $request->all();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        // Xử lý upload ảnh mới
        if ($request->hasFile('thumbnail')) {
            // Xóa ảnh cũ nếu có
            if ($product->thumbnail && Storage::disk('public')->exists($product->thumbnail)) {
                Storage::disk('public')->delete($product->thumbnail);
            }
            
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time() . '_' . $thumbnail->getClientOriginalName();
            $thumbnailPath = $thumbnail->storeAs('products', $thumbnailName, 'public');
            $data['thumbnail'] = $thumbnailPath;
        }

        $product->update($data);

        return redirect()->route('admin.product')->with('success', 'Cập nhật thành công!');
    }

    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            
            // Xóa ảnh thumbnail nếu có
            if ($product->thumbnail && Storage::disk('public')->exists($product->thumbnail)) {
                Storage::disk('public')->delete($product->thumbnail);
            }
            
            $product->delete();
            
            return redirect()->route('admin.product')->with('success', 'Đã xóa sản phẩm!');
        } catch (\Exception $e) {
            return redirect()->route('admin.product')->with('error', 'Không thể xóa sản phẩm. Vui lòng thử lại!');
        }
    }
}
