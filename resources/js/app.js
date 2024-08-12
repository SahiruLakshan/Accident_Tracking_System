import './bootstrap';
require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;


Echo.channel('accidents')
    .listen('NewAccidentReport', (e) => {
        // Show notification
        document.getElementById('notification-badge').style.display = 'inline-block';
    });


Alpine.start();
