<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductVariant;

class ProductVariantSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();
        
        if ($products->count() > 0) {
            // Tạo variants cho từng sản phẩm
            foreach ($products as $index => $product) {
                $this->createVariantsForProduct($product, $index + 1);
            }
        }
    }
    
    private function createVariantsForProduct($product, $productNumber)
    {
        $variants = [];
        
        // Áo thun nam basic
        if (str_contains(strtolower($product->title), 'áo thun')) {
            $variants = [
                ['color' => 'Trắng', 'size' => 'S', 'quantity' => 15, 'price' => 150000, 'sale_price' => 120000],
                ['color' => 'Trắng', 'size' => 'M', 'quantity' => 20, 'price' => 150000, 'sale_price' => 120000],
                ['color' => 'Trắng', 'size' => 'L', 'quantity' => 18, 'price' => 150000, 'sale_price' => 120000],
                ['color' => 'Đen', 'size' => 'S', 'quantity' => 12, 'price' => 150000, 'sale_price' => 120000],
                ['color' => 'Đen', 'size' => 'M', 'quantity' => 16, 'price' => 150000, 'sale_price' => 120000],
                ['color' => 'Đen', 'size' => 'L', 'quantity' => 14, 'price' => 150000, 'sale_price' => 120000],
                ['color' => 'Xanh', 'size' => 'S', 'quantity' => 10, 'price' => 150000, 'sale_price' => 120000],
                ['color' => 'Xanh', 'size' => 'M', 'quantity' => 13, 'price' => 150000, 'sale_price' => 120000],
            ];
        }
        // Quần jean nam
        elseif (str_contains(strtolower($product->title), 'quần jean')) {
            $variants = [
                ['color' => 'Xanh đậm', 'size' => '30', 'quantity' => 8, 'price' => 450000, 'sale_price' => 380000],
                ['color' => 'Xanh đậm', 'size' => '32', 'quantity' => 12, 'price' => 450000, 'sale_price' => 380000],
                ['color' => 'Xanh đậm', 'size' => '34', 'quantity' => 10, 'price' => 450000, 'sale_price' => 380000],
                ['color' => 'Xanh nhạt', 'size' => '30', 'quantity' => 6, 'price' => 450000, 'sale_price' => 380000],
                ['color' => 'Xanh nhạt', 'size' => '32', 'quantity' => 9, 'price' => 450000, 'sale_price' => 380000],
                ['color' => 'Xanh nhạt', 'size' => '34', 'quantity' => 7, 'price' => 450000, 'sale_price' => 380000],
            ];
        }
        // Giày sneaker
        elseif (str_contains(strtolower($product->title), 'giày sneaker')) {
            $variants = [
                ['color' => 'Trắng', 'size' => '39', 'quantity' => 15, 'price' => 350000, 'sale_price' => 0],
                ['color' => 'Trắng', 'size' => '40', 'quantity' => 18, 'price' => 350000, 'sale_price' => 0],
                ['color' => 'Trắng', 'size' => '41', 'quantity' => 16, 'price' => 350000, 'sale_price' => 0],
                ['color' => 'Trắng', 'size' => '42', 'quantity' => 14, 'price' => 350000, 'sale_price' => 0],
                ['color' => 'Đen', 'size' => '39', 'quantity' => 12, 'price' => 350000, 'sale_price' => 0],
                ['color' => 'Đen', 'size' => '40', 'quantity' => 15, 'price' => 350000, 'sale_price' => 0],
                ['color' => 'Đen', 'size' => '41', 'quantity' => 13, 'price' => 350000, 'sale_price' => 0],
                ['color' => 'Đen', 'size' => '42', 'quantity' => 11, 'price' => 350000, 'sale_price' => 0],
            ];
        }
        // Túi xách nữ
        elseif (str_contains(strtolower($product->title), 'túi xách')) {
            $variants = [
                ['color' => 'Đen', 'size' => 'M', 'quantity' => 10, 'price' => 280000, 'sale_price' => 220000],
                ['color' => 'Nâu', 'size' => 'M', 'quantity' => 8, 'price' => 280000, 'sale_price' => 220000],
                ['color' => 'Trắng', 'size' => 'M', 'quantity' => 6, 'price' => 280000, 'sale_price' => 220000],
            ];
        }
        // Đồng hồ nam
        elseif (str_contains(strtolower($product->title), 'đồng hồ')) {
            $variants = [
                ['color' => 'Đen', 'size' => '42mm', 'quantity' => 5, 'price' => 850000, 'sale_price' => 720000],
                ['color' => 'Nâu', 'size' => '42mm', 'quantity' => 4, 'price' => 850000, 'sale_price' => 720000],
                ['color' => 'Xanh', 'size' => '42mm', 'quantity' => 3, 'price' => 850000, 'sale_price' => 720000],
            ];
        }
        // Ví nữ mini
        elseif (str_contains(strtolower($product->title), 'ví nữ')) {
            $variants = [
                ['color' => 'Đen', 'size' => 'S', 'quantity' => 12, 'price' => 180000, 'sale_price' => 0],
                ['color' => 'Nâu', 'size' => 'S', 'quantity' => 10, 'price' => 180000, 'sale_price' => 0],
                ['color' => 'Hồng', 'size' => 'S', 'quantity' => 8, 'price' => 180000, 'sale_price' => 0],
            ];
        }
        // Mũ lưỡi trai
        elseif (str_contains(strtolower($product->title), 'mũ lưỡi trai')) {
            $variants = [
                ['color' => 'Đen', 'size' => 'M', 'quantity' => 20, 'price' => 120000, 'sale_price' => 95000],
                ['color' => 'Trắng', 'size' => 'M', 'quantity' => 18, 'price' => 120000, 'sale_price' => 95000],
                ['color' => 'Xanh', 'size' => 'M', 'quantity' => 15, 'price' => 120000, 'sale_price' => 95000],
                ['color' => 'Đỏ', 'size' => 'M', 'quantity' => 12, 'price' => 120000, 'sale_price' => 95000],
            ];
        }
        // Kính mát
        elseif (str_contains(strtolower($product->title), 'kính mát')) {
            $variants = [
                ['color' => 'Đen', 'size' => 'M', 'quantity' => 15, 'price' => 250000, 'sale_price' => 200000],
                ['color' => 'Nâu', 'size' => 'M', 'quantity' => 12, 'price' => 250000, 'sale_price' => 200000],
                ['color' => 'Xanh', 'size' => 'M', 'quantity' => 10, 'price' => 250000, 'sale_price' => 200000],
            ];
        }
        // Thắt lưng da
        elseif (str_contains(strtolower($product->title), 'thắt lưng')) {
            $variants = [
                ['color' => 'Đen', 'size' => 'M', 'quantity' => 8, 'price' => 320000, 'sale_price' => 280000],
                ['color' => 'Nâu', 'size' => 'M', 'quantity' => 6, 'price' => 320000, 'sale_price' => 280000],
                ['color' => 'Đen', 'size' => 'L', 'quantity' => 5, 'price' => 320000, 'sale_price' => 280000],
                ['color' => 'Nâu', 'size' => 'L', 'quantity' => 4, 'price' => 320000, 'sale_price' => 280000],
            ];
        }
        // Tất nam
        elseif (str_contains(strtolower($product->title), 'tất nam')) {
            $variants = [
                ['color' => 'Đen', 'size' => 'M', 'quantity' => 25, 'price' => 80000, 'sale_price' => 0],
                ['color' => 'Trắng', 'size' => 'M', 'quantity' => 22, 'price' => 80000, 'sale_price' => 0],
                ['color' => 'Xám', 'size' => 'M', 'quantity' => 18, 'price' => 80000, 'sale_price' => 0],
            ];
        }
        
        // Tạo variants cho sản phẩm
        foreach ($variants as $index => $variant) {
            ProductVariant::create([
                'product_id' => $product->id,
                'color' => $variant['color'],
                'size' => $variant['size'],
                'quantity' => $variant['quantity'],
                'price' => $variant['price'],
                'sale_price' => $variant['sale_price'],
                'sku' => 'PROD' . str_pad($productNumber, 3, '0', STR_PAD_LEFT) . '-' . 
                        strtoupper(substr($variant['color'], 0, 3)) . '-' . $variant['size'],
                'is_active' => true
            ]);
        }
    }
}
