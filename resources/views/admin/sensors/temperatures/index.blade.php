@extends('admin.sensors.shared.history')

@section('table-tr')
@foreach($temperatures as $temp)
<tr>
    <td class="text-center">{{ (new \Carbon\Carbon($temp['date']))->setTimezone('Europe/Lisbon') }}</td>
    <td class="text-right">{{ $temp['value'] }} ºC</td>
</tr>
@endforeach
@endsection
