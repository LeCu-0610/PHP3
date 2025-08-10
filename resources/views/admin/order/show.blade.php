@extends('layouts.admin')
@section('title', 'Chi tiết Đơn hàng #' . $order->order_number)

@section('content')
<style>
    .order-detail-container {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 3px 15px rgba(0,0,0,0.08);
        overflow: hidden;
        margin: 20px 0;
    }
    
    .order-header {
        background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 25px;
        text-align: center;
    }
    
    .order-number {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 10px;
    }
    
    .order-date {
        font-size: 1.1rem;
        opacity: 0.9;
    }
    
    .order-body {
        padding: 30px;
    }
    
    .section-title {
        font-size: 1.3rem;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 20px;
        border-bottom: 2px solid #e9ecef;
        padding-bottom: 10px;
    }
    
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .info-card {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        border-left: 4px solid #667eea;
    }
    
    .info-label {
        font-weight: bold;
        color: #495057;
        font-size: 0.9rem;
        margin-bottom: 8px;
        text-transform: uppercase;
    }
    
    .info-value {
        color: #212529;
        font-size: 1rem;
    }
    
    .status-badge {
        padding: 8px 16px;
        border-radius: 25px;
        font-size: 0.9rem;
        font-weight: bold;
        text-transform: uppercase;
        display: inline-block;
    }
    
    .status-pending {
        background: #fff3cd;
        color: #856404;
    }
    
    .status-processing {
        background: #cce5ff;
        color: #004085;
    }
    
    .status-shipped {
        background: #d1ecf1;
        color: #0c5460;
    }
    
    .status-delivered {
        background: #d4edda;
        color: #155724;
    }
    
    .status-cancelled {
        background: #f8d7da;
        color: #721c24;
    }
    
    .products-section {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 25px;
        margin-bottom: 30px;
    }
    
    .product-item {
        display: flex;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid #dee2e6;
    }
    
    .product-item:last-child {
        border-bottom: none;
    }
    
    .product-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        margin-right: 20px;
    }
    
    .product-info {
        flex: 1;
    }
    
    .product-title {
        font-weight: bold;
        color: #212529;
        font-size: 1.1rem;
        margin-bottom: 5px;
    }
    
    .product-variant {
        font-size: 0.9rem;
        color: #6c757d;
        margin-bottom: 5px;
    }
    
    .product-price {
        font-weight: bold;
        color: #e74c3c;
        font-size: 1rem;
    }
    
    .product-quantity {
        background: #e9ecef;
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 0.9rem;
        color: #495057;
        margin-left: 15px;
    }
    
    .order-summary {
        background: #e9ecef;
        padding: 25px;
        border-radius: 8px;
        text-align: right;
    }
    
    .total-amount {
        font-size: 1.5rem;
        font-weight: bold;
        color: #212529;
    }
    
    .action-buttons {
        display: flex;
        gap: 15px;
        margin-top: 30px;
        justify-content: center;
    }
    
    .btn-back {
        background: linear-gradient(45deg, #6c757d 0%, #495057 100%);
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 1rem;
        transition: all 0.3s ease;
    }
    
    .btn-back:hover {
        transform: translateY(-2px);
        color: white;
        text-decoration: none;
    }
    
    .btn-update {
        background: linear-gradient(45deg, #28a745 0%, #1e7e34 100%);
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 6px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }
    
    .btn-update:hover {
        transform: translateY(-2px);
    }
    
    .note-section {
        background: #fff3cd;
        border: 1px solid #ffeaa7;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
    }
    
    .note-label {
        font-weight: bold;
        color: #856404;
        margin-bottom: 5px;
    }
    
    .note-content {
        color: #856404;
        font-style: italic;
    }
</style>

<div class="container-fluid">
    <div class="order-detail-container">
        <div class="order-header">
            <div class="order-number">#{{ $order->order_number }}</div>
            <div class="order-date">{{ $order->created_at->format('d/m/Y H:i') }}</div>
        </div>
        
        <div class="order-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            <div class="section-title">
                <i class="fas fa-info-circle"></i> Thông tin đơn hàng
            </div>
            
            <div class="info-grid">
                <div class="info-card">
                    <div class="info-label">Trạng thái</div>
                    <div class="info-value">
                        <span class="status-badge status-{{ $order->status }}">
                            {{ $order->status_text }}
                        </span>
                    </div>
                </div>
                
                <div class="info-card">
                    <div class="info-label">Khách hàng</div>
                    <div class="info-value">{{ $order->user->name }}</div>
                </div>
                
                <div class="info-card">
                    <div class="info-label">Email</div>
                    <div class="info-value">{{ $order->user->email }}</div>
                </div>
                
                <div class="info-card">
                    <div class="info-label">Số điện thoại</div>
                    <div class="info-value">{{ $order->phone ?? 'N/A' }}</div>
                </div>
            </div>
            
            <div class="section-title">
                <i class="fas fa-map-marker-alt"></i> Địa chỉ giao hàng
            </div>
            
            <div class="info-card">
                <div class="info-value">{{ $order->shipping_address }}</div>
            </div>
            
            @if($order->note)
                <div class="note-section">
                    <div class="note-label">Ghi chú:</div>
                    <div class="note-content">{{ $order->note }}</div>
                </div>
            @endif
            
            <div class="section-title">
                <i class="fas fa-shopping-bag"></i> Sản phẩm đã đặt
            </div>
            
            <div class="products-section">
                @foreach($order->orderDetails as $detail)
                    <div class="product-item">
                        <img src="{{ $detail->product->thumbnail ? asset('storage/' . $detail->product->thumbnail) : asset('images/no-image.png') }}" 
                             alt="{{ $detail->product->title }}" 
                             class="product-image">
                        <div class="product-info">
                            <div class="product-title">{{ $detail->product->title }}</div>
                            @if($detail->variant)
                                <div class="product-variant">
                                    Màu: {{ $detail->variant->color }}, 
                                    Size: {{ $detail->variant->size }}
                                </div>
                            @endif
                            <div class="product-price">
                                {{ number_format($detail->price, 0, ',', '.') }}đ
                            </div>
                        </div>
                        <div class="product-quantity">
                            Số lượng: {{ $detail->quantity }}
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="order-summary">
                <div class="total-amount">
                    Tổng cộng: {{ number_format($order->total_amount, 0, ',', '.') }}đ
                </div>
            </div>
            
            <div class="action-buttons">
                <a href="{{ route('admin.order.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
                
                <form action="{{ route('admin.order.update-status', $order->id) }}" method="POST" class="d-inline">
                    @csrf
                    <select name="status" class="form-select d-inline-block me-3" style="width: auto;">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Đã giao hàng</option>
                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Đã nhận hàng</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                    </select>
                    <button type="submit" class="btn-update">
                        <i class="fas fa-save"></i> Cập nhật trạng thái
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
