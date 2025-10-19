@extends('activities.layout')

@section('title', $activity->title)

@section('content')
<div style="display: flex; flex-direction: column; gap: 24px;">
    <!-- Back Button -->
    <div style="display: flex; align-items: center; gap: 16px;">
        <a href="{{ route('activities.index') }}" 
           class="material-button material-button-secondary" style="text-decoration: none;">
            <span class="material-icons" style="margin-right: 8px;">arrow_back</span>
            Quay lại danh sách
        </a>
    </div>

    <!-- Activity Detail Card -->
    <div class="material-card" style="overflow: hidden; cursor: default;">
        <!-- Card Header -->
        <div style="background: linear-gradient(135deg, #1976d2 0%, #1565c0 100%); color: white; padding: 32px;">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px; flex-wrap: wrap;">
                @if($activity->category)
                    <span class="category-chip category-{{ $activity->category->id }}" style="background-color: rgba(255,255,255,0.2); color: white;">
                        {{ $activity->category->name }}
                    </span>
                @else
                    <span class="category-chip category-none" style="background-color: rgba(255,255,255,0.2); color: white;">
                        Chưa phân loại
                    </span>
                @endif
                <span class="points-chip" style="background: rgba(255,255,255,0.2); color: white;">
                    {{ $activity->points }} điểm
                </span>
                <span class="status-chip {{ $activity->is_closed ? 'status-closed' : 'status-open' }}" style="background-color: rgba(255,255,255,0.2); color: white;">
                    {{ $activity->is_closed ? 'Đã đóng' : 'Đang mở' }}
                </span>
            </div>
            
            <h1 class="material-typography-h1" style="color: white; font-size: 32px; margin-bottom: 16px; line-height: 1.2;">
                {{ $activity->title }}
            </h1>
            
            <div style="display: flex; flex-wrap: wrap; gap: 24px; margin-bottom: 16px;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span class="material-icons" style="font-size: 20px;">schedule</span>
                    <div>
                        <div class="material-typography-caption" style="color: rgba(255,255,255,0.8);">Bắt đầu</div>
                        <div class="material-typography-body1" style="color: white; font-weight: 500;">
                            {{ \Carbon\Carbon::parse($activity->start_at)->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span class="material-icons" style="font-size: 20px;">event</span>
                    <div>
                        <div class="material-typography-caption" style="color: rgba(255,255,255,0.8);">Kết thúc</div>
                        <div class="material-typography-body1" style="color: white; font-weight: 500;">
                            {{ \Carbon\Carbon::parse($activity->end_at)->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Body -->
        <div style="padding: 32px;">
            @if($activity->content)
                <div style="margin-bottom: 32px;">
                    <h2 class="material-typography-h2" style="margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                        <span class="material-icons" style="font-size: 24px; color: #1976d2;">description</span>
                        Mô tả chi tiết
                    </h2>
                    <div style="background-color: #f8f9fa; padding: 16px; border-radius: 8px; border-left: 4px solid #1976d2;">
                        <p class="material-typography-body1" style="margin: 0; white-space: pre-line; line-height: 1.6;">
                            {{ $activity->content }}
                        </p>
                    </div>
                </div>
            @endif

            @if($activity->link)
                <div style="margin-bottom: 32px;">
                    <h2 class="material-typography-h2" style="margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                        <span class="material-icons" style="font-size: 24px; color: #1976d2;">link</span>
                        Liên kết
                    </h2>
                    <a href="{{ $activity->link }}" 
                       target="_blank" 
                       class="material-button material-button-primary" style="text-decoration: none;">
                        <span class="material-icons" style="margin-right: 8px;">open_in_new</span>
                        Truy cập liên kết
                    </a>
                </div>
            @endif

            <!-- Activity Info Grid -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 16px; margin-bottom: 32px;">
                <div class="material-card" style="padding: 20px; cursor: default;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="background-color: #e3f2fd; padding: 12px; border-radius: 50%;">
                            <span class="material-icons" style="font-size: 24px; color: #1976d2;">category</span>
                        </div>
                        <div>
                            <h3 class="material-typography-body2" style="color: #616161; margin: 0 0 4px 0; font-weight: 500;">Loại hoạt động</h3>
                            <p class="material-typography-body1" style="margin: 0; font-weight: 500;">
                                @switch($activity->type)
                                    @case(1)
                                        Mục 1
                                        @break
                                    @case(2)
                                        Mục 2
                                        @break
                                    @case(3)
                                        Mục 3
                                        @break
                                @endswitch
                            </p>
                        </div>
                    </div>
                </div>

                <div class="material-card" style="padding: 20px; cursor: default;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="background-color: #e8f5e8; padding: 12px; border-radius: 50%;">
                            <span class="material-icons" style="font-size: 24px; color: #2e7d32;">star</span>
                        </div>
                        <div>
                            <h3 class="material-typography-body2" style="color: #616161; margin: 0 0 4px 0; font-weight: 500;">Điểm thưởng</h3>
                            <p class="material-typography-body1" style="margin: 0; font-weight: 500;">{{ $activity->points }} điểm</p>
                        </div>
                    </div>
                </div>

                <div class="material-card" style="padding: 20px; cursor: default;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="background-color: #f3e5f5; padding: 12px; border-radius: 50%;">
                            <span class="material-icons" style="font-size: 24px; color: #7b1fa2;">access_time</span>
                        </div>
                        <div>
                            <h3 class="material-typography-body2" style="color: #616161; margin: 0 0 4px 0; font-weight: 500;">Tạo lúc</h3>
                            <p class="material-typography-body1" style="margin: 0; font-weight: 500;">{{ $activity->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Footer -->
        <div style="background-color: #f5f5f5; padding: 20px 32px; display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #e0e0e0;">
            <div class="material-typography-caption" style="color: #9e9e9e;">
                Cập nhật lần cuối: {{ $activity->updated_at->format('d/m/Y H:i') }}
            </div>
            
            <div style="display: flex; align-items: center; gap: 12px;">
                <a href="{{ route('activities.edit', $activity->id) }}" 
                   class="material-button material-button-primary" style="text-decoration: none;">
                    <span class="material-icons" style="margin-right: 8px;">edit</span>
                    Chỉnh sửa
                </a>
                
                <form action="{{ route('activities.destroy', $activity->id) }}" 
                      method="POST" 
                      style="display: inline;"
                      onsubmit="return confirm('Bạn có chắc chắn muốn xóa hoạt động này? Hành động này không thể hoàn tác.')">
    @csrf
    @method('DELETE')
                    <button type="submit" class="material-button material-button-danger">
                        <span class="material-icons" style="margin-right: 8px;">delete</span>
                        Xóa
                    </button>
  </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Responsive adjustments */
@media (max-width: 768px) {
    .material-container > div:first-child > div:last-child > div:last-child {
        flex-direction: column;
        gap: 8px;
    }
    
    .material-container > div:first-child > div:last-child > div:last-child > div:last-child {
        flex-direction: column;
        width: 100%;
    }
    
    .material-container > div:first-child > div:last-child > div:last-child > div:last-child > * {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endsection