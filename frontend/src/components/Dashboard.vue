<template>
  <div>
  <DashboardMobile v-if="device == 'Mobile'"/>
  <DashboardDesktop v-if="device == 'Desktop'"/>
  </div>
</template>
<script>
import Vue from 'vue'
  const DashboardMobile = () => import (/* webpackChunkName: "DashboardMobile"*/ '@/views/Dashboard/DashboardMobile.vue')
  const DashboardDesktop = () => import (/* webpackChunkName: "DashboardDesktop"*/ '@/views/Dashboard/DashboardDesktop.vue')
  export default {
    components: {
      DashboardMobile,DashboardDesktop
    },
    data: () => ({
        device:null,
        items:[
        {
          color: 'black',
          icon: 'mdi-briefcase',
          title: 'Aset',
          data: 'Aset',
          count:'-',
          to:'Aset'
        },
        {
          color: 'black',
          icon: 'mdi-account',
          title: 'Peminjaman',
          data: 'Peminjaman',
          count:'-',
          to:'Peminjaman'
        },
        {
          color: 'black',
          icon: 'mdi-car',
          title: 'Tes Drive',
          data: 'Tes Drive',
          count:'-',
          to:'TesDrive'
        },
        {
          color: 'black',
          icon: 'mdi-account',
          title: 'User',
          data: 'User',
          count:'-',
          to:'User'
        },
      ],
    }),
    created(){
      Vue.prototype.$ItemDashboard = this.getItem()
    },
    beforeMount(){
        this.device = this.$device
        // console.log(this.device)
    },
    mounted(){
      // console.log(this.$route.name)
    },
    methods:{
      getItem(){
        return this.items
      }
    }
    
  }
</script>