<template>
<v-container
fluid fill-height
    style="height:905px"
    :style="{backgroundColor:'#c8d2d8'}">
    <!-- <v-card style="margin-top:200px;" width="800px">
     -->
     <v-card class="mx-auto" elevation="3" width="800px">
          <v-toolbar color="#a10115" dark class="mb-2 text-overline"> <span class="judul text-h5"><b><v-icon class="mr-2" style="color:white">mdi-file-document-edit-outline</v-icon>FORMULIR ASET</b></span></v-toolbar>
        <!-- <v-card-title>
        <v-icon class="mr-2" style="color:black">mdi-file-document-edit-outline</v-icon> <span class="judul text-h5"> <b>FORMULIR ASET</b></span>
        </v-card-title> -->
        <v-card-text>
          <v-container>
            <v-row>
              <v-col
                cols="6"
                sm="6"
                md="4"
              >
                <v-select
                  label="Jenis Aset"
                  :items="['Mobil','Truk','Motor']"
                  color="red darken-4"
                  v-model="JenisAset"
                  required
                />
              </v-col>
              <v-col
                cols="6"
                sm="6"
                md="4"
              >
                <v-text-field
                  label="Nama Aset"
                  color="red darken-4"
                  v-model="NamaAset"
                  required
                ></v-text-field>
              </v-col>
              <v-col
                cols="6"
                sm="6"
                md="4"
              >
                <v-text-field
                  label="Warna"
                  color="red darken-4"
                  v-model="Warna"
                  required
                ></v-text-field>
              </v-col>
              <v-col
                cols="6"
                sm="6"
                md="4"
              >
                <v-text-field
                  label="No Pol"
                  color="red darken-4"
                  v-model="NoPlat"
                  required
                ></v-text-field>
              </v-col>
              <v-col
                cols="6"
                sm="6"
                md="4"
              >
                <v-text-field
                  label="BBM"
                  color="red darken-4"
                  v-model="BBM"
                  required
                ></v-text-field>
              </v-col>
              <v-col
                cols="6"
                sm="6"
                md="4"
              >
                <v-text-field
                  label="KM"
                  color="red darken-4"
                  v-model="KM"
                  required
                ></v-text-field>
              </v-col>
              <v-col
                cols="6"
                sm="6"
                md="4"
              >
                <v-select
                  label="Status Aset"
                  color="red darken-4"
                  :items="StatusList"
                  v-model="StatusAset"
                  item-value="text"
                  item-text="text"
                  required
                >
                 <template v-slot:selection="{ item }">
                    <v-icon :color="item.color">{{ getStatusIcon(item) }}</v-icon>{{getStatusText(item)}}
                  </template>
                  <template v-slot:item="{ item }">
                    <v-icon :color="item.color">{{ getStatusIcon(item) }}</v-icon>{{getStatusText(item)}}
                  </template>
                </v-select>
              </v-col>
              <v-col
                cols="6"
                sm="6"
                md="4"
              >
                <v-select
                  label="Kondisi Aset"
                  color="red darken-4"
                  :items="KondisiList"
                  item-text='text'
                  item-value='text'
                  v-model="KondisiAset"
                  required
                  hint="Kosongi bila kendaraan stay di dealer"
                  persistent-hint
                >
                <template v-slot:selection="{ item }">
                    <!-- <v-icon>{{ getKondisiIcon(item) }}</v-icon>{{getKondisiText(item)}} -->
                    <span v-show="getKondisiIcon(item).length == 1"><v-icon >{{ getKondisiIcon(item)[0] }}</v-icon>{{getKondisiText(item)}}</span>
                    <span v-show="getKondisiIcon(item).length == 2"><v-icon >{{ getKondisiIcon(item)[0] }}</v-icon><v-icon >{{getKondisiIcon(item)[1]}}</v-icon>{{getKondisiText(item)}}</span>
                  </template>
                  <template v-slot:item="{ item }">
                    <span v-show="getKondisiIcon(item).length == 1"><v-icon >{{ getKondisiIcon(item)[0] }}</v-icon>{{getKondisiText(item)}}</span>
                    <span v-show="getKondisiIcon(item).length == 2"><v-icon >{{ getKondisiIcon(item)[0] }}</v-icon><v-icon >{{getKondisiIcon(item)[1]}}</v-icon>{{getKondisiText(item)}}</span>
                  </template>
                </v-select>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-tooltip bottom>
          <template v-slot:activator="{ on, attrs }">
          <v-icon 
          large
           v-bind="attrs"
           v-on="on" 
           class="ml-3" 
           style="color: black;" 
           @click="BackToAset">mdi-arrow-left-circle-outline</v-icon>
           </template>
           <span>Back</span>
           </v-tooltip>
          <v-spacer></v-spacer>
          <v-tooltip bottom>
          <template v-slot:activator="{ on, attrs }">
          <v-icon 
          large
           v-bind="attrs"
           v-on="on" 
           class="mr-3" 
           @click="Reset">mdi-close-circle-outline</v-icon>
           </template>
           <span>Reset</span>
           </v-tooltip>
          <v-tooltip bottom>
          <template v-slot:activator="{ on, attrs }">
          <v-icon 
          large
          v-bind="attrs"
          v-on="on"
          class="mr-3" 
          style="color:#a10115;" 
          @click="save()">mdi-checkbox-marked-circle-outline</v-icon>
          </template>
          <span>Save</span>
          </v-tooltip>
        </v-card-actions>
      </v-card>
      </v-container>
