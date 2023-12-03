@extends('master')

@section('content')
<!-- Datatable CSS -->

<div class="row">
    <div class="col-sm-12 mb-1">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
    </div>
    @if (auth()->user()->contact->role->committees_read_create)
    <div class="col-sm-12">
        <a href="{{ route('committees.create') }}" class="btn btn-primary mb-2">Add Committee</a>
    </div>
    @endif

    <div class="col-sm-12">
        <div class="card mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Committees</h4>
                <p class="card-text">
                    Committees <code>records</code>
                </p>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Full Name</th>
                                <th>Gender</th>
                                <th>College</th>
                                <th>Personal Email</th>
                                <th>Contact #</th>
                                <th>Civil Status</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $contact)
                            <tr>
                                <td>{{ $contact->user->username }}</td>
                                <td>{{ $contact->full_name }}</td>
                                <td>{{ $contact->gender }}</td>
                                <td>{{ $contact->college }}</td>
                                <td>{{ $contact->personal_email }}</td>
                                <td>{{ $contact->contact_number }}</td>
                                <td>{{ $contact->civil_status }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>
                                    @if (auth()->user()->contact->role->committees_read_write)
                                    <a href="{{ route('committees.edit', $contact->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    @endif
                                    <a href="{{ route('committees.show', $contact->id) }}" class="btn btn-primary btn-sm">Show</a>
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
