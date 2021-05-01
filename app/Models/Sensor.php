<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;

    protected $fillable = [
        'value', 'date'
    ];

    public $timestamps = false;

    public function getChartAxisXY()
    {
        // Sensor chart shows the value for the last 24 hours
        $nowUTC = Carbon::now()->setTimezone('UTC');
        $last24hUTC = $nowUTC->copy()->subHours(24);
        // all registrers between now and last 24h, order by date to ensure the right order
        $temps = $this->orderBy('date')
            ->whereBetween('date', [$last24hUTC, $nowUTC])
            ->get();

        $nowForTimeZone = $nowUTC->setTimezone('Europe/Lisbon');
        $axisX = [];
        $axisY = [];

        for ($i = 23; $i >= 0; $i--) {
            $hour = $nowForTimeZone->copy()->subHours($i);
            $axisX[] = $hour->format('H');
            $filter = $temps->filter(function ($item) use ($hour) {
                return ((new Carbon($item->date))->setTimezone('Europe/Lisbon')->hour == $hour->hour);
            });

            if (count($filter) > 0) {
                $axisY[] = $filter->first()->value;
            } else {
                $axisY[] = null;
            }
        }

        return [
            'x' => $axisX,
            'y' => $axisY
        ];
    }
}
