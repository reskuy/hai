<template>
  <v-container fluid fill-height :style="{backgroundColor:'#f0efea'}">
            <v-layout align-center justify-center>
               <v-flex xs12 sm8 md4>
                  <v-card class="elevation-12" color="#f0efea">
                    <v-app-bar
                    dark
                    height="95"
                    color="#a10115"
                    >
                    <v-img class="mx-auto pa-3" max-width="60" src="../assets/logo-honda-1.png" style="cursor: pointer;"></v-img>
                    </v-app-bar>
                    <v-progress-linear
                        :active="loading"
                        :indeterminate="loading"
                        absolute
                        top
                        striped
                        color="red darken-4"
                    />
                     <v-card-text>
                        <center class="mb-4 mt-3"><b>Selamat Datang di HONDA AMARTHA INVENTORY</b></center>
                           <v-text-field
                              prepend-icon="mdi-account"
                              name="login"
                              label="Username"
                              color="#d72c16"
                              v-model="Username"
                              type="text"
                              @keyup.enter="login()"
                           ></v-text-field>
                           <v-text-field
                              id="password"
                              color="#d72c16"
                              :append-icon="showpass ? 'mdi-eye' : 'mdi-eye-off'"
                              :type="showpass ? 'text' : 'password'"
                              prepend-icon="mdi-lock"
                              name="password"
                              v-model="Password"
                              label="Password"
                              @click:append="showpass = !showpass"
                              @keyup.enter="login()"
                           ></v-text-field>
                     </v-card-text>
                     <v-col>
                        <v-btn
                        block
                        dark
                        color="#a10115"
                        class="btn btn-primary rounded-lg text-capitalize mt-n6"
                        @click="login()"
                        >
                        Masuk
                        </v-btn>
                    </v-col>
                  </v-card>
               </v-flex>
            </v-layout>
         </v-container>
</template>

<script>
import api from "@/services/http";
export default {
    
    data(){
        return{
            loading:false,
            Username:null,
            showpass:false,
            Password:null
        }
    },
    beforeCreate(){
      let user = JSON.parse(localStorage.getItem('logged'))
      if(user){
          this.$router.push('/')
      }
    },
    mounted(){
        // console.log('log')
    },
    methods:{
        login(){
         if(this.Username != null && this.Password != null){
            let auth = {
                username:this.Username,
                password:this.Password
            }
            this.$loading(true)
            this.loading = true
           api.post('login',auth).then(x=>{
             if(x.data == 'error'){
                this.$Toast('error','Username Atau Password Salah')
                this.loading = false
                this.$loading(false)
                return
             }
             localStorage.setItem('logged',JSON.stringify(x.data))
             this.$Toast('success','Welcome')
             this.loading = false
             this.$loading(false)
             this.$router.push('/')
           })
         }else{
            this.$Toast('error','Pastikan Username Dan Password Terisi')
         }
        },
    }
}
</script>

<style>

</style>