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
        logged:JSON.parse(localStorage.getItem('logged')),
        tokenlist:[],
        TokenIT:[],
        Stored:null,
      }
    },
    created(){
      let u = JSON.parse(localStorage.getItem('logged'))
      // if(u != null){
      //   console.log('user',u)
      if(u != null){
        this.ConnectFirebase()
        this.ITNotif()
        console.log('user login')
    }
    else{
      console.log('user masi kosong')
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
      Vue.prototype.$UserLogged = this.UserLogged
      Vue.prototype.$SetLog = this.SetLog
      Vue.prototype.$device = this.device
      Vue.prototype.$ConnectFirebase = this.ConnectFirebase
      Vue.prototype.$Toast = this.Toast
      Vue.prototype.$ChangeURL = this.ChangeURL
      Vue.prototype.$Store = this.Store
      Vue.prototype.$CekStore = this.CekStore
      Vue.prototype.$DateConvert = this.dateconvert
      //
      console.log(self)
    },
    methods:{
      ConnectFirebase(){
        console.log('conected')
        let u = JSON.parse(localStorage.getItem('logged'))
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
                  let direct = 'userlevel/'+u.level+'/'+u.id_user
                  // const eventref = db.ref(direct) 
                  // let snapshot = eventref.once('value');
                  db.ref(direct).on('value', snapshot => {
                    let data = snapshot.val();
                    let messages = [];
                    if(data != null){
                      Object.keys(data).forEach(key => {
                      messages.push(data[key]);
                      });
                      if(messages.includes(token) == false){
                        db.ref(direct).push(token)
                      }
                    }else{
                      db.ref(direct).push(token)
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
      },
      async ITNotif(){
        const eventrefIT = firebase.database().ref("userlevel/3"); //IT
        let snapshotIT = await eventrefIT.once('value');
        let dx = snapshotIT.val();
        Object.keys(dx).forEach(key => {
          this.TokenIT.push(dx[key]);
        });
        Vue.prototype.$TokenIT = this.TokenIT
      },
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
          var myAudio = new Audio(window.location.origin+'/storage/SuaraNotif.mpeg');
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
      UserLogged(){
        return JSON.parse(localStorage.getItem('logged'))
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
