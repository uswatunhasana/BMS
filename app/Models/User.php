<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'updated_by',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at'
    ];

    // public static function boot()
    // {
    //     parent::boot();
    //     // dd(Auth::check());
    //     // self::updating(function (User $user) {
    //     //     $user->updated_by = Auth::id();
    //     // });
    // }

    public function news()
    {
        return $this->hasMany(News::class, 'user_id');
    }

    public function category()
    {
        return $this->hasMany(Category::class, 'user_id');
    }
}
