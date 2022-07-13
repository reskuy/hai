<template>
  <v-app>
    <v-overlay :value="overlay">
      <v-progress-circular
        indeterminate
        size="64"
      ></v-progress-circular>
    </v-overlay>
    <v-main class="NoneTransition" :class="$vuetify.theme.dark ? 'black' : 'grey lighten-4'">
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
  const Appbar = () => import (/* webpackChunkName: "AppBar"*/ '@/components/Appbar.vue')
  console.log('self',self)
  export default {
    components: {
      Appbar
    },

    data () {
      return {
        device:null,
        overlay:false,
        notifToken:null,
        showappbar:false,
        tokenlist:[],
        Stored:null,
      }
    },
    created(){
      let db = firebase.database()
      db.ref('alluser').on('value', x => {
				const data = x.val();
				let tokenlist = [];
				Object.keys(data).forEach(key => {
        // console.log(data[key])
				tokenlist.push(data[key]);
				});
				this.tokenlist = tokenlist;
			});
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
              this.setNotif(token)
              db.ref("alluser").on('value', snapshot => {
                const data = snapshot.val();
                let messages = [];
                Object.keys(data).forEach(key => {
                messages.push(data[key]);
                });
                this.tokenlist = messages
              });
              // msgref.
              this.receiveMessage();
            });
        })
        .catch((err) => {
          console.log("Unable to get token ", err);
        });
    } catch (e) {
      console.log(e);
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
      Vue.prototype.$device = this.device
      Vue.prototype.$Toast = this.Toast
      Vue.prototype.$ChangeURL = this.ChangeURL
      Vue.prototype.$Store = this.Store
      Vue.prototype.$CekStore = this.CekStore
      //
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
      async setNotif(x){
        let data = await this.tokenlist
        console.log(data.includes(x))
        if(data.includes(x) == false){
          firebase.database().ref("alluser").push(x)
        }
      },
      receiveMessage() {
        firebase.messaging().onMessage((payload) => {
          console.log("payload ", payload);
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
  .ScrollCSSHide::-webkit-scrollbar {
    display: none;
  }
  .toolbar-text{
  color:#b71c1c;
  }
</style>
