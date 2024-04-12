<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article;

class Atag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    public function articles(){
        return $this->belongsToMany(Article::class, 'articles_atags');
    }
}
