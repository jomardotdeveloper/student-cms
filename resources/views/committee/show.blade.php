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
                <h4 class="card-title mb-0">Committee Form</h4>
                <p class="card-text">
                    View <code>committee</code>
                </p>
            </div>
            <div class="card-body">

                <form action="#" method="POST" class="row">

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Username</label>
                            <input class="form-control" type="text" name="username" placeholder="Username" value="{{ $committee->user->username }}" disabled>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>First Name</label>
                            <input class="form-control" type="text" name="first_name" placeholder="First Name" value="{{ $committee->first_name }}" disabled>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Middle Name</label>
                            <input class="form-control" type="text" name="middle_name" placeholder="Middle Name" value="{{ $committee->middle_name }}" disabled>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Last Name</label>
                            <input class="form-control" type="text" name="last_name" placeholder="Last Name" value="{{ $committee->last_name }}" disabled>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Personal Email</label>
                            <input class="form-control" type="email" name="personal_email" placeholder="Personal Email" value="{{ $committee->personal_email }}" disabled>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>College</label>
                            <input class="form-control" type="text" name="college" placeholder="College" required value="{{ $committee->college }}" disabled>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Contact #</label>
                            <input class="form-control" type="text" name="contact_number" placeholder="Contact #" value="{{ $committee->contact_number }}" disabled>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Gender</label>
                            <select name="gender" id="gender" class="form-control" disabled>
                                <option value="Male" {{ $committee->gender == "Male" ? "selected" : "" }}>Male</option>
                                <option value="Female" {{ $committee->gender == "Female" ? "selected" : "" }}>Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Committee Type</label>
                            <select name="role_id" id="role_id" class="form-control" disabled>
                                <option selected>{{ $committee->role->role }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Civil Status</label>
                            <select name="civil_status" id="civil_status" class="form-control" disabled>
                                <option value="Single" {{ $committee->gender == "Single" ? "selected" : "" }}>Single</option>
                                <option value="Married" {{ $committee->gender == "Married" ? "selected" : "" }}>Married</option>
                                <option value="Widowed" {{ $committee->gender == "Widowed" ? "selected" : "" }}>Widowed</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Email</label>
                            <input class="form-control" type="email" name="email" placeholder="Email" required value="{{ $committee->email }}" disabled>
                        </div>
                    </div>

                    @if (auth()->user()->contact->role->committees_read_delete)
                    <div class="col-12">
                        <form action="{{ route('committees.destroy', ['committee' => $committee]) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <input type="submit" value="Delete" class="btn btn-danger"/>
                        </form>
                    </div>

                    @endif

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
