@extends('master')

@section('content')
<!-- Datatable CSS -->

<div class="row">
    <div class="col-sm-12 mb-1">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
    </div>
    @if (auth()->user()->contact->role->complaints_read_create)
    <div class="col-sm-12">
        <a href="{{ route('grievances.create') }}" class="btn btn-primary mb-2">Add Grievance</a>
    </div>
    @endif
    <div class="col-sm-12">
        <div class="card mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Grievances</h4>
                <p class="card-text">
                    Grievance <code>records</code>
                </p>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Student #</th>
                                <th>Student Full Name</th>
                                <th>Date</th>
                                <th>Concern</th>
                                <th>Subject of Concern</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($grievances as $grievance)
                            <tr>
                                <td>{{ $grievance->formatted_id }}</td>
                                <td>{{ $grievance->user->contact->student_number }}</td>
                                <td>{{ $grievance->user->contact->full_name }}</td>
                                <td>{{ $grievance->created_at }}</td>
                                <td>{{ $grievance->concern }}</td>
                                <td>{{ $grievance->subject_of_concern }}</td>
                                <td>{{ $grievance->status }}</td>
                                <td>

                                    <a href="{{ route('grievances.show', $grievance->id) }}" class="btn btn-primary btn-sm">Show</a>
                                    @if (auth()->user()->contact->role->complaints_read_write)
                                    <a href="{{ route('grievances.edit', $grievance->id) }}" class="btn btn-primary btn-sm">Edit</a>
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
