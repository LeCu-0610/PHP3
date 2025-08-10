<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // Danh sách danh mục
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('admin.category.index', compact('categories'));
    }

    // Hiển thị form thêm danh mục
    public function create()
    {
        return view('admin.category.create');
    }

    // Xử lý thêm danh mục
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'status' => $request->status ?? 1
        ]);

        return redirect()->route('admin.category')->with('success', '✅ Thêm danh mục thành công!');
    }

    // Hiển thị form sửa danh mục
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    // Xử lý cập nhật danh mục
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'status' => $request->status ?? 1
        ]);

        return redirect()->route('admin.category')->with('success', '✅ Cập nhật danh mục thành công!');
    }

    // Xóa danh mục (nếu không có sản phẩm liên kết)
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Kiểm tra nếu danh mục có sản phẩm
        if ($category->products()->count() > 0) {
            return redirect()->route('admin.category')
                ->with('error', '❌ Không thể xóa! Danh mục này đang chứa sản phẩm.');
        }

        $category->delete();

        return redirect()->route('admin.category')->with('success', '✅ Xóa danh mục thành công!');
    }
}
