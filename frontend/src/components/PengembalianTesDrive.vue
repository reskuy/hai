<template>
<v-card height="100%">
  <v-sheet
    class="rounded"
    v-show="loading == true"
      color="gray lighten-2"
    >
      <v-skeleton-loader
        class="mt-4"
        type="text@2,table-heading,table-thead,table-tbody,table-tfoot"
      ></v-skeleton-loader>
    </v-sheet>
    <v-container
fluid
    style="height:100%"
    :style="{backgroundColor:'#c8d2d8'}">
  <v-data-table
    :headers="headers"
    :items="DataPengembalian"
    :search="search"
    v-show="loading == false"
    class="elevation-4"
    :custom-filter="filter"
  >
 <!--Desktop-->
    <template v-slot:top>
      <v-toolbar
      color="#a10115"
      elevation="4"
      dark
      v-show="device == 'Desktop'">
        <v-toolbar-title class="pencarian_desk">Pengembalian Tes Drive</v-toolbar-title>
        
        <v-text-field
        prepend-icon="mdi-magnify"
        class="mt-6"
          v-model="search"
          label="Pencarian"
        ></v-text-field>
      </v-toolbar>
    <!--mobile-->
    <v-toolbar
      color="#a10115"
      elevation="4"
      dark
      v-show="device == 'Mobile'">
        <v-toolbar-title style="font-size:11px" class="pencarian mr-2 ml-n1 mt-4">Pengembalian <p>Tes Drive</p></v-toolbar-title>
        <v-text-field
          prepend-icon="mdi-magnify"
          class="mt-6"
          v-model="search"
          label="Pencarian">
        </v-text-field>
    </v-toolbar>

    </template>
    <template v-slot:[`item.id_kembali_tes_drive`]="{ item }">
      <v-chip class="m">{{item.id_kembali_tes_drive}}</v-chip>
    </template>
    <template v-slot:[`item.actions`]="{ item }">
      <v-icon
      small
      class="ma-2"
        @click="FungsiAksi(item)"
      >
        mdi-eye
      </v-icon>
      <!-- <v-icon
      small
        @click="deleteItem(item)"
      >
        mdi-delete
      </v-icon> -->
    </template>
   <template v-slot:[`item.approve_pengembalian_tes_drive`]="{ item }">
      <!-- ini untuk hr approve -->
      <v-icon
      small
      v-show="item.acc_hr == null && logged.level == 4"
      color="green"
      class="ma-2"
      @click="accHRGA(item)"
      >
        mdi-check-outline
      </v-icon>
      <v-divider v-show="item.acc_hr == null  && logged.level == 4"/>
      <v-icon
      small
      v-show="item.acc_hr == null && logged.level == 4"
      color="red"
      class="ma-2"
      @click="cancelHRGA(item)"
      >
        mdi-close-outline
      </v-icon>
      <v-chip v-show="item.acc_hr != null && item.acc_hr != 'N' && logged.level < 5 && item.approve_pengembalian_tes_drive == null">HR GA<v-icon small>mdi-check</v-icon></v-chip>
      <v-chip v-show="item.acc_hr == 'N' && logged.level < 5 && item.approve_pengembalian_tes_drive == null">HR GA<v-icon small>mdi-close</v-icon></v-chip>
      <v-chip class="mt-2" v-show="item.acc_hr == null && logged.level < 4 && item.approve_pengembalian_tes_drive == null"><b style="font-size:12px;">Menunggu</b></v-chip>
      <!-- end of hr approve -->

      <!-- end of manager approve -->

      <v-icon
      small
      v-show="item.approve_pengembalian_tes_drive == 'ACC'"
      class="ma-2"
      color="green">
        mdi-check-outline
      </v-icon>

    </template>
    <template v-slot:no-data>
      <span>Mohon Tunggu</span>
    </template>
  </v-data-table>
  </v-container>
