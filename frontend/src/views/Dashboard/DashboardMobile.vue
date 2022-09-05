<template>
<div
    class="mx-auto"
    :style="{backgroundColor:'#c8d2d8',height:height}"
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
      height="135"
      class="mb-n15"
      color="white">
        <v-container>
          
          <v-row>
            <v-col cols="15" class="text-center mt-2" color="#a10115"><h4>HONDA AMARTHA INVENTORY</h4>
            <h5>HR & GA Department</h5>
            <h6>PT. Prospect Motor</h6></v-col>
          </v-row>


          <!-- <v-img class="mx-auto" max-width="120" src="@/assets/logo-honda.png" style="cursor: pointer;"></v-img> -->
        </v-container>
      </v-sheet>

            <!-- sementara hilang time di mobile -->
    <v-container>
      <v-row dense class="mt-1">
        <v-col cols="6">
          <v-alert
          @click="ChangeURL({to:'FormTesDrive'})"
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
            @click="ChangeURL({to:'FormPeminjaman'})"
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

<!-- icon icon dashboard -->
        <v-col
          v-for="(item, i) in items"
          :key="i"
          cols="3"
        >
        <div class="text-center" v-show="item.locked == 'N'">
          <v-avatar
            rounded-xl
            size="60"
            :color="item.colorback"
            @click="ChangeURL(item)"
          >
          <v-badge
            dot
            v-show="item.badge == true"
            color="green"
          >
            <v-icon :color="item.color"> 
              {{item.icon}}
            </v-icon>
            </v-badge>
            <v-icon :color="item.color" v-show="item.badge == false"> 
              {{item.icon}}
            </v-icon>
          </v-avatar>

          <p class="font mt-1">{{item.title}}</p>
          <p v-show="item.title == 'Pengembalian'" class="font mt-n5">{{item.data}}</p>
        </div>

        <div class="text-center" v-show="item.locked == 'Y'">
          <v-avatar
            rounded-xl
            size="60"
            color="white"
          >
            <v-icon color="gray"> 
              {{item.icon}}
            </v-icon>
          </v-avatar>
          <p class="font mt-1">{{item.title}}</p>
          <p v-show="item.title == 'Pengembalian'" class="font mt-n5">{{item.data}}</p>
        </div>
        </v-col>

        <v-col cols="12" class="mb-0">
          <SyaratKetentuanMobile/>
        </v-col>
      </v-row>
      <Laporan />
      <FloatChat />
    </v-container>
</div>
</template>
<script>
import SyaratKetentuanMobile from '@/components/SyaratKetentuanMobile/index.vue'
import FloatChat from '@/components/FloatChat/index.vue'
import Laporan from '@/components/DialogLaporan/index.vue'
import API from "@/services/http";
  export default {
    components:{
      SyaratKetentuanMobile,FloatChat,Laporan
    },
    data: () => ({
    dialog:false,
    logged:[],
    height:'600px',
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
      let winheight = window.innerHeight+75
      this.height = winheight+'px'
      window.scrollTo(0,0)
      this.logged = JSON.parse(localStorage.getItem('logged'))
      this.items = this.$ItemDashboard
      this.getDataUser()
      this.getDataAset()
      this.getDataTesDrive()
      this.getDataPeminjaman()
      this.getDataPengembalianTesDrive()
      this.getDataPengembalianPeminjaman()
      this.getTime()
      this.startTime()
      this.getDepartment()
    },
    mounted(){
        let userlogged = localStorage.getItem('userlogged')
        let department=localStorage.getItem('departmentlogged')
        if(userlogged){
            this.dialog = false
            if(localStorage.getItem('bell') == undefined){
              this.$showDialogBell(true)
            }
            localStorage.setItem('bell','ok')
            this.Department = department
        }
    },
    methods:{
      getTime(){
        let hari = new Date().toISOString().substring(0,10)
        this.time = this.$DateConvert(hari)
      },
      getDataUser(){
        let u = this.logged
        console.log(u)
        API.get("totaluser").then(x=>{
          let index = this.items.findIndex(x=>x.title == 'User')
          this.items[index].locked = u.level == 3 ? 'N' : 'Y'
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
        let u = this.logged
        API.get("totalpengembaliantesdrive").then(x=>{
          let index = this.items.findIndex(x=>x.data == 'Tes Drive')
          this.items[index].locked = u.level > 1 ? 'N' : 'Y'
          this.items[index].count = x.data.totalform
        })
      },
      getDataPengembalianPeminjaman(){
        let u = this.logged
        API.get("totalpengembalianpeminjaman").then(x=>{
          let index = this.items.findIndex(x=>x.data == 'Peminjaman')
          this.items[index].locked = u.level > 1 ? 'N' : 'Y'
          this.items[index].count = x.data.totalform
          this.$loading(false)
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
        if(x.title == 'Laporan'){
          this.$AllLaporan()
        }
        this.$ChangeURL(x.to)
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
.v-carousel__controls{
  display:none !important;
}
.v-list .v-list-item--active{
  color:#a10115;
}
.fab{
  bottom:80px;
  margin-left:290px;
  position: fixed;
  -webkit-transition: all 2s ease-in-out;
  transition: all 2s ease-in-out;
  z-index: 4;
}
</style>