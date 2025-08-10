@extends('layouts.admin')
@section('title', 'Quản lý Đơn hàng')

@section('content')
<style>
    .order-card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        margin-bottom: 20px;
        overflow: hidden;
    }
    
    .order-header {
        background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .order-number {
        font-size: 1.1rem;
        font-weight: bold;
    }
    
    .order-date {
        font-size: 0.9rem;
        opacity: 0.9;
    }
    
    .order-body {
        padding: 20px;
    }
    
    .order-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-bottom: 20px;
    }
    
    .info-item {
        background: #f8f9fa;
        padding: 12px;
        border-radius: 6px;
    }
    
    .info-label {
        font-weight: bold;
        color: #495057;
        font-size: 0.85rem;
        margin-bottom: 5px;
    }
    
    .info-value {
        color: #212529;
        font-size: 0.95rem;
    }
    
    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: bold;
        text-transform: uppercase;
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
    
    .order-items {
        background: #f8f9fa;
        border-radius: 6px;
        padding: 15px;
        margin-bottom: 20px;
    }
    
    .item-row {
        display: flex;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #dee2e6;
    }
    
    .item-row:last-child {
        border-bottom: none;
    }
    
    .item-image {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 4px;
        margin-right: 15px;
    }
    
    .item-info {
        flex: 1;
    }
    
    .item-title {
        font-weight: bold;
        color: #212529;
        margin-bottom: 2px;
    }
    
    .item-variant {
        font-size: 0.85rem;
        color: #6c757d;
    }
    
    .item-price {
        font-weight: bold;
        color: #e74c3c;
    }
    
    .order-total {
        background: #e9ecef;
        padding: 15px;
        border-radius: 6px;
        text-align: right;
        font-size: 1.1rem;
        font-weight: bold;
        color: #212529;
    }
    
    .order-actions {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }
    
    .btn-view {
        background: linear-gradient(45deg, #007bff 0%, #0056b3 100%);
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }
    
    .btn-view:hover {
        transform: translateY(-1px);
        color: white;
        text-decoration: none;
    }
    
    .btn-update {
        background: linear-gradient(45deg, #28a745 0%, #1e7e34 100%);
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }
    
    .btn-update:hover {
        transform: translateY(-1px);
    }
    
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #6c757d;
    }
    
    .empty-state i {
        font-size: 4rem;
        margin-bottom: 20px;
        opacity: 0.5;
    }
    
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 30px;
    }
</style>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-shopping-cart"></i> Quản lý Đơn hàng</h2>
        <div class="d-flex align-items-center">
            <span class="badge bg-primary me-2">{{ $orders->total() }} đơn hàng</span>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($orders->count() > 0)
        @foreach($orders as $order)
            <div class="order-card">
                <div class="order-header">
                    <div>
                        <div class="order-number">#{{ $order->order_number }}</div>
                        <div class="order-date">{{ $order->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                    <div class="d-flex align-items-center">
                        <span class="status-badge status-{{ $order->status }}">
                            {{ $order->status_text }}
                        </span>
                    </div>
                </div>
                
                <div class="order-body">
                    <div class="order-info">
                        <div class="info-item">
                            <div class="info-label">Khách hàng</div>
                            <div class="info-value">{{ $order->user->name }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Email</div>
                            <div class="info-value">{{ $order->user->email }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Số điện thoại</div>
                            <div class="info-value">{{ $order->phone ?? 'N/A' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Địa chỉ giao hàng</div>
                            <div class="info-value">{{ $order->shipping_address }}</div>
                        </div>
                    </div>
                    
                    <div class="order-items">
                        <h6 class="mb-3">Sản phẩm đã đặt:</h6>
                        @foreach($order->orderDetails as $detail)
                            <div class="item-row">
                                <img src="{{ $detail->product->thumbnail ? asset('storage/' . $detail->product->thumbnail) : asset('images/no-image.png') }}" 
                                     alt="{{ $detail->product->title }}" 
                                     class="item-image">
                                <div class="item-info">
                                    <div class="item-title">{{ $detail->product->title }}</div>
                                    @if($detail->variant)
                                        <div class="item-variant">
                                            Màu: {{ $detail->variant->color }}, 
                                            Size: {{ $detail->variant->size }}
                                        </div>
                                    @endif
                                </div>
                                <div class="item-price">
                                    {{ number_format($detail->price, 0, ',', '.') }}đ x {{ $detail->quantity }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="order-total">
                        Tổng cộng: {{ number_format($order->total_amount, 0, ',', '.') }}đ
                    </div>
                    
                    <div class="order-actions">
                        <a href="{{ route('admin.order.show', $order->id) }}" class="btn-view">
                            <i class="fas fa-eye"></i> Xem chi tiết
                        </a>
                        
                        <form action="{{ route('admin.order.update-status', $order->id) }}" method="POST" class="d-inline">
                            @csrf
                            <select name="status" class="form-select form-select-sm d-inline-block me-2" style="width: auto;">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Đã giao hàng</option>
                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Đã nhận hàng</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                            </select>
                            <button type="submit" class="btn-update">
                                <i class="fas fa-save"></i> Cập nhật
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        
        <div class="pagination-wrapper">
            {{ $orders->links() }}
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-shopping-cart"></i>
            <h4>Chưa có đơn hàng nào</h4>
            <p>Khi có khách hàng đặt hàng, đơn hàng sẽ hiển thị ở đây.</p>
        </div>
    @endif
</div>
@endsection
