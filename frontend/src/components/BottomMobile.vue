<template>
    <v-bottom-navigation
  fixed
  app
  elevation="6"
      v-model="value"
      :input-value="active"
      shift
      color="red darken-4"
    >
    <v-btn value="/" @click="ChangeURL('')">
        <span>Home</span>

        <v-icon>mdi-home</v-icon>
      </v-btn>
      <v-btn value="history">
        <span>History</span>

        <v-icon>mdi-history</v-icon>
      </v-btn>
    </v-bottom-navigation>
</template>
<script>
export default {
    data(){
        return{
            active:true,
            value:'/',
        }
    },
    mounted(){
        //
    },
    methods:{
      ChangeURL(x){
        this.$ChangeURL(x)
      }, 
    }
}
</script>