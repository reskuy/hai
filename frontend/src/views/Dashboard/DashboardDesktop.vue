<template>
<div
    class="mx-auto"
    :style="{backgroundColor:'#c8d2d8',height:height}"
  >
  <SideBar class="mt-16 color-side"/>
    

<v-container>
  <v-alert 
  class="pa-2 mb-2 overline" dense
            color="black"
            border="bottom"
            colored-border
            elevation="5">
            <v-row dense>
              <v-col class="text-start" cols="6"></v-col>
              <v-col class="text-end" cols="6"><v-icon color="#a10115" class="mr-1">mdi-calendar-month </v-icon><span class="mr-4">{{time}}</span><v-icon color="#a10115">mdi-clock-outline </v-icon><span>{{' '+realtime}}</span></v-col>
            </v-row>
              </v-alert>
              
  <v-row dense class="mb-5">
    <v-col cols="12" sm="12" md="6" lg="6" xl="6">
      <SyaratKetentuan/>
    </v-col>

    <v-col cols="12" sm="12" md="6" lg="6" xl="6">

      <v-row dense>
      <v-col cols="12" sm="4" md="4">
       <v-card elevation="6">
        <v-list-item three-line>
      <v-list-item-content>
        <v-list-item-subtitle class="text-overline">Ajukan Tes Drive</v-list-item-subtitle>
      </v-list-item-content>

        <v-list-item-avatar
          tile
        >
        <v-icon large>mdi-file-plus</v-icon>
        </v-list-item-avatar>
      </v-list-item>
        <v-card-actions>
            <v-btn class="border" width="100%" small @click="ChangeURL({to:'FormTesDrive'})">
            Buat Sekarang
            </v-btn>
        </v-card-actions>
        </v-card>
    </v-col>

    <v-col cols="12" sm="4" md="4">
      <!-- <v-alert
        dense
        color="black"
        border="bottom"
        icon="mdi-file-plus"
        colored-border> -->
        <v-card elevation="6">
        <v-list-item three-line>
          <v-list-item-content>
            <v-list-item-subtitle class="text-overline">Ajukan Peminjaman</v-list-item-subtitle>
          </v-list-item-content>

            <v-list-item-avatar
              tile
            >
            <v-icon large>mdi-file-plus</v-icon>
            </v-list-item-avatar>
          </v-list-item>
            <v-card-actions>
                <v-btn class="border" width="100%" small @click="ChangeURL({to:'FormPeminjaman'})">
                Buat Sekarang
                </v-btn>
            </v-card-actions>
            </v-card>
        <!-- </v-alert> -->
    </v-col>

    <v-col cols="12" sm="4" md="4">
      <!-- <v-alert
        dense
        color="black"
        border="bottom"
        icon="mdi-file-plus"
        colored-border> -->
        <v-card elevation="6">
        <v-list-item three-line>
        <v-list-item-content>
          <v-list-item-subtitle class="text-overline">Buat Laporan</v-list-item-subtitle>
        </v-list-item-content>

          <v-list-item-avatar
            tile
          >
          <v-icon large>mdi-chart-line</v-icon>
          </v-list-item-avatar>
        </v-list-item>
          <v-card-actions>
              <v-btn class="border" width="100%" small @click="ChangeURL({title:'Laporan',to:''})">
              Buat Sekarang
              </v-btn>
          </v-card-actions>
          </v-card>
        <!-- </v-alert> -->
    </v-col>

          <v-col v-for="(item, i) in items"
            :key="i"
            cols="12" sm="12" xs="12" md="4" lg="4" xl="4">
          <v-sheet
          class="rounded"
          elevation="6"
          v-show="item.isLoad == true"
            color="gray lighten-2"
          >
            <v-skeleton-loader
              class="mx-auto"
              max-height="125"
              type="card"
            ></v-skeleton-loader>
          </v-sheet>
          <v-alert
          color="black"
          border="bottom"
          large
          v-show="item.locked == 'N' && item.isLoad == false"
          :icon="item.icon"
          colored-border
          elevation="6">
              <v-list-item one-line>
              <v-list-item-content class="mt-n6 mx-n7">
              <v-list-item-title class="text-button"><span style="color:#a10115;" v-text="item.count+' '"/><span v-text="item.title" /></v-list-item-title>
              <v-list-item-subtitle style="font-size:12px;" v-show="item.title == 'Pengembalian' || item.title =='Laporan'" v-text="item.data"></v-list-item-subtitle>
              </v-list-item-content>
              </v-list-item>

              <v-card-actions class="mr-6">
                <v-spacer/>
              <v-btn
                  outlined
                  small
                  rounded
                  color="#a10115"
                  @click="ChangeURL(item)"
              >
                  Lihat Data
              </v-btn>
              <v-badge v-show="item.badge == true" class="mx-2 mt-6" dot color="#a10115"/>
              </v-card-actions>
          </v-alert>


          <!-- ini kalo user ga ada akses -->
          <v-tooltip top>
          <template v-slot:activator="{ on, attrs }">
          <v-alert
          large
          v-on="on"
          v-bind="attrs"
          v-show="item.locked == 'Y' && item.isLoad == false"
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
                  @click="ChangeURL(item)"
              >
                  Lihat Data
              </v-btn>
              </v-card-actions>
          </v-alert>
          </template>
          <span>Dibatasi</span>
        </v-tooltip>
      </v-col>
        <v-col cols="12" sm="12" xs="12" md="4" lg="4" xl="4">
          <v-list color="white rounded" elevation="6">
                <v-list-group
                class="mt-n1"
                  no-action
                  height="210px"
                >
                <template v-slot:activator>
                    <v-list-item-content>
                      <v-list-item-title ><span style="color:black;" class="text-button">ICON</span></v-list-item-title>
                    </v-list-item-content>
                  </template>

                  <v-list-item style="margin-left:-70px">
                    <v-list-item-content class="mt-n6">
                    <v-carousel
                    cycle
                    height="185px"
                    :show-arrows="false"
                    hide-delimiter-background
                    >
                      <v-carousel-item>
                        <v-card
                          height="100%"
                        >
                          <v-card-text>
                        <span><b>Status Aset</b></span>
                        <p></p>
                        1. <v-icon color="#a10115">mdi-car</v-icon> : 
                        <span>Kendaraan operasional </span>
                        <h4></h4>
                        <span class="ml-13"><b>READY</b></span>
                        <h4></h4>
                        2. <v-icon>mdi-car</v-icon> : 
                        <span>Kendaraan operasional</span>
                        <h4></h4>
                        <span class="ml-13"><b>NOT READY</b></span>
                      </v-card-text>
                      </v-card>
                      </v-carousel-item>
                      <v-carousel-item>
                      <v-card
                        height="100%"
                      >
                      <v-card-text>
                      <span><b>Kondisi Aset</b></span>
                      <p></p>
                      1. <v-icon>mdi-car-traction-control</v-icon> : 
                        <span>Kendaraan operasional untuk</span>
                        <h4></h4>
                        <span class="ml-13"><b>TES DRIVE</b></span>
                        <h4></h4>
                      2. <v-icon>mdi-car-clock</v-icon> : 
                        <span>Kendaraan operasional untuk</span>
                        <h4></h4>
                        <span class="ml-13"><b>DAILY</b></span>
                      </v-card-text>
                      </v-card>
                      </v-carousel-item>
                      <v-carousel-item>
                      <v-card
                        height="100%"
                      >
                      <v-card-text>
                      <span><b>Kondisi Aset</b></span>
                      <p></p>
                        3. <v-icon>mdi-car-key</v-icon> : 
                        <span>Kendaraan operasional untuk</span>
                        <h4></h4>
                        <span class="ml-13"><b>DIPINJAM</b></span>
                      </v-card-text>
                      </v-card>
                      </v-carousel-item>
                      </v-carousel>
                      </v-list-item-content>
                      </v-list-item>
          </v-list-group>
          </v-list>
        </v-col>
        
        <v-col cols="12" sm="12" xs="12" md="4" lg="4" xl="4">
          <v-list color="white rounded" elevation="6">
                <v-list-group
                class="mt-n1"
                  no-action
                  height="200px"
                >
                <template v-slot:activator>
                    <v-list-item-content>
                      <v-list-item-title ><span style="color:black;" class="text-button">Buletin</span></v-list-item-title>
                    </v-list-item-content>
                  </template>

                  <v-list-item style="margin-left:-70px">
                    <v-list-item-content class="mt-n6">
                    <v-carousel
                        cycle
                        height="185px"
                        :show-arrows="false"
                        hide-delimiter-background
                    >  
                    
                      <v-carousel-item>
                        <v-card
                          height="100%"
                        >
                          <v-card-text>
                        <span><b>Informasi Terkini Agustus 2022</b></span>
                        <p></p>
                        1. Mobil CR-V Nomor Polisi KT 6543  
                        <span class="ml-4">RR dalam perbaikan</span>
                        <h4></h4>
                        2. Manager Sales sedang <b>CUTI</b> 
                      </v-card-text>
                      </v-card>
                      </v-carousel-item>
                      </v-carousel>
                      </v-list-item-content>
                      </v-list-item>
          </v-list-group>
          </v-list>
        </v-col>
      </v-row>

    </v-col>
    
    
  </v-row>
  <!-- <br> -->
