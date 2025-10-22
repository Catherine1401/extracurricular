@extends('activities.layout')

@section('title', 'Quản lý danh mục')

@section('content')
<div class="material-container" style="display: flex; flex-direction: column; gap: 24px;">
    <!-- Header -->
    {{-- <div class="material-card" style="padding: 24px; cursor: default;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h2 class="material-typography-h1" style="font-size: 28px; margin-bottom: 8px;">Quản lý danh mục</h2>
                <p class="material-typography-body1" style="color: #616161; margin: 0;">Tổ chức và quản lý các danh mục hoạt động</p>
            </div>
        </div>
    </div> --}}

    <!-- Success Message -->
    @if(session('success'))
        <div class="material-card" style="padding: 16px; background-color: #e8f5e8; border-left: 4px solid #4caf50; cursor: default;">
            <div style="display: flex; align-items: center; gap: 8px;">
                <span class="material-icons" style="color: #4caf50;">check_circle</span>
                <span class="material-typography-body1" style="color: #2e7d32; font-weight: 500;">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
        <div class="material-card" style="padding: 16px; background-color: #ffebee; border-left: 4px solid #f44336; cursor: default;">
            <div style="display: flex; align-items: center; gap: 8px;">
                <span class="material-icons" style="color: #f44336;">error</span>
                <span class="material-typography-body1" style="color: #c62828; font-weight: 500;">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- Search Results Info -->
    @if(request('search'))
        <div class="material-card" style="padding: 16px; background-color: #e3f2fd; border-left: 4px solid #1976d2; cursor: default;">
            <div style="display: flex; align-items: center; gap: 8px;">
                <span class="material-icons" style="color: #1976d2;">search</span>
                <span class="material-typography-body1" style="color: #1565c0; font-weight: 500;">
                    Kết quả tìm kiếm cho: "{{ request('search') }}" - {{ $categories->total() }} danh mục
                </span>
            </div>
        </div>
    @endif

    <!-- Search Form -->
    <div class="material-card" style="padding: 24px; cursor: default;">
        <form method="GET" action="{{ route('categories.index') }}" style="display: flex; gap: 16px; align-items: end;">
            <div style="flex: 1;">
                <label class="material-form-label" style="margin-bottom: 8px;">Tìm kiếm danh mục</label>
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}" 
                       placeholder="Nhập tên danh mục hoặc mô tả..."
                       style="width: 100%; padding: 12px 16px; border: 1px solid #e0e0e0; border-radius: 8px; font-size: 14px;"
                       onfocus="this.style.borderColor='#1976d2'; this.style.outline='none'"
                       onblur="this.style.borderColor='#e0e0e0'">
            </div>
            <button type="submit" 
                    style="background-color: #1976d2; color: white; padding: 12px 24px; border: none; border-radius: 8px; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                <span class="material-icons" style="font-size: 18px;">search</span>
                Tìm kiếm
            </button>
            @if(request('search'))
                <a href="{{ route('categories.index') }}" 
                   style="background-color: #f5f5f5; color: #616161; padding: 12px 24px; border: none; border-radius: 8px; cursor: pointer; text-decoration: none; display: flex; align-items: center; gap: 8px;">
                    <span class="material-icons" style="font-size: 18px;">clear</span>
                    Xóa
                </a>
            @endif
        </form>
    </div>

    <!-- Categories Table Card -->
    <div class="material-card" style="overflow: hidden; cursor: default;">
        <div style="overflow-x: auto;">
            <table class="min-w-full" style="border-collapse: collapse; width: 100%;">
                <thead style="background-color: #f5f5f5;">
                    <tr>
                        <th class="p-4 text-left material-typography-caption" style="color:#616161;">#</th>
                        <th class="p-4 text-left material-typography-caption" style="color:#616161;">Tên danh mục</th>
                        <th class="p-4 text-left material-typography-caption" style="color:#616161;">Mô tả</th>
                        <th class="p-4 text-right material-typography-caption" style="color:#616161;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr style="border-top: 1px solid #e0e0e0;">
                            <td class="p-4">{{ $loop->iteration }}</td>
                            <td class="p-4 material-typography-body1" style="font-weight: 600;">{{ $category->name }}</td>
                            <td class="p-4 material-typography-body2" style="color:#616161;">{{ $category->description }}</td>
                            <td class="p-4">
                                <div style="display: flex; justify-content: flex-end; gap: 8px;">
                                    <a href="{{ route('categories.show', $category) }}" class="material-button material-button-secondary" style="text-decoration: none; padding: 6px 10px;">
                                        <span class="material-icons" style="font-size: 16px; margin-right: 4px;">visibility</span>
                                        Xem
                                    </a>
                                    <a href="{{ route('categories.edit', $category) }}" class="material-button material-button-primary" style="text-decoration: none; padding: 6px 10px;">
                                        <span class="material-icons" style="font-size: 16px; margin-right: 4px;">edit</span>
                                        Sửa
                                    </a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Xóa danh mục này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="material-button material-button-danger" style="padding: 6px 10px;">
                                            <span class="material-icons" style="font-size: 16px; margin-right: 4px;">delete</span>
                                            Xóa
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-4 material-typography-body1" style="text-align: center; color: #9e9e9e;">Chưa có danh mục nào</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($categories->hasPages())
        <div class="material-card" style="padding: 16px; cursor: default;">
            <div style="display: flex; justify-content: center;">
                {{ $categories->links() }}
            </div>
        </div>
    @endif

    <!-- Floating Action Button (FAB) -->
    <a href="{{ route('categories.create') }}" 
       class="material-fab" 
       style="position: fixed; right: 24px; bottom: 24px; width: 56px; height: 56px; border-radius: 50%; background-color: #1976d2; color: white; display: inline-flex; align-items: center; justify-content: center; box-shadow: 0 6px 12px rgba(25,118,210,0.3); text-decoration: none;">
        <span class="material-icons" style="font-size: 24px;">add</span>
    </a>

    <style>
        .material-button { display: inline-flex; align-items: center; border: none; border-radius: 4px; cursor: pointer; }
        .material-button-primary { background-color: #1976d2; color: white; }
        .material-button-secondary { background-color: #e3f2fd; color: #1976d2; }
        .material-button-danger { background-color: #d32f2f; color: white; }
        .material-card { background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        .material-typography-h1 { font-weight: 600; }
        .material-typography-body1 { font-size: 14px; }
        .material-typography-body2 { font-size: 13px; }
        .material-typography-caption { font-size: 12px; text-transform: uppercase; letter-spacing: .04em; }
        .material-button:hover { filter: brightness(0.98); }
        .material-button-primary:hover { background-color: #1565c0; }
        .material-button-secondary:hover { background-color: #bbdefb; }
        .material-button-danger:hover { background-color: #b71c1c; color: white; }
        @media (max-width: 768px) { .material-fab { right: 16px !important; bottom: 16px !important; } }
    </style>
</div>
@endsection
