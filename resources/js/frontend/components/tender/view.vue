<template>
    <div class="my-5">
        <loader v-if="preloader" object="#ff9633" color1="#ffffff" color2="#17fd3d" size="25" speed="2"
            bg="#343a40" objectbg="#999793" opacity="80" disableScrolling="false" name="loading"></loader>
            <h4 class="text-center" style="    background: #008000;
    color: white;
    padding: 12px 3px;">ই-নিলাম/ই-ইজারা সিস্টেম</h4>

        <!-- <h3>{{ tender.tender_name }}</h3> -->



    <div style='text-align:center; margin-bottom:20px'>
        <p class='m-0'>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</p>
        <p class='m-0'>উপজেলা নির্বাহী অফিসারের কার্যালয়</p>
        <p class='m-0'>তেঁতুলিয়া, পঞ্চগড়।</p>
        <p class='m-0'>www.tetulia.panchagarh.gov.bd</p>
    </div>

    <table width='100%' style='margin-bottom:15px !important'>
            <tr>
                <td style='text-align:left'>স্মারক নং:- {{ tender.memorial_no }}</td>
                <td style='text-align:right'>তারিখ:-  {{ dateformatGlobal(tender.noticeDate)[4] }} </td>
            </tr>
        </table>


       <p>{{ tender.description }}</p>

       <!-- <h4 class="text-center">বিবরণ</h4>
        <hr> -->

       <!-- <p>ইজারার ধরণ : {{ tender.tender_type }}</p> -->
       <!-- <p>সরকারি মূল্য : {{ tender.govt_price }}</p> -->

       <p>সিডিউল মূল্য : {{ tender.form_price }} [অফেরতযোগ্য</p>
       <p>অনলাইনে সিডিউল ক্রয়ের শেষ তারিখ ও সময় : {{ dateformatGlobal(tender.form_buy_last_date)[6] }}</p>
       <p>দরপত্র গ্রহনের শুরুর তারিখ ও সময় : {{ dateformatGlobal(tender.tender_start)[6] }}</p>
       <p>দরপত্র গ্রহনের শেষ তারিখ ও সময় : {{ dateformatGlobal(tender.tender_end)[6] }}</p>
       <p>দরপত্র খোলার তারিখ ও সময় : {{ dateformatGlobal(tender.tender_open)[6] }}</p>

       <h4 class="text-center">শর্তাবলী</h4>
       <hr>
       <div style="word-wrap: break-word;" v-html="tender.tender_roles"></div>



       <table width="100%" style="border-collapse: collapse;" border="0">
                              <tr>
                                  <td  style="text-align: center;" width="40%"></td>
                                  <td style="text-align: center; width: 200px;" width="30%"></td>
                                  <td style="text-align: center;" width="40%">
                                      <div class="signature text-center position-relative">

                                    সোহাগ চন্দ্র সাহা <br>
                                    উপজেলা নির্বাহী অফিসার <br>
                                    তেঁতুলিয়া, পঞ্চগড়। <br>
                                    e-mail: unotetulia@mopa.gov.bd
                                      </div>
                                  </td>
                              </tr>
                          </table>';







       <div class="text-center">
            <a target="_blank" :href="'/pdf/tenders/'+tender.tender_id" class="btn btn-danger mt-3">বিজ্ঞপ্তি ডাউনলোড করুন</a>
            <a :href="'/tenders/form/buy/'+tender.tender_id" class="btn btn-warning mt-3">সিডিউল ফর্ম কিনুন</a>
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
