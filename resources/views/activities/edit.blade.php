@extends('activities.layout')

@section('title', 'Chỉnh sửa hoạt động')

@section('content')
<div style="display: flex; flex-direction: column; gap: 24px;">
    <!-- Page Header -->
    <div class="material-card" style="padding: 24px; cursor: default;">
        <div style="display: flex; align-items: center; gap: 16px;">
            <a href="{{ route('activities.show', $activity->id) }}" 
               class="material-button material-button-secondary" style="text-decoration: none;">
                <span class="material-icons" style="margin-right: 8px;">arrow_back</span>
                Quay lại
            </a>
            <div>
                <h2 class="material-typography-h1" style="font-size: 28px; margin-bottom: 8px;">Chỉnh sửa hoạt động</h2>
                <p class="material-typography-body1" style="color: #616161; margin: 0;">Cập nhật thông tin hoạt động "{{ $activity->title }}"</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="material-card" style="overflow: hidden; cursor: default;">
        <form action="{{ route('activities.update', $activity->id) }}" method="POST">
    @csrf
    @method('PUT')

            <!-- Form Header -->
            <div style="background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%); color: white; padding: 24px 32px;">
                <h3 class="material-typography-h2" style="color: white; margin: 0 0 8px 0; display: flex; align-items: center; gap: 12px;">
                    <span class="material-icons" style="font-size: 28px;">edit</span>
                    Thông tin cơ bản
                </h3>
                <p class="material-typography-body1" style="color: rgba(255,255,255,0.9); margin: 0;">Cập nhật các thông tin cho hoạt động</p>
            </div>

            <!-- Form Body -->
            <div style="padding: 32px; display: flex; flex-direction: column; gap: 24px;">
                <!-- Title Field -->
                <div class="material-form-field">
                    <label for="title" class="material-form-label">
                        Tên hoạt động <span style="color: #d32f2f;">*</span>
                    </label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           value="{{ old('title', $activity->title) }}"
                           placeholder="Nhập tên hoạt động..."
                           class="material-form-input @error('title') material-form-input-error @enderror">
    @error('title')
                        <div class="material-form-error">
                            <span class="material-icons" style="font-size: 16px;">error</span>
                            {{ $message }}
                        </div>
    @enderror
                </div>

                <!-- Content Field -->
                <div class="material-form-field">
                    <label for="content" class="material-form-label">
                        Mô tả chi tiết
                    </label>
                    <textarea name="content" 
                              id="content" 
                              rows="6"
                              placeholder="Mô tả chi tiết về hoạt động..."
                              class="material-form-textarea @error('content') material-form-input-error @enderror">{{ old('content', $activity->content) }}</textarea>
    @error('content')
                        <div class="material-form-error">
                            <span class="material-icons" style="font-size: 16px;">error</span>
                            {{ $message }}
                        </div>
    @enderror
                </div>

                <!-- Link Field -->
                <div class="material-form-field">
                    <label for="link" class="material-form-label">
                        Liên kết <span style="color: #d32f2f;">*</span>
                    </label>
                    <input type="url" 
                           name="link" 
                           id="link" 
                           value="{{ old('link', $activity->link) }}"
                           placeholder="https://example.com"
                           class="material-form-input @error('link') material-form-input-error @enderror">
    @error('link')
                        <div class="material-form-error">
                            <span class="material-icons" style="font-size: 16px;">error</span>
                            {{ $message }}
                        </div>
    @enderror
                </div>

                <!-- Points and Category Row -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                    <!-- Points Field -->
                    <div class="material-form-field">
                        <label for="points" class="material-form-label">
                            Điểm thưởng <span style="color: #d32f2f;">*</span>
                        </label>
                        <div style="position: relative;">
                            <input type="number" 
                                   name="points" 
                                   id="points" 
                                   value="{{ old('points', $activity->points) }}"
                                   min="0" 
                                   max="20"
                                   placeholder="0"
                                   class="material-form-input @error('points') material-form-input-error @enderror">
                            <div style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: #9e9e9e; font-size: 14px;">
                                điểm
                            </div>
                        </div>
    @error('points')
                            <div class="material-form-error">
                                <span class="material-icons" style="font-size: 16px;">error</span>
                                {{ $message }}
                            </div>
    @enderror
                    </div>

                    <!-- Category Field -->
                    <div class="material-form-field">
                        <label for="category_id" class="material-form-label">
                            Danh mục <span style="color: #d32f2f;">*</span>
                        </label>
                        <select name="category_id" 
                                id="category_id"
                                class="material-form-select @error('category_id') material-form-input-error @enderror">
                            <option value="">Chọn danh mục</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $activity->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="material-form-error">
                                <span class="material-icons" style="font-size: 16px;">error</span>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Type Field -->
                <div class="material-form-field">
                    <label class="material-form-label">
                        Loại hoạt động <span style="color: #d32f2f;">*</span>
                    </label>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px;">
                        <label class="material-radio-card @error('type') material-form-input-error @enderror">
                            <input type="radio" name="type" value="1" {{ old('type', $activity->type) == '1' ? 'checked' : '' }} class="material-radio-input">
                            <div class="material-radio-content">
                                <div class="material-radio-indicator">
                                    <div class="material-radio-dot"></div>
                                </div>
                                <div>
                                    <div class="material-typography-body1" style="font-weight: 500; margin-bottom: 4px;">Mục 1</div>
                                    <div class="material-typography-caption">Loại hoạt động 1</div>
                                </div>
                            </div>
                        </label>
                        
                        <label class="material-radio-card @error('type') material-form-input-error @enderror">
                            <input type="radio" name="type" value="2" {{ old('type', $activity->type) == '2' ? 'checked' : '' }} class="material-radio-input">
                            <div class="material-radio-content">
                                <div class="material-radio-indicator">
                                    <div class="material-radio-dot"></div>
                                </div>
                                <div>
                                    <div class="material-typography-body1" style="font-weight: 500; margin-bottom: 4px;">Mục 2</div>
                                    <div class="material-typography-caption">Loại hoạt động 2</div>
                                </div>
                            </div>
                        </label>
                        
                        <label class="material-radio-card @error('type') material-form-input-error @enderror">
                            <input type="radio" name="type" value="3" {{ old('type', $activity->type) == '3' ? 'checked' : '' }} class="material-radio-input">
                            <div class="material-radio-content">
                                <div class="material-radio-indicator">
                                    <div class="material-radio-dot"></div>
                                </div>
                                <div>
                                    <div class="material-typography-body1" style="font-weight: 500; margin-bottom: 4px;">Mục 3</div>
                                    <div class="material-typography-caption">Loại hoạt động 3</div>
                                </div>
                            </div>
                        </label>
                    </div>
                    @error('type')
                        <div class="material-form-error">
                            <span class="material-icons" style="font-size: 16px;">error</span>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Time Fields -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                    <!-- Start Time Field -->
                    <div class="material-form-field">
                        <label for="start_at" class="material-form-label">
                            Thời gian bắt đầu <span style="color: #d32f2f;">*</span>
                        </label>
                        <input type="datetime-local" 
                               name="start_at" 
                               id="start_at" 
                               value="{{ old('start_at', \Carbon\Carbon::parse($activity->start_at)->format('Y-m-d\TH:i')) }}"
                               class="material-form-input @error('start_at') material-form-input-error @enderror">
    @error('start_at')
                            <div class="material-form-error">
                                <span class="material-icons" style="font-size: 16px;">error</span>
                                {{ $message }}
                            </div>
    @enderror
                    </div>

                    <!-- End Time Field -->
                    <div class="material-form-field">
                        <label for="end_at" class="material-form-label">
                            Thời gian kết thúc <span style="color: #d32f2f;">*</span>
                        </label>
                        <input type="datetime-local" 
                               name="end_at" 
                               id="end_at" 
                               value="{{ old('end_at', \Carbon\Carbon::parse($activity->end_at)->format('Y-m-d\TH:i')) }}"
                               class="material-form-input @error('end_at') material-form-input-error @enderror">
    @error('end_at')
                            <div class="material-form-error">
                                <span class="material-icons" style="font-size: 16px;">error</span>
                                {{ $message }}
                            </div>
    @enderror
                    </div>
                </div>

                <!-- Status Field -->
                <div class="material-form-field">
                    <label class="material-form-label">
                        Trạng thái hoạt động
                    </label>
                    <div style="display: flex; gap: 12px;">
                        <label class="material-radio-card">
                            <input type="radio" name="is_closed" value="0" {{ old('is_closed', $activity->is_closed ? '1' : '0') == '0' ? 'checked' : '' }} class="material-radio-input">
                            <div class="material-radio-content">
                                <div class="material-radio-indicator">
                                    <div class="material-radio-dot"></div>
                                </div>
                                <div>
                                    <div class="material-typography-body1" style="font-weight: 500; margin-bottom: 4px;">Đang mở</div>
                                    <div class="material-typography-caption">Hoạt động đang diễn ra</div>
                                </div>
                            </div>
                        </label>
                        
                        <label class="material-radio-card">
                            <input type="radio" name="is_closed" value="1" {{ old('is_closed', $activity->is_closed ? '1' : '0') == '1' ? 'checked' : '' }} class="material-radio-input">
                            <div class="material-radio-content">
                                <div class="material-radio-indicator">
                                    <div class="material-radio-dot"></div>
                                </div>
                                <div>
                                    <div class="material-typography-body1" style="font-weight: 500; margin-bottom: 4px;">Đã đóng</div>
                                    <div class="material-typography-caption">Hoạt động đã kết thúc</div>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Form Footer -->
            <div style="background-color: #f5f5f5; padding: 20px 32px; display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #e0e0e0;">
                <a href="{{ route('activities.show', $activity->id) }}" 
                   class="material-button material-button-secondary" style="text-decoration: none;">
                    <span class="material-icons" style="margin-right: 8px;">close</span>
                    Hủy bỏ
                </a>
                
                <button type="submit" class="material-button material-button-primary">
                    <span class="material-icons" style="margin-right: 8px;">save</span>
                    Cập nhật hoạt động
                </button>
            </div>
  </form>
    </div>
