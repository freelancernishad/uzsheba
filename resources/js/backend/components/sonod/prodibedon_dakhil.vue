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



                <div class="col-md-12">
                <div class="form-group">
                   <label for="">যে স্থানে নলকূপ স্থাপন করা হবে সেই স্থানের পানিধারক স্তরের অবস্থা</label>
                   <textarea name="save_water_Condition"  v-model="form.save_water_Condition" id="save_water_Condition" cols="30" rows="3" style="resize:none" class="form-control"></textarea>
                 </div>
                </div>


                <div class="col-md-12">
                <div class="form-group">
                   <label for="">নলকূপ দ্বারা উপকৃত হবে এইরূপ সম্ভাব্য এলাকা</label>
                   <textarea name="helpfull_area"  v-model="form.helpfull_area" id="helpfull_area" cols="30" rows="3" style="resize:none" class="form-control"></textarea>
                 </div>
                </div>



                <div class="col-md-12">
                <div class="form-group">
                   <label for="">গৃহস্থালীর উদ্দেশ্যে ব্যবহৃত নলকূপসহ অন্যান্য নলকূপের উপর সম্ভাব্য প্রভাব</label>
                   <textarea name="home_and_other_benefite"  v-model="form.home_and_other_benefite" id="home_and_other_benefite" cols="30" rows="3" style="resize:none" class="form-control"></textarea>
                 </div>
                </div>


                <div class="col-md-12">
                <div class="form-group">
                   <label for="">নলকূপ স্থাপনের জন্য খনন স্থানের উপযুক্ততা</label>
                   <textarea name="right_area"  v-model="form.right_area" id="right_area" cols="30" rows="3" style="resize:none" class="form-control"></textarea>
                 </div>
                </div>


                <div class="col-md-12">
                <div class="form-group">
                   <label for="">দুইটি নলকূপের পারস্পরিক দূরত্ব  (সর্বনিম্ন ০.৫০ কিউসেক ক্যাপাসিটির ২৫০ মিটার)</label>
                   <textarea name="distanceTo"  v-model="form.distanceTo" id="distanceTo" cols="30" rows="3" style="resize:none" class="form-control"></textarea>
                 </div>
                </div>

                <div class="col-md-12">
                <div class="form-group">
                   <label for="">নিকটবর্তী অন্যান্য নলকূপ এবং বৈদ্যুতিক সংযোগের দূরত্ব (হাত নকশা) </label>
                  <input type="file" class="form-control" id="hand_map" @change="FileSelected($event, 'hand_map')">


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
