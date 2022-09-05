<template>
    <v-dialog v-model="dialog" width="380px" persistent>
        <v-card>
            <v-toolbar color="#a10115">
                <span class="text-button" style="color:white;" dark>Export Excel Pengembalian Tes Drive</span>
                <v-spacer/>
                <v-btn dark @click="dialogx" icon>
                    <v-icon>mdi-close</v-icon>
                </v-btn>
            </v-toolbar>
            <v-container>
                <v-row dense>
                    <!-- tanggal awal -->
                    <v-col cols="12">
                       <v-menu
                        color="#d72c16"
                        v-model="menu2"
                        min-width="auto"
                        :close-on-content-click="false"
                        transition="scale-transition"
                        >
                        <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                            color="#d72c16"
                            v-model="TglAwal"
                            label="Tanggal Awal"
                            prepend-icon="mdi-calendar"
                            readonly
                            v-bind="attrs"
                            v-on="on"
                            ></v-text-field>
                        </template>
                        <v-date-picker
                        color="#d72c16"
                            v-model="TglAwal"
                            @input="menu2 = false"
                        ></v-date-picker>
                        </v-menu>
                    </v-col>

                    <!-- tanggal akhir  -->
                    <v-col cols="12">
                         <v-menu
                            color="#d72c16"
                            v-model="menu3"
                            min-width="auto"
                            :close-on-content-click="false"
                            transition="scale-transition"
                            >
                            <template v-slot:activator="{ on, attrs }">
                                <v-text-field
                                color="#d72c16"
                                v-model="TglAkhir"
                                label="Tanggal Akhir"
                                prepend-icon="mdi-calendar"
                                readonly
                                v-bind="attrs"
                                v-on="on"
                                ></v-text-field>
                            </template>
                            <v-date-picker
                            color="#d72c16"
                                v-model="TglAkhir"
                                @input="menu3 = false"
                            ></v-date-picker>
                            </v-menu>
                    </v-col>
                    
                    <!-- radio grup seleksi semua atau kembali -->
                    <v-col cols="12" v-show="TglAwal != null && TglAkhir != null">
                     <v-radio-group
                        v-model="filter"
                        mandatory
                        >
                        <v-radio
                            color="red darken-4"
                            label="Semua"
                            value="All"
                        ></v-radio>
                        <v-radio
                            color="red darken-4"
                            label="Sudah Kembali"
                            value="Kembali"
                        ></v-radio>
                        </v-radio-group>
                    </v-col>
                    <!-- button Export Excel -->
                    <v-col cols="12">
                        <v-btn 
                            depressed 
                            width="100%" 
                            color="#a10115" 
                            :disabled="TglAwal != null && TglAkhir != null ? false : true" 
                            :dark="TglAwal != null && TglAkhir != null ? true : false" 
                            @click="GenerateReport">
                            Export
                        </v-btn>
                    </v-col>
                </v-row>
            </v-container>
        </v-card>
    </v-dialog>
