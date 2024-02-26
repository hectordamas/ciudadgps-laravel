<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StoryItem;
use App\Models\Commerce;


class Story extends Model
{
    protected $guarded = [];

    use HasFactory;

    public function commerce() {
        return $this->belongsTo(Commerce::class);
    }
}
