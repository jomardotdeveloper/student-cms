@extends('master')

@section('content')
<div class="row">
    <div class="col-sm-12 mb-1">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
    </div>
    @if (auth()->user()->contact->role->stats_read_only)
    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa-solid fa-users"></i></span>
                <div class="dash-widget-info">
                    <span>You're among the top</span>
                    <h3>{{ $topPercentage }}%</h3>
                    <span>Contributors of all time</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa-solid fa-file-text"></i></span>
                <div class="dash-widget-info">
                    <span>You're Contributed about</span>
                    <h3>{{ $totalSuggestionPercentage }}%</h3>
                    <span>of the total suggestions</span>
                </div>
            </div>
        </div>
    </div>





    <div class="col-md-6 text-center">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Upvotes</h3>
                <canvas id="upvote-line-charts"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6 text-center">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Downvotes</h3>
                <canvas id="downvote-line-charts"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6 text-center">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Suggestions</h3>
                <canvas id="suggestion-line-charts"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6 text-center">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Category Chart</h3>
                <canvas id="category-bar-charts"></canvas>
            </div>
        </div>
    </div>

    @endif

    @if (auth()->user()->contact->role->stats_read_write)
    <div class="col-md-6 text-center">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Resolved</h3>
                <canvas id="resolved-line-charts"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6 text-center">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Ongoing</h3>
                <canvas id="ongoing-line-charts"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6 text-center">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Pending</h3>
                <canvas id="pending-line-charts"></canvas>
            </div>
        </div>
    </div>


    <div class="col-md-6 text-center">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Unresponsive</h3>
                <canvas id="unresponsive-line-charts"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6 text-center">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Average Performance Rating</h3>
                <canvas id="rate-line-charts"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6 text-center">
        @php
            $currentYear = isset($_GET['year']) ? $_GET['year'] : date('Y');
        @endphp
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Top 10 Contributors</h3>
                <select name="form-control" id="Years">
                    <option value="2023" {{ $currentYear == "2023" ? "selected" : "" }}>2023</option>
                    <option value="2022" {{ $currentYear == "2022" ? "selected" : "" }}>2022</option>
                    <option value="2021" {{ $currentYear == "2021" ? "selected" : "" }}>2021</option>
                    <option value="2020" {{ $currentYear == "2020" ? "selected" : "" }}>2020</option>
                    <option value="2019" {{ $currentYear == "2019" ? "selected" : "" }}>2019</option>
                    <option value="2018" {{ $currentYear == "2018" ? "selected" : "" }}>2018</option>
                    <option value="2017" {{ $currentYear == "2017" ? "selected" : "" }}>2017</option>
                </select>
                <canvas id="contributors-bar-charts"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6 text-center">
        @php
            $voteCurrentYear = isset($_GET['voteYear']) ? $_GET['voteYear'] : date('Y');
        @endphp
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Votes</h3>
                <select name="form-control" id="VoteYears">
                    <option value="2023" {{ $voteCurrentYear == "2023" ? "selected" : "" }}>2023</option>
                    <option value="2022" {{ $voteCurrentYear == "2022" ? "selected" : "" }}>2022</option>
                    <option value="2021" {{ $voteCurrentYear == "2021" ? "selected" : "" }}>2021</option>
                    <option value="2020" {{ $voteCurrentYear == "2020" ? "selected" : "" }}>2020</option>
                    <option value="2019" {{ $voteCurrentYear == "2019" ? "selected" : "" }}>2019</option>
                    <option value="2018" {{ $voteCurrentYear == "2018" ? "selected" : "" }}>2018</option>
                    <option value="2017" {{ $voteCurrentYear == "2017" ? "selected" : "" }}>2017</option>
                </select>
                <canvas id="votes-bar-charts"></canvas>
            </div>
        </div>
    </div>
    @endif




