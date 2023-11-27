<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sentiment\Analyzer;
use NlpTools\Tokenizers\WhitespaceTokenizer;
use NlpTools\Similarity\CosineSimilarity;

class Suggestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'suggestion_category_id',
        'status',
        'body'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function suggestionCategory()
    {
        return $this->belongsTo(SuggestionCategory::class);
    }

    public function getSentimentAnalysisAttribute()
    {
        $analyzer = new Analyzer();
        $output_text = $analyzer->getSentiment($this->body);
        $mood        = '';


        if($output_text['neg'] > 0){
            $mood = 'Negative';
        }

        if($output_text['neu'] > 0 && $output_text['neg'] == 0){
            $mood = 'Neutral';
        }

        if($output_text['pos'] > 0){
            $mood = 'Positive';
        }

        return $mood;
    }

    public function getKeywordsRelatedAttribute()
    {



        $keywords = [];
        $tokenizer = new WhitespaceTokenizer();
        $suggestionTokens = $tokenizer->tokenize($this->body);

        foreach($suggestionTokens as $token) {
            $tokens = $tokenizer->tokenize($token);
            $categoryTokens = $tokenizer->tokenize($this->suggestionCategory->tag_names_string);

            $cosineSimilarity = new CosineSimilarity();
            $similarity = $cosineSimilarity->similarity($tokens, $categoryTokens);

            if ($similarity > 0) {
                // Merge suggestion keywords with the existing list
                $keywords = array_merge($keywords, $tokens);
            }
        }

        foreach($suggestionTokens as $token) {
            $tokens = $tokenizer->tokenize($token);
            $categoryTokens = $tokenizer->tokenize($this->suggestionCategory->name);

            $cosineSimilarity = new CosineSimilarity();
            $similarity = $cosineSimilarity->similarity($tokens, $categoryTokens);

            if ($similarity > 0) {
                // Merge suggestion keywords with the existing list
                $keywords = array_merge($keywords, $tokens);
            }
        }
        try{
            foreach($this->suggestionCategory->tag_names as $token) {
                $startLetterLower = strtolower(substr($token, 0, 1));
                // dd($token);
                $jsonFilePath = public_path('dictionary/' . $startLetterLower . '.json');

                // Read the contents of the JSON file
                $jsonContents = file_get_contents($jsonFilePath);

                // Decode JSON data
                $data = json_decode($jsonContents, true);
                $word = $data[strtoupper($token)];


                foreach($word['SYNONYMS'] as $synonym) {
                    foreach($suggestionTokens as $suggestionToken) {
                        if (strtoupper($synonym) == strtoupper($suggestionToken)) {
                            $keywords[] = $suggestionToken;
                        }
                    }

                }


            }
        }catch(\Exception $e){

        }




        // remove duplicates in keywords
        $keywords = array_unique($keywords);

        return $keywords;
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function getUpVoteCountsAttribute()
    {
        return $this->votes()->where('is_upvote', true)->count();
    }

    public function getDownVoteCountsAttribute()
    {
        return $this->votes()->where('is_upvote', false)->count();
    }


    public function getUserAllowedToUpVoteAttribute()
    {
        $user = auth()->user();

        if (!$user) {
            return false;
        }

        $vote = $this->votes()->where('user_id', $user->id)->where('is_upvote', true)->first();
        // dd($vote);
        if ($vote) {
            return false;
        }

        return true;
    }

    public function getUserAllowedToDownVoteAttribute()
    {
        $user = auth()->user();

        if (!$user) {
            return false;
        }

        $vote = $this->votes()->where('user_id', $user->id)->where('is_upvote', false)->first();

        if ($vote) {
            return false;
        }

        return true;
    }
}
