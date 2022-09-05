<template>
<v-container
fluid
    style="height:100%"
    :style="{backgroundColor:'#c8d2d8'}">
  <v-data-table
    :headers="headers"
    :items="DataUser"
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
        <v-toolbar-title>Data User</v-toolbar-title>
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
           class="account ma-2" 
           color="white" 
           @click="ChangeURL('FormDataUser')">mdi-account-multiple-plus</v-icon>
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
          <v-toolbar-title class="pencarian" style="font-size:13px">Data User</v-toolbar-title>
          
          <v-spacer></v-spacer>
          <v-icon class="mr-1" @click="ChangeURL('FormDataUser')">mdi-account-multiple-plus</v-icon>
          <v-spacer></v-spacer>
          <v-text-field
          
            prepend-icon="mdi-magnify"
            class="pencarian mt-6"
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
    <template v-slot:no-data>
      <span>Mohon Tunggu</span>
    </template>
  </v-data-table>
  </v-container>
</template>
<script>
import API from "@/services/http";
  export default {
    data: () => ({
      dialog: false,
      device: null,
      dialogDelete: false,
      headers: [
        { text: 'No User', value: 'No' },
        { text: 'Nama Lengkap', value: 'nama_lengkap' },
        { text: 'Department', value: 'department.nama_department' },
        { text: 'Username', value: 'username' },
        { text: 'Password', value: 'Secret' },
        { text: 'Level', value: 'level' },
        { text: 'Actions', value: 'actions', sortable: false , align: 'start',},
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
      this.device = this.$device
      console.log(this.$UserLogged())
      if(this.$UserLogged().level !=  3){
        return this.$ChangeURL('')
      }
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
          let i= 1
          x.data.forEach(z => {
            z.No = i
            z.Secret = '********'
            i++
          });
          this.DataUser = x.data
          this.$loading(false)
        })
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
.account{
  font-size:26px !important;

}
.judul{
width:70px;
}
</style>