@extends('master')

@section('content')
<!-- Datatable CSS -->

<div class="row">
    <div class="col-sm-12">
        <div class="card mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Registration Requests</h4>
                <p class="card-text">
                    Student registration requests <code>records</code>
                </p>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>
                                <th>Student #</th>
                                <th>Full Name</th>
                                <th>Gender</th>
                                <th>College</th>
                                <th>Personal Email</th>
                                <th>Contact #</th>
                                <th>Civil Status</th>
                                <th>Email</th>
                                <th>Enrollment Form</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $contact)
                            <tr>
                                <td>{{ $contact->student_number }}</td>
                                <td>{{ $contact->full_name }}</td>
                                <td>{{ $contact->gender }}</td>
                                <td>{{ $contact->college }}</td>
                                <td>{{ $contact->personal_email }}</td>
                                <td>{{ $contact->contact_number }}</td>
                                <td>{{ $contact->civil_status }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>
                                    @if ($contact->enrollment_form)
                                    <a href="{{ $contact->enrollment_form }}" target="_blank" class="btn btn-primary">View</a>
                                    @else
                                    <span class="text-danger">No Enrollment Form</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('registration-request.approve', $contact->id) }}" class="btn btn-primary btn-sm">Approve</a>
                                    <a href="{{ route('registration-request.reject', $contact->id) }}" class="btn btn-danger text-light btn-sm">Reject</a>
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
