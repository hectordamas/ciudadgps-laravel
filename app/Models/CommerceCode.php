<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Commerce;

class CommerceCode extends Model
{
    use HasFactory;

    protected $table = 'commerce_codes';

    public function commerce() {
        return $this->belongsTo(Commerce::class);
    }
}
