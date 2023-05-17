<template>
    <div>

        <form @submit.stop.prevent="finalSubmit">
            <div class="panel-heading"
                style="font-weight: bold; font-size: 20px;background:#159513;text-align:center;color:white">টিকা রেজিস্ট্রেশন </div>


            <div class="form-pannel">

                <div class="row">








                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="labelColor">শিশুর নাম<span
                                    class="text-danger"></span></label>
                            <input type="text" class="form-control" v-model="form.childs_name" required>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="labelColor">লিঙ্গ<span
                                    class="text-danger"></span></label>
                            <select class="form-control" v-model="form.gender" required>
                                <option value="">নির্বাচন করুন</option>
                                <option>পুরুষ</option>
                                <option>মহিলা</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="labelColor">জন্ম তারিখ <span
                                    class="text-danger"></span></label>
                            <input type="date" class="form-control" v-model="form.date_of_birth" required>
                        </div>
                    </div>



                    <div class="col-md-2">
                    <div class="form-group">
                        <label for="" class="labelColor">কত তম সন্তান </label>

                        <select class="form-control"  v-model="form.how_many_children" required>
                            <option value="">নির্বাচন করুন</option>
                            <option value="1">১</option>
                            <option value="2">২</option>
                            <option value="3">৩</option>
                            <option value="4">৪</option>
                            <option value="5">৫</option>
                            <option value="6">৬</option>
                            <option value="7">৭</option>
                            <option value="8">৮</option>
                            <option value="9">৯</option>
                            <option value="10">১০</option>
                        </select>




                    </div>
                </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="labelColor">মাতার নাম<span
                                    class="text-danger"></span></label>
                            <input type="text" class="form-control" v-model="form.name" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="labelColor">মাতার জাতীয় পরিচয়পত্র<span
                                    class="text-danger"></span></label>
                            <input type="text" class="form-control" v-model="form.pregnant_woman_nid" required>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="labelColor">পিতার নাম<span class="text-danger"></span></label>
                            <input type="text" class="form-control" v-model="form.husband_name" required>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="labelColor">পিতার জাতীয় পরিচয়পত্র<span class="text-danger"></span></label>
                            <input type="text" class="form-control" v-model="form.husband_name_nid" required>
                        </div>
                    </div>

                </div>










                <div class="row">
                    <div class="col-md-6">
                        <div class="app-heading">বর্তমান ঠিকানা</div>
                        <div class="col-md-12">
                        </div>



                        <div class="form-group" style="    margin-top: 66px !important;">
                            <label for="" class="labelColor">বিভাগ</label>

                            <select class='form-control' name="division" id="division" v-model="Pdivision" @change="getdistrictFun" >
                            <option value="">বিভাগ নির্বাচন করুন</option>
                                <option v-for="div in getdivisions" :key="div.id" :value="div.id">{{ div.bn_name }}</option>
                        </select>

                            <!-- <input type="text" class="form-control" v-model="form.applicant_present_district"> -->
                        </div>

                        <div class="form-group">
                            <label for="" class="labelColor">জেলা</label>

                        <select   class='form-control' name="district" id="district" v-model="applicant_present_district" @change="getthanaFun" >
                            <option value="">জেলা নির্বাচন করুন</option>
                            <option v-for="dist in getdistricts" :key="dist.id" :value="dist.id">{{ dist.bn_name }}</option>
                        </select>

                            <!-- <input type="text" class="form-control" v-model="form.applicant_present_district"> -->
                        </div>
                        <div class="form-group">
                            <label for="" class="labelColor">উপজেলা/থানা</label>

                        <select  class='form-control' name="thana" id="thana" v-model="applicant_present_thana" @change="getuniounFun" >
                            <option value="">উপজেলা নির্বাচন করুন</option>
                            <option v-for="thana in getthanas" :key="thana.id" :value="thana.id">{{ thana.bn_name }}</option>
                        </select>
                    </div>

                        <div class="form-group">
                            <label for="" class="labelColor">ইউনিয়ন</label>
                            <select  class='form-control' name="union" id="union" v-model="form.union" @change="getuniounFunPer" >
                                <option value="">ইউনিয়ন নির্বাচন করুন</option>
                                <option v-for="uion in getuniouns" :key="uion.id" :value="uion.bn_name">{{ uion.bn_name }}</option>
                            </select>
                            <!-- <input type="text" class="form-control" v-model="form.union"> -->

                        </div>
                        <div class="form-group">
                            <label for="" class="labelColor">পোষ্ট অফিস</label>
                            <input type="text" class="form-control" v-model="form.post_office">
                        </div>
                        <div class="form-group">
                            <label for="" class="labelColor">ওয়ার্ড নং</label>
                            <select v-model="form.word_number" id="word_no" class="form-control" required>
                                                <option value="">ওয়াড নং</option>
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
                            <!-- <input type="text" class="form-control" v-model="form.applicant_present_word_number"> -->
                        </div>
                        <div class="form-group">
                            <label for="" class="labelColor">গ্রাম/মহল্লা</label>
                            <input type="text" class="form-control" v-model="form.village">
                        </div>
                        <!-- <div class="form-group">
                            <label for="" class="labelColor">রোড/ব্লক/সেক্টর</label>
                            <input type="text" class="form-control" v-model="form.applicant_present_road_block_sector">
                        </div> -->


                    </div>
                    <div class="col-md-6">
                        <div class="app-heading">স্থায়ী ঠিকানা</div>
                        <div class="col-md-12">
                            <input type="checkbox" id="checkbox" v-model="sameStatus" @change="sameAddress"> <label
                                for="checkbox"> বর্তমান ঠিকানা ও স্থায়ী ঠিকানা একই হলে</label>
                        </div>


                        <div class="form-group">
                            <label for="" class="labelColor">বিভাগ</label>

                            <select class='form-control' name="division" id="division" v-model="Perdivision" @change="getdistrictFunPer" >
                            <option value="">বিভাগ নির্বাচন করুন</option>
                                <option v-for="div in getdivisionsPer" :key="div.id" :value="div.id">{{ div.bn_name }}</option>
                        </select>

                            <!-- <input type="text" class="form-control" v-model="form.applicant_present_district"> -->
                        </div>



                        <div class="form-group">
                            <label for="" class="labelColor">জেলা</label>

                            <select   class='form-control' name="district" id="district" v-model="applicant_permanent_district" @change="getthanaFunPer" >
                            <option value="">জেলা নির্বাচন করুন</option>
                            <option v-for="dist in getdistrictsPer" :key="dist.id" :value="dist.id">{{ dist.bn_name }}</option>
                        </select>

                            <!-- <input type="text" class="form-control" v-model="form.applicant_permanent_district"> -->
                        </div>


                        <div class="form-group">
                            <label for="" class="labelColor">উপজেলা/থানা</label>
                            <select  class='form-control' name="thana" id="thana" v-model="applicant_permanent_thana" @change="getuniounFunPer" >
                                <option value="">উপজেলা নির্বাচন করুন</option>
                                <option v-for="thana in getthanasPer" :key="thana.id" :value="thana.id">{{ thana.bn_name }}</option>
                            </select>
                            <!-- <input type="text" class="form-control" v-model="form.applicant_permanent_Upazila"> -->
                        </div>

                        <div class="form-group">
                            <label for="" class="labelColor">ইউনিয়ন</label>
                            <select  class='form-control' name="union" id="union" v-model="form.applicant_permanent_union" @change="getuniounFunPer" >
                                <option value="">ইউনিয়ন নির্বাচন করুন</option>
                                <option v-for="union in getuniounsPer" :key="union.id" :value="union.bn_name">{{ union.bn_name }}</option>
                            </select>
                            <!-- <input type="text" class="form-control" v-model="form.applicant_permanent_Upazila"> -->
                        </div>



                        <div class="form-group">
                            <label for="" class="labelColor">পোষ্ট অফিস</label>
                            <input type="text" class="form-control" v-model="form.applicant_permanent_post_office">
                        </div>

                        <div class="form-group">
                            <label for="" class="labelColor">ওয়ার্ড নং</label>
                            <select v-model="form.applicant_permanent_word_number" id="word_no" class="form-control" required>
                                                <option value="">ওয়াড নং</option>
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
                            <!-- <input type="text" class="form-control" v-model="form.applicant_permanent_word_number"> -->
                        </div>

                        <div class="form-group">
                            <label for="" class="labelColor">গ্রাম/মহল্লা</label>
                            <input type="text" class="form-control" v-model="form.applicant_permanent_village">
                        </div>
                        <!-- <div class="form-group">
                            <label for="" class="labelColor">রোড/ব্লক/সেক্টর</label>
                            <input type="text" class="form-control"
                                v-model="form.applicant_permanent_road_block_sector">
                        </div> -->

                    </div>
                </div>




