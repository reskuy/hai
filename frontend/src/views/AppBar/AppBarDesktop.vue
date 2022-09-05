<template>
    <v-app-bar
      dark
      elevation="6"
      color="white"
      v-show="showappbar == true && this.device == 'Desktop'"
    >
      <!-- <v-app-bar-nav-icon></v-app-bar-nav-icon> -->
      <v-tooltip bottom>
        <template v-slot:activator="{ on, attrs }">
          <v-btn v-bind="attrs" v-on="on" @click="ChangeURL('')" icon><v-img src="@/assets/logo-honda-1.png" max-width="43" class="ml-7 mr-6"></v-img></v-btn>
        </template>
        <span>Home</span>
      </v-tooltip>
      <!-- <v-btn @click="ChangeURL('')" icon><v-img src="@/assets/logo-honda-1.png" max-width="50" class="ml-7"></v-img></v-btn> -->
      <v-toolbar-title class="ml-1"><span class="toolbar-text text-h6">HONDA AMARTHA INVENTORY</span></v-toolbar-title>

      <v-spacer></v-spacer>
      <v-btn text>
      <span class="toolbar-text" v-show="userlogged" v-text="userlogged != null ? 'Hi '+userlogged.nama_lengkap : null"></span>
      </v-btn>
      <v-btn icon @click="drawer()">
        <v-icon color="red darken-4">mdi-account</v-icon>
      </v-btn>
    </v-app-bar>
</template>
<script>
import Vue from 'vue'
  export default {
    data: () => ({
    dialog:true,
    device:null,
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
        this.setLogged()
        Vue.prototype.$setLogged = this.setLogged
        Vue.prototype.$setLogOut = this.LogOut
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
      drawer(){
        this.$Drawer()
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