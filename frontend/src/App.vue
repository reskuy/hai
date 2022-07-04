<template>
  <v-app>
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
      Vue.prototype.$device = this.device
      //
    },
    methods:{
      //
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

  .v-navigation-drawer {
    will-change: initial;
  }

  .v-menu {
    will-change: initial !important;
  }

  .NoneTransition {
    transition: none !important
  }
  /* icon syncfusion */
  .mata:before{ 
    content:'\e345'; 
    /* color: #2E7D32 !important; */
  /* endof icon syncfusion */
  } 
  .e-edit:before{
    color: #0D47A1 !important;
  }
  .e-delete:before{
    color: red !important;
  }
  .e-pager .e-currentitem{
    background: #D32F2F !important;
  }
</style>