@extends('admin.sensors.shared.history')

@section('table-tr')
    @foreach($smokes as $smoke)
    <tr>
        <td class="text-center">{{ $smoke['date'] }}</td>
        <td class="text-right {{ $smoke['value'] > 299 ? 'text-danger' : ''}}">{{ $smoke['value'] }}</td>
    </tr>
    @endforeach
@endsection
