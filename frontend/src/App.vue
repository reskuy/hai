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
        showappbar:false,
      }
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
      //
    },
    methods:{
      loading(v){
        this.overlay = v
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
