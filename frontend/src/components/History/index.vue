<template>
<v-container
    fluid
    style="height:100%"
    :style="{backgroundColor:'#c8d2d8'}">
<div
    class="mx-auto"
    :style="{backgroundColor:'#c8d2d8'}"
  >
  <!-- rangkap desktop -->
  <!--Desktop v-show artinya, bakal nampilkan semua rangkap element kodingan ini khusus untuk device == Desktop -->
<v-card v-show="device == 'Desktop' " max-width="1080" elevation="6" :class="device == 'Desktop' ? 'mx-auto mt-4 rounded' : 'mx-auto mt-n3'">
    <v-toolbar
      color="#a10115"
      dark
    >
      <v-toolbar-title>History</v-toolbar-title>
    </v-toolbar>
    <v-list-item-group
        color="primary"
      >
    <v-list three-line>
      <div v-for="(item, index) in items" :key="index">

        <v-subheader
          :key="index"
          v-text="item.date"
          class="tgl mt-n4 mb-n4"
        ></v-subheader>

        <v-list-item
        v-for="(data,i) in item.data" :key="i+'a'"
        :class="device == 'Desktop' ? 'ml-16' : 'ml-1'">
          <v-list-item-avatar>
           <v-icon>{{data.avatar}}</v-icon>
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title><span class="item-caption">{{data.title}}</span></v-list-item-title>
            <v-list-item-subtitle><span v-text="data.penanggung_jawab+' | '+data.department.nama_department"/><b><span style="color:#a10115" v-text="' | '+data.accs"/></b></v-list-item-subtitle>
          </v-list-item-content>
          <v-subheader
          class="ml-15"
          v-text="data.jam_keluar_kendaraan"></v-subheader>
        </v-list-item>
        <v-divider class="mb-2"/>
      </div>
    </v-list>
    </v-list-item-group>
    
</v-card>
<!-- akhir rangkap desktop -->

<!-- Mobile -->
  <v-card v-show="device == 'Mobile' ">
    <v-toolbar
      color="#a10115"
      dark
    >
      <v-toolbar-title>History</v-toolbar-title>
    </v-toolbar>
  </v-card>
  <!-- end of mobile -->
  <!-- </v-card> -->
  </div>
  </v-container>
</template>
<script>
import API from "@/services/http";
  export default {
    data: () => ({
      items: [
      ],
      device:null,
      peminjaman:[],
      tesdrive:[],
    }),
    beforeMount(){
        this.device = this.$device
    },
    mounted(){
      let user = JSON.parse(localStorage.getItem('logged'))
      console.log(user)
      let department = user.department.id_department
      this.$loading(true)
      API.get("/historypeminjaman/"+user.nama_lengkap+'/'+department).then(x=>{
        x.data.forEach(a => {
          a.avatar = a.keperluan == 'Daily' ? 'mdi-car' : 'mdi-car-key',
          a.title = 'Peminjaman '+a.aset.jenis_aset+' '+a.aset.nama_aset+' '+a.aset.no_plat+' Untuk Keperluan '+a.keperluan+' Tujuan '+a.tujuan+' '
          a.accs = a.approve_form_tes_drive != null ? a.approve_form_tes_drive : ''
        });
        this.peminjaman = x.data.reverse()
      })
      API.get("/historytesdrive/"+user.nama_lengkap+'/'+department).then(x=>{
        x.data.forEach(a => {
          a.avatar = 'mdi-car-traction-control'
          a.title = 'Tes Drive '+a.aset.jenis_aset+' '+a.aset.nama_aset+' '+a.aset.no_plat
          a.accs = a.approve_form_tes_drive != null ? a.approve_form_tes_drive : ''
        });
        console.log(x)
        this.tesdrive = x.data.reverse()
        this.items = [...this.peminjaman,...this.tesdrive]
        this.items.sort(function(a,b){
          return new Date(b.tgl_peminjaman) - new Date(a.tanggal_pemakaian);
        });
        this.items.forEach(q => {
          q.Tgl = q.tanggal_pemakaian ? this.$DateConvert(q.tanggal_pemakaian) : this.$DateConvert(q.tgl_peminjaman)
        });
        // this gives an object with dates as keys
          const groups = this.items.reduce((groups, list) => {
            const date = list.Tgl
            if (!groups[date]) {
              groups[date] = [];
            }
            groups[date].push(list);
            return groups;
          }, {});

          // Edit: to add it in the array format instead
          const groupArrays = Object.keys(groups).map((date) => {
            return {
              date,
              data: groups[date]
            };
          });
        this.items = groupArrays
        this.$loading(false)
      })
    },
  }
</script>
<style>
.tgl{
  font-weight: bold;
  font-family:Arial, Helvetica, sans-serif;
}
</style>