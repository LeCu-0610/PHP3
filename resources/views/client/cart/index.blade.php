@extends('layouts.client')

@section('title', 'Giỏ hàng')

@section('content')
<style>
    .cart-container {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 3px 15px rgba(0,0,0,0.08);
        overflow: hidden;
        margin: 20px 0;
    }
    
    .cart-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        text-align: center;
    }
    
    .cart-header h2 {
        margin: 0;
        font-weight: 600;
        font-size: 1.4rem;
    }
    
    .cart-body {
        padding: 25px;
    }
    
    .cart-item {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }
    
    .cart-item:hover {
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .cart-item-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 6px;
    }
    
    .cart-item-title {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 5px;
        font-size: 1rem;
    }
    
    .cart-item-variant {
        font-size: 0.85rem;
        color: #6c757d;
        margin-bottom: 8px;
    }
    
    .cart-item-price {
        font-weight: bold;
        color: #e74c3c;
        font-size: 1.1rem;
    }
    
    .quantity-control {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .quantity-input {
        width: 60px;
        text-align: center;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        padding: 6px;
    }
    
    .btn-quantity {
        background: #6c757d;
        border: none;
        color: white;
        width: 30px;
        height: 30px;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .btn-quantity:hover {
        background: #5a6268;
    }
    
    .btn-remove {
        background: linear-gradient(45deg, #dc3545, #e74c3c);
        border: none;
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        transition: all 0.3s ease;
    }
    
    .btn-remove:hover {
        transform: translateY(-1px);
        color: white;
    }
    
    .cart-summary {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        border: 1px solid #e9ecef;
    }
    
    .summary-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size: 0.95rem;
    }
    
    .summary-total {
        border-top: 1px solid #dee2e6;
        padding-top: 10px;
        margin-top: 10px;
        font-weight: bold;
        font-size: 1.2rem;
        color: #e74c3c;
    }
    
    .btn-checkout {
        background: linear-gradient(45deg, #27ae60, #2ecc71);
        border: none;
        color: white;
        padding: 12px 30px;
        border-radius: 25px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        width: 100%;
        margin-top: 15px;
    }
    
    .btn-checkout:hover {
        transform: translateY(-1px);
        color: white;
    }
    
    .btn-clear {
        background: #6c757d;
        border: none;
        color: white;
        padding: 8px 20px;
        border-radius: 20px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }
    
    .btn-clear:hover {
        background: #5a6268;
        color: white;
    }
    
    .empty-cart {
        text-align: center;
        padding: 50px 20px;
        color: #6c757d;
    }
    
    .empty-cart i {
        font-size: 4rem;
        margin-bottom: 20px;
        color: #dee2e6;
    }
    
    .btn-continue-shopping {
        background: linear-gradient(45deg, #667eea, #764ba2);
        border: none;
        color: white;
        padding: 12px 25px;
        border-radius: 25px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        margin-top: 20px;
        transition: all 0.3s ease;
    }
    
    .btn-continue-shopping:hover {
        transform: translateY(-1px);
        color: white;
    }
</style>

<div class="container-fluid">
    <div class="cart-container">
        <div class="cart-header">
            <h2><i class="fas fa-shopping-cart me-2"></i>Giỏ hàng của bạn</h2>
        </div>

        <div class="cart-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($cartItems->count() > 0)
                <div class="row">
                    <div class="col-lg-8">
                        @foreach($cartItems as $item)
                            <div class="cart-item">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        @if($item->product->thumbnail)
                                            <img src="{{ asset('storage/' . $item->product->thumbnail) }}" 
                                                 class="cart-item-image" 
                                                 alt="{{ $item->product->title }}">
                                        @else
                                            <div class="cart-item-image bg-light d-flex align-items-center justify-content-center">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="cart-item-title">{{ $item->product->title }}</div>
                                        @if($item->variant_info)
                                            <div class="cart-item-variant">{{ $item->variant_info }}</div>
                                        @endif
                                        <div class="cart-item-price">{{ number_format($item->price, 0, ',', '.') }}đ</div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="quantity-control">
                                            <button class="btn-quantity" onclick="updateQuantity({{ $item->id }}, -1)">-</button>
                                            <input type="number" class="quantity-input" value="{{ $item->quantity }}" 
                                                   min="1" onchange="updateQuantity({{ $item->id }}, this.value, true)">
                                            <button class="btn-quantity" onclick="updateQuantity({{ $item->id }}, 1)">+</button>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <div class="cart-item-price">{{ number_format($item->subtotal, 0, ',', '.') }}đ</div>
                                    </div>
                                    
                                    <div class="col-md-1">
                                        <a href="{{ route('client.cart.remove', $item->id) }}" 
                                           class="btn btn-remove"
                                           onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                        <div class="text-end mt-3">
                            <a href="{{ route('client.cart.clear') }}" 
                               class="btn btn-clear"
                               onclick="return confirm('Bạn có chắc muốn xóa tất cả sản phẩm?')">
                                <i class="fas fa-trash me-2"></i>Xóa tất cả
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="cart-summary">
                            <h5 class="mb-3">Tóm tắt đơn hàng</h5>
                            
                            <div class="summary-item">
                                <span>Tạm tính:</span>
                                <span>{{ number_format($total, 0, ',', '.') }}đ</span>
                            </div>
                            
                            <div class="summary-item">
                                <span>Phí vận chuyển:</span>
                                <span>Miễn phí</span>
                            </div>
                            
                            <div class="summary-item summary-total">
                                <span>Tổng cộng:</span>
                                <span>{{ number_format($total, 0, ',', '.') }}đ</span>
                            </div>
                            
                            <a href="{{ route('client.checkout.index') }}" class="btn btn-checkout">
                                <i class="fas fa-credit-card me-2"></i>Tiến hành thanh toán
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="empty-cart">
                    <i class="fas fa-shopping-cart"></i>
                    <h4>Giỏ hàng trống</h4>
                    <p>Bạn chưa có sản phẩm nào trong giỏ hàng.</p>
                    <a href="{{ route('client.product') }}" class="btn btn-continue-shopping">
                        <i class="fas fa-shopping-bag me-2"></i>Tiếp tục mua sắm
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    function updateQuantity(itemId, change, isDirectInput = false) {
        let quantity;
        
        if (isDirectInput) {
            quantity = parseInt(change);
        } else {
            const input = document.querySelector(`input[onchange*="${itemId}"]`);
            quantity = parseInt(input.value) + parseInt(change);
        }
        
        if (quantity < 1) quantity = 1;
        
        fetch(`/cart/${itemId}/update`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ quantity: quantity })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'Có lỗi xảy ra!');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra!');
        });
    }
</script>
@endsection
