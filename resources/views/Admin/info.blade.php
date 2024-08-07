@extends('Admin.dashboard')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5 col-md-12">
                    <div class="card">
                        <div class="card-header card-header-danger">
                            <h4 class="card-title">This Year Status - {{ \Carbon\Carbon::now()->format('Y') }}</h4>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover">
                                <thead class="text-warning">
                                    <th><b>#</b></th>
                                    <th><b>Severity</b></th>
                                    <th><b>Accident Count</b></th>
                                </thead>
                                <tbody>
                                    @php $x = 0 @endphp
                                    @foreach ($severityCounts as $severity)
                                        @php $x++@endphp
                                        <tr>
                                            <td>{{ $x }}</td>
                                            <td>{{ $severity->Severity }}</td>
                                            <td>{{ $severity->count }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 col-md-12">
                    <div class="card">
                        <div class="card-header card-header-warning">
                            <h4 class="card-title">Last Years Status</h4>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover">
                                <thead class="text-warning">
                                    <th><b>#</b></th>
                                    <th><b>Year</b></th>
                                    <th><b>Accident Count</b></th>
                                    <th><b>Passanger Injuries</b></th>
                                    <th><b>Pedestrian Injuries</b></th>
                                    <th><b>Children Injuries</b></th>
                                    <th><b>Total Injuries</b></th>
                                </thead>
                                <tbody>
                                    @foreach ($yearlyData as $index => $data)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $data->year }}</td>
                                            <td>{{ $data->accident_count }}</td>
                                            <td>{{ $data->passanger_injuries }}</td>
                                            <td>{{ $data->pedestrian_injuries }}</td>
                                            <td>{{ $data->children_injuries }}</td>
                                            <td style="font-weight: 700">{{ $data->total_injuries }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
