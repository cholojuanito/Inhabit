window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('jquery');

    //require('bootstrap-sass');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */
window.Vue = require('vue');
window.axios = require('axios');
window.moment = require('moment');

import velocity from 'velocity-animate';
import Form from './classes/Form.js';
import VueRouter from 'vue-router';
import VueAuth from '@websanova/vue-auth';
import VueAxios from 'vue-axios';
import auth from './auth'
import router from './routes';
import chunk from 'chunk';

window.Form = Form;
// Make the base url 'api/'
window.axios.defaults.baseURL = process.env.MIX_APP_URL + '/api';
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/** 
 *  Attach the Vue Plugins
 *
 * The only order that matters is this
 * 1. Router first
 *  2. Vue axios after that
 *  3. VueAuth after that
 */
Vue.router = router;
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(VueAuth, auth);

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

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });



/**
 * Any other global variables
 */

const statesArray = [
    'Alabama - AL',
    'Alaska - AK',
    'Arizona - AZ',
    'Arkansas - AR',
    'California - CA',
    'Colorado - CO',
    'Connecticut - CT',
    'Delaware - DE',
    'Florida - FL',
    'Georgia - GA',
    'Hawaii - HI',
    'Idaho - ID',
    'Illinois - IL',
    'Indiana - IN',
    'Iowa - IA',
    'Kansas - KS',
    'Kentucky - KY',
    'Louisiana - LA',
    'Maine - ME',
    'Maryland - MD',
    'Massachusetts - MA',
    'Michigan - MI',
    'Minnesota - MN',
    'Mississippi - MS',
    'Missouri - MO',
    'Montana - MT',
    'Nebraska - NE',
    'Nevada - NV',
    'New Hampshire - NH',
    'New Jersey - NJ',
    'New Mexico - NM',
    'New York - NY',
    'North Carolina - NC',
    'North Dakota - ND',
    'Ohio - OH',
    'Oklahoma - OK',
    'Oregon - OR',
    'Pennsylvania - PA',
    'Rhode Island - RI',
    'South Carolina - SC',
    'South Dakota - SD',
    'Tennessee - TN',
    'Texas - TX',
    'Utah - UT',
    'Vermont - VT',
    'Virginia - VA',
    'Washington - WA',
    'West Virginia - WV',
    'Wisconsin - WI',
    'Wyoming - WY',
];

window.STATES = statesArray;
window.CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
