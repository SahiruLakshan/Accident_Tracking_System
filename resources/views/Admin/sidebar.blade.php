<div class="sidebar" data-color="purple" data-background-color="black" data-image="../assets/img/accident.jpg">
    <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
            Accident Tracker
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item" id="dashboard-link">
                <a class="nav-link" href="/">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item" id="accidents-link">
                <a class="nav-link" href="/accidents">
                    <i class="material-icons">reports</i>
                    <p>Accidents Reports</p>
                </a>
            </li>
            <li class="nav-item" id="profile-link">
                <a class="nav-link" href="/users">
                    <i class="material-icons">person</i>
                    <p>Registered Users</p>
                </a>
            </li>
            <li class="nav-item" id="map-link">
                <a class="nav-link" href="/map">
                    <i class="material-icons">map</i>
                    <p>Show on Map</p>
                </a>
            </li>
            <li class="nav-item" id="icons-link">
                <a class="nav-link" href="./icons.html">
                    <i class="material-icons">bubble_chart</i>
                    <p>Icons</p>
                </a>
            </li>
            <li class="nav-item" id="maps-link">
                <a class="nav-link" href="./map.html">
                    <i class="material-icons">location_ons</i>
                    <p>Maps</p>
                </a>
            </li>
            <li class="nav-item" id="notifications-link">
                <a class="nav-link" href="./notifications.html">
                    <i class="material-icons">notifications</i>
                    <p>Notifications</p>
                </a>
            </li>
        </ul>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const navItems = document.querySelectorAll('.nav-item');
        navItems.forEach(item => {
            item.classList.remove('active');
        });

        const currentPath = window.location.pathname;
        
        if (currentPath === '/') {
            document.getElementById('dashboard-link').classList.add('active');
        } else if (currentPath === '/users') {
            document.getElementById('profile-link').classList.add('active');
        } 
        }
    });
</script>
