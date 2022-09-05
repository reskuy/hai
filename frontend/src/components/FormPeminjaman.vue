<template>
  <v-container fluid :style="{backgroundColor:'#c8d2d8'}">
    <v-card class="mx-auto ma-2 pa-2 mb-12" elevation="3" width="1150px">
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
        <v-checkbox v-show="device == 'Mobile'" class="mt-n5 mx-3" value="DAILY" label="Daily" v-model="StatusAset" color="red darken-4"/>
      </v-col>
      <v-col cols="7">
        <v-text-field
        color="#d72c16"
        label="Keperluan"
        :disabled="KeperluanDisabled"
        v-model="Keperluan"/>
      </v-col>
      <v-col v-show="device == 'Desktop'" cols="1">
        <v-checkbox value="DAILY" label="Daily" v-model="StatusAset" color="red darken-4"/>
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
        label=" Pilih Tipe"/>
      </v-col>

      <v-col cols="4">
        <v-subheader>Nomor Polisi</v-subheader>
      </v-col>
      <v-col cols="8">
        <v-text-field
        color="#d72c16"
        v-model="NoPol"
        label=""
        readonly/>
      </v-col>

      <v-col cols="4">
        <v-subheader>Kondisi Awal Kilometer</v-subheader>
      </v-col>
      <v-col cols="8">
        <v-text-field
        color="#d72c16"
          v-model="KondisiKilometer"
          label=""
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
          label=""
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
        <v-subheader>Jam Keluar</v-subheader>
      </v-col>
      <v-col cols="4" md="1">
        <v-text-field
        color="#d72c16"
        maxlength="2"
        label="Jam"
        v-model="JamKeluarJam"/>
      </v-col>
        <v-col cols="4" md="1">
        <v-text-field
        color="#d72c16"
        maxlength="2"
        label="Menit"
        v-model="JamKeluarMenit"/>
      </v-col>
      <v-col cols="5" v-show="device == 'Desktop'"></v-col>

      <v-col cols="4">
        <v-subheader>Jam Masuk</v-subheader>
      </v-col>
      <v-col cols="4" md="1">
        <v-text-field
        color="#d72c16"
        maxlength="2"
        label="Jam"
        v-model="JamMasukJam"/>
      </v-col>
        <v-col cols="4" md="1">
        <v-text-field
        maxlength="2"
        color="#d72c16"
        label="Menit"
        v-model="JamMasukMenit"/>
      </v-col>
      <v-col cols="5" v-show="device == 'Desktop'"></v-col>
      <!-- <v-col cols="4">
        <v-subheader>Jam Keluar</v-subheader>
      </v-col>
      <v-col cols="4" md="1">
        <v-text-field
        color="#d72c16"
        maxlength="2"
        label="Jam"
        v-model="JamKeluarJam"/>
      </v-col>
        <v-col cols="4" md="1">
        <v-text-field
        color="#d72c16"
        maxlength="2"
        label="Menit"
        v-model="JamKeluarMenit"/>
      </v-col>
      <v-col cols="5" v-show="device == 'Desktop'"></v-col>

      <v-col cols="4">
        <v-subheader>Jam Masuk</v-subheader>
      </v-col>
      <v-col cols="4" md="1">
        <v-text-field
        color="#d72c16"
        maxlength="2"
        label="Jam"
        v-model="JamMasukJam"/>
      </v-col>
        <v-col cols="4" md="1">
        <v-text-field
        maxlength="2"
        color="#d72c16"
        label="Menit"
        v-model="JamMasukMenit"/>
      </v-col>
      <v-col cols="5" v-show="device == 'Desktop'"></v-col> -->

      <v-col cols="4">
        <v-subheader>Tanggal Pemakaian</v-subheader>
      </v-col>
      <v-col cols="8">
        <v-dialog
        color="red darken-4"
        ref="dialogTanggalPeminjaman"
        v-model="menu2"
        :return-value.sync="TanggalPeminjaman"
        persistent
        width="290px"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field
            color="red darken-4"
            v-model="TanggalPeminjaman"
            label="Tanggal Peminjaman"
            prepend-icon="mdi-calendar"
            readonly
            v-bind="attrs"
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker
          color="red darken-4"
          v-model="TanggalPeminjaman"
          scrollable
        >
          <v-spacer></v-spacer>
          <v-btn
            text
            color="red darken-4"
            @click="menu2 = false"
          >
            Batal
          </v-btn>
          <v-btn
            text
            color="red darken-4"
            @click="$refs.dialogTanggalPeminjaman.save(TanggalPeminjaman)"
          >
            OK
          </v-btn>
        </v-date-picker>
      </v-dialog>
      </v-col>

      <v-col cols="4">
        <v-subheader>Estimasi Tanggal Pengembalian</v-subheader>
      </v-col>
      <v-col cols="8">
        <v-dialog
        color="red darken-4"
        ref="dialogEstimasiTanggalPengembalian"
        v-model="menu3"
        :return-value.sync="EstimasiTanggalPengembalian"
        persistent
        width="290px"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field
            color="red darken-4"
            v-model="EstimasiTanggalPengembalian"
            label="Estimasi Tanggal Pengembalian"
            prepend-icon="mdi-calendar"
            readonly
            v-bind="attrs"
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker
          color="red darken-4"
          v-model="EstimasiTanggalPengembalian"
          scrollable
        >
          <v-spacer></v-spacer>
          <v-btn
            text
            color="red darken-4"
            @click="menu3 = false"
          >
            Batal
          </v-btn>
          <v-btn
            text
            color="red darken-4"
            @click="$refs.dialogEstimasiTanggalPengembalian.save(EstimasiTanggalPengembalian)"
          >
            OK
          </v-btn>
        </v-date-picker>
      </v-dialog>
      </v-col>

    </v-row>
      <v-card-actions>
        <v-tooltip right>
          <template v-slot:activator="{ on, attrs }">
          <v-icon 
          large
           v-bind="attrs"
           v-on="on" 
           class="ml-3" 
           style="color: black;" 
           @click="Reset()">mdi-close-circle-outline</v-icon>
           </template>
           <span>Reset</span>
           </v-tooltip>
        <v-spacer/>
        <v-tooltip left>
          <template v-slot:activator="{ on, attrs }">
          <v-icon 
          large
           v-bind="attrs"
           v-on="on" 
           class="ml-3 ma-2" 
           style="color: #a10115;" 
           :disabled="SaveDisabled"
           right
           @click="Save()"> mdi-checkbox-marked-circle-outline</v-icon>
           </template>
           <span>Save</span>
           </v-tooltip>
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
      PenanggungJawab: JSON.parse(localStorage.getItem("logged")).nama_lengkap,
      Department: JSON.parse(localStorage.getItem("logged")).department,
      NamaCustomer:null,
      AsetData:[],
      listoken:[],
      KeperluanDisabled:false,
      device: null,
      StatusAset:null,
      overlay:false,
      NoPol:null,
      // JamMasukJam:null,
      // JamMasukMenit:'00',
      // JamKeluarJam:null,
      // JamKeluarMenit:'00',
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
      EstimasiTanggalPengembalian:null,
      TanggalPeminjaman:(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
      menu: false,
      modal: false,
      menu2: false,
      menu3:false,
      checkbox: false,
    }),
    created(){
      this.device = this.$device
    },
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
        this.KondisiBBM= x != null ? this.AsetData.find(data=>data.id_aset==x).BBM : null
        this.KondisiKilometer= x != null ? this.AsetData.find(data=>data.id_aset==x).KM : null
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
              JamMasuk:this.JamMasukJam+':'+this.JamMasukMenit,
              JamKeluar:this.JamKeluarJam+':'+this.JamKeluarMenit,
              KondisiAwalKilometer:this.KondisiKilometer,
              KondisiAwalKebersihanInterior:this.KondisiAwalKebersihanInterior,
              KondisiAwalKebersihanEksterior:this.KondisiAwalKebersihanEksterior,
              KondisiAwalFisikKendaraan:this.KondisiFisik,
              TglPeminjaman:this.TanggalPeminjaman,
              StatusAset:this.StatusAset,
              EstimasiTanggalPengembalian: this.EstimasiTanggalPengembalian
            }).then(x=>{
              this.KirimNotif()
              this.SetSeen()
              this.Reset()
              console.log(x)
              this.overlay = false
              this.$ChangeURL('Peminjaman')
              this.$Toast('success','Pengajuan Dibuat')
            })
      },
      SetSeen(){
        api.get('setseen/peminjaman')
      },
      ChangeURL(x){
        this.$ChangeURL(x)
      },
      async KirimNotif(){
        let kendaraan = this.AsetData.find(data=>data.id_aset==this.ModelKendaraan).nama_aset
        const eventref = firebase.database().ref("userlevel/4"); // HRGA
        let snapshot = await eventref.once('value');
        // firebase.database().ref("alluser").on('value', snapshot => {
                let dx = snapshot.val();
                Object.keys(dx).forEach(key => {
                this.listoken.push(dx[key]);
                });
                this.listoken.concat(this.$TokenIT)
            // })
        let data = {
          "registration_ids":this.listoken, 
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
        this.TanggalKembali = (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)
      },
    },
  }
</script>
<style scoped>
body{
  background-color:aqua;
}
</style>