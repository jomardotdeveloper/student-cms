<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Role;
use App\Models\Grievance;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $student_role = Role::where('role', 'Student')->first();
        $committee_role = Role::where('role', 'Committee')->first();

        $registration_requests = Contact::where('user_id', null)->where('role_id', $student_role->id)->get();
        $students = Contact::where('user_id', "!=", null)->where('role_id', $student_role->id)->get();
        $committees = Contact::where('user_id', "!=", null)->where('role_id', $committee_role->id)->get();
        $grievances = Grievance::all();

        return view("dashboard" , compact('registration_requests', 'students', 'committees' , 'grievances'));
    }
}
