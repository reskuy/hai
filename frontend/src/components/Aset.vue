<template>
  <v-data-table
    :headers="headers"
    :items="DataAset"
    :search="search"
    class="elevation-1"
    :custom-filter="filter"
  >
    <template v-slot:top>
      <v-toolbar
        color="#a10115"
        elevation="4"
        dark
      >
        <v-toolbar-title>Data Aset</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-text-field
          prepend-icon="mdi-magnify"
          class="mt-6"
          v-model="search"
          label="Pencarian"
        ></v-text-field>
        <v-spacer></v-spacer>
        <v-btn class="ma-2" color="#f0efea" @click="ChangeURL('')" elevation="6" rounded><v-icon color="#a10115" >mdi-home-outline</v-icon></v-btn>
        <v-btn class="ma-2" color="#f0efea" @click="ChangeURL('FormDataAset')" elevation="6" rounded><v-icon color="#a10115" >mdi-note-plus-outline</v-icon></v-btn>
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
      <v-tooltip left>
        <template v-slot:activator="{ on, attrs }">
          <v-icon
            class="ml-n3"
            :color="item.status_aset == 'READY' ? 'red darken-4' : item.status_aset == 'DAILY' ? 'red darken-4' : 'grey'"
            v-bind="attrs"
            v-on="on"
          >
            mdi-car-back
          </v-icon>
        </template>
        <span v-text="item.status_aset == 'READY' ? 'READY' : item.status_aset == 'DAILY' ? 'READY' : 'NOT READY'"></span>
      </v-tooltip>
    </template>
    <template v-slot:[`item.kondisi_aset`]="{ item }">
      <v-icon
      class="ml-n3"
      v-show="item.status_aset == 'DAILY'"
      >
        mdi-car-back
      </v-icon>
      <v-icon
      class="mt-n1"
      v-show="item.status_aset == 'DAILY'"
      >
        mdi-car-clock
      </v-icon>
      <v-icon
      class="ml-n3"
      v-show="item.status_aset == 'DIPINJAM'"
      >
        mdi-car-key
      </v-icon>
    </template>
    <template v-slot:no-data>
      <span>Mohon Tunggu</span>
    </template>
  </v-data-table>
</template>
<script>
import API from "@/services/http";
  export default {
    data: () => ({
      dialog: false,
      dialogDelete: false,
      headers: [
        { text: 'Actions', value: 'actions', sortable: false , align: 'center',},
        {
          text: 'Jenis Aset',
          align: 'start',
          value: 'jenis_aset',
        },
        { text: 'Nama Aset', value: 'nama_aset' },
        { text: 'Warna', value: 'warna' },
        { text: 'No Pol', value: 'no_plat' },
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
      this.$loading(true)
      this.getDataAset()
    },

    methods: {
    editItem(x){
      this.$Store(x)
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
      API.get("/aset").then(x=>{
      this.DataAset = x.data
      this.$loading(false)
      })
    },
    },
  }
</script>
