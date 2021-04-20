<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Humidity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'state', 'trigger'
    ];

    protected $hidden =  [
        'created_at', 'updated_at'
    ];
}
