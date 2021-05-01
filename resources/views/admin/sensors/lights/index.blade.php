@extends('admin.sensors.shared.history')

@section('table-tr')
@foreach($lights as $light)
<tr>
    <td class="text-center">{{ (new \Carbon\Carbon($light['date']))->setTimezone('Europe/Lisbon') }}</td>
    <td class="text-right">{{ $light['value'] }}</td>
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
                    label: 'índice de Claridade das últimas 24 horas',
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
