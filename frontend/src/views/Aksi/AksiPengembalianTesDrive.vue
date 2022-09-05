<template>
  <v-container fluid fill-height :style="{backgroundColor:'#c8d2d8'}">
    <v-card class="mx-auto ma-2 pa-2" elevation="3" width="1150px">
      <v-sheet class="mb-7 pa-2 d-flex justify-start">
        <v-card class="pa-2 text-overline text-center" width="215px" dark color="#a10115"><span><b>Pengembalian Tes Drive</b></span></v-card>
      </v-sheet>
    <v-row>
      <v-col cols="6" md="3" sm="6" xs="6">
        <v-text-field
        color="#d72c16"
        prepend-icon="mdi-numeric-1-box-multiple-outline"
        label="No Referensi"
        v-model="NoRefrensi"
        readonly/>
      </v-col>

      <v-col cols="6" md="3" sm="6" xs="6">
        <v-text-field
        color="#d72c16"
        prepend-icon="mdi-account-hard-hat-outline"
        label="Penanggung Jawab"
        v-model="PenanggungJawab"
        readonly/>
      </v-col>

      <v-col cols="6" md="3" sm="6" xs="6">
        <v-text-field
        color="#d72c16"
        prepend-icon="mdi-clock-time-four-outline"
        label="Jam Keluar"
        v-model="JamKeluar"
        readonly/>
      </v-col>

      <v-col cols="6" md="3" sm="6" xs="6">
        <v-text-field
        persistent-hint
        hint="*Jam sesuai pengembalian kendaraan"
        color="#d72c16"
        prepend-icon="mdi-clock-time-four-outline"
        label="Jam Masuk"
        v-model="JamMasuk"
        readonly/>
      </v-col>

      <v-col cols="6" md="3" sm="6" xs="6">
          
      </v-col>

      <v-col cols="6" md="3" sm="12">
        <v-text-field
        color="#d72c16"
        prepend-icon="mdi-office-building-outline"
        label="Department"
        v-model="Department"
        readonly/>
      </v-col>

      <v-col cols="6" md="3" sm="6" xs="6">
        <v-text-field
        color="#d72c16"
        prepend-icon="mdi-office-building-outline"
        label="Tgl Tes Drive"
        v-model="TanggalPeminjaman"
        readonly/>
      </v-col>

      <v-col cols="6" md="3" sm="6" xs="6">
        <v-text-field
        color="#d72c16"
        prepend-icon="mdi-office-building-outline"
        label="Tgl Kembali Kendaraan"
        v-model="TanggalKembali"
        readonly/>
      </v-col>

<!--Kolom data lengkap Tes drive-->
<v-card class=" mx-5 text-overline text-center" width="195px" dark color="grey"><span><b>Data Awal Tes Drive</b></span></v-card>
<v-col cols="12" v-show="device == 'Desktop'">
        <v-simple-table>
    <template v-slot:default>
      <thead>
        <tr>
          <th class="text-left">
            Nama Customer
          </th>
          <th class="text-left">
            Model Kendaraan
          </th>
          <th class="text-left">
            Nomor Polisi
          </th>
          <th class="text-left">
            Kilometer
          </th>
          <th class="text-left">
            BBM
          </th>
          <th class="text-left">
            Kebersihan Interior
          </th>
          <th class="text-left">
            Kebersihan Eksterior
          </th>
          <th class="text-left">
            Fisik Kendaraan
          </th>
          <th class="text-left">
            Lokasi Tes Drive
          </th>
        </tr>
      </thead>
      <tbody>
        <tr
        >
          <td>{{NamaCustomer}}</td>
          <td>{{ModelKendaraan}}</td>
          <td>{{NoPol}}</td>
          <td>{{KondisiKilometer}}</td>
          <td>{{KondisiBBM}}</td>
          <td>{{KondisiAwalKebersihanInterior}}</td>
          <td>{{KondisiAwalKebersihanEksterior}}</td>
          <td>{{KondisiFisik}}</td>
          <td>{{LokasiTesDrive}}</td>
        </tr>
      </tbody>
    </template>
  </v-simple-table>
      </v-col>
