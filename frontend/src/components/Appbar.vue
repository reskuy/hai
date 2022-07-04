<template>
  <div>
  <AppBarMobile v-show="device == 'Mobile' && showappbar == true && islogged == true"/>
  <AppBarDesktop v-show="device == 'Desktop' && showappbar == true && islogged == true"/>
  </div>
</template>
<script>
import Vue from 'vue'
  const AppBarDesktop = () => import (/* webpackChunkName: "AppBarDesktop"*/ '@/views/AppBar/AppBarDesktop.vue')
  const AppBarMobile = () => import (/* webpackChunkName: "AppBarMobile"*/ '@/views/AppBar/AppBarMobile.vue')
  export default {
    components: {
      AppBarDesktop,AppBarMobile
    },
    data: () => ({
        device:null,
        showappbar:false,
        islogged:false,
    }),
    beforeMount(){
        this.device = this.$device
    },
    mounted(){
      if(this.$route.name == 'Login'){
        this.showappbar = false
      }else{
        this.showappbar = true
      }
      Vue.prototype.$logged = this.logged
      Vue.prototype.$loggedout = this.loggedout
    },
    methods:{
      logged(){
        this.islogged = true
        this.$setLogged()
      },
      loggedout(){
        this.islogged = false
      }
    },
    watch:{
      $route(){
        if(this.$route.name != 'Login'){
          this.showappbar = true
        }else{
          this.showappbar = false
        }
      }
    },
    
  }
</script>