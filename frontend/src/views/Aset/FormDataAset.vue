<template>
    <v-card>
        <v-card-title>
          <span class="text-h5">Aset Data</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col
                cols="12"
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
                cols="12"
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
                cols="12"
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
                cols="12"
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
                cols="12"
                sm="6"
                md="4"
              >
                <v-select
                  label="Status Aset"
                  color="red darken-4"
                  :items="['READY','DIPINJAM']"
                  v-model="StatusAset"
                  required
                />
              </v-col>
              <v-col
                cols="12"
                sm="6"
                md="4"
              >
                <v-text-field
                  label="Kondisi Aset"
                  color="red darken-4"
                  v-model="KondisiAset"
                  required
                ></v-text-field>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-btn
            color="red darken-4"
            dark
            elevation="6"
            @click="BackToAset"
          >
            Kembali
          </v-btn>
          <v-spacer></v-spacer>
          <v-btn
            color="red darken-4"
            dark
            elevation="6"
            @click="Reset"
          >
            Reset
          </v-btn>
          <v-btn
            color="red darken-4"
            dark
            elevation="6"
            @click="save()"
          >
            Save
          </v-btn>
        </v-card-actions>
      </v-card>
</template>
<script>
import API from "@/services/http";
export default {
    data: () => ({
      showpass:false,
      JenisAset:null,
      isEdit:false,
      NamaAset:null,
      Warna:null,
      NoPlat:null,
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
        this.KondisiAset = null
      },
      BackToAset(){
        this.$Store(null)
        this.$router.push('Aset')
      },
      save(){
        this.$loading(true)
        let data = {
          JenisAset:this.JenisAset,
          NamaAset:this.NamaAset,
          Warna:this.Warna,
          NoPlat:this.NoPlat,
          StatusAset:this.StatusAset,
          KondisiAset:this.KondisiAset
        }
        if(this.isEdit == false){
          API.post('aset',data).then(x=>{
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
      }
    }
}
</script>