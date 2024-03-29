<?php

namespace App\Http\Controllers;

use Antoineaugusti\LaravelSentimentAnalysis\Facades\SentimentAnalysis;
use App\Models\Contact;
use App\Models\Grievance;
use App\Models\GrievanceFile;
use App\Models\Report;
use App\Models\Role;
use Illuminate\Http\Request;
use Sentiment\Analyzer;

class GrievanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $grievances = Grievance::all();
        if(auth()->user()->contact->role->complaints_read_own_only) {
            $grievances = Grievance::where('user_id', auth()->user()->id)->get();
        }

        if(auth()->user()->contact->role->complaints_read_allowed_users) {
            $all_grivances = Grievance::all();
            $grievances = [];
            foreach ($all_grivances as $grievance) {
                if (in_array(auth()->user()->id, $grievance->allowed_user_ids)) {
                    $grievances[] = $grievance;
                }
            }
        }

        if(auth()->user()->contact->role->complaints_read_only) {
            // dd("JOMAR");
            $grievances = Grievance::all();
        }
        return view('grievance.index', compact('grievances'));
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
        return view('grievance.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();




        $user = auth()->user();
        $data["user_id"] = $user->id;
        // $data["is_student_plm"] = $data["is_student_plm"] == "Yes" ? true : false;
        if (array_key_exists("allowed_users",$data)) {
            $data["allowed_users"] = json_encode($data["allowed_users"]);
        }

        $grievance = Grievance::create($data);




        if($request->has("files")) {
            $files = $request->file("files");
            foreach ($files as $file) {
                $path = $this->upload($file, "grievance_files");
                GrievanceFile::create([
                    "grievance_id" => $grievance->id,
                    "file" => $path
                ]);
            }
        }

        return redirect()->route('grievances.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Grievance $grievance)
    {
        $emails = $grievance->emails;
        return view('grievance.show', compact('grievance' , 'emails'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grievance $grievance)
    {
        $users = [];
        $committee_roles = Role::where('is_committee', true)->get();
        $contacts = Contact::whereIn('role_id', $committee_roles->pluck('id'))->get();

        foreach ($contacts as $contact) {
            $users[] = $contact->user;
        }
        return view('grievance.edit', compact('grievance', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grievance $grievance)
    {
        $data = $request->all();

        if($request->verify_npl){
            $selected_policies = $request->policies;
            $grievance_policies = $grievance->final_say_policies;
            $grievance->update([
                "is_fn" => false,
                "is_tp" => false,
                "is_fp" => false
            ]);

            if(count($grievance_policies) < 1){
                $grievance->update([
                    "is_fn" => true
                ]);
                return redirect()->route('grievances.index');
            }

            // check if all policies are present in the selected policies
            $is_present_all = true;
            foreach($grievance_policies as $grievance_policy){
                if(!in_array($grievance_policy, $selected_policies)){
                    $is_present_all = false;
                }
            }

            $is_false_negative = false;

            foreach($grievance_policies as $grievance_policy){
                if(!in_array($grievance_policy, $selected_policies)){
                    $is_false_negative = true;
                }else{
                    $is_false_negative = false;
                }
            }

            if($is_false_negative){
                $grievance->update([
                    "is_fn" => true
                ]);
                return redirect()->route('grievances.index');
            }

            if($is_present_all){
                $grievance->update([
                    "is_tp" => true
                ]);
                return redirect()->route('grievances.index');
            }else{
                $grievance->update([
                    "is_fp" => true
                ]);
                return redirect()->route('grievances.index');
            }



        }


        if (array_key_exists("is_summary_report",$data) && array_key_exists("is_create",$data)) {
            Report::create([
                "grievance_id" => $grievance->id,
                "body" => $data["body"]
            ]);

            return redirect()->route('grievances.index');
        }


        if (array_key_exists("is_summary_report",$data) && array_key_exists("is_update",$data)) {
            $report = Report::where('grievance_id', $grievance->id)->first();
            $report->body = $data["body"];
            $report->save();

            return redirect()->route('grievances.index');
        }


        if (array_key_exists("is_rate_form",$data)) {

            $grievance->update($data);
            return redirect()->route('grievances.index');
        }





        $user = auth()->user();
        // $data["is_student_plm"] = $data["is_student_plm"] == "Yes" ? true : false;
        if (array_key_exists("allowed_users",$data)) {
            $data["allowed_users"] = json_encode($data["allowed_users"]);
        }

        $grievance->update($data);

        if($request->has("files")) {
            $files = $request->file("files");
            foreach ($files as $file) {
                $path = $this->upload($file, "grievance_files");
                GrievanceFile::create([
                    "grievance_id" => $grievance->id,
                    "file" => $path
                ]);
            }
        }

        return redirect()->route('grievances.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grievance $grievance)
    {
        $grievance->delete();
        return redirect()->route('grievances.index');
    }

    public function printReport(Grievance $grievance) {
        return view('grievance.print-report', compact('grievance'));
    }

}
