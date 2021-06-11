<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirConditioner extends Model
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
        return $this->hasMany(AirConditionerValue::class)->latest()->take(30);
    }
}
