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
                    Create <code>student</code>
                </p>
            </div>
            <div class="card-body">

                <form action="{{ route('students.store') }}" method="POST" class="row" enctype="multipart/form-data">
                    @csrf

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Student #</label>
                            <input class="form-control" type="text" name="student_number" placeholder="Student #" required>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>First Name</label>
                            <input class="form-control" type="text" name="first_name" placeholder="First Name" required>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Middle Name</label>
                            <input class="form-control" type="text" name="middle_name" placeholder="Middle Name" >
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Last Name</label>
                            <input class="form-control" type="text" name="last_name" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Personal Email</label>
                            <input class="form-control" type="email" name="personal_email" placeholder="Personal Email" >
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Course                       </label>
                            <select name="college" class="form-control" required>
                                <option value="BS ChE">Bachelor of Science in Chemical Engineering - BS ChE</option>
                                <option value="BS CE">Bachelor of Science in Civil Engineering - BS CE</option>
                                <option value="BS CpE">Bachelor of Science in Computer Engineering - BS CpE</option>
                                <option value="BS CS">Bachelor of Science in Computer Science - BS CS</option>
                                <option value="BS EE">Bachelor of Science in Electrical Engineering - BS EE</option>
                                <option value="BS ECE">Bachelor of Science in Electronics Engineering - BS ECE</option>
                                <option value="BS IT">Bachelor of Science in Information Technology - BS IT</option>
                                <option value="BS MfE">Bachelor of Science in Manufacturing Engineering - BS MfE</option>
                                <option value="BS ME">Bachelor of Science in Mechanical Engineering - BS ME</option>
                            </select>

                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Contact #</label>
                            <input class="form-control" type="text" name="contact_number" placeholder="Contact #" >
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Gender</label>
                            <select name="gender" id="gender" class="form-control" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Civil Status</label>
                            <select name="civil_status" id="civil_status" class="form-control" required>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Email</label>
                            <input class="form-control" type="email" name="email" placeholder="Email" required>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Password</label>
                            <input class="form-control" type="password" name="password" placeholder="Password" required>
                        </div>
                    </div>


                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Repeat Password</label>
                            <input class="form-control" type="password" name="password_confirmation" placeholder="Password" required>
                        </div>
                    </div>


                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Enrollment Form</label>
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
