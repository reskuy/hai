<template>  
  <center>
    <div class="cambox" style="height: 600px; width: 100%;">

      <qrcode-stream :camera="camera" @decode="onDecode" @init="onInit">
        <v-btn small fab depressed @click="switchCamera"><v-icon>mdi-camera-retake-outline</v-icon></v-btn>
      </qrcode-stream>
      <!-- <v-chip>Batal</v-chip> -->
    </div>
  </center>
</template>

<script>
import Vue from "vue";
import VueQrcodeReader from "vue-qrcode-reader";

Vue.use(VueQrcodeReader);


export default {
  data () {
    return {
      camera: 'rear',
      noRearCamera: false,
      noFrontCamera: false,
    }
  },
  created(){
      this.$loading(true)
  },
  mounted(){
    //
  },
  watch:{
    //
  },
  computed:{
    //
  },

  methods: {
    switchCamera () {
      switch (this.camera) {
        case 'front':
          this.camera = 'rear'
          break
        case 'rear':
          this.camera = 'front'
          break
      }
    },


    async onDecode (result) {
      this.$loading(true)
      window.location.assign(result)
    },

    async onInit (promise) {
      try {
        await promise
      } catch (error) {
        const triedFrontCamera = this.camera === 'front'
        const triedRearCamera = this.camera === 'rear'

        const cameraMissingError = error.name === 'OverconstrainedError'

        if (triedRearCamera && cameraMissingError) {
          this.noRearCamera = true
          this.camera = 'front'
          alert('Camera Belakang Tidak Ditemukan')
        }

        if (triedFrontCamera && cameraMissingError) {
          this.noFrontCamera = true
          alert('Camera Depan Tidak Ditemukan')
        }

        // console.error(error)
      }
      this.$loading(false)
    }
  }
}
</script>

<style scoped>
button {
  position: absolute;
  left: 10px;
  top: 10px;
}

.error {
  color: red;
  font-weight: bold;
}
.cambox{
    width:850px;
    height: 500px;
}
</style>