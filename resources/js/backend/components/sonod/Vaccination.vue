<template>
    <div>
        <loader v-if="preLooding" object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#343a40"
            objectbg="#999793" opacity="80" name="circular"></loader>
        <form @submit.stop.prevent="onSubmit">
            <div class="panel-heading"
                style="font-weight: bold; font-size: 20px;background:#159513;text-align:center;color:white">টিকা প্রদান করুন
            </div>
            <div class="form-pannel">






                <div class="row tikaForm" >
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="labelColor">টিকা ধরন </label>
                            <select class="form-control" v-model="tikatype" @change="SelectTikatype" required>
                                <option value="">নির্বাচন করুন</option>
                                <option value="বিসিজি টিকা">বিসিজি টিকা</option>
                                <option value="অন্যান্য টিকা">অন্যান্য টিকা</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-md-4" v-if="tikatype">
                        <div class="form-group">
                            <label for="" class="labelColor">কত তম টিকা  </label>
                            <select class="form-control" v-model="vax.tikadose" @change="SelectTika" required>
                                <option value="">নির্বাচন করুন</option>
                                <option value="১ম বার">১ম বার</option>
                                <option value="২য় বার">২য় বার</option>
                                <option value="৩য় বার">৩য় বার</option>
                                <option value="৪র্থ বার">৪র্থ বার</option>
                                <option value="৫ম বার">৫ম বার</option>

                            </select>
                        </div>
                    </div>






                    <div class="col-md-12" v-if="tikatype">
                        <div class="form-group">
                            <label for="" class="labelColor">টিকার নাম </label>
                            <!-- <multiselect v-model="vax.tikaname" :options="options" :multiple="true" required></multiselect> -->
                        <div class="form-check" v-for="(opt,keys) in options" :key="keys">
                            <input class="form-check-input" v-model="vax.tikaname[keys]" type="checkbox" value="" :id="'tikacheck'+keys">
                            <label class="form-check-label" :for="'tikacheck'+keys">
                                {{ opt }}
                            </label>
                        </div>
                    </div>

                    </div>






                    <div class="col-md-4" v-if="tikatype">
                        <div class="form-group">
                            <label for="" class="labelColor">টিকা কেন্দ্রের নাম </label>
                            <input type="text" class="form-control" v-model="vax.kendro_name" required>
                        </div>
                    </div>

                    <div class="col-md-4" v-if="tikatype">
                        <div class="form-group">
                            <label for="" class="labelColor">স্বাস্থ্য সহকারী/টিকাদান কর্মীর নাম </label>
                            <input type="text" class="form-control" v-model="vax.kormir_name" required  >
                        </div>
                    </div>


                    <div class="col-md-4" v-if="tikatype">
                        <div class="form-group">
                            <label for="" class="labelColor">টিকা প্রদানের তারিখ</label>
                            <input type="date" class="form-control" v-model="vax.tikaDate" required  @change="NextDate">
                        </div>
                    </div>


                    <div class="col-md-4 d-none" v-if="tikatype" >
                        <div class="form-group">
                            <label for="" class="labelColor">পরবর্তী টিকার তারিখ</label>
                            <input type="date" class="form-control" v-model="vax.nextTikaDate" required readonly>
                        </div>
                    </div>





                </div>




                <div style="text-align:center">
                    <button type="submit" class="btn btn-primary" :disabled="disabled" v-html="buttontex">টিকা প্রদান করুন</button>
                </div>


                <div class="row">

<table class="table">
    <tr>
        <th >টিকা কেন্দ্রে আসার তারিখসমূহ</th>
        <th >টিকার ডোস</th>
        <th >কর্মী</th>
        <th >কেন্দ্র</th>
        <th >তারিখ</th>
        <!-- <td >পরবর্তী টিকা গ্রহনের তারিখ</td> -->
    </tr>

    <tr v-for="(tikalist,index) in tikalists" :key="index">
        <td>{{ index+1+'. '+tikalist.tikaname }}</td>
        <td>{{ tikalist.tikadose }}</td>
        <td>{{ tikalist.kormir_name }}</td>
        <td>{{ tikalist.kendro_name }}</td>
        <td>{{ tikalist.tikaDate }}</td>
        <!-- <td>{{ tikalist.nextTikaDate }}</td> -->
    </tr>

