<template>
    <v-app-bar
      dark
      elevation="6"
      color="white"
      v-show="showappbar == true && this.device == 'Desktop'"
    >
      <!-- <v-app-bar-nav-icon></v-app-bar-nav-icon> -->
      <v-btn @click="ChangeURL('')" icon><v-icon color="red darken-4">mdi-home</v-icon></v-btn>
      <v-toolbar-title><span class="toolbar-text text-h6">HONDA AMARTHA INVENTORY</span></v-toolbar-title>

      <v-spacer></v-spacer>
      <span class="toolbar-text" v-show="userlogged" v-text="'Hi '+userlogged"></span>
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

      <v-list>
        <v-list-item
          v-for="acc in accitem"
          :key="acc.text"
          :to="acc.to"
          link
          color="red darken-4"
        >
          <v-list-item-title color="red darken-4" @click="ChangeURL(acc.to)" v-text="acc.text"/>
        </v-list-item>
      </v-list>
    </v-menu>
    </v-app-bar>
</template>
<script>
import Vue from 'vue'
  export default {
    data: () => ({
    dialog:true,
    device:null,
    department:localStorage.getItem('departmentlogged'),
    UserPengguna:null,
    showappbar:false,
    userlogged:localStorage.getItem('userlogged'),
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
        let userlogged = localStorage.getItem('userlogged')
        let department=localStorage.getItem('departmentlogged')
        if(userlogged){
            this.dialog = false
            this.department=department
            this.showappbar = true
        }
        Vue.prototype.$setLogged = this.setLogged
    },
    methods:{
      setLogged(){
        this.userlogged = localStorage.getItem('userlogged')
        this.department = localStorage.getItem('departmentlogged')
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
        if(this.$route.path == '/'+x){
            return
        }
        if(x == 'auth'){
          return this.LogOut()
        }else{
          return this.$router.push('/'+x)
        }
      }, 
    }
  }
</script>