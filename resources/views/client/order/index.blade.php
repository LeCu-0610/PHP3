@extends('layouts.client')

@section('title', 'Đơn hàng của tôi')

@section('content')
<style>
    .order-container {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 3px 15px rgba(0,0,0,0.08);
        overflow: hidden;
        margin: 20px 0;
    }
    
    .order-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        text-align: center;
    }
    
    .order-header h2 {
        margin: 0;
        font-weight: 600;
        font-size: 1.4rem;
    }
    
    .order-body {
        padding: 25px;
    }
    
    .order-card {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }
    
    .order-card:hover {
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .order-number {
        font-weight: bold;
        color: #2c3e50;
        font-size: 1.1rem;
        margin-bottom: 10px;
    }
    
    .order-date {
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 10px;
    }
    
    .order-status {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 15px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 15px;
    }
    
    .order-total {
        font-weight: bold;
        color: #e74c3c;
        font-size: 1.2rem;
        margin-bottom: 15px;
    }
    
    .order-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    
    .btn-view {
        background: linear-gradient(45deg, #667eea, #764ba2);
        border: none;
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    
    .btn-view:hover {
        transform: translateY(-1px);
        color: white;
    }
    
    .btn-cancel {
        background: linear-gradient(45deg, #dc3545, #e74c3c);
        border: none;
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    
    .btn-cancel:hover {
        transform: translateY(-1px);
        color: white;
    }
    
    .empty-orders {
        text-align: center;
        padding: 50px 20px;
        color: #6c757d;
    }
    
    .empty-orders i {
        font-size: 4rem;
        margin-bottom: 20px;
        color: #dee2e6;
    }
    
    .btn-start-shopping {
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
    
    .btn-start-shopping:hover {
        transform: translateY(-1px);
        color: white;
    }
</style>

<div class="container-fluid">
    <div class="order-container">
        <div class="order-header">
            <h2><i class="fas fa-shopping-bag me-2"></i>Đơn hàng của tôi</h2>
        </div>

        <div class="order-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($orders->count() > 0)
                @foreach($orders as $order)
                    <div class="order-card">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="order-number">{{ $order->order_number }}</div>
                                <div class="order-date">
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ $order->created_at->format('d/m/Y H:i') }}
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <span class="order-status {{ $order->status_badge }}">
                                    {{ $order->status_text }}
                                </span>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="order-total">
                                    {{ number_format($order->total_amount, 0, ',', '.') }}đ
                                </div>
                                <small class="text-muted">
                                    {{ $order->orderDetails->count() }} sản phẩm
                                </small>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="order-actions">
                                    <a href="{{ route('client.order.show', $order->id) }}" class="btn btn-view">
                                        <i class="fas fa-eye me-1"></i>Xem chi tiết
                                    </a>
                                    
                                    @if($order->status === 'pending')
                                        <a href="{{ route('client.order.cancel', $order->id) }}" 
                                           class="btn btn-cancel"
                                           onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này?')">
                                            <i class="fas fa-times me-1"></i>Hủy đơn hàng
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                
                <div class="d-flex justify-content-center mt-4">
                    {{ $orders->links() }}
                </div>
            @else
                <div class="empty-orders">
                    <i class="fas fa-shopping-bag"></i>
                    <h4>Chưa có đơn hàng nào</h4>
                    <p>Bạn chưa có đơn hàng nào. Hãy bắt đầu mua sắm ngay!</p>
                    <a href="{{ route('client.product') }}" class="btn btn-start-shopping">
                        <i class="fas fa-shopping-cart me-2"></i>Bắt đầu mua sắm
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
