<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Email;
use App\Models\EmailFile;
use App\Models\Grievance;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emails = Email::where('to_user_id', auth()->user()->id)->orWhere('from_user_id', auth()->user()->id)->where('grievance_id',"=", null)->get();

        // dd($emails);
        if(isset($_GET['type'])) {
            $type = $_GET['type'];
            if($type == "sent") {
                $emails = Email::where('from_user_id', auth()->user()->id)->where('grievance_id', null)->get();
            } else if($type == "received") {
                $emails = Email::where('to_user_id', auth()->user()->id)->where('grievance_id', null)->get();
            }
        }
        return view('email.index', compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = [];
        $committee_roles = Role::where('is_committee', true)->get();
        $contacts = Contact::whereIn('role_id', $committee_roles->pluck('id'))->get();

        foreach ($contacts as $contact) {
            $users[] = $contact->user;
        }
        $grievances = Grievance::all();
        return view('email.create' , compact('grievances' , 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messageType = $request->get('message_type');
        $user = null;
        if($messageType == "Student") {
            $contact = Contact::where("student_number", $request->get("student_number"))->first();

            if($contact == null) {
                return back()->with(["error" => ["Student Number does not exist"]]);
            }

            $user = $contact->user;
        } else if($messageType == "Committee") {
            $user = User::find($request->get("user_id"));

            if($user == null) {
                return back()->with(["error" => ["Username does not exist"]]);
            }
        } else {
            $admin = User::all()->first();
            $user = $admin;
        }

        $data = $request->all();

        $data["to_user_id"] = $user->id;
        $data["from_user_id"] = auth()->user()->id;

        $email = Email::create($data);

        if($request->has("files")) {
            $files = $request->file("files");
            foreach ($files as $file) {
                $path = $this->upload($file, "grievance_files");
                EmailFile::create([
                    "email_id" => $email->id,
                    "file" => $path,
                    'name' => $file->getClientOriginalName(),
                ]);
            }
        }

        return redirect()->route('emails.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Email $email)
    {
        if(auth()->user()->id == $email->to_user_id) {
            $email->is_read = true;
            $email->save();
        }
        return view('email.show', compact('email'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
