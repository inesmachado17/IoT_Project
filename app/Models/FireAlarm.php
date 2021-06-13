<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FireAlarm extends Model
{
    use HasFactory;

    protected $fillable = [
        'disabled', 'state'
    ];

    protected $hidden =  [
        'created_at', 'updated_at'
    ];
}
