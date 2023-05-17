<template>
<div>
 <loader v-if="preLooding" object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#343a40" objectbg="#999793" opacity="80" name="circular"></loader>

<div class="breadcrumbs-area">
    <h3>প্রোফাইল</h3>
    <ul>
        <li>
            <router-link :to="{name:'Dashboard'}">ড্যাশবোর্ড</router-link>
        </li>
        <li>প্রোফাইল</li>
    </ul>
</div>

   <form class="row" @submit.stop.prevent="onSubmit">


        <div class="form-group col-md-6">
          <label for="">নাম</label>
          <input type="text" v-model="form.name" class="form-control" placeholder="" aria-describedby="helpId">
        </div>


        <div class="form-group col-md-6">
          <label for="">পদবি</label>

          <select v-model="form.position" class="form-control" disabled readonly>
            <option value="">নির্বাচন করুন</option>
            <option value="admin">এডমিন</option>
            <option value="sub_admin">সাব-এডমিন</option>
          </select>

        </div>



        <div class="form-group col-md-6">
          <label for="">মোবাইল নাম্বার</label>
          <input type="text" v-model="form.phone" class="form-control" placeholder="" aria-describedby="helpId">
        </div>

        <div class="form-group col-md-6">
          <label for="">ইমেইল</label>
          <input type="text" v-model="form.email" class="form-control" placeholder="" aria-describedby="helpId">
        </div>


        <div class="form-group col-md-6">
            <div class="form-group">
                <label for="">সাক্ষর</label>
                <input type="file" id="hand_map" class="form-control" @change="FileSelected($event, 'signature')">
            </div>
        </div>




        <div class="col-md-12">
      <div class="form-check">
            <input type="checkbox" id="checkboxid" v-model="changepass"  class="form-check-input">
            <label for="checkboxid" class="form-check-label">পাসওয়ার্ড পরিবর্তন করতে চাই</label>
        </div>

        </div>



        <div class="form-group col-md-6" v-if="changepass">
          <label for="">পুরাতন পাসওয়ার্ড</label>
          <input type="text" v-model="oldpassword" class="form-control" placeholder="" aria-describedby="helpId">
        </div>


        <div class="form-group col-md-6" v-if="changepass">
          <label for=""> নতুন পাসওয়ার্ড</label>
          <input type="text" v-model="newpassword" class="form-control" placeholder="" aria-describedby="helpId">
        </div>


        <div class="col-md-12">
    <button class="btn btn-info" type="submit">Submit</button>
</div>
    </form>


</div>


</template>



<script>
import axios from 'axios';
export default {
    created() {

    },
    data() {
        return {
             preLooding:true,
             changepass:false,
             oldpassword:'',
             newpassword:'',
              form:{
                name:null,
                email:null,
                phone:null,
                password:null,
                position:null,
                signature:null,
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



     async getsonodById(){
        //    var id =  this.Users.id;
        //     var res = await this.callApi('get', `/api/update/users/${id}`, []);
            this.form = this.Users;
            this.preLooding = false
        },


        async onSubmit() {
            this.preLooding = true

            this.form['changepass'] = this.changepass
            this.form['oldpassword'] = this.oldpassword
            this.form['newpassword'] = this.newpassword
            var res = await this.callApi('post', '/api/update/users', this.form);
            if(res.data==0){
                //old password does not match
                  Notification.customError('সঠিক পুরাতন পাসওয়ার্ড প্রদান করুন');

            }else if(res.data==2){
                //naew and old password does not match
                  Notification.customError('পুরাতন পাসওয়ার্ড এবং নতুন পাসওয়ার্ড মিলে নি');
            }else{
                // all ok
                  Notification.customSuccess('User Update Success');
                  this.getsonodById();
                  this.changepass = false
                  this.oldpassword = '';
                  this.newpassword = '';
            }
            //  this.$router.push({ name: 'userlist'})

            this.preLooding = false

        }
    },
    mounted() {
        setTimeout(()=>{
        this.getsonodById();
         }, 2000);
    }
}
</script>
