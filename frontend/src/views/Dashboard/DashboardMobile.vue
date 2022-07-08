<template>
<v-sheet
    class="mx-auto"
    style="height:100vh"
    :style="{backgroundColor:'#D3D3D3'}"
  > 
    <v-dialog
      v-model="dialog"
      persistent
      transition="dialog-top-transition"
    >
    <v-app-bar
      dark
      color="red darken-4"
    >
      <v-toolbar-title><v-icon class="mr-2">mdi-account</v-icon>Pengguna</v-toolbar-title>
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
                color="red darken-4"
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
      <v-alert class="pa-2 mb-2 text-end overline" dense
            color="black"
            border="bottom"
            colored-border
            elevation="5">{{time+' '+realtime}}</v-alert>
      <v-row dense>
        <v-col cols="6">
          <v-alert
          @click="ChangeURL('FormTesDrive')"
            dense
            color="black"
            border="bottom"
            colored-border
            elevation="5">
            <v-card-title class="mb-n3">
              <span id="teks-merah" class="text-h6 mx-n4">
              <v-icon color="red darken-4">mdi-plus</v-icon>
              Buat Form
              </span>
             
            </v-card-title>
             <span id="teks-merah" class="text-overline mx-7">Tes Drive</span>
            <!-- <v-card-title>
              <span class="text-h6 mx-n4">
              <v-icon color="black">mdi-plus</v-icon>
              Buat Form
              </span>
              <span class="caption mx-4">Tes Drive</span>
            </v-card-title> -->

          </v-alert>
        </v-col>

        <v-col cols="6">
          <v-alert
            dense
            color="black"
            border="bottom"
            colored-border
            @click="ChangeURL('FormPeminjaman')"
            elevation="5">
            <v-card-title class="mb-n3">
              <span id="teks-merah" class="text-h6 mx-n4">
              <v-icon color="red darken-4">mdi-plus</v-icon>
              Buat Form
              </span>
             
            </v-card-title>
             <span id="teks-merah" class="text-overline mx-5">Peminjaman</span>
          </v-alert>
        </v-col>

        <v-col
          v-for="(item, i) in items"
          :key="i"
          cols="6"
        >
        <v-alert
        dense
        color="red darken-4"
        border="bottom"
        @click="ChangeURL(item.to)"
        colored-border
        height="130px"
        elevation="6">
          <!-- <v-card
            :color="item.color"
            dark
            @click="ChangeURL(item.to)"
            elevation="6"
          > -->
            <div class="d-flex flex-no-wrap justify-center">
              <v-avatar
              tile
              class="mt-5"
              >
              <v-icon :color="item.color" large>{{item.icon}}</v-icon>
                <!-- <span>{{item.count}}</span> -->
              </v-avatar>
              <div>
                <!-- <v-card-title
                  class="text-h6"
                  v-text="item.title"
                ></v-card-title> -->
                
                <v-card-title class="test-h5 mt-4"><span>{{item.count}}</span></v-card-title>
              </div>
              
            </div>
            <v-card-title class="overline justify-center mt-n4"><span>{{item.data}}</span></v-card-title>
        </v-alert>
        </v-col>
      </v-row>
    </v-container>
</v-sheet>
</template>
<script>
import API from "@/services/http";
  export default {
    data: () => ({
    dialog:true,
    value:true,
    realtime:null,
    time:null,
    active:true,
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
          color: 'black',
          icon: 'mdi-briefcase',
          title: 'Aset',
          data: 'Aset',
          count:'-',
          to:'Aset'
        },
        {
          color: 'black',
          icon: 'mdi-account',
          title: 'Peminjaman',
          data: 'Peminjaman',
          count:'-',
          to:'Peminjaman'
        },
        {
          color: 'black',
          icon: 'mdi-car',
          title: 'Tes Drive',
          data: 'Tes Drive',
          count:'-',
          to:'TesDrive'
        },
      ],
    }),
    created(){
      this.getTime()
      this.startTime()
      this.$loading(true)
      this.getDataAset()
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
      getTime(){
        let hari = new Date().toISOString().substring(0,10)
        this.time = hari
      },
      getDataAset(){
        API.get("/totalaset").then(x=>{
          let index = this.items.findIndex(x=>x.title == 'Aset')
          this.items[index].count = x.data
          this.$loading(false)
        })
      },
      getDataTesDrive(){
        API.get("/totaltesdrive").then(x=>{
          let index = this.items.findIndex(x=>x.title == 'Tes Drive')
          this.items[index].count = x.data.totalform
        })
      },
      getDepartment(){
        API.get("/department").then(x=>{
          this.Departmentdata=x.data
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
        },
        startTime() {
          const today = new Date();
          let h = today.getHours();
          let m = today.getMinutes();
          let s = today.getSeconds();
          m = this.checkTime(m);
          s = this.checkTime(s);
          this.realtime =  h + ":" + m + ":" + s;
          setTimeout(this.startTime, 1000);
        },

        checkTime(i){
          if (i < 10){
            i = "0" + i
            }
          return i
        }
    }
  }
</script>
<style scoped>
#teks-merah{
  color:  #b71c1c;
}
</style>