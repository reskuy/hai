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
    :items="DataTesDrive"
    v-show="loading == false"
    :search="search"
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
        <v-toolbar-title>Data Tes Drive</v-toolbar-title>
        <v-divider
          class="mx-4"
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-text-field
        prepend-icon="mdi-magnify"
        class="mt-6"
          v-model="search"
          label="Pencarian"
        ></v-text-field>
        <LaporanTesDrive/>
      </v-toolbar>
    <!--mobile-->
    <v-toolbar
      color="#a10115"
      elevation="4"
      dark
      v-show="device == 'Mobile'">
        <v-toolbar-title style="font-size:14px" class="pencarian ml-n1">Tes Drive</v-toolbar-title>
        <v-text-field
          prepend-icon="mdi-magnify"
          class="mt-6"
          v-model="search"
          label="Pencarian">
        </v-text-field>
    </v-toolbar>

    </template>
    <template v-slot:[`item.actions`]="{ item }">
      <v-icon
      small
      class="ma-2"
        @click="openAksi(item)"
      >
        mdi-eye
      </v-icon>
    </template>
    <template v-slot:[`item.id_form_tes_drive`]="{ item }">
      <v-chip class="m">{{item.id_form_tes_drive}}</v-chip>
    </template>
    <template v-slot:[`item.approve_form_tes_drive`]="{ item }">
      <!-- ini untuk hr approve -->
      <v-chip class="mt-1 mb-1" small v-show="item.acc_hr == null && logged.level == 4" @click="accHRGA(item)">
      <v-icon
      small
      color="green"
      class="ma-2"
      >
        mdi-check-outline
      </v-icon>
      </v-chip>
      <v-divider v-show="item.acc_hr == null  && logged.level == 4"/>
      <v-chip class="mt-1 mb-1" small v-show="item.acc_hr == null && logged.level == 4" @click="cancelHRGA(item)">
      <v-icon
      small
      color="red"
      class="ma-2"
      >
        mdi-close-outline
      </v-icon>
      </v-chip>
      
      <v-chip v-show="item.acc_hr != null && item.acc_hr != 'N' && logged.level < 5 && item.approve_form_tes_drive == null"><b style="font-size:12px;">HR GA</b><v-icon small>mdi-check</v-icon></v-chip>
      <v-chip v-show="item.acc_hr == 'N' && logged.level < 5 && item.approve_form_tes_drive == null"><b style="font-size:12px;">HR GA</b><v-icon small>mdi-close</v-icon></v-chip>
      <v-chip  v-show="item.acc_hr == null && logged.level != 4 && item.approve_form_tes_drive == null"><b style="font-size:12px;">Menunggu</b></v-chip>
      <!-- end of hr approve -->

      <!-- ini untuk manager approve -->
      <v-chip class="mt-1 mb-1" small v-show="item.acc_hr != null && item.acc_hr != 'N' && item.acc_manager == null && logged.level == 5" @click="accManager(item)">
      <v-icon
      small
      color="green"
      class="ma-2"
      >
        mdi-check-outline
      </v-icon>
      </v-chip>
      <v-divider v-show="item.acc_hr != null && item.acc_hr != 'N' && item.acc_manager == null  && logged.level == 5"/>
      <v-chip class="mt-1 mb-1" small v-show="item.acc_hr != null && item.acc_hr != 'N' && item.acc_manager == null && logged.level == 5" @click="cancelManager(item)">
      <v-icon
      small
      color="red"
      class="ma-2"
      >
        mdi-close-outline
      </v-icon>
      </v-chip>
      <!-- end of manager approve -->

      <v-chip v-show="item.approve_form_tes_drive == 'ACC'">
      <v-icon
      small
      class="ma-2"
      color="green">
        mdi-check-outline
      </v-icon>
      </v-chip>

      <v-chip v-show="item.approve_form_tes_drive == 'REJECT'">
      <v-icon
      small
      class="ma-2"
      color="red darken-4">
        mdi-close-outline
      </v-icon>
      </v-chip>
    </template>
    <template v-slot:[`item.pengembalian`]="{ item }">
      <v-btn class="mr-4" v-show="item.approve_form_tes_drive == 'ACC'" icon>
      <v-icon
      small
      v-show="item.pengembalian == null && (logged.level == 2 || logged.level == 3)"
      color="red darken-4"
        @click="ToPengembalian(item)"
      >
        mdi-note
      </v-icon>
      <v-tooltip left v-show="item.pengembalian != null">
        <template v-slot:activator="{ on, attrs }">
      <v-icon
      small
      v-on="on"
      v-bind="attrs"
      v-show="item.pengembalian != null"
      >
        mdi-note
      </v-icon>
        </template>
        <span>Sudah Dikembalikan</span>
      </v-tooltip>
      </v-btn>
      <v-chip class="ml-n15" v-show="(logged.level == 1 || logged.level == 4 ||  logged.level == 5) && item.pengembalian == null"><b style="font-size:12px;">Beroperasi</b></v-chip>
      <v-chip class="ml-n15" v-show="(logged.level == 2 || logged.level == 3) && item.approve_form_tes_drive == null"><b style="font-size:12px;">Beroperasi</b></v-chip>
    </template>
    <template v-slot:[`item.print`]="{ item }">
      <v-btn class="mr-4" icon>
      <v-icon
      
        @click="ToPrint(item)"
      >
        mdi-file-document-check-outline
      </v-icon>
      </v-btn>
    </template>
    <template v-slot:no-data>
      <span>Mohon Tunggu</span>
    </template>
  </v-data-table>
  <v-dialog v-model="dialogAlertManager" width="380px" persistent>
        <v-card>
            <v-toolbar color="#a10115">
                <span class="text-button" style="color:white;" dark>Tujuan Notif</span>
                <v-spacer/>
            </v-toolbar>
            <v-container>
               <v-row>
                    <v-col cols="12" class="mb-n2 mt-4">
                        <v-autocomplete
                            color="#a10115"
                            class="text-button"
                            v-model="SelectPerson"
                            :items="listmanager"
                            dense
                            item-text="nama_lengkap"
                            return-object
                            label="List"
                        ></v-autocomplete>
                    </v-col>
                    <v-col cols="12" class="mt-n4">
                        <v-btn 
                            :disabled="SelectPerson != null ? false : true" 
                            @click="Generate" 
                            width="100%" 
                            :dark="SelectPerson != null ? true : false"
                            color="#a10115">
                            Kirim Notifikasi
                        </v-btn>
                    </v-col>
               </v-row>
            </v-container>
        </v-card>
    </v-dialog>
  </v-container>
