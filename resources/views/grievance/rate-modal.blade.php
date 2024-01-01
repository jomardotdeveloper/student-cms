<div class="modal custom-modal fade" id="rate_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <form action="{{ route('grievances.update', ['grievance' => $grievance]) }}" method="POST" class="row" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="is_rate_form" value="1"/>

                    <div class="col-12 mb-2">
                        <div class="form-group">
                            <label for="">
                               Message ({{ $grievance->feedback ? $grievance->sentiment_analysis : "" }} )
                            </label>
                            <textarea name="feedback" id="feedback" class="form-control" cols="30" rows="10" required {{ $grievance->feedback ? "disabled" : "" }}>{{ $grievance->feedback }}</textarea>
                        </div>
                    </div>

                    @if (!$grievance->feedback)
                    <div class="col-12">
                        <input type="submit" value="Save" class="btn btn-primary"/>
                    </div>
                    @endif

                </form>
            </div>
        </div>
    </div>
</div>
