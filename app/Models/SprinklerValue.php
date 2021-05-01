<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SprinklerValue extends Model
{
    use HasFactory;

    public function sprinkler() {
        return $this->belongsTo(Sprinkler::class);
    }
}
