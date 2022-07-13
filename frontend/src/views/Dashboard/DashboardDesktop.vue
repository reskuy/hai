<template>
<v-sheet
    class="mx-auto"
    style="height:100vh"
    :style="{backgroundColor:'#D3D3D3'}"
  >
    <v-dialog
      v-model="dialog"
      persistent
      width="500px"
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
                sm="12"
                md="12"
              >
                <v-text-field
                  label="Isi Nama Anda*"
                  required
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
    <v-col cols="12" sm="6" md="6">
      <v-alert
        dense
        color="red darken-4"
        border="bottom"
        icon="mdi-note"
        colored-border
        elevation="5">

        <v-card-subtitle>Ajukan Tes Drive Secara Online.</v-card-subtitle>

        <v-card-actions>
            <v-btn @click="ChangeURL('FormTesDrive')" text>
            Buat Sekarang
            </v-btn>
        </v-card-actions>
        <!-- </v-card> -->
        </v-alert>
    </v-col>

    <v-col cols="12" sm="6" md="6">
      <v-alert
        dense
        color="red darken-4"
        border="bottom"
        icon="mdi-note"
        colored-border>
        <v-card-subtitle>Ajukan Peminjaman Secara Online.</v-card-subtitle>

        <v-card-actions>
            <v-btn @click="ChangeURL('FormPeminjaman')" text>
            Buat Sekarang
            </v-btn>
        </v-card-actions>
        <!-- </v-card> -->
        </v-alert>
    </v-col>

    <v-col v-for="(item, i) in items"
          :key="i"
          cols="4">
        <v-alert
        dense
        color="red darken-4"
        border="bottom"
        colored-border
        elevation="5">
        <!-- <v-card
            class="ma-3 mb-3"
            max-width="344"
            outlined
            elevation="6"
        > -->
            <v-list-item three-line>
            <v-list-item-content>
                <!-- <div class="text-overline mb-4">
                Asset
                </div> -->
                <v-list-item-title class="text-h5 mb-1" v-text="item.title">
                </v-list-item-title>
                <v-list-item-subtitle v-text="'Total '+item.title"></v-list-item-subtitle>
                <v-list-item-subtitle class="text-h5" v-text="item.count"></v-list-item-subtitle>
            </v-list-item-content>

            <v-list-item-avatar
                size="50"
                dark
                color="white"
            >
            <v-icon v-text="item.icon"/></v-list-item-avatar>
            </v-list-item>

            <v-card-actions>
            <v-btn
                outlined
                rounded
                text
                @click="ChangeURL(item.to)"
            >
                Lihat Data
            </v-btn>
            </v-card-actions>
        <!-- </v-card> -->
        </v-alert>
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
import API from "@/services/http";
  export default {
    data: () => ({
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
      this.items = this.$ItemDashboard
      this.getTime()
      this.startTime()
      this.$loading(true)
      this.getDataAset()
      this.getDataTesDrive()
      this.getDataPeminjaman()
      this.getDepartment()
      this.getDataUser()
    },
    mounted(){
        let userlogged = localStorage.getItem('userlogged')
        let department=localStorage.getItem('departmentlogged')
        if(userlogged){
            this.dialog = false
            this.department=department
        }
    },
    methods:{
      getTime(){
        let hari = new Date().toISOString().substring(0,10)
        this.time = hari
      },
      getDataUser(){
        API.get("totaluser").then(x=>{
          let index = this.items.findIndex(x=>x.title == 'User')
          this.items[index].count = x.data
        })
      },
      getDataAset(){
        API.get("totalaset").then(x=>{
          let index = this.items.findIndex(x=>x.title == 'Aset')
          this.items[index].count = x.data
          this.$loading(false)
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