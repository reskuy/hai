<template>
  <v-container fluid>
    <v-card class="mx-auto ma-2 pa-2" elevation="3" width="1150px">
      <v-toolbar width="270px" color="red darken-4" dark class="mb-10 text-overline"><center><span>Form Pengajuan Peminjaman</span></center></v-toolbar>
    <v-row>
        <v-col cols="4">
        <v-subheader>Penanggung Jawab</v-subheader>
      </v-col>
      <v-col cols="8">
        <v-text-field
        label="Nama"
        v-model="PenanggungJawab"
        readonly/>
      </v-col>

      <v-col cols="4">
        <v-subheader>Department</v-subheader>
      </v-col>
      <v-col cols="8">
        <v-text-field
        label="Department"
        v-model="Department.nama_department"
        readonly/>
      </v-col>

      <v-col cols="4">
        <v-subheader>Nama Customer</v-subheader>
      </v-col>
      <v-col cols="8">
        <v-text-field
        label="Nama Sesuai STNK"
        v-model="NamaCustomer"/>
      </v-col>
      
      <v-col cols="4">
        <v-subheader>Tujuan</v-subheader>
      </v-col>
      <v-col cols="8">
        <v-text-field
        label="Isi Tujuan"
        v-model="Tujuan"/>
      </v-col>
      
      <v-col cols="4">
        <v-subheader>Keperluan</v-subheader>
      </v-col>
      <v-col cols="8">
        <v-text-field
        label="Isi Keperluan"
        v-model="Keperluan"/>
      </v-col>

      <v-col cols="4">
        <v-subheader>Model Kendaraan</v-subheader>
      </v-col>
      <v-col cols="8">
        <v-select
        :item-value="IdAset"
        :item-text="NamaAset"
        :items="AsetData"
        v-model="ModelKendaraan"
        label="Type"/>
      </v-col>

      <v-col cols="4">
        <v-subheader>Nomor Polisi</v-subheader>
      </v-col>
      <v-col cols="8">
        <v-text-field
        v-model="NoPol"
        label="Nomor"
        readonly/>
      </v-col>

      <v-col cols="4">
        <v-subheader>Kondisi Awal Kilometer</v-subheader>
      </v-col>
      <v-col cols="8">
        <v-text-field
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
          v-model="KondisiAwalKebersihanInterior"
          label="Interior"
        ></v-text-field>
      </v-col>
      <v-col cols="4">
        <v-text-field
          v-model="KondisiAwalKebersihanEksterior"
          label="Eksterior"
        ></v-text-field>
      </v-col>

      <v-col cols="4">
        <v-subheader>Kondisi Awal Fisik Kendaraan</v-subheader>
      </v-col>
      <v-col cols="8">
        <v-text-field
        label="Kondisi"
        v-model="KondisiFisik"/>
      </v-col>

      <v-col cols="4">
        <v-subheader>Tanggal Pemakaian</v-subheader>
      </v-col>
      <v-col cols="8">
          <v-menu
          v-model="menu2"
          :close-on-content-click="false"
          transition="scale-transition"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-text-field
              v-model="TanggalPemakaian"
              label="Tanggal Pemakaian"
              prepend-icon="mdi-calendar"
              readonly
              v-bind="attrs"
              v-on="on"
            ></v-text-field>
          </template>
          <v-date-picker
            v-model="TanggalPemakaian"
            @input="menu2 = false"
          ></v-date-picker>
        </v-menu>
      </v-col>
    </v-row>
      <v-card-actions>
        <v-btn color="red darken-2" dark @click="Reset()">Reset
          <v-icon dark>
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
  export default {
    data: () => ({
      PenanggungJawab: localStorage.getItem("userlogged"),
      Department: JSON.parse(localStorage.getItem("departmentlogged")),
      NamaCustomer:null,
      AsetData:[],
      email: '',
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
      TanggalPemakaian:(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
      menu: false,
      modal: false,
      menu2: false,
      checkbox: false,
    }),
    mounted(){
      this.getAset()
    },

    watch: {
      ModelKendaraan(x){
        this.NoPol= x != null ? this.AsetData.find(data=>data.id_aset==x).no_plat : null
      }
    },
    methods: {
      getAset(){
        api.get('/aset').then(x=>{
          this.AsetData = x.data
        })
      },
      Save() {
        this.overlay = true
        api.post('/formtesdrive',{
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
          this.Reset()
          console.log(x)
          this.overlay = false
          this.$Toast('success','Pengajuan Dibuat')
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
      },
    },
  }
</script>
<style scoped>
body{
  background-color:aqua;
}
</style>