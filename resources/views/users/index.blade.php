@extends('activities.layout')

@section('title', 'Quản lý người dùng')

@section('content')
<div style="display: flex; flex-direction: column; gap: 24px;">
    <!-- Page Header -->
    <div class="material-card" style="padding: 24px; cursor: default;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h2 class="material-typography-h1" style="font-size: 28px; margin-bottom: 8px;">Quản lý người dùng</h2>
                <p class="material-typography-body1" style="color: #616161; margin: 0;">Quản lý tài khoản người dùng trong hệ thống</p>
            </div>
            <a href="{{ route('users.create') }}" class="material-button material-button-primary">
                <span class="material-icons" style="margin-right: 8px;">person_add</span>
                Thêm người dùng
            </a>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="material-card" style="padding: 16px; background-color: #e8f5e8; border-left: 4px solid #4caf50; cursor: default;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <span class="material-icons" style="color: #4caf50;">check_circle</span>
                <span style="color: #2e7d32; font-weight: 500;">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="material-card" style="padding: 16px; background-color: #ffebee; border-left: 4px solid #f44336; cursor: default;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <span class="material-icons" style="color: #f44336;">error</span>
                <span style="color: #c62828; font-weight: 500;">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- Users Table -->
    <div class="material-card" style="overflow: hidden; cursor: default;">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #f5f5f5;">
                        <th style="padding: 16px; text-align: left; border-bottom: 1px solid #e0e0e0; font-weight: 600;">ID</th>
                        <th style="padding: 16px; text-align: left; border-bottom: 1px solid #e0e0e0; font-weight: 600;">Tên</th>
                        <th style="padding: 16px; text-align: left; border-bottom: 1px solid #e0e0e0; font-weight: 600;">Email</th>
                        <th style="padding: 16px; text-align: left; border-bottom: 1px solid #e0e0e0; font-weight: 600;">Vai trò</th>
                        <th style="padding: 16px; text-align: left; border-bottom: 1px solid #e0e0e0; font-weight: 600;">Ngày tạo</th>
                        <th style="padding: 16px; text-align: center; border-bottom: 1px solid #e0e0e0; font-weight: 600;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr style="border-bottom: 1px solid #f0f0f0;">
                            <td style="padding: 16px;">{{ $user->id }}</td>
                            <td style="padding: 16px;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <span class="material-icons" style="font-size: 20px; color: #666;">person</span>
                                    {{ $user->name }}
                                </div>
                            </td>
                            <td style="padding: 16px;">{{ $user->email }}</td>
                            <td style="padding: 16px;">
                                @if($user->role === 'admin')
                                    <span style="background-color: #e3f2fd; color: #1976d2; padding: 4px 8px; border-radius: 12px; font-size: 11px; font-weight: 500;">
                                        👑 Admin
                                    </span>
                                @elseif($user->role === 'organization')
                                    <span style="background-color: #e8f5e8; color: #2e7d32; padding: 4px 8px; border-radius: 12px; font-size: 11px; font-weight: 500;">
                                        🏢 Tổ chức
                                    </span>
                                @else
                                    <span style="background-color: #f3e5f5; color: #7b1fa2; padding: 4px 8px; border-radius: 12px; font-size: 11px; font-weight: 500;">
                                        👤 Người dùng
                                    </span>
                                @endif
                            </td>
                            <td style="padding: 16px;">{{ $user->created_at->format('d/m/Y H:i') }}</td>
                            <td style="padding: 16px; text-align: center;">
                                <div style="display: flex; align-items: center; gap: 8px; justify-content: center;">
                                    <a href="{{ route('users.show', $user->id) }}" 
                                       class="material-button material-button-secondary" 
                                       style="text-decoration: none; padding: 6px 10px; font-size: 12px;">
                                        <span class="material-icons" style="font-size: 16px; margin-right: 4px;">visibility</span>
                                        Xem
                                    </a>
                                    
                                    <a href="{{ route('users.edit', $user->id) }}" 
                                       class="material-button material-button-primary" 
                                       style="text-decoration: none; padding: 6px 10px; font-size: 12px;">
                                        <span class="material-icons" style="font-size: 16px; margin-right: 4px;">edit</span>
                                        Sửa
                                    </a>
                                    
                                    @if($user->id !== Auth::user()->id)
                                        <form action="{{ route('users.destroy', $user->id) }}" 
                                              method="POST" 
                                              style="display: inline;"
                                              onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="material-button material-button-danger" 
                                                    style="padding: 6px 10px; font-size: 12px;">
                                                <span class="material-icons" style="font-size: 16px; margin-right: 4px;">delete</span>
                                                Xóa
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 48px; text-align: center;">
                                <span class="material-icons" style="font-size: 64px; color: #9e9e9e; margin-bottom: 16px;">people</span>
                                <h3 style="margin-bottom: 8px;">Chưa có người dùng nào</h3>
                                <p style="color: #616161; margin-bottom: 24px;">Hãy thêm người dùng đầu tiên!</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($users->hasPages())
        <div class="material-card" style="padding: 16px; cursor: default;">
            <div style="display: flex; justify-content: center;">
                {{ $users->links() }}
            </div>
        </div>
    @endif
</div>

<style>
/* Table responsive */
@media (max-width: 768px) {
    .material-card table {
        font-size: 14px;
    }
    
    .material-card th,
    .material-card td {
        padding: 12px 8px;
    }
    
    .material-card .material-button {
        font-size: 11px;
        padding: 4px 8px;
    }
}
</style>
@endsection
