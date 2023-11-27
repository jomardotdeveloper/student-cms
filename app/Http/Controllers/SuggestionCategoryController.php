<?php

namespace App\Http\Controllers;

use App\Models\SuggestionCategory;
use App\Models\Tag;
use Illuminate\Http\Request;

class SuggestionCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suggestion_categories = SuggestionCategory::all();
        return view('suggestion_category.index' , compact('suggestion_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        return view('suggestion_category.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

        $suggestion_category = SuggestionCategory::create($data);

        return redirect()->route('suggestion_categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SuggestionCategory $suggestion_category)
    {
        return view('suggestion_category.show', compact('suggestion_category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuggestionCategory $suggestion_category)
    {
        $tags = Tag::all();
        return view('suggestion_category.edit', compact('suggestion_category', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuggestionCategory $suggestion_category)
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

        $suggestion_category->update($data);

        return redirect()->route('suggestion_categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuggestionCategory $suggestion_category)
    {
        $suggestion_category->delete();
        return redirect()->route('suggestion_categories.index');
    }
}
