import axios from "axios";
 if (process.env.NODE_ENV === 'development') {
  axios.defaults.baseURL = 'http://localhost:8000/api'
 }else{
  axios.defaults.baseURL = window.location.origin+'/haiserver/server.php/api'
 }
export default axios.create({
  baseURL: undefined,
  headers: {
    "Content-type": "application/json",
  }
});