</v-card>
</template>
<script>
import axios from 'axios'
import firebase from "@/services/firebase-sw"
import API from "@/services/http";
  export default {
    data: () => ({
      dialog: false,
      search:'',
      device:null,
      loading:true,
      logged:[],
      dialogDelete: false,
      headers: [
        { text: 'No Refrensi', value: 'id_kembali_tes_drive' },
        { text: 'Tanggal Pengembalian', value: 'Tanggal'}, 
        {
          text: 'Penanggung Jawab',
          align: 'start',
          value: 'tesdrive.penanggung_jawab',
        },
        { text: 'Department', value: 'tesdrive.department.nama_department' },
        { text: 'Model Kendaraan', value: 'tesdrive.aset.nama_aset' },
        { text: 'No Pol', value: 'tesdrive.aset.no_plat' },
        { text: 'Jam Masuk', value: 'jam_masuk_kendaraan' },
        { text: 'Actions', value: 'actions', sortable: false , align: 'start',},
        { text: 'Approve', value: 'approve_pengembalian_tes_drive' }
      ],
      desserts: [],
      DataPengembalian:[],
      editedIndex: -1,
    }),

    computed: {
      //
    },

    watch: {
      //
    },

    created () {
      this.logged = this.$SetLog()
      this.device = this.$device
      this.getDataPengembalian()
    },
    mounted(){
        //
    },

    methods: {
      FungsiAksi(item){
        // nah lupa disini sekalinya
        this.$Store(item)
        this.$ChangeURL("PengembalianTesDrive/"+item.id_kembali_tes_drive)
      },
      openAksi(x){
        this.$Store(x)
        // const suara = require('../assets/SuaraNotif.mpeg')
        this.$ChangeURL('PengembalianTesDrive/'+x.id_form_tes_drive)
      },
      ChangeURL(x){
        this.$ChangeURL(x)
      },
        filter (value, search) {
        search = search.toString().toLocaleLowerCase()
        return value != null &&
          search != null &&
          typeof value === 'string' &&
          value.toString().toLocaleLowerCase().indexOf(search) !== -1
      },
      getDataPengembalian(){
        this.Seen()
        API.get("/pengembaliantesdrive").then(x=>{
          x.data.forEach(z => {
            z.Tanggal = this.$DateConvert(z.tanggal_pengembalian)
          });
          this.DataPengembalian = x.data.reverse()
          this.loading = false
        })
      },
      accHRGA(x){
        this.$loading(true)
        x.accby = this.$UserLogged().nama_lengkap
        x.title = 'Approve Pengembalian'
        API.put("/approvepengembalianformtesdrive/"+x.id_kembali_tes_drive,{
              AccBy:'HRGA',
              AccHR:x.accby,
              IdAset:x.tesdrive.aset.id_aset,
            }).then(c=>{
          console.log(c)
          this.$loading(false)
          this.KirimNotif(x)
          this.loading = true
          this.getDataPengembalian()
          this.$Toast('success','Approve By HRGA')
        })
      },
      cancelHRGA(x){
        this.$loading(true)
        x.accby = localStorage.getItem('userlogged')
        x.title = 'Reject Pengembalian'
        API.put("/approvepengembalianformtesdrive/"+x.id_kembali_tes_drive,{
              AccBy:'HRGA',
              AccHR:'N',
              Approve:'REJECT',
              IdAset:x.tesdrive.aset.id_aset,
            }).then(c=>{
            this.$loading(false)
            console.log(c)
            this.KirimNotif(x)
            this.loading = true
            this.getDataPengembalian()
            this.$Toast('success','Cancel By HRGA')
        })
      },
      KirimNotif(x){
        let listoken = [];
        firebase.database().ref("alluser").on('value', snapshot => {
                let dx = snapshot.val();
                Object.keys(dx).forEach(key => {
                listoken.push(dx[key]);
                });
            })
        let data = {
          "registration_ids":listoken, 
            "notification" : {
                    "title": x.title+" Tes Drive",
                    "body": x.accby+' '+x.title+" Tes Drive Pengajuan dari "+x.tesdrive.penanggung_jawab+" Mengembalikan Tes Drive Kendaraan "+x.tesdrive.aset.jenis_aset+' '+x.tesdrive.aset.nama_aset+' '+x.tesdrive.aset.no_plat,
                    "icon": "https://www.honda-indonesia.com/favicon/android-icon-192x192.png",
          },
          "priority":"high"
        }
        axios.post('https://fcm.googleapis.com/fcm/send',data,{
          headers: {
          'Content-Type': 'application/json',
          'Authorization': 'key=AAAARShXKoo:APA91bGI1FeO6Q8eoNOTmKZTp4Fh7nLEkTY-yaXLMnUDi4z2BpFKWnV0SBOL8bYVSjKaDnGA8Te0Aycdmmo_yjZ2WIeDzitUemUOutRoAa6GKeF_J2AIz-oXEDX_YOrTSzV4aWSjVYIh'
          }
        }).then(x=>{
          console.log(x)
        })
      },
      Seen(){
        API.get('seen/p_tesdrive/'+this.logged.id_user)
      },
    },
  }
</script>
<style>
.pencarian{
  width: 150px;
}
.pencarian_desk{
  width:1200px;
}
</style>