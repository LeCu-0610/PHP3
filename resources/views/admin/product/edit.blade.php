@extends('layouts.admin')

@section('title', 'Sửa sản phẩm')

@section('content')
<style>
    .form-container {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        overflow: hidden;
        margin: 20px 0;
    }
    
    .form-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 15px 20px;
        text-align: center;
    }
    
    .form-header h2 {
        margin: 0;
        font-weight: 600;
        font-size: 1.4rem;
    }
    
    .form-body {
        padding: 20px;
    }
    
    .form-section {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        border-left: 3px solid #667eea;
    }
    
    .form-section h5 {
        color: #2c3e50;
        margin-bottom: 15px;
        font-weight: 600;
        font-size: 1rem;
    }
    
    .image-upload-container {
        border: 2px dashed #dee2e6;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        background: linear-gradient(145deg, #f8f9fa, #e9ecef);
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .image-upload-container:hover {
        border-color: #667eea;
        background: linear-gradient(145deg, #f0f8ff, #e6f3ff);
        transform: translateY(-1px);
    }
    
    .image-preview-container {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 15px;
        background: white;
        box-shadow: 0 1px 5px rgba(0,0,0,0.1);
    }
    
    .file-input-wrapper {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }
    
    .file-input-wrapper input[type=file] {
        position: absolute;
        left: -9999px;
    }
    
    .file-input-label {
        display: inline-flex;
        align-items: center;
        padding: 8px 16px;
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
        border-radius: 20px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
        font-size: 0.9rem;
        box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
    }
    
    .file-input-label:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 12px rgba(102, 126, 234, 0.4);
    }
    
    .form-control, .form-select {
        border-radius: 6px;
        border: 1px solid #e9ecef;
        padding: 8px 12px;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.15rem rgba(102, 126, 234, 0.25);
    }
    
    .form-label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 5px;
        font-size: 0.9rem;
    }
    
    .btn-submit {
        background: linear-gradient(45deg, #667eea, #764ba2);
        border: none;
        border-radius: 20px;
        padding: 10px 25px;
        color: white;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
    }
    
    .btn-submit:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 12px rgba(102, 126, 234, 0.4);
        color: white;
    }
    
    .btn-back {
        background: #6c757d;
        border: none;
        border-radius: 20px;
        padding: 10px 20px;
        color: white;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }
    
    .btn-back:hover {
        background: #5a6268;
        color: white;
        transform: translateY(-1px);
    }
    
    .price-input {
        position: relative;
    }
    
    .price-input::after {
        content: 'VNĐ';
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        font-weight: 500;
        font-size: 0.8rem;
    }
    
    .current-image {
        border: 2px solid #28a745;
        border-radius: 8px;
        padding: 12px;
        background: #f8fff9;
    }
    
    .new-image {
        border: 2px solid #ffc107;
        border-radius: 8px;
        padding: 12px;
        background: #fffbf0;
    }
    
    .mb-3 {
        margin-bottom: 0.75rem !important;
    }
    
    .row {
        margin-left: -8px;
        margin-right: -8px;
    }
    
    .col-md-2, .col-md-3, .col-md-4, .col-md-6, .col-md-8 {
        padding-left: 8px;
        padding-right: 8px;
    }
</style>

