window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}


window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');
import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    // wsHost: 'http://127.0.0.1:8000',
    // wsPort: 6001,
    encrypted : false,
    auth: {
        headers: {
            'X-CSRF-TOKEN': token,
        },
    },
});

let userId= $('#user_id').val();
if(userId){
    window.Echo.private('chat-'+userId)
    .listen('MessageSent', (data) => {
        console.log(data.message.message);
        $('#addClass').trigger('click');
        console.log(data.message);
    });
}

let adminId = $('#admin_id').val();

if(adminId){
    console.log(adminId);
    window.Echo.private('chat-admin')
    .listen('MessageToAdmin', (data) => {
        console.log(data.message);
        $('.see_message').trigger('click');
    });
}
