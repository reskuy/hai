<template>
<v-card height="100hv">
  <v-data-table
    :headers="headers"
    :items="DataPengembalian"
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
        <v-toolbar-title>Data Pengembalian</v-toolbar-title>
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
        { text: 'Tanggal Peminjaman', value: 'tgl_peminjaman'},
        { text: 'Tanggal Pengembalian', value: 'tgl_pengembalian'}, 
        { text: 'Kondisi Akhir BBM', value: 'kondisi_akhir_bbm'},
        { text: 'Kondisi Akhir Kilometer', value: 'kondisi_akhir_kilometer' },
        { text: 'Kondisi Akhir Kebersihan', value: 'kondisi_akhir_kebersihan_kendaraan' },
        { text: 'Kondisi Akhir Fisik', value: 'kondisi_akhir_fisik_kendaraan' },
        { text: 'Jam Masuk', value: 'jam_masuk_kendaraan' },
        { text: 'Approve Pengembalian Tes Drive', value: 'approve_pengembalian_tes_drive' },
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
      this.getDataPengembalian()
    },

    methods: {
        filter (value, search) {
        search = search.toString().toLocaleLowerCase()
        return value != null &&
          search != null &&
          typeof value === 'string' &&
          value.toString().toLocaleLowerCase().indexOf(search) !== -1
      },
      getDataPengembalian(){
        this.$loading(true)
        API.get("/pengembaliantesdrive").then(x=>{
          this.DataPengembalian = x.data.reverse()
          this.$loading(false)
        })
      },
    },
  }
</script>