<hr>




<div class="row">




                <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="labelColor">শিশুর জন্ম নিবন্ধন নং<span class="text-danger"></span></label>
                            <input type="text" class="form-control" v-model="form.childBirthNo" >
                        </div>
                    </div>



                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="labelColor">মোবাইল নম্বর</label>
                            <input type="text" class="form-control" v-model="form.mobile_no" required>
                        </div>
                    </div>

<!--
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="" class="labelColor">টিকা কেন্দ্রের নাম </label>
                        <input type="text" class="form-control" v-model="form.how_many_children" required>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="" class="labelColor">স্বাস্থ্য সহকারী/টিকাদান কর্মীর নাম </label>
                        <input type="text" class="form-control" v-model="form.how_many_children" required>
                    </div>
                </div> -->




                </div>
















                <div style="text-align:center">
                    <button type="submit" class="btn btn-primary">সাবমিট</button>
                </div>
                <!-- <b-button class="ml-2" @click="resetForm()">রিসেট</b-button> -->
            </div>
        </form>
        <!-- Info modal -->

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
            submitLoad: false,
            form: {
                id_no:'',
                name:'',
                pregnant_woman_nid:'',
                husband_name:'',
                husband_name_nid:'',
                mobile_no:'',
                division:'',
                district:'',
                upazila:'',
                union:'',
                post_office:'',
                word_number:'',
                village:'',
                divisionPer:'',
                applicant_permanent_district:'',
                applicant_permanent_Upazila:'',
                applicant_permanent_union:'',
                applicant_permanent_post_office:'',
                applicant_permanent_village:'',
                applicant_permanent_word_number:'',




                date_of_last_menstrual_period:'',
                probable_date_of_delivery:'',
                how_many_wombs:'',
                how_many_children:'',

            },

            sameStatus: '',



            getdivisions:{},
            getdistricts:{},
            getthanas:{},
            getuniouns:{},

            getdivisionsPer:{},
            getdistrictsPer:{},
            getthanasPer:{},
            getuniounsPer:{},
            Pdivision:'',
            Perdivision:'',
            applicant_present_district:'',
            applicant_permanent_district:'',
            applicant_present_thana:'',
            applicant_permanent_thana:'',
        };
    },


    methods: {


        getProbableDate(){
            var day = new Date(this.form.date_of_last_menstrual_period);
            var nextDay = new Date(day);
            nextDay.setDate(day.getDate() + 280);
            this.form.probable_date_of_delivery = this.dateformatGlobal(nextDay)[0]
        },

        sameAddress() {
            // console.log(value)
            if (this.sameStatus) {

                this.getdivisionFunPer();
                this.Perdivision = this.Pdivision
                this.getdistrictFunPer();
                this.applicant_permanent_district = this.applicant_present_district
                this.getthanaFunPer();
                this.applicant_permanent_thana = this.applicant_present_thana
                this.getuniounFunPer();

                this.form.applicant_permanent_union = this.form.union


                this.form.applicant_permanent_village = this.form.village
                this.form.applicant_permanent_road_block_sector = this.form.applicant_present_road_block_sector
                this.form.applicant_permanent_word_number = this.form.word_number

                this.form.applicant_permanent_post_office = this.form.post_office




            } else {

                this.Perdivision = '';
                this.applicant_permanent_district = '';
                this.applicant_permanent_thana = '';
                this.form.applicant_permanent_union = '';


                this.form.applicant_permanent_village = null
                this.form.applicant_permanent_road_block_sector = null
                this.form.applicant_permanent_word_number = null
                this.form.applicant_permanent_district = null
                this.form.applicant_permanent_Upazila = null
                this.form.applicant_permanent_post_office = null
            }
        },


        async getdivisionFun(){
         var res = await this.callApi('get',`/api/getdivisions`,[]);
         this.getdivisions = res.data;
        },

        async getdistrictFun(){

            var resdiv = await this.callApi('get', `/api/getdivisions?id=${this.Pdivision}`, []);
            // console.log(resdiv)
            this.form.division= resdiv.data.bn_name

        var res = await this.callApi('get',`/api/getdistrict?id=${this.Pdivision}`,[]);
        this.getdistricts = res.data;





        },

        async getthanaFun(){
        var res = await this.callApi('get',`/api/getthana?id=${this.applicant_present_district}`,[]);
        this.getthanas = res.data;
        var resOwn = await this.callApi('get',`/api/getdistrict?ownid=${this.applicant_present_district}`,[]);
        this.form.district = resOwn.data.bn_name

        },

        async getuniounFun(){
            var ress = await this.callApi('get', `/api/getthana?ownid=${this.applicant_present_thana}`, []);
            // console.log(ress.data.bn_name);
            this.form.upazila = ress.data.bn_name;
            // this.getuniouns = ress.data;


        var res = await this.callApi('get',`/api/getunioun?id=${this.applicant_present_thana}`,[]);
        this.getuniouns = res.data;
        },




        //////////////////////////////////

        async getdivisionFunPer(){
         var res = await this.callApi('get',`/api/getdivisions`,[]);
         this.getdivisionsPer = res.data;
        },

        async getdistrictFunPer(){
            var resdiv = await this.callApi('get', `/api/getdivisions?id=${this.Perdivision}`, []);
            // console.log(resdiv)
            this.form.divisionPer= resdiv.data.bn_name


        var res = await this.callApi('get',`/api/getdistrict?id=${this.Perdivision}`,[]);
        this.getdistrictsPer = res.data;



        },

        async getthanaFunPer(){
            // console.log(this.applicant_permanent_district)
        var res = await this.callApi('get',`/api/getthana?id=${this.applicant_permanent_district}`,[]);
        this.getthanasPer = res.data;
        var resOwn = await this.callApi('get',`/api/getdistrict?ownid=${this.applicant_permanent_district}`,[]);
        this.form.applicant_permanent_district = resOwn.data.bn_name

        },

        async getuniounFunPer(){

            var resw = await this.callApi('get',`/api/getthana?ownid=${this.applicant_permanent_thana}`,[]);
        this.form.applicant_permanent_Upazila = resw.data.bn_name;

        var res = await this.callApi('get',`/api/getunioun?id=${this.applicant_permanent_thana}`,[]);
        this.getuniounsPer = res.data;
        },




        async finalSubmit() {
            this.submitLoad = true;

            var payment_type = this.getunionInfos.payment_type;
            this.form['status'] = 'approved';

            var res = await this.callApi('post', '/api/sonod/submit?applicationT=tika', this.form);
            var datas = res.data;

                Swal.fire({
                    title: 'অভিনন্দন',
                    text: `আপনার টিকা রেজিস্ট্রেশন সফলভাবে দাখিল হয়েছে`,
                    icon: 'success',
                    confirmButtonColor: 'green',
                    confirmButtonText: `Ok`,

                }).then(async (result) => {
                    console.log(result)
                    if (result.isConfirmed) {
                        // this.$root.$emit('bv::hide::modal', 'info-modal')
                        this.$router.push({ name: 'home' })
                    } else if (result.isDenied) {
                        // this.$root.$emit('bv::hide::modal', 'info-modal')
                    } else if (result.isDismissed) {
                        //cancel
                        this.$router.push({ name: 'home' })
                    }
                })
        },
    },
    mounted() {
        this.getdivisionFun();
        this.getdivisionFunPer();

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
