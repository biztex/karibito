require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
});