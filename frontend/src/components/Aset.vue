<template>
  <v-data-table
    :headers="headers"
    :items="DataAset"
    sort-by="calories"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar
        flat
      >
        <v-toolbar-title>Data Aset</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
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
        class="mr-2"
        @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
      small
        @click="deleteItem(item)"
      >
        mdi-delete
      </v-icon>
    </template>
    <template v-slot:no-data>
      <v-btn
        color="primary"
      >
        Reset
      </v-btn>
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
        { text: 'Actions', value: 'actions', sortable: false , align: 'start',},
        {
          text: 'Jenis Aset',
          align: 'start',
          value: 'jenis_aset',
        },
        { text: 'Nama Aset', value: 'nama_aset' },
        { text: 'Warna', value: 'warna' },
        { text: 'No Pol', value: 'no_plat' },
        { text: 'No Pol', value: 'aset.no_plat' },
        { text: 'Status Aset', value: 'status' },
        { text: 'Kondisi Aset', value: 'kondisi_aset' },
      ],
      desserts: [],
      DataAset:[],
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
      this.getDataAset()
    },

    methods: {
      getDataAset(){
        API.get("/aset").then(x=>{
          this.DataAset = x.data
        })
      },
    },
  }
</script>
