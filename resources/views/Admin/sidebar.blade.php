<div class="sidebar" data-color="purple" data-background-color="black" data-image="../assets/img/sidebar-2.jpg">
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
                    <i class="material-icons">content_paste</i>
                    <p>Accidents Reports</p>
                </a>
            </li>
            <li class="nav-item" id="profile-link">
                <a class="nav-link" href="/profile">
                    <i class="material-icons">person</i>
                    <p>Registered Users</p>
                </a>
            </li>
            <li class="nav-item" id="typography-link">
                <a class="nav-link" href="./typography.html">
                    <i class="material-icons">library_books</i>
                    <p>Typography</p>
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
        } else if (currentPath === '/profile') {
            document.getElementById('profile-link').classList.add('active');
        } else if (currentPath === '/profile')) {
            document.getElementById('table-link').classList.add('active');
        } else if (currentPath.includes('typography.html')) {
            document.getElementById('typography-link').classList.add('active');
        } else if (currentPath.includes('icons.html')) {
            document.getElementById('icons-link').classList.add('active');
        } else if (currentPath.includes('map.html')) {
            document.getElementById('maps-link').classList.add('active');
        } else if (currentPath.includes('notifications.html')) {
            document.getElementById('notifications-link').classList.add('active');
        }
    });
</script>
