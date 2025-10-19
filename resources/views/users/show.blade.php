@extends('activities.layout')

@section('title', 'Chi tiết người dùng')

@section('content')
<div style="display: flex; flex-direction: column; gap: 24px;">
    <!-- Page Header -->
    <div class="material-card" style="padding: 24px; cursor: default;">
        <div style="display: flex; align-items: center; gap: 16px;">
            <a href="{{ route('users.index') }}" 
               class="material-button material-button-secondary" style="text-decoration: none;">
                <span class="material-icons" style="margin-right: 8px;">arrow_back</span>
                Quay lại
            </a>
            <div>
                <h2 class="material-typography-h1" style="font-size: 28px; margin-bottom: 8px;">Chi tiết người dùng</h2>
                <p class="material-typography-body1" style="color: #616161; margin: 0;">Thông tin chi tiết về {{ $user->name }}</p>
            </div>
        </div>
    </div>

    <!-- User Details Card -->
    <div class="material-card" style="overflow: hidden; cursor: default;">
        <!-- Card Header -->
        <div style="background: linear-gradient(135deg, #9c27b0 0%, #673ab7 100%); color: white; padding: 32px;">
            <div style="display: flex; align-items: center; gap: 16px;">
                <div style="width: 80px; height: 80px; background-color: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <span class="material-icons" style="font-size: 40px;">person</span>
                </div>
                <div>
                    <h3 class="material-typography-h2" style="color: white; margin: 0 0 8px 0;">{{ $user->name }}</h3>
                    <p class="material-typography-body1" style="color: rgba(255,255,255,0.9); margin: 0;">{{ $user->email }}</p>
                </div>
            </div>
        </div>

        <!-- Card Body -->
        <div style="padding: 32px;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px;">
                <!-- Basic Information -->
                <div>
                    <h4 class="material-typography-h3" style="margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                        <span class="material-icons" style="font-size: 20px;">info</span>
                        Thông tin cơ bản
                    </h4>
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #f0f0f0;">
                            <span style="font-weight: 500; color: #666;">ID:</span>
                            <span>{{ $user->id }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #f0f0f0;">
                            <span style="font-weight: 500; color: #666;">Tên:</span>
                            <span>{{ $user->name }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #f0f0f0;">
                            <span style="font-weight: 500; color: #666;">Email:</span>
                            <span>{{ $user->email }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #f0f0f0;">
                            <span style="font-weight: 500; color: #666;">Vai trò:</span>
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
                        </div>
                    </div>
                </div>

                <!-- Account Information -->
                <div>
                    <h4 class="material-typography-h3" style="margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                        <span class="material-icons" style="font-size: 20px;">account_circle</span>
                        Thông tin tài khoản
                    </h4>
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #f0f0f0;">
                            <span style="font-weight: 500; color: #666;">Ngày tạo:</span>
                            <span>{{ $user->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #f0f0f0;">
                            <span style="font-weight: 500; color: #666;">Cập nhật cuối:</span>
                            <span>{{ $user->updated_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #f0f0f0;">
                            <span style="font-weight: 500; color: #666;">Email xác thực:</span>
                            <span style="color: {{ $user->email_verified_at ? '#4caf50' : '#f44336' }};">
                                {{ $user->email_verified_at ? 'Đã xác thực' : 'Chưa xác thực' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activities Count (if organization) -->
            @if($user->role === 'organization')
                <div style="margin-top: 32px; padding-top: 24px; border-top: 1px solid #e0e0e0;">
                    <h4 class="material-typography-h3" style="margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                        <span class="material-icons" style="font-size: 20px;">event_note</span>
                        Hoạt động
                    </h4>
                    <div style="background-color: #f5f5f5; padding: 16px; border-radius: 8px;">
                        <p style="margin: 0; color: #666;">
                            Tổ chức này đã tạo <strong>{{ $user->activities->count() }}</strong> hoạt động
                        </p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Card Footer -->
        <div style="background-color: #f5f5f5; padding: 16px 32px; display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #e0e0e0;">
            <a href="{{ route('users.index') }}" class="material-button material-button-secondary" style="text-decoration: none;">
                <span class="material-icons" style="margin-right: 8px;">arrow_back</span>
                Quay lại danh sách
            </a>
            
            <div style="display: flex; align-items: center; gap: 12px;">
                <a href="{{ route('users.edit', $user->id) }}" class="material-button material-button-primary" style="text-decoration: none;">
                    <span class="material-icons" style="margin-right: 8px;">edit</span>
                    Chỉnh sửa
                </a>
                
                @if($user->id !== Auth::user()->id)
                    <form action="{{ route('users.destroy', $user->id) }}" 
                          method="POST" 
                          style="display: inline;"
                          onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="material-button material-button-danger">
                            <span class="material-icons" style="margin-right: 8px;">delete</span>
                            Xóa
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
