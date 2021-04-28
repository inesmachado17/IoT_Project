@extends('admin.sensors.shared.history')

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
