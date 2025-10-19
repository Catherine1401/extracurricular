@extends('activities.layout')

@section('title', 'Danh sách hoạt động ngoại khóa')

@section('content')
<div style="display: flex; flex-direction: column; gap: 24px;">
    <!-- Page Header -->
    <div class="material-card" style="padding: 24px; cursor: default;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h2 class="material-typography-h1" style="font-size: 28px; margin-bottom: 8px;">Hoạt động ngoại khóa</h2>
                <p class="material-typography-body1" style="color: #616161; margin: 0;">Khám phá các hoạt động thú vị và bổ ích</p>
            </div>
        </div>
    </div>

    <!-- Activities Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(400px, 1fr)); gap: 16px;">
        @forelse ($activities as $activity)
            <a href="{{ route('activities.show', $activity->id) }}" class="material-card clickable" style="text-decoration: none; color: inherit;">
                <!-- Card Header -->
                <div style="padding: 16px 16px 0 16px;">
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 12px; flex-wrap: wrap;">
                        @if($activity->category)
                            <span class="category-chip category-{{ $activity->category->id }}">
                                {{ $activity->category->name }}
                            </span>
                        @else
                            <span class="category-chip category-none">
                                Chưa phân loại
                            </span>
                        @endif
                        <span class="points-chip">{{ $activity->points }} điểm</span>
                        <span class="status-chip {{ $activity->is_closed ? 'status-closed' : 'status-open' }}">
                            {{ $activity->is_closed ? 'Đã đóng' : 'Đang mở' }}
                        </span>
                    </div>
                    
                    <h3 class="material-typography-h2" style="font-size: 18px; margin-bottom: 8px; line-height: 1.3;">
                        {{ $activity->title }}
                    </h3>
                    
                    @if($activity->content)
                        <p class="material-typography-body2" style="margin-bottom: 16px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                            {{ Str::limit($activity->content, 150) }}
                        </p>
                    @endif
                </div>

                <!-- Card Body -->
                <div style="padding: 0 16px 16px 16px;">
                    <div style="display: flex; flex-direction: column; gap: 8px; margin-bottom: 16px;">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <span class="material-icons" style="font-size: 16px; color: #616161;">schedule</span>
                            <span class="material-typography-caption" style="color: #616161;">
                                Bắt đầu: {{ \Carbon\Carbon::parse($activity->start_at)->format('d/m/Y H:i') }}
                            </span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <span class="material-icons" style="font-size: 16px; color: #616161;">event</span>
                            <span class="material-typography-caption" style="color: #616161;">
                                Kết thúc: {{ \Carbon\Carbon::parse($activity->end_at)->format('d/m/Y H:i') }}
                            </span>
                        </div>
                    </div>

                    @if($activity->link)
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px;">
                            <span class="material-icons" style="font-size: 16px; color: #1976d2;">link</span>
                            <span class="material-typography-body2" style="color: #1976d2;">Có liên kết</span>
                        </div>
                    @endif
                </div>

                <!-- Card Footer -->
                <div style="background-color: #f5f5f5; padding: 12px 16px; display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #e0e0e0;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span class="material-icons" style="font-size: 16px; color: #9e9e9e;">access_time</span>
                        <span class="material-typography-caption">
                            {{ $activity->created_at->format('d/m/Y H:i') }}
                        </span>
                    </div>
                    
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span class="material-icons" style="font-size: 16px; color: #1976d2;">arrow_forward</span>
                    </div>
                </div>
            </a>
        @empty
            <!-- Empty State -->
            <div class="material-card" style="grid-column: 1 / -1; padding: 48px 24px; text-align: center; cursor: default;">
                <span class="material-icons" style="font-size: 64px; color: #9e9e9e; margin-bottom: 16px;">event_available</span>
                <h3 class="material-typography-h2" style="margin-bottom: 8px;">Chưa có hoạt động nào</h3>
                <p class="material-typography-body1" style="color: #616161; margin-bottom: 24px;">Hãy tạo hoạt động đầu tiên để bắt đầu!</p>
                <a href="{{ route('activities.create') }}" class="material-button material-button-primary">
                    <span class="material-icons" style="margin-right: 8px;">add</span>
                    Tạo hoạt động mới
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($activities->hasPages())
        <div class="material-card" style="padding: 16px; cursor: default;">
            <div style="display: flex; justify-content: center;">
                {{ $activities->links() }}
            </div>
        </div>
    @endif
</div>

<style>
/* Custom pagination styling to match Material Design */
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
    list-style: none;
    padding: 0;
    margin: 0;
}

.pagination li {
    display: flex;
}

.pagination a,
.pagination span {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 40px;
    height: 40px;
    padding: 0 12px;
    border-radius: 4px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.3s cubic-bezier(0.4, 0.0, 0.2, 1);
}

.pagination a {
    color: #1976d2;
    background-color: transparent;
}

.pagination a:hover {
    background-color: rgba(25, 118, 210, 0.1);
}

.pagination .active span {
    background-color: #1976d2;
    color: white;
    box-shadow: 0 2px 4px rgba(25, 118, 210, 0.3);
}

.pagination .disabled span {
    color: #9e9e9e;
    cursor: not-allowed;
}

/* Responsive grid */
@media (max-width: 768px) {
    .material-container > div:first-child > div:last-child {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection