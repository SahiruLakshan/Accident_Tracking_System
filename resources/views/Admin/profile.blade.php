@extends('Admin.dashboard')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-warning">
                            <h4 class="card-title "><b>Registered Users</b></h4>
                            <p class="card-category"> Registered By Mobile and Web App</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary">
                                        <th>
                                            #
                                        </th>
                                        <th>
                                            User ID
                                        </th>
                                        <th>
                                            Username
                                        </th>
                                        <th>
                                            Contact Number
                                        </th>
                                        <th>
                                            Address
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                        <th>

                                        </th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>123</td>
                                            <td>Sahiru Lakshan</td>
                                            <td>0766216791</td>
                                            <td>Mahawela Gedara, Kotawila, Kamburugamuwa</td>
                                            <td>sahiru906@gmail.com</td>
                                            <td><a href="" class="btn btn-sm btn-danger">Remove</a></td>
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
