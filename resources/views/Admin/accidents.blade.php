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
                                    <thead class=" text-primary">
                                        <th>
                                            #
                                        </th>
                                        <th>
                                            User ID
                                        </th>
                                        <th>
                                            SE_No
                                        </th>
                                        <th>
                                            Lat
                                        </th>
                                        <th>
                                            Lon
                                        </th>
                                        <th>
                                            Date
                                        </th>
                                        <th>
                                            Time
                                        </th>
                                        <th>
                                            Type
                                        </th>
                                        <th>
                                            Severity
                                        </th>
                                        <th>
                                            Vehicle 1
                                        </th>
                                        <th>
                                            Vehicle 2
                                        </th>
                                        <th>
                                            Vehicle 3
                                        </th>
                                        <th>
                                            Pedest
                                        </th>
                                        <th>
                                            Object
                                        </th>
                                        <th>
                                            With_Con
                                        </th>
                                        <th>
                                            Pas_Inj
                                        </th>
                                        <th>
                                            Ped_Inj
                                        </th>
                                        <th>
                                            des
                                        </th>
                                        <th>
                                            drukness
                                        </th>
                                        <th>
                                            dl
                                        </th>
                                        <th>
                                            nic
                                        </th>
                                        <th>
                                            remarks
                                        </th>
                                        <th>

                                        </th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                123
                                            </td>
                                            <td>
                                                AR_1
                                            </td>
                                            <td>
                                                6.871309
                                            </td>
                                            <td>
                                                79.885589
                                            </td>
                                            <td>
                                                2005-01-22
                                            </td>
                                            <td>
                                                13:40:00
                                            </td>
                                            <td>
                                                Veh To Veh
                                            </td>
                                            <td>
                                                Minor
                                            </td>
                                            <td>
                                                Car
                                            </td>
                                            <td>
                                                Car
                                            </td>
                                            <td>
                                                Bus
                                            </td>
                                            <td>
                                                -
                                            </td>
                                            <td>
                                                -
                                            </td>
                                            <td>
                                                N/A
                                            </td>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                0
                                            </td>
                                            <td>
                                                Car collided with Police sergen
                                            </td>
                                            <td>
                                                Yes
                                            </td>
                                            <td>
                                                -
                                            </td>
                                            <td>
                                                -
                                            </td>
                                            <td>
                                                -
                                            </td>
                                            <td>
                                                <a href="" class="btn btn-sm btn-danger">Remove</a>
                                            </td>
                                        </tr>
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
