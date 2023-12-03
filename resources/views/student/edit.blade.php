@extends('master')

@section('content')
<!-- Datatable CSS -->

<div class="row">
    <div class="col-sm-12 mb-1">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
    </div>
    <div class="col-sm-12">
        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>

        @endif
    </div>
    <div class="col-sm-12">
        <div class="card mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Student Form</h4>
                <p class="card-text">
                    Edit <code>student</code>
                </p>
            </div>
            <div class="card-body">

                <form action="{{ route('students.update', ['student' => $student]) }}" method="POST" class="row">
                    @csrf
                    @method('PUT')
                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Student #</label>
                            <input class="form-control" type="text" name="student_number" placeholder="Student #" value="{{ $student->student_number }}" required>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>First Name</label>
                            <input class="form-control" type="text" name="first_name" placeholder="First Name" value="{{ $student->first_name }}" required>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Middle Name</label>
                            <input class="form-control" type="text" name="middle_name" placeholder="Middle Name" value="{{ $student->middle_name }}">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Last Name</label>
                            <input class="form-control" type="text" name="last_name" placeholder="Last Name" value="{{ $student->last_name }}" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Personal Email</label>
                            <input class="form-control" type="email" name="personal_email" placeholder="Personal Email" value="{{ $student->personal_email }}">
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Course                       </label>
                            <select name="college" class="form-control" required>
                                <option value="BS ChE" {{ $student->course == "BS ChE" ? "selected" : "" }}>Bachelor of Science in Chemical Engineering - BS ChE</option>
                                <option value="BS CE" {{ $student->course == "BS CE" ? "selected" : "" }}>Bachelor of Science in Civil Engineering - BS CE</option>
                                <option value="BS CpE" {{ $student->course == "BS CpE" ? "selected" : "" }}>Bachelor of Science in Computer Engineering - BS CpE</option>
                                <option value="BS CS" {{ $student->course == "BS CS" ? "selected" : "" }}>Bachelor of Science in Computer Science - BS CS</option>
                                <option value="BS EE" {{ $student->course == "BS EE" ? "selected" : "" }}>Bachelor of Science in Electrical Engineering - BS EE</option>
                                <option value="BS ECE" {{ $student->course == "BS ECE" ? "selected" : "" }}>Bachelor of Science in Electronics Engineering - BS ECE</option>
                                <option value="BS IT" {{ $student->course == "BS IT" ? "selected" : "" }}>Bachelor of Science in Information Technology - BS IT</option>
                                <option value="BS MfE" {{ $student->course == "BS MfE" ? "selected" : "" }}>Bachelor of Science in Manufacturing Engineering - BS MfE</option>
                                <option value="BS ME" {{ $student->course == "BS ME" ? "selected" : "" }}>Bachelor of Science in Mechanical Engineering - BS ME</option>
                            </select>

                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Contact #</label>
                            <input class="form-control" type="text" name="contact_number" placeholder="Contact #" value="{{ $student->contact_number }}">
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Gender</label>
                            <select name="gender" id="gender" class="form-control" required>
                                <option value="Male" {{ $student->gender == "Male" ? "selected" : "" }}>Male</option>
                                <option value="Female" {{ $student->gender == "Female" ? "selected" : "" }}>Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Civil Status</label>
                            <select name="civil_status" id="civil_status" class="form-control" required>
                                <option value="Single" {{ $student->gender == "Single" ? "selected" : "" }}>Single</option>
                                <option value="Married" {{ $student->gender == "Married" ? "selected" : "" }}>Married</option>
                                <option value="Widowed" {{ $student->gender == "Widowed" ? "selected" : "" }}>Widowed</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Email</label>
                            <input class="form-control" type="email" name="email" placeholder="Email" required value="{{ $student->email }}">
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Update Enrollment Form</label>
                            <input class="form-control" type="file" name="enrollment_form" required>
                        </div>
                    </div>


                    <div class="col-12">
                        <input type="submit" value="Save" class="btn btn-primary"/>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
