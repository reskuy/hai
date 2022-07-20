<template>
<v-card id="snackbar" @click="hide">
    <v-icon color="white" class="mr-2">mdi-note</v-icon>
    <span>{{data}}</span>
</v-card>
</template>
<script>
import Vue from 'vue'
export default {
    data(){
        return{
            data:null
        }
    },
    mounted(){
        Vue.prototype.$Notifkan = this.Notifkan
    },
    methods:{
        Notifkan(z) {
            var x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
            this.data = z.body
        },
        hide(){
            var x = document.getElementById("snackbar");
            x.className = x.className.replace("show", "")
        }
    }
}
</script>

<style>
#snackbar {
  visibility: hidden;
  min-width: 100%;
  background-color: #333;
  color: #fff;
  text-align: center;
  border-radius: 2px;
  padding: 16px;
  position: fixed;
  z-index: 1;
  left: 0%;
  top: 50px;
  font-size: 17px;
}

#snackbar.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@-webkit-keyframes fadein {
  from {top: 0; opacity: 0;} 
  to {top: 50px; opacity: 1;}
}

@keyframes fadein {
  from {top: 0; opacity: 0;}
  to {top: 50px; opacity: 1;}
}

@-webkit-keyframes fadeout {
  from {top: 50px; opacity: 1;} 
  to {top: 0; opacity: 0;}
}

@keyframes fadeout {
  from {top: 50px; opacity: 1;}
  to {top: 0; opacity: 0;}
}
</style>