<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Commerce;

class GalleryItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function commerce(){
        return $this->belongsTo(Commerce::class);
    }
}
