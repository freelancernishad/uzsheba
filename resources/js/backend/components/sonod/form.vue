<template>
    <div>
        <form @submit.stop.prevent="onSubmit">
            <div class="panel-heading"
                style="font-weight: bold; font-size: 20px;background:#159513;text-align:center;color:white">প্রসব অনুমোদন করুন
            </div>
            <div class="form-pannel">







                    <div class="row">
                        <div class="col-md-4">
                        <div class="form-group">
                            <span for="" class="labelColor">আইডি নং : <span class="text-danger"></span></span>{{ form.id_no }}
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <span for="" class="labelColor">গর্ভবতী মহিলার নাম : <span class="text-danger"></span></span>{{ form.name }}
                        </div>
                    </div>



                    <div class="col-md-4">
                        <div class="form-group">
                            <span for="" class="labelColor">গর্ভবতী মহিলার জাতীয় পরিচয়পত্র : <span class="text-danger"></span></span>{{ form.pregnant_woman_nid }}
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <span for="" class="labelColor">স্বামীর নাম : <span class="text-danger"></span></span>{{ form.husband_name }}
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <span for="" class="labelColor">স্বামীর জাতীয় পরিচয়পত্র : <span class="text-danger"></span></span>{{ form.husband_name_nid }}
                        </div>
                    </div>



                    <div class="col-md-4">
                        <div class="form-group">
                            <span for="" class="labelColor">মোবাইল নম্বর : </span>{{ form.mobile_no }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <span for="" class="labelColor">বিভাগ : </span>{{ form.division }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <span for="" class="labelColor">জেলা : </span>{{ form.district }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <span for="" class="labelColor">উপজেলা/থানা : </span>{{ form.upazila }}


                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <span for="" class="labelColor">ইউনিয়ন : </span>{{ form.union }}


                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <span for="" class="labelColor">পোষ্ট অফিস : </span>{{ form.post_office }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <span for="" class="labelColor">ওয়ার্ড নং : </span>{{ form.word_number }}


                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <span for="" class="labelColor">গ্রাম/মহল্লা : </span> {{ form.village }}

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <span for="" class="labelColor">শেষ মাসিকের তারিখ : </span> {{ form.date_of_last_menstrual_period }}

                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <span for="" class="labelColor">সম্ভাব্য প্রসবের তারিখ : </span>{{ form.probable_date_of_delivery }}
                        </div>
                    </div>







                    <div class="col-md-4">
                        <div class="form-group">
                            <span for="" class="labelColor">গ্রাভিড (কত তম গর্ভ) : </span>{{ form.how_many_wombs }}

                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <span for="" class="labelColor">কততম সন্তান  : </span>{{ form.how_many_children }}

                        </div>
                    </div>



                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="labelColor">সন্তান প্রসবের তারিখ</label>
                            <input type="date" class="form-control" v-model="form.date_of_birth" required>
                        </div>
                    </div>



                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="labelColor">সন্তান প্রসব</label>
                            <select class="form-control" v-model="form.childbirth_type" required>
                                <option value="">নির্বাচন করুন</option>
                                <option>জীবত প্রসব</option>
                                <option>মৃত প্রসব</option>
                                <option>গর্ভপাত প্রসব</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="labelColor">লিঙ্গ</label>
                            <select class="form-control" v-model="form.gender" required>
                                <option value="">নির্বাচন করুন</option>
                                <option>পুরুষ</option>
                                <option>মহিলা</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="labelColor">সন্তানের নাম</label>
                            <input type="text" class="form-control" v-model="form.childs_name" required>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="labelColor">সন্তান জন্মদানের স্থান</label>
                            <input type="text" class="form-control" v-model="form.place_of_childbirth" required>
                        </div>
                    </div>


                </div>
                <div style="text-align:center">
                    <b-button type="submit" variant="primary">অনুমোদন করুন</b-button>
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
            waitForPayment: false,
            submitLoad: false,
            sameStatus: '',
            sonodnamedata: {},
            SonodNamesOptions: {},
            form: {},

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



        async onSubmit() {

            var res = await this.callApi('post', '/api/sonod/update', this.form);
            Notification.customSuccess(`Your data has been Updated`);
            this.$router.push({ name: 'applicationlist',params:{type:'applied'} })


        },

        async getdata(id) {
            var res = await this.callApi('get', `/api/sonod/single/${id}?admin=true`, []);
            this.form = res.data.sonod


        }
    },
    mounted() {
        this.getdata(this.$route.params.id)
        this.address();
    }
};
</script>
<style scoped >
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
</style>
