@extends('_default')

@section('content')

    <h1>Dashboard</h1>

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <h5 class="text-muted font-weight-normal mt-0">Rentals</h5>
                                    @php
                                        $curr_count = \App\Reservation::where('company_id', \Auth::user()->company_id)->whereBetween('created_at', [\Carbon\Carbon::parse('first day of this month')->format('Y-m-d H:i:s'), \Carbon\Carbon::now()->format('Y-m-d H:i:s')])->count();
                                        $prev_count = \App\Reservation::where('company_id', \Auth::user()->company_id)->whereBetween('created_at', [\Carbon\Carbon::parse('first day of last month')->format('Y-m-d H:i:s'), \Carbon\Carbon::parse('last day of last month')->format('Y-m-d H:i:s')])->count();
                                        $percentChange = $curr_count > 0 ? (1 - $prev_count / $curr_count) * 100 : 0;
                                    @endphp
                                    <h3 class="mt-3 mb-3">{{ $curr_count }}</h3>
                                    <p class="mb-0 text-muted">
                                        <span class="text-{{ $percentChange < 0 ? 'danger' : 'success' }} mr-2">{{ $percentChange > 0 ? '+' : '' }}{{ number_format($percentChange, 2) }}%</span>
                                        <span class="text-nowrap">Since Last Month</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <h5 class="text-muted font-weight-normal mt-0">Revenue</h5>
                                    @php
                                        $curr_amt_charged = \App\Reservation::where('company_id', \Auth::user()->company_id)->whereBetween('created_at', [\Carbon\Carbon::parse('first day of this month')->format('Y-m-d H:i:s'), \Carbon\Carbon::now()->format('Y-m-d H:i:s')])->sum('amount_charged');
                                        $curr_fees = \App\Reservation::where('company_id', \Auth::user()->company_id)->whereBetween('created_at', [\Carbon\Carbon::parse('first day of this month')->format('Y-m-d H:i:s'), \Carbon\Carbon::now()->format('Y-m-d H:i:s')])->sum('stripe_fees');
                                        $current_revenue = $curr_amt_charged - $curr_fees;
                                        $prev_amt_charged = \App\Reservation::where('company_id', \Auth::user()->company_id)->whereBetween('created_at', [\Carbon\Carbon::parse('first day of last month')->format('Y-m-d H:i:s'), \Carbon\Carbon::parse('last day of last month')->format('Y-m-d H:i:s')])->sum('amount_charged');
                                        $prev_fees = \App\Reservation::where('company_id', \Auth::user()->company_id)->whereBetween('created_at', [\Carbon\Carbon::parse('first day of last month')->format('Y-m-d H:i:s'), \Carbon\Carbon::parse('last day of last month')->format('Y-m-d H:i:s')])->sum('stripe_fees');
                                        $prev_revenue = $prev_amt_charged - $prev_fees;
                                        $percentChange = $current_revenue > 0 ? (1 - $prev_revenue / $current_revenue) * 100 : 0;
                                    @endphp
                                    <h3 class="mt-3 mb-3">${{ number_format($current_revenue, 2) }}</h3>
                                    <p class="mb-0 text-muted">
                                        <span class="text-{{ $percentChange < 0 ? 'danger' : 'success' }} mr-2">{{ $percentChange > 0 ? '+' : '' }}{{ number_format($percentChange, 2) }}%</span>
                                        <span class="text-nowrap">Since Last Month</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 mt-3 mt-xs-0">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <h5 class="text-muted font-weight-normal mt-0">Views</h5>
                                    <h3 class="mt-3 mb-3">0</h3>
                                    <p class="mb-0 text-muted">
                                        <span class="text-success mr-2">+/- 0.00%</span>
                                        <span class="text-nowrap">Since Last Month</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 mt-3 mt-xs-0">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <h5 class="text-muted font-weight-normal mt-0">SOMETHING ELSE</h5>
                                    <h3 class="mt-3 mb-3">0</h3>
                                    <p class="mb-0 text-muted">
                                        <span class="text-success mr-2">+/- 0.00%</span>
                                        <span class="text-nowrap">Since Last Month</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="card widget-flat">
                    <div class="card-body">
                        <h5 class="text-muted font-weight-normal mt-0">6 Month Revenue to View Comparison</h5>
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="row">
            <div class="col-xs-12 col-md-5">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-md-12" style="padding-right:0;">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <h5 class="text-muted font-weight-normal mt-0">Popular Units</h5>
                                    <canvas id="donut"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-7">
                <div class="card widget-flat">
                    <div class="card-body">
                        <h5 class="text-muted font-weight-normal mt-0">Tasks This Week</h5>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Unit</th>
                                        <th>Task</th>
                                        <th>Scheduled</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tr>
                                    <td>UNIT NAME</td>
                                    <td>TASK SHORT DESCRIPTION</td>
                                    <td>DATE</td>
                                    <td><i class="far fa-edit"></i></td>
                                </tr>
                                <tr>
                                    <td>UNIT NAME</td>
                                    <td>TASK SHORT DESCRIPTION</td>
                                    <td>DATE</td>
                                    <td><i class="far fa-edit"></i></td>
                                </tr>
                                <tr>
                                    <td>UNIT NAME</td>
                                    <td>TASK SHORT DESCRIPTION</td>
                                    <td>DATE</td>
                                    <td><i class="far fa-edit"></i></td>
                                </tr>
                                <tr>
                                    <td>UNIT NAME</td>
                                    <td>TASK SHORT DESCRIPTION</td>
                                    <td>DATE</td>
                                    <td><i class="far fa-edit"></i></td>
                                </tr>
                                <tr>
                                    <td>UNIT NAME</td>
                                    <td>TASK SHORT DESCRIPTION</td>
                                    <td>DATE</td>
                                    <td><i class="far fa-edit"></i></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scriptsStack')

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
            label: 'Revenue',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [0, 10, 5, 2, 20, 30, 45]
        },
        {
            label: 'Views',
            backgroundColor: 'rgb(90,19,255)',
            borderColor: 'rgb(90,19,255)',
            data: [0, 155, 22, 18, 3, 164, 22]
        }]
    },

    // Configuration options go here
    options: {}
    });

    var dnt = document.getElementById('donut').getContext('2d');
    var donut = new Chart(dnt, {
        type: 'doughnut',
        data: {
            datasets: [{
        data: [10, 20, 30, 15, 18, 15, 16],
        backgroundColor: ['rgb(150,51,255)', 'rgb(255,231,18)', 'rgb(81,161,57)', 'rgb(127,127,127)', 'rgb(0,45,247)']
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
        'Purple',
        'Yellow',
        'Green',
        'Gray',
        'Blue'
    ]
        },
        options: {
            legend: {
                position: 'left'
            }
        }
    });
    </script>

@endpush
