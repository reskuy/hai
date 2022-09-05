<template>

<v-card fluid
    style="height:100%"
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
    <v-container
    fluid
    style="height:100%"
    :style="{backgroundColor:'#c8d2d8'}">
  <v-data-table
    :headers="headers"
    :items="DataAset"
    v-show="loading == false"
    :search="search"
    class="elevation-1"
    :custom-filter="filter"
  >
    <template v-slot:top>

      <!--desktop-->
      <v-toolbar
        color="#a10115"
        elevation="4"
        dark
        v-show="device == 'Desktop'"
      >
        <v-toolbar-title>Data Aset</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-tooltip right color="white">
          <template v-slot:activator="{ on, attrs }">
          <v-icon 
          large
           v-bind="attrs"
           v-on="on" 
           class="note mr-1 ma-2" 
           @click="ChangeURL('FormDataAset')">mdi-car-2-plus</v-icon>
           </template>
           <span style="color: black;"><b>Input</b></span>
           </v-tooltip>
        <v-spacer></v-spacer>
        
        <v-text-field
          prepend-icon="mdi-magnify"
          class="mt-6"
          v-model="search"
          label="Pencarian"
        ></v-text-field>
          <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-toolbar color="red darken-4" dark><span class="text-overline"><v-icon>mdi-alert</v-icon></span></v-toolbar>
            <!-- <v-card-title class="text-h5">Apakah Yakin Akan Menghapus Data ini?</v-card-title> -->
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="red darken-1" text @click="BatalHapus">Batal</v-btn>
              <v-btn color="red darken-1" text @click="Hapus">Hapus</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>

      <!--Mobile-->
      <v-toolbar
        color="#a10115"
        elevation="4"
        dark
        v-show="device == 'Mobile'">
          <v-toolbar-title class="pencarian ml-n1" style="font-size:13px">Data Aset</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-icon class="mr-1" color="white" @click="ChangeURL('FormDataAset')">mdi-car-2-plus</v-icon>
          <v-spacer></v-spacer>
          <v-text-field
            prepend-icon="mdi-magnify"
            class="mt-6 ml-1"
            v-model="search"
            label="Pencarian"
          ></v-text-field>
        </v-toolbar>

    </template>
    <template v-slot:[`item.No`]="{ item }">
      <v-chip class="m">{{item.No}}</v-chip>
    </template>
    <template v-slot:[`item.actions`]="{ item }">
      <v-icon
      
        class="mr-2"
        @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
      
        @click="DeleteDialog(item)"
      >
        mdi-delete
      </v-icon>
    </template>
    <template v-slot:[`item.status_aset`]="{ item }">
      <v-tooltip left color="#a10115">
        <template v-slot:activator="{ on, attrs }">
          <v-icon
            class="ml-n3"
            :color="item.status_aset == 'READY' ? '#a10115' : 'grey'"
            v-bind="attrs"
            v-on="on"
          >
            mdi-car-back
          </v-icon>
        </template>
        <span v-text="item.status_aset == 'READY' ? 'READY' : item.kondisi_aset == 'DAILY' ? 'READY' : 'NOT READY'"></span>
      </v-tooltip>
    </template>
    <template v-slot:[`item.kondisi_aset`]="{ item }">
      <v-tooltip left color="#a10115">
        <template v-slot:activator="{ on, attrs }">
          <v-icon
          class="mt-n1"
          v-bind="attrs"
          v-on="on"
          v-show="item.kondisi_aset == null ? null : item.kondisi_aset.match('TES DRIVE')"
          >
            mdi-car-traction-control
          </v-icon>
        </template>
        <span v-text="item.kondisi_aset"></span>
      </v-tooltip>
      <v-tooltip left color="#a10115">
        <template v-slot:activator="{ on, attrs }">
          <v-icon
          class="mt-n1"
          v-bind="attrs"
          v-on="on"
          v-show="item.kondisi_aset == null ? null : item.kondisi_aset.match('BEROPERASI')"
          >
            mdi-car-key
          </v-icon>
        </template>
        <span v-text="item.kondisi_aset"></span>
      </v-tooltip>
      <v-tooltip left color="#a10115">
        <template v-slot:activator="{ on, attrs }">
          <v-icon
          class="mt-n1"
          v-bind="attrs"
          v-on="on"
          v-show="item.kondisi_aset == null ? null : item.kondisi_aset.match('DAILY')"
          >
            mdi-car-clock
          </v-icon>
        </template>
        <span v-text="item.kondisi_aset"></span>
      </v-tooltip>
      <v-tooltip left color="#a10115">
        <template v-slot:activator="{ on, attrs }">
          <v-icon
          class="mt-n1"
          v-bind="attrs"
          v-on="on"
          v-show="item.kondisi_aset == null ? null : item.kondisi_aset.match('DIPINJAM')"
          >
            mdi-car-key
          </v-icon>
        </template>
        <span v-text="item.kondisi_aset"></span>
      </v-tooltip>
    </template>
    <template v-slot:no-data>
      <span>Mohon Tunggu</span>
    </template>
  </v-data-table>
  </v-container>
