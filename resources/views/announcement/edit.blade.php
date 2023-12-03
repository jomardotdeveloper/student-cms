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
                <h4 class="card-title mb-0">Pinboard Form</h4>
                <p class="card-text">
                    Edit <code>pinboard</code>
                </p>
            </div>
            <div class="card-body">

                <form action="{{ route('announcements.update', ['announcement' => $announcement]) }}" method="POST" class="row">
                    @csrf

                    @method('PUT')
                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Title</label>
                            <input class="form-control" type="text" name="title" placeholder="Title" required value="{{ $announcement->title }}">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Category</label>
                            <select name="announcement_category_id" id="announcement_category_id" class="form-control" required>
                                @foreach ($announcement_categories as $category)
                                <option value="{{ $category->id }}" {{ $announcement->announcement_category_id == $category->id ? "selected" : "" }}>{{ $category->name }}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Tags</label>
                            <select class="select-multiple-tags form-control" name="tag_ids[]" multiple="multiple">
                                @foreach ($tags as $tag)

                                <option value="{{ $tag->name }}" {{ in_array($tag->name, $announcement->tag_names) ? "selected" : "" }}>{{ $tag->name }}</option>
                                @endforeach
                            </select>


                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="form-group">
                            <label for="">
                                Body
                            </label>
                            <textarea name="body" id="body" class="form-control" cols="30" rows="10" required>{{ $announcement->body }}</textarea>
                        </div>
                    </div>






                    <div class="col-12">
                        <input type="submit" value="Save" class="btn btn-primary"/>
                    </div>

                </form>
                @if (auth()->user()->contact->role->pinboard_read_delete)
                <div class="col-12 mt-2">
                    <form action="{{ route('announcements.destroy', ['announcement' => $announcement]) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <input type="submit" value="Delete" class="btn btn-danger"/>
                    </form>
                </div>

                @endif
            </div>
        </div>
    </div>
</div>

@endsection
