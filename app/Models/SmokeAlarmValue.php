<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmokeAlarmValue extends Model
{
    use HasFactory;

    public function alarm()
    {
        return $this->belongsTo(SmokeAlarm::class);
    }
}
