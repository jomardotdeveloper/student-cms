<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CommitteeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $committee_roles = Role::where('is_committee', true)->get();
        $contacts = Contact::whereIn('role_id', $committee_roles->pluck('id'))->get();

        // dd($contacts[0]->user);
        return view('committee.index' , compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::where('is_committee', true)->get();
        return view('committee.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "username" => "required|unique:users",
            "password" => "required|confirmed",
        ]);

        $role = Role::where('role', 'Committee')->first();

        $user = User::create([
            'username' => $request->get('username'),
            'password' => Hash::make($request->get('password')),
        ]);

        $data = $request->all();
        // $data["role_id"] = $role->id;
        $data["user_id"] = $user->id;

        $contact = Contact::create($data);
        $contact->user_id = $user->id;
        $contact->save();

        return redirect()->route('committees.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $committee = Contact::findOrFail($id);

        return view('committee.show', compact('committee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $committee = Contact::findOrFail($id);
        $roles = Role::where('is_committee', true)->get();

        return view('committee.edit', compact('committee', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $committee = Contact::findOrFail($id);
        $user = User::findOrFail($committee->user_id);

        $validated = $request->validate([
            "username" => "required|unique:users,username," . $user->id,
        ]);

        $user->username = $request->get('username');
        $user->password = Hash::make($request->get('password'));
        $user->save();



        $committee->update($request->all());

        return redirect()->route('committees.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $committee = Contact::findOrFail($id);
        $user = User::findOrFail($committee->user_id);
        $user->delete();
        $committee->delete();

        return redirect()->route('committees.index');
    }
}
