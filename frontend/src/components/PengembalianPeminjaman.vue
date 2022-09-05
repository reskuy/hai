<template>
<v-sheet height="100%" fluid
    :style="{backgroundColor:'#c8d2d8'}">
  <v-sheet
    class="rounded"
    v-show="loading == true"
      color="gray lighten-2"
    >
      <v-skeleton-loader
        class="mt-4"
        type="text@2,table-heading,table-thead,table-tbody,table-tfoot"
      ></v-skeleton-loader>
    </v-sheet>
    <v-container fluid
    style="height:100%"
    :style="{backgroundColor:'#c8d2d8'}">
  <v-data-table
    :headers="headers"
    :items="DataPengembalian"
    :search="search"
    v-show="loading == false"
    class="elevation-4"
    :custom-filter="filter"
  >
<!--Desktop-->
    <template v-slot:top>
      <v-toolbar
      color="#a10115"
      elevation="4"
      dark
      v-show="device == 'Desktop'">
        <v-toolbar-title>Pengembalian Kendaraan Operasional</v-toolbar-title>
        <v-divider
          class="mx-4"
          vertical
        ></v-divider>
        <v-text-field
        prepend-icon="mdi-magnify"
        class="mt-6"
          v-model="search"
          label="Pencarian"
        ></v-text-field>
        <v-spacer></v-spacer>
      </v-toolbar>
    <!--mobile-->
    <v-toolbar
      color="#a10115"
      elevation="4"
      dark
      v-show="device == 'Mobile'">
        <v-toolbar-title style="font-size:11px" class="pencarian mr-2 ml-n1 mt-4">Pengembalian <p>Kendaraan</p></v-toolbar-title>
        <v-text-field
          prepend-icon="mdi-magnify"
          class="mt-6"
          v-model="search"
          label="Pencarian">
        </v-text-field>
    </v-toolbar>

    </template>
    <template v-slot:[`item.id_kembali_peminjaman`]="{ item }">
      <v-chip class="m">{{item.id_kembali_peminjaman}}</v-chip>
    </template>
    <template v-slot:[`item.actions`]="{ item }">
      <v-icon
      small
      class="ma-2"
        @click="fungsiAksi(item)"
      >
        mdi-eye
      </v-icon>
      <!-- <v-icon
      small
        @click="deleteItem(item)"
      >
        mdi-delete
      </v-icon> -->
    </template>
    <template v-slot:[`item.approve_pengembalian_peminjaman`]="{ item }">
      <!-- ini untuk hr approve -->
      <v-chip 
      class="mt-1 mb-1 mx-2" 
      @click="accHRGA(item)"
      v-show="item.acc_hr == null && logged.level == 4">
      <v-icon
      small
      color="green"
      class="ma-2"
      >
        mdi-check-outline
      </v-icon>
      </v-chip >
      <!-- <v-divider v-show="item.acc_hr == null  && logged.level == 4"/> -->
      <v-chip 
      class="mt-1 mb-1 mx-2" 
      @click="cancelHRGA(item)"
      v-show="item.acc_hr == null && logged.level == 4">
      <v-icon
      small
      color="red"
      class="ma-2"
      >
        mdi-close-outline
      </v-icon>
      </v-chip>
      <v-chip v-show="item.acc_hr != null && item.acc_hr != 'N' && logged.level < 5 && item.approve_pengembalian_kendaraan == null">HR GA<v-icon small>mdi-check</v-icon></v-chip>
      <v-chip v-show="item.acc_hr == 'N' && logged.level < 5 && item.approve_pengembalian_kendaraan == null">HR GA<v-icon small>mdi-close</v-icon></v-chip>
      <v-chip class="mt-2" v-show="item.acc_hr == null && logged.level < 4 && item.approve_pengembalian_kendaraan == null"><b style="font-size:12px;">Menunggu</b></v-chip>
      <!-- end of hr approve -->

      <!-- end of manager approve -->

      <v-icon
      small
      v-show="item.approve_pengembalian_kendaraan == 'ACC'"
      class="ma-2"
      color="green">
        mdi-check-outline
      </v-icon>

    </template>
    <template v-slot:no-data>
      <span>Mohon Tunggu</span>
    </template>
  </v-data-table>
  </v-container>
