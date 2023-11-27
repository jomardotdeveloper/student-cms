<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile()
    {
        $suggestions = auth()->user()->suggestions;

        if(isset($_GET['keyword'])){
            $new_suggestions = [];
            foreach($suggestions as $suggestion){
                // dd($suggestions);
                $keywords = $suggestion->keywords_related;
                // dd(in_array($_GET['keyword'], $suggestion->keywords_related));
                if(!in_array($_GET['keyword'], $suggestion->keywords_related)){
                    continue;
                } else {
                    array_push($new_suggestions, $suggestion);
                }

            }

            $suggestions = $new_suggestions;
        }
        return view('profile' , compact('suggestions'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            "name" => "required",
            "email" => "required",
            "phone" => "required",
            "address" => "required",
            "city" => "required",
            "state" => "required",
            "pincode" => "required",
        ]);

        $user = auth()->user();
        $user->update($validated);

        return back()->with(["success" => ["Profile Updated Successfully"]]);
    }


    public function changePassword()
    {
        return view('change-password');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            "old_password" => "required",
            "password" => "required|confirmed",
        ]);

        $user = auth()->user();

        if (!Hash::check($validated["old_password"], $user->password)) {
            return back()->with(["error" => ["Invalid Old Password"]]);
        }

        $user->update([
            "password" => Hash::make($validated["password"])
        ]);

        return back()->with(["success" => ["Password Updated Successfully"]]);
    }

    public function editProfile()
    {
        return view('edit-profile');
    }

}
