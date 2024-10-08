<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top" id="navigation-example">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            @if (Auth::check() && Auth::user()->type == '0')
                <a class="navbar-brand" href="javascript:void(0)"><i class="material-icons">person</i> {{ Auth::user()->name }}</a>
            @elseif (Auth::check() && Auth::user()->type == '1')
                <a class="navbar-brand" href="javascript:void(0)">Admin - {{ Auth::user()->name }}</a>
                <a href="/register" class="btn btn-sm btn-danger">Add an user</a>
            @else
                <p>Please login</p>
            @endif
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
            aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end">
            {{-- <form class="navbar-form mr-5">
                <div class="input-group no-border">
                    <input type="text" value="" class="form-control" placeholder="Search..." />
                    <button type="submit" class="btn btn-default btn-round btn-just-icon">
                        <i class="material-icons">search</i>
                        <div class="ripple-container"></div>
                    </button>
                </div>
            </form> --}}
            <ul class="navbar-nav">
                <form action="/logout" method="post">
                    @csrf
                    <button class="btn btn-sm btn-success">Logout</button>
                </form>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)">
                        <i class="material-icons">dashboard</i>
                        <p class="d-lg-none d-md-block">Stats</p>
                    </a>
                </li> --}}
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link" href="javscript:void(0)" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">notifications</i>
                        <span class="notification">5</span>
                        <p class="d-lg-none d-md-block">Some Actions</p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="javascript:void(0)">Mike John responded to your email</a>
                        <a class="dropdown-item" href="javascript:void(0)">You have 5 new tasks</a>
                        <a class="dropdown-item" href="javascript:void(0)">You're now friend with Andrew</a>
                        <a class="dropdown-item" href="javascript:void(0)">Another Notification</a>
                        <a class="dropdown-item" href="javascript:void(0)">Another One</a>
                    </div>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>
