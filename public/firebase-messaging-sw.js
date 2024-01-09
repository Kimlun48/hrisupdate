/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({
  apiKey: "AIzaSyDej99zkPzNOwxneXzS9op7_1yDhvU-Z-8",
  authDomain: "laravel-firebase-demo-8232d.firebaseapp.com",
  databaseURL: "https://laravel-firebase-demo-8232d-default-rtdb.asia-southeast1.firebasedatabase.app",
  projectId: "laravel-firebase-demo-8232d",
  storageBucket: "laravel-firebase-demo-8232d.appspot.com",
  messagingSenderId: "581079552692",
  appId: "1:581079552692:web:09765c8e846961e65d7de1",
  measurementId: "G-GQXPE9M25S"

});

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
  console.log(
    "[firebase-messaging-sw.js] Received background message ",
    payload,
  );
  /* Customize notification here */
  const notificationTitle = "Background Message Title";
  const notificationOptions = {
    body: "Background Message body.",
    icon: "/itwonders-web-logo.png",
  };

  return self.registration.showNotification(
    notificationTitle,
    notificationOptions,
  );
});
