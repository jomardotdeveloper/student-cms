@extends('master')

@section('content')
<!-- Datatable CSS -->

<div class="row">
    <div class="col-sm-12 mb-1">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="col-sm-12">
        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#csv_modal">
            Upload CSV
        </button>
        @include('import.upload-modal')
        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#chart_modal">
            Generate Chart
        </button>
        @include('import.chart-modal')

        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#sentiment_modal">
            Get Sentiment Analysis
        </button>
        @include('import.sentiment-modal', ["columns" => $columns, "bodies" => $bodies])

    </div>

    <div class="col-sm-12">
        @if(Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach(Session::get('error') as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
        @endif
    </div>

    <div class="col-sm-12">
        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
        @endif
    </div>
    <div class="col-sm-12">
        <div class="card mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Data</h4>
                <p class="card-text">
                    All <code>records</code>
                </p>
            </div>
            <div class="card-body">
                @if ($csv_file)
                <div class="table-responsive">
                    <table class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>
                            @foreach ($columns as $column)
                                <th>{{ $column }}</th>
                            @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bodies as $row)
                                <tr>
                                    @foreach ($row as $column)
                                        <td>{{ $column }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        <li>No CSV file uploaded</li>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>



@endsection
@push('scripts')
    <script>
        var chart_column_element = document.getElementById('chart_column');
        var data_multiple_select_element = document.getElementById('data_multiple_select');

        chart_column_element.addEventListener('change', function() {
            var selected_column = chart_column_element.value;
            // fetch the data
            if(selected_column == '') {
                data_multiple_select_element.innerHTML = '';
                return;
            }


            fetch('/backend/imports/similar-values/' + selected_column)
                .then(response => response.json())
                .then(data => {
                    console.log(data);

                    var options = '';

                    for(var i = 0; i < data.length; i++) {
                        options += '<option value="' + data[i] + '">' + data[i] + '</option>';
                    }


                    data_multiple_select_element.innerHTML = options;

                });
        });
    </script>
@endpush
