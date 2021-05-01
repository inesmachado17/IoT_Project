@extends('admin.sensors.shared.history')

@section('svg-icon')
{{-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wind"
    viewBox="0 0 16 16">
    <path
        d="M12.5 2A2.5 2.5 0 0 0 10 4.5a.5.5 0 0 1-1 0A3.5 3.5 0 1 1 12.5 8H.5a.5.5 0 0 1 0-1h12a2.5 2.5 0 0 0 0-5zm-7 1a1 1 0 0 0-1 1 .5.5 0 0 1-1 0 2 2 0 1 1 2 2h-5a.5.5 0 0 1 0-1h5a1 1 0 0 0 0-2zM0 9.5A.5.5 0 0 1 .5 9h10.042a3 3 0 1 1-3 3 .5.5 0 0 1 1 0 2 2 0 1 0 2-2H.5a.5.5 0 0 1-.5-.5z" />
</svg> --}}
<i class="fas fa-smog"></i>
@endsection

@section('table-tr')
@foreach($smokes as $smoke)
<tr>
    <td class="text-center">{{ (new \Carbon\Carbon($smoke['date']))->setTimezone('Europe/Lisbon') }}</td>
    <td class="text-right {{ $smoke['value'] > 299 ? 'text-danger' : ''}}">{{ $smoke['value'] }}</td>
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
                    label: 'índice de Fumaça das últimas 24 horas',
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
