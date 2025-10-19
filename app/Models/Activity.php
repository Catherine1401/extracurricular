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
        'is_closed',
        'start_at',
        'end_at'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }
    
    public function organization() {
        return $this->belongsTo(User::class, 'organization_id');
    }
}
