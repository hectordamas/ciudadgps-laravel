<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Models\Comment;
use App\Models\Commerce;
use App\Models\Like;
use App\Models\Code;
use App\Models\Article;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];

    protected $hidden = ['password','remember_token'];
 
    protected $casts = ['email_verified_at' => 'datetime'];

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function codes(){
        return $this->hasMany(Code::class);
    }

    public function commerces(){
        return $this->belongsToMany(Commerce::class, 'commerce_user');
    }

    public function articles(){
        return $this->hasMany(Article::class);
    }
}
