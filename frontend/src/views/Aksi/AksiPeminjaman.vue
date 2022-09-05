<template>
  <v-container fluid fill-height :style="{backgroundColor:'#c8d2d8'}">
    <v-card class="mx-auto ma-2 pa-2" elevation="3" width="1150px">
      <v-sheet class="mb-7 pa-2 d-flex justify-start">
        <v-card class="pa-2 text-overline text-center" width="210px" dark color="#a10115"><span><b>Pengajuan Peminjaman</b></span></v-card>
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
        persistent-hint
        hint="*estimasi jam pemakaian akan berubah sesuai approve"
        color="#d72c16"
        prepend-icon="mdi-clock-time-four-outline"
        label="Jam Keluar"
        v-model="JamKeluar"
        readonly/>
      </v-col>

      <v-col cols="6" md="3" sm="6" xs="6">
        <v-text-field
        persistent-hint
        hint="*estimasi jam akan berubah sesuai kembali kendaraan"
        color="#d72c16"
        prepend-icon="mdi-clock-time-four-outline"
        label="Jam Masuk"
        v-model="JamMasuk"
        readonly/>
      </v-col>

       <v-col cols="6" md="3" sm="6" xs="6">

       </v-col>

       <v-col cols="6" md="3" sm="6" xs="6">
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
        prepend-icon="mdi-calendar"
        label="Tanggal Pemakaian"
        v-model="TanggalPeminjaman"
        readonly/>
      </v-col>

      <v-col cols="6" md="3" sm="6" xs="6">
        <v-text-field
        persistent-hint
        hint="*tanggal akan berubah jika terlambat mengembalikan kendaraan"
        color="#d72c16"
        prepend-icon="mdi-calendar"
        label="Tanggal Kembali"
        v-model="TanggalKembali"
        readonly/>
      </v-col>

<!--kolom data lengkap-->
      <v-col cols="12" v-show="device=='Desktop'">
        <v-simple-table>
    <template v-slot:default>
      <thead>
        <tr>
          <th class="text-left">
            Tujuan
          </th>
          <th class="text-left">
            Keperluan
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
        </tr>
      </thead>
      <tbody>
        <tr
        >
          <td>{{Tujuan}}</td>
          <td>{{Keperluan}}</td>
          <td>{{ModelKendaraans}}</td>
          <td>{{NoPol}}</td>
          <td>{{KondisiAwalKilometer}}</td>
          <td>{{KondisiAwalBBM}}</td>
          <td>{{KebersihanInterior}}</td>
          <td>{{KebersihanEksterior}}</td>
          <td>{{KondisiAwalFisik}}</td>
     
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
           <tr >
            <th>Tujuan</th>
            <td>{{Tujuan}}</td>
          </tr>
          <tr>
            <th>Keperluann</th>
            <td>{{Keperluan}}</td>
          </tr>
          <tr>
            <th>Model Kendaraan</th>
            <td>{{ModelKendaraans}}</td>
          </tr>
          <tr>
            <th>Nomor Polisi</th>
            <td>{{NoPol}}</td>
          </tr>
          <tr>
            <th>Kondisi Awal Kilometer</th>
            <td>{{KondisiAwalKilometer}}</td>
          </tr>
          <tr>
            <th>Kondisi Awal BBM</th>
            <td>{{KondisiAwalBBM}}</td>
          </tr>
          <tr>
            <th>Kondisi Awal Kebersihan</th>
            <td>{{KondisiAwalKebersihan}}</td>
          </tr>
          <tr>
            <th>Kondisi Awal Fisik Kendaraan</th>
            <td>{{KondisiAwalFisik}}</td>
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
            @click="ChangeURL('Peminjaman')"
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
import API from "@/services/http"
  export default {
    data: () => ({
      PenanggungJawab: null,
      Department:null,
      NamaCustomer:null,
      AsetData:[],
      email: '',
      device:null,
      overlay:false,
      select: null,
      ModelKendaraans:null, // variabel model kendaraan
      Tujuan:null, //bikin variabel tujuan
      Keperluan:null, // bikin variabel keperluan
      NoPol:null,// bikin nopol
      KondisiAwalKilometer:null, //kondisi awal
      KondisiAwalBBM:null,//kondisi bbm
      KebersihanInterior:null,//kondisi kebersihan
      KebersihanEksterior:null,
      KondisiAwalFisik:null,//kondisi fisik
      NoRefrensi:null,
      JamKeluar:null,
      JamMasuk:null,
      LokasiTesDrive:null,
      TanggalPeminjaman:null,
      TanggalKembali:null,
      // TanggalPeminjaman:(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
      menu: false,
      modal: false,
      menu2: false,
      checkbox: false,
    }),
    created(){
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
      GetData(x){
      API.get('formpeminjaman/'+x).then(x=>{
        let data = x.data
        console.log(data)
        this.PenanggungJawab = data.penanggung_jawab
        this.Tujuan = data.tujuan // panggil data tujuan
        this.Keperluan = data.keperluan //panggil variabel keperluan, set datanya = cek data yang dikirim  ke halaman ini, data.keperluan
        this.ModelKendaraans = data.aset.nama_aset //error merah tu ada yang sama kaya di watch, jadi kubedain yang ini tambahin s
        this.NoPol = data.aset.no_plat // panggil nopol
        this.KondisiAwalKilometer = data.kondisi_awal_kilometer// kondisi kilometer
        this.KondisiAwalBBM = data.kondisi_awal_bbm//kondiai bbm
        this.KebersihanInterior = data.kondisi_awal_kebersihan_interior
        this.KebersihanEksterior = data.kondisi_awal_kebersihan_eksterior
        this.KondisiAwalFisik = data.kondisi_awal_fisik_kendaraan//kondisi fisik
        this.Department = data.department.nama_department// department
        this.TanggalPeminjaman = data.tgl_peminjaman//tanggal
        this.TanggalKembali = data.tgl_pengembalian
        this.JamKeluar = data.jam_keluar_kendaraan
        this.JamMasuk = data.jam_masuk_kendaraan
        this.NoRefrensi = data.id_form_peminjaman//no reprensi
        this.$loading(false)
      })
     },

      LocalData(){
      let data = this.$CekStore()
      this.PenanggungJawab = data.penanggung_jawab
      this.JamKeluar = data.jam_keluar_kendaraan
      this.JamMasuk = data.jam_masuk_kendaraan
        this.Tujuan = data.tujuan // panggil data tujuan
        this.Keperluan = data.keperluan //panggil variabel keperluan, set datanya = cek data yang dikirim  ke halaman ini, data.keperluan
        this.ModelKendaraans = data.aset.nama_aset //error merah tu ada yang sama kaya di watch, jadi kubedain yang ini tambahin s
        this.NoPol = data.aset.no_plat // panggil nopol
        this.KondisiAwalKilometer = data.kondisi_awal_kilometer// kondisi kilometer
        this.KondisiAwalBBM = data.kondisi_awal_bbm//kondiai bbm
        this.KebersihanInterior = data.kondisi_awal_kebersihan_interior
        this.KebersihanEksterior = data.kondisi_awal_kebersihan_eksterior
        this.KondisiAwalFisik = data.kondisi_awal_fisik_kendaraan//kondisi fisik
        this.Department = data.department.nama_department// department
        this.TanggalPeminjaman = data.tgl_peminjaman//tanggal
        this.TanggalKembali = data.tgl_pengembalian
        this.NoRefrensi = data.id_form_peminjaman//no reprensi
        this.$loading(false)
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