<template>
    <v-card>
        <v-card-title>
          <span class="text-h5">User Data</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col
                cols="12"
                sm="6"
                md="4"
              >
                <v-text-field
                  label="Username*"
                  prepend-icon="mdi-account"
                  color="red darken-4"
                  v-model="Username"
                  required
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
                sm="6"
                md="4"
              >
                <v-text-field
                color="red darken-4"
                :append-icon="showpass ? 'mdi-eye' : 'mdi-eye-off'"
                :type="showpass ? 'text' : 'password'"
                prepend-icon="mdi-lock"
                name="password"
                v-model="Password"
                label="Password"
                @click:append="showpass = !showpass"
                @keyup.enter="save()"
                ></v-text-field>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-btn
            color="red darken-4"
            dark
            elevation="6"
            @click="BackToUser"
          >
            Kembali
          </v-btn>
          <v-spacer></v-spacer>
          <v-btn
            color="red darken-4"
            dark
            elevation="6"
            @click="Reset"
          >
            Reset
          </v-btn>
          <v-btn
            color="red darken-4"
            dark
            elevation="6"
            @click="save()"
          >
            Save
          </v-btn>
        </v-card-actions>
      </v-card>
</template>
<script>
import API from "@/services/http";
export default {
    data: () => ({
      showpass:false,
      isEdit:false,
      IdUser:null,
      Username:null,
      Password:null
    }),
    created(){
    let data = this.$CekStore() == null ? [] : this.$CekStore()
    if(this.$CekStore() != null ){ this.isEdit = true }
    this.IdUser = data.id_user
    this.Username = data.username
    this.Password = data.password
    },
    methods:{
      Reset(){
        this.$Store(null)
        this.Username = null
        this.Password = null
      },
      BackToUser(){
        this.$Store(null)
        this.$router.push('User')
      },
      save(){
        this.$loading(true)
        let data = {
          Username:this.Username,
          Password:this.Password
        }
        if(this.isEdit == false){
          API.post('user',data).then(x=>{
          console.log(x)
          this.$Store(null)
          this.$Toast('success','User Ditambahkan')
          this.$router.push('User')
          })
        }else{
          API.put('user/'+this.IdUser,data).then(x=>{
            console.log(x)
            this.$Store(null)
            this.$Toast('success','User DiUbah')
            this.$router.push('User')
          })
        }
      }
    }
}
</script>