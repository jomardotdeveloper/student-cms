<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\AnnouncementCategory;
use App\Models\Tag;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announcements = Announcement::all();
        return view('announcement.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $announcement_categories = AnnouncementCategory::all();
        $tags = Tag::all();
        return view('announcement.create', compact('announcement_categories' , 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $tags = $request->get("tag_ids");
        $tag_ids = [];

        foreach ($tags as $tag) {
            $found_tag = Tag::where('name', $tag)->first();
            if (!$found_tag)
                $found_tag = Tag::create(["name" => $tag]);

            $tag_ids[] = $found_tag->id;
        }

        if (array_key_exists("tag_ids",$data)) {
            $data["tag_ids"] = json_encode($data["tag_ids"]);
        }


        $announcement = Announcement::create($data);
        return redirect()->route('announcements.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement)
    {

        return view('announcement.show', compact('announcement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announcement $announcement)
    {
        $announcement_categories = AnnouncementCategory::all();
        $tags = Tag::all();

        return view('announcement.edit', compact('announcement' , 'announcement_categories' , 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Announcement $announcement)
    {

        $data = $request->all();
        $tags = $request->get("tag_ids");
        $tag_ids = [];

        foreach ($tags as $tag) {
            $found_tag = Tag::where('name', $tag)->first();
            if (!$found_tag)
                $found_tag = Tag::create(["name" => $tag]);

            $tag_ids[] = $found_tag->id;
        }

        if (array_key_exists("tag_ids",$data)) {
            $data["tag_ids"] = json_encode($data["tag_ids"]);
        }

        $announcement->update($data);
        return redirect()->route('announcements.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {

        $announcement->delete();
        return redirect()->route('announcements.index');


    }
}
