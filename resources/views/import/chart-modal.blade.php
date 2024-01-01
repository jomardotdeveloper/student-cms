<div class="modal custom-modal fade" id="chart_modal" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Chart</h3>
                </div>
                <form action="{{ route('imports.chart') }}" class="row" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="">
                            Title
                        </label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="">
                            Chart
                        </label>
                        <select class="form-control" name="chart_type" id="chart_type">
                            <option value="bar">Bar</option>
                            <option value="line">Line</option>
                            <option value="pie">Pie</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="">
                            Column
                        </label>
                        <select class="form-control" name="column" id="chart_column" required>
                            <option value="">Select Column</option>

                            @foreach ($columns as $column)
                            <option value="{{ $column }}">{{ $column }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label>Data</label>
                        <select class="form-control" style="height: 100%;" id="data_multiple_select" name="data_to_include[]" multiple="multiple" required>
                        </select>
                    </div>


                    <input type="submit" value="Generate Chart" class="btn btn-primary mt-2"/>
                </form>
            </div>
        </div>
    </div>
</div>
