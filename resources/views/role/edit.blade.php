@extends('master')

@section('content')
<!-- Datatable CSS -->

<div class="row">
    <div class="col-sm-12">
        <div class="card mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Role Form</h4>
                <p class="card-text">
                    Edit <code>Role</code>
                </p>
            </div>
            <div class="card-body">

                <form action="{{ route('roles.update', ['role'=>$role]) }}" method="POST" class="row">
                    @csrf
                    @method('PUT')


                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Role</label>
                            <input class="form-control" type="text" name="role" placeholder="Role" required value="{{ $role->role }}">
                        </div>
                    </div>
                    <div class="col-12"></div>

                    <div class="col-4 mt-2">
                        <label>Dashboard</label>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="dashboard_read_only" {{ $role->dashboard_read_only ? 'checked' : '' }}> Dashboard Access
                            </label>
                        </div>
                    </div>

                    <div class="col-4 mt-2">
                        <label>Message</label>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="access_to_message" {{ $role->access_to_message ? 'checked' : '' }}> Message Access
                            </label>
                        </div>
                    </div>

                    <div class="col-4 mt-2">
                        <label>Stats</label>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="stats_read_only" {{ $role->stats_read_only ? 'checked' : '' }} > Owner’s Stats Access
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="stats_read_write" {{ $role->stats_read_write ? 'checked' : '' }} > Committee Graphs Access
                            </label>
                        </div>
                    </div>

                    <!-- roles -->
                    <div class="col-4 mt-2">
                        <label>Roles</label>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="roles_read_only" {{ $role->roles_read_only ? 'checked' : '' }}> Roles Readonly
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="roles_read_write" {{ $role->roles_read_write ? 'checked' : '' }}> Roles Read & Write
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="roles_read_delete" {{ $role->roles_read_delete ? 'checked' : '' }}> Roles Read & Delete
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="roles_read_create" {{ $role->roles_read_create ? 'checked' : '' }}> Roles Read & Create
                            </label>
                        </div>
                    </div>

                    <!-- students -->
                    <div class="col-4 mt-2">
                        <label>Students</label>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="students_read_only" {{ $role->students_read_only ? 'checked' : '' }}> Students Readonly
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="students_read_write" {{ $role->students_read_write ? 'checked' : '' }}> Students Read & Write
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="students_read_delete" {{ $role->students_read_delete ? 'checked' : '' }}> Students Read & Delete
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="students_read_create" {{ $role->students_read_create ? 'checked' : '' }}> Students Read & Create
                            </label>
                        </div>
                    </div>

                    <!-- committees -->
                    <div class="col-4 mt-2">
                        <label>Committees</label>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="committees_read_only" {{ $role->committees_read_only ? 'checked' : '' }}> Committees Readonly
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="committees_read_write" {{ $role->committees_read_write ? 'checked' : '' }}> Committees Read & Write
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="committees_read_delete" {{ $role->committees_read_delete ? 'checked' : '' }}> Committees Read & Delete
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="committees_read_create" {{ $role->committees_read_create ? 'checked' : '' }}> Committees Read & Create
                            </label>
                        </div>
                    </div>

                    <div class="col-4 mt-2">
                        <label>Registration Request</label>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="registration_requests_read_only" {{ $role->registration_requests_read_only ? 'checked' : '' }}> Registration Request Readonly
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="registration_requests_read_write" {{ $role->registration_requests_read_write ? 'checked' : '' }}> Registration Request Read & Write
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="registration_requests_read_delete" {{ $role->registration_requests_read_delete ? 'checked' : '' }}> Registration Request Read & Delete
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="registration_requests_read_create" {{ $role->registration_requests_read_create ? 'checked' : '' }}> Registration Request Read & Create
                            </label>
                        </div>
                    </div>

                    <!-- committees -->
                    <div class="col-4 mt-2">
                        <label>Pinboard</label>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="pinboard_read_only" {{ $role->pinboard_read_only ? 'checked' : '' }}> Pinboard Readonly
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="pinboard_read_write" {{ $role->pinboard_read_write ? 'checked' : '' }}> Pinboard Read & Write
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="pinboard_read_delete" {{ $role->pinboard_read_delete ? 'checked' : '' }}> Pinboard Read & Delete
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="pinboard_read_create" {{ $role->pinboard_read_create ? 'checked' : '' }}> Pinboard Read & Create
                            </label>
                        </div>
                    </div>

                    <div class="col-4 mt-2">
                        <label>Grievances</label>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="complaints_read_only" {{ $role->complaints_read_only ? 'checked' : '' }}> Grievances Readonly
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="complaints_read_own_only" {{ $role->complaints_read_own_only ? 'checked' : '' }} > Grievances Readonly Own
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="complaints_read_allowed_users" {{ $role->complaints_read_allowed_users ? 'checked' : '' }} > Grievances Readonly Allowed Users
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="complaints_read_write" {{ $role->complaints_read_write ? 'checked' : '' }}> Grievances Read & Write
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="complaints_read_delete" {{ $role->complaints_read_delete ? 'checked' : '' }}> Grievances Read & Delete
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="complaints_read_create" {{ $role->complaints_read_create ? 'checked' : '' }}> Grievances Read & Create
                            </label>
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
