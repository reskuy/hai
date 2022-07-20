<template>
<v-sheet
    class="mx-auto"
    style="height:100vh"
    :style="{backgroundColor:'#c8d2d8'}"
  >
  <SideBar class="mt-16 color-side"/>
    <v-dialog
      v-model="dialog"
      persistent
      width="500px"
      transition="dialog-top-transition"
    >
    <v-app-bar
      dark
      color="#a10115"
    >
      <v-toolbar-title color="#f0efea"><v-icon class="mr-2">mdi-account</v-icon>Pengguna</v-toolbar-title>
    </v-app-bar>
    <v-card color="#f0efea">
        <v-card-text>
          <v-container>
            <v-row>
              <v-col
                cols="12"
                sm="12"
                md="12"
              >
                <v-text-field
                  label="Isi Nama Anda*"
                  required
                  color="#d72c16"
                  v-model="UserPengguna"
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
                sm="12"
                md="12"
              >
                <v-select
                  label="Pilih Department Anda*"
                  required
                  color="#d72c16"
                  item-value="id_department"
                  item-text="nama_department"
                  :items="Departmentdata"
                  v-model="Department"
                ></v-select>
              </v-col>
              <v-col cols="12"
                sm="12"
                md="12">
                <v-btn
                block
                dark
                color="#a10115"
                class="btn btn-primary rounded-lg text-capitalize mt-n6"
                @click="SavePengguna()"
                >
                <span style="color:#f0efea;">
                Masuk
                </span>
                </v-btn>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
      </v-card>
    </v-dialog>

<v-container>
  <v-alert 
  class="pa-2 mb-2 overline" dense
            color="black"
            border="bottom"
            colored-border
            elevation="5">
            <v-row dense>
              <v-col class="text-start" cols="6"><v-icon color="#a10115" style="cursor: pointer;" @click="ShowBell(true)">mdi-bell-badge</v-icon></v-col>
              <v-col class="text-end" cols="6"><v-icon color="#a10115" class="mr-1">mdi-calendar-month </v-icon><span class="mr-4">{{time}}</span><v-icon color="#a10115">mdi-clock-outline </v-icon><span>{{' '+realtime}}</span></v-col>
            </v-row>
              </v-alert>
  <v-row dense>
    <v-col cols="12" sm="6" md="6">
      <v-alert
        dense
        color="black"
        border="bottom"
        icon="mdi-file-plus-outline"
        colored-border
        elevation="5">

        <v-card-subtitle class="text-overline">Ajukan Tes Drive Secara Online</v-card-subtitle>

        <v-card-actions>
            <v-btn class="border" dark small color="#a10115" @click="ChangeURL('FormTesDrive')">
            Buat Sekarang
            </v-btn>
        </v-card-actions>
        <!-- </v-card> -->
        </v-alert>
    </v-col>

    <v-col cols="12" sm="6" md="6">
      <v-alert
        dense
        color="black"
        border="bottom"
        icon="mdi-file-plus"
        colored-border>
        <v-card-subtitle class="text-overline">Ajukan Peminjaman Secara Online</v-card-subtitle>

        <v-card-actions>
            <v-btn class="border" dark small color="#a10115" @click="ChangeURL('FormPeminjaman')">
            Buat Sekarang
            </v-btn>
        </v-card-actions>
        <!-- </v-card> -->
        </v-alert>
    </v-col>

    <v-col v-for="(item, i) in items"
          :key="i"
          cols="3">
        
        <v-alert
        color="black"
        border="bottom"
        large
        v-show="item.locked == 'N'"
        :icon="item.icon"
        colored-border
        elevation="6">
            <v-list-item one-line>
            <v-list-item-content class="mt-n6 mx-n4">
            <v-list-item-title class="text-button"><span style="color:#a10115;" v-text="item.count+' '"/><span v-text="item.title" /></v-list-item-title>
            <v-list-item-subtitle style="font-size:12px;" v-show="item.title =='Pengembalian'" v-text="item.data"></v-list-item-subtitle>
            </v-list-item-content>
            </v-list-item>

            <v-card-actions>
              <v-spacer/>
            <v-btn
                outlined
                small
                rounded
                color="#a10115"
                @click="ChangeURL(item.to)"
            >
                Lihat Data
            </v-btn>
            </v-card-actions>
        </v-alert>


        <!-- ini kalo user ga ada akses -->
        <v-tooltip top>
        <template v-slot:activator="{ on, attrs }">
        <v-alert
        large
        v-on="on"
        v-bind="attrs"
        v-show="item.locked == 'Y'"
        :icon="item.icon">
            <v-list-item one-line>
            <v-list-item-content class="mt-n6 mx-n4">
            <v-list-item-title class="text-button"><span style="color:#a10115;" v-text="item.count+' '"/><span v-text="item.title" /></v-list-item-title>
            <v-list-item-subtitle style="font-size:12px;" v-show="item.title =='Pengembalian'" v-text="item.data"></v-list-item-subtitle>
            </v-list-item-content>
            </v-list-item>

            <v-card-actions>
              <v-spacer/>
            <v-btn
            disabled
                outlined
                small
                rounded
                color="#a10115"
                @click="ChangeURL(item.to)"
            >
                Lihat Data
            </v-btn>
            </v-card-actions>
        </v-alert>
        </template>
        <span>Dibatasi</span>
      </v-tooltip>
    </v-col>
  </v-row>
