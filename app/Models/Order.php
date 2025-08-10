<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        'status',
        'shipping_address',
        'billing_address',
        'phone',
        'note'
    ];

    protected $casts = [
        'total_amount' => 'decimal:0',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function getStatusTextAttribute()
    {
        $statuses = [
            'pending' => 'Chờ xử lý',
            'processing' => 'Đang xử lý',
            'shipped' => 'Đã giao hàng',
            'delivered' => 'Đã nhận hàng',
            'cancelled' => 'Đã hủy',
        ];

        return $statuses[$this->status] ?? $this->status;
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'bg-warning',
            'processing' => 'bg-info',
            'shipped' => 'bg-primary',
            'delivered' => 'bg-success',
            'cancelled' => 'bg-danger',
        ];

        return $badges[$this->status] ?? 'bg-secondary';
    }
}
