@extends('master')

@section('content')
<!-- Datatable CSS -->

<div class="row">
    <div class="col-sm-12 mb-1">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
    </div>
    <div class="col-sm-12">
        <div class="card mb-0">
            <div class="card-header">
                <h4 class="card-title mb-0">Role Form</h4>
                <p class="card-text">
                    Create <code>Role</code>
                </p>
            </div>
            <div class="card-body">

                <form action="{{ route('roles.store') }}" method="POST" class="row">
                    @csrf

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Role</label>
                            <input class="form-control" type="text" name="role" placeholder="Role" required>
                        </div>
                    </div>
                    <div class="col-12"></div>
                    <div class="col-4 mt-2">
                        <label>Committee</label>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="is_committee"> Committee Access
                            </label>
                        </div>
                    </div>
                    <div class="col-12"></div>
                    <div class="col-4 mt-2">
                        <label>Dashboard</label>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="dashboard_read_only"> Dashboard Access
                            </label>
                        </div>
                    </div>

                    <div class="col-4 mt-2">
                        <label>Message</label>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="access_to_message"> Message Access
                            </label>
                        </div>
                    </div>
                    <div class="col-4 mt-2">
                        <label>Stats</label>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="stats_read_only"> Owner’s Stats Access
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="stats_read_write"> Committee Graphs Access
                            </label>
                        </div>
                    </div>


                    <!-- roles -->
                    <div class="col-4 mt-2">
                        <label>Roles</label>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="roles_read_only"> Roles Readonly
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="roles_read_write"> Roles Read & Write
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="roles_read_delete"> Roles Read & Delete
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="roles_read_create"> Roles Read & Create
                            </label>
                        </div>
                    </div>

                    <!-- students -->
                    <div class="col-4 mt-2">
                        <label>Students</label>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="students_read_only"> Students Readonly
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="students_read_write"> Students Read & Write
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="students_read_delete"> Students Read & Delete
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="students_read_create"> Students Read & Create
                            </label>
                        </div>
                    </div>

                    <!-- committees -->
                    <div class="col-4 mt-2">
                        <label>Committees</label>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="committees_read_only"> Committees Readonly
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="committees_read_write"> Committees Read & Write
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="committees_read_delete"> Committees Read & Delete
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="committees_read_create"> Committees Read & Create
                            </label>
                        </div>
                    </div>

                    <div class="col-4 mt-2">
                        <label>Registration Request</label>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="registration_requests_read_only"> Registration Request Readonly
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="registration_requests_read_write"> Registration Request Read & Write
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="registration_requests_read_delete"> Registration Request Read & Delete
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="registration_requests_read_create"> Registration Request Read & Create
                            </label>
                        </div>
                    </div>

                    <!-- committees -->
                    <div class="col-4 mt-2">
                        <label>Pinboard</label>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="pinboard_read_only"> Pinboard Readonly
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="pinboard_read_write"> Pinboard Read & Write
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="pinboard_read_delete"> Pinboard Read & Delete
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="pinboard_read_create"> Pinboard Read & Create
                            </label>
                        </div>
                    </div>

                    <div class="col-4 mt-2">
                        <label>Complaints</label>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="complaints_read_only"> Grievances Readonly
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="complaints_read_own_only" > Grievances Readonly Own
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="complaints_read_allowed_users" > Grievances Readonly Allowed Users
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="complaints_read_write"> Grievances Read & Write
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="complaints_read_delete"> Grievances Read & Delete
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="complaints_read_create"> Grievances Read & Create
                            </label>
                        </div>
                    </div>


                    <div class="col-4 mt-2">
                        <label>Suggestion</label>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="suggestion_read_only"> Suggestion Readonly
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="suggestion_read_own_only" > Suggestion Readonly Own
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="suggestion_read_write"> Suggestion Read & Write
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="suggestion_read_delete"> Suggestion Read & Delete
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="suggestion_read_create"> Suggestion Read & Create
                            </label>
                        </div>
                    </div>


                    <div class="col-4 mt-2">
                        <label>Suggestion category</label>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="suggestion_category_read_only"> Suggestion Category Readonly
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="suggestion_category_read_write"> Suggestion Category Read & Write
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="suggestion_category_read_delete"> Suggestion Category Read & Delete
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="suggestion_category_read_create"> Suggestion Category Read & Create
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