</v-card>
</template>
<script>
import axios from 'axios'
import firebase from "@/services/firebase-sw"
import API from "@/services/http";
const LaporanTesDrive = () => import (/* webpackChunkName: "LaporanTesDrive"*/ '@/components/LaporanTesDrive/index.vue')
// import SuaraNotif from '../assets/SuaraNotif.mpeg'
  export default {
    components: {
      LaporanTesDrive
    },
    data: () => ({
      JmlhAset:'',
      dialog: false,
      search:'',
      device: null,
      SelectPerson:null,
      logged:[],
      stored:[],
      listmanager:[],
      loading:true,
      dialogAlertManager:false,
      dialogDelete: false,
      headers: [
        { text: 'No Refrensi', value: 'id_form_tes_drive' },
        { text: 'Tanggal Pemakaian', value: 'Tanggal' },
        {
          text: 'Penanggung Jawab',
          align: 'start',
          value: 'penanggung_jawab',
        },
        { text: 'Department', value: 'department.nama_department' },
        { text: 'Nama Customer', value: 'nama_customer' },
        { text: 'Model Kendaraan', value: 'aset.nama_aset' },
        { text: 'No Pol', value: 'aset.no_plat' },
        { text: 'Actions', value: 'actions', sortable: false , align: 'start',},
        { text: 'Approve', value:'approve_form_tes_drive', align:'center'},
        { text: 'Pengembalian', value:'pengembalian', align:'center'},
        { text: 'Berkas', value:'print', align:'center'}
      ],
      desserts: [],
      userlist:[],
      listoken:[],
      DataTesDrive:[],
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
      this.getDataTesDrive()
      this.getManager()
    },
    mounted(){
      //
    },
    methods: {
      openAksi(x){
        this.$Store(x)
        // const suara = require('../assets/SuaraNotif.mpeg')
        this.$ChangeURL('TesDrive/'+x.id_form_tes_drive)
      },
      OpenLaporan(){
        this.$OpenLaporanTesDrive()
      },
      ChangeURL(x){
        this.$ChangeURL(x)
      },
        filter (value, search) {
          console.log(value)
        search = search.toString().toLocaleLowerCase()
        return value != null &&
          search != null &&
          typeof value === 'string' &&
          value.toString().toLocaleLowerCase().indexOf(search) !== -1
      },
      getDataTesDrive(){
        this.Seen()
        API.get("/formtesdrive").then(x=>{
          x.data.forEach(z => {
            z.id_form_tes_drive = z.id_form_tes_drive.toString()
            z.Tanggal = this.$DateConvert(z.tanggal_pemakaian)
          });
          this.DataTesDrive = x.data.reverse()
          this.loading = false
          // this.$loading(false)
        })
      },
      accHRGA(x){
        this.$loading(true)
        x.accby = JSON.parse(localStorage.getItem('logged')).nama_lengkap
        x.title = 'Approve'
        API.put("/approveformtesdrive/"+x.id_form_tes_drive,{
              AccBy:'HRGA',
              AccHR:x.accby,
              IdAset:x.aset.id_aset,
            }).then(c=>{
          this.$loading(false)
          console.log(c)
          this.stored = x
          this.dialogAlertManager = true //alert to manager
          // this.KirimNotif(x)
          this.loading = true
          this.getDataTesDrive()
          this.$Toast('success','Approve By HRGA')
        })
      },
      cancelHRGA(x){
        this.$loading(true)
        x.accby = JSON.parse(localStorage.getItem('logged')).nama_lengkap
        x.title = 'Reject'
        x.user = this.userlist.find(c => c.nama_lengkap == x.penanggung_jawab && c.id_department == x.department.id_department)
        API.put("/approveformtesdrive/"+x.id_form_tes_drive,{
              AccBy:x.accby,
              AccHR:'N',
              Approve:'REJECT',
              IdAset:x.aset.id_aset,
            }).then(c=>{
            this.$loading(false)
            console.log(c)
            this.SelectPerson = x.user
            // console.log('x',x)
            this.KirimNotif(x)
            this.loading = true
            this.getDataTesDrive()
            this.$Toast('success','Cancel By HRGA')
        })
      },
      accManager(x){
        this.$loading(true)
        x.accby = JSON.parse(localStorage.getItem('logged')).nama_lengkap
        x.title = 'Approve'
        x.user = this.userlist.find(c => c.nama_lengkap == x.penanggung_jawab && c.id_department == x.department.id_department)
        API.put("/approveformtesdrive/"+x.id_form_tes_drive,{
              AccBy:'Manager',
              AccManager:x.accby,
              Approve:'ACC',
              IdAset:x.aset.id_aset,
            }).then(c=>{
          this.$loading(false)
          console.log(c)
          this.SelectPerson = x.user
          this.KirimNotif(x)
          this.loading = true
          this.getDataTesDrive()
          this.$Toast('success','Approve By Manager')
        })
      },
      cancelManager(x){
        this.$loading(true)
        x.accby = JSON.parse(localStorage.getItem('logged')).nama_lengkap
        x.title = 'Reject'
        x.user = this.userlist.find(c => c.nama_lengkap == x.penanggung_jawab && c.id_department == x.department.id_department)
        API.put("/approveformtesdrive/"+x.id_form_tes_drive,{
              AccBy:x.accby,
              AccManager:'N',
              Approve:'REJECT',
              IdAset:x.aset.id_aset,
            }).then(c=>{
            this.$loading(false)
            console.log(c)
            this.SelectPerson = x.user
            this.KirimNotif(x)
            this.loading = true
            this.getDataTesDrive()
            this.$Toast('success','Cancel By Manager')
        })
      },
      ToPengembalian(x){
        this.$Store(x)
        this.$ChangeURL('FormPengembalianTesDrive/'+x.id_form_tes_drive)
      },
      ToPrint(x){
        this.$Store(x)
        this.$ChangeURL('SuratPengajuanTesDrive/'+x.id_form_tes_drive)
      },

      async getManager(){
        API.get('user').then(x=>{
          this.userlist = x.data
          let dt = x.data
          let dtf = dt.filter(x => x.level == 5)
          this.listmanager = dtf
        })
      },
      
      Generate(){
        this.KirimNotif(this.stored)
        this.dialogAlertManager = false
      },

      async KirimNotif(x){
        // firebase.database().ref("alluser").on('value', snapshot => {
        const eventref = firebase.database().ref("userlevel/"+this.SelectPerson.level+"/"+this.SelectPerson.id_user); // HRGA
        let snapshot = await eventref.once('value');
                let dx = snapshot.val();
                Object.keys(dx).forEach(key => {
                this.listoken.push(dx[key]);
                });
            // })
        let data = {
          "registration_ids":this.listoken, 
            "notification" : {
                    "title": x.title+" Tes Drive",
                    "body": x.accby+' '+x.title+" Tes Drive Pengajuan dari "+x.penanggung_jawab+" Tes Drive Kendaraan "+x.aset.jenis_aset+' '+x.aset.nama_aset+' '+x.aset.no_plat,
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
        API.get('seen/tes_drive/'+this.logged.id_user)
      },
    },
  }
</script>
<style>
.pencarian{
  width: 150px;
}
</style>