import axios from "axios";
 if (process.env.NODE_ENV === 'development') {
  axios.defaults.baseURL = 'http://192.168.1.11:8000/api'
 }else{
  axios.defaults.baseURL = window.location.origin+'/haiserver/server.php/api'
 }
export default axios.create({
  baseURL: undefined,
  headers: {
    "Content-type": "application/json",
  }
});