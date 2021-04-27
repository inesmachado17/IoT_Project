@extends('admin.sensors.shared.history')

@section('table-tr')
    @foreach($lights as $light)
    <tr>
        <td class="text-center">{{ $light['date'] }}</td>
        <td class="text-right">{{ $light['value'] }}</td>
    </tr>
    @endforeach
@endsection
