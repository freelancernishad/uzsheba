<template>
    <div>
        <div class="breadcrumbs-area">
    <h3>Resulation</h3>
    <ul>
        <li>
            <router-link :to="{name:'Dashboard'}">Home</router-link>
        </li>
        <li>Resulation</li>
    </ul>
</div>


<form class="row" @submit.stop.prevent="onSubmit">


    <div class="form-group col-md-12">
          <label for="">স্মারক নং</label>
          <input type="text" v-model="form.memorial_no" class="form-control" placeholder="" aria-describedby="helpId">
    </div>


    <div class="form-group col-md-12">
          <label for="">নিলাম/ইজারার  শিরোনাম</label>
          <textarea v-model="form.description" class="form-control" cols="30" rows="4" style="height: 100px;"></textarea>
    </div>









<div class="col-md-12 text-center mb-5">

<button class="btn btn-info px-5 py-3" style="font-size: 18px;" type="submit">রেজোলিউশন প্রদান করুন</button>
</div>
</form>


    </div>
</template>



<script>
export default {
    data(){
        return {
            form:{
                memorial_no:'',
                description:''
            },
            tinyInt:
                {
                    plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
                    toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
                }
            ,
            unions:{},
        }
    },
    methods:{

        async getsonodById(){
           var id =  this.$route.params.id;
            var res = await this.callApi('get', `/api/tender/${id}`, []);

            var resolutions = res.data.resolutions
            if(resolutions){

                this.form.memorial_no = resolutions.memorial_no;
                this.form.description = resolutions.description;
            }


        },

        async onSubmit() {

            this.form.tender_list_id = this.$route.params.id;
            var res = await this.callApi('post', '/api/resolutions', this.form);
            Notification.customSuccess('Success');
            this.$router.push({ name: 'tenderlist',params:{name:'Completed'}})

        },
    },
    mounted(){
        if(this.$route.params.id){
            this.getsonodById();
        }
    }
}
</script>