</v-card>
</template>
<script>
import API from "@/services/http";
  export default {
    data: () => ({
      dialog: false,
      device: null,
      logged:[],
      loading:true,
      JmlhAset:'',
      dialogDelete: false,
      headers: [
        {
          text: 'No',
          align: 'start',
          value: 'No',
        },
        {
          text: 'Jenis Aset',
          align: 'start',
          value: 'jenis_aset',
        },
        { text: 'Nama Aset', value: 'nama_aset' },
        { text: 'Warna', value: 'warna' },
        { text: 'No Pol', value: 'no_plat' },
        { text: 'BBM', value: 'BBM' },
        { text: 'KM', value: 'KM' },
        { text: 'Status Aset', value: 'status_aset' ,align: 'center',},
        { text: 'Kondisi Aset', value: 'kondisi_aset',align: 'center', },
      ],
      desserts: [],
      DataAset:[],
      search:'',
      editedIndex: -1,
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
      },
    },

    watch: {
      //
    },

    created () {
      // this.$loading(true)
      this.logged = this.$SetLog()
      this.device = this.$device
      this.aksicek()
      this.getDataAset()
    },
    mounted(){
      //
    },

     methods: {
    aksicek(){
      if(this.logged.level == 4 || this.logged.level == 3){
        this.headers.push({ text: 'Actions', value: 'actions', sortable: false , align: 'center',})
      }
    },
    editItem(x){
      this.$Store(x)
      console.log(x)
      this.ChangeURL('FormDataAset')
    },
    DeleteDialog(x){
        this.$Store(x)
        this.dialogDelete = true
    },
    BatalHapus(){
      this.$Store(null)
      this.dialogDelete = false
    },
    Hapus(){
      this.dialogDelete = false
      let z = this.$CekStore() == null ? [] : this.$CekStore()
      this.deleteItem(z)
      this.$Store(null)
    },
    deleteItem(x){
      API.delete('aset/'+x.id_aset).then(c=>{
        console.log(c)
        this.getDataAset()
        this.log(x)
        this.$Toast('success','Data Aset Di Hapus')
      })
    },
    log(x){
      let data = {
        User:this.$UserLogged(),
        Status:'Menghapus Data Aset '+x.jenis_aset+' '+x.nama_aset+' '+x.no_plat
      }
      API.post('log',data).then(c=>{
        console.log(c)
      })
    },
    ChangeURL(x){
      this.$ChangeURL(x)
    },
    filter(value, search){
      search = search.toString().toLocaleLowerCase()
      return value != null &&
      search != null &&
      typeof value === 'string' &&
      value.toString().toLocaleLowerCase().indexOf(search) !== -1
    },
    getDataAset(){
      this.Seen()
      API.get("/aset").then(x=>{
      let i = 1
      x.data.forEach(z => {
        z.No =i
        i++
      });
      this.DataAset = x.data
      this.loading = false
      this.$loading(false)
      })
    },
    Seen(){
      API.get('seen/aset/'+this.logged.id_user)
      },
    },
  }
</script>
<style>
.aset{
  background-color: #a10115 !important;
  margin-right: 2px;
  border:2px solid #ffffff75 !important;
}
.pencarian{
  width: 150px;
}
.note{
  font-size:35px !important;
}
</style>
