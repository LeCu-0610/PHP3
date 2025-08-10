@extends('layouts.client')

@section('title', $product->title)

@section('content')
<style>
    .product-detail-container {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 3px 15px rgba(0,0,0,0.08);
        overflow: hidden;
        margin: 20px 0;
    }
    
    .product-image-main {
        width: 100%;
        height: 350px;
        object-fit: cover;
        border-radius: 8px;
    }
    
    .product-info {
        padding: 25px;
    }
    
    .product-title {
        font-size: 1.6rem;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 12px;
    }
    
    .product-price {
        font-size: 1.5rem;
        font-weight: bold;
        color: #e74c3c;
        margin-bottom: 8px;
    }
    
    .product-sale-price {
        font-size: 1.2rem;
        color: #95a5a6;
        text-decoration: line-through;
        margin-right: 12px;
    }
    
    .category-badge {
        background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        display: inline-block;
        margin-bottom: 15px;
    }
    
    .product-description {
        font-size: 1rem;
        line-height: 1.5;
        color: #555;
        margin-bottom: 20px;
    }
    
    .product-content {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    
    .btn-add-cart {
        background: linear-gradient(45deg, #e74c3c 0%, #c0392b 100%);
        border: none;
        border-radius: 25px;
        padding: 12px 30px;
        font-size: 1rem;
        font-weight: bold;
        color: white;
        transition: all 0.3s ease;
        margin-right: 12px;
    }
    
    .btn-add-cart:hover {
        transform: scale(1.03);
        color: white;
    }
    
    .btn-buy-now {
        background: linear-gradient(45deg, #27ae60 0%, #2ecc71 100%);
        border: none;
        border-radius: 25px;
        padding: 12px 30px;
        font-size: 1rem;
        font-weight: bold;
        color: white;
        transition: all 0.3s ease;
    }
    
    .btn-buy-now:hover {
        transform: scale(1.03);
        color: white;
    }
    
    .related-products {
        margin-top: 40px;
    }
    
    .related-product-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        border-radius: 8px;
        overflow: hidden;
    }
    
    .related-product-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }
    
    .related-product-image {
        height: 180px;
        object-fit: cover;
        width: 100%;
    }
    
    .no-image-placeholder {
        height: 350px;
        background: linear-gradient(45deg, #f0f0f0 0%, #e0e0e0 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #999;
        font-size: 1.2rem;
        border-radius: 8px;
    }
    
    .product-meta {
        background: #f8f9fa;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 15px;
    }
    
    .meta-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-size: 0.9rem;
    }
    
    .meta-item:last-child {
        margin-bottom: 0;
    }

    /* Variants styles */
    .product-variants {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .variants-container {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 15px;
    }

    .color-options, .size-options {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .color-option, .size-option {
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-radius: 15px;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .color-option:hover, .size-option:hover {
        background-color: #e9ecef;
        border-color: #6c757d;
    }

    .input-group .btn {
        border-radius: 0.25rem;
        padding: 6px 12px;
    }

    .input-group .form-control {
        border-radius: 0.25rem;
        text-align: center;
        padding: 6px 8px;
    }

    .mb-4 {
        margin-bottom: 1rem !important;
    }
    
    .mb-3 {
        margin-bottom: 0.75rem !important;
    }
    
    .mb-2 {
        margin-bottom: 0.5rem !important;
    }
    
    .mt-4 {
        margin-top: 1rem !important;
    }
    
    .mt-3 {
        margin-top: 0.75rem !important;
    }
    
    .mt-2 {
        margin-top: 0.5rem !important;
    }
    
    .me-2 {
        margin-right: 0.5rem !important;
    }
    
    .ms-2 {
        margin-left: 0.5rem !important;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <!-- Product Image -->
        <div class="col-lg-6 mb-4">
            <div class="product-detail-container">
                @if($product->thumbnail)
                    <img src="{{ asset('storage/' . $product->thumbnail) }}" 
                         class="product-image-main" 
                         alt="{{ $product->title }}">
                @else
                    <div class="no-image-placeholder">
                        📷 Không có ảnh
                    </div>
                @endif
            </div>
        </div>

        <!-- Product Information -->
        <div class="col-lg-6">
            <div class="product-info">
                <span class="category-badge">
                    {{ $product->category->name ?? 'Không phân loại' }}
                </span>
                
                <h1 class="product-title">{{ $product->title }}</h1>
                
                <div class="product-price">
                    @if($product->sale_price > 0 && $product->sale_price < $product->price)
                        <span class="product-sale-price">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                        {{ number_format($product->sale_price, 0, ',', '.') }}đ
                    @else
                        {{ number_format($product->price, 0, ',', '.') }}đ
                    @endif
                </div>
                
                <div class="product-meta">
                    <div class="meta-item">
                        <span><strong>Mã sản phẩm:</strong></span>
                        <span>#{{ $product->id }}</span>
                    </div>
                    <div class="meta-item">
                        <span><strong>Danh mục:</strong></span>
                        <span>{{ $product->category->name ?? 'Không phân loại' }}</span>
                    </div>
                    <div class="meta-item">
                        <span><strong>Trạng thái:</strong></span>
                        <span class="badge bg-success">Còn hàng</span>
                    </div>
                </div>
                
                <div class="product-description">
                    <h5>Mô tả sản phẩm:</h5>
                    <p>{{ $product->description ?: 'Chưa có mô tả cho sản phẩm này.' }}</p>
                </div>
                
                <!-- Product Variants Section -->
                @if($product->hasVariants())
                    <div class="product-variants mb-4">
                        <h5>Biến thể sản phẩm</h5>
                        <div class="variants-container">
                            @php
                                $colors = $product->variants->pluck('color')->filter()->unique();
                                $sizes = $product->variants->pluck('size')->filter()->unique();
                            @endphp
                            
                            @if($colors->count() > 0)
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Màu sắc:</label>
                                    <div class="color-options">
                                        @foreach($colors as $color)
                                            <button type="button" class="btn btn-outline-primary me-2 mb-2 color-option" 
                                                    data-color="{{ $color }}" onclick="selectColor('{{ $color }}')">
                                                {{ $color }}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            
                            @if($sizes->count() > 0)
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Kích thước:</label>
                                    <div class="size-options">
                                        @foreach($sizes as $size)
                                            <button type="button" class="btn btn-outline-secondary me-2 mb-2 size-option" 
                                                    data-size="{{ $size }}" onclick="selectSize('{{ $size }}')">
                                                {{ $size }}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Quantity Input for Variants -->
                            <div id="quantity-section" class="mt-3" style="display: none;">
                                <label for="quantity" class="form-label">Số lượng mua:</label>
                                <div class="input-group" style="max-width: 150px;">
                                    <button type="button" class="btn btn-outline-secondary" onclick="changeQuantity(-1)">-</button>
                                    <input type="number" id="quantity" class="form-control text-center" value="1" min="1" max="999">
                                    <button type="button" class="btn btn-outline-secondary" onclick="changeQuantity(1)">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                
                @if(!$product->hasVariants())
                    <div class="d-flex flex-wrap">
                        <form action="{{ route('client.cart.add') }}" method="POST" class="me-2">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-add-cart">
                                🛒 Thêm vào giỏ hàng
                            </button>
                        </form>
                        <form action="{{ route('client.cart.add') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="buy_now" value="1">
                            <button type="submit" class="btn btn-buy-now">
                                💳 Mua ngay
                            </button>
                        </form>
                    </div>
                @else
                    <div class="d-flex flex-wrap">
                        <form action="{{ route('client.cart.add') }}" method="POST" class="me-2">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="variant_id" id="selected-variant-id">
                            <input type="hidden" name="quantity" id="selected-quantity" value="1">
                            <button type="submit" class="btn btn-add-cart" id="add-to-cart-btn" disabled>
                                🛒 Thêm vào giỏ hàng
                            </button>
                        </form>
                        <form action="{{ route('client.cart.add') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="variant_id" id="buy-now-variant-id">
                            <input type="hidden" name="quantity" id="buy-now-quantity" value="1">
                            <input type="hidden" name="buy_now" value="1">
                            <button type="submit" class="btn btn-buy-now" id="buy-now-btn" style="display: none;">
                                💳 Mua ngay
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="related-products">
            <h3 class="mb-4">🔄 Sản phẩm liên quan</h3>
            <div class="row">
                @foreach($relatedProducts as $relatedProduct)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card related-product-card h-100">
                            @if($relatedProduct->thumbnail)
                                <img src="{{ asset('storage/' . $relatedProduct->thumbnail) }}" 
                                     class="related-product-image" 
                                     alt="{{ $relatedProduct->title }}">
                            @else
                                <div class="no-image-placeholder" style="height: 180px;">
                                    📷 Không có ảnh
                                </div>
                            @endif
                            
                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title">{{ $relatedProduct->title }}</h6>
                                
                                <div class="mb-2">
                                    @if($relatedProduct->sale_price > 0 && $relatedProduct->sale_price < $relatedProduct->price)
                                        <span class="text-muted text-decoration-line-through">
                                            {{ number_format($relatedProduct->price, 0, ',', '.') }}đ
                                        </span>
                                        <span class="text-danger fw-bold ms-2">
                                            {{ number_format($relatedProduct->sale_price, 0, ',', '.') }}đ
                                        </span>
                                    @else
                                        <span class="text-danger fw-bold">
                                            {{ number_format($relatedProduct->price, 0, ',', '.') }}đ
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="mt-auto">
                                    <a href="{{ route('client.product.show', $relatedProduct->id) }}" 
                                       class="btn btn-outline-primary btn-sm w-100">
                                        👁️ Xem chi tiết
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

<script>
    // Variant selection variables
    let selectedColor = '';
    let selectedSize = '';
    let selectedVariant = null;
    
    // Product variants data
    const variants = @json($product->variants);
    
    function selectColor(color) {
        selectedColor = color;
        updateVariantSelection();
        
        // Update button styles
        document.querySelectorAll('.color-option').forEach(btn => {
            btn.classList.remove('btn-primary');
            btn.classList.add('btn-outline-primary');
        });
        event.target.classList.remove('btn-outline-primary');
        event.target.classList.add('btn-primary');
    }
    
    function selectSize(size) {
        selectedSize = size;
        updateVariantSelection();
        
        // Update button styles
        document.querySelectorAll('.size-option').forEach(btn => {
            btn.classList.remove('btn-secondary');
            btn.classList.add('btn-outline-secondary');
        });
        event.target.classList.remove('btn-outline-secondary');
        event.target.classList.add('btn-secondary');
    }
    
    function updateVariantSelection() {
        // Find matching variant
        const matchingVariant = variants.find(variant => 
            variant.color === selectedColor && variant.size === selectedSize
        );
        
        if (matchingVariant) {
            selectedVariant = matchingVariant;
            showSelectedVariantInfo();
        } else {
            selectedVariant = null;
            hideSelectedVariantInfo();
        }
    }
    
    function showSelectedVariantInfo() {
        // Show quantity section
        document.getElementById('quantity-section').style.display = 'block';
        
        // Enable buttons and set variant ID
        document.getElementById('add-to-cart-btn').disabled = false;
        document.getElementById('buy-now-btn').style.display = 'inline-block';
        document.getElementById('selected-variant-id').value = selectedVariant.id;
        document.getElementById('buy-now-variant-id').value = selectedVariant.id;
    }
    
    function hideSelectedVariantInfo() {
        // Hide quantity section
        document.getElementById('quantity-section').style.display = 'none';
        
        // Disable buttons
        document.getElementById('add-to-cart-btn').disabled = true;
        document.getElementById('buy-now-btn').style.display = 'none';
        document.getElementById('selected-variant-id').value = '';
        document.getElementById('buy-now-variant-id').value = '';
    }
    
    function changeQuantity(delta) {
        const quantityInput = document.getElementById('quantity');
        let currentQuantity = parseInt(quantityInput.value) || 1;
        let newQuantity = currentQuantity + delta;
        
        // Ensure quantity is within valid range
        if (newQuantity < 1) newQuantity = 1;
        if (selectedVariant && newQuantity > selectedVariant.quantity) {
            newQuantity = selectedVariant.quantity;
        }
        
        quantityInput.value = newQuantity;
        document.getElementById('selected-quantity').value = newQuantity;
        document.getElementById('buy-now-quantity').value = newQuantity;
    }
    
    function formatPrice(price) {
        return new Intl.NumberFormat('vi-VN').format(price) + 'đ';
    }
</script>
@endsection
