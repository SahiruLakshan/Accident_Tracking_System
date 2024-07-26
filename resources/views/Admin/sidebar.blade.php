<div class="sidebar" data-color="purple" data-background-color="black" data-image="../assets/img/accident.jpg">
    <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
            Accident Tracker
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item" id="dashboard-link">
                <a class="nav-link" href="/">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item" id="info-link">
                <a class="nav-link" href="/info">
                    <i class="material-icons">local_pharmacy</i>
                    <p>Injured / Death Details</p>
                </a>
            </li>
            <li class="nav-item" id="accidents-link">
                <a class="nav-link" href="/accidents">
                    <i class="material-icons">report</i>
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
        </ul>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Function to set the active menu item
        function setActiveMenuItem() {
            // Remove 'active' class from all menu items
            const navItems = document.querySelectorAll('.nav-item');
            navItems.forEach(item => {
                item.classList.remove('active');
            });

            // Get the current path
            const currentPath = window.location.pathname;

            // Set the 'active' class based on the current path
            if (currentPath === '/') {
                document.getElementById('dashboard-link').classList.add('active');
            } else if (currentPath === '/info') {
                document.getElementById('info-link').classList.add('active');
            }else if (currentPath === '/accidents') {
                document.getElementById('accidents-link').classList.add('active');
            } else if (currentPath === '/users') {
                document.getElementById('profile-link').classList.add('active');
            } else if (currentPath === '/map') {
                document.getElementById('map-link').classList.add('active');
            }
        }

        // Call the function to set the active menu item on page load
        setActiveMenuItem();

        // Add event listeners to each nav link to handle click events
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                navItems.forEach(item => {
                    item.classList.remove('active');
                });
                this.parentElement.classList.add('active');
            });
        });
    });
</script>
