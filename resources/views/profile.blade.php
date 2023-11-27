@extends('master')

@section('content')
<!-- Datatable CSS -->

<div class="row">
    <div class="card mb-0">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-view">
                        <div class="profile-img-wrap">
                            <div class="profile-img">
                                <a href="#"><img src="{{ asset('avatar.png') }}" alt="User Image"></a>
                            </div>
                        </div>
                        <div class="profile-basic">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="profile-info-left">
                                        <h3 class="user-name m-t-0 mb-0">{{ auth()->user()->contact->full_name }}</h3>
                                        <h6 class="text-muted">{{ auth()->user()->contact->role->role }}</h6>
                                        @if (auth()->user()->contact->role->role == "Student")
                                            <div class="staff-id">Student # : {{ auth()->user()->contact->student_number }}</div>
                                        @endif
                                        <div class="small doj text-muted">Date of Join : {{ auth()->user()->created_at  }}</div>
                                        @if (auth()->user()->contact->role->role != "Administrator")
                                        <div class="small doj text-muted">

                                            @foreach (auth()->user()->keywords_suggestions as $keyword)
                                                <a href="{{ route('profile') }}?keyword={{ $keyword }}" class="btn btn-primary btn-sm text-dark">
                                                    <i class="fa-solid fa-tags"></i> {{ $keyword }}
                                                </a>
                                            @endforeach
                                        </div>
                                        @else
                                        <div class="small doj text-muted">&nbsp;</div>
                                        @endif

                                        <div class="small doj text-muted">&nbsp;</div>
                                        <div class="small doj text-muted">&nbsp;</div>
                                        <div class="small doj text-muted">&nbsp;</div>
                                        <div class="small doj text-muted">&nbsp;</div>
                                        @if (auth()->user()->contact->role->role != "Student")
                                        <div class="small doj text-muted">&nbsp;</div>
                                        @endif
                                        {{-- <div class="staff-msg"><a class="btn btn-custom" href="chat.html">Send Message</a></div> --}}
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Gender:</div>
                                            <div class="text">{{ auth()->user()->contact->gender }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Course:</div>
                                            <div class="text">{{ auth()->user()->contact->college }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Personal Email:</div>
                                            <div class="text">{{ auth()->user()->contact->personal_email }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Contact #:</div>
                                            <div class="text">{{ auth()->user()->contact->contact_number }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Civil Status:</div>
                                            <div class="text">{{ auth()->user()->contact->civil_status }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Email:</div>
                                            <div class="text">{{ auth()->user()->contact->email }}</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="pro-edit">
                            <a  href="{{ route('profile.edit') }}"><i class="fa-solid fa-pencil"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if (auth()->user()->contact->role->role != "Administrator")
<div class="row mt-2">
    <div class="card mb-0">
        <div class="card-header">
            <h4 class="card-title mb-0">Suggestions</h4>
            <p class="card-text">
                Suggestion <code>records</code>
            </p>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="datatable table table-stripped mb-0">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Body</th>
                            <th>Date</th>
                            <th>Upvotes</th>
                            <th>Downvotes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($suggestions as $suggestion)
                        <tr>
                            <td>{{ $suggestion->suggestionCategory->name }}</td>
                            <td>{{ $suggestion->body }}</td>
                            <td>{{ $suggestion->created_at }}</td>
                            <td>{{ $suggestion->up_vote_counts }}</td>
                            <td>{{ $suggestion->down_vote_counts }}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
