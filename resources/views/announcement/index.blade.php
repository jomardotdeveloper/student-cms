@extends('master')

@section('content')
<!-- Datatable CSS -->

<div class="row">
    @if (auth()->user()->contact->role->pinboard_read_create)
    <div class="col-sm-12">
        <a href="{{ route('announcements.create') }}" class="btn btn-primary mb-2">Add Pinboard</a>
    </div>
    @endif

    @if (count($announcements) < 1)
    <div class="col-sm-12">
        <div class="alert alert-secondary">
            No Pinboard found.
        </div>
    </div>
    @else
    @foreach ($announcements as $announcement)
    <div class="col-6 d-flex">
        <div class="card w-100">
            <div class="card-body">
                <div class="dropdown dropdown-action profile-action">
                    @if (auth()->user()->contact->role->pinboard_read_write)
                    <a href="{{ route('announcements.edit', ['announcement' => $announcement]) }}" class="btn btn-primary">Edit</a>
                    @endif
                </div>
                <h4 class="project-title"><a href="#">{{ $announcement->title }}</a></h4>
                <small class="block text-ellipsis m-b-15">
                   <span class="text-muted">{{ $announcement->user->contact->full_name }}</span> </br>
                   <span class="text-muted">{{ $announcement->created_at }}</span>
                </small>
                <p class="text-muted">
                    {{ $announcement->body }}
                </p>
                <div class="pro-deadline m-b-15">
                    <div class="sub-title">
                        Category:
                    </div>
                    <div class="text-muted">
                        {{ $announcement->announcementCategory->name }}
                    </div>
                </div>
                @if ($announcement->tag_ids)
                <div class="project-members m-b-15">
                    <div>Tags</div>
                    {{-- <ul> --}}
                        @foreach ($announcement->tags as $tag)
                        <span class="badge bg-inverse-success">
                            <i class="fa-solid fa-tags"></i>
                            {{ $tag->name  }}
                        </span>
                        @endforeach

                    {{-- </ul> --}}
                </div>
                @endif

            </div>
        </div>
    </div>
    @endforeach
    @endif




</div>

@endsection
