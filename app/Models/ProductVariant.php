<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id',
        'color',
        'size',
        'quantity',
        'price',
        'sale_price',
        'sku',
        'image',
        'is_active'
    ];

    protected $casts = [
        'price' => 'float',
        'sale_price' => 'float',
        'quantity' => 'integer',
        'is_active' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getFinalPriceAttribute()
    {
        return $this->sale_price > 0 ? $this->sale_price : $this->price;
    }

    public function getDiscountPercentageAttribute()
    {
        if ($this->sale_price > 0 && $this->price > 0) {
            return round((($this->price - $this->sale_price) / $this->price) * 100);
        }
        return 0;
    }

    public function isInStock()
    {
        return $this->quantity > 0;
    }
}
