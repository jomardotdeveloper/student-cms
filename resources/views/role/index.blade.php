@extends('master')

@section('content')
<!-- Datatable CSS -->

<div class="row">
    @if (auth()->user()->contact->role->roles_read_create)
    <div class="col-sm-12">
        <a href="{{ route('roles.create') }}" class="btn btn-primary mb-2">Add Role</a>
    </div>
    @endif
    <div class="col-sm-12">
        <div class="card mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Roles</h4>
                <p class="card-text">
                    Roles and Permissions <code>records</code>
                </p>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->role }}</td>
                                <td>
                                    @if (auth()->user()->contact->role->roles_read_write)
                                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    @endif
                                    <a href="{{ route('roles.show', $role->id) }}" class="btn btn-primary btn-sm">View</a>
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
