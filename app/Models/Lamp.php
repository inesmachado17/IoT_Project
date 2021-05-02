<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lamp extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'setting', 'timer', 'state'
    ];

    protected $hidden =  [
        'created_at', 'updated_at'
    ];

    public function history()
    {
        return $this->hasMany(BlindState::class)->latest()->take(30);
    }
}
