@extends('master')

@section('content')
<!-- Datatable CSS -->

<div class="row">
    <div class="col-sm-12 mb-1">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
    </div>
    @if (auth()->user()->contact->role->is_committee || auth()->user()->id == 1)
    <div class="col-sm-12">
        <a href="{{ route('policies.create') }}" class="btn btn-primary mb-2">Add Policy</a>
    </div>
    @endif

    <div class="col-sm-12">
        <div class="card mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Policies</h4>
                <p class="card-text">
                    Policy <code>records</code>
                </p>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>
                                <th>Parent</th>
                                <th>Policy</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($policies as $policy)
                            <tr>
                                <td>{{ $policy->parent_id ? $policy->parent->policy : "N/A"}}</td>
                                <td>{{ $policy->policy }}</td>
                                <td>
                                    <a href="{{ route('policies.edit', $policy->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
