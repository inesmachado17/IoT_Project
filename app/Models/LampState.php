<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LampState extends Model
{
    use HasFactory;

    public function lamp()
    {
        return $this->belongsTo(Lamp::class);
    }
}
