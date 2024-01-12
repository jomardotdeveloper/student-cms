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
                    View <code>Role</code>
                </p>
            </div>
            <div class="card-body">

                <form action="#" method="POST" class="row">

                    <div class="col-4">
                        <div class="form-group mb-4">
                            <label>Role</label>
                            <input class="form-control" type="text" name="role" placeholder="Role" disabled value="{{ $role->role }}">
                        </div>
                    </div>
                    <div class="col-12"></div>
                    <div class="col-4 mt-2">
                        <label>Committee</label>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="is_committee" {{ $role->is_committee ? 'checked' : '' }} disabled> Committee Access
                            </label>
                        </div>
                    </div>

                    <div class="col-12"></div>

                    <div class="col-4 mt-2">
                        <label>Dashboard</label>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="dashboard_read_only" {{ $role->dashboard_read_only ? 'checked' : '' }} disabled> Dashboard Access
                            </label>
                        </div>
                    </div>
                    <div class="col-4 mt-2">
                        <label>Message</label>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="access_to_message" {{ $role->access_to_message ? 'checked' : '' }} disabled> Message Access
                            </label>
                        </div>
                    </div>
                    <div class="col-4 mt-2">
                        <label>Stats</label>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="stats_read_only" {{ $role->stats_read_only ? 'checked' : '' }} disabled> Owner’s Stats Access
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="stats_read_write" {{ $role->stats_read_write ? 'checked' : '' }} disabled> Committee Graphs Access
                            </label>
                        </div>
                    </div>
                    <!-- roles -->
                    <div class="col-4 mt-2">
                        <label>Roles</label>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="roles_read_only" {{ $role->roles_read_only ? 'checked' : '' }} disabled> Roles Readonly
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="roles_read_write" {{ $role->roles_read_write ? 'checked' : '' }} disabled> Roles Read & Write
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="roles_read_delete" {{ $role->roles_read_delete ? 'checked' : '' }} disabled> Roles Read & Delete
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="roles_read_create" {{ $role->roles_read_create ? 'checked' : '' }} disabled> Roles Read & Create
                            </label>
                        </div>
                    </div>

                    <!-- students -->
                    <div class="col-4 mt-2">
                        <label>Students</label>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="students_read_only" {{ $role->students_read_only ? 'checked' : '' }} disabled> Students Readonly
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="students_read_write" {{ $role->students_read_write ? 'checked' : '' }} disabled> Students Read & Write
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="students_read_delete" {{ $role->students_read_delete ? 'checked' : '' }} disabled> Students Read & Delete
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="students_read_create" {{ $role->students_read_create ? 'checked' : '' }} disabled> Students Read & Create
                            </label>
                        </div>
                    </div>

                    <!-- committees -->
                    <div class="col-4 mt-2">
                        <label>Committees</label>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="committees_read_only" {{ $role->committees_read_only ? 'checked' : '' }} disabled> Committees Readonly
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="committees_read_write" {{ $role->committees_read_write ? 'checked' : '' }} disabled> Committees Read & Write
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="committees_read_delete" {{ $role->committees_read_delete ? 'checked' : '' }} disabled> Committees Read & Delete
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="committees_read_create" {{ $role->committees_read_create ? 'checked' : '' }} disabled> Committees Read & Create
                            </label>
                        </div>
                    </div>

                    <div class="col-4 mt-2">
                        <label>Registration Request</label>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="registration_requests_read_only" {{ $role->registration_requests_read_only ? 'checked' : '' }} disabled> Registration Request Readonly
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="registration_requests_read_write" {{ $role->registration_requests_read_write ? 'checked' : '' }} disabled> Registration Request Read & Write
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="registration_requests_read_delete" {{ $role->registration_requests_read_delete ? 'checked' : '' }} disabled> Registration Request Read & Delete
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="registration_requests_read_create" {{ $role->registration_requests_read_create ? 'checked' : '' }} disabled> Registration Request Read & Create
                            </label>
                        </div>
                    </div>

                    <!-- committees -->
                    <div class="col-4 mt-2">
                        <label>Pinboard</label>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="pinboard_read_only" {{ $role->pinboard_read_only ? 'checked' : '' }} disabled> Pinboard Readonly
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="pinboard_read_write" {{ $role->pinboard_read_write ? 'checked' : '' }} disabled> Pinboard Read & Write
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="pinboard_read_delete" {{ $role->pinboard_read_delete ? 'checked' : '' }} disabled> Pinboard Read & Delete
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="pinboard_read_create" {{ $role->pinboard_read_create ? 'checked' : '' }} disabled> Pinboard Read & Create
                            </label>
                        </div>
                    </div>

                    <div class="col-4 mt-2">
                        <label>Grievances</label>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="complaints_read_only" {{ $role->complaints_read_only ? 'checked' : '' }} disabled> Grievances Readonly
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="complaints_read_own_only" {{ $role->complaints_read_own_only ? 'checked' : '' }} disabled> Grievances Readonly Own
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="complaints_read_allowed_users" {{ $role->complaints_read_allowed_users ? 'checked' : '' }} disabled> Grievances Readonly Allowed Users
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="complaints_read_write" {{ $role->complaints_read_write ? 'checked' : '' }} disabled> Grievances Read & Write
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="complaints_read_delete" {{ $role->complaints_read_delete ? 'checked' : '' }} disabled> Grievances Read & Delete
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="complaints_read_create" {{ $role->complaints_read_create ? 'checked' : '' }} disabled> Grievances Read & Create
                            </label>
                        </div>
                    </div>


                    <div class="col-4 mt-2">
                        <label>Suggestion</label>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="suggestion_read_only" {{ $role->suggestion_read_only ? 'checked' : '' }} disabled> Suggestion Readonly
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="suggestion_read_own_only" {{ $role->suggestion_read_own_only ? 'checked' : '' }} disabled> Suggestion Readonly Own
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="suggestion_read_write" {{ $role->suggestion_read_write ? 'checked' : '' }} disabled> Suggestion Read & Write
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="suggestion_read_delete" {{ $role->suggestion_read_delete ? 'checked' : '' }} disabled> Suggestion Read & Delete
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="suggestion_read_create" {{ $role->suggestion_read_create ? 'checked' : '' }} disabled> Suggestion Read & Create
                            </label>
                        </div>
                    </div>


                    <div class="col-4 mt-2">
                        <label>Suggestion category</label>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="suggestion_category_read_only" {{ $role->suggestion_category_read_only ? 'checked' : '' }} disabled> Suggestion Category Readonly
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="suggestion_category_read_write" {{ $role->suggestion_category_read_write ? 'checked' : '' }} disabled> Suggestion Category Read & Write
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="suggestion_category_read_delete" {{ $role->suggestion_category_read_delete ? 'checked' : '' }} disabled> Suggestion Category Read & Delete
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="col-form-label">
                                <input type="checkbox" name="suggestion_category_read_create" {{ $role->suggestion_category_read_create ? 'checked' : '' }} disabled> Suggestion Category Read & Create
                            </label>
                        </div>
                    </div>








                    @if (auth()->user()->contact->role->roles_read_delete)
                    <div class="col-12">
                        <form action="{{ route('roles.destroy', ['role' => $role]) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <input type="submit" value="Delete" class="btn btn-danger"/>
                        </form>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
