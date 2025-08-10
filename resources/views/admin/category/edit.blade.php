@extends('layouts.admin')
@section('title', 'Sửa danh mục')

@section('content')
<h2>✏️ Sửa danh mục</h2>
<form method="POST" action="{{ route('admin.category.update', $category->id) }}">
    @csrf
    <input type="text" name="name" value="{{ $category->name }}" required><br><br>
    <textarea name="description">{{ $category->description }}</textarea><br><br>
    <select name="status">
        <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Bật</option>
        <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Tắt</option>
    </select><br><br>
    <button type="submit">Cập nhật</button>
</form>
@endsection
