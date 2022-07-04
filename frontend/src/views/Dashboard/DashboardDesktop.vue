<template>
<v-card
    class="mx-auto"
  >

    <v-dialog
      v-model="dialog"
      persistent
      transition="dialog-top-transition"
    >
    <v-app-bar
      dark
      color="blue darken-4"
    >
      <v-toolbar-title>Pengguna</v-toolbar-title>
    </v-app-bar>
    <v-card>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col
                cols="12"
                sm="12"
                md="12"
              >
                <v-text-field
                  label="Isi Nama Anda*"
                  required
                  v-model="UserPengguna"
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
                sm="12"
                md="12"
              >
                <v-select
                  label="Pilih Department Anda*"
                  required
                  item-value="id_department"
                  item-text="nama_department"
                  :items="Departmentdata"
                  v-model="Department"
                ></v-select>
              </v-col>
              <v-col cols="12"
                sm="12"
                md="12">
                <v-btn
                block
                dark
                color="blue darken-4"
                class="btn btn-primary rounded-lg text-capitalize mt-n6"
                @click="SavePengguna()"
                >
                Masuk
                </v-btn>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
      </v-card>
    </v-dialog>

<v-container>
  <v-row dense>
    <v-col cols="12" v-show="formhide == false">
        <v-card
        color="#385F73"
        dark
        >
        <v-card-title class="text-h5">
            Buat Form
            <v-spacer/>
            <v-btn @click="formhide = true" icon>
            <v-icon>mdi-close</v-icon>
            </v-btn>
        </v-card-title>

        <v-card-subtitle>Ajukan Peminjaman Dan Tes Drive Secara Online.</v-card-subtitle>

        <v-card-actions>
            <v-btn @click="ChangeURL('formtesdrive')" text>
            Buat Sekarang
            </v-btn>
        </v-card-actions>
        </v-card>
    </v-col>

    <v-col v-for="(item, i) in items"
          :key="i"
          cols="4">
        <v-card
            class="ma-3 mb-3"
            max-width="344"
            outlined
        >
            <v-list-item three-line>
            <v-list-item-content>
                <!-- <div class="text-overline mb-4">
                Asset
                </div> -->
                <v-list-item-title class="text-h5 mb-1" v-text="item.title">
                </v-list-item-title>
                <v-list-item-subtitle v-text="'Total '+item.title"></v-list-item-subtitle>
                <v-list-item-subtitle class="text-h5" v-text="item.count"></v-list-item-subtitle>
            </v-list-item-content>

            <v-list-item-avatar
                size="50"
                dark
                :color="item.color"
            >
            <v-icon v-text="item.icon"/></v-list-item-avatar>
            </v-list-item>

            <v-card-actions>
            <v-btn
                outlined
                rounded
                text
            >
                Lihat Data
            </v-btn>
            </v-card-actions>
        </v-card>
    </v-col>
  </v-row>
</v-container>
<v-footer>
    <span>Versi : 1.0</span>
    <v-spacer/>
    <span>By Rifka Karin Afinda</span>
  </v-footer>
</v-card>
</template>
<script>
import API from "@/services/http";
  export default {
    data: () => ({
    formhide:false,
    dialog:true,
    UserPengguna:null,
    Department:null,
    Departmentdata:[],
    userlogged:localStorage.getItem('userlogged'),
    accitem: [
        {
            to:'auth',
            text:'Logout'
        },
        {
            to:'setting',
            text:'Pengaturan'
        }
      ],
      items: [
        {
          color: '#1F7087',
          icon: 'mdi-briefcase',
          title: 'Asset',
          data: 'Asset',
          count:1,
          to:'Asset'
        },
        {
          color: '#1F7000',
          icon: 'mdi-account',
          title: 'Peminjaman',
          data: 'Peminjaman',
          count:1,
          to:'Peminjaman'
        },
        {
          color: '#1F7555',
          icon: 'mdi-note',
          title: 'Tes Drive',
          data: 'Tes Drive',
          count:1,
          to:'TesDrive'
        },
      ],
    }),
    mounted(){
        let userlogged = localStorage.getItem('userlogged')
        let department=localStorage.getItem('departmentlogged')
        this.getDepartment()
        if(userlogged){
            this.dialog = false
            this.department=department
        }
    },
    methods:{
      getDepartment(){
        API.get("/department").then(x=>{
          this.Departmentdata=x.data
        })
      },
      LogOut(){
        localStorage.removeItem('userlogged')
        localStorage.removeItem('logged')
        localStorage.removeItem('departmentlogged')
        this.$router.go('/auth')
      },
      ChangeURL(x){
        this.$router.push('/'+x)
      }, 
        SavePengguna(){
            let Department = this.Departmentdata.find(x=>x.id_department == this.Department)
            localStorage.setItem('userlogged',this.UserPengguna)
            localStorage.setItem('departmentlogged',JSON.stringify(Department))
            this.userlogged = this.UserPengguna
            this.$logged()
            this.dialog = false
        }
    }
  }
</script>