</div>

<style>
/* Material Design Form Components */
.material-form-field {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.material-form-label {
    font-size: 14px;
    font-weight: 500;
    color: #424242;
    margin: 0;
}

.material-form-input,
.material-form-textarea,
.material-form-select {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #e0e0e0;
    border-radius: 4px;
    font-size: 16px;
    font-family: 'Roboto', sans-serif;
    background-color: #ffffff;
    transition: all 0.3s cubic-bezier(0.4, 0.0, 0.2, 1);
    box-sizing: border-box;
}

.material-form-input:focus,
.material-form-textarea:focus,
.material-form-select:focus {
    outline: none;
    border-color: #1976d2;
    box-shadow: 0 0 0 2px rgba(25, 118, 210, 0.2);
}

.material-form-input-error,
.material-form-textarea.material-form-input-error,
.material-form-select.material-form-input-error {
    border-color: #d32f2f;
}

.material-form-input-error:focus,
.material-form-textarea.material-form-input-error:focus,
.material-form-select.material-form-input-error:focus {
    border-color: #d32f2f;
    box-shadow: 0 0 0 2px rgba(211, 47, 47, 0.2);
}

.material-form-textarea {
    resize: vertical;
    min-height: 120px;
}

.material-form-error {
    display: flex;
    align-items: center;
    gap: 4px;
    color: #d32f2f;
    font-size: 12px;
    margin-top: 4px;
}

.material-radio-card {
    display: flex;
    align-items: center;
    padding: 16px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0.0, 0.2, 1);
    background-color: #ffffff;
}

