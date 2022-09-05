<template>
<v-card height="100hv" class="mx-auto"
    style="height:100vh" :style="{backgroundColor:'#c8d2d8'}">
  <v-container>
    <v-toolbar
      color="#a10115"
      elevation="4"
      class="mx-16"
      dark
      >
        <v-toolbar-title color="#a10115">History</v-toolbar-title>
        <v-divider
          class="mx-4"
          vertical
        ></v-divider>
        <v-text-field  prepend-icon="mdi-magnify" color="white" class="mt-6" label="Pencarian" v-model="Pencarian"></v-text-field>
        <v-spacer></v-spacer>
      </v-toolbar>
    <!-- <v-row>
      <v-col cols="6">
        <span class="mx-5">history</span>
      </v-col>
      <v-col cols="6">
        <v-text-field style="width:30%" prepend-icon="mdi-magnify" color="#a10115" label="Pencarian" v-model="Pencarian"></v-text-field>
      </v-col>
    </v-row> -->
<table v-show="device == 'Desktop'" style="width:100%">
    <tr class="pa-2">
      <th><v-card style="background-color:whitesmoke" :style="{color:'#a10115'}" class="pa-2">Tes Drive<v-spacer/></v-card></th>
      <th><v-card style="background-color:whitesmoke" :style="{color:'#a10115'}" class="pa-2">Peminjaman</v-card></th>
    </tr>
    <tr>
      <td>
        <v-row dense>
          <v-col
                v-for="(item, i) in DataTesDrive"
                :key="i"
                cols="12"
                class="pa-2"
              >
                <v-card
                 width="880px"
                  color="white"
                >
                  <div class="d-flex flex-no-wrap justify-start">
                    <v-avatar
                      class="ma-3"
                      size="110"
                      tile
                      color="#a10115bf"
                    >
                      <v-icon x-large color="white">mdi-car-traction-control</v-icon>
                    </v-avatar>
                    <div>
                       <v-card-actions class="selanjut">
                        <v-spacer/>
                        <v-btn
                          class="mt-3 mb-n8 mx-15"
                          outlined
                          rounded
                          small
                           @click="ToAksiTesDrive(item)"
                          color="#a10115"
                        >
                          Selengkapnya
                        </v-btn>
                      </v-card-actions>
                      <v-card-title
                        class="text-h5"
                        v-text="item.aset.nama_aset+' | '+item.aset.no_plat"
                      ></v-card-title>

                      <v-card-subtitle v-text="item.penanggung_jawab +' | '+item.tanggal_pemakaian +' - '+item.tanggal_kembali"></v-card-subtitle>
                     
                    </div>
                  </div>
                </v-card>
              </v-col>
              <v-col
                cols="12"
                v-show="DataTesDrive.length == 0"
                class="pa-2"
              >
              <v-card width="860px" height="130px" color="white">
                  <span>No Data</span>
                </v-card>
              </v-col>
        </v-row>
      </td>
      <td>
        <v-row dense>
          <v-col
                v-for="(items, u) in DataPeminjaman"
                :key="u"
                cols="12"
                class="pa-2"
              >
                <v-card
                  color="white"
                  width= "880px"
                >
                  <div class="d-flex flex-no-wrap justify-start">
                    <v-avatar
                      class="ma-3"
                      size="110"
                      tile
                      color="#a10115bf"
                    >
                      <v-icon x-large color="white">mdi-car-key</v-icon>
                    </v-avatar>
                    
                    <div>
                      <v-card-actions class="selanjut">
                        <v-spacer/>
                        <v-btn
                          class="mt-3 mb-n8 mx-15"
                          outlined
                          rounded
                          small
                          color="#a10115"
                          @click="ToAksiPeminjaman(item)"
                        >
                          Selengkapnya
                        </v-btn>
                      </v-card-actions>
                      <v-card-title
                        class="text-h5"
                        v-text="items.aset.nama_aset+' | '+items.aset.no_plat"
                      ></v-card-title>
                      <v-card-subtitle v-text="items.penanggung_jawab +' | '+items.tgl_peminjaman +' - '+items.tgl_pengembalian"></v-card-subtitle>
                    </div>

                    
                  </div>
                </v-card>
              </v-col>
              <v-col
                cols="12"
                v-show="DataPeminjaman.length == 0"
                class="pa-2"
              >
              <v-card width="860px" height="130px" color="white">
                  <span>No Data</span>
                </v-card>
              </v-col>
        </v-row>
      </td>
    </tr>
  </table>

  <v-card elevation="6" v-show="device == 'Mobile'">
    <v-row>
      <v-col cols="6">
        <v-card class="pa-2" @click="ChangeTab('TesDrive')"><v-icon>mdi-car-key</v-icon>Tes Drive</v-card>
      </v-col>
      <v-col cols="6">
        <v-card class="pa-2" @click="ChangeTab('Peminjaman')"> <v-icon>mdi-car-traction-control</v-icon>Peminjaman</v-card>
      </v-col>
    </v-row>
        <v-row dense v-show="ShowTesDrive == true">
          <v-col
                v-for="(itemsz, e) in DataTesDrive"
                :key="e"
                cols="12"
                class="pa-2"
              >
                <v-card
                  color="white"
                >
                  <div class="d-flex flex-no-wrap justify-start">
                    <v-avatar
                      class="ma-3"
                      size="70"
                      tile
                      color="red darken-4"
                    >
                      <!-- <v-img></v-img> -->
                    </v-avatar>
                    <div>
                      <v-card-title
                        class="caption"
                        v-text="itemsz.aset.nama_aset+' | '+itemsz.aset.no_plat"
                      ></v-card-title>

                      <v-card-subtitle v-text="itemsz.penanggung_jawab +' | '+itemsz.tanggal_pemakaian +' - '+(itemsz.tanggal_kembali == null ? '' : itemsz.tanggal_kembali)"></v-card-subtitle>

                      <v-card-actions>

                        <v-btn
                          class="ml-2 mt-n4"
                          outlined
                          rounded
                          small
                        >
                          Selengkapnya
                        </v-btn>
                      </v-card-actions>
                    </div>

                    
                  </div>
                </v-card>
              </v-col>
        </v-row>

        <v-row dense v-show="ShowPeminjaman == true">
          <v-col
                v-for="(itemsz, e) in DataPeminjaman"
                :key="e"
                cols="12"
                class="pa-2"
              >
                <v-card
                  color="white"
                >
                  <div class="d-flex flex-no-wrap justify-start">
                    <v-avatar
                      class="ma-3"
                      size="70"
                      tile
                      color="red darken-4"
                    >
                      <!-- <v-img></v-img> -->
                    </v-avatar>
                    <div>
                      <v-card-title
                        class="caption"
                        v-text="itemsz.aset.nama_aset+' | '+itemsz.aset.no_plat"
                      ></v-card-title>

                      <v-card-subtitle v-text="itemsz.penanggung_jawab +' | '+itemsz.tgl_peminjaman +' - '+(itemsz.tgl_pengembalian == null ? '' : itemsz.tgl_pengembalian)"></v-card-subtitle>

                      <v-card-actions>

                        <v-btn
                          class="ml-2 mt-n4"
                          outlined
                          rounded
                          small
                        >
                          Selengkapnya
                        </v-btn>
                      </v-card-actions>
                    </div>

                    
                  </div>
                </v-card>
              </v-col>
        </v-row>
  </v-card>
  </v-container>
   
