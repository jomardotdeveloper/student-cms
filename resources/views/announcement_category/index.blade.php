@extends('master')

@section('content')
<!-- Datatable CSS -->

<div class="row">
    <div class="col-sm-12 mb-1">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
    </div>
    @if (auth()->user()->contact->role->pinboard_read_create)
    <div class="col-sm-12">
        <a href="{{ route('announcement_categories.create') }}" class="btn btn-primary mb-2">Add Category</a>
    </div>
    @endif

    <div class="col-sm-12">
        <div class="card mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Pinboard Categories</h4>
                <p class="card-text">
                    Pinboard Category <code>records</code>
                </p>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($announcement_categories as $categ)
                            <tr>
                                <td>{{ $categ->name }}</td>
                                <td>
                                    @if (auth()->user()->contact->role->pinboard_read_write)
                                    <a href="{{ route('announcement_categories.edit', $categ->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    @endif
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
