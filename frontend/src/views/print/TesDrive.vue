<template>
    <v-card fluid style="height:100vh" :class="$vuetify.theme.dark ? 'grey darken-4' : ''">
        <v-card-actions style="height: 85px;">
          <v-toolbar-title class="text-h5">
            <b>PENGAJUAN TES DRIVE</b>
          </v-toolbar-title>
          <v-spacer></v-spacer>
          <v-btn text outlined class="text-capitalize" depressed @click="CetakSurat">Download</v-btn>
          <v-btn text outlined class="text-capitalize" depressed @click="ChangeURL('TesDrive')">Keluar</v-btn>
        </v-card-actions>

        <v-divider></v-divider>

        <v-card-text fluid height="100%" :style="{backgroundColor:'#c8d2d8'}">
          <v-container class="fill-height" fluid style="height:100vh" :style="{backgroundColor:'#c8d2d8'}">
            <!-- ini untuk print -->
            <v-row v-show="false">
              <vue-html2pdf 
                      :show-layout="false" 
                      :float-layout="false" 
                      :enable-download="true" 
                      :preview-modal="true" 
                      :paginate-elements-by-height="1400" 
                      filename="Pengajuan Tes Drive" 
                      :pdf-quality="2" 
                      :manual-pagination="false" 
                      pdf-format="a5" 
                      pdf-orientation="landscape" 
                      pdf-content-width="700px" 
                      ref="html2Pdf" 
                    > 
                    <section slot="pdf-content">
              <v-sheet outlined width="21cm" height="auto" class="ma-8 mx-auto elevation-15">
                <div>
                  <img
                    class="logo"
                    src="../../assets/logo-pm.png"
                  />
                </div>
                <div id="cetakan" style="padding: 35px; width: 21cm; height: auto; margin: auto; font-family: 'Calibri', sans-serif; font-size: 14px;">
                  <!-- Kepala Surat Start -->
                  <div class="mt-2 mb-4">
                   <label><strong><CENTER>SURAT IJIN PENGGUNAAN KENDARAAN TES DRIVE</CENTER></strong></label>
                  </div>
                  <!-- Kepala Surat End -->
                  <div class="mt-4">
                      <v-row no-gutters style="display:flex;justify-content:end;">
                        <label>Samarinda</label>
                        <label style="width: 2%;">,</label>
                        <label>{{TanggalSurat}}</label>
                      </v-row>
                    </div>
                  <!-- Isi Surat Strat -->
                  <div class="ml-3 mr-3">
                    <div>
                      <v-row no-gutters>
                        <label class="col-4 d-flex flex-row" v-text="'No Referensi : '+NoRefrensi"></label>
                      </v-row>
                    </div>

                    <div>
                      <v-row no-gutters>
                        <label>Sesuai kepentingannya, dengan ini diberikan izin penggunaan kendaraan <strong style="font-style: italic;">Tes Drive </strong> kepada karyawan :</label>
                      </v-row>
                    </div>
                    <div>
                      <v-row no-gutters>
                        <v-col cols="9">
                          <div>
                            <v-row no-gutters>
                              <label style="width: 33%;">Nama Penanggung Jawab</label>
                              <label style="width: 2%;">:</label>
                              <label style="width: 64%;">{{PenanggungJawab}}</label>
                            </v-row>
                          </div>

                          <div>
                            <v-row no-gutters>
                              <label style="width: 33%;">Departement</label>
                              <label style="width: 2%;">:</label>
                              <label style="width: 64%;">{{Department}}</label>
                            </v-row>
                          </div>

                          <div>
                            <v-row no-gutters>
                              <label style="width: 33%;">Nama Customer</label>
                              <label style="width: 2%;">:</label>
                              <label style="width: 64">{{NamaCustomer}}</label>
                            </v-row>
                          </div>

                          <div>
                            <v-row no-gutters>
                              <label style="width: 33%;">Hari, Tgl Pemakaian</label>
                              <label style="width: 2%;">:</label>
                              <label>{{TanggalPemakaian}}</label>
                            </v-row>
                          </div>

                          <div>
                            <v-row no-gutters>
                              <label style="width: 33%;">Hari, Tgl Pengembalian</label>
                              <label style="width: 2%;">:</label>
                              <label>{{TanggalKembali}}</label>
                            </v-row>
                          </div>

                          <div>
                            <v-row no-gutters>
                              <label style="width: 33%;">Jam Pemakaian</label>
                              <label style="width: 2%;">:</label>
                              <v-row no-gutters>
                                <label style="width:12%">{{JamKeluar}}</label>
                                <label style="width:8%;">s/d</label>
                                <label>{{JamMasuk}}</label>
                              </v-row>
                            </v-row>
                          </div>

                          <div>
                            <v-row no-gutters>
                              <label style="width: 33%;">Model Kendaraan</label>
                              <label style="width: 2%;">:</label>
                              <label style="width: 64%;">{{ModelKendaraan}}</label>
                            </v-row>
                          </div>

                          <div>
                            <v-row no-gutters>
                              <label style="width: 33%;">Nomor Polisi</label>
                              <label style="width: 2%;">:</label>
                              <label style="width: 64%;">{{NoPol}}</label>
                            </v-row>
                          </div>

                            <div>
                            <v-row no-gutters>
                              <label style="width: 33%;">Kondisi Awal Kilometer</label>
                              <label style="width: 2%;">:</label>
                              <v-row no-gutters>
                                <label>{{KondisiKM + ' KM'}}</label>
                              </v-row>
                            </v-row>
                          </div>

                          <div>
                            <v-row no-gutters>
                              <label style="width: 33%;">Kondisi Awal BBM</label>
                              <label style="width: 2%;">:</label>
                              <v-row no-gutters>
                                <label>{{KondisiBBM + ' BAR'}}</label>
                              </v-row>
                            </v-row>
                          </div>

                          <div>
                            <v-row no-gutters>
                              <label style="width: 33%;">Kondisi Awal Kebersihan</label>
                              <label style="width: 2%;">:</label>
                              <label style="width: 11%;">Interior</label>
                              <label style="width: 2%;">:</label>
                              <label style="width: 50%;">{{Interior}}</label>
                            </v-row>
                            <v-row no-gutters>
                              <label style="width: 33%;"></label>
                              <label style="width: 2%;">:</label>
                              <label style="width: 11%;">Eksterior</label>
                              <label style="width: 2%;">:</label>
                              <label style="width: 50%;">{{Eksterior}}</label>
                            </v-row>
                          </div>
                          <div>
                            <v-row no-gutters>
                              <label style="width: 33%;">Kondisi Awal Fisik Kendaraan</label>
                              <label style="width: 2%;">:</label>
                              <label style="width: 64%;">{{KondisiAwalFisik}}</label>
                            </v-row>
                          </div>
                          <div>
                            <v-row no-gutters>
                              <label style="width: 33%;">Lokasi Tes Drive</label>
                              <label style="width: 2%;">:</label>
                              <label style="width: 64%;">{{LokasiTesDrive}}</label>
                            </v-row>
                          </div>
                        </v-col>

                        <v-col cols="3">
                          <div style="width: 152px; height: 152px; margin: auto; margin-top: 10px;">
                            <!-- <figure class="qrcode" v-show="this.datacuti.approvalcuti.length">
                              <qrcode
                                :value="'Tertanda '+datacuti"
                                tag="svg"
                                :options="{
                                  errorCorrectionLevel: 'Q',
                                  width: 150,
                                }"
                              ></qrcode>
                              <img
                                class="qrcode__image"
                                src="../../assets/LogoTrinity.png"
                                alt="Barcode"
                              />
                            </figure> -->
                          </div>
                        </v-col>
                      </v-row>
                    </div>

                    <div>
                      <v-row no-gutters>
                        <label>Demikian surat permohonan izin penggunaan kendaraan ini kami berikan.</label>
                      </v-row>
                    </div>
                    <div style="margin-top:1px">
                      <v-row no-gutters style="display:flex;justify-content:center;">
                        <span><center><i>Menyetujui,</i></center></span>
                      </v-row>
                    </div>
                    <div class="mt-2">
                      <v-row dense no-gutters style="display:flex;justify-content:center;">
                        <table cellspacing="0" cellpadding="0" style="max-width:200px;border:none;">
                            <tr>
                                <td v-show="this.AccManager != null"><center><b>Manager</b></center></td>
                                <td v-show="this.AccHR != null"><center><b>HR/GA</b></center></td>
                            </tr>
                            <tr >
                                <th style="height:20px" colspan="1" v-show="this.AccManager != null">
                                  <center>
                                    <figure class="qrcode">
                                      <qrcode
                                      height="120px"
                                       v-show="this.AccManager != null"
                                        :value="server+'/ApproveTesDriveManager/'+this.NoRefrensi"
                                        tag="svg"
                                        :options="{
                                          errorCorrectionLevel: 'Q',
                                        }"
                                      ></qrcode>
                                      <img
                                          class="qrcode__image"
                                          src="../../assets/logo-qr.png"
                                        />
                                    </figure>
                                  </center>
                                </th>
                                <th style="height:20px" colspan="1">
                                  <center>
                                    <figure class="qrcode">
                                      <qrcode
                                      height="120px"
                                        v-show="this.AccHR != null"
                                        :value="server+'/ApproveTesDriveHRGA/'+this.NoRefrensi"
                                        tag="svg"
                                        :options="{
                                          errorCorrectionLevel: 'Q',
                                        }"
                                      ></qrcode>
                                      <img
                                          class="qrcode__image"
                                          src="../../assets/logo-qr.png"
                                        />
                                    </figure>
                                  </center>
                                </th>
                            </tr>
                            <tr>
                                <td v-show="this.AccManager != null"><center>{{AccManager}}</center></td>
                                <td><center>{{AccHR}}</center></td>
                            </tr>
                        </table>
                      </v-row>
                    </div>
                  </div>
                  <!-- Isi Surat End -->

                  <!-- Approval Oleh Start -->
                  <div class="ma-3 text-center">
                   
                  </div>
                  <!-- Approval Oleh End --> 
                </div> 
              </v-sheet>
              </section>
                </vue-html2pdf>
            </v-row>

            <!--preview surat asli -->
            <v-row v-show="true">
              <section slot="pdf-content" class="mx-auto">
                      <v-sheet style="margin-top:-800px" width="21cm" height="auto" class="ma-8 mx-auto elevation-15">
                        <div>
                  <img
                    class="logo"
                    src="../../assets/logo-pm.png"
                  />
                </div>
                        <div id="cetakan" style="padding: 35px; width: 21cm; height: auto; margin: auto; font-family: 'Calibri', sans-serif; font-size: 14px;">
                          <!-- Kepala Surat Start -->
                            <div class="mt-n4 mb-1">
                                <label><strong><CENTER>SURAT IJIN PENGGUNAAN KENDARAAN TES DRIVE</CENTER></strong></label>
                            </div>
                           
                          <div class="ml-3 mr-3" style="margin-top:-5px;">
                          
                            <!--Table data kendaraan-->
                          <div class="mt-n10">
                              <v-row no-gutters>
                                <table class="kendaraan mt-10 mb-2" border="none">
                                  <tr>
                                    <td rowspan="4" style="width: 602px;">
                                        <div style="padding-left:5px;">
                                          <v-row no-gutters>
                                          <label class="col-4 d-flex flex-row" v-text="'No Referensi : '+NoRefrensi"></label>
                                          </v-row>
                                        </div>
                                        <div style="padding-left:5px;" class="mb-n1">
                              <v-row no-gutters>
                                <label>Sesuai kepentingannya, dengan ini diberikan izin penggunaan</label>
                              </v-row>
                            </div>
                            <div class="mb-1" style="padding-left:5px;">
                              <v-row no-gutters>
                                <label>kendaraan <strong style="font-style: italic;">TES DRIVE</strong> kepada karyawan :</label>
                              </v-row>
                            </div>
                            <!--Data Pemakai-->
                            <div>
                      <v-row no-gutters>
                      <v-col cols="9">
                        <div style="padding-left:5px;">
                            <v-row no-gutters>
                              <label style="width: 40%;">Penanggung Jawab</label>
                              <label style="width: 2%;">:</label>
                              <label>{{PenanggungJawab}}</label>
                            </v-row>
                        </div>
                        <div style="padding-left:5px;">
                            <v-row no-gutters>
                              <label style="width: 40%;">Departement</label>
                              <label style="width: 2%;">:</label>
                              <label>{{Department}}</label>
                            </v-row>
                          </div>

                          <div style="padding-left:5px;">
                            <v-row no-gutters>
                              <label style="width: 40%;">Nama Customer</label>
                              <label style="width: 2%;">:</label>
                              <label>{{NamaCustomer}}</label>
                            </v-row>
                          </div>

                          <div style="padding-left:5px;">
                            <v-row no-gutters>
                              <label style="width: 40%;">Hari, Tgl Pemakaian</label>
                              <label style="width: 2%;">:</label>
                              <label>{{TanggalPemakaian}}</label>
                            </v-row>
                          </div>

                          <div style="padding-left:5px;">
                            <v-row no-gutters>
                              <label style="width: 40%;">Hari, Tgl Kembali</label>
                              <label style="width: 2%;">:</label>
                              <label>{{TanggalKembali}}</label>
                            </v-row>
                          </div>

                          <div style="padding-left:5px;">
                            <v-row no-gutters>
                              <label style="width: 40%;">Jam Pemakaian</label>
                              <label style="width: 2%;">:</label>
                              <v-row no-gutters>
                                <label>{{JamKeluar}}</label>
                                <label>s/d</label>
                                <label>{{JamMasuk}}</label>
                              </v-row>
                            </v-row>
                          </div>

                          <div style="padding-left:5px;">
                            <v-row no-gutters>
                              <label style="width: 40%;">Lokasi Tes Drive</label>
                              <label style="width: 2%;">:</label>
                              <label>{{LokasiTesDrive}}</label>
                            </v-row>
                          </div>
                        </v-col>
                        </v-row>
                    </div>
                    <div class="mt-1" style="padding-left:5px;">
                        <v-row no-gutters>
                          <label>Demikian surat permohonan izin ini kami setujui.</label>
                        </v-row>
                    </div>
                    <div class="mt-n1" style="padding-left:5px;">
                        <v-row no-gutters>
                          <label> </label> 
                        </v-row>
                        </div>
                    <div class="mt-2 mb-1" style="padding-left:5px;">
                      <v-row no-gutters>
                        <span style="text-align:center"><i>Mengetahui,</i></span>
                      </v-row>
                    </div>
                            <!--QR-->
                            <div style="margin-top:-2px;margin-left:-20px;z-index:1;position:relative;">
                              <v-row dense no-gutters style="margin-left:-120px;width:200px !important;">
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
                                <th style="height:10px" colspan="1" class="ml-10" v-show="this.AccHR != null">
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
                                    <th colspan="2" style="height:42px;">DATA KENDARAAN TES DRIVE</th>
                                  </tr>
                                    
                                    <tr>
                                        <td rowspan="1">
                                      <div style="height:180px">
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
                                            <label >{{NoPol}}</label>
                                          </v-row>
                                        </div>

                                          <div style="padding-left:5px;">
                                          <v-row no-gutters>
                                            <label style="width: 50%;">Kondisi Awal Kilometer</label>
                                            <label style="width: 2%;">:</label>
                                            <v-row no-gutters>
                                              <label>{{KondisiKM + ' KM'}}</label>
                                            </v-row>
                                          </v-row>
                                        </div>

                                        <div style="padding-left:5px;">
                                          <v-row no-gutters>
                                            <label style="width: 50%;">Kondisi Awal BBM</label>
                                            <label style="width: 2%;">:</label>
                                            <v-row no-gutters>
                                              <label>{{KondisiBBM + ' BAR'}}</label>
                                            </v-row>
                                          </v-row>
                                        </div>
                                        <div style="padding-left:5px;">
                                            <v-row no-gutters>
                                                <label style="width: 50%;">Kondisi Fisik Kendaraan</label>
                                                <label style="width: 2%;">:</label>
                                                <label>{{KondisiAwalFisik}}</label>
                                            </v-row>
                                        </div>
                                        <div style="padding-left:5px;">
                                            <v-row no-gutters>
                                                <label style="width: 50%;" align="left">Kebersihan Interior</label>
                                                <label style="width: 2%;">:</label>
                                                <label >{{Interior}}</label>
                                            </v-row>
                                        </div>
                                        <div style="padding-left:5px;">
                                            <v-row no-gutters>
                                                <label style="width: 50%;" align="left">Kebersihan Eksterior</label>
                                                <label style="width: 2%;">:</label>
                                                <label >{{Eksterior}}</label>
                                            </v-row>
                                        </div>
                                      </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="2" style="height:42px;">PEMERIKSAAN BODY</th>
                                    </tr>
                                    <tr>
                                      
                                        <th :style="[
                                        { backgroundImage: 'url(\'' + require('@/assets/pemeriksaan.png') + '\')' },
                                        {backgroundSize: 'cover'},{backgroundPosition:'center center'},
                                        {width:'452px',height:'202px'}]">
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
          <!-- <page size="A4" layout="landscape"></page> -->
        </v-card-text>
      </v-card>
