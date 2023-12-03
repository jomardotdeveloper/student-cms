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
                <h4 class="card-title mb-0">Policy Form</h4>
                <p class="card-text">
                    Edit <code>policy</code>
                </p>
            </div>
            <div class="card-body">

                <form action="{{ route('policies.update', ['policy' => $policy]) }}" method="POST" class="row">
                    @csrf
                    @method('PUT')

                    <div class="col-12">
                        <div class="form-group">
                            <label for="">
                                Parent
                            </label>

                            <select name="parent_id" id="parent_id" class="form-control">
                                @foreach ($policies as $parent)
                                <option value="{{ $parent->id }}" {{  $parent->id == $policy->parent_id ? "selected" : "" }}>{{ $parent->policy }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group mb-4">
                            <label>Policy</label>
                            <textarea name="policy" id="policy" class="form-control" cols="30" rows="10">{{$policy->policy }}</textarea>
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
