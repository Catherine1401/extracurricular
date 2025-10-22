@extends('activities.layout')

@section('title', 'Chi tiết danh mục - ' . $category->name)

@section('content')
<div class="container mx-auto mt-8 max-w-4xl">
    <!-- Back Button -->
    <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 24px;">
        <a href="{{ route('categories.index') }}" 
           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 flex items-center gap-2" style="text-decoration: none;">
            <span class="material-icons" style="font-size: 18px;">arrow_back</span>
            Quay lại danh sách
        </a>
    </div>

    <!-- Category Detail Card -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Card Header -->
        <div style="background: linear-gradient(135deg, #1976d2 0%, #1565c0 100%); color: white; padding: 32px;">
            <h1 class="text-3xl font-bold mb-4">{{ $category->name }}</h1>
            @if($category->description)
                <p class="text-lg opacity-90">{{ $category->description }}</p>
            @endif
        </div>

        <!-- Card Body -->
        <div style="padding: 32px;">
            <!-- Category Info -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 16px; margin-bottom: 32px;">
                <div class="bg-blue-50 p-6 rounded-lg">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="background-color: #e3f2fd; padding: 12px; border-radius: 50%;">
                            <span class="material-icons" style="font-size: 24px; color: #1976d2;">category</span>
                        </div>
                        <div>
                            <h3 class="text-sm text-gray-600 mb-1">Tên danh mục</h3>
                            <p class="font-semibold">{{ $category->name }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-green-50 p-6 rounded-lg">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="background-color: #e8f5e8; padding: 12px; border-radius: 50%;">
                            <span class="material-icons" style="font-size: 24px; color: #2e7d32;">event</span>
                        </div>
                        <div>
                            <h3 class="text-sm text-gray-600 mb-1">Số hoạt động</h3>
                            <p class="font-semibold">{{ $category->activities()->count() }} hoạt động</p>
                        </div>
                    </div>
                </div>

                <div class="bg-purple-50 p-6 rounded-lg">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="background-color: #f3e5f5; padding: 12px; border-radius: 50%;">
                            <span class="material-icons" style="font-size: 24px; color: #7b1fa2;">access_time</span>
                        </div>
                        <div>
                            <h3 class="text-sm text-gray-600 mb-1">Tạo lúc</h3>
                            <p class="font-semibold">{{ $category->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Footer -->
        <div style="background-color: #f5f5f5; padding: 20px 32px; display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #e0e0e0;">
            <div class="text-sm text-gray-600">
                Cập nhật lần cuối: {{ $category->updated_at->format('d/m/Y H:i') }}
            </div>
            
            <div style="display: flex; align-items: center; gap: 12px;">
                <a href="{{ route('categories.edit', $category) }}" 
                   class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex items-center gap-2" 
                   style="text-decoration: none;">
                    <span class="material-icons" style="font-size: 18px;">edit</span>
                    Chỉnh sửa
                </a>
                
                <form action="{{ route('categories.destroy', $category) }}" 
                      method="POST" 
                      style="display: inline;"
                      onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục này? Hành động này không thể hoàn tác.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 flex items-center gap-2">
                        <span class="material-icons" style="font-size: 18px;">delete</span>
                        Xóa
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection