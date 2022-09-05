<template>
<v-card>
        <v-card-actions style="height: 60px;">
          <v-toolbar-title class="text-h6">
            <b>PENGAJUAN PEMINJAMAN KENDARAAN OPERASIONAL</b>
          </v-toolbar-title>
          <v-spacer></v-spacer>
          <v-btn text outlined class="text-capitalize" @click="CetakSurat">Download</v-btn>
          <v-btn text outlined class="text-capitalize" depressed @click="ChangeURL('Peminjaman')">Keluar</v-btn>
        </v-card-actions>
    <v-divider></v-divider>

        <v-card-text :class="$vuetify.theme.dark ? 'dark' : 'grey lighten-3'">
          <v-container class="fill-height" fluid>
            <v-row v-show="false">
              <vue-html2pdf 
                      :show-layout="false" 
                      :float-layout="false" 
                      :enable-download="true" 
                      :preview-modal="true" 
                      :paginate-elements-by-height="1400" 
                      filename="Surat Pengajuan Peminjaman" 
                      :pdf-quality="2" 
                      :manual-pagination="false" 
                      pdf-format="a5" 
                      pdf-orientation="landscape" 
                      pdf-content-width="700px" 
                      ref="html2Pdf" 
                    > 
                    <section slot="pdf-content" class="mx-auto">
                      <v-sheet width="21cm" height="auto" class="ma-8 mx-auto elevation-15">
                        <div>
                  <img
                    class="logo"
                    src="../../assets/logo-pm.png"
                  />
                </div>
                        <div id="cetakan" style="padding: 35px; width: 21cm; height: auto; margin: auto; font-family: 'Calibri', sans-serif; font-size: 14px;">
                          <!-- Kepala Surat Start -->
                            <div class="mt-n4 mb-1">
                                <label><strong><CENTER>SURAT IJIN PENGGUNAAN KENDARAAN OPERASIONAL</CENTER></strong></label>
                            </div>
                           
                          <div class="ml-3 mr-3" style="margin-top:-5px;">
                          
                            <!--Table data kendaraan-->
                          <div class="mt-n10">
                              <v-row no-gutters>
                                <table class="kendaraan mt-10" border="none">
                                  <tr>
                                    <td rowspan="4">
                                        <div style="padding-left:5px;">
                                          <v-row no-gutters>
                                          <label class="col-4 d-flex flex-row" v-text="'No Referensi : '+NoRefrensi"></label>
                                          </v-row>
                                        </div>
                                        <div style="padding-left:5px;" class="mb-2">
                              <v-row no-gutters>
                                <label>Sesuai kepentingannya, dengan ini diberikan izin </label>
                              </v-row>
                            </div>
                            <div class="mb-2" style="padding-left:5px;">
                              <v-row no-gutters>
                                <label>penggunaan kendaraan <strong style="font-style: italic;">OPERASIONAL</strong> kepada karyawan :</label>
                              </v-row>
                            </div>
                            <!--Data Pemakai-->
                            <div>
                              <v-row no-gutters>
                                <v-col cols="9">
                                  <div style="padding-left:5px;">
                                    <v-row no-gutters>
                                      <label style="width: 50%;">Nama Penanggung Jawab</label>
                                      <label style="width: 2%;">:</label>
                                      <label>{{PenanggungJawab}}</label>
                                      <!-- bikin variabel Penanggung Jawab -->
                                    </v-row>
                                  </div>

                                  <div style="padding-left:5px;">
                                    <v-row no-gutters>
                                      <label style="width: 50%;">Departement</label>
                                      <label style="width: 2%;">:</label>
                                      <label>{{Departement}}</label>
                                    </v-row>
                                  </div>

                                  <div style="padding-left:5px;">
                                    <v-row no-gutters>
                                      <label style="width: 50%;">Tujuan</label>
                                      <label style="width: 2%;">:</label>
                                      <label>{{Tujuan}}</label>
                                    </v-row>
                                  </div>

                                  <div style="padding-left:5px;">
                                    <v-row no-gutters>
                                      <label style="width: 50%;">Keperluan</label>
                                      <label style="width: 2%;">:</label>
                                      <label>{{Keperluan}}</label>
                                    </v-row>
                                  </div>

                                  <div style="padding-left:5px;">
                                    <v-row no-gutters>
                                      <label style="width: 50%;">Model Kendaraan</label>
                                      <label style="width: 2%;">:</label>
                                      <label>{{ModelKendaraan}}</label>
                                    </v-row>
                                  </div>

                                  <div style="padding-left:5px;">
                                    <v-row no-gutters>
                                      <label style="width: 50%;">Nomor Polisi</label>
                                      <label style="width: 2%;">:</label>
                                      <label>{{Nopol}}</label>
                                    </v-row>
                                  </div>
                                  </v-col>
                                  </v-row>
                        </div>
                        
                        <div class="mt-2" style="padding-left:5px;">
                              <v-row no-gutters>
                                <label>Demikian surat permohonan izin penggunaan kendaraan</label>
                              </v-row>
                        </div>
                        <div class="mt-n1" style="padding-left:5px;">
                          <v-row no-gutters>
                            <label>ini kami berikan.</label> 
                          </v-row>
                          </div>
                          <div class="mt-2 mb-3" style="padding-left:5px;">
                              <v-row no-gutters>
                                <label>Samarinda</label>
                                <label style="width: 2%;">,</label>
                                <label>{{TglPemakaian}}</label>
                              </v-row>
                            </div>
                            <!--QR-->
                            <div style="margin-top:-2px;margin-left:200px;z-index:1;position:relative;">
                              <v-row dense no-gutters style="width:200px !important;"
                              >
                                <table cellspacing="0" cellpadding="0" style="max-width:50px;border:none;">
                            <tr>
                                <th style="height:10px" colspan="1" v-show="this.AccManager != null">
                                  <center>
                                    <figure class="qrcode">
                                      <span>Manager</span>
                                      <qrcode
                                      height="120px"
                                       v-show="this.AccManager != null"
                                        :value="server+'/ApprovePeminjamanManager/'+this.NoRefrensi"
                                        tag="svg"
                                        :options="{
                                          errorCorrectionLevel: 'Q',
                                        }"
                                      ></qrcode>
                                      <img
                                          class="qrcode__image"
                                          src="../../assets/logo-qr.png"
                                        />
                                        {{AccManager}}
                                    </figure>
                                  </center>
                                </th>
                                <th style="height:10px" colspan="1" class="ml-10">
                                  <center>
                                    <figure class="qrcode">
                                      <span>HR/GA</span>
                                      <qrcode
                                      height="120px"
                                        v-show="this.AccHR != null"
                                        :value="server+'/ApprovePeminjamanHRGA/'+this.NoRefrensi"
                                        tag="svg"
                                        :options="{
                                          errorCorrectionLevel: 'Q',
                                        }"
                                      ></qrcode>
                                      <img
                                          class="qrcode__image"
                                          src="../../assets/logo-qr.png"
                                        />
                                       {{AccHR}}
                                    </figure>
                                  </center>
                                </th>
                            </tr>
                            <tr>
                                <!-- <td v-show="this.AccManager != null"><center>{{AccManager}}</center></td>
                                <td v-show="this.AccHR != null"><center>{{AccHR}}</center></td> -->
                            </tr>
                        </table>
                      </v-row>
                    </div>
                                    </td>
                                    <th colspan="2">DATA KENDARAAN OPERASIONAL</th>
                                  </tr>
                                    
                                    <tr>
                                        <td rowspan="1">
                                      <div style="height:180px">
                                        <div style="padding-left:5px;">
                                            <v-row no-gutters>
                                                <label style="width: 42%;" align="left">Hari, Tgl Pemakaian</label>
                                                <label style="width: 2%;">:</label>
                                                <label >{{Hari+' '+TglPemakaian}}</label>
                                            </v-row>
                                        </div>
                                        <div style="padding-left:5px;">
                                            <v-row no-gutters>
                                                <label style="width: 42%;" align="left">Tgl Pengembalian</label>
                                                <label style="width: 2%;">:</label>
                                                <label >{{TglKembali}}</label>
                                            </v-row>
                                        </div>
                                        <div style="padding-left:5px;">
                                            <v-row no-gutters>
                                                <label style="width: 42%;" align="left">Jam Keluar</label>
                                                <label style="width: 2%;">:</label>
                                                <label >{{JamKeluar}}</label>
                                            </v-row>
                                        </div>
                                        <div style="padding-left:5px;">
                                            <v-row no-gutters>
                                                <label style="width: 42%;" align="left">Jam Masuk</label>
                                                <label style="width: 2%;">:</label>
                                                <label>{{JamMasuk}}</label>
                                            </v-row>
                                        </div>
                                        <div style="padding-left:5px;">
                                            <v-row no-gutters>
                                                <label style="width: 42%;" align="left">Kondisi Kilometer</label>
                                                <label style="width: 2%;">:</label>
                                                <label >{{KondisiAwalKM+' KM'}}</label>
                                            </v-row>
                                        </div>
                                        <div style="padding-left:5px;">
                                            <v-row no-gutters>
                                                <label style="width: 42%;" align="left">Kondisi BBM</label>
                                                <label style="width: 2%;">:</label>
                                                <label >{{KondisiAwalBBM+' BAR'}}</label>
                                            </v-row>
                                        </div>
                                        <div style="padding-left:5px;">
                                            <v-row no-gutters>
                                                <label style="width: 42%;" align="left">Kebersihan Interior</label>
                                                <label style="width: 2%;">:</label>
                                                <label >{{Interior}}</label>
                                            </v-row>
                                        </div>
                                        <div style="padding-left:5px;">
                                            <v-row no-gutters>
                                                <label style="width: 42%;" align="left">Kebersihan Eksterior</label>
                                                <label style="width: 2%;">:</label>
                                                <label >{{Eksterior}}</label>
                                            </v-row>
                                        </div>
                                      </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">PEMERIKSAAN BODY</th>
                                    </tr>
                                    <tr>
                                      
                                        <th :style="[
                                        { backgroundImage: 'url(\'' + require('@/assets/pemeriksaan.png') + '\')' },
                                        {backgroundSize: 'cover'},{backgroundPosition:'center center'},
                                        {width:'402px',height:'202px'}]">
                                        <!-- <img style="width:280px;" src="../../assets/pemeriksaan.png" /> -->
                                        </th>
                                    </tr>
                                </table>
                              </v-row>
                            </div>
                </div>
                
                </div>
              </v-sheet>
              </section>
              </vue-html2pdf>
            </v-row>

            <v-row v-show="true">
              <section slot="pdf-content" class="mx-auto">
                      <v-sheet width="21cm" height="auto" class="ma-8 mx-auto elevation-15">
                        <div>
                  <img
                    class="logo"
                    src="../../assets/logo-pm.png"
                  />
                </div>
                        <div id="cetakan" style="padding: 35px; width: 21cm; height: auto; margin: auto; font-family: 'Calibri', sans-serif; font-size: 14px;">
                          <!-- Kepala Surat Start -->
                            <div class="mt-n4 mb-1">
                                <label><strong><CENTER>SURAT IJIN PENGGUNAAN KENDARAAN OPERASIONAL</CENTER></strong></label>
                            </div>
                           
                          <div class="ml-3 mr-3" style="margin-top:-5px;">
                          
                            <!--Table data kendaraan-->
                          <div class="mt-n10">
                              <v-row no-gutters>
                                <table class="kendaraan mt-10" border="none">
                                  <tr>
                                    <td rowspan="4">
                                        <div style="padding-left:5px;">
                                          <v-row no-gutters>
                                          <label class="col-4 d-flex flex-row" v-text="'No Referensi : '+NoRefrensi"></label>
                                          </v-row>
                                        </div>
                                        <div style="padding-left:5px;" class="mb-2">
                              <v-row no-gutters>
                                <label>Sesuai kepentingannya, dengan ini diberikan izin </label>
                              </v-row>
                            </div>
                            <div class="mb-2" style="padding-left:5px;">
                              <v-row no-gutters>
                                <label>penggunaan kendaraan <strong style="font-style: italic;">OPERASIONAL</strong> kepada karyawan :</label>
                              </v-row>
                            </div>
                            <!--Data Pemakai-->
                            <div>
                              <v-row no-gutters>
                                <v-col cols="9">
                                  <div style="padding-left:5px;">
                                    <v-row no-gutters>
                                      <label style="width: 50%;">Nama Penanggung Jawab</label>
                                      <label style="width: 2%;">:</label>
                                      <label>{{PenanggungJawab}}</label>
                                      <!-- bikin variabel Penanggung Jawab -->
                                    </v-row>
                                  </div>

                                  <div style="padding-left:5px;">
                                    <v-row no-gutters>
                                      <label style="width: 50%;">Departement</label>
                                      <label style="width: 2%;">:</label>
                                      <label>{{Departement}}</label>
                                    </v-row>
                                  </div>

                                  <div style="padding-left:5px;">
                                    <v-row no-gutters>
                                      <label style="width: 50%;">Tujuan</label>
                                      <label style="width: 2%;">:</label>
                                      <label>{{Tujuan}}</label>
                                    </v-row>
                                  </div>

                                  <div style="padding-left:5px;">
                                    <v-row no-gutters>
                                      <label style="width: 50%;">Keperluan</label>
                                      <label style="width: 2%;">:</label>
                                      <label>{{Keperluan}}</label>
                                    </v-row>
                                  </div>

                                  <div style="padding-left:5px;">
                                    <v-row no-gutters>
                                      <label style="width: 50%;">Model Kendaraan</label>
                                      <label style="width: 2%;">:</label>
                                      <label>{{ModelKendaraan}}</label>
                                    </v-row>
                                  </div>

                                  <div style="padding-left:5px;">
                                    <v-row no-gutters>
                                      <label style="width: 50%;">Nomor Polisi</label>
                                      <label style="width: 2%;">:</label>
                                      <label>{{Nopol}}</label>
                                    </v-row>
                                  </div>
                                  </v-col>
                                  </v-row>
                        </div>
                        
                        <div class="mt-2" style="padding-left:5px;">
                              <v-row no-gutters>
                                <label>Demikian surat permohonan izin penggunaan kendaraan</label>
                              </v-row>
                        </div>
                        <div class="mt-n1" style="padding-left:5px;">
                          <v-row no-gutters>
                            <label>ini kami berikan.</label> 
                          </v-row>
                          </div>
                          <div class="mt-2 mb-3" style="padding-left:5px;">
                              <v-row no-gutters>
                                <label>Samarinda</label>
                                <label style="width: 2%;">,</label>
                                <label>{{TglPemakaian}}</label>
                              </v-row>
                            </div>
                            <!--QR-->
                            <div style="margin-top:-2px;margin-left:200px;z-index:1;position:relative;">
                              <v-row dense no-gutters style="width:200px !important;"
                              >
                                <table cellspacing="0" cellpadding="0" style="max-width:50px;border:none;">
                            <tr>
                                <th style="height:10px" colspan="1">
                                  <center>
                                    <figure class="qrcode">
                                      <span v-show="this.AccManager != null">Manager</span>
                                      <qrcode
                                      height="120px"
                                       v-show="this.AccManager != null"
                                        :value="server+'/ApprovePeminjamanManager/'+this.NoRefrensi"
                                        tag="svg"
                                        :options="{
                                          errorCorrectionLevel: 'Q',
                                        }"
                                      ></qrcode>
                                      <img
                                          class="qrcode__image"
                                          src="../../assets/logo-qr.png"
                                        />
                                        {{AccManager}}
                                    </figure>
                                  </center>
                                </th>
                                <th style="height:10px" colspan="1" class="ml-10">
                                  <center>
                                    <figure class="qrcode">
                                      <span v-show="this.AccHR != null">HR/GA</span>
                                      <qrcode
                                      height="120px"
                                        v-show="this.AccHR != null"
                                        :value="server+'/ApprovePeminjamanHRGA/'+this.NoRefrensi"
                                        tag="svg"
                                        :options="{
                                          errorCorrectionLevel: 'Q',
                                        }"
                                      ></qrcode>
                                      <img
                                          class="qrcode__image"
                                          src="../../assets/logo-qr.png"
                                        />
                                       {{AccHR}}
                                    </figure>
                                  </center>
                                </th>
                            </tr>
                            <tr>
                                <!-- <td v-show="this.AccManager != null"><center>{{AccManager}}</center></td>
                                <td v-show="this.AccHR != null"><center>{{AccHR}}</center></td> -->
                            </tr>
                        </table>
                      </v-row>
                    </div>
                                    </td>
                                    <th colspan="2">DATA KENDARAAN OPERASIONAL</th>
                                  </tr>
                                    
                                    <tr>
                                        <td rowspan="1">
                                      <div style="height:180px">
                                        <div style="padding-left:5px;">
                                            <v-row no-gutters>
                                                <label style="width: 42%;" align="left">Hari, Tgl Pemakaian</label>
                                                <label style="width: 2%;">:</label>
                                                <label >{{Hari+' '+TglPemakaian}}</label>
                                            </v-row>
                                        </div>
                                        <div style="padding-left:5px;">
                                            <v-row no-gutters>
                                                <label style="width: 42%;" align="left">Tgl Pengembalian</label>
                                                <label style="width: 2%;">:</label>
                                                <label >{{TglKembali}}</label>
                                            </v-row>
                                        </div>
                                        <div style="padding-left:5px;">
                                            <v-row no-gutters>
                                                <label style="width: 42%;" align="left">Jam Keluar</label>
                                                <label style="width: 2%;">:</label>
                                                <label >{{JamKeluar}}</label>
                                            </v-row>
                                        </div>
                                        <div style="padding-left:5px;">
                                            <v-row no-gutters>
                                                <label style="width: 42%;" align="left">Jam Masuk</label>
                                                <label style="width: 2%;">:</label>
                                                <label>{{JamMasuk}}</label>
                                            </v-row>
                                        </div>
                                        <div style="padding-left:5px;">
                                            <v-row no-gutters>
                                                <label style="width: 42%;" align="left">Kondisi Kilometer</label>
                                                <label style="width: 2%;">:</label>
                                                <label >{{KondisiAwalKM+' KM'}}</label>
                                            </v-row>
                                        </div>
                                        <div style="padding-left:5px;">
                                            <v-row no-gutters>
                                                <label style="width: 42%;" align="left">Kondisi BBM</label>
                                                <label style="width: 2%;">:</label>
                                                <label >{{KondisiAwalBBM+' BAR'}}</label>
                                            </v-row>
                                        </div>
                                        <div style="padding-left:5px;">
                                            <v-row no-gutters>
                                                <label style="width: 42%;" align="left">Kebersihan Interior</label>
                                                <label style="width: 2%;">:</label>
                                                <label >{{Interior}}</label>
                                            </v-row>
                                        </div>
                                        <div style="padding-left:5px;">
                                            <v-row no-gutters>
                                                <label style="width: 42%;" align="left">Kebersihan Eksterior</label>
                                                <label style="width: 2%;">:</label>
                                                <label >{{Eksterior}}</label>
                                            </v-row>
                                        </div>
                                      </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">PEMERIKSAAN BODY</th>
                                    </tr>
                                    <tr>
                                      
                                        <th :style="[
                                        { backgroundImage: 'url(\'' + require('@/assets/pemeriksaan.png') + '\')' },
                                        {backgroundSize: 'cover'},{backgroundPosition:'center center'},
                                        {width:'402px',height:'202px'}]">
                                        <!-- <img style="width:280px;" src="../../assets/pemeriksaan.png" /> -->
                                        </th>
                                    </tr>
                                </table>
                              </v-row>
                            </div>
                </div>
                
                </div>
              </v-sheet>
              </section>
              </v-row>
          </v-container>
        </v-card-text>
       
</v-card>
</template>
<script>
//import api backend ini file fungsi api nya di services/http
import VueHtml2pdf from 'vue-html2pdf'
import API from '@/services/http'
export default {
  components: { 
        VueHtml2pdf 
    },
    data(){
        return{
          server:null,
          PenanggungJawab:null,
          Departement:null,
          Tujuan:null,
          Keperluan:null,
          // GambarPemeriksaan:{ backgroundImage: 'url(\'' + require('@/assets/pemeriksaan.png') + '\')' },
          ModelKendaraan:null,
          Nopol:null,
          TglPemakaian:null,
          TglKembali:null,
          Hari:null,
          JamKeluar:null,
          JamMasuk:null,
          Interior:null,
          Eksterior:null,
          KondisiAwalKM:null,
          KondisiAwalBBM:null,
          AccManager:null,
          AccHR:null,
          // Dekalarasikan Variabel Penanggung Jawab Jangan Lupa
            NoRefrensi:null,
        }
    },
    created(){
      //loading dimulai
      this.server = window.location.origin
        this.$loading(true)
        let data = this.$CekStore()== null ? [] : this.LocalData()
        if(typeof data == 'object'){this.GetData(this.$route.params.id)}else{this.LocalData()}
        // this.GenerateImg()
        //this.getdata di atas ini, ngirim parameter id refrensi, 
    },
    mounted(){
        //  this.$loading(true)
     //
    },
    methods:{
        //kosongan
        CetakSurat(){
          // alert('nanti dicetak')
          this.$refs.html2Pdf.generatePdf()
        },
        // GenerateImg(){
        //   document.getElementById('GambarPemeriksaan').style.background = 'url(\'' + require('@/assets/pemeriksaan.png') + '\')'
        // },
        GetData(x){
          this.$loading(true)
          let hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu']
          //di atas ini nilai x adalah data yang dikirim dari created yaitu parameter id refrensi untuk cari data form nya
          //Cek Api ini Di dalam Router Backend form peminjaman RESOURCE dikasi / karena ini ngambil data satuan untuk surat
          API.get('formpeminjaman/'+x).then(z=>{ 
            // nah dsini dah data nya keluar
            // kalo ragu pakai console log z.data untuk cek datanye
            console.log(z.data)
            this.NoRefrensi = z.data.id_form_peminjaman
            this.PenanggungJawab = z.data.penanggung_jawab
            this.Departement = z.data.department.nama_department
            this.Tujuan = z.data.tujuan
            this.Keperluan = z.data.keperluan
            this.ModelKendaraan = z.data.aset.nama_aset
            this.Nopol = z.data.aset.no_plat
            this.Hari = hari[new Date(z.data.tgl_peminjaman).getDay()]
            this.TglPemakaian = this.$DateConvert(z.data.tgl_peminjaman)
            this.TglKembali = z.data.tgl_pengembalian == null ? '' : this.Hari+' '+ this.$DateConvert(z.data.tgl_pengembalian)
            this.JamKeluar = z.data.jam_keluar_kendaraan
            this.JamMasuk = z.data.jam_masuk_kendaraan
            this.KondisiAwalKM = z.data.kondisi_awal_kilometer
            this.KondisiAwalBBM = z.data.kondisi_awal_bbm 
            this.Interior = z.data.kondisi_awal_kebersihan_interior
            this.Eksterior = z.data.kondisi_awal_kebersihan_eksterior
            this.AccManager = z.data.acc_manager
            this.AccHR = z.data.acc_hr
            console.log(z.data.acc_hr)
            // eksekusi variabel penanggung jawab, di isi dengan data hasil yang di dapat ,. z.nama_variabel_ngikut_database
           })
          //API.get Dapatkan Dulu Data nya Kemudian Gunakan Then, lakukan Fungsi untuk menampilkan result API, aku biasanya pake arrow function ( z atau x atau c  => { } ) <-ini arrow function
          this.$loading(false)
          // jangan lupa kalo suda di eksekusi fungsi nya di stop  loading , biar ga loding terus
        },
         LocalData(){
          let hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu']
          let data = this.$CekStore()
          this.NoRefrensi = data.id_form_peminjaman
            this.PenanggungJawab = data.penanggung_jawab
            this.Departement = data.department.nama_department
            this.Tujuan = data.tujuan
            this.Keperluan = data.keperluan
            this.ModelKendaraan = data.aset.nama_aset
            this.Nopol = data.aset.no_plat
            this.Hari = hari[new Date(data.tgl_peminjaman).getDay()]
            this.TglPemakaian = this.$DateConvert(data.tgl_peminjaman)
            this.TglKembali = this.$DateConvert(data.tgl_pengembalian)
            this.JamKeluar = data.jam_keluar_kendaraan
            this.JamMasuk = data.jam_masuk_kendaraan
            this.KondisiAwalKM = data.kondisi_awal_kilometer
            this.KondisiAwalBBM = data.kondisi_awal_bbm
            this.Interior = data.kondisi_awal_kebersihan_interior
            this.Eksterior = data.kondisi_awal_kebersihan_eksterior
            this.AccManager = data.acc_manager
            this.AccHR = data.acc_hr
            this.$loading(false)
         },
         ChangeURL(x){
          this.$ChangeURL(x)
         }
    }
}
</script>
<style>
table{
    border-collapse:collapse;
    
  }

.qrcode {
  display: inline-block;
  z-index: 1;
  /* font-size: 0;
  margin-bottom: 0; */
  position: relative;
  margin-right: 150px;
  margin-left: -250px;
}
.qrcode__image {
  background-color: white;
  z-index:1;
  border-radius: 25px;
  /* border: 0.25rem solid #fff; */
  /* border-radius: 3rem; */
  /* box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.25); */
  height: 13%;
  left: 50%;
  overflow: hidden;
  position: absolute;
  top: 48%;
  transform: translate(-50%, -50%);
  width:9%;
}
.logo{
  margin-bottom: -50px;
  margin-left:40px;
  width: 18%;
}
</style>