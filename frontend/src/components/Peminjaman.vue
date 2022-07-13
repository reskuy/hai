<template>
<v-card height="100hv">
  <v-data-table
    :headers="headers"
    :items="DataPeminjaman"
    :search="search"
    class="elevation-4"
    :custom-filter="filter"
  >
    <template v-slot:top>
      <v-toolbar
      color="red darken-4"
      elevation="4"
      dark
      >
        <v-toolbar-title>Data Peminjaman</v-toolbar-title>
        <v-divider
          class="mx-4"
          vertical
        ></v-divider>
        <v-text-field
        class="mt-6"
          v-model="search"
          label="Pencarian"
        ></v-text-field>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5">Are you sure you want to delete this item?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text>Cancel</v-btn>
              <v-btn color="blue darken-1" text>OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:[`item.actions`]="{ item }">
      <v-icon
      small
      class="ma-2"
        @click="editItem(item)"
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
    <template v-slot:[`item.approve_form_tes_drive`]="{ item }">
      <v-icon
      small
      class="ma-2"
      @click="editItem(item)"
      >
        mdi-finger
      </v-icon>
    </template>
    <template v-slot:no-data>
      <span>Mohon Tunggu</span>
    </template>
  </v-data-table>
</v-card>
</template>
<script>
import API from "@/services/http";
  export default {
    data: () => ({
      dialog: false,
      search:'',
      dialogDelete: false,
      headers: [
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
      DataPeminjaman:[],
      editedIndex: -1,
    }),

    computed: {
      //
    },

    watch: {
      //
    },

    created () {
      this.getDataPeminjaman()
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
        this.$loading(true)
        API.get("/formpeminjaman").then(x=>{
          this.DataPeminjaman = x.data.reverse()
          this.$loading(false)
        })
      },
    },
  }
</script>
