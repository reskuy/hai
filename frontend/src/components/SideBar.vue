<template>
      <v-navigation-drawer
      v-model="drawer"
        absolute
        dark
        right
        overlay-opacity="0"
        hide-overlay
        expand-on-hover
      >
        <v-list
          nav
          dense
        >
        <v-list-item link @click="ChangeURL('history')">
            <v-list-item-icon>
              <v-icon color="#a10115">mdi-history</v-icon>
            </v-list-item-icon>
            <v-list-item-title><span style="color:#a10115;">History</span></v-list-item-title>
          </v-list-item>
          <v-list-item link @click="ChangeURL('Pengaturan')">
            <v-list-item-icon>
              <v-icon color="#a10115">mdi-cog</v-icon>
            </v-list-item-icon>
            <v-list-item-title><span style="color:#a10115;">Pengaturan</span></v-list-item-title>
          </v-list-item>
          <v-list-item link @click="ChangeURL('auth')">
            <v-list-item-icon>
              <v-icon color="#a10115">mdi-logout</v-icon>
            </v-list-item-icon>
            <v-list-item-title><span style="color:#a10115;">Log Out</span></v-list-item-title>
          </v-list-item>
        </v-list>
      </v-navigation-drawer>
</template>
<script>
import Vue from 'vue'
  export default {
    data(){
      return{
        drawer:true,
      }
    },
    created(){
     //
    },
    mounted(){
     Vue.prototype.$Drawer = this.Drawer
     this.$Drawer(true)
    },
    methods:{
      Drawer(){
        return this.drawer = !this.drawer
      },
      LogOut(){
        this.showappbar = false
        this.$loggedout()
        localStorage.removeItem('userlogged')
        localStorage.removeItem('logged')
        localStorage.removeItem('departmentlogged')
        this.$router.push('/auth')
      },
      ChangeURL(x){
        if(x == 'auth'){
          return this.LogOut()
        }else{
          return this.$ChangeURL(x)
        }
      }, 
    }
  }
</script>
<style scoped>
</style>