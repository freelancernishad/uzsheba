<template>
    <div>

<div class="breadcrumbs-area">
    <h3>Tenders form</h3>
    <ul>
        <li>
            <router-link :to="{name:'Dashboard'}">Home</router-link>
        </li>
        <li>Tenders form</li>
    </ul>
</div>

    <form class="row" @submit.stop.prevent="onSubmit">


        <div class="form-group col-md-6">
          <label for="">ইজারার ধরণ</label>
          <input type="text" v-model="form.tender_type" class="form-control" placeholder="" aria-describedby="helpId">
        </div>

        <div class="form-group col-md-6">
          <label for="">স্মারক নং</label>
          <input type="text" v-model="form.memorial_no" class="form-control" placeholder="" aria-describedby="helpId">
        </div>

        <div class="form-group col-md-6">
          <label for="">ইজারার শিরোনাম</label>
          <input type="text" v-model="form.tender_name" class="form-control" placeholder="" aria-describedby="helpId">
        </div>

        <div class="form-group col-md-12">
          <label for="">ইজারার বিবরণ</label>
             <textarea v-model="form.description" class="form-control" style="height:150px"></textarea>
        </div>






        <!-- <div class="form-group col-md-6">
          <label for="">ওয়ার্ড নং</label>

            <select v-model="form.tender_word_no" class="form-control" >
                <option value="">ওয়ার্ড নির্বাচন করুন</option>
                <option value="1">১</option>
                <option value="2">২</option>
                <option value="3">৩</option>
                <option value="4">৪</option>
                <option value="5">৫</option>
                <option value="6">৬</option>
                <option value="7">৭</option>
                <option value="8">৮</option>
                <option value="9">৯</option>
            </select>
        </div> -->






        <div class="form-group col-md-6">
          <label for="">সরকারি মূল্য</label>
          <input type="Number" v-model="form.govt_price" class="form-control" placeholder="" aria-describedby="helpId">
        </div>

        <div class="form-group col-md-6">
          <label for="">সিডিউল মূল্য</label>
          <input type="Number" v-model="form.form_price" class="form-control" placeholder="" aria-describedby="helpId">
        </div>




        <div class="col-md-12"></div>



        <div class="form-group col-md-6">
          <label for="">সিডিউল ক্রয়ের শেষ তারিখ</label>
          <input type="datetime-local" v-model="form.form_buy_last_date" class="form-control" placeholder="" aria-describedby="helpId">
        </div>

        <div class="form-group col-md-6">
          <label for="">সিডিউল ক্রয়ের স্থান</label>
          <input type="text" v-model="form.form_buy_address" class="form-control" placeholder="" aria-describedby="helpId">
        </div>



        <div class="form-group col-md-6">
          <label for="">বিজ্ঞপ্তির তারিখ</label>
          <input type="datetime-local" v-model="form.noticeDate" class="form-control" placeholder="" aria-describedby="helpId">
        </div>


        <div class="form-group col-md-6">
          <label for="">দরপত্র গ্রহনের শুরুর তারিখ</label>
          <input type="datetime-local" v-model="form.tender_start" class="form-control" placeholder="" aria-describedby="helpId">
        </div>


        <div class="form-group col-md-6">
          <label for="">দরপত্র গ্রহনের শেষ তারিখ</label>
          <input type="datetime-local" v-model="form.tender_end" class="form-control" placeholder="" aria-describedby="helpId">
        </div>


        <div class="form-group col-md-6">
          <label for="">দরপত্র দাখিলের পদ্ধতি ও স্থান</label>
          <input type="text" v-model="form.tender_submit_role_address" class="form-control" placeholder="" aria-describedby="helpId">
        </div>




        <div class="form-group col-md-6">
          <label for="">দরপত্র খোলার তারিখ</label>
          <input type="datetime-local" v-model="form.tender_open" class="form-control" placeholder="" aria-describedby="helpId">
        </div>


        <div class="form-group col-md-6">
          <label for="">দরপত্র খোলার স্থান</label>
          <input type="text" v-model="form.tender_open_address" class="form-control" placeholder="" aria-describedby="helpId">
        </div>


        <div class="col-md-12">

            <div class="form-group">
                <label for="">Title</label>
                <input type="text" v-model="form.tender_product_title" class="form-control" placeholder="" aria-describedby="helpId">
            </div>


            <div class="form-group">
                <label for="">সংখ্যা/পরিমাণ</label>
                <vue-editor v-model="form.tender_product_Number_Quantity" api-key="nhnny39zzu3w0euy077ojdf9gk1n3mjpkobk25i228rt3qkz" style="height:250px;" :init="tinyInt"></vue-editor>
            </div>

        </div>







        <div class="form-group col-md-12">
          <label for="">শর্তাবলি</label>
          <vue-editor v-model="form.tender_roles" api-key="nhnny39zzu3w0euy077ojdf9gk1n3mjpkobk25i228rt3qkz" style="height:250px;" :init="tinyInt"></vue-editor>
        <!-- <textarea v-model="form.tender_roles" class="form-control" style="height:300px"></textarea> -->
        </div>



        <div class="col-md-12 text-center">

    <button class="btn btn-info px-5 py-3" style="font-size: 18px;" type="submit">বিজ্ঞপ্তি সম্পন্ন করুন</button>
</div>
    </form>


    </div>
</template>

<script>
export default {
    data(){
        return {
            form:{
                tender_type:'',
                memorial_no:'',
                tender_name:'',
                description:'',
                tender_word_no:'',
                govt_price:'',
                form_price:'',
                noticeDate:'',
                form_buy_last_date:'',
                tender_start:'',
                tender_end:'',
                tender_open:'',
                tender_roles:'',
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
            this.form = res.data;
        },

        async onSubmit() {

            if(this.$route.params.id){
                var id =  this.$route.params.id;
                var res = await this.callApi('put', `/api/tender/${id}`, this.form);
                Notification.customSuccess('Tender Update Success');
            }else{

                this.form['union_name'] = this.Users.unioun;
                var res = await this.callApi('post', '/api/tender', this.form);
                Notification.customSuccess('Tender Create Success');
            }
            this.$router.push({ name: 'tenderlist',params:{name:'pending'}})
        },
    },
    mounted(){
        if(this.$route.params.id){
            this.getsonodById();
        }
    }
}
</script>



