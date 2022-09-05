<template>
  <v-container fluid :style="{backgroundColor:'#c8d2d8'}">
    <v-card class="mx-auto ma-2 pa-2" elevation="3" width="1150px">
      <v-sheet class="mb-7 pa-2 d-flex justify-start">
        <v-card class="pa-2 text-overline text-center" width="259px" dark color="#a10115"><span>Form Pengembalian Tes Drive</span></v-card>
      </v-sheet>
    <v-row>
        <v-col cols="4">
        <v-subheader>Penanggung Jawab</v-subheader>
      </v-col>
      <v-col cols="8">
        <v-text-field
        color="#d72c16"
        label="Nama"
        v-model="PenanggungJawab"
        readonly/>
      </v-col>

      <v-col cols="4">
        <v-subheader>Department</v-subheader>
      </v-col>
      <v-col cols="8">
        <v-text-field
        color="#d72c16"
        label="Department"
        v-model="Department"
        readonly/>
      </v-col>

      <v-col cols="4">
        <v-subheader>Kendaraan</v-subheader>
      </v-col>
      <v-col cols="8">
        <v-text-field
        color="#d72c16"
        v-model="Kendaraan"
        label="Sesuai Tipe Kendaraan yang di Pilih"
        readonly/>
      </v-col>

      <v-col cols="4">
        <v-subheader>Nomor Polisi</v-subheader>
      </v-col>
      <v-col cols="8">
        <v-text-field
        color="#d72c16"
        v-model="NoPol"
        label="Sesuai Tipe Kendaraan yang di Pilih"
        readonly/>
      </v-col>

      <v-col cols="4">
        <v-subheader>Kondisi Akhir Kilometer</v-subheader>
      </v-col>
      <v-col cols="8">
        <v-text-field
          color="#d72c16"
          v-model="KondisiKilometer"
          label="Isi Kilometer"
          value="0"
          suffix="KM"
        ></v-text-field>
      </v-col>

      <v-col cols="4">
        <v-subheader>Kondisi Akhir BBM</v-subheader>
      </v-col>
      <v-col cols="8">
        <v-text-field
        color="#d72c16"
          v-model="KondisiBBM"
          label="Isi Bahan Bakar"
          value="0"
          suffix="Bar"
        ></v-text-field>
      </v-col>

      <v-col cols="4">
        <v-subheader>Kondisi Akhir Kebersihan</v-subheader>
      </v-col>
      <v-col cols="4">
        <v-text-field
        color="#d72c16"
          v-model="KondisiAwalKebersihanInterior"
          label="Interior"
        ></v-text-field>
      </v-col>
      <v-col cols="4">
        <v-text-field
        color="#d72c16"
          v-model="KondisiAwalKebersihanEksterior"
          label="Eksterior"
        ></v-text-field>
      </v-col>

      <v-col cols="4">
        <v-subheader>Kondisi Akhir Fisik Kendaraan</v-subheader>
      </v-col>
      <v-col cols="8">
        <v-text-field
        color="#d72c16"
        label="Kondisi"
        v-model="KondisiFisik"/>
      </v-col>

      <v-col cols="4">
        <v-subheader>Tanggal Pengembalian</v-subheader>
      </v-col>
      <v-col cols="8">
          <v-menu
          color="#d72c16"
          v-model="menu2"
          :close-on-content-click="false"
          transition="scale-transition"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-text-field
            color="#d72c16"
              v-model="TanggalPengembalian"
              label="Tanggal Pengembalian"
              prepend-icon="mdi-calendar"
              readonly
              v-bind="attrs"
              v-on="on"
            ></v-text-field>
          </template>
          <v-date-picker
          color="#d72c16"
            v-model="TanggalPengembalian"
            @input="menu2 = false"
          ></v-date-picker>
        </v-menu>
      </v-col>
    </v-row>
      <v-card-actions>
        <v-tooltip top>
          <template v-slot:activator="{ on, attrs }">
          <v-icon 
          large
           v-bind="attrs"
           v-on="on" 
           class="ml-3 mt-4" 
           style="color: black;" 
           @click="BackToTesDrive">mdi-arrow-left-circle-outline</v-icon>
           </template>
           <span>Back</span>
           </v-tooltip>
          <v-spacer></v-spacer>
        <v-tooltip top>
          <template v-slot:activator="{ on, attrs }">
          <v-icon 
          large
           v-bind="attrs"
           v-on="on" 
           class="mr-3 mt-4" 
           @click="Reset()">mdi-close-circle-outline</v-icon>
           </template>
           <span>Reset</span>
           </v-tooltip>
        <v-tooltip top>
          <template v-slot:activator="{ on, attrs }">
          <v-icon 
          large
          v-bind="attrs"
          v-on="on"
          class="mr-3 mt-4" 
          style="color:#a10115;"
          @click="Save()">mdi-checkbox-marked-circle-outline</v-icon>
          </template>
          <span>Save</span>
          </v-tooltip>
      </v-card-actions>
    </v-card>
  </v-container>
