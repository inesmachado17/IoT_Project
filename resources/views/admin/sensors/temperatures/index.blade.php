@extends('admin.sensors.shared.history')

@section('table-tr')
    @foreach($temperatures as $temp)
    <tr>
        <td class="text-center">{{ $temp['date'] }}</td>
        <td class="text-right">{{ $temp['value'] }} ºC</td>
    </tr>
    @endforeach
@endsection
