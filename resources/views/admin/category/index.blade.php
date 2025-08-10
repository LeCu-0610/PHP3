@extends('layouts.admin')

@section('title', 'Danh sách danh mục')

@section('content')
    <h2 class="mb-4">📂 Danh sách danh mục</h2>

    {{-- Hiển thị thông báo thành công --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Hiển thị thông báo lỗi --}}
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Nút thêm danh mục --}}
    <a href="{{ route('admin.category.create') }}" class="btn btn-success mb-3">➕ Thêm danh mục</a>

    {{-- Bảng danh sách danh mục --}}
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Tên</th>
                <th>Slug</th>
                <th>Mô tả</th>
                <th>Trạng thái</th>
                <th style="width: 150px;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $cat)
                <tr>
                    <td>{{ $cat->id }}</td>
                    <td>{{ $cat->name }}</td>
                    <td>{{ $cat->slug }}</td>
                    <td>{{ Str::limit($cat->description, 50) }}</td>
                    <td>
                        <span class="badge bg-{{ $cat->status ? 'success' : 'secondary' }}">
                            {{ $cat->status ? 'Bật' : 'Tắt' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.category.edit', $cat->id) }}" class="btn btn-sm btn-primary">
                            ✏️ Sửa
                        </a>
                        <a href="{{ route('admin.category.delete', $cat->id) }}" class="btn btn-sm btn-danger"
                           onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')">
                            🗑️ Xóa
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Không có danh mục nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
