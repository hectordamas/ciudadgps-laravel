<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Commerce;

class Weekday extends Model
{
    use HasFactory;

    public function commerces(){
        return $this
            ->belongsToMany(Commerce::class, 'commerce_weekday')
            ->withPivot('hour_open', 'hour_minute', 'hour_close', 'minute_close');
    }
}
