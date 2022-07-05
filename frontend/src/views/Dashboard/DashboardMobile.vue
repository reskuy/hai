<template>
  <v-card
  :style="{backgroundColor:'#D3D3D3'}"
  style="height:100vh"
    class="mx-auto"
  >
    
    <v-dialog
      v-model="dialog"
      persistent
      transition="dialog-top-transition"
    >
    <v-app-bar
      dark
      color="blue darken-4"
    >
      <v-toolbar-title>Pengguna</v-toolbar-title>
    </v-app-bar>
    <v-card>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col
                cols="12"
                sm="6"
                md="4"
              >
                <v-text-field
                  label="Isi Nama Anda*"
                  required
                  v-model="UserPengguna"
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
                sm="6"
                md="4"
              >
                <v-select
                  label="Pilih Department Anda*"
                  required
                  item-value="id_department"
                  item-text="nama_department"
                  :items="Departmentdata"
                  v-model="Department"
                ></v-select>
              </v-col>
              <v-col cols="12"
                sm="6"
                md="4">
                <v-btn
                block
                dark
                color="blue darken-4"
                class="btn btn-primary rounded-lg text-capitalize mt-n6"
                @click="SavePengguna()"
                >
                Masuk
                </v-btn>
              </v-col>
            </v-row>
          </v-container>
              </v-card-text>
    </v-card>
    </v-dialog>
    <v-container>
      <v-row dense>
        <v-col cols="12">
          <v-card
            color="gray"
            elevation="5"
            outlined
          >
            <v-card-title class="text-h5">
              Buat Form
            </v-card-title>

            <v-card-subtitle>Ajukan Peminjaman Dan Tes Drive Secara Online.</v-card-subtitle>

            <v-card-actions>
              <v-btn text @click="ChangeURL('formtesdrive')">
                Buat Sekarang
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>

        <v-col
          v-for="(item, i) in items"
          :key="i"
          cols="12"
        >
          <v-card
            :color="item.color"
            dark
            @click="ChangeURL(item.to)"
            elevation="6"
          >
            <div class="d-flex flex-no-wrap justify-space-between">
              <div>
                <v-card-title
                  class="text-h5"
                  v-text="item.title"
                ></v-card-title>

                <v-card-subtitle v-text="item.data"></v-card-subtitle>
              </div>

              <v-avatar
                class="ma-3"

                tile
              >
              <v-icon>{{item.icon}}</v-icon>
                <span>{{item.count}}</span>
                <!-- <v-img :src="item.icon"></v-img> -->
              </v-avatar>
            </div>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-card>
</template>
<script>
import API from "@/services/http";
  export default {
    data: () => ({
    dialog:true,
    UserPengguna:null,
    Department:null,
    Departmentdata:[],
    userlogged:localStorage.getItem('userlogged'),
      accitem: [
        {
            to:'/auth',
            text:'Logout'
        },
        {
            to:'/setting',
            text:'Pengaturan'
        }
      ],
      items: [
        {
          color: 'red darken-4',
          icon: 'mdi-briefcase',
          title: 'Asset',
          data: 'Asset',
          count:null,
          to:'Asset'
        },
        {
          color: 'red darken-4',
          icon: 'mdi-account',
          title: 'Peminjaman',
          data: 'Peminjaman',
          count:null,
          to:'Peminjaman'
        },
        {
          color: 'red darken-4',
          icon: 'mdi-note',
          title: 'Tes Drive',
          data: 'Tes Drive',
          count:null,
          to:'TesDrive'
        },
      ],
    }),
    created(){
      this.getDepartment()
      this.getDataTesDrive()
    },
    mounted(){
        let userlogged = localStorage.getItem('userlogged')
        let department=localStorage.getItem('departmentlogged')
        if(userlogged){
            this.dialog = false
            this.Department=department
        }
    },
    methods:{
      getDepartment(){
        API.get("/department").then(x=>{
          this.Departmentdata=x.data
        })
      },
      getDataTesDrive(){
        API.get("/totaltesdrive").then(x=>{
          let index = this.items.findIndex(x=>x.title == 'Tes Drive')
          this.items[index].count = x.data.totalform
        })
      },
      LogOut(){
        localStorage.removeItem('userlogged')
        localStorage.removeItem('logged')
        localStorage.removeItem('departmentlogged')
        this.$router.go('/auth')
      },
      ChangeURL(x){
        if(this.$route.path == '/'+x){
            return
        }else{
          return this.$router.push('/'+x)
        }
      },  
        SavePengguna(){
          let Department = this.Departmentdata.find(x=>x.id_department == this.Department)
            localStorage.setItem('userlogged',this.UserPengguna)
            localStorage.setItem('departmentlogged',JSON.stringify(Department))
            this.userlogged = this.UserPengguna
            this.$logged()
            this.dialog = false
        }
    }
  }
</script>