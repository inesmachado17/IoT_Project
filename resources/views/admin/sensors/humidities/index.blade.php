@extends('admin.sensors.shared.history')

@section('table-tr')
@foreach($humidities as $humd)
<tr>
    <td class="text-center">{{ (new \Carbon\Carbon($humd['date']))->setTimezone('Europe/Lisbon') }}</td>
    <td class="text-right">{{ $humd['value'] }} %</td>
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
                    label: 'índice de Humidade das últimas 24 horas',
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
