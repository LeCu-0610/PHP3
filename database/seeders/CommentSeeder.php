<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Product;
use App\Models\User;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();
        $users = User::all();
        
        if ($products->count() > 0 && $users->count() > 0) {
            $product = $products->first();
            $user = $users->first();
            
            Comment::create([
                'product_id' => $product->id,
                'user_id' => $user->id,
                'content' => 'Sản phẩm rất tốt!',
                'rating' => 5,
                'status' => 1
            ]);
            
            Comment::create([
                'product_id' => $product->id,
                'user_id' => $user->id,
                'content' => 'Chất lượng tốt, giá cả hợp lý',
                'rating' => 4,
                'status' => 1
            ]);
        }
    }
}
