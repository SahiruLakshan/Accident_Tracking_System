@extends('Admin.dashboard')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-warning">
                            <h4 class="card-title "><b>Accident Reports</b></h4>
                            <p class="card-category"> Submitted By Users</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                  <thead class="text-primary">
                                    <tr>
                                      <th style="color: white;">#</th>
                                      <th style="color: white;">User ID</th>
                                      <th style="color: white;">SE_No</th>
                                      <th style="color: white;">Lat & Lon</th>
                                      <th style="color: white;">Date</th>
                                      <th style="color: white;">Time</th>
                                      <th style="color: white;">Type</th>
                                      <th style="color: white;">Severity</th>
                                      <th style="color: white;">Vehicle 1</th>
                                      <th style="color: white;">Vehicle 2</th>
                                      <th style="color: white;">Vehicle 3</th>
                                      <th style="color: white;">Pedest</th>
                                      <th style="color: white;">Object</th>
                                      <th style="color: white;">With_Con</th>
                                      <th style="color: white;">Pas_Inj</th>
                                      <th style="color: white;">Ped_Inj</th>
                                      <th style="color: white;">des</th>
                                      <th style="color: white;">drukness</th>
                                      <th style="color: white;">dl</th>
                                      <th style="color: white;">nic</th>
                                      <th style="color: white;">Images</th>
                                      <th style="color: white;">remarks</th>
                                      <th style="color: white;"></th>
                                    </tr>
                                  </thead>
                                  
                                    <tbody>
                                      @php $x =0 @endphp
                                      @foreach ($data as $accidents)
                                        @php $x++ @endphp
                                        <tr>
                                            <td>
                                              {{ $x }}
                                            </td>
                                            <td>
                                              {{ $accidents->user_id }}
                                            </td>
                                            <td>
                                              {{ $accidents->se_no }}
                                            </td>
                                            <td>
                                              <a href="https://www.google.com/maps/search/?api=1&query={{ $accidents->lat }},{{ $accidents->lon }}" target="_blank" style="color: inherit; text-decoration: underline;">
                                                {{ $accidents->lat }},{{ $accidents->lon }}
                                              </a>
                                            </td>
                                            <td>
                                              {{ $accidents->date }}
                                            </td>
                                            <td>
                                              {{ $accidents->time }}
                                            </td>
                                            <td>
                                              {{ $accidents->acd_type }}
                                            </td>
                                            <td>
                                              {{ $accidents->severity }}
                                            </td>
                                            <td>
                                              {{ $accidents->vehicle_1 }}
                                            </td>
                                            <td>
                                              {{ $accidents->vehicle_2 }}
                                            </td>
                                            <td>
                                              {{ $accidents->vehicle_3 }}
                                            </td>
                                            <td>
                                              {{ $accidents->pedest }}
                                            </td>
                                            <td>
                                              {{ $accidents->object }}
                                            </td>
                                            <td>
                                              {{ $accidents->with_con }}
                                            </td>
                                            <td>
                                              {{ $accidents->pas_inj }}
                                            </td>
                                            <td>
                                              {{ $accidents->ped_inj }}
                                            </td>
                                            <td>
                                              {{ $accidents->des }}
                                            </td>
                                            <td>
                                              {{ $accidents->drunkness }}
                                            </td>
                                            <td>
                                              {{ $accidents->dl }}
                                            </td>
                                            <td>
                                              {{ $accidents->nic }}
                                            </td>
                                            <td>
                                              <a href="" class="btn btn-sm btn-success">View Images</a>
                                            </td>
                                            <td>
                                              {{ $accidents->remarks }}
                                            </td>
                                            <td>
                                                <a href="" class="btn btn-sm btn-danger">Remove</a>
                                            </td>
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
    </div>
@endsection
