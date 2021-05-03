@extends('admin.sensors.shared.history')

@section('svg-icon')
<i class="fas fa-smog"></i>
@endsection

@section('table-tr')
@foreach($smokes as $smoke)
<tr>
    <td class="text-center">{{ (new \Carbon\Carbon($smoke['date']))->setTimezone('Europe/Lisbon') }}</td>
    <td class="text-center {{ $smoke['value'] > 299 ? 'text-danger' : ''}}">{{ $smoke['value'] }}</td>
</tr>
@endforeach
@endsection

@section('script')
<script>
    const sensorChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chart['x']) !!},
            datasets: [
                {
                    label: 'Índice de Fumo das últimas 24 horas',
                    data: {!! json_encode($chart['y']) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderCorlor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    spanGaps: true
                }
            ]
        },
    });
</script>
@endsection
