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
                <h4 class="card-title mb-0">Suggestion Category Form</h4>
                <p class="card-text">
                    Edit <code>category</code>
                </p>
            </div>
            <div class="card-body">

                <form action="{{ route('suggestion_categories.update', ['suggestion_category' => $suggestion_category]) }}" method="POST" class="row">
                    @csrf
                    @method('PUT')
                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Username</label>
                            <input class="form-control" type="text" name="name" placeholder="Name" value="{{ $suggestion_category->name }}" required>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Tags</label>
                            <select class="select-multiple-tags form-control" name="tag_ids[]" multiple="multiple">
                                @foreach ($tags as $tag)

                                <option value="{{ $tag->name }}" {{ in_array($tag->name, $suggestion_category->tag_names) ? "selected" : "" }}>{{ $tag->name }}</option>
                                @endforeach
                            </select>
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