</v-container>
    <Laporan />
    <Footer />
</div>
</template>
<script>
const SyaratKetentuan = () => import (/* webpackChunkName: "SyaratKetentuan"*/ '@/components/SyaratKetentuan/index.vue')
const Footer = () => import (/* webpackChunkName: "Footer"*/ '@/components/Footer/index.vue')
const SideBar = () => import (/* webpackChunkName: "SideBar"*/ '@/components/SideBar.vue')
const Laporan = () => import (/* webpackChunkName: "Laporan"*/ '@/components/DialogLaporan/index.vue')
import moment from 'moment'
import API from "@/services/http";
  export default {
    components:{
      SyaratKetentuan,SideBar,Footer,Laporan
    },
    data: () => ({
    logged:[],
    formhide:false,
    dialog:true,
    realtime:null,
    DialogLaporan:false,
    epochtime:null,
    time:null,
    height:'720px',
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
      let winheight = window.innerHeight+50
      this.height = winheight+'px'
      window.scrollTo(0,0)
      // this.$loading(true)
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
      window.scrollTo(0,0)
      if(window.innerHeight > 850){
        let elHtml = document.getElementsByTagName('html')[0]
        elHtml.style.overflowY = 'hidden'
      }
        let userlogged = localStorage.getItem('userlogged')
        let department=localStorage.getItem('departmentlogged')
        if(userlogged){
            this.dialog = false
            if(localStorage.getItem('bell') == undefined){
              this.$showDialogBell(true)
            }
            localStorage.setItem('bell','ok')
            this.department=department
        }
    },
    methods:{
      getTime(){
          // let hari = new Date(x.data).toISOString().substring(0,10)
          // this.time = this.$DateConvert(hari)
          this.time = moment().locale('id').format('LL')
      },
      getDataUser(){
        let u = this.logged
        console.log(u)
        API.get("totaluser").then(x=>{
          let index = this.items.findIndex(x=>x.title == 'User')
          this.items[index].locked = u.level == 3 ? 'N' : 'Y'
          this.items[index].count = x.data
          this.items[index].isLoad = false
        })
      },
      getDataAset(){
        API.get("totalaset/"+this.logged.id_user).then(x=>{
          let index = this.items.findIndex(x=>x.title == 'Aset')
          this.items[index].count = x.data.count
          this.items[index].isLoad = false
          this.items[index].badge = x.data.seen == 'Y' ? true : false
        })
      },
      getDataTesDrive(){
        API.get("totaltesdrive/"+this.logged.id_user).then(x=>{
          let index = this.items.findIndex(x=>x.title == 'Tes Drive')
          this.items[index].count = x.data.totalform
          this.items[index].isLoad = false
          this.items[index].badge = x.data.seen == 'Y' ? true : false
        })
      },
      getDataPeminjaman(){
        API.get("totalpeminjaman/"+this.logged.id_user).then(x=>{
          let index = this.items.findIndex(x=>x.title == 'Peminjaman')
          this.items[index].count = x.data.totalform
          this.items[index].isLoad = false
          this.items[index].badge = x.data.seen == 'Y' ? true : false
        })
      },
      getDataPengembalianTesDrive(){
        let u = this.logged
        API.get("totalpengembaliantesdrive/"+this.logged.id_user).then(x=>{
          let index = this.items.findIndex(x=>x.data == 'Tes Drive')
          this.items[index].locked = u.level > 1 ? 'N' : 'Y'
          this.items[index].count = x.data.totalform
          this.items[index].isLoad = false
          this.items[index].badge = x.data.seen == 'Y' ? true : false
        })
      },
      getDataPengembalianPeminjaman(){
        let u = this.logged
        API.get("totalpengembalianpeminjaman/"+this.logged.id_user).then(x=>{
          let index = this.items.findIndex(x=>x.data == 'Peminjaman')
          this.items[index].locked = u.level > 1 ? 'N' : 'Y'
          this.items[index].count = x.data.totalform
          this.items[index].isLoad = false
          this.items[index].badge = x.data.seen == 'Y' ? true : false
          // this.$loading(false)
          // this.getDataLaporan()
          this.$LoadingKetentuan()
        })
      },
      getDataLaporan(){
        let u = this.logged
        let index = this.items.findIndex(x=>x.title == 'Laporan')
          this.items[index].locked = u.level > 1 ? 'N' : 'Y'
          this.items[index].isLoad = false
          this.$LoadingKetentuan()
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
          this.realtime =  moment().locale('id').format("LTS");
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
.border{
  color:white !important;
}
.border:hover{
  transition: border-radius 0.2s;
  border-radius: 10px;
}
.theme--light.v-btn.v-btn--has-bg{
  background-color: #a10115 !important;
}
/* .v-btn__content > .v-icon{
  color:#a10115 !important;
} */
</style>