@extends('Admin.dashboard')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6 col-lg-12">
                    <div class="card card-chart">
                        <div class="card-header card-header-success">
                            <div class="ct-chart" id="completedTasksChart"></div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Accidents of This Week - Week {{ $weekOfMonth }} of
                                {{ \Carbon\Carbon::now()->format('F') }}</h4>

                            @if ($percentageChangeTodayYesterday > 0)
                                <p class="card-category">
                                    <span style="color: rgb(187, 180, 180)">Today</span>
                                    <span class="text-danger">
                                        <i class="fa fa-long-arrow-up"></i>
                                        {{ number_format($percentageChangeTodayYesterday, 2) }}%
                                    </span>
                                    <span style="color: rgb(187, 180, 180)">increase compared to yesterday.</span>
                                </p>
                            @else
                                <p class="card-category">
                                    <span class="text-success">
                                        <span style="color: rgb(187, 180, 180)">Today</span>
                                        <i class="fa fa-long-arrow-down"></i>
                                        {{ number_format($percentageChangeTodayYesterday, 2) }}%
                                    </span>
                                    <span style="color: rgb(187, 180, 180)">decrease compared to yesterday.</span>
                                </p>
                            @endif
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">access_time</i> Last updated: {{ $formattedUpdatedAt }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12">
                    <div class="card card-chart">
                        <div class="card-header card-header-warning">
                            <div class="ct-chart" id="websiteViewsChart"></div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Accidents of This Year - {{ \Carbon\Carbon::now()->format('Y') }}</h4>
                            @if ($percentageChange > 0)
                                <p class="card-category">
                                    <span class="text-danger"><i class="fa fa-long-arrow-up"></i>
                                        {{ number_format($percentageChange, 2) }}% </span> <span
                                        style="color: rgb(187, 180, 180)">increase compare last year.</span>.
                                </p>
                            @else
                                <p class="card-category">
                                    <span class="text-success"><i class="fa fa-long-arrow-down"></i>
                                        {{ number_format($percentageChange, 2) }}% </span> <span
                                        style="color: rgb(187, 180, 180)">decrease compare last year.</span>.
                                </p>
                            @endif
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">access_time</i> Last updated: {{ $formattedUpdatedAt }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12">
                    <div class="card card-chart">
                        <div class="card-header card-header-danger">
                            <div class="ct-chart" id="lastyear"></div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Accidents of Last 5 Years</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12">
                    <div class="card card-chart">
                        <div class="card-header card-header-primary">
                            <div class="ct-chart" id="timerange"></div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Accidents Time Ranges</h4>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">content_copy</i>
              </div>
              <p class="card-category">Used Space</p>
              <h3 class="card-title">49/50
                <small>GB</small>
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-warning">warning</i>
                <a href="#pablo" class="warning-link">Get More Space...</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">store</i>
              </div>
              <p class="card-category">Revenue</p>
              <h3 class="card-title">$34,245</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">date_range</i> Last 24 Hours
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">info_outline</i>
              </div>
              <p class="card-category">Fixed Issues</p>
              <h3 class="card-title">75</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">local_offer</i> Tracked from Github
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="fa fa-twitter"></i>
              </div>
              <p class="card-category">Followers</p>
              <h3 class="card-title">+245</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">update</i> Just Updated
              </div>
            </div>
          </div>
        </div>
      </div> --}}
            {{-- <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header card-header-danger">
                            <h4 class="card-title">Today Reports - Provinces</h4>
                            <p class="card-category">on 18th July, 2024</p>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover">
                                <thead class="text-warning">
                                    <th>#</th>
                                    <th>Province</th>
                                    <th>Accident Count</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Southern Province</td>
                                        <td>5</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header card-header-warning">
                            <h4 class="card-title">Reports - Years</h4>
                            <p class="card-category">To 2023</p>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover">
                                <thead class="text-warning">
                                    <th>#</th>
                                    <th>Year</th>
                                    <th>Accident Count</th>
                                    <th>Deaths</th>
                                    <th>Injured</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>2023</td>
                                        <td>40</td>
                                        <td>5</td>
                                        <td>10</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="col-lg-6 col-md-12">
          <div class="card">
            <div class="card-header card-header-tabs card-header-warning">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <span class="nav-tabs-title">Tasks:</span>
                  <ul class="nav nav-tabs" data-tabs="tabs">
                    <li class="nav-item">
                      <a class="nav-link active" href="#profile" data-toggle="tab">
                        <i class="material-icons">bug_report</i> Bugs
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#messages" data-toggle="tab">
                        <i class="material-icons">code</i> Website
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#settings" data-toggle="tab">
                        <i class="material-icons">cloud</i> Server
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="profile">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>Sign contract for "What are conference organizers afraid of?"</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                        </td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>Create 4 Invisible User Experiences you Never Knew About</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane" id="messages">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                        </td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>Sign contract for "What are conference organizers afraid of?"</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane" id="settings">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                        </td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>Sign contract for "What are conference organizers afraid of?"</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-white btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div> --}}
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var monthlyCounts = @json($monthlyCountsCurrentYear);

        var monthLabels = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];

        var dataWebsiteViewsChart = {
            labels: monthLabels,
            series: [
                Object.values(monthlyCounts)
            ]
        };

        var optionsWebsiteViewsChart = {
            axisX: {
                showGrid: false
            },
            low: 0,
            high: Math.max(...Object.values(monthlyCounts)) + 10,
            chartPadding: {
                top: 0,
                right: 5,
                bottom: 0,
                left: 0
            }
        };

        var responsiveOptions = [
            ['screen and (max-width: 640px)', {
                seriesBarDistance: 5,
                axisX: {
                    labelInterpolationFnc: function(value) {
                        return value[0];
                    }
                }
            }]
        ];

        var websiteViewsChart = new Chartist.Bar('#websiteViewsChart', dataWebsiteViewsChart,
            optionsWebsiteViewsChart, responsiveOptions);

        md.startAnimationForBarChart(websiteViewsChart);

        websiteViewsChart.on('draw', function(data) {
            if (data.type === 'bar') {
                data.group.append(
                    new Chartist.Svg('text', {
                        x: data.x2,
                        y: data.y2 - 10,
                        style: 'text-anchor: middle; font-size: 12px;fill: white;',
                    }, 'ct-label').text(data.value.y)
                );
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get weekly data from Blade
        var weeklyCounts = @json(array_values($weeklyCounts));

        // Define labels for the days of the week
        var weekLabels = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        // Prepare data for Chartist
        var dataCompletedTasksChart = {
            labels: weekLabels,
            series: [
                weeklyCounts
            ]
        };

        var optionsCompletedTasksChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
                tension: 0
            }),
            low: 0,
            high: Math.max(...weeklyCounts) + 10, // Set high dynamically based on data
            chartPadding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            }
        };

        var completedTasksChart = new Chartist.Line('#completedTasksChart', dataCompletedTasksChart,
            optionsCompletedTasksChart);

        // Start animation for the Completed Tasks Chart - Line Chart
        md.startAnimationForLineChart(completedTasksChart);

        // Add text labels to the line chart points
        completedTasksChart.on('draw', function(data) {
            if (data.type === 'point') {
                data.group.append(
                    new Chartist.Svg('text', {
                        x: data.x,
                        y: data.y - 10,
                        style: 'text-anchor: middle; font-size: 12px; fill: white;',
                    }, 'ct-label').text(data.value.y)
                );
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var yearlyCounts = @json($yearlyCounts);

        var yearLabels = Object.keys(yearlyCounts);
        var seriesData = Object.values(yearlyCounts);

        var dataWebsiteViewsChart = {
            labels: yearLabels,
            series: [seriesData]
        };

        var optionsWebsiteViewsChart = {
            axisX: {
                showGrid: false
            },
            low: 0,
            high: Math.max(...seriesData) + 10,
            chartPadding: {
                top: 0,
                right: 5,
                bottom: 0,
                left: 0
            }
        };

        var responsiveOptions = [
            ['screen and (max-width: 640px)', {
                seriesBarDistance: 5,
                axisX: {
                    labelInterpolationFnc: function(value) {
                        return value;
                    }
                }
            }]
        ];

        var websiteViewsChart = new Chartist.Bar('#lastyear', dataWebsiteViewsChart, optionsWebsiteViewsChart,
            responsiveOptions);

        md.startAnimationForBarChart(websiteViewsChart);

        websiteViewsChart.on('draw', function(data) {
            if (data.type === 'bar') {
                data.group.append(
                    new Chartist.Svg('text', {
                        x: data.x2,
                        y: data.y2 - 10,
                        style: 'text-anchor: middle; font-size: 12px;fill: white;',
                    }, 'ct-label').text(data.value.y)
                );
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get time range data from Blade
        var timeRangeCounts = @json(array_values($timeRangeCounts));

        // Define labels for the time ranges
        var timeRangeLabels = ['00:00 - 05:59 am', '06:00 - 11:59 am', '12:00 - 17:59 pm', '18:00 - 23:59 pm'];

        // Prepare data for Chartist
        var dataTimeRangeChart = {
            labels: timeRangeLabels,
            series: [
                timeRangeCounts
            ]
        };

        var optionsTimeRangeChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
                tension: 0
            }),
            low: 0,
            high: Math.max(...timeRangeCounts) + 10, // Set high dynamically based on data
            chartPadding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            }
        };

        var timeRangeChart = new Chartist.Line('#timerange', dataTimeRangeChart, optionsTimeRangeChart);

        // Start animation for the Time Range Chart - Line Chart
        md.startAnimationForLineChart(timeRangeChart);

        // Add text labels to the line chart points
        timeRangeChart.on('draw', function(data) {
            if (data.type === 'point') {
                data.group.append(
                    new Chartist.Svg('text', {
                        x: data.x,
                        y: data.y - 10,
                        style: 'text-anchor: middle; font-size: 12px; fill: white;',
                    }, 'ct-label').text(data.value.y)
                );
            }
        });
    });
</script>
