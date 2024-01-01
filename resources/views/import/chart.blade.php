@extends('master')

@section('content')
<div class="row">
    <div class="col-sm-12 mb-1">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="col-md-12 text-center">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">{{ $title }}</h3>
                <canvas id="chart"></canvas>
            </div>
        </div>
    </div>


</div>

@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('chart');
    const x = @json($x);
    const y = @json($y);

    console.log(x);
    console.log(y);

    new Chart(ctx, {
        type: '{{ $chart_type }}',
        data: {
        labels: x,
        datasets: [{
            label: "{{ $title }}",
            data: y,
            borderWidth: 1
        }]
        },
        options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
        }
    });
</script>

@endpush
