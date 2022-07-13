import axios from "axios";
 if (process.env.NODE_ENV === 'development') {
  axios.defaults.baseURL = 'http://localhost:8000/api'
  // axios.defaults.baseURL = 'https://0d26-110-139-169-149.ap.ngrok.io/api'
 }else{
  axios.defaults.baseURL = window.location.origin+'/haiserver/server.php/api'
 }
export default axios.create({
  baseURL: undefined,
  headers: {
    "Content-type": "application/json",
  }
});