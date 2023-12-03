@extends('master')

@section('content')
<!-- Datatable CSS -->

<div class="row">
    <div class="col-sm-12 mb-1">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
    </div>
    <div class="col-sm-12">
        @if(Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach(Session::get('error') as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>

        @endif
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
                <h4 class="card-title mb-0">Password information</h4>
                <p class="card-text">
                    My <code>password</code>
                </p>
            </div>
            <div class="card-body">
                <form action="{{ route('change-password.update') }}" class="row" method="POST">
                    @csrf
                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Old Password</label>
                            <input class="form-control" type="password" name="old_password" placeholder="Password" required>
                        </div>
                    </div>


                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>New Password</label>
                            <input class="form-control" type="password" name="password" placeholder="Password" required>
                        </div>
                    </div>


                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Repeat Password</label>
                            <input class="form-control" type="password" name="password_confirmation" placeholder="Password" required>
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
