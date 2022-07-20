<template>
<div
    class="mx-auto"
    style="height:100vh"
    :style="{backgroundColor:'#c8d2d8'}"
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
                  color="#a10115"
                  @keyup.enter="SavePengguna()"
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
                  color="#a10115"
                  item-value="id_department"
                  item-text="nama_department"
                  @keyup.enter="SavePengguna()"
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
    <!-- #b4b19a -->
    </v-dialog>
     <v-sheet
      height="175"
      class="mb-n15"
      color="white">
        <v-container>
          <v-row class="mt-n4 mb-n9">
            <v-col col="6"><v-btn color="#a10115" icon rounded><v-icon color="#a10115" style="cursor: pointer;" @click="ShowBell(true)">mdi-bell-badge</v-icon></v-btn></v-col>
            <v-col style="color:black" col="6" class="text-end text-overline">{{time}}</v-col>
          </v-row>
          <v-row>
            <v-col cols="15" class="text-center mt-2" color="#a10115"><h4>HONDA AMARTHA INVENTORY</h4>
            <h5>HR & GA Department</h5>
            <h6>PT. Prospect Motor</h6></v-col>
          </v-row>


          <!-- <v-img class="mx-auto" max-width="120" src="@/assets/logo-honda.png" style="cursor: pointer;"></v-img> -->
        </v-container>
      </v-sheet>
      <!-- <v-alert class="text-end overline" dense
            color="black"
            border="bottom"
            colored-border
            elevation="5">{{time+' '+realtime}}</v-alert> -->
            <!-- sementara hilang time di mobile -->
    <v-container>
      <v-row dense class="mt-1">
        <v-col cols="6">
          <v-alert
          @click="ChangeURL('FormTesDrive')"
            dense
            color="black"
            border="bottom"
            colored-border
            elevation="5">
            <v-card-title>
              <span id="teks-merah" class="mx-n4">
                <v-icon color="red darken-4">mdi-file-document-plus-outline</v-icon>
                Tes Drive
              </span>
            </v-card-title>
             <!-- <span id="teks-merah" class="text-overline text-center">Buat Form</span> -->
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
            <v-card-title>
              <span id="teks-merah" class="mx-n4">
                <v-icon color="red darken-4">mdi-file-document-plus</v-icon>
                Peminjaman
              </span>
            </v-card-title>
             <!-- <span id="teks-merah" class="text-overline text-center">Buat Form</span> -->
          </v-alert>
        </v-col>
        <!-- <v-col cols="12">
        <v-alert
            dense
            color="black"
            border="bottom"
            colored-border
            elevation="5">
            <v-row dense>
              <v-col class="text-start" cols="6"><v-icon color="#a10115" style="cursor: pointer;" @click="ShowBell(true)">mdi-bell-badge</v-icon></v-col>
            </v-row>
              </v-alert>
              </v-col> -->

<!-- icon icon dashboard -->
        <v-col
          v-for="(item, i) in items"
          :key="i"
          cols="3"
        >
        <div class="text-center">
          <v-avatar
            rounded-xl
            size="60"
            :color="item.colorback"
            @click="ChangeURL(item.to)"
          >
            <v-icon :color="item.color"> 
              {{item.icon}}
            </v-icon>
          </v-avatar>
          <p class="font mt-1">{{item.title}}</p>
          <p v-show="item.title == 'Pengembalian'" class="font mt-n5">{{item.data}}</p>
        </div>
        </v-col>
      </v-row>
    </v-container>
</div>
</template>
<script>
import API from "@/services/http";
  export default {
    data: () => ({
    dialog:true,
    logged:[],
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
      items: [],
    }),
    created(){
      this.$loading(true)
      this.logged = JSON.parse(localStorage.getItem('logged'))
      this.items = this.$ItemDashboard
      this.getTime()
      this.startTime()
      this.getDataAset()
      this.getDataPeminjaman()
      this.getDataTesDrive()
      this.getDataPengembalianTesDrive()
      this.getDataPengembalianPeminjaman()
      this.getDataUser()
      this.getDepartment()
    },
    mounted(){
        let userlogged = localStorage.getItem('userlogged')
        let department=localStorage.getItem('departmentlogged')
        if(userlogged){
            this.dialog = false
            this.$showDialogBell(true)
            this.Department = department
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
          this.$loading(false)
          this.items[index].count = x.data.totalform
        })
      },
      getDepartment(){
        API.get("/department").then(x=>{
          this.Departmentdata=x.data
        })
      },
      ShowBell(x){
          this.$showDialogBell(x)
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
        }
    }
  }
</script>
<style scoped>
#teks-merah{
  font-size: 14px;
  color:  #a10115;
}
.font{
 font-family: 'Calibri';
 font-size: 11px;
 font-weight: bold;
}
</style>