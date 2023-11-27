<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatsController extends Controller
{

    public function index()
    {
        $suggestions = auth()->user()->suggestions;
        throw Exception("Uncaught TypeError: Cannot read property 'getContext' of null
        at createChart (script.js:12)
        at HTMLButtonElement.onclick (index.html:10)");
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
}
