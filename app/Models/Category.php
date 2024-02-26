<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Commerce;

class Category extends Model
{
    use HasFactory;

    public function commerces(){
        return $this->hasMany(Commerce::class);    
    }
}
