
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap-sass');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

var siteurl = document.querySelector('meta[name="site-url"]').getAttribute('content');
var pusherKey       = null;
var pusherCluster   = null;
window.Echo = new Echo({
    broadcaster : 'pusher',
    key         : pusherKey,
    cluster     : pusherCluster,
    encrypted   : true,
    authEndpoint: siteurl + '/broadcasting/auth'
});

console.log(window.Echo);

var userId          = localStorage.getItem('user.logged.id');
var notification    = require('./notifications/notification');

window.Echo
    .private('chat-user.'+userId)
    .listen('Chat', (response) => {
        console.log('NEW MESSAGE');
        console.log(response);
        notification.main('Anda mendapat pesan baru', response.data.message, null);
        $('#conversation-box').append('' +
            '<div class="row-chat opponent">\n' +
            '   <div class="alert alert-success text-left fit-to-content opponent-message" data-chat-message-id="' + response.data.message_id + '">\n' +
            '       '+ response.data.message +'\n' +
            '   </div>\n' +
            '</div>' +
            '');
        $("#conversation-box").scrollTop($("#conversation-box")[0].scrollHeight);
});