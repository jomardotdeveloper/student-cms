<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use App\Models\Vote;
use App\Models\SuggestionCategory;
use Illuminate\Http\Request;
use NlpTools\Tokenizers\WhitespaceTokenizer;
use NlpTools\Similarity\CosineSimilarity;


class SuggestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suggestions = Suggestion::where("status","Approved")->get();

        if(auth()->user()->contact->role->is_committee) {
            $suggestions = Suggestion::all();
        }

        if(isset($_GET['search'])){
            $suggestions = Suggestion::where('body', 'LIKE', '%'.$_GET['search'].'%')->get();
        }

        if (isset($_GET['status']) || isset($_GET['sort'])) {
            $suggestions = Suggestion::all();

            if (isset($_GET['status'])) {
                $suggestions = Suggestion::where('status', $_GET['status'])->get();
            }

            if (isset($_GET['sort'])) {
                if ($_GET['sort'] == "Relevance") {
                    if (isset($_GET['status'])) {
                        $suggestions = $this->getSuggestionRelevance($_GET['status']);
                    } else {
                        $suggestions = $this->getSuggestionRelevance();
                    }
                }
            }
        }

        return view('suggestion.index', compact('suggestions'));
    }
    // public function getSuggestionRelevance($status = "all")
    // {
    //     $suggestions = Suggestion::all();
    //     $categories = SuggestionCategory::all();
    //     $relevanceData = [];

    //     foreach ($suggestions as $suggestion) {
    //         foreach ($categories as $category) {
    //             // Tokenize suggestion body and category name
    //             $tokenizer = new WhitespaceTokenizer();
    //             $suggestionTokens = $tokenizer->tokenize($suggestion->body);
    //             $categoryTokens = $tokenizer->tokenize($category->tag_names_string);

    //             // Calculate cosine similarity
    //             $cosineSimilarity = new CosineSimilarity();
    //             $similarity = $cosineSimilarity->similarity($suggestionTokens, $categoryTokens);

    //             // Store relevance level
    //             $relevanceData[] = [
    //                 'Suggestion' => $suggestion,
    //                 'Category' => $category,
    //                 'Relevance' => $similarity,
    //             ];
    //         }
    //     }

    //     // Sort suggestions by relevance level
    //     usort($relevanceData, function ($a, $b) {
    //         return $b['Relevance'] <=> $a['Relevance'];
    //     });

    //     dd($relevanceData);
    //     $removeDuplicates = [];

    //     foreach ($relevanceData as $data) {
    //         $exists = False;

    //         foreach ($removeDuplicates as $removeDuplicate) {
    //             if ($removeDuplicate['Suggestion']->id == $data['Suggestion']->id) {
    //                 $exists = True;
    //             }
    //         }

    //         if (!$exists) {
    //             $removeDuplicates[] = $data;
    //         }
    //     }

    //     $sorted = [];

    //     foreach ($removeDuplicates as $data) {
    //         if ($status != "all") {
    //             if ($data['Suggestion']->status == $status) {
    //                 $sorted[] = $data['Suggestion'];
    //             }
    //         } else {
    //             $sorted[] = $data['Suggestion'];
    //         }
    //     }

    //     return $sorted;
    // }

    public function getSuggestionRelevance($status = "all") {
        $suggestions = [];
        $suggestionWithObj = [];
        $mySuggestions = Suggestion::where('user_id', auth()->user()->id)->get();
        $notMySuggestions = Suggestion::where('user_id', '!=', auth()->user()->id)->get();

        $myTags = "";


        foreach ($mySuggestions as $mySuggestion) {
            $tags = $mySuggestion->suggestionCategory->tags;
            foreach ($tags as $tag) {
                if (!str_contains($myTags, $tag->name)) {
                    $myTags .= $tag->name . " ";
                }
            }
        }

        foreach ($notMySuggestions as $notMySuggestion) {
            $notMyTags = "";

            $tags = $notMySuggestion->suggestionCategory->tags;

            foreach ($tags as $tag) {
                if (!str_contains($notMyTags, $tag->name)) {
                    $notMyTags .= $tag->name . " ";
                }
            }


            $text1 = $myTags;
            $text2 =  $notMyTags;

            // Tokenize the texts
            $tokenizer = new WhitespaceTokenizer();
            $tokens1 = $tokenizer->tokenize($text1);
            $tokens2 = $tokenizer->tokenize($text2);

            // Calculate cosine similarity
            $cosineSimilarity = new CosineSimilarity();
            $similarity = $cosineSimilarity->similarity($tokens1, $tokens2);

            $suggestionWithObj[] = [
                'suggestion' => $notMySuggestion,
                'similarity' => $similarity
            ];
        }

        usort($suggestionWithObj, function ($a, $b) {
            return $a['similarity'] <=> $b['similarity'];
        });

        foreach ($suggestionWithObj as $suggestion) {
            if ($status != "all") {
                if ($suggestion['suggestion']->status == $status) {
                    $suggestions[] = $suggestion['suggestion'];
                }
            } else {
                $suggestions[] = $suggestion['suggestion'];
            }
        }

        foreach ($mySuggestions as $mySuggestion) {
            $suggestions[] = $mySuggestion;
        }


        return $suggestions;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suggestion_categories = SuggestionCategory::all();
        return view('suggestion.create' , compact('suggestion_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $suggestion = Suggestion::create([
            'user_id' => auth()->user()->id,
            'suggestion_category_id' => $request->suggestion_category_id,
            'status' => "Approved",
            'body' => $request->body,
        ]);

        $suggestion->save();


        if($suggestion->sentiment_analysis == "Negative") {
            $suggestion = Suggestion::find($suggestion->id);
            $suggestion->status = "Pending";
            $suggestion->save();
            return redirect()->route('suggestions.index')->with('error', ['Suggestion created successfully. It is pending approval due to negative sentiment analysis.']);
        }


        return redirect()->route('suggestions.index')->with('success', 'Suggestion created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Suggestion $suggestion)
    {

        return view('suggestion.show', compact('suggestion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Suggestion $suggestion)
    {
        $suggestion_categories = SuggestionCategory::all();
        return view('suggestion.edit', compact('suggestion', 'suggestion_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Suggestion $suggestion)
    {
        $suggestion->update($request->all());
        return redirect()->route('suggestions.index')->with('success', 'Suggestion updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Suggestion $suggestion)
    {
        $suggestion->delete();
        return redirect()->route('suggestions.index')->with('success', 'Suggestion deleted successfully');
    }

    public function approve(Suggestion $suggestion)
    {
        $suggestion->status = "Approved";
        $suggestion->save();
        return redirect()->route('suggestions.index')->with('success', 'Suggestion approved successfully');
    }

    public function reject(Suggestion $suggestion)
    {
        $suggestion->status = "Rejected";
        $suggestion->save();
        return redirect()->route('suggestions.index')->with('success', 'Suggestion rejected successfully');
    }

    public function upvote(Suggestion $suggestion)
    {

        $downvote = Vote::where('is_upvote', false)->where('suggestion_id', $suggestion->id)->where('user_id', auth()->user()->id)->first();
        if ($downvote) {
            $downvote->delete();
        }



        Vote::create([
            'user_id' => auth()->user()->id,
            'suggestion_id' => $suggestion->id,
            'is_upvote' => true
        ]);
        return redirect()->route('suggestions.index')->with('success', 'Suggestion upvoted successfully');
    }

    public function downvote(Suggestion $suggestion)
    {
        $upvote = Vote::where('is_upvote', true)->where('suggestion_id', $suggestion->id)->where('user_id', auth()->user()->id)->first();
        if ($upvote) {
            $upvote->delete();
        }

        Vote::create([
            'user_id' => auth()->user()->id,
            'suggestion_id' => $suggestion->id,
            'is_upvote' => false
        ]);

        return redirect()->route('suggestions.index')->with('success', 'Suggestion downvoted successfully');
    }


}
