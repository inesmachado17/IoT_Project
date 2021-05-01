<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirConditionerValue extends Model
{
    use HasFactory;

    public function airConditioner()
    {
        return $this->belongsTo(AirConditioner::class);
    }
}
