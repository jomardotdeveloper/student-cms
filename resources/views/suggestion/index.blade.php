@extends('master')

@section('content')
<div class="row">
    <div class="col-sm-12 mb-1">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
    </div>
</div>
<!-- Datatable CSS -->
@if (!auth()->user()->contact->role->is_committee)
<div class="row filter-row">
    <div class="col-3">
        {{-- <a href="#" class="btn btn-success w-100"> Search </a> --}}
    </div>
    <div class="col-6">
        <div class="input-block mb-3 form-focus">
            <input type="text" class="form-control floating" id="search">
            <label class="focus-label">Suggestion</label>
        </div>
    </div>
    <div class="col-3">
        <button onclick="filter()" class="btn btn-success w-100"> Search </a>
    </div>
    <script>
        function filter() {
            var search = document.querySelector('#search');
            var url = "{{ route('suggestions.index') }}";
            if (search) {
                var searchValue = document.querySelector('#search').value;
                url += "?search=" + searchValue;
            }
            window.location.href = url;
        }
    </script>
</div>
@endif
@if (auth()->user()->contact->role->suggestion_read_write && auth()->user()->contact->role->is_committee )
<div class="row filter-row">
    <div class="col-sm-6 col-md-3">

    </div>

    @php
        $status = "";
        $sort = "";

        if(isset($_GET['status'])) {
            $status = $_GET['status'];
        }

        if(isset($_GET['sort'])) {
            $sort = $_GET['sort'];
        }
        // dd($status, $sort);
    @endphp
    <div class="col-sm-6 col-md-3"></div>
    <div class="col-sm-6 col-md-3">
        <div class="input-block mb-3 form-focus select-focus">
            <select class="select floating" id="status">
                <option value="Approved" {{ $status == "Approved" ? "selected" : "" }}>Approved</option>
                <option value="Pending" {{ $status == "Pending" ? "selected" : "" }}>Pending</option>
                <option value="Rejected" {{ $status == "Rejected" ? "selected" : "" }}>Rejected</option>
            </select>
            <label class="focus-label">Status</label>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <button onclick="filter()" class="btn btn-success w-100"> Search </a>
    </div>
    <script>
        function filter() {
            var status = document.querySelector('#status');
            var sort = document.querySelector('#sort');
            var url = "{{ route('suggestions.index') }}";
            if (status) {
                var statusValue = document.querySelector('#status').value;
                url += "?status=" + statusValue;
            }
            window.location.href = url;
        }
    </script>

</div>
@endif
<div class="row">
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
    @if (auth()->user()->contact->role->suggestion_read_create)
    <div class="col-sm-12">
        <a href="{{ route('suggestions.create') }}" class="btn btn-primary mb-2">Add Suggestion</a>
    </div>
    @endif

    @if (count($suggestions) < 1)
    <div class="col-sm-12">
        <div class="alert alert-secondary">
            No Suggestion found.
        </div>
    </div>
    @else
    @foreach ($suggestions as $suggestion)
    <div class="col-6 d-flex">
        <div class="card w-100">
            <div class="card-body">
                <div class="dropdown dropdown-action profile-action">
                    @if (auth()->user()->contact->role->suggestion_read_write && auth()->user()->id == $suggestion->user_id)
                    <a href="{{ route('suggestions.edit', ['suggestion' => $suggestion]) }}" class="btn btn-primary">Edit</a>
                    @endif
                    @if (auth()->user()->contact->role->suggestion_read_write && auth()->user()->contact->role->is_committee && $suggestion->status == 'Pending')
                    <a href="{{ route('suggestions.approve', ['suggestion' => $suggestion]) }}" class="btn btn-primary">Approve</a>
                    <a href="{{ route('suggestions.reject', ['suggestion' => $suggestion]) }}" class="btn btn-danger">Reject</a>
                    @endif
                </div>
                <small class="block text-ellipsis m-b-15">
                   <span class="text-muted">{{ $suggestion->user->contact->full_name }}
                    @if ($suggestion->status == 'Approved')
                        <span class="badge bg-inverse-success">{{ "Approved" }} </span>
                    @elseif ($suggestion->status == 'Pending')
                        <span class="badge bg-inverse-warning">{{ "Pending" }} </span>
                    @else
                        <span class="badge bg-inverse-danger">{{ "Rejected" }} </span>
                    @endif
                </span> </br>
                   <span class="text-muted">{{ $suggestion->created_at }}</span>
                </small>
                <p class="text-muted">
                    {{ $suggestion->body }}
                </p>
                <div class="pro-deadline m-b-15">
                    <div class="sub-title">
                        Category:
                    </div>
                    <div class="text-muted">
                        {{ $suggestion->suggestionCategory->name }}
                    </div>
                </div>


                @if ($suggestion->keywords_related)
                <div class="project-members m-b-15">
                    <div>Keywords</div>
                    {{-- <ul> --}}
                        @foreach ($suggestion->keywords_related as $keyword)
                        <span class="badge bg-inverse-success">
                            <i class="fa-solid fa-tags"></i>
                            {{ $keyword  }}
                        </span>
                        @endforeach

                    {{-- </ul> --}}
                </div>
                @endif
                <div class="project-members m-b-15">
                    <button class="btn btn-primary" onclick="upvote('{{ $suggestion->id }}')" {{ !$suggestion->user_allowed_to_up_vote ? "disabled" : "" }}>({{ $suggestion->up_vote_counts }}) Up Vote</a>
                    <button class="btn btn-warning mx-2"  onclick="downvote('{{ $suggestion->id }}')" {{ !$suggestion->user_allowed_to_down_vote ? "disabled" : "" }}>({{ $suggestion->down_vote_counts }})Down Vote</a>
                </div>


            </div>
        </div>
    </div>
    @endforeach
    @endif




</div>


@endsection
@push('scripts')
<script>

    function upvote(id) {
        var url = "/backend/suggestions/" + id + "/upvote";


        // Redirect to the generated URL
        window.location.href = url;




    }

    function downvote (id) {

        var url = "/backend/suggestions/" + id + "/downvote";


        // Redirect to the generated URL
        window.location.href = url;



    }
</script>
@endpush
