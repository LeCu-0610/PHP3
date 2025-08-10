@extends('layouts.admin')

@section('title', 'Danh sách sản phẩm')

@section('content')
    <h2 class="mb-4">📦 Danh sách sản phẩm</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <a href="{{ route('admin.product.create') }}" class="btn btn-success mb-3">➕ Thêm sản phẩm</a>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Ảnh</th>
                <th>Tên</th>
                <th>Giá</th>
                <th>Biến thể</th>
                <th>Tổng số lượng</th>
                <th>Danh mục</th>
                <th style="width: 150px;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>
                        @if($p->thumbnail)
                            <img src="{{ asset('storage/' . $p->thumbnail) }}" alt="{{ $p->title }}" 
                                 class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                        @else
                            <div class="bg-light text-center" style="width: 50px; height: 50px; line-height: 50px; font-size: 12px;">
                                No Image
                            </div>
                        @endif
                    </td>
                    <td>{{ $p->title }}</td>
                    <td>
                        @if($p->hasVariants())
                            <span class="text-success">{{ number_format($p->min_price, 0, ',', '.') }}đ</span>
                            @if($p->min_price != $p->max_price)
                                <br><small class="text-muted">- {{ number_format($p->max_price, 0, ',', '.') }}đ</small>
                            @endif
                        @else
                            {{ number_format($p->price, 0, ',', '.') }}đ
                        @endif
                    </td>
                    <td>
                        @if($p->hasVariants())
                            <span class="badge bg-info">{{ $p->variants->count() }} biến thể</span>
                            <br><small class="text-muted">
                                @php
                                    $colors = $p->variants->pluck('color')->filter()->unique()->take(3);
                                    $sizes = $p->variants->pluck('size')->filter()->unique()->take(3);
                                @endphp
                                @if($colors->count() > 0)
                                    Màu: {{ $colors->implode(', ') }}
                                @endif
                                @if($sizes->count() > 0)
                                    <br>Size: {{ $sizes->implode(', ') }}
                                @endif
                            </small>
                        @else
                            <span class="badge bg-secondary">Không có</span>
                        @endif
                    </td>
                    <td>
                        @if($p->hasVariants())
                            <span class="text-primary">{{ $p->variants->sum('quantity') }}</span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>{{ $p->category->name ?? 'Không có' }}</td>
                    <td>
                        <a href="{{ route('admin.product.edit', $p->id) }}" class="btn btn-sm btn-primary">✏️ Sửa</a>
                        <a href="{{ route('admin.product.delete', $p->id) }}" class="btn btn-sm btn-danger"
                           onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">🗑️ Xóa</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Không có sản phẩm nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
