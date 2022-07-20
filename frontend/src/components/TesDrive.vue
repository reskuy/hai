<template>
<v-card height="100hv">
  <v-data-table
    :headers="headers"
    :items="DataTesDrive"
    :search="search"
    class="elevation-4"
    :custom-filter="filter"
  >
    <template v-slot:top>
      <v-toolbar
      color="#a10115"
      elevation="4"
      dark
      >
        <v-toolbar-title>Data Tes Drive</v-toolbar-title>
        <v-divider
          class="mx-4"
          vertical
        ></v-divider>
        <v-text-field
        prepend-icon="mdi-magnify"
        class="mt-6"
          v-model="search"
          label="Pencarian"
        ></v-text-field>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5">Are you sure you want to delete this item?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text>Cancel</v-btn>
              <v-btn color="blue darken-1" text>OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
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
      <!-- <v-icon
      small
        @click="deleteItem(item)"
      >
        mdi-delete
      </v-icon> -->
    </template>
    <template v-slot:[`item.approve_form_tes_drive`]="{ item }">
      <!-- ini untuk hr approve -->
      <v-icon
      small
      v-show="item.acc_hr == null && logged.level == 2"
      color="green"
      class="ma-2"
      @click="accHRGA(item)"
      >
        mdi-check-outline
      </v-icon>
      <v-divider v-show="item.acc_hr == null  && logged.level == 2"/>
      <v-icon
      small
      v-show="item.acc_hr == null && logged.level == 2"
      color="red"
      class="ma-2"
      @click="cancelHRGA(item)"
      >
        mdi-close-outline
      </v-icon>
      <p v-show="item.acc_hr == 'Y' && logged.level < 3 && item.approve_form_tes_drive == null">HR GA<v-icon small>mdi-check</v-icon></p>
      <p v-show="item.acc_hr == 'N' && logged.level < 3 && item.approve_form_tes_drive == null">HR GA<v-icon small>mdi-close</v-icon></p>
      <!-- end of hr approve -->

      <!-- ini untuk manager approve -->
      <v-icon
      small
      v-show="item.acc_manager == null && logged.level == 3"
      color="green"
      class="ma-2"
      @click="accManager(item)"
      >
        mdi-check-outline
      </v-icon>
      <v-divider v-show="item.acc_manager == null  && logged.level == 3"/>
      <v-icon
      small
      v-show="item.acc_manager == null && logged.level == 3"
      color="red"
      class="ma-2"
      @click="cancelManager(item)"
      >
        mdi-close-outline
      </v-icon>
      <!-- end of manager approve -->

      <v-icon
      small
      v-show="item.approve_form_tes_drive == 'ACC'"
      class="ma-2"
      color="green">
        mdi-check-outline
      </v-icon>

      <v-icon
      small
      v-show="item.approve_form_tes_drive == 'REJECT'"
      class="ma-2"
      color="red darken-4">
        mdi-close-outline
      </v-icon>
    </template>
    <template v-slot:no-data>
      <span>Mohon Tunggu</span>
    </template>
  </v-data-table>
</v-card>
</template>
<script>
import axios from 'axios'
import firebase from "@/services/firebase-sw"
import API from "@/services/http";
// import SuaraNotif from '../assets/SuaraNotif.mpeg'
  export default {
    data: () => ({
      dialog: false,
      search:'',
      logged:[],
      dialogDelete: false,
      headers: [
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
        { text: 'Approve', value:'approve_form_tes_drive'}
      ],
      desserts: [],
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
      this.getDataTesDrive()
    },
    mounted(){
      this.logged = this.$SetLog()
      console.log(this.logged)
    },

    methods: {
      openAksi(x){
        console.log(x)
        // const suara = require('../assets/SuaraNotif.mpeg')
        this.$ChangeURL('TesDrive/'+x.id_form_tes_drive)
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
      getDataTesDrive(){
        this.$loading(true)
        API.get("/formtesdrive").then(x=>{
          x.data.forEach(z => {
            z.Tanggal = this.$DateConvert(z.tanggal_pemakaian)
          });
          this.DataTesDrive = x.data.reverse()
          this.$loading(false)
        })
      },
      accHRGA(x){
        this.$loading(true)
        x.accby = 'HRGA'
        x.title = 'Approve'
        API.put("/approveformtesdrive/"+x.id_form_tes_drive,{
              AccBy:x.accby,
              AccHR:'Y',
              IdAset:x.aset.id_aset,
            }).then(c=>{
          console.log(c)
          this.KirimNotif(x)
          this.getDataTesDrive()
          this.$Toast('success','Approve By HRGA')
        })
      },
      cancelHRGA(x){
        this.$loading(true)
        x.accby = 'HRGA'
        x.title = 'Reject'
        API.put("/approveformtesdrive/"+x.id_form_tes_drive,{
              AccBy:x.accby,
              AccHR:'N',
              Approve:'REJECT',
              IdAset:x.aset.id_aset,
            }).then(c=>{
            console.log(c)
            this.KirimNotif(x)
            this.getDataTesDrive()
            this.$Toast('success','Cancel By HRGA')
        })
      },
      accManager(x){
        this.$loading(true)
        x.accby = 'Manager'
        x.title = 'Approve'
        API.put("/approveformtesdrive/"+x.id_form_tes_drive,{
              AccBy:'Manager',
              AccManager:'Y',
              Approve:'ACC',
              IdAset:x.aset.id_aset,
            }).then(c=>{
          console.log(c)
          this.KirimNotif(x)
          this.getDataTesDrive()
          this.$Toast('success','Approve By Manager')
        })
      },
      cancelManager(x){
        this.$loading(true)
        x.accby = 'Manager'
        x.title = 'Reject'
        API.put("/approveformtesdrive/"+x.id_form_tes_drive,{
              AccBy:'Manager',
              AccManager:'N',
              Approve:'REJECT',
              IdAset:x.aset.id_aset,
            }).then(c=>{
            console.log(c)
            this.KirimNotif(x)
            this.getDataTesDrive()
            this.$Toast('success','Cancel By Manager')
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
    },
  }
</script>
