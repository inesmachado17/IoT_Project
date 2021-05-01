@extends('admin.sensors.shared.history')

@section('table-tr')
@foreach($motions as $motion)
<tr>
    <td class="text-center">{{ (new \Carbon\Carbon($motion['date']))->setTimezone('Europe/Lisbon') }}</td>
    <td class="text-center">{!! $motion['value'] == 0 ? '<i class="bi bi-person-check text-success"></i>' : '<i
            class="bi bi-person-x text-danger"></i>' !!}</td>
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
                    label: 'Presença de movimento das últimas 24 horas',
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