<!--kolom data lengkap Pengembalian-->
<v-card class=" mx-5 text-overline text-center" width="270px" dark color="grey"><span><b>Data Pengembalian Tes Drive</b></span></v-card>
      <v-col cols="12" v-show="device == 'Desktop'">
        <v-simple-table>
    <template v-slot:default>
      <thead>
        <tr>
          <th class="text-left">
            Kilometer
          </th>
          <th class="text-left">
            BBM
          </th>
          <th class="text-left">
            Kebersihan Interior
          </th>
          <th class="text-left">
            Kebersihan Eksterior
          </th>
          <th class="text-left">
            Fisik Kendaraan
          </th>
          <th class="text-left">
            Lokasi Tes Drive
          </th>
        </tr>
      </thead>
      <tbody>
        <tr
        >
          <td>{{KondisiAkhirKilometer}}</td>
          <td>{{KondisiAkhirBBM}}</td>
          <td>{{KondisiAkhirKebersihanInterior}}</td>
          <td>{{KondisiAkhirKebersihanEksterior}}</td>
          <td>{{KondisiAkhirFisik}}</td>
          <td>{{LokasiTesDrive}}</td>
        </tr>
      </tbody>
    </template>
  </v-simple-table>
      </v-col>

      <!-- ini mobile -->
      <v-col cols="12" v-show="device == 'Mobile'">
       <v-simple-table  class="mt-n6">
        <template v-slot:default>
          <tbody>
          <tr>
            <th>Kondisi Awal Kilometer</th>
            <td>{{KondisiKilometer}}</td>
          </tr>
          <tr>
            <th>Kondisi Awal BBM</th>
            <td>{{KondisiBBM}}</td>
          </tr>
          <tr>
            <th>Kondisi Awal Kebersihan</th>
            <td>{{KondisiAwalKebersihanInterior}}</td>
          </tr>
          <tr>
            <th>Kondisi Awal Fisik Kendaraan</th>
            <td>{{KondisiFisik}}</td>
          </tr>
          <tr>
            <th>Lokasi Tes drive</th>
            <td>{{LokasiTesDrive}}</td>
          </tr>
          </tbody>
        </template>
      </v-simple-table>
        <!-- <table style="width:100%">
         
        </table> -->
      </v-col>
    </v-row>
      <v-card-actions>
        <v-spacer/>
        <v-tooltip bottom>
        <template v-slot:activator="{ on, attrs }">
        <v-btn
          class="ma-2"
          v-on="on"
          v-bind="attrs"
          color="#a10115"
          dark
          icon
        >
          <v-icon
          large
            dark
            right
            @click="ChangeURL('PengembalianTesDrive')"
          >
          mdi-close-circle-outline
          </v-icon>
        </v-btn>
        </template>
         <span>Close</span>
        </v-tooltip>
      </v-card-actions>
    </v-card>
  </v-container>
