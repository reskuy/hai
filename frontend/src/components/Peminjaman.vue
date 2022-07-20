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
      <v-toolbar class="mb-3"
      color="#a10115"
      elevation="4"
      dark
      >
        <v-toolbar-title>Data Peminjaman</v-toolbar-title>
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
    <template v-slot:[`item.approve_peminjaman`]="{ item }">
      <v-icon
      small
      color="green"
      class="ma-2"
      @click="acc(item)"
      >
        mdi-check-outline
      </v-icon>
      <v-divider/>
      <v-icon
      small
      color="red"
      class="ma-2"
      @click="cancel(item)"
      >
        mdi-close-outline
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
        { text: 'Tanggal Peminjaman', value: 'TanggalPeminjaman'},
        {
          text: 'Penanggung Jawab',
          align: 'start',
          value: 'penanggung_jawab',
        },
        { text: 'Department', value: 'department.nama_department' },
        { text: 'Model Kendaraan', value: 'aset.nama_aset' },
        { text: 'No Pol', value: 'aset.no_plat' },
        { text: 'Actions', value: 'actions', sortable: false , align: 'center',},
        { text: 'Approve', value:'approve_peminjaman', sortable: false , align: 'center',}
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
          x.data.forEach(z => {
            z.TanggalPeminjaman = this.$DateConvert(z.tgl_peminjaman)
          });
          this.DataPeminjaman = x.data.reverse()
          this.$loading(false)
        })
      },
      acc(x){
        console.log(x)
        alert('acc')
      },
      cancel(x){
        console.log(x)
        alert('cancel')
      }
    },
  }
</script>
