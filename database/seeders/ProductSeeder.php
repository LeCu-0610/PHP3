<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        
        if ($categories->count() > 0) {
            $category = $categories->first();
            
            $products = [
                [
                    'title' => 'Áo thun nam basic',
                    'slug' => 'ao-thun-nam-basic',
                    'description' => 'Áo thun nam chất liệu cotton 100%, thoáng mát, dễ mặc',
                    'content' => 'Áo thun nam basic với thiết kế đơn giản, phù hợp với mọi lứa tuổi. Chất liệu cotton 100% mềm mại, thoáng mát, không gây kích ứng da.',
                    'price' => 150000,
                    'sale_price' => 120000,
                    'category_id' => $category->id,
                    'status' => 1
                ],
                [
                    'title' => 'Quần jean nam slim fit',
                    'slug' => 'quan-jean-nam-slim-fit',
                    'description' => 'Quần jean nam slim fit thời trang, chất liệu denim cao cấp',
                    'content' => 'Quần jean nam slim fit với thiết kế ôm dáng, tôn vóc dáng. Chất liệu denim cao cấp, bền bỉ, không bị phai màu.',
                    'price' => 450000,
                    'sale_price' => 380000,
                    'category_id' => $category->id,
                    'status' => 1
                ],
                [
                    'title' => 'Giày sneaker unisex',
                    'slug' => 'giay-sneaker-unisex',
                    'description' => 'Giày sneaker unisex thời trang, phù hợp mọi lứa tuổi',
                    'content' => 'Giày sneaker unisex với thiết kế hiện đại, phù hợp với mọi phong cách. Đế cao su bền bỉ, đệm lót êm ái.',
                    'price' => 350000,
                    'sale_price' => 0,
                    'category_id' => $category->id,
                    'status' => 1
                ],
                [
                    'title' => 'Túi xách nữ thời trang',
                    'slug' => 'tui-xach-nu-thoi-trang',
                    'description' => 'Túi xách nữ thời trang, chất liệu da tổng hợp cao cấp',
                    'content' => 'Túi xách nữ với thiết kế sang trọng, phù hợp với mọi dịp. Chất liệu da tổng hợp cao cấp, bền đẹp.',
                    'price' => 280000,
                    'sale_price' => 220000,
                    'category_id' => $category->id,
                    'status' => 1
                ],
                [
                    'title' => 'Đồng hồ nam dây da',
                    'slug' => 'dong-ho-nam-day-da',
                    'description' => 'Đồng hồ nam dây da thời trang, máy quartz chính xác',
                    'content' => 'Đồng hồ nam với thiết kế cổ điển, dây da mềm mại. Máy quartz chính xác, mặt kính chống xước.',
                    'price' => 850000,
                    'sale_price' => 720000,
                    'category_id' => $category->id,
                    'status' => 1
                ],
                [
                    'title' => 'Ví nữ mini cầm tay',
                    'slug' => 'vi-nu-mini-cam-tay',
                    'description' => 'Ví nữ mini cầm tay thời trang, nhiều ngăn tiện lợi',
                    'content' => 'Ví nữ mini với thiết kế nhỏ gọn, nhiều ngăn tiện lợi. Chất liệu da tổng hợp, bền đẹp.',
                    'price' => 180000,
                    'sale_price' => 0,
                    'category_id' => $category->id,
                    'status' => 1
                ],
                [
                    'title' => 'Mũ lưỡi trai nam',
                    'slug' => 'mu-luoi-trai-nam',
                    'description' => 'Mũ lưỡi trai nam thời trang, chất liệu cotton thoáng mát',
                    'content' => 'Mũ lưỡi trai nam với thiết kế đơn giản, phù hợp với mọi phong cách. Chất liệu cotton thoáng mát.',
                    'price' => 120000,
                    'sale_price' => 95000,
                    'category_id' => $category->id,
                    'status' => 1
                ],
                [
                    'title' => 'Kính mát unisex',
                    'slug' => 'kinh-mat-unisex',
                    'description' => 'Kính mát unisex thời trang, chống tia UV hiệu quả',
                    'content' => 'Kính mát unisex với thiết kế hiện đại, chống tia UV hiệu quả. Gọng kính nhẹ, bền bỉ.',
                    'price' => 250000,
                    'sale_price' => 200000,
                    'category_id' => $category->id,
                    'status' => 1
                ],
                [
                    'title' => 'Thắt lưng da nam',
                    'slug' => 'that-lung-da-nam',
                    'description' => 'Thắt lưng da nam thời trang, chất liệu da thật cao cấp',
                    'content' => 'Thắt lưng da nam với thiết kế sang trọng, chất liệu da thật cao cấp. Khóa kim loại bền bỉ.',
                    'price' => 320000,
                    'sale_price' => 280000,
                    'category_id' => $category->id,
                    'status' => 1
                ],
                [
                    'title' => 'Tất nam cotton',
                    'slug' => 'tat-nam-cotton',
                    'description' => 'Tất nam cotton thoáng mát, 3 đôi/hộp',
                    'content' => 'Tất nam cotton với chất liệu mềm mại, thoáng mát. Thiết kế ôm chân, không bị tuột.',
                    'price' => 80000,
                    'sale_price' => 0,
                    'category_id' => $category->id,
                    'status' => 1
                ]
            ];
            
            foreach ($products as $productData) {
                Product::create($productData);
            }
        }
    }
}
