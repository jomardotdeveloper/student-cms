<div class="modal custom-modal fade" id="verify_npl" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Verify NPL Modal</h3>
                </div>
                <form action="{{ route('grievances.update', ['grievance' => $grievance]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="verify_npl" value="1">
                    <div class="form-group">
                        <label for="">
                            Policies
                        </label>
                        @php
                            $policies = \App\Models\Policy::all();
                        @endphp
                        <select name="policies[]" id="policies" class="form-control" multiple required style="height:100%;">
                            @foreach ($policies as $policy)
                                <option value="{{ $policy->id }}">{{ $policy->policy }}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="submit" value="Save" class="btn btn-primary mt-2"/>
                </form>
            </div>
        </div>
    </div>
</div>
