<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Commerce;

class Category extends Model
{
    use HasFactory;
    
    public function commerces(){
        return $this->belongsToMany(Commerce::class, 'categories_commerces');    
    }
}
