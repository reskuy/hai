<template>
    <v-card>

    </v-card>
</template>
<script>
// import API from "@/services/http";
export default {
    data(){
        return{
            //
        }
    },
    created(){
       this.$loading(true)
       this.Cek()
    },
    mounted(){
      //  this.$loading(true)
     //
    },
    methods:{
        Cek(){
            this.$swal.fire(
                'Surat Ini Valid',
                'Sudah Di ACC Oleh HR / GA',
                'success'
             ).then(res=>{
                if(res.isConfirmed == true){
                    this.$ChangeURL('FormPengembalianTesDrive/'+this.$route.params.id)
                }
             })
             this.$loading(false)
        }
    }

}
</script>