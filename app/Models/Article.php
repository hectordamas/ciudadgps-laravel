<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Atag;
use App\Models\User;

class Article extends Model
{
    use HasFactory;

    public function atags() {
        return $this->belongsToMany(Atag::class, 'articles_atags');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