</template>
<script>
import Vue from 'vue'
import API from '@/services/http'
export default {
    data:()=>({
        dialog:false,
        menu2:false,
        filter:"All",
        menu3:false,
        TglAwal:null,
        TglAkhir:null,
    }),
    mounted(){
        Vue.prototype.$OpenLaporanPengembalianTesDrive = this.dialogx
    },
    methods:{
        dialogx(){
            this.dialog = !this.dialog
            this.TglAkhir= null
            this.TglAwal = null
            this.filter = 'All'
        },
        GenerateReport(){
            this.dialog = false
            API.get('laporanpengembaliantesdrive/'+this.TglAwal+'/'+this.TglAkhir).then(x=>{
                console.log(x)
               const xlsx = require('xlsx');
                let newArray = []
                if(this.filter == 'Kembali'){
                    x.data.forEach(z => {
                        if(z.pengembalian != null){
                        newArray.push({
                        'Tanggal Peminjaman': this.$DateConvert(z.tesdrive.tanggal_pemakaian),
                        'Tanggal Pengembalian': this.$DateConvert(z.tanggal_pengembalian),
                        'Penanggung Jawab':z.tesdrive.penanggung_jawab,
                        'Department':z.tesdrive.department.nama_department,
                        'Kendaraan': z.tesdrive.aset.nama_aset,
                        'Warna':z.tesdrive.aset.warna,
                        'No Pol':z.tesdrive.aset.no_plat,
                        'BBM Awal':z.tesdrive.kondisi_awal_bbm,
                        'BBM Akhir':z.kondisi_akhir_bbm,
                        'KM Awal':z.tesdrive.kondisi_awal_kilometer,
                        'KM Akhir':z.kondisi_akhir_kilometer,
                        'Kondisi Awal Fisik':z.tesdrive.kondisi_awal_fisik_kendaraan,
                        'Kondisi Akhir Fisik':z.kondisi_akhir_fisik_kendaraan,
                        'Kondisi Awal Kebersihan Interior':z.tesdrive.kondisi_awal_kebersihan_interior,
                        'Kondisi Akhir Kebersihan Interior':z.kondisi_akhir_kebersihan_interior,
                        'Kondisi Awal Kebersihan Eksterior':z.tesdrive.kondisi_awal_kebersihan_eksterior,
                        'Kondisi Akhir Kebersihan Eksterior':z.kondisi_akhir_kebersihan_eksterior,
                        'Jam Keluar':z.tesdrive.jam_keluar_kendaraan,
                        'Jam Masuk':z.jam_masuk_kendaraan,
                        'Nama Customer':z.tesdrive.nama_customer,
                        'Lokasi TesDrive':z.tesdrive.lokasi_tes_drive,
                        })
                      }
                    })
                }
                if(this.filter == 'All'){
                    x.data.forEach(z => {
                        newArray.push({
                        'Tanggal Peminjaman': this.$DateConvert(z.tesdrive.tanggal_pemakaian),
                        'Tanggal Pengembalian': this.$DateConvert(z.tanggal_pengembalian),
                        'Penanggung Jawab':z.tesdrive.penanggung_jawab,
                        'Department':z.tesdrive.department.nama_department,
                        'Kendaraan': z.tesdrive.aset.nama_aset,
                        'Warna':z.tesdrive.aset.warna,
                        'No Pol':z.tesdrive.aset.no_plat,
                        'BBM Awal':z.tesdrive.kondisi_awal_bbm,
                        'BBM Akhir':z.kondisi_akhir_bbm,
                        'KM Awal':z.tesdrive.kondisi_awal_kilometer,
                        'KM Akhir':z.kondisi_akhir_kilometer,
                        'Kondisi Awal Fisik':z.tesdrive.kondisi_awal_fisik_kendaraan,
                        'Kondisi Akhir Fisik':z.kondisi_akhir_fisik_kendaraan,
                        'Kondisi Awal Kebersihan Interior':z.tesdrive.kondisi_awal_kebersihan_interior,
                        'Kondisi Akhir Kebersihan Interior':z.kondisi_akhir_kebersihan_interior,
                        'Kondisi Awal Kebersihan Eksterior':z.tesdrive.kondisi_awal_kebersihan_eksterior,
                        'Kondisi Akhir Kebersihan Eksterior':z.kondisi_akhir_kebersihan_eksterior,
                        'Jam Keluar':z.tesdrive.jam_keluar_kendaraan,
                        'Jam Masuk':z.jam_masuk_kendaraan,
                        'Nama Customer':z.tesdrive.nama_customer,
                        'Lokasi TesDrive':z.tesdrive.lokasi_tes_drive,
                        })
                    })
                }

                // let ws = xlsx.utils.sheet_add_aoa([
                //     [title,' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ']
                //     ], {origin: 'A1'})
                let ws = xlsx.utils.json_to_sheet(newArray);
                let wb =xlsx.utils.book_new();
                xlsx.utils.book_append_sheet(wb, ws, 'Report '+this.$DateConvert(this.TglAwal)+'-'+this.$DateConvert(this.TglAkhir))
                xlsx.writeFile(wb, 'Laporan '+this.filter+' Pengembalian TesDrive '+this.$DateConvert(this.TglAwal)+'-'+this.$DateConvert(this.TglAkhir)+'.xlsx');
            })
        }
    }
}
</script>