<?php

namespace App\Models;

use App\Enums\PublishedType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'user_id',
        'isPublished',
    ];

    public static function boot()
    {
        parent::boot();
        // dd(Auth::check());
        self::creating(function(Category $category){
            $category->isPublished = PublishedType::ACTIVE;
        });
        // self::updating(function (Category $category) {
        //     $category->updated_by = Auth::id();
        // });
    }

    public function news()
    {
        return $this->hasMany(News::class, 'category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


}