</template>
<script>
import axios from 'axios'
import firebase from "@/services/firebase-sw"
import API from "@/services/http";
  export default {
    data: () => ({
      PenanggungJawab: null,
      Department: null,
      NamaCustomer:null,
      AsetData:[],
      device:null,
      overlay:false,
      NoPol:null,
      TanggalPeminjaman:null,
      TanggalKembali:null,
      NoRefrensi:null,
      ModelKendaraan:null,
      JamKeluar:null,
      JamMasuk:null,
      KondisiKilometer:null,
      KondisiBBM:null,
      KondisiAwalKebersihanInterior:null,
      KondisiAwalKebersihanEksterior:null,
      KondisiFisik:null,
      LokasiTesDrive:null,
      KondisiAkhirKilometer:null,
      KondisiAkhirBBM:null, //ini M nya besar
      KondisiAkhirKebersihanInterior:null,
      KondisiAkhirKebersihanEksterior:null,
      KondisiAkhirFisik:null,
      TanggalPemakaian:(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
      menu: false,
      modal: false,
      menu2: false,
      checkbox: false,
    }),
    created(){
     this.$loading(true)
      let data = this.$CekStore() == null ? [] : this.LocalData() // ini data yang dibawa dari table di cek disini
      if(typeof data == 'object'){ this.GetData(this.$route.params.id) }else{ this.LocalData() }
      // console.log(data)
      
      this.getAset()
    },
    mounted(){
      this.device = this.$device
    },
    watch: {
      //
    },
    methods: {
      getAset(){
        API.get('/aset').then(x=>{
          this.AsetData = x.data
          this.$loading(false)
        })
      },
      Save() {
        if(this.ModelKendaraan != null 
        && this.PenanggungJawab != null 
        && this.NamaCustomer != null 
        && this.KondisiBBM != null 
        && this.KondisiKilometer != null
        && this.KondisiAwalKebersihanInterior != null
        && this.KondisiAwalKebersihanEksterior != null
        && this.KondisiFisik != null
        && this.LokasiTesDrive != null
        && this.TanggalPemakaian != null){
          this.overlay = true
            API.post('/formtesdrive',{
              IdAset:this.ModelKendaraan,
              IdDepartment:this.Department.id_department,
              PenanggungJawab:this.PenanggungJawab,
              NamaCustomer:this.NamaCustomer,
              KondisiBBM:this.KondisiBBM,
              KondisiKM:this.KondisiKilometer,
              KondisiKebersihan:'Interior : '+this.KondisiAwalKebersihanInterior+' / Eksterior : '+this.KondisiAwalKebersihanEksterior,
              KondisiFisik:this.KondisiFisik,
              LokasiTesDrive:this.LokasiTesDrive,
              TanggalPemakaian:this.TanggalPemakaian,
            }).then(x=>{
              this.KirimNotif()
              this.Reset()
              console.log(x)
              this.overlay = false
              this.$ChangeURL('TesDrive')
              this.$Toast('success','Pengajuan Dibuat')
            })
        }else{
          this.$Toast('error','Pastikan Semua Terisi')
        }
      },
      ChangeURL(x){
        this.$ChangeURL(x)
      },
      GetData(x){
      API.get('pengembaliantesdrive/'+x).then(x=>{
        let data = x.data
        console.log(data)
        this.PenanggungJawab = data.tesdrive.penanggung_jawab
        this.NamaCustomer = data.tesdrive.nama_customer
        this.NoRefrensi = data.tesdrive.id_form_tes_drive
        this.ModelKendaraan = data.tesdrive.aset.nama_aset
        this.JamKeluar = data.tesdrive.jam_keluar_kendaraan
        this.JamMasuk = data.jam_masuk_kendaraan
        this.NoPol = data.tesdrive.aset.no_plat
        this.TanggalPeminjaman = data.tesdrive.tanggal_pemakaian
        this.TanggalKembali = data.tanggal_pengembalian
        this.KondisiBBM = data.tesdrive.kondisi_awal_bbm
        this.Department = data.tesdrive.department.nama_department
        this.KondisiKilometer = data.tesdrive.kondisi_awal_kilometer
        this.KondisiFisik = data.tesdrive.kondisi_awal_fisik_kendaraan
        this.KondisiAwalKebersihanInterior = data.tesdrive.kondisi_awal_kebersihan_interior
        this.KondisiAwalKebersihanEksterior = data.tesdrive.kondisi_awal_kebersihan_eksterior
        this.LokasiTesDrive = data.tesdrive.lokasi_tes_drive
        this.KondisiAkhirKilometer = data.kondisi_akhir_kilometer
        this.KondisiAkhirBBM = data.kondisi_akhir_bbm
        this.KondisiAkhirKebersihanInterior = data.kondisi_akhir_kebersihan_interior
        this.KondisiAkhirKebersihanEksterior = data.kondisi_akhir_kebersihan_eksterior
        this.KondisiAkhirFisik = data.kondisi_akhir_fisik_kendaraan
        this.TanggalSurat = this.$DateConvert(data.tanggal_pemakaian)
        this.$loading(false)
      })
     },

      LocalData(){
      let data = this.$CekStore()
        this.PenanggungJawab = data.tesdrive.penanggung_jawab
        this.NamaCustomer = data.tesdrive.nama_customer
        this.NoRefrensi = data.tesdrive.id_form_tes_drive
        this.ModelKendaraan = data.tesdrive.aset.nama_aset
        this.JamKeluar = data.tesdrive.jam_keluar_kendaraan
        this.JamMasuk = data.jam_masuk_kendaraan
        this.NoPol = data.tesdrive.aset.no_plat
        this.TanggalPeminjaman = data.tesdrive.tanggal_pemakaian
        this.TanggalKembali = data.tanggal_pengembalian
        this.KondisiBBM = data.tesdrive.kondisi_awal_bbm
        this.Department = data.tesdrive.department.nama_department
        this.KondisiKilometer = data.tesdrive.kondisi_awal_kilometer
        this.KondisiFisik = data.tesdrive.kondisi_awal_fisik_kendaraan
        this.KondisiAwalKebersihanInterior = data.tesdrive.kondisi_awal_kebersihan_interior
        this.KondisiAwalKebersihanEksterior = data.tesdrive.kondisi_awal_kebersihan_eksterior
        this.LokasiTesDrive = data.tesdrive.lokasi_tes_drive
        this.KondisiAkhirKilometer = data.kondisi_akhir_kilometer
        this.KondisiAkhirBBM = data.kondisi_akhir_bbm
        this.KondisiAkhirKebersihanInterior = data.kondisi_akhir_kebersihan_interior
        this.KondisiAkhirKebersihanEksterior = data.kondisi_akhir_kebersihan_eksterior
        this.KondisiAkhirFisik = data.kondisi_akhir_fisik_kendaraan
        this.TanggalSurat = this.$DateConvert(data.tanggal_pemakaian)
        this.$loading(false)
     },
      KirimNotif(){
        let kendaraan = this.AsetData.find(data=>data.id_aset==this.ModelKendaraan).nama_aset
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
                    "title": "Pengajuan Tes Drive",
                    "body": "Pengajuan dari "+this.PenanggungJawab+" Tes Drive Kendaraan "+kendaraan,
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
        this.TanggalPemakaian = (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)
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