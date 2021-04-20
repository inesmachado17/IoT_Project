<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Door extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'open'
    ];

    protected $hidden =  [
        'created_at', 'updated_at'
    ];
}
