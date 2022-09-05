<template>
<v-row dense>
<v-col cols="12">
          <v-sheet
          class="rounded"
          elevation="6"
          v-show="loading == true"
            color="gray lighten-2"
          >
            <v-skeleton-loader
              class="mx-auto"
              max-height="480"
              type="image,image"
            ></v-skeleton-loader>
          </v-sheet>
          <v-carousel
            v-show="loading == false"
            cycle
            height="100%"
            :show-arrows="false"
            hide-delimiter-background
          >
            <v-carousel-item>
              <v-card
                height="100%"
              >
                <v-card-text>
                  <h4>Syarat Pengguna Kendaraan Operaional</h4>
                  <p></p>
                  <b>WAJIB :</b> Mengisi data formulir pengajuan Tes Drive atau Peminjaman Operasional dengan lengkap di app <b>HAI</b>
                  <p></p>
                  1. Prosedur peminjaman  kendaraan  : <b>Pengguna</b> <v-icon small>mdi-arrow-right</v-icon> <b>HR/GA</b> <v-icon small>mdi-arrow-right</v-icon> <b>Manager</b>
                  <h4></h4>
                  2. Prosedur Pengambalian kendaraan : <b>Security</b> <v-icon small>mdi-arrow-right</v-icon> <b>HR/GA</b>
                  <h4></h4>
                  3. Security berhak menahan kendaraan sebelum ada <b>Approve HR/GA</b> dan <b>Manager</b>
                  <h4></h4>
                  4. Peminjaman selain untuk tugas kantor harus ada <b>Approve HR/GA</b> dam <b>Manager</b>
                  <h4></h4>
                  5. Segala kerusakan yang diakibatkan keteledoran akan dikenakan sanksi dan pertanggung jawaban pengguna
                  <p></p>
                  <h4>Tugas dan Ketentuan Security</h4>
                    <p></p>
                    1. Aktivitas keluar kendaraan security melakukan pengecekkan sesuai surat pengajuan yang telah tercetak
                    <h4></h4>
                    2. Pengecekan juga dilakukan oleh security setiap aktivitas masuknya kendaraan dan di input ke formulir pengembalian di app <b>HAI</b>
                    <h4></h4>
                    3. Apabila ada kerusakan silahkan diketik dengan jelas pada kolom kondisi kendaraan dan segera menginformasikan ke <b>HR/GA</b> terkait kerusakan
                    <p></p>
                    <h4>Catatan Penting :</h4> Setiap pengguna kendaraan harap mengisi<b> Bahan Bakar</b>
                    <h4></h4>
                    <span>Reminder customer untuk <b>Tidak Meninggalkan</b> barang berharga di kendaraan setelah Tes Drive</span>
                </v-card-text>
              </v-card>
            </v-carousel-item>
          </v-carousel>
        </v-col>
</v-row>
</template>
<script>
import Vue from 'vue';
export default {
  data(){
    return{
      loading:true,
      // height:(window.innerHeight-)+'px'
    }
  },
  mounted(){
    Vue.prototype.$LoadingKetentuan = this.loadingx
  },
  methods:{
    loadingx(){
      this.loading = !this.loading
    }
  }
}
</script>