</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('category-bar-charts');
   const suggestionCategories = @json($suggestionCategories);
   const myData = @json($mySuggestionPerCategory);
  new Chart(ctx, {
    type: 'pie',
    data: {
      labels: suggestionCategories,
      datasets: [{
        label: '# of Suggestions',
        data: myData,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  const ctx2 = document.getElementById('upvote-line-charts');
   const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November","December"];
    const data = @json($upvotes);
    new Chart(ctx2, {
        type: 'line',
        data: {
        labels: months,
        datasets: [{
            label: '# of Upvotes',
            data: data,
            borderWidth: 1
        }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });

    const ctx3 = document.getElementById('downvote-line-charts');
//    const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November","December"];
    const data2 = @json($downvotes);
    new Chart(ctx3, {
        type: 'line',
        data: {
        labels: months,
        datasets: [{
            label: '# of Downvotes',
            data: data2,
            borderWidth: 1
        }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });

    const ctx4 = document.getElementById('suggestion-line-charts');
//    const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November","December"];
    const data3 = @json($suggestionInYear);
    new Chart(ctx4, {
        type: 'line',
        data: {
        labels: months,
        datasets: [{
            label: '# of Suggestions',
            data: data3,
            borderWidth: 1
        }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });
</script>


<script>
    const monthsData = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November","December"];
    const resolvedGrievances = @json($resolved);

    const resolveCtx = document.getElementById('resolved-line-charts');
    new Chart(resolveCtx, {
        type: 'line',
        data: {
        labels: monthsData,
        datasets: [{
            label: '# of Resolved',
            data: resolvedGrievances,
            borderWidth: 1
        }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });

    const ongoingGrievances = @json($ongoing);
    const ongoingCtx = document.getElementById('ongoing-line-charts');
    new Chart(ongoingCtx, {
        type: 'line',
        data: {
        labels: monthsData,
        datasets: [{
            label: '# of Ongoing',
            data: ongoingGrievances,
            borderWidth: 1
        }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });


    const pendingGrievances = @json($pending);

    const pendingCtx = document.getElementById('pending-line-charts');
    new Chart(pendingCtx, {
        type: 'line',
        data: {
        labels: monthsData,
        datasets: [{
            label: '# of Pending',
            data: pendingGrievances,
            borderWidth: 1
        }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });


    const unresponsiveGrievances = @json($unresponsive);

    const unresponsiveCtx = document.getElementById('unresponsive-line-charts');

    new Chart(unresponsiveCtx, {
        type: 'line',
        data: {
        labels: monthsData,
        datasets: [{
            label: '# of Unresponsive',
            data: unresponsiveGrievances,
            borderWidth: 1
        }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });

    const rateGrievances = @json($grievanceRatingInYear);

    const rateCtx = document.getElementById('rate-line-charts');

    new Chart(rateCtx, {
        type: 'line',
        data: {
        labels: monthsData,
        datasets: [{
            label: 'Rate',
            data: rateGrievances,
            borderWidth: 1
        }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });

    const topLabels = @json($topnames);
    const topContributorsData = @json($topcounts);


    const contributorsCtx = document.getElementById('contributors-bar-charts');

    new Chart(contributorsCtx, {
        type: 'bar',
        data: {
        labels: topLabels,
        datasets: [{
            label: 'Top 10 Contributors',
            data: topContributorsData,
            borderWidth: 1
        }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });

    var yearDropdown = document.getElementById("Years");

    yearDropdown.onchange = function() {
        var selectedYear = this.value;
        var url = "{{ route('stats.index') }}?year=" + selectedYear;
        window.location.href = url;
    };


    var voteYearDropdown = document.getElementById("VoteYears");

    voteYearDropdown.onchange = function() {
        var selectedYear = this.value;
        var url = "{{ route('stats.index') }}?voteYear=" + selectedYear;
        window.location.href = url;
    };

    const voteLabels = ["Upvotes", "Downvotes"];
    const upvotesData = "{{ $upvotespercentage }}";
    const downvotesData = "{{ $downvotespercentage }}";

    const votesCtx = document.getElementById('votes-bar-charts');

    new Chart(votesCtx, {
        type: 'bar',
        data: {
        labels: voteLabels,
        datasets: [{
            label: 'Votes',
            data: [upvotesData, downvotesData],
            borderWidth: 1
        }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });


</script>
@endpush