<div class="form-container">
    <div class="form-header">
        <h2><i class="fas fa-edit me-2"></i>Sửa sản phẩm</h2>
    </div>

    <div class="form-body">
        <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Thông tin cơ bản -->
            <div class="form-section">
                <h5><i class="fas fa-info-circle me-2"></i>Thông tin cơ bản</h5>
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="title" class="form-label">Tên sản phẩm</label>
                            <input type="text" class="form-control" name="title" value="{{ old('title', $product->title) }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Danh mục</label>
                            <select name="category_id" class="form-select" required>
                                @foreach($categories as $c)
                                    <option value="{{ $c->id }}" {{ old('category_id', $product->category_id) == $c->id ? 'selected' : '' }}>
                                        {{ $c->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug (URL)</label>
                            <input type="text" class="form-control" name="slug" value="{{ old('slug', $product->slug) }}">
                            <small class="form-text text-muted">Để trống để tự động tạo từ tên sản phẩm</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status" class="form-label">Trạng thái</label>
                            <select name="status" class="form-select">
                                <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>Hiện</option>
                                <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>Ẩn</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Giá cả -->
            <div class="form-section">
                <h5><i class="fas fa-tag me-2"></i>Thông tin giá</h5>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="price" class="form-label">Giá gốc</label>
                            <div class="price-input">
                                <input type="number" class="form-control" name="price" step="1000" value="{{ old('price', $product->price) }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="sale_price" class="form-label">Giá khuyến mãi</label>
                            <div class="price-input">
                                <input type="number" class="form-control" name="sale_price" step="1000" value="{{ old('sale_price', $product->sale_price) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ảnh sản phẩm -->
            <div class="form-section">
                <h5><i class="fas fa-image me-2"></i>Ảnh sản phẩm</h5>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="image-upload-container" onclick="document.getElementById('thumbnail').click()">
                            <div class="file-input-wrapper">
                                <input type="file" class="form-control" name="thumbnail" id="thumbnail" accept="image/*" onchange="previewImage(this)">
                                <label for="thumbnail" class="file-input-label">
                                    <i class="fas fa-cloud-upload-alt me-2"></i>Chọn ảnh mới
                                </label>
                            </div>
                            <small class="form-text text-muted mt-2 d-block">
                                <i class="fas fa-info-circle me-1"></i>JPG, PNG, GIF - Tối đa 2MB
                            </small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        @if($product->thumbnail)
                            <div class="current-image mb-2">
                                <h6 class="text-success mb-2">
                                    <i class="fas fa-check-circle me-2"></i>Ảnh hiện tại
                                </h6>
                                <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="Current Image" class="img-fluid rounded" style="max-height: 150px;">
                            </div>
                        @endif
                        <div id="imagePreview" class="new-image" style="display: none;">
                            <h6 class="text-warning mb-2">
                                <i class="fas fa-eye me-2"></i>Ảnh mới
                            </h6>
                            <img id="preview" src="" alt="Preview" class="img-fluid rounded" style="max-height: 150px;">
                            <button type="button" class="btn btn-sm btn-danger mt-2" onclick="removeImage()">
                                <i class="fas fa-trash me-1"></i>Xóa ảnh mới
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mô tả -->
            <div class="form-section">
                <h5><i class="fas fa-align-left me-2"></i>Mô tả sản phẩm</h5>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả ngắn</label>
                    <textarea class="form-control" name="description" rows="2" placeholder="Mô tả ngắn gọn về sản phẩm...">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Nội dung chi tiết</label>
                    <textarea class="form-control" name="content" rows="3" placeholder="Mô tả chi tiết về sản phẩm...">{{ old('content', $product->content) }}</textarea>
                </div>
            </div>

            <!-- Nút hành động -->
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-submit me-2">
                    <i class="fas fa-save me-2"></i>Cập nhật sản phẩm
                </button>
                <a href="{{ route('admin.product') }}" class="btn btn-back">
                    <i class="fas fa-arrow-left me-2"></i>Quay lại
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(input) {
        const file = input.files[0];
        const preview = document.getElementById('preview');
        const imagePreview = document.getElementById('imagePreview');
        
        if (file) {
            if (file.size > 2 * 1024 * 1024) {
                alert('File ảnh quá lớn. Vui lòng chọn file nhỏ hơn 2MB.');
                input.value = '';
                return;
            }
            
            if (!file.type.startsWith('image/')) {
                alert('Vui lòng chọn file ảnh hợp lệ.');
                input.value = '';
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
        }
    }
    
    function removeImage() {
        document.getElementById('thumbnail').value = '';
        document.getElementById('imagePreview').style.display = 'none';
    }
</script>
@endsection
    