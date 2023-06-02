<template>
    <div>

<div class="breadcrumbs-area">
    <h3>Sonod List</h3>
    <ul>
        <li>
            <router-link :to="{name:'Dashboard'}">Home</router-link>
        </li>
        <li>Sonod List</li>
    </ul>
</div>

    <form class="row" @submit.stop.prevent="onSubmit">


        <div class="form-group col-md-6">
          <label for="">নাম</label>
          <input type="text" v-model="form.name" class="form-control" placeholder="" aria-describedby="helpId">
        </div>


        <div class="form-group col-md-6">
          <label for="">পদবি</label>

          <select v-model="form.position" class="form-control">
            <option value="">নির্বাচন করুন</option>
            <option value="admin">এডমিন</option>
            <option value="uno">উপজেলা নির্বাহী অফিসার</option>
            <option value="chairman">উপজেলা চেয়ারম্যান</option>
            <option value="sub_admin">উপজেলা ইঞ্জিনিয়ার</option>

          </select>

        </div>


        <div class="form-group col-md-6">
          <label for="">উপাধি</label>
          <input type="text" v-model="form.designation" class="form-control" placeholder="" aria-describedby="helpId">
        </div>




        <div class="form-group col-md-6">
          <label for="">উপজেলা</label>
          <select v-model="form.upozila" class="form-control" >
            <option value="">নির্বাচন করুন</option>
            <option value="পঞ্চগড় সদর">পঞ্চগড় সদর</option>
            <option value="দেবীগঞ্জ">দেবীগঞ্জ</option>
            <option value="বোদা">বোদা</option>
            <option value="আটোয়ারী">আটোয়ারী</option>
            <option value="তেঁতুলিয়া">তেঁতুলিয়া</option>
          </select>

        </div>


        <div class="form-group col-md-6">
          <label for="">ইমেইল</label>
          <input type="text" v-model="form.email" class="form-control" placeholder="" aria-describedby="helpId">
        </div>


        <div class="form-group col-md-6" v-if="!this.$route.params.id">
          <label for="">পাসওয়ার্ড</label>
          <input type="text" v-model="form.password" class="form-control" placeholder="" aria-describedby="helpId">
        </div>



        <div class="form-group col-md-6">
          <label for="">মোবাইল নাম্বার</label>
          <input type="text" v-model="form.phone" class="form-control" placeholder="" aria-describedby="helpId">
        </div>




        <div class="form-group col-md-6">

            <div class="form-group">
                <label for="">সাক্ষর</label>
                 <input type="file" id="hand_map" class="form-control" @change="FileSelected($event, 'signature')">
                </div>
        </div>


        <div class="col-md-12">
    <button class="btn btn-info" type="submit">Submit</button>
</div>
    </form>


    </div>
</template>

<script>

import Checkbox from "./Checkbox.vue";

export default {

    components: {
    Checkbox,
  },

    data(){
        return {
            selectedOptions: [],
            options: {
                1:{word:'1',name:'১নং ওয়ার্ড'},
                2:{word:'2',name:'২নং ওয়ার্ড'},
                3:{word:'3',name:'৩নং ওয়ার্ড'},
                4:{word:'4',name:'৪নং ওয়ার্ড'},
                5:{word:'5',name:'৫নং ওয়ার্ড'},
                6:{word:'6',name:'৬নং ওয়ার্ড'},
                7:{word:'7',name:'৭নং ওয়ার্ড'},
                8:{word:'8',name:'৮নং ওয়ার্ড'},
                9:{word:'9',name:'৯নং ওয়ার্ড'},
            },
            form:{
                id:null,


                name:'Admin',
                designation:'',
                email:null,
                phone:'01909756552',
                password:'123456',
                position:'admin',
                signature:'',

            },
            unions:{},
        }
    },
    methods:{



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



        async getsonodById(){
           var id =  this.$route.params.id;
            var res = await this.callApi('get', `/api/update/users/${id}`, []);
            this.form = res.data;
        },


        async onSubmit() {

            var res = await this.callApi('post', '/api/update/users', this.form);
             this.$router.push({ name: 'userlist'})
            Notification.customSuccess('User Update Success');

        },



    },
    mounted(){
        if(this.$route.params.id){

            this.getsonodById();
        }



    }
}
</script>



