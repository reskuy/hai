<template>
  <v-container fluid :style="{backgroundColor:'#c0b2b5'}">
    <v-card class="mx-auto ma-2 pa-2" elevation="3" width="1150px">
      <!-- <v-toolbar width="270px" color="#a10115" dark class="mb-10 text-overline"><center><span>Form Pengajuan Peminjaman</span></center></v-toolbar> -->
      <v-sheet class="mb-7 pa-2 d-flex justify-start">
        <v-card class="pa-2 text-overline text-center" width="259px" dark color="#a10115"><span>Form Pengajuan Peminjaman</span></v-card>
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
        v-model="Department.nama_department"
        readonly/>
      </v-col>

      <v-col cols="4">
        <v-subheader>Tujuan</v-subheader>
      </v-col>
      <v-col cols="8">
        <v-text-field
        color="#d72c16"
        label="Tujuan"
        v-model="Tujuan"/>
      </v-col>
      
      <v-col cols="4">
        <v-subheader>Keperluan</v-subheader>
      </v-col>
      <v-col cols="7">
        <v-text-field
        color="#d72c16"
        label="Keperluan"
        :disabled="KeperluanDisabled"
        v-model="Keperluan"/>
      </v-col>
      <v-col cols="1">
        <v-checkbox label="Daily" value="DAILY" v-model="StatusAset" color="red darken-4"/>
      </v-col>

      <v-col cols="4">
        <v-subheader>Model Kendaraan</v-subheader>
      </v-col>
      <v-col cols="8">
        <v-select
        color="#d72c16"
        :item-value="IdAset"
        :item-text="NamaAset"
        :items="AsetData"
        v-model="ModelKendaraan"
        label=" Pilih Tipe Kendaraan Dan Nomor Polisi"/>
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
        <v-subheader>Kondisi Awal Kilometer</v-subheader>
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
        <v-subheader>Kondisi Awal BBM</v-subheader>
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
        <v-subheader>Kondisi Awal Kebersihan</v-subheader>
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
        <v-subheader>Kondisi Awal Fisik Kendaraan</v-subheader>
      </v-col>
      <v-col cols="8">
        <v-text-field
        color="#d72c16"
        label="Kondisi"
        v-model="KondisiFisik"/>
      </v-col>

      <v-col cols="4">
        <v-subheader>Tanggal Pemakaian</v-subheader>
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
              v-model="TanggalPeminjaman"
              label="Tanggal Peminjaman"
              prepend-icon="mdi-calendar"
              readonly
              v-bind="attrs"
              v-on="on"
            ></v-text-field>
          </template>
          <v-date-picker
          color="#d72c16"
            v-model="TanggalPeminjaman"
            @input="menu2 = false"
          ></v-date-picker>
        </v-menu>
      </v-col>
    </v-row>
      <v-card-actions>
        <v-btn color="#a10115" dark @click="Reset()">Reset
          <v-icon 
          dark
          right>
            mdi-close-circle
          </v-icon>
        </v-btn>
        <v-spacer/>
        <v-btn
          class="ma-2"
          color="grey darken-2"
          dark
          @click="Save()"
        >
          Save
          <v-icon
            dark
            right
          >
            mdi-checkbox-marked-circle
          </v-icon>
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-container>
</template>
<script>
import api from "@/services/http"
import axios from "axios";
import firebase from '@/services/firebase-sw.js'
  export default {
    data: () => ({
      PenanggungJawab: localStorage.getItem("userlogged"),
      Department: JSON.parse(localStorage.getItem("departmentlogged")),
      NamaCustomer:null,
      AsetData:[],
      KeperluanDisabled:false,
      email: '',
      StatusAset:null,
      overlay:false,
      NoPol:null,
      select: null,
      Tujuan:null,
      Keperluan:null,
      ModelKendaraan:null,
      KondisiKilometer:null,
      KondisiBBM:null,
      KondisiAwalKebersihanInterior:null,
      KondisiAwalKebersihanEksterior:null,
      KondisiFisik:null,
      LokasiTesDrive:null,
      TanggalPeminjaman:(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
      menu: false,
      modal: false,
      menu2: false,
      checkbox: false,
    }),
    mounted(){
      this.getAset()
    },

    watch: {
      StatusAset(x){
        this.Keperluan = null
        if(x == 'DAILY'){
          this.Keperluan = x
          this.KeperluanDisabled = true
        }else{
          this.KeperluanDisabled = false
        }
      },
      ModelKendaraan(x){
        this.NoPol= x != null ? this.AsetData.find(data=>data.id_aset==x).no_plat : null
      }
    },
    methods: {
      getAset(){
        api.get('aset').then(x=>{
          x.data = x.data.filter(c=>c.status_aset == 'READY' || c.status_aset == 'DAILY')
          this.AsetData = x.data
        })
      },
      Save() {
        if(this.ModelKendaraan == null){return this.$Toast('error','Pastikan Semua Semua Terisi')}
        if(this.Department == null){return this.$Toast('error','Pastikan Semua Semua Terisi')}
        if(this.PenanggungJawab == null){return this.$Toast('error','Pastikan Semua Semua Terisi')}
        if(this.Keperluan == null){return this.$Toast('error','Pastikan Semua Semua Terisi')}
        if(this.Tujuan == null){return this.$Toast('error','Pastikan Semua Semua Terisi')}
        if(this.KondisiBBM == null){return this.$Toast('error','Pastikan Semua Semua Terisi')}
        if(this.KondisiKilometer == null){return this.$Toast('error','Pastikan Semua Semua Terisi')}
        if(this.KondisiAwalKebersihanInterior == null){return this.$Toast('error','Pastikan Semua Semua Terisi')}
        if(this.KondisiAwalKebersihanEksterior == null){return this.$Toast('error','Pastikan Semua Semua Terisi')}
        if(this.KondisiFisik == null){return this.$Toast('error','Pastikan Semua Semua Terisi')}
        if(this.TanggalPeminjaman == null){return this.$Toast('error','Pastikan Semua Semua Terisi')}
          this.overlay = true
            api.post('formpeminjaman',{
              IdAset:this.ModelKendaraan,
              IdDepartment:this.Department.id_department,
              PenanggungJawab:this.PenanggungJawab,
              Keperluan:this.Keperluan,
              Tujuan:this.Tujuan,
              KondisiAwalBBM:this.KondisiBBM,
              KondisiAwalKilometer:this.KondisiKilometer,
              KondisiAwalKebersihan:'Interior : '+this.KondisiAwalKebersihanInterior+' / Eksterior : '+this.KondisiAwalKebersihanEksterior,
              KondisiAwalFisikKendaraan:this.KondisiFisik,
              TglPeminjaman:this.TanggalPeminjaman,
              StatusAset:this.StatusAset,
            }).then(x=>{
              this.KirimNotif()
              this.Reset()
              console.log(x)
              this.overlay = false
              this.$ChangeURL('Peminjaman')
              this.$Toast('success','Pengajuan Dibuat')
            })
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
                    "title": "Pengajuan Peminjaman",
                    "body": "pengajuan dari "+this.PenanggungJawab+" Peminjaman Kendaraan "+kendaraan+". Tujuan Ke "+this.Tujuan+". Untuk Keperluan "+this.Keperluan,
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
        this.Keperluan = null
        this.Tujuan = null
        this.NamaCustomer = null
        this.ModelKendaraan = null
        this.NoPol = null
        this.KondisiKilometer = null
        this.KondisiBBM = null
        this.KondisiAwalKebersihanInterior = null
        this.KondisiAwalKebersihanEksterior = null
        this.KondisiFisik = null
        this.TanggalPeminjaman = (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)
      },
    },
  }
</script>
<style scoped>
body{
  background-color:aqua;
}
</style>