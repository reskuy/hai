<template>
  <div>
  <DashboardMobile v-if="device == 'Mobile'"/>
  <DashboardDesktop v-if="device == 'Desktop'"/>
  </div>
</template>
<script>
  const DashboardMobile = () => import (/* webpackChunkName: "DashboardMobile"*/ '@/views/Dashboard/DashboardMobile.vue')
  const DashboardDesktop = () => import (/* webpackChunkName: "DashboardDesktop"*/ '@/views/Dashboard/DashboardDesktop.vue')
  export default {
    components: {
      DashboardMobile,DashboardDesktop
    },
    data: () => ({
        device:null
    }),
    beforeMount(){
        this.device = this.$device
        // console.log(this.device)
    },
    mounted(){
      // console.log(this.$route.name)
    }
    
  }
</script>