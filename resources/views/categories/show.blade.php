@extends('categories.layout')

@section('content')
<div class="container mx-auto mt-8 max-w-lg">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">{{ $category->name }}</h1>
        <p class="text-gray-600 mb-6">{{ $category->description ?? 'Không có mô tả' }}</p>

        <div class="flex justify-between">
            <a href="{{ route('categories.edit', $category) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 flex items-center gap-2">
                <span class="material-icons">edit</span> Sửa
            </a>
            <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Xóa danh mục này?')">
                @csrf
                @method('DELETE')
                <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 flex items-center gap-2">
                    <span class="material-icons">delete</span> Xóa
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
