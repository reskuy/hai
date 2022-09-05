<template>
<v-footer elevation="2" app bottom fixed padless>
    <v-sheet height="100px" width="100%" color="black" dark>
        <center>
        <v-row dense>
            <v-col class="mt-1" cols="12">
                <v-img src="@/assets/logo-honda-1.png" max-width="43"></v-img>
                <p class="text-button">PT. Porspect Motor</p>
            </v-col>
            <v-col style="margin-top:-100px" cols="12" md="6">
                <!-- Total pengembalian -->
               <v-chip ><span>Today : {{TotalTesDrive}} Tes Drive</span></v-chip>
            </v-col>
            <v-col style="margin-top:-100px;" cols="12" md="6">
                <!-- Total Peminjaman -->
               <v-chip ><span>Today : {{TotalPeminjaman}} Peminjaman</span></v-chip>
            </v-col>
            <v-col style="margin-top:-60px" cols="12" md="6">
                <!-- Pengembalian Tes Drive -->
                <v-chip ><span>Today : {{TotalPengembalianTesDrive}} Pengembalian Tes Drive</span></v-chip>
            </v-col>
            <v-col style="margin-top:-60px" cols="12" md="6">
                <!-- pengembalian peminjaman -->
               <v-chip><span>Today : {{TotalPengembalianPeminjaman}} Pengembalian Peminjaman</span></v-chip>
            </v-col>
            <v-col style="margin-top:-80px" cols="12" md="1">
                <v-btn @click="ToWa('6285250384489')" class="rounded">
                <v-icon>mdi-whatsapp</v-icon>
                Jordy  
                </v-btn>
                <!-- kontak hr -->
            </v-col>
            
            <v-col style="margin-top:-80px" cols="12" md="1">
                <v-btn @click="ToWa('6287819003468')" class="rounded">
                <v-icon >mdi-whatsapp</v-icon>
                Agus
                </v-btn>
                <!-- kontak ga -->
            </v-col>
            <v-col style="margin-top:-80px" cols="12" md="7">
                <!-- kosong aja buat space -->
             </v-col>
            <v-col style="margin-top:-100px"  cols="12" md="3">
                <!-- developer  -->
                <!-- <span class="text-end">Version : 1.0</span> -->
                <span style="margin-left:50px" class="justify-end text-subtitle-2">Version : 1.0 </span><span class="justify-end text-subtitle-2 ml-7">Develop By Karin</span>
            </v-col>
        </v-row>
        </center>
        <!-- <span>Versi : 1.0</span>
        <v-spacer/>
        <span>By Rifka Karin Afinda</span> -->
    </v-sheet>
    </v-footer>
</template>
<script>
// import Vue from 'vue'
import API from '@/services/http'
  export default {
    data: () => ({
    //
    TotalTesDrive:'',
    TotalPeminjaman:'',
    TotalPengembalianTesDrive:0,
    TotalPengembalianPeminjaman:0,
    }),
    mounted(){
        this.GetTotal()
    },
    methods:{
        GetTotal(){
            API.get('totaltesdrivetoday').then(x=>{
               this.TotalTesDrive = x.data.totalform
            })
            API.get('totalpeminjamantoday').then(x=>{
               this.TotalPeminjaman = x.data.totalform
            })
        },
        ToWa(x){
            window.open('https://wa.me/'+x+'?text=Saya User HAI Mau Bertanya', '_blank').focus()
        }
    },
  }
</script>