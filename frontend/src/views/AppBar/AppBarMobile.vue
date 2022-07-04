<template>
    <v-app-bar
      dark
      color="blue darken-4"
    >
      <!-- <v-app-bar-nav-icon></v-app-bar-nav-icon> -->
      <v-btn @click="ChangeURL('')" icon><v-icon>mdi-home</v-icon></v-btn>

      <v-toolbar-title>HAI</v-toolbar-title>

      <v-spacer></v-spacer>
      <span v-show="userlogged" v-text="'Hi '+userlogged"></span>
      <v-menu
      :rounded="true"
      offset-y
    >
      <template v-slot:activator="{ attrs, on }">
        <v-btn 
        v-bind="attrs"
        v-on="on"
        icon>
            <v-icon>mdi-account</v-icon>
        </v-btn>
      </template>

      <v-list>
        <v-list-item
          v-for="acc in accitem"
          :key="acc.text"
          :to="acc.to"
          link
        >
          <v-list-item-title v-text="acc.text"></v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>
    </v-app-bar>
</template>
<script>
  export default {
    data: () => ({
    dialog:true,
    department:localStorage.getItem('departmentlogged'),
    UserPengguna:null,
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
        let userlogged = localStorage.getItem('userlogged')
        let department=localStorage.getItem('departmentlogged')
        if(userlogged){
            this.dialog = false
            this.department=department
        }
    },
    methods:{
      LogOut(){
        localStorage.removeItem('userlogged')
        localStorage.removeItem('logged')
        localStorage.removeItem('departmentlogged')
        localStorage.removeItem('Appbar')
        this.$router.go('/auth')
      },
      ChangeURL(x){
        if(this.$route.path == '/'+x){
            return
        }
        this.$router.push('/'+x)
      }, 
    }
  }
</script>