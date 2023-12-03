<?php

namespace App\Http\Controllers;

use App\Models\Grievance;
use App\Models\Suggestion;
use App\Models\SuggestionCategory;
use Illuminate\Http\Request;

class StatsController extends Controller
{

    public function index()
    {
        $grievancesPerStatusInYear = $this->grievancesPerStatusInYear();
        $grievanceRatingInYear = $this->ratingsInYear();
        // dd($grievancesPerStatusInYear);

        $unresponsive = $grievancesPerStatusInYear['Unresponsive'];
        $ongoing = $grievancesPerStatusInYear['Ongoing'];
        $pending = $grievancesPerStatusInYear['Pending'];
        $resolved = $grievancesPerStatusInYear['Resolved'];

        $suggestionInYear = $this->suggestionInYear();
        $upvotes = $this->upVotesInYear();
        $downvotes = $this->downVotesInYear();
        // dd($upvotes);
        $suggestionCategories = SuggestionCategory::all()->pluck('name')->all();
        $mySuggestionPerCategory = [];

        foreach ($suggestionCategories as $category) {
            $mySuggestionPerCategory[] = count(Suggestion::where('user_id', auth()->user()->id)
                ->where('status', 'Approved')
                ->where('suggestion_category_id', SuggestionCategory::where('name', $category)->first()->id)
                ->get()->all());
        }
        $year = isset($_GET['year']) ? $_GET['year'] : date('Y');
        $top = $this->top10Contributors($year);

        $topnames = [];
        $topcounts = [];

        foreach ($top as $key => $value) {
            $topnames[] = $value['name'];
            $topcounts[] = $value['count'];
        }

        $voteyear = isset($_GET['voteYear']) ? $_GET['voteYear'] : date('Y');

        $upvotespercentage = $this->votesPercentage($voteyear)['upvote'];
        $downvotespercentage = $this->votesPercentage($voteyear)['downvote'];

        // dd($top);

        $topPercentage = $this->topPercentage();
        $totalSuggestionPercentage = $this->totalSuggestionPercentage();
        return view('stats' , compact(
            'totalSuggestionPercentage' ,
            'topPercentage' ,
            'suggestionCategories' ,
            'mySuggestionPerCategory' ,
            'upvotes' ,
            'downvotes' ,
            'suggestionInYear',
            'unresponsive',
            'ongoing',
            'pending',
            'resolved',
            'grievanceRatingInYear',
            'topnames',
            'topcounts',
            'upvotespercentage',
            'downvotespercentage'

        ));
    }

    private function votesPercentage($year) {

        $suggestions = Suggestion::where('status', 'Approved')
            ->whereYear('created_at', $year)
            ->get()->all();

        $upVotes = 0;
        $downVotes = 0;

        foreach ($suggestions as $suggestion) {
            if ($suggestion->up_vote_counts) {
                $upVotes += $suggestion->up_vote_counts;
            }
            if ($suggestion->down_vote_counts) {
                $downVotes += $suggestion->down_vote_counts;
            }
        }
        $percentageUpvote = 0;
        $percentageDownvote = 0;
        if ($upVotes > 0) {
            $percentageUpvote = $upVotes / ($upVotes + $downVotes) * 100;
        }

        if ($downVotes > 0) {
            $percentageDownvote = $downVotes / ($upVotes + $downVotes) * 100;
        }

        return [
            'upvote' => $percentageUpvote,
            'downvote' => $percentageDownvote
        ];

    }

    private function top10Contributors ($year) {
        $suggestions = Suggestion::where('status', 'Approved')
            ->whereYear('created_at', $year)
            ->get()->all();

        $users = [];
        $contributionPerUser = [];

        foreach ($suggestions as $suggestion) {
            if (!in_array($suggestion->user_id, $users)) {
                array_push($users, $suggestion->user_id);
            }
        }

        $top10Contributors = [];

        foreach ($users as $user) {
            $contributionPerUser[$user]['count'] = count(Suggestion::where('user_id', $user)->where('status', 'Approved')->get()->all());
            $contributionPerUser[$user]['name'] = Suggestion::where('user_id', $user)->first()->user->contact->full_name;
        }

        arsort($contributionPerUser);

        $i = 0;

        foreach ($contributionPerUser as $key => $value) {
            if ($i < 10) {
                $top10Contributors[$key] = $value;
            }
            $i++;
        }

        return $top10Contributors;

    }

