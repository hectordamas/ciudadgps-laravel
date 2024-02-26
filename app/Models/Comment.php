<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Commerce;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function commerce(){
        return $this->belongsTo(Commerce::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
