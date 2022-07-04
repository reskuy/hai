<template>
  <div>
  <AppBarMobile v-show="device == 'Mobile'"/>
  <AppBarDesktop v-show="device == 'Desktop'"/>
  </div>
</template>
<script>
  const AppBarDesktop = () => import (/* webpackChunkName: "AppBarDesktop"*/ '@/views/AppBar/AppBarDesktop.vue')
  const AppBarMobile = () => import (/* webpackChunkName: "AppBarMobile"*/ '@/views/AppBar/AppBarMobile.vue')
  export default {
    components: {
      AppBarDesktop,AppBarMobile
    },
    data: () => ({
        device:null,
        showappbar:false
    }),
    beforeMount(){
        this.device = this.$device
        if(window.location.pathname == '/auth'){
          this.showappbar = false
        }else{
          this.showappbar = true
        }
        // console.log(this.device)
    }
    
  }
</script>