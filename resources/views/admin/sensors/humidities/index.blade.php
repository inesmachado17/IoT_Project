@extends('admin.sensors.shared.history')

@section('table-tr')
    @foreach($humidities as $humd)
    <tr>
        <td class="text-center">{{ $humd['date'] }}</td>
        <td class="text-right">{{ $humd['value'] }} %</td>
    </tr>
    @endforeach
@endsection