</template>
<script>
import API from "@/services/http";
export default {
    data: () => ({
      showpass:false,
      JenisAset:null,
      isEdit:false,
      NamaAset:null,
      StatusList:[
        {icon:'mdi-car-back',text:'READY',color:'red darken-4'},
        {icon:'mdi-car-back',text:'NOT READY',color:'gray'}],
      KondisiList:[
        {icon:'mdi-car-key',text:'TES DRIVE'},
        {icon:'mdi-car-clock',text:'DAILY'},
        {icon:'mdi-car-traction-control',text:'BEROPERASI'},
        {icon:'mdi-car-clock,mdi-car-traction-control',text:'DAILY,BEROPERASI'},
        ],
      Warna:null,
      NoPlat:null,
      BBM:null,
      KM:null,
      StatusAset:"READY",
      KondisiAset:null
    }),
    created(){
    let data = this.$CekStore() == null ? [] : this.$CekStore()
    if(this.$CekStore() != null){this.isEdit = true}
        this.IdAset = data.id_aset
        this.JenisAset = data.jenis_aset
        this.NamaAset = data.nama_aset
        this.Warna = data.warna
        this.NoPlat = data.no_plat
        this.BBM = data.BBM
        this.KM = data.KM
        this.StatusAset = data.status_aset
        this.KondisiAset = data.kondisi_aset
    },
    methods:{
      Reset(){
        this.$Store(null)
        this.JenisAset = null
        this.NamaAset = null
        this.Warna = null
        this.NoPlat = null
        this.StatusAset = null
        this.BBM = null
        this.KM = null
        this.KondisiAset = null
      },
      BackToAset(){
        this.$Store(null)
        this.$router.push('Aset')
      },
      getStatusText(item){
        return ' — ' +`${item.text}`
      },
      getStatusIcon(item){
        return `${item.icon}`
      },
      getKondisiText(item){
        return ' — ' +`${item.text}`
      },
      getKondisiIcon(item){
        let cek = item.icon.split(',')
        // return `${item.icon}`
        return cek
      },
      save(){
        this.$loading(true)
        let data = {
          JenisAset:this.JenisAset,
          NamaAset:this.NamaAset,
          Warna:this.Warna,
          BBM:this.BBM,
          KM:this.KM,
          NoPlat:this.NoPlat,
          StatusAset:this.StatusAset,
          KondisiAset:this.KondisiAset
        }
        if(this.isEdit == false){
          API.post('aset',data).then(x=>{
          this.SetSeen()
          console.log(x)
          this.$Store(null)
          this.$Toast('success','Aset Ditambahkan')
          this.$router.push('Aset')
          })
        }else{
          API.put('aset/'+this.IdAset,data).then(x=>{
          console.log(x)
          this.$Store(null)
          this.$Toast('success','Aset DiUbah')
          this.$router.push('Aset')
          })
        }
      },
      SetSeen(){
        API.get('setseen/aset')
      }
    }
}
</script>
