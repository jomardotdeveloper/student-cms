@extends('master')

@section('content')
<!-- Datatable CSS -->

<div class="row">
    <div class="col-sm-12 mb-1">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
    </div>
    <div class="col-sm-12">
        <a href="{{ route('emails.create') }}" class="btn btn-primary mb-2">Send Message</a>
        <a href="{{ route('emails.index') }}?type=all" class="btn btn-primary mb-2 mx-2">All</a>
        <a href="{{ route('emails.index') }}?type=received" class="btn btn-primary mb-2 mx-2">Inbox</a>
        <a href="{{ route('emails.index') }}?type=sent" class="btn btn-primary mb-2 mx-2">Sent</a>
    </div>

    <div class="col-sm-12">
        <div class="card mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Messages</h4>
                <p class="card-text">
                    My <code>inbox</code>
                </p>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="datatable table table-stripped mb-0">
                        <thead>
                            <tr>
                                <th>From</th>
                                <th>To</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th>Read</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($emails as $email)
                            <tr>
                                <td>{{ $email->from_user->contact->full_name }}</td>
                                <td>{{ $email->to_user->contact->full_name }}</td>
                                <td>{{ $email->subject }}</td>
                                <td>{{ $email->created_at }}</td>
                                <td class="{{ $email->is_read ? "text-success" : "text-danger" }}">{{ $email->is_read ? "Yes" : "No" }}</td>
                                <td>
                                    <a href="{{ route('emails.show', $email->id) }}" class="btn btn-primary btn-sm">Show</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
