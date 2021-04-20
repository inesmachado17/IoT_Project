<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temperature extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'state', 'trigger'
    ];

    protected $hidden =  [
        'created_at', 'updated_at'
    ];
}
