@extends('Admin.dashboard')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-warning">
                            <h4 class="card-title"><b>Registered Users</b></h4>
                            <p class="card-category">Registered By Mobile and Web App</p>
                        </div>
                        <div class="card-body">
                            <form id="searchForm" class="navbar-form mr-5">
                                @csrf
                                <div class="input-group no-border sm:w-50">
                                    <input type="text" id="searchUserId" class="form-control flex-grow" name="search" placeholder="Search by UserId or Name" />
                                    <button type="submit" class="btn btn-default btn-round btn-just-icon">
                                        <i class="material-icons">search</i>
                                        <div class="ripple-container"></div>
                                    </button>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary">
                                        <th>#</th>
                                        <th>User ID</th>
                                        <th>Username</th>
                                        <th>Contact Number</th>
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th></th>
                                    </thead>
                                    <tbody id="userTable">
                                        @php $x = 0; @endphp
                                        @foreach($users as $user)
                                            @php $x++; @endphp
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#searchUserId').on('keyup', function () {
                var userId = $(this).val();

                $.ajax({
                    url: '{{ route("searchByUserId") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        search: userId
                    },
                    success: function (response) {
                        $('#userTable').empty();

                        if (response.users.length > 0) {
                            var users = response.users;
                            var x = 1;

                            users.forEach(function(user) {
                                $('#userTable').append(`
                                    <tr>
                                        <td><b><i>${x}</i></b></td>
                                        <td>${user.id}</td>
                                        <td>${user.name}</td>
                                        <td>${user.phone_number}</td>
                                        <td style="max-width: 300px">${user.address}</td>
                                        <td>${user.email}</td>
                                        <td><a href="/removeuser/${user.id}" class="btn btn-sm btn-danger">Remove</a></td>
                                    </tr>
                                `);
                                x++;
                            });
                        } else {
                            $('#userTable').append('<tr><td colspan="7">No user found</td></tr>');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endsection
