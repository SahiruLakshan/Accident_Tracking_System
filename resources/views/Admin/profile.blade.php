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
                                        @php
                                            $x=0;
                                        @endphp
                                        @foreach($users as $user)
                                            @php
                                                $x++;
                                            @endphp
                                            <tr>
                                                <td><b><i>{{ $x }}</i></b></td>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->phone_number }}</td>
                                                <td style="max-width: 300px">{{ $user->address }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td><a href="{{ url('/removeuser' . $user->id) }}" class="btn btn-sm btn-danger">Remove</a></td>
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
