@extends('master')

@section('content')
<!-- Datatable CSS -->

<div class="row">
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
                <h4 class="card-title mb-0">Suggestion Form</h4>
                <p class="card-text">
                    Edit <code>suggestion</code>
                </p>
            </div>
            <div class="card-body">

                <form action="{{ route('suggestions.update', ['suggestion' => $suggestion]) }}" method="POST" class="row">
                    @csrf
                    @method('PUT')

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Category</label>
                            <select name="suggestion_category_id" id="suggestion_category_id" class="form-control" required>
                                @foreach ($suggestion_categories as $category)
                                <option value="{{ $category->id }}" {{ $suggestion->suggestion_category_id == $category->id ? "selected" : "" }}>{{ $category->name }}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="form-group">
                            <label for="">
                                Body
                            </label>
                            <textarea name="body" id="body" class="form-control" cols="30" rows="10" required>{{ $suggestion->body }}</textarea>
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
