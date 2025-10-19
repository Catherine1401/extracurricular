@extends('categories.layout')

@section('content')
<div class="container mx-auto mt-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold text-gray-800">📂 Danh mục</h1>
        <a href="{{ route('categories.create') }}"
           class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600 flex items-center gap-2">
            <span class="material-icons">add</span> Thêm mới
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full text-left border-collapse">
            <thead class="bg-indigo-50">
                <tr>
                    <th class="p-4">#</th>
                    <th class="p-4">Tên danh mục</th>
                    <th class="p-4">Mô tả</th>
                    <th class="p-4 text-right">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-4">{{ $loop->iteration }}</td>
                        <td class="p-4 font-medium">{{ $category->name }}</td>
                        <td class="p-4 text-gray-600">{{ $category->description }}</td>
                        <td class="p-4 text-right flex justify-end gap-2">
                            <a href="{{ route('categories.show', $category) }}" class="text-blue-500 hover:text-blue-700">
                                <span class="material-icons">visibility</span>
                            </a>
                            <a href="{{ route('categories.edit', $category) }}" class="text-yellow-500 hover:text-yellow-700">
                                <span class="material-icons">edit</span>
                            </a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Xóa danh mục này?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500 hover:text-red-700">
                                    <span class="material-icons">delete</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="p-4 text-center text-gray-500">Chưa có danh mục nào</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
