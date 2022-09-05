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
        <span class="ml-4">Home</span>

        <v-icon class="ml-4">mdi-home</v-icon>
      </v-btn>
      <v-btn value="history" @click="ChangeURL('History')">
        <span>History</span>
        <v-icon>mdi-history</v-icon>
      </v-btn>

      <v-btn value="camera" @click="ChangeURL('CameraQR')">
        <span>QR</span>
        <v-icon id="qrcode" class="mt-n3" x-large>mdi-qrcode-scan</v-icon>
      </v-btn>
      

      <v-btn value="pengaturan" @click="ChangeURL('Log')">
        <span>LOG</span>
        <v-icon>mdi-account-clock</v-icon>
      </v-btn>
      <v-btn value="logout" @click="ChangeURL('auth')">
        <span class="mr-4">Log Out</span>
        <v-icon class="mr-4">mdi-logout</v-icon>
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
        this.$setLogOut()
        // localStorage.removeItem('logged')
        // this.$router.push('/auth')
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