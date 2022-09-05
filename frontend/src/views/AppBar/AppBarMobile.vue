<template>
    <v-app-bar
      dark
      :app="isMobile"
      :fixed="isMobile"
      elevation="6"
      color="white"
      class="mb-2"
      v-show="showappbar == true && device == 'Mobile'"
    >
      <!-- <v-app-bar-nav-icon></v-app-bar-nav-icon> -->
      <!-- <v-btn @click="ChangeURL('')" icon><v-icon color="red darken-4">mdi-home</v-icon></v-btn> -->
      <v-btn @click="ChangeURL('')" icon><v-img src="@/assets/logo-honda-1.png" max-width="37" class="ml-2"></v-img></v-btn>

      <v-toolbar-title class="mx-n4"><span class="toolbar-text text-h6">HAI</span></v-toolbar-title>

      <v-spacer></v-spacer>
       <span class="toolbar-text" v-show="userlogged" v-text="userlogged != null ? 'Hi '+userlogged.nama_lengkap : null"></span>
      <v-menu
      :rounded="true"
      offset-y
    >
      <template v-slot:activator="{ attrs, on }">
        <v-btn 
        v-bind="attrs"
        v-on="on"
        icon>
            <v-icon color="red darken-4">mdi-account</v-icon>
        </v-btn>
      </template>

      <!-- <v-list>
        <v-list-item
          v-for="acc in accitem"
          :key="acc.text"
          :to="acc.to"
          link
        >
          <v-list-item-title @click="ChangeURL(acc.to)" v-text="acc.text"></v-list-item-title>
        </v-list-item>
      </v-list> -->
    </v-menu>
    </v-app-bar>
</template>
<script>
import Vue from 'vue'
  export default {
    data: () => ({
    dialog:true,
    device:null,
    isMobile:false,
    department:null,
    UserPengguna:null,
    showappbar:false,
    userlogged:localStorage.getItem('logged'),
    accitem: [
        {
            to:'auth',
            text:'Logout'
        },
        {
            to:'setting',
            text:'Pengaturan'
        }
      ],
    }),
    mounted(){
        this.device = this.$device
        if(this.device == 'Mobile'){
          this.isMobile = true
        }
        this.setLogged()
        Vue.prototype.$setLoggedMobile = this.setLogged
    },
    methods:{
      setLogged(){
        this.userlogged = JSON.parse(localStorage.getItem('logged'))
        if(this.userlogged != null){
          this.department = this.userlogged.department
          this.showappbar = true
        }
      },
      LogOut(){
        this.showappbar = false
        localStorage.removeItem('logged')
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