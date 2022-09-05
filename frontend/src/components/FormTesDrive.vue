<template>
  <v-container fluid :style="{backgroundColor:'#c8d2d8'}">
    <v-card class="mx-auto ma-2 pa-2 mb-12" elevation="3" width="1150px">
      <v-sheet class="mb-7 pa-2 d-flex justify-start">
        <v-card class="pa-2 text-overline text-center" width="259px" dark color="#a10115"><span>Form Pengajuan Tes Drive</span></v-card>
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
        <v-subheader>Nama Customer</v-subheader>
      </v-col>
      <v-col cols="8">
        <v-text-field
        color="#d72c16"
        label="Nama Sesuai KTP"
        v-model="NamaCustomer"/>
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
        <v-subheader>Lokasi Tes Drive</v-subheader>
      </v-col>
      <v-col cols="8">
        <v-text-field
        color="#d72c16"
        label="Sesuai Lokasi"
        v-model="LokasiTesDrive"/>
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

      <v-col cols="4">
        <v-subheader>Tanggal Pemakaian</v-subheader>
      </v-col>
      <v-col cols="8">
        <v-dialog
        color="red darken-4"
        ref="dialogTanggalPemakaian"
        v-model="menu2"
        :return-value.sync="TanggalPemakaian"
        persistent
        width="290px"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field
            color="red darken-4"
            v-model="TanggalPemakaian"
            label="Tanggal Pemakaian"
            prepend-icon="mdi-calendar"
            readonly
            v-bind="attrs"
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker
          color="red darken-4"
          v-model="TanggalPemakaian"
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
            @click="$refs.dialogTanggalPemakaian.save(TanggalPemakaian)"
          >
            OK
          </v-btn>
        </v-date-picker>
      </v-dialog>
      </v-col>

      <v-col cols="4">
        <v-subheader>Estimasi Tanggal Kembali</v-subheader>
      </v-col>
      <v-col cols="8">
        <v-dialog
        color="red darken-4"
        ref="dialogEstimasiTanggalKembali"
        v-model="menu3"
        :return-value.sync="EstimasiTanggalKembali"
        persistent
        width="290px"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field
            color="red darken-4"
            v-model="EstimasiTanggalKembali"
            label="Estimasi Tanggal Kembali"
            prepend-icon="mdi-calendar"
            readonly
            v-bind="attrs"
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker
          color="red darken-4"
          v-model="EstimasiTanggalKembali"
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
            @click="$refs.dialogEstimasiTanggalKembali.save(EstimasiTanggalKembali)"
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
import axios from 'axios'
import firebase from "@/services/firebase-sw"
import api from "@/services/http"
  export default {
    data: () => ({
      PenanggungJawab: JSON.parse(localStorage.getItem("logged")).nama_lengkap,
      Department: JSON.parse(localStorage.getItem("logged")).department,
      NamaCustomer:null,
      AsetData:[],
      listoken:[],
      email: '',
      overlay:false,
      NoPol:null,
      device:null,
      select: null,
      SaveDisabled:false,
      ModelKendaraan:null,
      KondisiKilometer:null,
      KondisiBBM:null,
      JamMasukMenit:'00',
      JamMasukJam:null,
      JamKeluarMenit:'00',
      JamKeluarJam:null,
      JamKeluar:null,
      JamMasuk:null,
      KondisiAwalKebersihanInterior:null,
      KondisiAwalKebersihanEksterior:null,
      EstimasiTanggalKembali:null,
      KondisiFisik:null,
      LokasiTesDrive:null,
      TanggalPemakaian:(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
      menu: false,
      modal: false,
      menu2: false,
      menu3:false,
      checkbox: false,
    }),
    created(){
      this.device = this.$device
      this.$loading(true)
      this.getAset()
    },
    mounted(){
      console.log(this.$refs.dialog)
    },

    watch: {
      ModelKendaraan(x){
        this.NoPol= x != null ? this.AsetData.find(data=>data.id_aset==x).no_plat : null
        this.KondisiBBM = x != null ? this.AsetData.find(data=>data.id_aset==x).BBM : null
        this.KondisiKilometer = x != null ? this.AsetData.find(data=>data.id_aset==x).KM : null
      }
    },
    methods: {
      getAset(){
        api.get('/aset').then(x=>{
          x.data = x.data.filter(c=>c.jenis_aset == 'Mobil' && c.status_aset == 'READY' || c.kondisi_aset == 'DAILY')
          this.AsetData = x.data
          this.$loading(false)
        })
      },
      Save() {
        if(this.ModelKendaraan == null){return this.$Toast('error','Pastikan Semua Semua Terisi',)}
        if(this.Department == null){return this.$Toast('error','Pastikan Semua Semua Terisi')}
        if(this.PenanggungJawab == null){return this.$Toast('error','Pastikan Semua Semua Terisi')}
        if(this.NamaCustomer == null){return this.$Toast('error','Pastikan Semua Semua Terisi')}
        if(this.KondisiBBM == null){return this.$Toast('error','Pastikan Semua Semua Terisi')}
        if(this.KondisiKilometer == null){return this.$Toast('error','Pastikan Semua Semua Terisi')}
        if(this.KondisiAwalKebersihanInterior == null){return this.$Toast('error','Pastikan Semua Semua Terisi')}
        if(this.KondisiAwalKebersihanEksterior == null){return this.$Toast('error','Pastikan Semua Semua Terisi')}
        if(this.KondisiFisik == null){return this.$Toast('error','Pastikan Semua Semua Terisi')}
        if(this.LokasiTesDrive == null){return this.$Toast('error','Pastikan Semua Semua Terisi')}
        if(this.TanggalPemakaian == null){return this.$Toast('error','Pastikan Semua Semua Terisi')}
        this.SaveDisabled = true
        this.overlay = true
            api.post('/formtesdrive',{
              IdAset:this.ModelKendaraan,
              IdDepartment:this.Department.id_department,
              PenanggungJawab:this.PenanggungJawab,
              NamaCustomer:this.NamaCustomer,
              KondisiBBM:this.KondisiBBM,
              JamKeluar:this.JamKeluarJam+':'+this.JamKeluarMenit,
              JamMasuk:this.JamMasukJam+':'+this.JamMasukMenit,
              KondisiKM:this.KondisiKilometer,
              KondisiAwalKebersihanInterior:this.KondisiAwalKebersihanInterior,
              KondisiAwalKebersihanEksterior:this.KondisiAwalKebersihanEksterior,
              KondisiFisik:this.KondisiFisik,
              LokasiTesDrive:this.LokasiTesDrive,
              TanggalPemakaian:this.TanggalPemakaian,
              EstimasiTanggalKembali:this.EstimasiTanggalKembali,
            }).then(x=>{
              this.KirimNotif()
              this.SetSeen()
              this.Reset()
              console.log(x)
              this.overlay = false
              this.SaveDisabled = false
              this.$ChangeURL('TesDrive')
              this.$Toast('success','Pengajuan Dibuat')
            })
      },
      ChangeURL(x){
        this.$ChangeURL(x)
      },
      async KirimNotif(){
        let kendaraan = this.AsetData.find(data=>data.id_aset==this.ModelKendaraan).nama_aset
        const eventref = firebase.database().ref("userlevel/4"); // HRGA
        let snapshot = await eventref.once('value');
        let dx = snapshot.val();
        // firebase.database().ref("alluser").on('value', snapshot => {
        Object.keys(dx).forEach(key => {
        this.listoken.push(dx[key]);
        });
        this.listoken.concat(this.$TokenIT)
        console.log('tl',this.listoken)
        let data = {
            "notification" : {
                    "title": "Pengajuan Tes Drive",
                    "body": "Pengajuan dari "+this.PenanggungJawab+" Tes Drive Kendaraan "+kendaraan,
                    "icon": "https://www.honda-indonesia.com/favicon/android-icon-192x192.png",
          },
          "priority":"high",
          "registration_ids":this.listoken, 
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
        this.JamMasukMenit = null
        this.JamMasukJam = null
        this.JamKeluarMenit = null
        this.JamKeluarJam = null
        this.KondisiAwalKebersihanInterior = null
        this.KondisiAwalKebersihanEksterior = null
        this.KondisiFisik = null
        this.TanggalPemakaian = (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)
        this.LokasiTesDrive = null
      },
      SetSeen(){
        api.get('setseen/tes_drive')
      },
    },
  }
</script>
<style scoped>
body{
  background-color:aqua;
}
</style>