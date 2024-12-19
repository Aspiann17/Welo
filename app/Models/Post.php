<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'creator',
    ];

    /**
     * Automatically generating a slug based on the title
     */
    protected static function booted()
    {
        static::saving(function ($post) {
            $post->slug = Str::slug($post->title);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'creator');
    }
}
