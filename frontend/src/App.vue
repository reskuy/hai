<template>
  <v-app>
    <v-overlay :value="overlay">
      <v-progress-circular
        indeterminate
        size="64"
      ></v-progress-circular>
    </v-overlay>
    <v-main class="NoneTransition" :class="$vuetify.theme.dark ? 'black' : 'grey lighten-4'">
      <NotifApp/>
      <Appbar/>
      <router-view/>
    </v-main>
  </v-app>
</template>

<script>
  import Vue from 'vue'
  import Vuetify from 'vuetify/lib'
  import firebase from '@/services/firebase-sw.js'

  Vue.use(Vuetify)
  const NotifApp = () => import (/* webpackChunkName: "NotifApp"*/ '@/components/NotifApp.vue')
  const Appbar = () => import (/* webpackChunkName: "AppBar"*/ '@/components/Appbar.vue')
  console.log('self',self)
  export default {
    components: {
      Appbar,NotifApp
    },

    data () {
      return {
        device:null,
        overlay:false,
        notifToken:null,
        showappbar:false,
        logged:JSON.parse(localStorage.getItem('logged')),
        tokenlist:[],
        Stored:null,
      }
    },
    created(){
      let db = firebase.database()
      try {
      firebase
        .messaging()
        .requestPermission()
        .then(() => {
          console.log("Notification permission granted");
          firebase
            .messaging()
            .getToken()
            .then((token) => {
              window.console.log("token ", token);
              this.notifToken = token
              db.ref("alluser").on('value', snapshot => {
                let data = snapshot.val();
                let messages = [];
                Object.keys(data).forEach(key => {
                messages.push(data[key]);
                });
                  if(messages.includes(token) == false){
                    db.ref("alluser").push(token)
                  }
              });
              this.receiveMessage();
            });
        })
        .catch((err) => {
          console.log("Unable to get token ", err);
        });
    } catch (e) {
      console.log('firebase',e);
    }
      // console.log(fbnotif.messaging())
    },
    beforeCreate(){
    //  Vue.prototype.ShowAppBar = false
    },
    mounted(){
      if(window.location.pathname == '/auth'){
        this.showappbar = false
      }else{
        this.showappbar = true
      }
      let user = JSON.parse(localStorage.getItem('logged'))
      if(!user){
        if(this.$router.currentRoute.name != "Login"){
          this.$router.push('/auth')
        }
      }
      let cek = navigator.userAgent.split(/\s*[;)(]\s*/);
      if(cek[1] == "Linux" || cek[1] == "iPhone" || cek[1] == "iPad"){
        this.device = "Mobile"
      }else{
        this.device = "Desktop"
      }
      Vue.prototype.$loading = this.loading
      Vue.prototype.$SetLog = this.SetLog
      Vue.prototype.$device = this.device
      Vue.prototype.$Toast = this.Toast
      Vue.prototype.$ChangeURL = this.ChangeURL
      Vue.prototype.$Store = this.Store
      Vue.prototype.$CekStore = this.CekStore
      Vue.prototype.$DateConvert = this.dateconvert
      //
      console.log(self)
    },
    methods:{
      loading(v){
        this.overlay = v
      },
      Store(x){
        this.Stored = x
      },
      CekStore(){
        return this.Stored
      },
      SetLog(){
        return JSON.parse(localStorage.getItem('logged'))
      },
      receiveMessage() {
        firebase.messaging().onMessage((payload) => {
          console.log("payload ", payload);
          var myAudio = new Audio('http://localhost:8000/storage/SuaraNotif.mpeg');
          myAudio.play();
          this.$Notifkan(payload.notification)
        });
    },
      Toast(icon,title){
          this.$swal.fire({
          toast: true,
          icon: icon,
          title: title,
          animation: false,
          showCloseButton: true,
          position: 'top-right',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true})
      },
      ChangeURL(x){
        if(this.$route.path == '/'+x){
            return
        }
        if(x == 'auth'){
          return this.LogOut()
        }else{
          return this.$router.push('/'+x)
        }
      },
      dateconvert(x){
       let date = new Date(x)
       let monthyear = date.toLocaleString('en-us',{month:'short', year:'numeric'})
       let tgl = date.getDate()
       return tgl+' '+monthyear
      },
    },
    watch:{
      $route(){
        this.rute = this.$route.name
        // let check = this.ruteblock.includes(this.$route.name)
        // if(check == true){
        //   this.isblock = false
        // }else{
        //   this.isblock = true
        // }
      }
    },
    
  };
</script>

<style>
@import url(https://fonts.googleapis.com/css?family=Roboto+Condensed:400&subset=latin,latin-ext);
/* html::-webkit-scrollbar {
  display:none
} */
  .ScrollCSSHide::-webkit-scrollbar {
    display: none;
  }
/* html {   max-height: 100% !important; }  */
  .toolbar-text{
  color:#a10115;
  }
</style>
