<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sentiment\Analyzer;
use NlpTools\Tokenizers\WhitespaceTokenizer;
use NlpTools\Similarity\CosineSimilarity;
class Grievance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'is_student_plm',
        'plm_email',
        'facebook',
        'contact_number',
        'course',
        'year',
        'block',
        'concern',
        'subject_of_concern',
        'description_of_concern',
        'allowed_users',
        'rate',
        'feedback',
        'status',
        'is_tp',
        'is_fp',
        'is_fn',
    ];

    public function emails()
    {
        return $this->hasMany(Email::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function grievanceFiles()
    {
        return $this->hasMany(GrievanceFile::class);
    }

    public function getAllowedUsersAttribute()
    {
        $users = [];

        if (!$this->attributes['allowed_users']) {
            return [];
        }

        foreach (json_decode($this->attributes['allowed_users']) as $user) {
            $users[] = User::find($user);
        }
        return $users;
    }

    public function getAllowedUserIdsAttribute()
    {
        if (!$this->attributes['allowed_users']) {
            return [];
        }
        return json_decode($this->attributes['allowed_users']);
    }

    public function getFormattedIdAttribute()
    {
        return str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }


    public function getSentimentAnalysisAttribute()
    {
        $analyzer = new Analyzer();
        $output_text = $analyzer->getSentiment($this->feedback);
        $mood = '';

        $moods = [
            'Negative - ' . strval($output_text['neg'] * 100) . '%',
            'Neutral - ' . strval($output_text['neu'] * 100) . '%',
            'Positive - ' . strval($output_text['pos'] * 100) . '%',
        ];


        if($output_text['neg'] > 0){
            $mood = 'Negative';
        }

        if($output_text['neu'] > 0 && $output_text['neg'] == 0){
            $mood = 'Neutral';

        }

        if($output_text['pos'] > 0){
            $mood = 'Positive';
        }

        $moods_str = implode(', ', $moods);
        return $moods_str;
    }

    public function getFinalSayPoliciesAttribute()
    {
        $complaint = $this->description_of_concern;
        $comments = [];
        $policies = Policy::all();

        if(count($policies) == 0)
            return "No policies found.";

        $count = 1;
        foreach($policies as $policy) {
            if ($count > 5)
                break;
            $policyText = $policy->policy;
            // Tokenize the texts
            $tokenizer = new WhitespaceTokenizer();
            $complaintTokens = $tokenizer->tokenize($complaint);
            $policyTokens = $tokenizer->tokenize($policyText);
                // dd($policyTokens);
            // Calculate cosine similarity
            $cosineSimilarity = new CosineSimilarity();
            $similarity = $cosineSimilarity->similarity($complaintTokens, $policyTokens);

            // Set a threshold for similarity (you can adjust this as needed)
            $threshold = 0;
            if($similarity > 0) {
                $count++;
                $comments[] = $policy->id;
            }
            // Check if the similarity meets the threshold

        }

        // Policy text - Example: V. GUIDELINES ON ONLINE LEARNING FOR STUDENTS WITH INTERNET...
        return $comments;
    }

    public function getFinalSayAttribute()
    {
        // Sample complaint text (you can replace this with your complaint text)
        $complaint = $this->description_of_concern;
        $comments = [];
        $policies = Policy::all();

        if(count($policies) == 0)
            return "No policies found.";


        $count = 1;
        foreach($policies as $policy) {
            if ($count > 5)
                break;
            $policyText = $policy->policy;
            // Tokenize the texts
            $tokenizer = new WhitespaceTokenizer();
            $complaintTokens = $tokenizer->tokenize($complaint);
            $policyTokens = $tokenizer->tokenize($policyText);
                // dd($policyTokens);
            // Calculate cosine similarity
            $cosineSimilarity = new CosineSimilarity();
            $similarity = $cosineSimilarity->similarity($complaintTokens, $policyTokens);

            // Set a threshold for similarity (you can adjust this as needed)
            $threshold = 0;

            // Check if the similarity meets the threshold

            if($similarity > 0) {
                $count++;
                $comments[] = [
                    'policy' => $policy->policy,
                    'similarity' => $similarity,
                ];
            }
        }


        $comments = collect($comments)->sortByDesc('similarity')->toArray();
        // dd($comments);
        // combined them to string
        $comments_str = '';
        foreach($comments as $comment) {
            if($comment['similarity'] <= 0)
                continue;
            $comments_str .= $comment['policy'] . ' - ' . strval( $comment['similarity']);
            $comments_str .= "<br>";
        }
        // Policy text - Example: V. GUIDELINES ON ONLINE LEARNING FOR STUDENTS WITH INTERNET...
        return $comments_str;
    }

    public function report()
    {
        return $this->hasOne(Report::class);
    }

}
