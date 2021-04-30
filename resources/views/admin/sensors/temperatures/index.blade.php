@extends('admin.sensors.shared.history')

@section('svg-icon')
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-thermometer-half"
    viewBox="0 0 16 16">
    <path d="M9.5 12.5a1.5 1.5 0 1 1-2-1.415V6.5a.5.5 0 0 1 1 0v4.585a1.5 1.5 0 0 1 1 1.415z" />
    <path
        d="M5.5 2.5a2.5 2.5 0 0 1 5 0v7.55a3.5 3.5 0 1 1-5 0V2.5zM8 1a1.5 1.5 0 0 0-1.5 1.5v7.987l-.167.15a2.5 2.5 0 1 0 3.333 0l-.166-.15V2.5A1.5 1.5 0 0 0 8 1z" />
</svg>
@endsection

@section('table-tr')
@foreach($temperatures as $temp)
<tr>
    <td class="text-center">{{ (new \Carbon\Carbon($temp['date']))->setTimezone('Europe/Lisbon') }}</td>
    <td class="text-right">{{ $temp['value'] }} ºC</td>
</tr>
@endforeach
@endsection

@section('script')
<script>
    const canvasElement = document.getElementById('myChart');
    const ctx = canvasElement.getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chart['x']) !!},
            datasets: [
                {
                    label: 'temp ºC',
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