</v-sheet>
</template>
<script>
import API from "@/services/http";
  export default {
    data: () => ({
      dialog: false,
      search:'',
      logged:[],
      device:null,
      loading:true,
      dialogDelete: false,
      headers: [
        { text: 'No Refrensi', value: 'id_kembali_peminjaman', align:'center' },
        { text: 'Tanggal Pengembalian', value: 'TanggalPengembalian'}, 
        {
          text: 'Penanggung Jawab',
          align: 'start',
          value: 'peminjaman.penanggung_jawab',
        },
        { text: 'Department', value: 'peminjaman.department.nama_department' },
        { text: 'Model Kendaraan', value: 'peminjaman.aset.nama_aset' },
        { text: 'No Pol', value: 'peminjaman.aset.no_plat' },
        { text: 'Jam Masuk', value: 'jam_masuk_kendaraan' },
        { text: 'Actions', value: 'actions', sortable: false , align: 'start',},
        { text: 'Approve Pengembalian Peminjaman', value: 'approve_pengembalian_peminjaman',align: 'center' },
      ],
      desserts: [],
      DataPengembalian:[],
      editedIndex: -1,
    }),

    computed: {
      //
    },

    watch: {
      //
    },

    created () {
      this.logged = this.$SetLog()
      this.getDataPengembalian()
    },
    mounted(){
      this.device = this.$device
    },

    methods: {
        filter (value, search) {
        search = search.toString().toLocaleLowerCase()
        return value != null &&
          search != null &&
          typeof value === 'string' &&
          value.toString().toLocaleLowerCase().indexOf(search) !== -1
      },
      fungsiAksi(item){
        this.$Store(item)
        this.$ChangeURL('PengembalianPeminjaman/'+item.id_kembali_peminjaman)
      },
      getDataPengembalian(){
        // this.$loading(true)
        this.Seen()
        API.get("/pengembalianpeminjaman").then(x=>{
          x.data.forEach(z => {
            z.TanggalPengembalian = this.$DateConvert(z.tgl_pengembalian)
          });
          this.DataPengembalian = x.data.reverse()
          // this.$loading(false)
          this.loading = false
        })
      },
      accHRGA(x){
        this.$loading(true)
        x.accby = JSON.parse(localStorage.getItem('logged')).nama_lengkap
        x.title = 'Approve Pengembalian'
        API.put("/approvepengembalianpeminjaman/"+x.id_kembali_peminjaman,{
              AccBy:'HRGA',
              AccHR:x.accby,
              IdAset:x.peminjaman.aset.id_aset,
              Approve:'ACC',
            }).then(c=>{
          console.log(c)
          this.$loading(false)
          this.KirimNotif(x)
          this.loading = true
          this.getDataPengembalian()
          this.$Toast('success','Approve By HRGA')
        })
      },
      cancelHRGA(x){
        this.$loading(true)
        x.accby = JSON.parse(localStorage.getItem('logged')).nama_lengkap
        x.title = 'Reject Pengembalian'
        API.put("/approvepengembalianpeminjaman"+x.id_kembali_peminjaman,{
              AccBy:'HRGA',
              AccHR:'N',
              Approve:'REJECT',
              IdAset:x.peminjaman.aset.id_aset,
            }).then(c=>{
            this.$loading(false)
            console.log(c)
            this.KirimNotif(x)
            this.loading = true
            this.getDataPengembalian()
            this.$Toast('success','Cancel By HRGA')
        })
      },
      Seen(){
        API.get('seen/p_peminjaman/'+this.logged.id_user)
      },
    },
  }
</script>
<style>
.pencarian{
  width: 150px;
}
</style>
