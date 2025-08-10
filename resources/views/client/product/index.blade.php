@extends('layouts.client')

@section('title', 'Danh sách sản phẩm')

@section('content')
<style>
    .product-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        border-radius: 15px;
        overflow: hidden;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    
    .product-image {
        height: 250px;
        object-fit: cover;
        width: 100%;
    }
    
    .product-price {
        font-size: 1.2rem;
        font-weight: bold;
        color: #e74c3c;
    }
    
    .product-sale-price {
        font-size: 1rem;
        color: #95a5a6;
        text-decoration: line-through;
    }
    
    .category-badge {
        background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.8rem;
    }
    
    .search-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 30px;
        border-radius: 15px;
        margin-bottom: 30px;
    }
    
    .filter-section {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 30px;
    }
    
    .btn-view-detail {
        background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 25px;
        padding: 8px 20px;
        color: white;
        transition: all 0.3s ease;
    }
    
    .btn-view-detail:hover {
        transform: scale(1.05);
        color: white;
    }
    
    .no-image-placeholder {
        height: 250px;
        background: linear-gradient(45deg, #f0f0f0 0%, #e0e0e0 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #999;
        font-size: 1.2rem;
    }
</style>

<div class="container-fluid">
    <!-- Search and Filter Section -->
    <div class="search-container text-white">
        <h2 class="text-center mb-4">🛍️ Khám phá sản phẩm</h2>
        <form method="GET" action="{{ route('client.product') }}" class="row g-3">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control form-control-lg" 
                       placeholder="🔍 Tìm kiếm sản phẩm..." 
                       value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <select name="category" class="form-select form-select-lg">
                    <option value="">📂 Tất cả danh mục</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" 
                                {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-light btn-lg w-100">🔍 Tìm kiếm</button>
            </div>
        </form>
    </div>

    <!-- Results Info -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>📦 Sản phẩm ({{ $products->total() }} kết quả)</h4>
        @if(request('search') || request('category'))
            <a href="{{ route('client.product') }}" class="btn btn-outline-secondary">
                🔄 Xóa bộ lọc
            </a>
        @endif
    </div>

    <!-- Products Grid -->
    <div class="row">
        @forelse($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card product-card h-100">
                    @if($product->thumbnail)
                        <img src="{{ asset('storage/' . $product->thumbnail) }}" 
                             class="product-image" 
                             alt="{{ $product->title }}">
                    @else
                        <div class="no-image-placeholder">
                            📷 Không có ảnh
                        </div>
                    @endif
                    
                    <div class="card-body d-flex flex-column">
                        <div class="mb-2">
                            <span class="category-badge">
                                {{ $product->category->name ?? 'Không phân loại' }}
                            </span>
                        </div>
                        
                        <h5 class="card-title">{{ $product->title }}</h5>
                        
                        <div class="mb-2">
                            @if($product->hasVariants())
                                <span class="text-success fw-bold">
                                    {{ number_format($product->min_price, 0, ',', '.') }}đ
                                </span>
                                @if($product->min_price != $product->max_price)
                                    <span class="text-muted"> - {{ number_format($product->max_price, 0, ',', '.') }}đ</span>
                                @endif
                                <br>
                                <small class="text-info">
                                    {{ $product->variants->count() }} biến thể
                                </small>
                            @else
                                @if($product->sale_price > 0 && $product->sale_price < $product->price)
                                    <span class="product-sale-price">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                                    <span class="product-price ms-2">{{ number_format($product->sale_price, 0, ',', '.') }}đ</span>
                                @else
                                    <span class="product-price">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                                @endif
                            @endif
                        </div>
                        
                        <p class="card-text text-muted flex-grow-1">
                            {{ Str::limit($product->description, 80) }}
                        </p>
                        
                        <div class="mt-auto">
                            <a href="{{ route('client.product.show', $product->id) }}" 
                               class="btn btn-view-detail w-100">
                                👁️ Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="alert alert-info">
                    <h4>😔 Không tìm thấy sản phẩm</h4>
                    <p>Hãy thử tìm kiếm với từ khóa khác hoặc chọn danh mục khác.</p>
                    <a href="{{ route('client.product') }}" class="btn btn-primary">🔄 Xem tất cả sản phẩm</a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($products->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $products->appends(request()->query())->links() }}
        </div>
    @endif
</div>
@endsection
