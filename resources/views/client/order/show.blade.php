@extends('layouts.client')

@section('title', 'Chi tiết đơn hàng')

@section('content')
<style>
    .order-detail-container {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 3px 15px rgba(0,0,0,0.08);
        overflow: hidden;
        margin: 20px 0;
    }
    
    .order-detail-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        text-align: center;
    }
    
    .order-detail-header h2 {
        margin: 0;
        font-weight: 600;
        font-size: 1.4rem;
    }
    
    .order-detail-body {
        padding: 25px;
    }
    
    .order-info-section {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        border-left: 3px solid #667eea;
    }
    
    .order-info-section h5 {
        color: #2c3e50;
        margin-bottom: 15px;
        font-weight: 600;
        font-size: 1.1rem;
    }
    
    .info-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        padding: 8px 0;
        border-bottom: 1px solid #e9ecef;
    }
    
    .info-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }
    
    .info-label {
        font-weight: 600;
        color: #2c3e50;
    }
    
    .info-value {
        color: #6c757d;
    }
    
    .order-status-badge {
        display: inline-block;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
    }
    
    .order-items {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }
    
    .order-item {
        display: flex;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid #e9ecef;
    }
    
    .order-item:last-child {
        border-bottom: none;
    }
    
    .order-item-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 6px;
        margin-right: 15px;
    }
    
    .order-item-info {
        flex: 1;
    }
    
    .order-item-title {
        font-weight: 600;
        color: #2c3e50;
        font-size: 1rem;
        margin-bottom: 5px;
    }
    
    .order-item-variant {
        font-size: 0.85rem;
        color: #6c757d;
        margin-bottom: 5px;
    }
    
    .order-item-quantity {
        font-size: 0.85rem;
        color: #6c757d;
    }
    
    .order-item-price {
        font-weight: bold;
        color: #e74c3c;
        font-size: 1.1rem;
        text-align: right;
    }
    
    .order-summary {
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
        border-top: 2px solid #dee2e6;
        padding-top: 15px;
        margin-top: 15px;
        font-weight: bold;
        font-size: 1.3rem;
        color: #e74c3c;
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
    
    .btn-cancel {
        background: linear-gradient(45deg, #dc3545, #e74c3c);
        border: none;
        color: white;
        padding: 10px 20px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        margin-left: 10px;
    }
    
    .btn-cancel:hover {
        transform: translateY(-1px);
        color: white;
    }
</style>

<div class="container-fluid">
    <a href="{{ route('client.order.index') }}" class="btn btn-back">
        <i class="fas fa-arrow-left me-2"></i>Quay lại danh sách đơn hàng
    </a>

    <div class="order-detail-container">
        <div class="order-detail-header">
            <h2><i class="fas fa-receipt me-2"></i>Chi tiết đơn hàng</h2>
        </div>

        <div class="order-detail-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-lg-8">
                    <!-- Thông tin đơn hàng -->
                    <div class="order-info-section">
                        <h5><i class="fas fa-info-circle me-2"></i>Thông tin đơn hàng</h5>
                        
                        <div class="info-item">
                            <span class="info-label">Mã đơn hàng:</span>
                            <span class="info-value">{{ $order->order_number }}</span>
                        </div>
                        
                        <div class="info-item">
                            <span class="info-label">Ngày đặt:</span>
                            <span class="info-value">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        
                        <div class="info-item">
                            <span class="info-label">Trạng thái:</span>
                            <span class="order-status-badge {{ $order->status_badge }}">
                                {{ $order->status_text }}
                            </span>
                        </div>
                        
                        @if($order->note)
                            <div class="info-item">
                                <span class="info-label">Ghi chú:</span>
                                <span class="info-value">{{ $order->note }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Thông tin giao hàng -->
                    <div class="order-info-section">
                        <h5><i class="fas fa-shipping-fast me-2"></i>Thông tin giao hàng</h5>
                        
                        <div class="info-item">
                            <span class="info-label">Địa chỉ giao hàng:</span>
                            <span class="info-value">{{ $order->shipping_address }}</span>
                        </div>
                        
                        <div class="info-item">
                            <span class="info-label">Số điện thoại:</span>
                            <span class="info-value">{{ $order->phone }}</span>
                        </div>
                        
                        <div class="info-item">
                            <span class="info-label">Địa chỉ thanh toán:</span>
                            <span class="info-value">{{ $order->billing_address }}</span>
                        </div>
                    </div>

                    <!-- Danh sách sản phẩm -->
                    <div class="order-items">
                        <h5 class="mb-3"><i class="fas fa-shopping-cart me-2"></i>Sản phẩm đã đặt</h5>
                        
                        @foreach($order->orderDetails as $item)
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
                                        <div class="order-item-quantity">Số lượng: {{ $item->quantity }}</div>
                                    </div>
                                </div>
                                
                                <div class="order-item-price">
                                    {{ number_format($item->subtotal, 0, ',', '.') }}đ
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="order-summary">
                        <h5 class="mb-3">Tóm tắt đơn hàng</h5>
                        
                        <div class="summary-item">
                            <span>Tạm tính:</span>
                            <span>{{ number_format($order->total_amount, 0, ',', '.') }}đ</span>
                        </div>
                        
                        <div class="summary-item">
                            <span>Phí vận chuyển:</span>
                            <span>Miễn phí</span>
                        </div>
                        
                        <div class="summary-item summary-total">
                            <span>Tổng cộng:</span>
                            <span>{{ number_format($order->total_amount, 0, ',', '.') }}đ</span>
                        </div>
                        
                        @if($order->status === 'pending')
                            <a href="{{ route('client.order.cancel', $order->id) }}" 
                               class="btn btn-cancel w-100"
                               onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này?')">
                                <i class="fas fa-times me-2"></i>Hủy đơn hàng
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
