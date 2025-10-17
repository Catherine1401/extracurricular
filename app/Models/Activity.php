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
        'category',
        'is_closed',
        'start_at',
        'end_at'
    ];
}