.material-radio-card:hover {
    background-color: #f5f5f5;
    border-color: #1976d2;
}

.material-radio-card.selected {
    border-color: #1976d2;
    background-color: #e3f2fd;
}

.material-radio-input {
    display: none;
}

.material-radio-content {
    display: flex;
    align-items: center;
    gap: 12px;
    width: 100%;
}

.material-radio-indicator {
    width: 20px;
    height: 20px;
    border: 2px solid #9e9e9e;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s cubic-bezier(0.4, 0.0, 0.2, 1);
}

.material-radio-dot {
    width: 8px;
    height: 8px;
    background-color: #1976d2;
    border-radius: 50%;
    opacity: 0;
    transition: opacity 0.3s cubic-bezier(0.4, 0.0, 0.2, 1);
}

.material-radio-card.selected .material-radio-indicator {
    border-color: #1976d2;
}

.material-radio-card.selected .material-radio-dot {
    opacity: 1;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .material-container > div:first-child > div:last-child > div:last-child {
        flex-direction: column;
        gap: 8px;
    }
    
    .material-container > div:first-child > div:last-child > div:last-child > * {
        width: 100%;
        justify-content: center;
    }
    
    .material-container > div:first-child > div:last-child > div:last-child > div:first-child {
        grid-template-columns: 1fr;
    }
    
    .material-container > div:first-child > div:last-child > div:last-child > div:last-child {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
// Radio button interactions
document.querySelectorAll('.material-radio-input').forEach(radio => {
    radio.addEventListener('change', function() {
        // Remove selected class from all cards in the same group
        const groupName = this.name;
        document.querySelectorAll(`input[name="${groupName}"]`).forEach(input => {
            input.closest('.material-radio-card').classList.remove('selected');
        });
        
        // Add selected class to current card
        if (this.checked) {
            this.closest('.material-radio-card').classList.add('selected');
        }
    });
});

// Initialize radio button states
document.querySelectorAll('.material-radio-input:checked').forEach(radio => {
    radio.closest('.material-radio-card').classList.add('selected');
});
</script>
@endsection