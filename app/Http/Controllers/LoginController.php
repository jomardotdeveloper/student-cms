<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $validated = $request->validate([
            "username" => "required",
            "password" => "required"
        ]);

        if (Auth::attempt($validated, true)) {
            $request->session()->regenerate();
            return redirect()->intended("/backend/stats");
        }

        return back()->with(["error" => ["Invalid Credentials"]]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route("login");
    }

    public function register ()
    {
        return view('register');
    }

    public function store (Request $request)
    {
        $validated = $request->validate([
            "student_number" => "required|unique:contacts",
            'password' => [
                'required',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ],
            'password_confirmation' => 'required|same:password'
        ]);


        $role = Role::where('role', 'student')->first();
        $data = $request->all();
        $data["role_id"] = $role->id;
        $data["temp_password"] = $request->get("password");
        $data["enrollment_form"] = $this->upload($request->file("enrollment_form"), "enrollment_forms");

        Contact::create($data);

        return redirect()->route("login");
    }
}
