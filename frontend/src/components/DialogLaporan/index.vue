<template>
<div>
    <v-dialog v-model="dialog" width="380px" persistent>
        <v-card>
            <v-toolbar color="#a10115">
                <span class="text-button" style="color:white;" dark>Laporan Generator</span>
                <v-spacer/>
                <v-btn color="white" @click="dialogx" icon>
                    <v-icon>mdi-close</v-icon>
                </v-btn>
            </v-toolbar>
            <v-container>
               <v-row>
                    <v-col cols="12" class="mb-n2 mt-4">
                        <v-autocomplete
                            color="#a10115"
                            class="text-button"
                            v-model="SelectLaporan"
                            :items="ListLaporan"
                            dense
                            label="Laporan"
                        ></v-autocomplete>
                    </v-col>
                    <v-col cols="12" class="mt-n4">
                        <v-btn 
                            :disabled="SelectLaporan != null ? false : true" 
                            @click="Generate" 
                            width="100%" 
                            :dark="SelectLaporan != null ? true : false"
                            color="#a10115">
                            Generate Laporan
                        </v-btn>
                    </v-col>
               </v-row>
            </v-container>
        </v-card>
    </v-dialog>
    <LaporanTesDrive/>
    <LaporanPeminjaman/>
    <LaporanPengembalianTesDrive/>
    <LaporanPengembalianPeminjaman/>
    </div>
</template>
<script>
import Vue from 'vue'
const LaporanTesDrive = () => import (/* webpackChunkName: "LaporanTesDrive"*/ '@/components/LaporanTesDrive/index.vue')
const LaporanPeminjaman = () => import (/* webpackChunkName: "LaporanPeminjaman"*/ '@/components/LaporanPeminjaman/index.vue')
const LaporanPengembalianTesDrive = () => import (/* webpackChunkName: "LaporanPengembalianTesDrive"*/ '@/components/LaporanPengembalianTesDrive/index.vue')
const LaporanPengembalianPeminjaman = () => import (/* webpackChunkName: "LaporanPengembalianPeminjaman"*/ '@/components/LaporanPengembalianPeminjaman/index.vue')
export default {
    components:{
      LaporanTesDrive,LaporanPeminjaman,LaporanPengembalianTesDrive,LaporanPengembalianPeminjaman
    },
    data:()=>({
        dialog:false,
        menu2:false,
        SelectLaporan:null,
        ListLaporan: ['Tes Drive', 'Peminjaman', 'Pengembalian Tes Drive', 'Pengembalian Peminjaman'],
        menu3:false,
        TglAwal:null,
        TglAkhir:null,
    }),
    mounted(){
        Vue.prototype.$AllLaporan = this.dialogx
    },
    methods:{
        dialogx(){
            this.dialog = !this.dialog
        },
        Generate(){
            this.dialog = false
            if(this.SelectLaporan == 'Tes Drive'){
                this.$OpenLaporanTesDrive()
            }
            if(this.SelectLaporan == 'Peminjaman'){
                this.$OpenLaporanPeminjaman()
            }
            if(this.SelectLaporan == 'Pengembalian Tes Drive'){
                this.$OpenLaporanPengembalianTesDrive()
            }
            if(this.SelectLaporan == 'Pengembalian Peminjaman'){
                this.$OpenLaporanPengembalianPeminjaman()
            }
        },
    }
}
</script>