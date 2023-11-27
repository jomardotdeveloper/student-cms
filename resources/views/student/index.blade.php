@extends('master')

@section('content')
<!-- Datatable CSS -->

<div class="row">
    @if (auth()->user()->contact->role->students_read_create)
    <div class="col-sm-12">
        <a href="{{ route('students.create') }}" class="btn btn-primary mb-2">Add Student</a>
    </div>
    @endif
    <div class="col-sm-12">
        <div class="card mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Students</h4>
                <p class="card-text">
                    Students <code>records</code>
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
                                <th>Course</th>
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
                                    <a href="{{ $contact->enrollment_form }}" class="btn btn-primary" target="_blank">View</a>
                                    @else
                                    <span class="text-danger">No Enrollment Form</span>
                                    @endif
                                </td>
                                <td>
                                    @if (auth()->user()->contact->role->students_read_edit)
                                    <a href="{{ route('students.edit', $contact->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    @endif
                                    <a href="{{ route('students.show', $contact->id) }}" class="btn btn-primary btn-sm">Show</a>
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
