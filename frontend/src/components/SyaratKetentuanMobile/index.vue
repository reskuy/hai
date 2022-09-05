<template>
          <v-list color="white rounded" elevation="6">
            <v-list-group
            class="mt-n1"
              no-action
              @click="list"
            >
              <template v-slot:activator>
                <v-list-item-content>
                  <v-list-item-title ><span style="color:black;" class="text-button">Syarat dan Ketentuan</span></v-list-item-title>
                </v-list-item-content>
              </template>

              <v-list-item style="margin-left:-70px">
                <v-list-item-content class="mt-n6">
                <v-carousel
                    cycle
                    height="220px"
                    :show-arrows="false"
                    hide-delimiter-background
                >  
                
                  <v-carousel-item>
                    <v-card
                      height="100%"
                    >
                      <v-card-text>
                        <h4>Pengguna:</h4>
                        <p></p>
                        <h4></h4>
                        1. Prosedur peminjaman  kendaraan  : 
                        <h4></h4>
                        <span class="ml-4"><b>Pengguna</b> <v-icon small>mdi-arrow-right</v-icon> <b>HR/GA</b> <v-icon small>mdi-arrow-right</v-icon> <b>Manager</b></span>
                        <h4></h4>
                        2. Prosedur Pengambalian kendaraan : 
                        <h4></h4>
                        <span class="ml-4"><b>Security</b> <v-icon small>mdi-arrow-right</v-icon> <b>HR/GA</b></span>
                        <h4></h4>
                        3. Security berhak menahan kendaraan 
                        <h4></h4>
                        <span class="ml-4">operasional sebelum ada Approve </span><h4></h4>
                        <span class="ml-4"><b>HR/GA</b> dan <b>Manager</b></span>
                      </v-card-text>
                    </v-card>
                  </v-carousel-item>

                  <v-carousel-item>
                    <v-card
                      height="100%"
                    >
                      <v-card-text>
                        <h4>Pengguna:</h4>
                        <p></p>
                        <h4></h4>
                        4. Peminjaman selain untuk tugas kantor  
                        <h4></h4>
                        <span class="ml-4">harus ada Approve <b>HR/GA</b> dam <b>Manager</b></span>
                        <h4></h4>
                        5. Segala kerusakan yang diakibatkan  
                        <h4></h4>
                        <span class="ml-4">keteledoran akan dikenakan sanksi dan </span>
                        <span class="ml-4">pertanggung jawaban pengguna</span>
                      </v-card-text>
                    </v-card>
                  </v-carousel-item>

                  <v-carousel-item>
                    <v-card
                      height="100%"
                    >
                      <v-card-text>
                        <h4>Security</h4>
                          <p></p>
                          1. Aktivitas keluar kendaraan security  
                          <h4></h4>
                          <span class="ml-4">melakukan pengecekkan sesuai surat </span>
                          <h4></h4>
                          <span class="ml-4">pengajuan yang telah tercetak</span>
                          <h4></h4>
                          2. Pengecekan juga dilakukan oleh security  
                          <h4></h4>
                          <span class="ml-4">setiap aktivitas masuknya kendaraan dan  </span>
                          <h4></h4>
                          <span class="ml-4">di input ke formulir pengembalian </span>
                          <h4></h4>
                          <span class="ml-4">di app <b>HAI</b></span>
                      </v-card-text>
                    </v-card>
                  </v-carousel-item>

                  <v-carousel-item>
                    <v-card
                      height="100%"
                    >
                      <v-card-text>
                        <h4>Security</h4>
                        <p></p>
                          3. Apabila ada kerusakan silahkan diketik 
                          <h4></h4>
                          <span class="ml-4">dengan jelas pada kolom kondisi</span>
                          <h4></h4>
                          <span class="ml-4"> kendaraan dan segera menginformasikan </span>
                          <h4></h4>
                          <span class="ml-4 mb-n2">ke <b>HR/GA</b> terkait kerusakan</span>
                          <p></p>
                          <span><b>Catatan Penting :</b></span> 
                          <h4></h4>
                          <span>Setiap pengguna kendaraan harap Mengisi</span>
                          <h4></h4>
                          <b> Bahan Bakar</b>
                      </v-card-text>
                    </v-card>
                  </v-carousel-item>
                  
                   </v-carousel>
                </v-list-item-content>
              </v-list-item>
            </v-list-group>

            <v-list-group
            class="mt-n1"
              no-action
            >
              <template v-slot:activator>
                <v-list-item-content>
                  <v-list-item-title ><span style="color:black;" class="text-button">Informasi Icon</span></v-list-item-title>
                </v-list-item-content>
              </template>
              <v-list-item style="margin-left:-70px">
                <v-list-item-content class="mt-n6">
                    <v-carousel
                    cycle
                    height="190px"
                    :show-arrows="false"
                    hide-delimiter-background
                >  
                <v-carousel-item>
                    <v-card
                      height="100%"
                    >
                      <v-card-text>
                        <b>Status Aset</b>
                        <p></p>
                        1. <v-icon color="#a10115">mdi-car</v-icon> : Icon ini menunjukkan kendaraan
                        <h4></h4>
                        <span class="ml-13">operasional <b>READY</b></span>
                        <h4></h4>
                        2. <v-icon>mdi-car</v-icon> : Icon ini menunjukkan kendaraan  
                        <h4></h4>
                        <span class="ml-13">operasional <b>NOT READY</b></span>
                        
                      </v-card-text>
                    </v-card>
                  </v-carousel-item>
                  <v-carousel-item>
                    <v-card
                      height="100%"
                    >
                      <v-card-text>
                      <b>Kondisi Aset</b>
                        <p></p>
                        1. <v-icon>mdi-car-traction-control</v-icon> : Icon ini menunjukkan kendaraan
                        <h4></h4>
                        <span class="ml-13">beroperasi untuk <b>TES DRIVE</b></span>
                        <h4></h4>
                        2. <v-icon>mdi-car-clock</v-icon> : Icon ini menunjukkan kendaraan
                        <h4></h4>
                        <span class="ml-13">operasional untuk<b> DAILY</b></span>
                        <h4></h4>
                        
                      </v-card-text>
                    </v-card>
                  </v-carousel-item>
                  <v-carousel-item>
                    <v-card
                      height="100%"
                    >
                      <v-card-text>
                        <b>Kondisi Aset</b>
                        <p></p>
                        3. <v-icon>mdi-car-key</v-icon> : Icon ini menunjukkan kendaraan 
                        <h4></h4>
                        <span class="ml-13">operasional <b>DIPINJAM</b></span>
                        
                      </v-card-text>
                    </v-card>
                  </v-carousel-item>
                  </v-carousel>
                </v-list-item-content>
              </v-list-item>
            </v-list-group>
            <v-list-group
            class="mt-n1"
              no-action
            >
              <template v-slot:activator>
                <v-list-item-content>
                  <v-list-item-title ><span style="color:black;" class="text-button">Buletin</span></v-list-item-title>
                </v-list-item-content>
              </template>
              <v-list-item style="margin-left:-70px">
                <v-list-item-content class="mt-n6">
                    <v-carousel
                    cycle
                    height="140px"
                    :show-arrows="false"
                    hide-delimiter-background
                >  
                <v-carousel-item>
                    <v-card
                      height="100%"
                    >
                      <v-card-text>
                        <b>Informasi Terkini Bulan Agustus 2022</b>
                        <p></p>
                        1. Mobil CR-V Nomor Polisi KT 6543 RR, 
                        <span class="ml-4">dalam perbaikan</span>
                        <h4></h4>
                        2. Manager Sales sedang <b>CUTI</b> 
                      </v-card-text>
                    </v-card>
                  </v-carousel-item>
                  </v-carousel>
                </v-list-item-content>
              </v-list-item>
            </v-list-group>
          </v-list>
</template>
<script>
export default {
    methods:{
    list(){
        if(document.querySelector(".v-carousel__controls") != null){
            document.querySelector(".v-carousel__controls").style.display = 'none'
        }
      },
    }
}
</script>
