@extends('layouts.admin')
@section('title', 'Thêm danh mục')

@section('content')
<h2>➕ Thêm danh mục</h2>
<form method="POST" action="{{ route('admin.category.store') }}">
    @csrf
    <input type="text" name="name" placeholder="Tên danh mục" required><br><br>
    <textarea name="description" placeholder="Mô tả"></textarea><br><br>
    <select name="status">
        <option value="1" selected>Bật</option>
        <option value="0">Tắt</option>
    </select><br><br>
    <button type="submit">Lưu</button>
</form>
@endsection
