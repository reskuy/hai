<template>
  <v-container fluid fill-height>
            <v-layout align-center justify-center>
               <v-flex xs12 sm8 md4>
                  <v-card class="elevation-12">
                    <v-progress-linear
                        :active="loading"
                        :indeterminate="loading"
                        absolute
                        top
                        striped
                        color="deep-purple accent-4"
                    />
                     <v-card-text>
                           <v-text-field
                              prepend-icon="mdi-account"
                              name="login"
                              label="Username"
                              v-model="Username"
                              type="text"
                              @keyup.enter="login()"
                           ></v-text-field>
                           <v-text-field
                              id="password"
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
                        color="blue darken-4"
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
            this.loading = true
           api.post('login',auth).then(x=>{
             if(x.data == 'error'){
                this.Toast('error','Username Atau Password Salah')
                this.loading = false
                return
             }
             localStorage.setItem('logged',JSON.stringify(x.data))
             this.Toast('success','Welcome')
             this.loading = false
             this.$router.push('/')
           })
         }else{
            this.Toast('error','Pastikan Username Dan Password Terisi')
         }
        },
        Toast(icon,title){
            this.$swal.fire({
            toast: true,
            icon: icon,
            title: title,
            animation: false,
            showCloseButton: true,
            position: 'top-right',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true})
        },
    }
}
</script>

<style>

</style>