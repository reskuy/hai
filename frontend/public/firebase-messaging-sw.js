importScripts("https://www.gstatic.com/firebasejs/8.2.5/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/8.2.5/firebase-messaging.js");

// Initialize the Firebase app in the service worker by passing in
// your app's Firebase config object.
// https://firebase.google.com/docs/web/setup#config-object
    firebase.initializeApp({
        apiKey: "AIzaSyC55sPAxNKvmk_jvcm3uXVpbib3Dx9C1L0",
        authDomain: "amarthanotif-d4a1e.firebaseapp.com",
        projectId: "amarthanotif-d4a1e",
        storageBucket: "amarthanotif-d4a1e.appspot.com",
        messagingSenderId: "297029544586",
        appId: "1:297029544586:web:feae439a348b87772cdb73",
        measurementId: "G-NV649R8FDN"
    });
    const messaging = firebase.messaging();
    messaging.onBackgroundMessage((payload) => {
      console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload
      );
      // Customize notification here
      const notificationTitle = payload.notification.title;
      const notificationOptions = {
        body: payload.notification.body,
      };
    
      self.registration.showNotification(notificationTitle, notificationOptions);
    });