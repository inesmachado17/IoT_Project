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
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00'],
            datasets: [{
                label: 'temp ºC',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderCorlor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
    });
</script>
@endsection
