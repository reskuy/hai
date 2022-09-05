<template >
<v-container fluid fill-height :style="{backgroundColor:'#c8d2d8'}">
    <v-card class="mx-auto" elevation="3" width="600px">
          <v-toolbar color="#a10115" dark class="mb-2 text-overline"><v-icon class="mr-2" style="color:white">mdi-account-edit</v-icon> <span class="judul text-h5"> <b>FORMULIR USER</b></span></v-toolbar>
          <!-- <span class="text-h5">User Data</span> -->
        <v-card-text>
            <v-row dense>
              <v-col
                cols="12"
                sm="12"
                md="12"
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
                sm="12"
                md="12"
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
              <v-col
                cols="12"
                sm="12"
                md="12"
              >
                <v-select
                  label="Level"
                  prepend-icon="mdi-account"
                  color="red darken-4"
                  :items="levelList"
                  item-text="Nama"
                  item-value="Level"
                  v-model="Level"
                  required
                ></v-select>
              </v-col>
              <v-col
                cols="12"
                sm="12"
                md="12"
              >
                <v-select
                  label="Department"
                  prepend-icon="mdi-office-building-outline"
                  color="red darken-4"
                  :items="DepartmentList"
                  item-text="nama_department"
                  item-value="id_department"
                  v-model="Department"
                  required
                ></v-select>
              </v-col>
              <v-col
                cols="12"
                sm="12"
                md="12"
              >
                <v-text-field
                  label="Nama Lengkap*"
                  prepend-icon="mdi-account"
                  color="red darken-4"
                  v-model="NamaLengkap"
                  required
                ></v-text-field>
              </v-col>
            </v-row>
        </v-card-text>
        <v-card-actions>
          <v-btn
            color="black"
            dark
            elevation="6"
            @click="BackToUser"
          >
            <v-icon>mdi-arrow-left-circle</v-icon>
          </v-btn>
          <v-spacer></v-spacer>
          <v-btn
            color="#a10115"
            dark
            elevation="6"
            @click="Reset"
          >
           <v-icon>mdi-close-circle</v-icon>
          </v-btn>
          <v-btn
            color="grey darken-2"
            dark
            elevation="6"
            @click="save()"
          >
             <v-icon>mdi-checkbox-marked-circle</v-icon>
          </v-btn>
        </v-card-actions>
      </v-card>
</v-container>
</template>
<script>
import API from "@/services/http";
export default {
    data: () => ({
      showpass:false,
      isEdit:false,
      levelList:[{
        'Level':1,
        'Nama':'Akses Level Karyawan',
      },
      {
        'Level':2,
        'Nama':'Akses Level Security',
      },
      {
        'Level':3,
        'Nama':'Akses Level IT',
      },
      {
        'Level':4,
        'Nama':'Akses Level HR / GA',
      },
      {
        'Level':5,
        'Nama':'Akses Level Manager',
      }],
      DepartmentList:[],
      IdUser:null,
      Level:null,
      Username:null,
      NamaLengkap:null,
      Password:null,
      Department:null,
    }),
    created(){
    this.getDepartment()
    let data = this.$CekStore() == null ? [] : this.$CekStore()
    if(this.$CekStore() != null ){ this.isEdit = true }
    this.IdUser = data.id_user
    this.Username = data.username
    this.Password = data.password
    this.Level = data.level
    this.Department = data.id_department
    this.NamaLengkap = data.nama_lengkap
    },
    methods:{
      Reset(){
        this.$Store(null)
        this.Username = null
        this.Password = null
        this.Level = null
        this.Department = null
        this.NamaLengkap = null
      },
      BackToUser(){
        this.$Store(null)
        this.$router.push('User')
      },
      getDepartment(){
        API.get('department').then(x=>{
          this.DepartmentList = x.data
        })
      },
      save(){
        this.$loading(true)
        let data = {
          Username:this.Username,
          Password:this.Password,
          Level:this.Level,
          Department:this.Department,
          NamaLengkap:this.NamaLengkap,
          User:this.$UserLogged()
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