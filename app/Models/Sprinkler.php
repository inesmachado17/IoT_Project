<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sprinkler extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'timer', 'state', 'value'
    ];

    protected $hidden =  [
        'created_at', 'updated_at'
    ];

    public function history()
    {
        return $this->hasMany(SprinklerValue::class)->latest()->take(30);
    }
}
