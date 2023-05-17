<template>

<form @submit.stop.prevent="finalSubmit">





            <div class="row">



                <div class="col-md-6">
                <div class="form-group">
                   <label for="">আবেদনকারীর নাম</label>
                   <input type="text" name="appicant_name" id="appicant_name" v-model="form.appicant_name" class="form-control" placeholder="" aria-describedby="helpId">
                 </div>
                </div>


                <div class="col-md-6">
                <div class="form-group">
                   <label for="">পিতার নাম</label>
                   <input type="text" name="applicant_father_name" id="applicant_father_name" v-model="form.applicant_father_name" class="form-control" placeholder="" aria-describedby="helpId">
                 </div>
                </div>



                <div class="col-md-6">
                <div class="form-group">
                   <label for="">গ্রাম</label>
                   <input type="text" name="village" id="village" class="form-control" v-model="form.village" placeholder="" aria-describedby="helpId">
                 </div>
                </div>



                <div class="col-md-6">
                <div class="form-group">
                   <label for="">ইউনিয়ন</label>
                   <input type="text" name="union" id="union" class="form-control" v-model="form.union" placeholder="" aria-describedby="helpId">
                 </div>
                </div>





                <div class="col-md-6">
                <div class="form-group">
                   <label for="">মৌজা</label>
                   <input type="text" name="mouja_name" id="mouja_name" class="form-control" v-model="form.mouja_name" placeholder="" aria-describedby="helpId">
                 </div>
                </div>



                <div class="col-md-6">
                <div class="form-group">
                   <label for="">জে.এল.নং</label>
                   <input type="text" name="JL_No" id="JL_No" class="form-control" v-model="form.JL_No" placeholder="" aria-describedby="helpId">
                 </div>
                </div>


                <div class="col-md-6">
                <div class="form-group">
                   <label for="">খতিয়ান নং</label>
                   <input type="text" name="khotiyan_no" id="khotiyan_no" v-model="form.khotiyan_no" class="form-control" placeholder="" aria-describedby="helpId">
                 </div>
                </div>


                <div class="col-md-6">
                <div class="form-group">
                   <label for=""> দাগ নং</label>
                   <input type="text" name="dag_NO" id="dag_NO" v-model="form.dag_NO" class="form-control" placeholder="" aria-describedby="helpId">
                 </div>
                </div>



                <div class="col-md-6">
                <div class="form-group">
                   <label for=""> জমির পরিমাণ</label>
                   <input type="text" name="dag_NO" id="dag_NO" v-model="form.land_length" class="form-control" placeholder="" aria-describedby="helpId">
                 </div>
                </div>



                <div class="col-md-6">
                <div class="form-group">
                   <label for="">ইমারত/স্থাপনার আয়তন</label>
                   <input type="text" name="dag_NO" id="dag_NO" v-model="form.ayoton" class="form-control" placeholder="" aria-describedby="helpId">
                 </div>
                </div>


                <div class="col-md-6">
                <div class="form-group">
                   <label for=""> প্রাস্তাবিত স্থানের জমির মালিকানা সংক্রান্ত কাগজপত্রাদি সঠিক রয়েছে কি, না?</label>
                   <select v-model="form.paperTrueOrNot" class="form-control" >
                        <option value="">নির্বাচন করুন</option>
                        <option>সঠিক</option>
                        <option>ভুল</option>
                    </select>
                 </div>
                </div>


                <div class="col-md-6">
                <div class="form-group">
                   <label for=""> BNBC এর কোড ও ইমারত নির্মাণ বিধিমালা অনুযায়ী নকশা প্রস্তুত করা হয়েছে কি না?</label>
                   <select v-model="form.mapBNNCCode" class="form-control" >
                        <option value="">নির্বাচন করুন</option>
                        <option>সঠিক</option>
                        <option>ভুল</option>
                    </select>
                 </div>
                </div>


                <div class="col-md-6">
                <div class="form-group">
                   <label for=""> সুপারভিশন ইঞ্জিনিয়ার নিয়োগ করা হয়েছে কি না?</label>
                   <select v-model="form.Supervision_Engineer" class="form-control" >
                        <option value="">নির্বাচন করুন</option>
                        <option>নিয়োগ করা হয়েছে</option>
                        <option>নিয়োগ করা হয়নি</option>
                    </select>

                 </div>
                </div>



                <div class="col-md-6">
                <div class="form-group">
                   <label for=""> প্রস্তাবিত জায়গায় ভবন/স্থাপনা নির্মাণ করা হলে  পরিবেশগত কোন ক্ষতির সম্ভাবনা রয়েছে কি না?</label>
                   <select v-model="form.paperTrueOrNot" class="form-control" >
                        <option value="">নির্বাচন করুন</option>
                        <option>সম্ভাবনা আছে</option>
                        <option>সম্ভাবনা নাই</option>
                    </select>
                   </div>
                </div>






                <div class="col-md-12">
                <div class="form-group">
                   <label for="">তদন্তকারীর মন্তব্য</label>
                   <textarea name="helpfull_area"  v-model="form.note" id="helpfull_area" cols="30" rows="3" style="resize:none" class="form-control"></textarea>
                 </div>
                </div>




                <div class="col-md-12">
                <div class="form-group">

                  <input type="submit" class="btn btn-info" style="background: green !important;font-size: 25px;" value="দাখিল করুন">

                 </div>
                </div>




            </div>



    </form>

</template>



<script>
export default {
    props: {
        ApproveData: {
            type: String,
            default: 'sec_approved'
        },
        SonodId: {
            type: String,
            default: '0'
        },
        'Details': {
            type: Object,
            default: {}
        },
    },

    created() {
        this.form = this.Details;
        this.form.license_id = this.Details.id;
    },
    data() {
        return {
            form:{
                save_water_Condition:'',
                helpfull_area:'',
                home_and_other_benefite:'',
                right_area:'',
                distanceTo:'',
                hand_map:'',
                land_length:'',
                ayoton:'',
                paperTrueOrNot:'',
                mapBNNCCode:'',
                Supervision_Engineer:'',
                posibleFalse:'',
                note:'',
            }
        }
    },
    methods: {

    FileSelected($event, parent_index) {
            let file = $event.target.files[0];
            if (file.size > 5048576) {
                Notification.image_validation();
            } else {
                let reader = new FileReader;
                reader.onload = event => {
                    this.form[parent_index] = event.target.result
                    // console.log(event.target.result);
                };
                reader.readAsDataURL(file)
            }
            //   console.log($event.target.result);
        },

        async finalSubmit(){

            this.form['reporter_name'] = this.getUsers.name
            this.form['reporter_signature'] = this.getUsers.signature
            this.form['reporter_id'] = this.getUsers.id


            var res = await this.callApi('post',`/api/application/approve/submit`,this.form);
            console.log(res)
            this.$root.$emit('bv::hide::modal', 'dakhil-modal')
            this.$emit('event-name')
        },



    },



}
</script>