</template>
<script>
import VueHtml2pdf from 'vue-html2pdf'
import API from "@/services/http";
export default {
  components: { 
        VueHtml2pdf 
    },
    data(){
        return{
            perusahaan:this.$route.params.perusahaan,
            kode:this.$route.params.kode,
            tahun:this.$route.params.tahun,
            no:this.$route.params.no,
            DialogLihatSuratCuti:false,
            DibuatTgl:'',
            server:null,
            dialoglistcuti:false,
            AccHR:null,
            AccManager:null,
            dialog_verifikasi_kontrak: false,
            PenanggungJawab:null,
            ModelKendaraan:null,
            NamaCustomer:null,
            Department:null,
            TanggalPemakaian:null,
            TanggalKembali:null,
            Hari:['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'],
            JamMasuk:null,
            JamKeluar:null,
            Interior:null,
            Eksterior:null,
            NoPol:null,
            KondisiKM:null,
            KondisiBBM:null,
            TanggalSurat:null,
            KondisiAwalFisik:null,
            LokasiTesDrive:null,
            NoRefrensi:null,
            mobile:null,
            datacuti:{
                NoCuti:'',
                karyawan:{
                    Nama:'',
                    jabatan:{
                        NamaJabatan:'',
                    }
                },
                approvalcuti:[]
            },
            detailcuti2:[],
            ShowValidasiKontrak:false,
            MasaKontrak:[],
            today:new Date().toJSON().slice(0,10).split('-').join('-'),
            windowSize: {x: 0, y: 0},
            dialog: false,
            token:localStorage.getItem('token'),
        }
    },
    created(){
      this.server = window.location.origin
      console.log(this.server)
      this.$loading(true)
      let data = this.$CekStore() == null ? [] : this.LocalData() // ini data yang dibawa dari table di cek disini
      if(typeof data == 'object'){ this.GetData(this.$route.params.id) }else{ this.LocalData() }
    },
    mounted(){
      //  this.$loading(true)
     //
    },
    methods:{
     ChangeURL(x){
      this.$ChangeURL(x)
     },
     CetakSurat(){
      // alert('nanti dicetak')
      this.$refs.html2Pdf.generatePdf()
     },
     GetData(x){
      API.get('formtesdrive/'+x).then(x=>{
        let data = x.data
        this.PenanggungJawab = data.penanggung_jawab
        this.Department = data.department.nama_department
        this.ModelKendaraan = data.aset.nama_aset
        this.TanggalPemakaian = this.Hari[new Date(data.tanggal_pemakaian).getDay()]+' '+ this.$DateConvert(data.tanggal_pemakaian)
        this.TanggalKembali = this.Hari[new Date(data.tanggal_kembali).getDay()]+' '+ this.$DateConvert(data.tanggal_kembali)
        this.NamaCustomer = data.nama_customer
        this.KondisiKM = data.kondisi_awal_kilometer
        this.KondisiBBM = data.kondisi_awal_bbm
        this.KondisiAwalFisik = data.kondisi_awal_fisik_kendaraan
        this.LokasiTesDrive = data.lokasi_tes_drive
        this.NoPol = data.aset.no_plat
        this.NoRefrensi = data.id_form_tes_drive
        this.JamMasuk = data.estimasi_jam_masuk_kendaraan
        this.JamKeluar = data.jam_keluar_kendaraan
        this.Interior = data.kondisi_awal_kebersihan_interior
        this.Eksterior = data.kondisi_awal_kebersihan_eksterior
        // this.Interior = data.
        console.log(data)
        this.AccHR = data.acc_hr
        this.AccManager = data.acc_manager
        this.TanggalSurat = this.$DateConvert(data.tanggal_pemakaian)
        this.$loading(false)
      })
     },
     LocalData(){
      let data = this.$CekStore()
        this.PenanggungJawab = data.penanggung_jawab
        console.log(data)
        this.Department = data.department.nama_department
        this.ModelKendaraan = data.aset.nama_aset
        this.TanggalPemakaian = this.Hari[new Date(data.tanggal_pemakaian).getDay()]+' '+ this.$DateConvert(data.tanggal_pemakaian)
        this.TanggalKembali = this.Hari[new Date(data.tanggal_kembali).getDay()]+' '+ this.$DateConvert(data.tanggal_kembali)
        this.NamaCustomer = data.nama_customer
        this.KondisiKM = data.kondisi_awal_kilometer
        this.KondisiBBM = data.kondisi_awal_bbm
        this.JamMasuk = data.estimasi_jam_masuk_kendaraan
        this.JamKeluar = data.jam_keluar_kendaraan
        this.Interior = data.kondisi_awal_kebersihan_interior
        this.Eksterior = data.kondisi_awal_kebersihan_eksterior
        //disini bikin jam masuk jam keluar juga biar dibaca
        this.KondisiAwalFisik = data.kondisi_awal_fisik_kendaraan
        this.LokasiTesDrive = data.lokasi_tes_drive
        this.NoPol = data.aset.no_plat
        this.NoRefrensi = data.id_form_tes_drive
        this.TanggalSurat = this.$DateConvert(data.tanggal_pemakaian)
        this.AccHR = data.acc_hr
        this.AccManager = data.acc_manager
        this.$loading(false)
     }
    }
}
</script>
<style>
  table{
    border-collapse:collapse;
    width: 100%;
  }
  .qrcode {
  display: inline-block;
  /* font-size: 0;
  margin-bottom: 0; */
  position: relative;
  margin-right: -180px;
  margin-left: 90px;
}

.qrcode__image {
  background-color: white;
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