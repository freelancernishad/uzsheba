<template>
    <div class="my-5">
        <loader v-if="preloader" object="#ff9633" color1="#ffffff" color2="#17fd3d" size="25" speed="2"
            bg="#343a40" objectbg="#999793" opacity="80" disableScrolling="false" name="loading"></loader>

        <h3>{{ tender.tender_name }}</h3>

       <p>{{ tender.description }}</p>

       <h4 class="text-center">বিবরণ</h4>
        <hr>

       <p>ইজারার ধরণ : {{ tender.tender_type }}</p>
       <p>সরকারি মূল্য : {{ tender.govt_price }}</p>
       <p>সিডিউল মূল্য : {{ tender.form_price }}</p>
       <p>অনলাইনে সিডিউল ক্রয়ের শেষ তারিখ : {{ dateformatGlobal(tender.form_buy_last_date)[6] }}</p>
       <p>দরপত্র গ্রহনের শুরুর তারিখ : {{ dateformatGlobal(tender.tender_start)[6] }}</p>
       <p>দরপত্র গ্রহনের শেষ তারিখ : {{ dateformatGlobal(tender.tender_end)[6] }}</p>
       <p>দরপত্র খোলার তারিখ : {{ dateformatGlobal(tender.tender_open)[6] }}</p>

       <h4 class="text-center">শর্তাবলি</h4>
       <hr>
       <div style="word-wrap: break-word;" v-html="tender.tender_roles"></div>



       <div class="text-center">
            <a target="_blank" :href="'/pdf/tenders/'+tender.tender_id" class="btn btn-danger mt-3">বিজ্ঞপ্তি ডাউনলোড করুন</a>
            <!-- <a :href="'/tenders/form/buy/'+tender.tender_id" class="btn btn-warning mt-3">সিডিউল ফর্ম কিনুন</a> -->
            <a :href="'/tenders/'+tender.tender_id" class="btn btn-info mt-3">ইজারা দাখিল করার জন্য ক্লিক করুন</a>
       </div>




    </div>
</template>

<script>
export default {
    data() {
        return {
            tender:{},
            preloader:true,
        }
    },
    watch: {
        '$route': {
            handler(newValue, oldValue) {
                this.getTender();
            },
            deep: true
        }
    },
    methods: {
        async getTender(){
            this.preloader = true;
            var id = this.$route.params.id;
            var res = await this.callApi('get',`/api/get/single/tender/${id}`,[]);
            this.tender = res.data;
            this.preloader = false;
        }
    },
    mounted(){
        this.getTender();
    }
}
</script>
