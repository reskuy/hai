<template>
<v-container
    fluid
    style="height:100%"
    :style="{backgroundColor:'#c8d2d8'}">
  <div> 
    <v-container fluid>
      <div class="mx-auto" :style="mobile ? '' : 'max-width: 600px;'">
        <v-card flat class="rounded-lg pa-2" :outlined="$vuetify.theme.dark ? true : false" :color="$vuetify.theme.dark ? '' : 'grey lighten-2'">
          <v-sheet outlined class="rounded-lg" :color="$vuetify.theme.dark ? '' : ''">
            <v-toolbar flat class="rounded-t-lg" :color="$vuetify.theme.dark ? '' : ''">
              <v-skeleton-loader type="heading" width="200px" v-show="loading == true"/>
              <v-toolbar-title class="title">Log</v-toolbar-title>
              <v-spacer></v-spacer>
              <v-dialog
                color="red darken-4"
                ref="dialogTanggal"
                v-model="menuTgl"
                :return-value.sync="tgl"
                persistent
                width="290px"
              >
                <template v-slot:activator="{ on, attrs }">
                  <v-text-field
                    color="red darken-4"
                    v-model="tgl"
                    class="mt-5 pa-2"
                    label="Estimasi Tanggal Kembali"
                    prepend-icon="mdi-calendar"
                    readonly
                    v-bind="attrs"
                    v-on="on"
                  ></v-text-field>
                </template>
                <v-date-picker
                  color="red darken-4"
                  v-model="tgl"
                  scrollable
                >
                  <v-spacer></v-spacer>
                  <v-btn
                    text
                    color="red darken-4"
                    @click="menuTgl = false"
                  >
                    Batal
                  </v-btn>
                  <v-btn
                    text
                    color="red darken-4"
                    @click="changeTgl(tgl)"
                  >
                    OK
                  </v-btn>
                </v-date-picker>
              </v-dialog>
            </v-toolbar>

            <v-divider></v-divider>

            <!-- <v-divider></v-divider> -->

            <v-skeleton-loader type="list-item-two-line" width="100%" v-show="loading == true"></v-skeleton-loader>

            <v-timeline
              dense
              class="ml-n3"
              v-show="loading == false"
            >
              <v-timeline-item
              color="red darken-4"
              v-for="log in Log"
             :key="log.Jam+log.Job">
                <v-card :outlined="$vuetify.theme.dark ? true : false" class="pl-3 pb-2 pt-1 mr-4 rounded-lg ml-n2">
                  <v-row dense class="pt-1">
                    <v-col cols="4" sm="3" md="2" lg="2">
                      <strong>{{log.Jam}}</strong>
                      <div class="text-caption">
                        {{log.Tanggal}}
                      </div>
                    </v-col>
                    <v-col class="mt-2" cols="11" sm="8" md="9" lg="9">
                      <strong>{{log.Status}}</strong>
                      <!-- <div class="text-caption">
                        {{log.Status}}
                      </div> -->
                    </v-col>
                  </v-row>
                </v-card>
              </v-timeline-item>
            </v-timeline>
            <v-card v-show="Log.length == 0">
              Sedang Menunggu...
            </v-card>
          </v-sheet>
        </v-card>
      </div>

      <v-fab-transition>
        <v-btn
          :color="$vuetify.theme.dark ? 'grey darken-3' : 'grey darken-1'"
          v-scroll="onScroll"
          v-show="fab"
          fab
          small
          dark
          fixed
          bottom
          right
          @click="toTop"
        >
          <v-icon>mdi-chevron-up</v-icon>
        </v-btn>
      </v-fab-transition>
    </v-container>
  </div>
  </v-container>
</template>

<script>
import api from "@/services/http";
  export default {
    data: () => ({
      fab: false,
      mobile:null,
      tgl:(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
      windowSize: {x: 0, y: 0},
      loading:false,
      DialogUserMenu: false,
      editedIndex: -1,
      token:null,
      menuTgl:false,
      MenuTemp:[],
      ParentTemp:[],
      ObjectTemp:[],
      ParentSelect:null,
      JabatanSelect:null,
      resMenu:[],
      Log:[],
    }),

    mounted(){
      this.token = localStorage.getItem('token')
      this.getLog()
      this.ee()
    },

    computed: {
      formTitleUserMenu () {
        return this.editedIndex === -1 ? 'Tambah User Menu' : 'Ubah User Menu'
      },
    },

    watch: {
      windowSize(){
        if (this.windowSize.x < 700) {
          this.titleClass = "d-none"
          this.mobile = true
        }else{
          this.titleClass = "mr-4"
          this.mobile = false
        }
      },
    },

    DialogUserMenu (val) {
      val || this.KeluarDialogUserMenu()
    },

    methods: {
      onScroll (e) {
        if (typeof window === 'undefined') return
        const top = window.pageYOffset ||   e.target.scrollTop || 0
        this.fab = top > 20
      },
      changeTgl(tgl){
        this.$refs.dialogTanggal.save(tgl)
        this.getLog()
      },
      toTop () {
        this.$vuetify.goTo(0)
      },
      
      onResize(){
        this.windowSize = { x: window.innerWidth, y: window.innerHeight }
      },

      getLog:function(){
        api.get('log/'+this.tgl).then(
        res=>{
            this.Log = res.data
        //   this.loading = false
        //   let a = JSON.stringify(res.data)
        //   this.Log = [...new Array]
        //   this.Log = JSON.parse(a)
        //   this.Log = a
        })
        // api.get('/log').then(
		// 		res => {
        //   console.log(res.data)
        //   this.Log = res.data
		// 		},
		// 		err => {
		// 			console.log(err);
		// 		}
		// 	)
      },
      ee(){
        // let url = "http://192.168.1.76:8000/log"
        // fetch(url)
        // .then((resp) => resp.json())
      },

      KeluarDialogUserMenu () {
        this.DialogUserMenu = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.ParentSelect = null
          this.editedIndex = -1
        })
      },

      Reset() {
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
        })
      },
    },
  }
</script>

<style>
/* table th + th { border-left:1px solid #dddddd; }
table td + td { border-left:1px solid #dddddd; } */
</style>