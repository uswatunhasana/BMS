<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Enums\PublishedType;
use Illuminate\Support\Facades\Auth;
use Conner\Tagging\Taggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory, Sluggable, Taggable, SoftDeletes;

    protected $table = 'news';

    protected $fillable = [
        'title',
        'content',
        'thumbnail',
        'category_id',
        'isPublished',
        'user_id',
        'slug',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function(News $news){
            $news->isPublished = PublishedType::ACTIVE;
        });
        // self::updating(function ($model) {
        //     $model->updated_by = Auth::id();
        // });
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class, 'news_id')->whereNull('parent_id');
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
