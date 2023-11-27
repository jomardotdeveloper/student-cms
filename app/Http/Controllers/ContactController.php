<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ContactController extends Controller
{
    public function index() {
        // contacts without user
        $contacts = Contact::where('user_id', null)->get();

        return view('registration-request.index' , compact('contacts'));
    }

    public function approve($id) {
        $contact = Contact::findOrFail($id);
        $user = User::create([
            'username' => $contact->student_number,
            'password' => Hash::make($contact->temp_password),
        ]);

        $contact->user_id = $user->id;
        $contact->save();

        return redirect()->route('contacts.index');
    }

    public function reject($id) {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('contacts.index');
    }
}
