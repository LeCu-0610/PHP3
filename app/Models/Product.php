<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    // Tên bảng trong database (có thể bỏ nếu đúng quy ước Laravel)
    protected $table = 'products';

    // Khóa chính
    protected $primaryKey = 'id';

    // Cho phép gán tự động
    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'price',
        'sale_price',
        'thumbnail',
        'status',
        'category_id',
    ];

    // Giá trị mặc định
    protected $attributes = [
        'status' => 0,
        'sale_price' => 0,
        'thumbnail' => '',
    ];

    // Cast kiểu dữ liệu
    protected $casts = [
        'price' => 'float',
        'sale_price' => 'float',
        'status' => 'integer',
        'category_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Quan hệ với bảng categories (nếu có)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    // Quan hệ với comments
    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class);
    }
    
    // Quan hệ với order details
    public function orderDetails()
    {
        return $this->hasMany(\App\Models\OrderDetail::class);
    }
    
    // Quan hệ với cart items
    public function cartItems()
    {
        return $this->hasMany(\App\Models\Cart::class);
    }
    
    // Quan hệ với product variants
    public function variants()
    {
        return $this->hasMany(\App\Models\ProductVariant::class);
    }
    
    // Quan hệ với active variants
    public function activeVariants()
    {
        return $this->hasMany(\App\Models\ProductVariant::class)->where('is_active', true);
    }
    
    // Lấy giá thấp nhất từ các variants
    public function getMinPriceAttribute()
    {
        return $this->variants()->min('price');
    }
    
    // Lấy giá cao nhất từ các variants
    public function getMaxPriceAttribute()
    {
        return $this->variants()->max('price');
    }
    
    // Kiểm tra xem sản phẩm có variants không
    public function hasVariants()
    {
        return $this->variants()->count() > 0;
    }
}
