<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $policies = Policy::all();
        return view('policy.index' , compact('policies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $policies = Policy::all();

        return view('policy.create' , compact('policies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $policy = Policy::create([
            'policy' => $request->get('policy'),
            'parent_id' => $request->get('parent_id')
        ]);

        return redirect()->route('policies.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Policy $policy)
    {
        $policies = Policy::where('id' , '!=' , $policy->id)->get();
        return view('policy.edit' , compact('policy' , 'policies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Policy $policy)
    {
        $policy->update([
            'policy' => $request->get('policy'),
            'parent_id' => $request->get('parent_id')
        ]);

        return redirect()->route('policies.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
