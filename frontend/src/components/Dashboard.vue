<template>
  <div>
  <DashboardMobile v-if="device == 'Mobile'"/>
  <DashboardDesktop v-if="device == 'Desktop'"/>
  <v-dialog
      v-model="dialog"
      max-width="700"
    >
    <v-alert 
      dense
      class="text-overline"
      color="black"
      border="bottom"
      colored-border
      elevation="5">
      <v-sheet>
        <v-app-bar class="rounded" color="#a10115" dark width="280px" height="30px">
          <span class="text-h6">
            Syarat Dan Ketentuan
          </span>
        </v-app-bar>
        

        <v-card-text>
         <h4>Syarat Pengguna Kendaraan Operaional :</h4>
         Mengisi data formulir pengajuan Tes Drive atau Peminjaman Operasional dengan lengkap di app HAI
         <p></p>
         <h4>Alur dan Ketentuan Pengguna:</h4>
         1. Prosedur peminjaman  kendaraan  : Pengguna <v-icon small>mdi-arrow-right</v-icon> HR/GA <v-icon small>mdi-arrow-right</v-icon> Manager
         <h4></h4>
         2. Prosedur Pengambalian kendaraan : Security <v-icon small>mdi-arrow-right</v-icon> HR/GA
         <h4></h4>
         3. Security berhak menahan kendaraan sebelum ada Approve HR/GA dan Manager
         <h4></h4>
         4. Peminjaman selain untuk tugas kantor harus ada Approve HR/GA dam Manager
         <h4></h4>
         5. Segala kerusakan yang diakibatkan keteledoran akan dikenakan sanksi dan pertanggung jawaban pengguna
        <p></p>
        <h4></h4>
        <h4>Tugas dan Ketentuan Security</h4>
        
        1. Aktivitas keluar kendaraan security melakukan pengecekkan sesuai surat pengajuan yang telah tercetak
        <h4></h4>
        2. Pengecekan juga dilakukan oleh security setiap aktivitas masuknya kendaraan dan di input ke formulir pengembalian di app HAI
        <p>3. Apabila ada kerusakan silahkan diketik dengan jelas pada kolom kondisi kendaraan dan segera menginformasikan ke HR/GA terkait kerusakan</p>

        <h4>Catatan Penting :</h4> Setiap pengguna kendaraan harap mengisi<b> Bahan Bakar</b>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn
            color="#a10115"
            text
            @click="dialog = false"
          >
            Setuju
          </v-btn>
        </v-card-actions>
      </v-sheet>
    </v-alert>
    </v-dialog>
  </div>
</template>
<script>
import Vue from 'vue'
  const DashboardMobile = () => import (/* webpackChunkName: "DashboardMobile"*/ '@/views/Dashboard/DashboardMobile.vue')
  const DashboardDesktop = () => import (/* webpackChunkName: "DashboardDesktop"*/ '@/views/Dashboard/DashboardDesktop.vue')
  export default {
    components: {
      DashboardMobile,DashboardDesktop
    },
    data: () => ({
        device:null,
        dialog:false,
        items:[
          {
          color: '#a10115',
          colorback: '#F5F5F5',
          icon: 'mdi-account-hard-hat',
          title: 'User',
          data: 'USER',
          locked: 'N',
          count:'-',
          to:'User'
        },
        {
          color: '#a10115',
          colorback: '#F5F5F5',
          icon: 'mdi-car-multiple',
          title: 'Aset',
          data: 'ASET',
          locked: 'N',
          count:'-',
          to:'Aset'
        },
        {
          color: '#a10115',
          colorback: '#F5F5F5',
          icon: 'mdi-car',
          title: 'Tes Drive',
          data: '-',
          locked: 'N',
          count:'-',
          to:'TesDrive'
        },
        {
          color: '#a10115',
          colorback: '#F5F5F5',
          icon: 'mdi-notebook-plus',
          title: 'Peminjaman',
          data: '-',
          locked: 'N',
          count:'-',
          to:'Peminjaman'
        },
        {
          color: '#a10115',
          colorback: '#F5F5F5',
          icon: 'mdi-notebook-check',
          title: 'Pengembalian',
          data: 'Tes Drive',
          count:'-',
          locked: 'N',
          to:'PengembalianTesDrive'
        },
        {
          color: '#a10115',
          colorback: '#F5F5F5',
          icon: 'mdi-notebook-check-outline',
          title: 'Pengembalian',
          data: 'Peminjaman',
          count:'-',
          locked: 'N',
          to:'PengembalianPeminjaman'
        },
      ],
    }),
    created(){
      Vue.prototype.$ItemDashboard = this.getItem()
    },
    beforeMount(){
        this.device = this.$device
        // console.log(this.device)
    },
    mounted(){
      window.scrollTo(0,0)
      let elHtml = document.getElementsByTagName('html')[0]
      elHtml.style.overflowY = 'hidden'
      // console.log(this.$route.name)
      Vue.prototype.$showDialogBell = this.showDialog
    },
    beforeDestroy(){
      let elHtml = document.getElementsByTagName('html')[0]
      elHtml.style.overflowY = null
    },
    methods:{
      getItem(){
        return this.items
      },
      showDialog(x){
        this.dialog = x
      }
    }
    
  }
</script>