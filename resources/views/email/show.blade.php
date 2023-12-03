@extends('master')

@section('content')
<!-- Datatable CSS -->

<div class="row">
    <div class="col-sm-12 mb-1">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
    </div>
    <div class="col-sm-12">
        <div class="card mb-0">
            <div class="card-body">
                <div class="mailview-content">
                    <div class="mailview-header">
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="text-ellipsis m-b-10">
                                    <span class="mail-view-title">{{ $email->subject }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="sender-info">
                            <div class="receiver-details float-start">
                                <span class="sender-name">{{ $email->from_user->contact->full_name }}</span>
                                <span class="receiver-name">
                                    to
                                    <span>{{ $email->to_user->contact->full_name }}</span>
                                </span>
                            </div>
                            <div class="mail-sent-time">
                                <span class="mail-time">{{ $email->created_at }}</span>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="mailview-inner">
                        <p>
                            {{ $email->body }}
                        </p>
                    </div>
                </div>
                <div class="mail-attachments">
                    <p><i class="fa-solid fa-paperclip"></i> {{ count($email->emailFiles) }} Attachments</p>
                    @foreach ($email->emailFiles as $file)


                    <a href="{{ $file->file }}" class="mt-2" target="_blank">{{ $file->name }}</a> <br>

                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
