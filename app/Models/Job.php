<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Commerce;

class Job extends Model
{
    use HasFactory;

    protected $with = ['commerce'];

    public function commerce(){
        return $this->belongsTo(Commerce::class);
    }

    public function scopeByTitle($query, $search){
        if($search) 
            return $query->where('title', 'LIKE', "%$search%");
    }

    public function scopeByDescription($query, $search){
        if($search)
            return $query->where('description', 'LIKE', "%$search%");
    }

}
