<?php

namespace App\Models;

use App\Enums\PublishedType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = "comments";
    
    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();
        self::creating(function(Comment $comment){
            $comment->isPublished = PublishedType::ACTIVE;
        });
    }

    public function news()
    {
        return $this->belongsTo(News::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
