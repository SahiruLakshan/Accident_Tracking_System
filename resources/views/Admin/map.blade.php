@extends('Admin.dashboard')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<style>
    #map {
        height: 500px;
        /* Adjust the height as needed */
        width: 100%;
    }
</style>
@section('content')
    <div id="map"></div>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize the Leaflet map
            var map = L.map('map').setView([7.8731, 80.7718], 8); // Center on Sri Lanka

            // Add a tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
            }).addTo(map);

            // Retrieve locations from Laravel
            var locations = @json($locations);

            // Add markers for each location
            locations.forEach(function(location) {
                L.marker([parseFloat(location.lat), parseFloat(location.lon)])
                    .addTo(map)
                    .bindPopup(
                        '<div class="popup-content">' +
                        '<b>Se_No:</b> ' + location.se_no + '<br>' +
                        '<b>Lat:</b> ' + location.lat + '<br>' +
                        '<b>Lon:</b> ' + location.lon + '<br>' +
                        '<b>Date:</b> ' + location.date + '<br>' +
                        '<b>Time:</b> ' + location.time +
                        '</div>'
                    );
            });

            // Adjust map bounds based on locations
            var bounds = new L.LatLngBounds();
            locations.forEach(function(location) {
                bounds.extend([parseFloat(location.lat), parseFloat(location.lon)]);
            });
            map.fitBounds(bounds, {
                padding: [50, 50]
            });
        });
    </script>
@endsection
