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
    :items="DataPeminjaman"
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
        <v-toolbar-title class="pencarian_desk">Data Peminjaman</v-toolbar-title>
        
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
        <v-toolbar-title style="font-size:13px" class="pencarian ml-n1">Peminjaman <h4></h4>Kendaraan</v-toolbar-title>
        <v-text-field
          prepend-icon="mdi-magnify"
          class="mt-6 ml-10"
          v-model="search"
          label="Pencarian">
        </v-text-field>
    </v-toolbar>

    </template>
    <template v-slot:[`item.id_form_peminjaman`]="{ item }">
      <v-chip class="m">{{item.id_form_peminjaman}}</v-chip>
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
    <template v-slot:[`item.approve_peminjaman`]="{ item }">
      <!-- ini untuk hr approve -->
      <v-chip class="mt-1 mb-1" small v-show="item.acc_hr == null && logged.level == 4" @click="accHRGA(item)">
      <v-icon
      small
      color="green"
      class="ma-2"
      @click="accHRGA(item)"
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
      <v-chip v-show="item.acc_hr != null && item.acc_hr != 'N' && logged.level < 5 && item.approve_peminjaman == null"><b style="font-size:12px;">HR GA</b><v-icon small>mdi-check</v-icon></v-chip>
      <v-chip v-show="item.acc_hr == 'N' && logged.level < 5 && item.approve_peminjaman == null"><b style="font-size:12px;">HR GA</b><v-icon small>mdi-close</v-icon></v-chip>
      <v-chip v-show="item.acc_hr == null && logged.level != 4 && item.approve_peminjaman == null"><b style="font-size:12px;">Menunggu</b></v-chip>
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
      <v-chip v-show="item.approve_peminjaman == 'ACC'">
      <v-icon
      small
      class="ma-2"
      color="green">
        mdi-check-outline
      </v-icon>
      </v-chip>

      <v-chip v-show="item.approve_peminjaman == 'REJECT'">
      <v-icon
      small
      class="ma-2"
      color="red darken-4">
        mdi-close-outline
      </v-icon>
      </v-chip>
    </template>
    <template v-slot:[`item.pengembalian`]="{ item }">
      <v-btn class="mr-4" v-show="item.approve_peminjaman == 'ACC' && (logged.level == 2 || logged.level == 3)" icon>
      <v-icon
      small
      v-show="item.pengembalian == null"
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
      <v-chip v-show="logged.level == 1 || logged.level == 4 ||  logged.level == 5"><b style="font-size:12px;">Menunggu</b></v-chip>
      <v-chip v-show="(logged.level == 2 || logged.level == 3) && item.approve_peminjaman == null"><b style="font-size:12px;">Menunggu</b></v-chip>
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
      <v-chip>Mohon Tunggu</v-chip>
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
  export default {
    data: () => ({
      dialog: false,
      search:'',
      listoken:[],
      SelectPerson:[],
      listmanager:[],
      stored:[],
      device:null,
      dialogAlertManager:false,
      loading: true,
      logged:[],
      dialogDelete: false,
      headers: [
        { text: 'No Refrensi', value: 'id_form_peminjaman'},
        { text: 'Tanggal Peminjaman', value: 'TanggalPeminjaman'},
        {
          text: 'Penanggung Jawab',
          align: 'start',
          value: 'penanggung_jawab',
        },
        { text: 'Department', value: 'department.nama_department' },
        { text: 'Model Kendaraan', value: 'aset.nama_aset' },
        { text: 'No Pol', value: 'aset.no_plat' },
        { text: 'Actions', value: 'actions', sortable: false , align: 'start',},
        { text: 'Approve', value:'approve_peminjaman', align:'center'},
        { text: 'Pengembalian', value:'pengembalian', align:'center'},
        { text: 'Berkas', value:'print', align:'center'}
      ],
      desserts: [],
      DataPeminjaman:[],
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
      this.getDataPeminjaman()
    },
    mounted(){
      this.device = this.$device
      this.getManager()
    },

    methods: {
        filter (value, search) {
        search = search.toString().toLocaleLowerCase()
        return value != null &&
          search != null &&
          typeof value === 'string' &&
          value.toString().toLocaleLowerCase().indexOf(search) !== -1
      },
      getDataPeminjaman(){
        this.Seen()
        API.get("/formpeminjaman").then(x=>{
          x.data.forEach(z => {
            z.TanggalPeminjaman = this.$DateConvert(z.tgl_peminjaman)
          });
          this.DataPeminjaman = x.data.reverse()
          this.loading = false
        })
      },
      Seen(){
        API.get('seen/peminjaman/'+this.logged.id_user)
      },
      openAksi(x){
        console.log(x)
        this.$Store(x)
        // const suara = require('../assets/SuaraNotif.mpeg')
        this.$ChangeURL('Peminjaman/'+x.id_form_peminjaman)
      },
      accHRGA(x){
        this.$loading(true)
        x.accby = JSON.parse(localStorage.getItem('logged')).nama_lengkap
        x.title = 'Approve'
        API.put("/approveformpeminjaman/"+x.id_form_peminjaman,{
              AccBy:'HRGA',
              AccHR:x.accby,
              IdAset:x.aset.id_aset,
            }).then(c=>{
          console.log(c)
          this.$loading(false)
          // this.KirimNotif(x)
          this.stored = x
          this.dialogAlertManager = true
          this.loading = true
          this.getDataPeminjaman()
          this.$Toast('success','Approve By HRGA')
        })
      },
      async getManager(){
        API.get('user').then(x=>{
          this.userlist = x.data
          let dt = x.data
          let dtf = dt.filter(x => x.level == 5)
          this.listmanager = dtf
        })
      },
      cancelHRGA(x){
        this.$loading(true)
        x.accby = JSON.parse(localStorage.getItem('logged')).nama_lengkap
        x.title = 'Reject'
        API.put("/approveformpeminjaman/"+x.id_form_peminjaman,{
              AccBy:x.accby,
              AccHR:'N',
              Approve:'REJECT',
              IdAset:x.aset.id_aset,
            }).then(c=>{
            this.$loading(false)
            console.log(c)
            this.KirimNotif(x)
            this.loading = true
            this.getDataPeminjaman()
            this.$Toast('success','Cancel By HRGA')
        })
      },
      Generate(){
        this.KirimNotif(this.stored)
        this.dialogAlertManager = false
      },
      accManager(x){
        this.$loading(true)
        x.accby = JSON.parse(localStorage.getItem('logged')).nama_lengkap
        x.title = 'Approve'
        API.put("/approveformpeminjaman/"+x.id_form_peminjaman,{
              AccBy:'Manager',
              AccManager:x.accby,
              Approve:'ACC',
              IdAset:x.aset.id_aset,
            }).then(c=>{
          this.$loading(false)
          console.log(c)
          this.KirimNotif(x)
          this.loading = true
          this.getDataPeminjaman()
          this.$Toast('success','Approve By Manager')
        })
      },
      cancelManager(x){
        this.$loading(true)
        x.accby = JSON.parse(localStorage.getItem('logged')).nama_lengkap
        x.title = 'Reject'
        API.put("/approveformpeminjaman/"+x.id_form_peminjaman,{
              AccBy:x.accby,
              AccManager:'N',
              Approve:'REJECT',
              IdAset:x.aset.id_aset,
            }).then(c=>{
            this.$loading(false)
            console.log(c)
            this.KirimNotif(x)
            this.loading = true
            this.getDataPeminjaman()
            this.$Toast('success','Reject By Manager')
        })
      },
      ToPengembalian(x){
        this.$Store(x)
        this.$ChangeURL('FormPengembalianPeminjaman/'+x.id_form_peminjaman)
      },
      ToPrint(x){
        this.$Store(x)
        this.$ChangeURL('SuratPengajuanPeminjaman/'+x.id_form_peminjaman)
      },

      async KirimNotif(x){
        // let listoken = [];
        const eventref = firebase.database().ref("userlevel/"+this.SelectPerson.level+"/"+this.SelectPerson.id_user); // HRGA
        let snapshot = await eventref.once('value');
        // firebase.database().ref("alluser").on('value', snapshot => {
                let dx = snapshot.val();
                Object.keys(dx).forEach(key => {
                this.listoken.push(dx[key]);
                });
            // })
        let data = {
          "registration_ids":this.listoken, 
            "notification" : {
                    "title": x.title+" Peminjaman",
                    "body": x.accby+' '+x.title+" Peminjaman Pengajuan dari "+x.penanggung_jawab+" Peminjaman Kendaraan "+x.aset.jenis_aset+' '+x.aset.nama_aset+' '+x.aset.no_plat,
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
