<div class="modal custom-modal fade" id="sentiment_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Chart</h3>
                </div>
                <form action="{{ route('imports.chart') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="title" value="Sentiment Analysis">
                    <input type="hidden" name="is_sentiment"  value="1"/>

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
                            Data
                        </label>
                        <select class="form-control" name="data_type" id="data_type">
                            <option value="sentiment_value">Sentiment Value</option>
                            <option value="count">Count</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="">
                            Column
                        </label>
                        <select class="form-control" name="column" id="column">
                            @foreach ($columns as $column)
                            <option value="{{ $column }}">{{ $column }}</option>
                            @endforeach
                        </select>
                    </div>


                    <input type="submit" value="Get Sentiment" class="btn btn-primary mt-2"/>
                </form>
            </div>
        </div>
    </div>
</div>