</v-container>
<v-footer elevation="4" app bottom fixed padless>
    <span>Versi : 1.0</span>
    <v-spacer/>
    <span>By Rifka Karin Afinda</span>
  </v-footer>
</v-sheet>
</template>
<script>
const SideBar = () => import (/* webpackChunkName: "SideBar"*/ '@/components/SideBar.vue')
import API from "@/services/http";
  export default {
    components:{
      SideBar
    },
    data: () => ({
    logged:[],
    formhide:false,
    dialog:true,
    realtime:null,
    time:null,
    UserPengguna:null,
    Department:null,
    Departmentdata:[],
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
      items: [],
    }),
    created(){
      this.$loading(true)
      this.logged = JSON.parse(localStorage.getItem('logged'))
      this.items = this.$ItemDashboard
      this.getTime()
      this.startTime()
      this.getDataAset()
      this.getDataTesDrive()
      this.getDataPeminjaman()
      this.getDataPengembalianTesDrive()
      this.getDataPengembalianPeminjaman()
      this.getDepartment()
      this.getDataUser()
    },
    mounted(){
        let userlogged = localStorage.getItem('userlogged')
        let department=localStorage.getItem('departmentlogged')
        if(userlogged){
            this.dialog = false
            this.$showDialogBell(true)
            this.department=department
        }
    },
    methods:{
      getTime(){
        let hari = new Date().toISOString().substring(0,10)
        this.time = this.$DateConvert(hari)
      },
      getDataUser(){
        API.get("totaluser").then(x=>{
          let u = this.logged
          let index = this.items.findIndex(x=>x.title == 'User')
          this.items[index].locked = (u.username == 'IT' ? 'N' : 'Y')
          this.items[index].count = x.data
        })
      },
      getDataAset(){
        API.get("totalaset").then(x=>{
          let index = this.items.findIndex(x=>x.title == 'Aset')
          this.items[index].count = x.data
        })
      },
      getDataTesDrive(){
        API.get("totaltesdrive").then(x=>{
          let index = this.items.findIndex(x=>x.title == 'Tes Drive')
          this.items[index].count = x.data.totalform
        })
      },
      getDataPeminjaman(){
        API.get("totalpeminjaman").then(x=>{
          let index = this.items.findIndex(x=>x.title == 'Peminjaman')
          this.items[index].count = x.data.totalform
        })
      },
      getDataPengembalianTesDrive(){
        API.get("totalpengembaliantesdrive").then(x=>{
          let u = this.logged
          let index = this.items.findIndex(x=>x.data == 'Tes Drive')
          this.items[index].locked = (u.username == 'Karyawan' ? 'Y' : u.username == 'Sales' ? 'Y' : 'N')
          this.items[index].count = x.data.totalform
        })
      },
      getDataPengembalianPeminjaman(){
        API.get("totalpengembalianpeminjaman").then(x=>{
          let u = this.logged
          let index = this.items.findIndex(x=>x.data == 'Peminjaman')
          this.items[index].locked = (u.username == 'Karyawan' ? 'Y' : u.username == 'Sales' ? 'Y' : 'N')
          this.items[index].count = x.data.totalform
          this.$loading(false)
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
        this.$ChangeURL(x)
      },
      SavePengguna(){
          if(this.UserPengguna != null && this.Department != null){
            let Department = this.Departmentdata.find(x=>x.id_department == this.Department)
            localStorage.setItem('userlogged',this.UserPengguna)
            localStorage.setItem('departmentlogged',JSON.stringify(Department))
            this.userlogged = this.UserPengguna
            this.$logged()
            this.dialog = false
          }
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
        },
        ShowBell(x){
          this.$showDialogBell(x)
        }
    }
  }
</script>
<style>
.color-side{
  background-color: #FFFFFF !important;
}
.border:hover{
  background-color: white !important;
  color:black;
  border:1px #a10115 solid;
}
</style>