<template>
    <v-bottom-navigation
  fixed
  app
  elevation="6"
      v-model="value"
      :input-value="active"
      shift
      color="red darken-4"
    >
    <v-btn value="/" @click="ChangeURL('')">
        <span>Home</span>

        <v-icon>mdi-home</v-icon>
      </v-btn>
      <v-btn value="history" @click="ChangeURL('History')">
        <span>History</span>
        <v-icon>mdi-history</v-icon>
      </v-btn>
      <v-btn value="pengaturan" @click="ChangeURL('History')">
        <span>Pengaturan</span>
        <v-icon>mdi-cog</v-icon>
      </v-btn>
      <v-btn value="logout" @click="ChangeURL('auth')">
        <span>Log Out</span>
        <v-icon>mdi-logout</v-icon>
      </v-btn>
    </v-bottom-navigation>
</template>
<script>
export default {
    data(){
        return{
            active:true,
            value:'/',
        }
    },
    mounted(){
        //
    },
    methods:{
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