    private function ratingsInYear() {
        $years = [
            'January' => '01',
            'February' => '02',
            'March' => '03',
            'April' => '04',
            'May' => '05',
            'June' => '06',
            'July' => '07',
            'August' => '08',
            'September' => '09',
            'October' => '10',
            'November' => '11',
            'December' => '12',
        ];

        $counts = [];

        foreach ($years as $month => $year) {
            $suggestion = Grievance::where('status', 'Resolved')
                ->whereMonth('created_at', $year)
                ->get()->all();

            $count = 0;

            foreach ($suggestion as $s) {
                if ($s->rate) {
                    $count += $s->rate;
                }
            }

        }

        return $counts;

    }

    private function grievancesPerStatusInYear () {
        $statuses = ['Pending', 'Ongoing', 'Unresponsive' , 'Resolved'];
        $years = [
            'January' => '01',
            'February' => '02',
            'March' => '03',
            'April' => '04',
            'May' => '05',
            'June' => '06',
            'July' => '07',
            'August' => '08',
            'September' => '09',
            'October' => '10',
            'November' => '11',
            'December' => '12',
        ];

        $counts = [];

        foreach ($years as $month => $year) {
            foreach ($statuses as $status) {
                $suggestion = Grievance::where('status', $status)
                    ->whereMonth('created_at', $year)
                    ->get()->all();

                $counts[$status][] = count($suggestion);
            }
        }
        // dd($counts);
        return $counts;
    }

    private function suggestionInYear() {
        $years = [
            'January' => '01',
            'February' => '02',
            'March' => '03',
            'April' => '04',
            'May' => '05',
            'June' => '06',
            'July' => '07',
            'August' => '08',
            'September' => '09',
            'October' => '10',
            'November' => '11',
            'December' => '12',
        ];

        $counts = [];

        foreach ($years as $month => $year) {
            $suggestion = Suggestion::where('status', 'Approved')
                ->where('user_id', auth()->user()->id)
                ->whereMonth('created_at', $year)
                ->get()->all();

            $counts[] = count($suggestion);
        }
        // dd($counts);
        return $counts;

    }

    private function upVotesInYear() {
        $years = [
            'January' => '01',
            'February' => '02',
            'March' => '03',
            'April' => '04',
            'May' => '05',
            'June' => '06',
            'July' => '07',
            'August' => '08',
            'September' => '09',
            'October' => '10',
            'November' => '11',
            'December' => '12',
        ];

        $counts = [];

        foreach ($years as $month => $year) {
            $suggestion = Suggestion::where('status', 'Approved')
                ->where('user_id', auth()->user()->id)
                ->whereMonth('created_at', $year)
                ->get()->all();


            $count = 0;

            foreach ($suggestion as $s) {


                if ($s->up_vote_counts) {
                    $count += $s->up_vote_counts;
                }
            }

            $counts[] = $count;

        }

        return $counts;

    }

    private function downVotesInYear() {
        $years = [
            'January' => '01',
            'February' => '02',
            'March' => '03',
            'April' => '04',
            'May' => '05',
            'June' => '06',
            'July' => '07',
            'August' => '08',
            'September' => '09',
            'October' => '10',
            'November' => '11',
            'December' => '12',
        ];

        $counts = [];

        foreach ($years as $month => $year) {
            $suggestion = Suggestion::where('status', 'Approved')
                ->where('user_id', auth()->user()->id)
                ->whereMonth('created_at', $year)
                ->get()->all();

            $count = 0;

            foreach ($suggestion as $s) {
                if ($s->down_vote_counts) {
                    $count += $s->down_vote_counts;
                }
            }

            $counts[] = $count;

        }

        return $counts;

    }

    private function topPercentage() {
        $userThatHasSuggestion = Suggestion::where('status', 'Approved')->get()->pluck('user_id')->all();
        $allSuggestion = Suggestion::where('status', 'Approved')->get()->all();
        $users = [];
        $contributionPerUser = [];

        foreach ($userThatHasSuggestion as $user) {
            if (!in_array($user, $users)) {
                array_push($users, $user);
            }
        }

        $topPercentage = 0;

        if (count($users) <= 0){
            return 0;
        }

        foreach ($users as $user) {
            $contributionPerUser[$user] = count(Suggestion::where('user_id', $user)->get()->all()) / count($allSuggestion) * 100;
        }

        return $contributionPerUser[auth()->user()->id];

    }

    private function totalSuggestionPercentage() {
        $suggestions = Suggestion::where('status', 'Approved')->get()->all();
        $mySuggestion = Suggestion::where('user_id', auth()->user()->id)
                                    ->where('status', 'Approved')
                                    ->get()->all();

        $topPercentage = 0;

        if (count($suggestions) <= 0 || count($mySuggestion) <= 0){
            return 0;
        }


        return count($mySuggestion) / count($suggestions) * 100;
    }
}
