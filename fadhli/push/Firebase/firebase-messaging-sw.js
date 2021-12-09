importScripts('https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js');

var firebaseConfig = {
    apiKey: "AIzaSyDmWZcXCEO4tWOq0gQB4YLzOqDKq7z_UzU",
    authDomain: "pushnotifications-45197.firebaseapp.com",
    projectId: "pushnotifications-45197",
    storageBucket: "pushnotifications-45197.appspot.com",
    messagingSenderId: "378507834485",
    appId: "1:378507834485:web:8702a0e0dcd18478ae343c",
    measurementId: "G-CSP438E6RB"
};

firebase.initializeApp(firebaseConfig);
const messaging=firebase.messaging();

messaging.setBackgroundMessageHandler(function (payload) {
    console.log(payload);
    const notification=JSON.parse(payload);
    const notificationOption={
        body:notification.body,
        icon:notification.icon
    };
    return self.registration.showNotification(payload.notification.title,notificationOption);
});