@extends('layouts.client')

@section('title', 'Thanh toán')

@section('content')
<style>
    .checkout-container {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 3px 15px rgba(0,0,0,0.08);
        overflow: hidden;
        margin: 20px 0;
    }
    
    .checkout-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        text-align: center;
    }
    
    .checkout-header h2 {
        margin: 0;
        font-weight: 600;
        font-size: 1.4rem;
    }
    
    .checkout-body {
        padding: 25px;
    }
    
    .form-section {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        border-left: 3px solid #667eea;
    }
    
    .form-section h5 {
        color: #2c3e50;
        margin-bottom: 15px;
        font-weight: 600;
        font-size: 1.1rem;
    }
    
    .form-control, .form-select {
        border-radius: 6px;
        border: 1px solid #e9ecef;
        padding: 10px 12px;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.15rem rgba(102, 126, 234, 0.25);
    }
    
    .form-label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 8px;
        font-size: 0.95rem;
    }
    
    .order-summary {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        border: 1px solid #e9ecef;
    }
    
    .order-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #e9ecef;
    }
    
    .order-item:last-child {
        border-bottom: none;
    }
    
    .order-item-image {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 4px;
    }
    
    .order-item-info {
        flex: 1;
        margin-left: 15px;
    }
    
    .order-item-title {
        font-weight: 600;
        color: #2c3e50;
        font-size: 0.9rem;
        margin-bottom: 3px;
    }
    
    .order-item-variant {
        font-size: 0.8rem;
        color: #6c757d;
        margin-bottom: 3px;
    }
    
    .order-item-price {
        font-weight: bold;
        color: #e74c3c;
        font-size: 0.9rem;
    }
    
    .summary-total {
        border-top: 2px solid #dee2e6;
        padding-top: 15px;
        margin-top: 15px;
        font-weight: bold;
        font-size: 1.3rem;
        color: #e74c3c;
    }
    
    .btn-place-order {
        background: linear-gradient(45deg, #27ae60, #2ecc71);
        border: none;
        color: white;
        padding: 15px 30px;
        border-radius: 25px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        width: 100%;
        margin-top: 20px;
    }
    
    .btn-place-order:hover {
        transform: translateY(-1px);
        color: white;
    }
    
    .btn-back {
        background: #6c757d;
        border: none;
        color: white;
        padding: 10px 20px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        margin-bottom: 20px;
    }
    
    .btn-back:hover {
        background: #5a6268;
        color: white;
    }
</style>

<div class="container-fluid">
    <a href="{{ route('client.cart.index') }}" class="btn btn-back">
        <i class="fas fa-arrow-left me-2"></i>Quay lại giỏ hàng
    </a>

    <div class="checkout-container">
        <div class="checkout-header">
            <h2><i class="fas fa-credit-card me-2"></i>Thanh toán đơn hàng</h2>
        </div>

        <div class="checkout-body">
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('client.checkout.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Thông tin giao hàng -->
                        <div class="form-section">
                            <h5><i class="fas fa-shipping-fast me-2"></i>Thông tin giao hàng</h5>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="shipping_address" class="form-label">Địa chỉ giao hàng</label>
                                        <textarea class="form-control" name="shipping_address" id="shipping_address" 
                                                  rows="3" required placeholder="Nhập địa chỉ giao hàng chi tiết">{{ old('shipping_address') }}</textarea>
                                        @error('shipping_address')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Số điện thoại</label>
                                        <input type="text" class="form-control" name="phone" id="phone" 
                                               value="{{ old('phone', Auth::user()->phone) }}" required placeholder="Nhập số điện thoại">
                                        @error('phone')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Thông tin thanh toán -->
                        <div class="form-section">
                            <h5><i class="fas fa-credit-card me-2"></i>Thông tin thanh toán</h5>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="billing_address" class="form-label">Địa chỉ thanh toán</label>
                                        <textarea class="form-control" name="billing_address" id="billing_address" 
                                                  rows="3" required placeholder="Nhập địa chỉ thanh toán">{{ old('billing_address') }}</textarea>
                                        @error('billing_address')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="note" class="form-label">Ghi chú</label>
                                        <textarea class="form-control" name="note" id="note" 
                                                  rows="3" placeholder="Ghi chú thêm cho đơn hàng">{{ old('note') }}</textarea>
                                        @error('note')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Phương thức thanh toán -->
                        <div class="form-section">
                            <h5><i class="fas fa-money-bill-wave me-2"></i>Phương thức thanh toán</h5>
                            
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
                                <label class="form-check-label" for="cod">
                                    <i class="fas fa-money-bill me-2"></i>Thanh toán khi nhận hàng (COD)
                                </label>
                            </div>
                            
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="bank" value="bank">
                                <label class="form-check-label" for="bank">
                                    <i class="fas fa-university me-2"></i>Chuyển khoản ngân hàng
                                </label>
                            </div>
                            
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="momo" value="momo">
                                <label class="form-check-label" for="momo">
                                    <i class="fas fa-mobile-alt me-2"></i>Ví MoMo
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="order-summary">
                            <h5 class="mb-3">Tóm tắt đơn hàng</h5>
                            
                            @foreach($cartItems as $item)
                                <div class="order-item">
                                    <div class="d-flex align-items-center">
                                        @if($item->product->thumbnail)
                                            <img src="{{ asset('storage/' . $item->product->thumbnail) }}" 
                                                 class="order-item-image" 
                                                 alt="{{ $item->product->title }}">
                                        @else
                                            <div class="order-item-image bg-light d-flex align-items-center justify-content-center">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        @endif
                                        
                                        <div class="order-item-info">
                                            <div class="order-item-title">{{ $item->product->title }}</div>
                                            @if($item->variant_info)
                                                <div class="order-item-variant">{{ $item->variant_info }}</div>
                                            @endif
                                            <div class="order-item-variant">Số lượng: {{ $item->quantity }}</div>
                                        </div>
                                    </div>
                                    
                                    <div class="order-item-price">
                                        {{ number_format($item->subtotal, 0, ',', '.') }}đ
                                    </div>
                                </div>
                            @endforeach
                            
                            <div class="order-item summary-total">
                                <span>Tổng cộng:</span>
                                <span>{{ number_format($total, 0, ',', '.') }}đ</span>
                            </div>
                            
                            <button type="submit" class="btn btn-place-order">
                                <i class="fas fa-check me-2"></i>Đặt hàng ngay
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Auto-fill billing address with shipping address
    document.getElementById('shipping_address').addEventListener('input', function() {
        document.getElementById('billing_address').value = this.value;
    });
</script>
@endsection
