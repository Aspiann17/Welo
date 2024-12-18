<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'creator',
        'content',
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
