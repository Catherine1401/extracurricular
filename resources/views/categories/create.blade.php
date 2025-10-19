@extends('activities.layout')

@section('title', 'Quản lý danh mục - Tạo mới')

@section('content')
<div class="container mx-auto mt-8 max-w-lg">
    <h1 class="text-2xl font-semibold mb-6 text-gray-800">➕ Thêm danh mục mới</h1>

    <form action="{{ route('categories.store') }}" method="POST" class="bg-white p-6 shadow-md rounded-lg">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Tên danh mục</label>
            <input type="text" name="name" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Mô tả</label>
            <textarea name="description" rows="3" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-400"></textarea>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('categories.index') }}" class="px-4 py-2 text-gray-600 hover:underline">Hủy</a>
            <button type="submit" class="ml-3 bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600">Lưu</button>
        </div>
    </form>
</div>
@endsection