<!--
    <tr>
        <td>১। ১ম বার শিশুকে বিসিজি, পােলিও-১, পেন্টা-১ | (ডিপিটি, হেপা-বি, হিব) টিকা
            পাওয়ার তারিখ
            (পেন্টা-১ এবং হামের ক্যালেন্ডার থেকে)।</td>
        <td>{{ form.first_dose }}</td>
    </tr>
    <tr>
        <td>২। ২য় বার শিশুকে পােলিও-২, পেন্টা-২ (ডিপিটি,
            হেপা-বি, হিব) টিকা দেয়ার জন্য যে তারিখে টিকা
            কেন্দ্রে আনতে হবে (সেশন প্ল্যান থেকে)।</td>
        <td>{{ form.second_dose }}</td>
    </tr>
    <tr>
        <td>৩। ৩য় বার শিশুকে পােলিও-৩, পেন্টা-৩ (ডিপিটি,
            হেপা-বি, হিব) টিকা দেয়ার জন্য যে তারিখে টিকা
            কেন্দ্রে আনতে হবে (সেশন প্ল্যান থেকে)।</td>
        <td>{{ form.third_dose }}</td>
    </tr>
    <tr>
        <td>৪। ৪র্থ বার শিশুকে হাম, পােলিও-৪, এবং ভিটামিন-এ
            পাওয়ার তারিখ (পেন্টা-১ এবং হামের ক্যালেন্ডার থেকে)।</td>
        <td>{{ form.forth_dose }}</td>
    </tr> -->
</table>
</div>




                <!-- <b-button class="ml-2" @click="resetForm()">রিসেট</b-button> -->
            </div>
        </form>

    </div>
</template>
<script>


