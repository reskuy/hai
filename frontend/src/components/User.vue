<template>
  <v-data-table
    :headers="headers"
    :items="DataUser"
    :search="search"
    class="elevation-1"
    :custom-filter="filter"
  >
    <template v-slot:top>
      <v-toolbar
        color="red darken-4"
        elevation="4"
        dark
      >
        <v-toolbar-title>Data User</v-toolbar-title>
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
        <v-btn class="ma-2" color="red darken-4" @click="ChangeURL('FormDataUser')" elevation="6" dark><v-icon>mdi-plus</v-icon></v-btn>
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
      small
        class="mr-2"
        @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
      small
        @click="DeleteDialog(item)"
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
        { text: 'Username', value: 'username' },
        { text: 'Password', value: 'password' },
      ],
      desserts: [],
      DataUser:[],
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
      this.getDataUser()
    },

    methods: {
    editItem(x){
      console.log(x)
      this.$Store(x)
      this.ChangeURL('FormDataUser')
    },
    deleteItem(x){
      API.delete('/user/'+x.id_user).then(x=>{
        console.log(x)
          this.$Toast('success','Data Berhasil Dihapus')
          this.$loading(true)
          this.getDataUser()
      })
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
      filter (value, search) {
        search = search.toString().toLocaleLowerCase()
        return value != null &&
          search != null &&
          typeof value === 'string' &&
          value.toString().toLocaleLowerCase().indexOf(search) !== -1
      },
      ChangeURL(x){
        if(this.$route.path == '/'+x){
            return
        }
        if(x == 'auth'){
          return this.LogOut()
        }else{
          return this.$router.push('/'+x)
        }
      }, 
      getDataUser(){
        API.get("/user").then(x=>{
          this.DataUser = x.data
          this.$loading(false)
        })
      },
    },
  }
</script>