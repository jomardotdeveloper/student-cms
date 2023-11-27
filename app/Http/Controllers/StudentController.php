<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student_role = Role::where('role', 'Student')->first();
        $contacts = Contact::where('user_id',"!=", null)->where('role_id', '=', $student_role->id)->get();
        return view('student.index' , compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "student_number" => "required|unique:contacts",
            "password" => "required|confirmed",
        ]);


        $role = Role::where('role', 'student')->first();

        $user = User::create([
            'username' => $request->get('student_number'),
            'password' => Hash::make($request->get('password')),
        ]);

        $data = $request->all();
        $data["role_id"] = $role->id;
        $data["temp_password"] = $request->get("password");
        $data["user_id"] = $user->id;
        $data["enrollment_form"] = $this->upload($request->file("enrollment_form"), "enrollment_forms");

        $contact = Contact::create($data);
        $contact->user_id = $user->id;
        $contact->save();

        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Contact::findOrFail($id);

        return view('student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Contact::findOrFail($id);

        return view('student.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = Contact::findOrFail($id);

        $validated = $request->validate([
            "student_number" => "required|unique:contacts,student_number," . $student->id,
        ]);

        $user = User::findOrFail($student->user_id);

        $user->username = $request->get('student_number');
        $student->update($validated);
        return redirect()->route("students.edit", $student->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Contact::findOrFail($id);
        $user = User::findOrFail($student->user_id);
        $user->delete();
        $student->delete();

        return redirect()->route('students.index');
    }
}
