import firebase from 'firebase/app'
import "firebase/database";
import "firebase/messaging";


const config = {
    apiKey: "AIzaSyC55sPAxNKvmk_jvcm3uXVpbib3Dx9C1L0",
    authDomain: "amarthanotif-d4a1e.firebaseapp.com",
    projectId: "amarthanotif-d4a1e",
    databaseURL: "https://amarthanotif-d4a1e-default-rtdb.asia-southeast1.firebasedatabase.app",
    storageBucket: "amarthanotif-d4a1e.appspot.com",
    messagingSenderId: "297029544586",
    appId: "1:297029544586:web:feae439a348b87772cdb73",
    measurementId: "G-NV649R8FDN"
};

const db = firebase.initializeApp(config);

export default db;