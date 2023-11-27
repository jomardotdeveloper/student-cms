<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view("role.index", compact("roles"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("role.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();


        foreach ($data as $key => $value) {
            if ($value == "on") {
                $data[$key] = true;
            }
        }
        Role::create($data);
        return redirect()->route("roles.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view("role.show", compact("role"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view("role.edit", compact("role"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $boolean_fields = [
            'dashboard_read_only',
            'dashboard_read_write',
            'dashboard_read_delete',
            'dashboard_read_create',
            'roles_read_only',
            'roles_read_write',
            'roles_read_delete',
            'roles_read_create',
            'students_read_only',
            'students_read_write',
            'students_read_delete',
            'students_read_create',
            'committees_read_only',
            'committees_read_write',
            'committees_read_delete',
            'committees_read_create',
            'registration_requests_read_only',
            'registration_requests_read_write',
            'registration_requests_read_delete',
            'registration_requests_read_create',
            'pinboard_read_only',
            'pinboard_read_write',
            'pinboard_read_delete',
            'pinboard_read_create',
            'helpdesk_read_only',
            'helpdesk_read_write',
            'helpdesk_read_delete',
            'helpdesk_read_create',
            'complaints_read_only',
            'complaints_read_write',
            'complaints_read_delete',
            'complaints_read_create',
            'stats_read_only',
            'stats_read_write',
            'stats_read_delete',
            'stats_read_create',
            'access_to_message',
            'complaints_read_own_only',
            'complaints_read_allowed_users',
            'suggestion_read_only',
            'suggestion_read_write',
            'suggestion_read_delete',
            'suggestion_read_create',
        ];

        foreach ($boolean_fields as $field) {
            $role->{$field} = false;
        }
        $role->save();

        $data = $request->all();

        foreach ($data as $key => $value) {
            if ($value == "on") {
                $data[$key] = true;
            }
        }

        $role->update($data);

        return redirect()->route("roles.index");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route("roles.index");
    }
}
