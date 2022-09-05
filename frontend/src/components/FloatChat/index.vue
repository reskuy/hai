<template>
    <v-layout>
        <v-speed-dial
         class="fab"
        v-model="fab"
        id="fab"
        @click="ChatBtn"
        bottom
        left
        :direction="'top'"
        :open-on-hover="false"
        :transition="'slide-y-reverse-transition'"
      >
        <template v-slot:activator>
          <v-btn
            v-model="fab"
            color="#a10115"
            dark
            fab
          >
            <v-icon v-if="fab">
              mdi-close
            </v-icon>
            <v-icon v-else>
              mdi-chat
            </v-icon>
          </v-btn>
        </template>
        <v-btn
          dark
          small
          data-nama="Agus" data-wa="6287819003468"
          @click="ToWa('6287819003468')"
          color="green"
        >
        <span data-nama="Agus" data-wa="6287819003468" class="Agus mr-2">Agus</span>
          <v-icon data-nama="Agus" data-wa="6287819003468">mdi-whatsapp</v-icon>
        </v-btn>
        <v-btn
          dark
          small
          data-nama="Jordy" data-wa="6285250384489"
          @click="ToWa('6285250384489')"
          color="green"
        >
        <span data-nama="Jordy" data-wa="6285250384489" class="Jordy mr-2">Jordy </span>
          <v-icon data-nama="Jordy" data-wa="6285250384489">mdi-whatsapp</v-icon>
        </v-btn>
      </v-speed-dial>
      </v-layout>
</template>
<script>
export default {
    data: () => ({
        fab:false,
        device:null,
    }),
    mounted(){
      this.device = this.$device
      // console.log('script running')
      //     var object = document.getElementById('fab'),
      //     initX, initY, firstX, firstY;
      //     var show = this.show

      //     object.addEventListener('mousedown', function(e) {
            
      //       e.preventDefault();
      //       initX = this.offsetLeft;
      //       initY = this.offsetTop;
      //       firstX = e.pageX;
      //       firstY = e.pageY;

      //       this.addEventListener('mousemove', dragIt, false);

      //       window.addEventListener('mouseup', function() {
      //         object.removeEventListener('mousemove', dragIt, false);
      //       }, false);

      //     }, false);

      //     object.addEventListener('touchstart', function(e) {
      //       // setTimeout(() => {
      //         this.addEventListener('touched', show(e), false)
      //       // }, 1000);
      //       e.preventDefault();
      //       initX = this.offsetLeft;
      //       initY = this.offsetTop;
      //       var touch = e.touches;
      //       firstX = touch[0].pageX;
      //       firstY = touch[0].pageY;

      //       this.addEventListener('touchmove', swipeIt, false);

      //       window.addEventListener('touchend', function(e) {
      //         e.preventDefault();
      //         object.removeEventListener('touchmove', swipeIt, false);
      //         object.removeEventListener('touched', show(e), false);
      //       }, false);
      //     }, false);

      //     function dragIt(e) {
      //       this.style.marginLeft = initX+e.pageX-firstX + 'px';
      //       this.style.bottom = initY+e.pageY-firstY + 'px';
      //     }

      //     function swipeIt(e) {
      //       var contact = e.touches;
      //       this.style.marginLeft = initX+contact[0].pageX-firstX + 'px';
      //       this.style.bottom = initY+contact[0].pageY-firstY + 'px';
      //     }
    },
    methods:{
        ChatBtn(){
          //
        },
        ToWa(x){
            window.open('https://wa.me/'+x+'?text=Saya User HAI Mau Bertanya', '_blank').focus()
        },
        show(e){
          console.log(e)
          // if(this.device == 'Mobile'){
          //   this.fab = !this.fab
          //   // console.log(e.touches[0].target.dataset)
          //   if(e.touches[0].target.dataset.wa){
          //     this.ToWa(e.touches[0].target.dataset.wa)
          //   }
          // }
          console.log('clicked')
        }
    }

}
</script>
<style>
.fab{
  /* bottom:80px;
  margin-left:275px; */
  position: fixed;
  -webkit-transition: all 1s ease-in-out;
  transition: all 1s ease-in-out;
  z-index: 4;
}
</style>