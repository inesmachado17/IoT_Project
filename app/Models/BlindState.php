<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlindState extends Model
{
    use HasFactory;

    public function blind()
    {
        return $this->belongsTo(Blind::class);
    }
}
