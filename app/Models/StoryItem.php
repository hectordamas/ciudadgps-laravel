<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Story;

class StoryItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Story(){
        return $this->belongsTo(Story::class);
    }
}
