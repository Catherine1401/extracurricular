<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'title',
        'content',
        'link',
        'points',
        'type',
        'category_id',
        'organization_id',
        'start_at',
        'end_at'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }
    
    public function organization() {
        return $this->belongsTo(User::class, 'organization_id');
    }
    
    /**
     * Kiểm tra xem hoạt động có đang mở hay không
     */
    public function isOpen() {
        return now()->isBefore($this->end_at);
    }
    
    /**
     * Kiểm tra xem hoạt động có đã đóng hay không
     */
    public function isClosed() {
        return now()->isAfter($this->end_at);
    }
    
    /**
     * Kiểm tra xem hoạt động có đang diễn ra hay không
     */
    public function isActive() {
        return now()->isBetween($this->start_at, $this->end_at);
    }
}
