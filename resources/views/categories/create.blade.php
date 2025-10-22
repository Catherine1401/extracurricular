@extends('activities.layout')

@section('title', 'Quản lý danh mục - Tạo mới')

@section('content')
<div class="container mx-auto mt-8 max-w-lg">
    <h1 class="text-2xl font-semibold mb-6 text-gray-800">➕ Thêm danh mục mới</h1>

    <form action="{{ route('categories.store') }}" method="POST" class="bg-white p-6 shadow-md rounded-lg">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Tên danh mục</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Mô tả</label>
            <textarea name="description" rows="3" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-400">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('categories.index') }}" 
               class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 flex items-center gap-2 transition-colors duration-200" 
               style="text-decoration: none;">
                <span class="material-icons" style="font-size: 18px;">close</span>
                Hủy
            </a>
            <button type="submit" 
                    class="px-6 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200"
                    style="background-color: #1976d2; color: white; border: none; cursor: pointer;"
                    onmouseover="this.style.backgroundColor='#1565c0'"
                    onmouseout="this.style.backgroundColor='#1976d2'">
                <span class="material-icons" style="font-size: 18px; color: white;">save</span>
                Lưu
            </button>
        </div>
    </form>
</div>
@endsection
