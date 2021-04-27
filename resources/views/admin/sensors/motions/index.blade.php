@extends('admin.sensors.shared.history')

@section('table-tr')
    @foreach($motions as $motion)
    <tr>
        <td class="text-center">{{ $motion['date'] }}</td>
        <td class="text-center">{!! $motion['value'] == 0 ? '<i class="bi bi-person-check text-success"></i>' : '<i class="bi bi-person-x text-danger"></i>' !!}</td>
    </tr>
    @endforeach
@endsection
