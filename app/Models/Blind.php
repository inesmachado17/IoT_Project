<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blind extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'setting', 'state', 'value'
    ];

    protected $hidden =  [
        'created_at', 'updated_at'
    ];

    public function history()
    {
        return $this->hasMany(BlindState::class)->latest()->take(30);
    }
}