export default {





    data() {
        return {
            value: null,
        options: {0:'পেন্টা (ডিপিটি, হেপ-বি, হিব)', 1:'ওপিভি', 2:'পিসিভি', 3:'আইপিভি', 4:'এমআর', 5:'এমআর (হাম ও রুবেলা)'},
            infoModal: {
                id: 'info-modal',
                title: '',
                content: '',
                content_id: '',
            },
            charages: {
                sonod_fee: 0,
                vatAmount: 0,
                taxAmount: 0,
                service: 0,
                totalamount: 0,
            },
            preLooding: false,
            waitForPayment: false,
            submitLoad: false,
            disabled: false,
            sameStatus: '',
            buttontex: 'টিকা প্রদান করুন',
            sonodnamedata: {},
            SonodNamesOptions: {},
            form: {
                id:'',
                first_dose:'',
                second_dose:'',
                third_dose:'',
                forth_dose:'',
            },
            vax:{
                applicantId:'',
                tikaname:{},
                tikadose:'',
                kendro_name:'উপজেলা স্বাস্থ্য কমপ্লেক্স, তেঁতুলিয়া, পঞ্চগড়',
                kormir_name:'',
                tikaDate:'',
                nextTikaDate:'',
            },
            tikatype:'',

            tikalists: {},

            getdivisions: {},
            getdistricts: {},
            getthanas: {},
            getuniouns: {},

            getdivisionsPer: {},
            getdistrictsPer: {},
            getthanasPer: {},
            getuniounsPer: {},
            Pdivision: 7,
            Perdivision: 7,
            applicant_present_district: '',
            applicant_permanent_district: '',
        };
    },

    methods: {


        NextDate(){

            var increaseDay = 0;

            var day = new Date(this.vax.tikaDate);



            if(this.vax.tikadose=='১ম বার'){
                increaseDay = 28 //২য় বার
            }else if(this.vax.tikadose=='২য় বার'){
                increaseDay = 28  //৩য় বার
            }else if(this.vax.tikadose=='৩য় বার'){
                increaseDay = 270 //৪র্থ বার
                day = new Date(this.form.date_of_birth);
            }else if(this.vax.tikadose=='৪র্থ বার'){
                increaseDay = 450 //৫ম বার
                day = new Date(this.form.date_of_birth);
            }else if(this.vax.tikadose=='৫ম বার'){
                increaseDay = 0
            }
            var nextDay = new Date(day);
            nextDay.setDate(day.getDate() + increaseDay);


            this.vax.nextTikaDate = this.dateformatGlobal(nextDay)[0]
            // console.log(this.vax.nextTikaDate)
        },




        async getdivisionFun() {
            var res = await this.callApi('get', `/api/getdivisions`, []);
            this.getdivisions = res.data;
        },

        async getdistrictFun() {

            var res = await this.callApi('get', `/api/getdistrict?id=${this.Pdivision}`, []);
            this.getdistricts = res.data;




        },

        async getthanaFun() {
            var res = await this.callApi('get', `/api/getthana?id=${this.applicant_present_district}`, []);
            this.getthanas = res.data;
            var resOwn = await this.callApi('get', `/api/getdistrict?ownid=${this.applicant_present_district}`, []);
            this.form.applicant_present_district = resOwn.data.bn_name

        },

        async getuniounFun() {
            var res = await this.callApi('get', `/api/getunioun?id=${this.thana}`, []);
            this.getuniouns = res.data;
        },



        address() {
            this.getdivisionFun();
        },

        async SelectTika(){
            this.preLooding = true
            var res = await this.callApi('get',`/api/check/tika?applicantId=${this.form.id}&tikadose=${this.vax.tikadose}&tikatype=${this.tikatype}`);
        //    console.log(res)

            if(res.data.statusCode){
                Notification.customError2(`${this.vax.tikadose} টিকা ইতিমধ্যে দেওয়া হয়েছে। পরবর্তী টিকার তারিখঃ ${res.data.nextDate}` );
                this.vax.tikadose = '';
                this.vax.tikaname = [];

            }else{

                if(this.tikatype=='বিসিজি টিকা'){
                this.options= ['বিসিজি']
                this.vax.tikaname = {0:'বিসিজি'}
            }else if(this.tikatype=='অন্যান্য টিকা'){



                if(this.vax.tikadose=='১ম বার'){
                this.vax.tikaname = {0:'পেন্টা (ডিপিটি, হেপ-বি, হিব)', 1:'ওপিভি', 2:'পিসিভি', 3:'আইপিভি'}
                }else if(this.vax.tikadose=='২য় বার'){
                    this.vax.tikaname = {0:'পেন্টা (ডিপিটি, হেপ-বি, হিব)', 1:'ওপিভি', 2:'পিসিভি'}
                }else if(this.vax.tikadose=='৩য় বার'){
                    this.vax.tikaname = {0:'পেন্টা (ডিপিটি, হেপ-বি, হিব)', 1:'ওপিভি', 2:'পিসিভি', 3:'আইপিভি'}
                }else if(this.vax.tikadose=='৪র্থ বার'){
                    this.vax.tikaname = {4:'এমআর'}
                }else if(this.vax.tikadose=='৫ম বার'){
                    this.vax.tikaname = {4:'এমআর'}
                }else{
                    this.vax.tikaname = []

                }

                }
            }
            this.NextDate();
            this.preLooding = false




        },


        SelectTikatype(){
            if(this.tikatype=='বিসিজি টিকা'){
                this.options= {0:'বিসিজি'}
            }else if(this.tikatype=='অন্যান্য টিকা'){
                this.options= {0:'পেন্টা (ডিপিটি, হেপ-বি, হিব)', 1:'ওপিভি', 2:'পিসিভি', 3:'আইপিভি', 4:'এমআর', 5:'এমআর (হাম ও রুবেলা)'}
            }
            this.SelectTika();
        },



        async onSubmit() {
            this.vax.applicantId = this.form.id

            var res = await this.callApi('post', '/api/tikalog', this.vax);

            Notification.customSuccess(`টিকা প্রদান সফল`);
            this.$router.push({ name: 'applicationlistWord', params:{type:'approved'} })


        },

        async getdata(id) {
            var res = await this.callApi('get', `/api/sonod/single/${id}?admin=true`, []);

            this.form = res.data.sonod

            var res2 = await this.callApi('get', `/api/tikalog?applicantId=${id}`, []);
            this.tikalists = res2.data

                this.buttontex = 'টিকা প্রদান করুন';
                this.vax.tikaDate = this.dateformatGlobal()[0];
                this.NextDate();



        }
    },
    mounted() {
        this.getdata(this.$route.params.id)
        this.address();


        this.vax.kormir_name = this.Users.names

    }
};
</script>
<style  >
.app-heading {
    text-align: center;
    margin: 32px 0;
    font-size: 23px;
    border-bottom: 1px solid #159513;
    color: #ffffff;
    background: #255f95;
}

.form-pannel {
    border: 1px solid #159513;
    padding: 25px 25px 25px 25px;
}

.panel-heading {
    padding: 11px 0px;
    border-top-right-radius: 6px;
    border-top-left-radius: 6px;
    margin-top: 20px;
}

.form-pannel {
    border-bottom-left-radius: 6px;
    border-bottom-right-radius: 6px;
}

.dropdown-menu {
    z-index: 99999;
}

.labelColor {
    color: #493eff;
    font-weight: 600;
}


.multiselect {
    border: 1px solid var(--bgColor2) !important;
    border-radius: 4px;
}


.tikaForm{
    border: 2px solid #0089ff;
    margin: 13px;
    padding: 24px 8px 24px 8px;
}



</style>
