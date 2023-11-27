@extends('master')

@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">Welcome {{ auth()->user()->contact->full_name }}!</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item active">Dashboard</li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa-solid fa-users"></i></span>
                <div class="dash-widget-info">
                    <h3>{{ count($students) }}</h3>
                    <span>Students</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa-solid fa-file-text"></i></span>
                <div class="dash-widget-info">
                    <h3>{{ count($registration_requests) }}</h3>
                    <span>Requests</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa-regular fa-ticket"></i></span>
                <div class="dash-widget-info">
                    <h3>{{ count($grievances) }}</h3>
                    <span>Grievances</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa-solid fa-object-group"></i></span>
                <div class="dash-widget-info">
                    <h3>{{ count($committees) }}</h3>
                    <span>Committees</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
