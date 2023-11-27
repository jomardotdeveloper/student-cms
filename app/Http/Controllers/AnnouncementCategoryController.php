<?php

namespace App\Http\Controllers;

use App\Models\AnnouncementCategory;
use Illuminate\Http\Request;

class AnnouncementCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announcement_categories = AnnouncementCategory::all();

        return view('announcement_category.index', compact('announcement_categories'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('announcement_category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $announcement_category = AnnouncementCategory::create($data);

        return redirect()->route('announcement_categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(AnnouncementCategory $announcementCategory)
    {
        return view('announcement_category.show', compact('announcementCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnnouncementCategory $announcementCategory)
    {
        return view('announcement_category.edit', compact('announcementCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnnouncementCategory $announcementCategory)
    {
        $data = $request->all();

        $announcementCategory->update($data);

        return redirect()->route('announcement_categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnnouncementCategory $announcementCategory)
    {
        $announcementCategory->delete();

        return redirect()->route('announcement_categories.index');
    }
}