</template>
<script>
import axios from 'axios'
import firebase from "@/services/firebase-sw"
import API from "@/services/http"
  export default {
    data: () => ({
      PenanggungJawab:null,
      Department: null,
      NamaCustomer:null,
      AsetData:[],
      email: '',
      overlay:false,
      NoPol:null,
      select: null,
      Kendaraan:null,
      device:null,
      IdFormTesDrive:null,
      KondisiKilometer:null,
      KondisiBBM:null,
      KondisiAwalKebersihanInterior:null,
      KondisiAwalKebersihanEksterior:null,
      KondisiFisik:null,
      LokasiTesDrive:null,
      TanggalPengembalian:(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
      menu: false,
      modal: false,
      menu2: false,
      checkbox: false,
    }),
    created(){
      this.device = this.$device
      this.$loading(true)
      let data = this.$CekStore() == null ? [] : this.LocalData() // ini data yang dibawa dari table di cek disini
      if(typeof data == 'object'){ this.GetData(this.$route.params.id) }else{ this.LocalData() }
      this.getAset()
    },
    mounted(){
      this.device = this.$device
    },
    watch: {
      ModelKendaraan(x){
        this.NoPol= x != null ? this.AsetData.find(data=>data.id_aset==x).no_plat : null
      }
    },
    methods: {
      getAset(){
        API.get('/aset').then(x=>{
          this.AsetData = x.data
          this.$loading(false)
        })
      },
      BackToTesDrive(){
        this.$Store(null)
        this.ChangeURL('TesDrive')
      },
      GetData(x){
      API.get('formpeminjaman/'+x).then(x=>{
        let data = x.data
        console.log(data)
        this.PenanggungJawab = data.penanggung_jawab
        this.Department = data.department.nama_department
        this.Kendaraan = data.aset.nama_aset
        this.NoPol = data.aset.no_plat
        this.IdFormTesDrive = data.id_form_tes_drive
        this.$loading(false)
      })
     },

      LocalData(){
      let data = this.$CekStore()
        this.PenanggungJawab = data.penanggung_jawab
        this.Department = data.department.nama_department
        this.Kendaraan = data.aset.nama_aset
        this.NoPol = data.aset.no_plat
        this.IdFormTesDrive = data.id_form_tes_drive
        this.$loading(false)
     },
      Save() {
          this.overlay = true
            API.post('/pengembaliantesdrive',{
              IdFormTesDrive:this.IdFormTesDrive,
              KondisiAkhirBBM:this.KondisiBBM,
              KondisiKilometer:this.KondisiKilometer,
              KondisiAkhirKebersihanInterior:this.KondisiAwalKebersihanInterior,
              KondisiAkhirKebersihanEksterior:this.KondisiAwalKebersihanEksterior,
              KondisiAkhirFisik:this.KondisiFisik,
              TanggalPengembalian:this.TanggalPengembalian,
            }).then(x=>{
              this.KirimNotif()
              // this.Reset()
              console.log(x)
              this.overlay = false
              this.$ChangeURL('PengembalianTesDrive')
              this.$Toast('success','Pengembalian Dibuat')
            })
      },
      ChangeURL(x){
        this.$ChangeURL(x)
      },
      KirimNotif(){
        let kendaraan = this.Kendaraan
        let listoken = [];
        firebase.database().ref("level4").on('value', snapshot => {
                let dx = snapshot.val();
                Object.keys(dx).forEach(key => {
                listoken.push(dx[key]);
                });
            })
        let data = {
          "registration_ids":listoken, 
            "notification" : {
                    "title": "Pengembalian Pengajuan Tes Drive",
                    "body": "Pengembalian Pengajuan dari "+this.PenanggungJawab+" Mengembalikan Tes Drive Kendaraan "+kendaraan,
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
      NamaAset(x){
        return x.nama_aset + ' — ' + x.no_plat
      },
      IdAset(x){
        return x.id_aset
      },
      Reset(){
        this.NamaCustomer = null
        this.ModelKendaraan = null
        this.NoPol = null
        this.KondisiKilometer = null
        this.KondisiBBM = null
        this.KondisiAwalKebersihanInterior = null
        this.KondisiAwalKebersihanEksterior = null
        this.KondisiFisik = null
        this.TanggalPengembalian = (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)
        this.LokasiTesDrive = null
      },
    },
  }
</script>
<style scoped>
body{
  background-color:aqua;
}
</style>