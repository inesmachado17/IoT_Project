<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sprinkler extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'timer', 'state'
    ];

    protected $hidden =  [
        'created_at', 'updated_at'
    ];
}
