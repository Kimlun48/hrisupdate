window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
//
import firebase from 'firebase/app';
import 'firebase/database';
import 'firebase/messaging';

const firebaseConfig = {
  apiKey: "AIzaSyCM7srRuoTvzAvTMDycPbUKbknE21NddiI",
  authDomain: "hris-an.firebaseapp.com",
  projectId: "hris-an",
  storageBucket: "hris-an.appspot.com",
  messagingSenderId: "953747269200",
  appId: "1:953747269200:web:9a18bfdfeedeff65585355",
  measurementId: "G-M85FD3ETBB"
};

firebase.initializeApp(firebaseConfig);