</v-card>
</template>
<script>
import API from "@/services/http";
  export default {
    data: () => ({
      dialog: false,
      search:'',
      ShowPeminjaman:false,
      ShowTesDrive:true,
      device:null,
      DataTesDrive:[],
      LockDataTesDrive:[],
      LockDataPeminjaman:[],
      dialogDelete: false,
      headersPeminjaman: [
        { text: 'Actions', value: 'actions', sortable: false , align: 'start',},
        {
          text: 'Penanggung Jawab',
          align: 'start',
          value: 'penanggung_jawab',
        },
        { text: 'Department', value: 'department.nama_department' },
        { text: 'Tujuan', value: 'tujuan' },
        { text: 'Keperluan', value: 'keperluan'},
        { text: 'Tanggal Peminjaman', value: 'tgl_peminjaman'},
        { text: 'Tanggal Pengembalian', value: 'tgl_pengembalian'},
        { text: 'Jam Keluar Kendaraan', value: 'jam_keluar_kendaraan'},
        { text: 'Model Kendaraan', value: 'aset.nama_aset' },
        { text: 'No Pol', value: 'aset.no_plat' },
        { text: 'Kondisi Awal KM', value: 'kondisi_awal_kilometer' },
        { text: 'Kondisi Awal BBM', value: 'kondisi_awal_bbm' },
        { text: 'Kondisi Awal Kebersihan', value: 'kondisi_awal_kebersihan' },
        { text: 'Kondisi Awal Fisik Kendaraan', value: 'kondisi_awal_fisik_kendaraan' },
        { text: 'Approve', value:'approve_peminjaman'}
      ],
      headersTesDrive: [
        { text: 'Actions', value: 'actions', sortable: false , align: 'start',},
        {
          text: 'Penanggung Jawab',
          align: 'start',
          value: 'penanggung_jawab',
        },
        { text: 'Department', value: 'department.nama_department' },
        { text: 'Tujuan', value: 'tujuan' },
        { text: 'Keperluan', value: 'keperluan'},
        { text: 'Tanggal Peminjaman', value: 'tgl_peminjaman'},
        { text: 'Tanggal Pengembalian', value: 'tgl_pengembalian'},
        { text: 'Jam Keluar Kendaraan', value: 'jam_keluar_kendaraan'},
        { text: 'Model Kendaraan', value: 'aset.nama_aset' },
        { text: 'No Pol', value: 'aset.no_plat' },
        { text: 'Kondisi Awal KM', value: 'kondisi_awal_kilometer' },
        { text: 'Kondisi Awal BBM', value: 'kondisi_awal_bbm' },
        { text: 'Kondisi Awal Kebersihan', value: 'kondisi_awal_kebersihan' },
        { text: 'Kondisi Awal Fisik Kendaraan', value: 'kondisi_awal_fisik_kendaraan' },
        { text: 'Approve', value:'approve_peminjaman'}
      ],
      desserts: [],
      Pencarian:null,
      DataPeminjaman:[],
      editedIndex: -1,
    }),

    computed: {
      //
    },

    created () {
      this.device = this.$device
      // this.getDataPeminjaman()
      this.getDataTesDrive()
    },
    watch:{
      Pencarian(val){
        if(val == null || val == ''){
         this.DataTesDrive = this.LockDataTesDrive
         this.DataPeminjaman = this.LockDataPeminjaman
        }else{
          // alert('ko')fin
          let data = []
          for(var i=0; i < this.LockDataTesDrive.length; i++){
            if(this.LockDataTesDrive[i].aset.nama_aset.toLocaleLowerCase().search(val.toLocaleLowerCase()) > -1){
              data.push(this.LockDataTesDrive[i])
            }
          }
          let datap = []
          for(var z=0; z < this.LockDataPeminjaman.length; z++){
            if(this.LockDataPeminjaman[z].aset.nama_aset.toLocaleLowerCase().search(val.toLocaleLowerCase()) > -1){
              datap.push(this.LockDataPeminjaman[z])
            }
          }
          this.DataPeminjaman = datap
          this.DataTesDrive = data
          // console.log(data)
          // this.DataPeminjaman = this.LockDataPeminjaman.filter(x=> this.Pencarian == x.aset.nama_aset)
        }
      }
    },

    methods: {
        filter (value, search) {
        search = search.toString().toLocaleLowerCase()
        return value != null &&
          search != null &&
          typeof value === 'string' &&
          value.toString().toLocaleLowerCase().indexOf(search) !== -1
      },
      
      getDataPeminjaman(){
        let user = JSON.parse(localStorage.getItem('logged'))
        console.log(user)
        let department = user.department.id_department
        this.$loading(true)
        API.get("/historypeminjaman/"+user.nama_lengkap+'/'+department).then(x=>{
          this.DataPeminjaman = x.data.reverse()
          this.LockDataPeminjaman = this.DataPeminjaman
          this.$loading(false)
        })
      },
      ChangeTab(x){
        if(x == 'TesDrive'){
          this.ShowPeminjaman = false
          this.ShowTesDrive = true
          this.getDataTesDrive()
        }
        if(x == 'Peminjaman'){
          this.ShowPeminjaman = true
          this.ShowTesDrive = false
          this.getDataPeminjaman()
        }
      },
      ToAksiPeminjaman(x){
        this.$ChangeURL('HistoryPeminjaman/'+x.id_form_peminjaman)
      },
      ToAksiTesDrive(x){
        this.$ChangeURL('HistoryTesDrive/'+x.id_form_tes_drive)
      },
      getDataTesDrive(){
        let user = JSON.parse(localStorage.getItem('logged'))
        console.log(user)
        let department = user.department.id_department
        this.$loading(true)
        this.getDataPeminjaman()
        API.get("/historytesdrive/"+user.nama_lengkap+'/'+department).then(x=>{
          this.DataTesDrive = x.data.reverse()
          this.LockDataTesDrive = this.DataTesDrive
          this.$loading(false)
        })
      },
    },
  }
</script>
<style>
.selanjut{
  margin-left: 510px !important;
}
</style>
