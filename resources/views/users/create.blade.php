@extends('activities.layout')

@section('title', 'Thêm người dùng mới')

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
                <h2 class="material-typography-h1" style="font-size: 28px; margin-bottom: 8px;">Thêm người dùng mới</h2>
                <p class="material-typography-body1" style="color: #616161; margin: 0;">Tạo tài khoản người dùng mới trong hệ thống</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="material-card" style="overflow: hidden; cursor: default;">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            
            <!-- Form Header -->
            <div style="background: linear-gradient(135deg, #4caf50 0%, #45a049 100%); color: white; padding: 24px 32px;">
                <h3 class="material-typography-h2" style="color: white; margin: 0 0 8px 0; display: flex; align-items: center; gap: 12px;">
                    <span class="material-icons" style="font-size: 28px;">person_add</span>
                    Thông tin người dùng
                </h3>
                <p class="material-typography-body1" style="color: rgba(255,255,255,0.9); margin: 0;">Nhập thông tin để tạo tài khoản mới</p>
            </div>

            <!-- Form Body -->
            <div style="padding: 32px; display: flex; flex-direction: column; gap: 24px;">
                <!-- Name Field -->
                <div class="material-form-field">
                    <label for="name" class="material-form-label">
                        Tên người dùng <span style="color: #d32f2f;">*</span>
                    </label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name') }}"
                           placeholder="Nhập tên người dùng..."
                           class="material-form-input @error('name') material-form-input-error @enderror">
                    @error('name')
                        <div class="material-form-error">
                            <span class="material-icons" style="font-size: 16px;">error</span>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="material-form-field">
                    <label for="email" class="material-form-label">
                        Email <span style="color: #d32f2f;">*</span>
                    </label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           value="{{ old('email') }}"
                           placeholder="Nhập email..."
                           class="material-form-input @error('email') material-form-input-error @enderror">
                    @error('email')
                        <div class="material-form-error">
                            <span class="material-icons" style="font-size: 16px;">error</span>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="material-form-field">
                    <label for="password" class="material-form-label">
                        Mật khẩu <span style="color: #d32f2f;">*</span>
                    </label>
                    <input type="password" 
                           name="password" 
                           id="password" 
                           placeholder="Nhập mật khẩu..."
                           class="material-form-input @error('password') material-form-input-error @enderror">
                    @error('password')
                        <div class="material-form-error">
                            <span class="material-icons" style="font-size: 16px;">error</span>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password Confirmation Field -->
                <div class="material-form-field">
                    <label for="password_confirmation" class="material-form-label">
                        Xác nhận mật khẩu <span style="color: #d32f2f;">*</span>
                    </label>
                    <input type="password" 
                           name="password_confirmation" 
                           id="password_confirmation" 
                           placeholder="Nhập lại mật khẩu..."
                           class="material-form-input @error('password_confirmation') material-form-input-error @enderror">
                    @error('password_confirmation')
                        <div class="material-form-error">
                            <span class="material-icons" style="font-size: 16px;">error</span>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Role Field -->
                <div class="material-form-field">
                    <label for="role" class="material-form-label">
                        Vai trò <span style="color: #d32f2f;">*</span>
                    </label>
                    <select name="role" 
                            id="role"
                            class="material-form-select @error('role') material-form-input-error @enderror">
                        <option value="">Chọn vai trò</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>👑 Admin</option>
                        <option value="organization" {{ old('role') == 'organization' ? 'selected' : '' }}>🏢 Tổ chức</option>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>👤 Người dùng</option>
                    </select>
                    @error('role')
                        <div class="material-form-error">
                            <span class="material-icons" style="font-size: 16px;">error</span>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Form Footer -->
            <div style="background-color: #f5f5f5; padding: 16px 32px; display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #e0e0e0;">
                <a href="{{ route('users.index') }}" class="material-button material-button-secondary" style="text-decoration: none;">
                    <span class="material-icons" style="margin-right: 8px;">cancel</span>
                    Hủy
                </a>
                
                <button type="submit" class="material-button material-button-primary">
                    <span class="material-icons" style="margin-right: 8px;">save</span>
                    Tạo người dùng
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
