<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Commerce;
use App\Models\User;
use App\Models\Question;

class Answer extends Model
{
    use HasFactory;

    public function commerce(){
        return $this->belongsTo(Commerce::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function question(){
        return $this->belongsTo(Question::class);
    }

}
