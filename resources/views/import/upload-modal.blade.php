<div class="modal custom-modal fade" id="csv_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Upload CSV</h3>
                </div>
                <form action="{{ route('imports.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="is_update" value="1">
                    <div class="form-group">
                        <label for="">
                            CSV
                        </label>
                        <input type="file" name="csv_file" id="csv_file" class="form-control" required>
                    </div>


                    <input type="submit" value="Upload" class="btn btn-primary mt-2"/>
                </form>
            </div>
        </div>
    </div>
</div>
