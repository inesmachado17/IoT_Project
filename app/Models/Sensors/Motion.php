<?php

namespace App\Models\Sensors;

use App\Models\Sensor;
use Carbon\Carbon;

class Motion extends Sensor
{
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
                return ((new Carbon($item->date))->setTimezone('Europe/Lisbon')->hour == $hour->hour
                && $item->value);
            });

                $axisY[] = $filter->count();
        }

        return [
            'x' => $axisX,
            'y' => $axisY
        ];
    }
}
