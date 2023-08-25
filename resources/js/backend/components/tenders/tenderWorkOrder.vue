<template>
    <div>
        <div class="breadcrumbs-area">
    <h3>Work Order</h3>
    <ul>
        <li>
            <router-link :to="{name:'Dashboard'}">Home</router-link>
        </li>
        <li>Work Order</li>
    </ul>
</div>


<form class="row" @submit.stop.prevent="onSubmit">


    <div class="form-group col-md-6">
          <label for="">ব্যাংকের নাম</label>
          <input type="text" v-model="form.bank_name" class="form-control" placeholder="" aria-describedby="helpId">
    </div>


    <div class="form-group col-md-6">
          <label for="">ব্যাংকের হিসাব নাম্বার</label>
          <input type="text" v-model="form.bank_account_no" class="form-control" placeholder="" aria-describedby="helpId">
    </div>





<div class="form-group col-md-12">
  <label for="">সূত্র</label>
  <vue-editor v-model="form.formula" api-key="nhnny39zzu3w0euy077ojdf9gk1n3mjpkobk25i228rt3qkz" style="height:250px;" :init="tinyInt"></vue-editor>
</div>




<div class="form-group col-md-12">
  <label for="">কার্যাদেশের বিবরণ</label>
  <vue-editor v-model="form.order_description" api-key="nhnny39zzu3w0euy077ojdf9gk1n3mjpkobk25i228rt3qkz" style="height:250px;" :init="tinyInt"></vue-editor>
</div>




<div class="form-group col-md-12">
  <label for="">অনুলিপি এবং অন্যান্য</label>
  <vue-editor v-model="form.copy_details" api-key="nhnny39zzu3w0euy077ojdf9gk1n3mjpkobk25i228rt3qkz" style="height:250px;" :init="tinyInt"></vue-editor>
</div>



<div class="col-md-12 text-center mb-5">

<button class="btn btn-info px-5 py-3" style="font-size: 18px;" type="submit">কার্যাদেশ প্রদান করুন</button>
</div>
</form>


    </div>
</template>



<script>
export default {
    data(){
        return {
            form:{
                formula:'',
                order_description:'',
                copy_details:'',
                tender_list_id:'',
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

            var tender_work_orders = res.data.tender_work_orders;
            if(tender_work_orders){
                this.form.formula = tender_work_orders.formula;
                this.form.order_description = tender_work_orders.order_description;
                this.form.copy_details = tender_work_orders.copy_details;
            }

        },

        async onSubmit() {

            this.form.tender_list_id = this.$route.params.id;
            var res = await this.callApi('post', '/api/tender-work-orders', this.form);
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


