<template>
    <div>
 <loader v-if="preLooding" object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#343a40" objectbg="#999793" opacity="80" name="circular"></loader>

<div class="breadcrumbs-area">
    <h3>Tenders List</h3>
    <ul>
        <li>
            <router-link :to="{name:'Dashboard'}">Home</router-link>
        </li>
        <li>Tenders List</li>
    </ul>
</div>




        <div class="card">
            <div class="card-header">
                <router-link :to="{ name: 'tenderlistadd' }" class="btn btn-info" v-if="this.$route.params.name=='pending'">বিজ্ঞপ্তি তৈরি করুন</router-link>
            </div>
        <div class="card-body">


            <table class="table">
            <thead>






                <tr>
                    <th>বিজ্ঞপ্তি নম্বর</th>
                    <th>সংক্ষিপ্ত শিরোনাম</th>
                    <th>বিজ্ঞপ্তি প্রকাশের তারিখ</th>
                    <th>স্মারক নম্বর</th>
                    <th>শেষ তারিখ</th>
                    <th>Action</th>
                </tr>




            </thead>

            <tbody>
                <tr v-for="(item,index) in filteredItems" :key="''+item.id">
                    <td></td>
                    <td>{{ item.tender_name }}</td>
                    <td>{{ item.noticeDate }}</td>
                    <td>{{ item.memorial_no }}</td>
                    <td>{{ item.tender_end }}</td>
                    <td>

                        <!-- <a size="sm" target="_blank" :href="'/tenders/'+ item.tender_id" class="btn btn-danger mr-1 mt-1" v-if="item.status!='Completed'">সিডিউল ফর্ম</a> -->




                        <span size="sm" @click="tenderComitti(item.id)" class="btn btn-success mr-1 mt-1" v-if="!item.commette1phone && !item.commette5phone">মূল্যায়ন কমিটি তৈরি করুন</span>


                        <!-- <span size="sm" @click="tenderComittiVeiw(item)" class="btn btn-success mr-1 mt-1" v-else>মূল্যায়ন কমিটি দেখুন</span> -->




                        <!-- <a size="sm" :href="'/pdf/sder/download/'+item.id" target="_blank" class="btn btn-success mr-1 mt-1" v-if="item.isOpen && item.status=='proccesing'">ওপেনিং সীট</a>  -->


                        <span size="sm" @click="tendeSelection(item)" class="btn btn-success mr-1 mt-1" v-if="item.isOpen && item.status=='proccesing'">দরপত্র ওপেন করুন</span>


                         <!-- <span size="sm" @click="tendeSelection(item,'select')" class="btn btn-success mr-1 mt-1" v-if="item.isOpen && item.status=='proccesing'">মূল্যায়ন</span> -->


                        <span size="sm" class="btn btn-danger mr-1 mt-1" v-else-if="!item.isOpen && item.status=='proccesing'"   > মূল্যায়ন করার জন্য অপেক্ষা করুন</span>




                        <router-link size="sm" :to="{name:'tendersubmitlist',params:{tender_id:item.id}}" class="btn btn-success mr-1 mt-1" v-if="item.status=='Completed'">তালিকা</router-link>


                        <router-link size="sm" :to="{name:'tenderResulation',params:{id:item.id}}" class="btn btn-warning mr-1 mt-1" v-if="item.status=='Completed' && !item.resolutions">রেজোলিউশন প্রদান</router-link>

                        <a size="sm" target="_blank" :href="'/dashboard/pdf/tenders/resulation/'+item.tender_id" class="btn btn-warning mr-1 mt-1" v-if="item.status=='Completed' && item.resolutions" >রেজোলিউশন ডাউনলোড  </a>

                        <router-link size="sm" :to="{name:'tenderworkorder',params:{id:item.id}}" class="btn btn-warning mr-1 mt-1" v-if="item.status=='Completed' && !item.tender_work_orders">কার্যাদেশ প্রদান</router-link>


                        <a size="sm" target="_blank" :href="'/dashboard/pdf/tenders/work/access/'+item.tender_id" class="btn btn-warning mr-1 mt-1" v-if="item.status=='Completed' && item.tender_work_orders" >কার্যাদেশ ডাউনলোড  </a>

                        <!-- <router-link size="sm" :to="{ name: 'tendersubmitlist', params: { tender_id: item.id } }" class="btn btn-success mr-1 mt-1">Submited Tender</router-link> -->
                        <router-link size="sm" :to="{ name: 'tenderlistedit', params: { id: item.id } }" class="btn btn-info mr-1 mt-1" v-if="item.status=='pending'">Edit</router-link>
                    </td>

                </tr>
            </tbody>

         </table>



    </div>

            </div>
        </div>
</template>

<script>

export default {

    computed: {
    filteredItems() {
      const currentDateTime = new Date();

      return this.items.map(entry => {
        const tenderOpenTime = new Date(entry.tender_open);
        return {
          ...entry,
          isOpen: currentDateTime >= tenderOpenTime
        };
      });
    }
    },
    created() {


    },
    data() {
        return {
            currentDateTime: '',

            preLooding:true,

            access:'',
            sortstatus:false,
            Filter:true,
            addNew:'tenderlistadd',
            FilterOn:false,
            PerPage:false,
            deleteRoute:'/api/get/users/delete',
            editRoute:'tenderlistedit',
            applicationRoute:'',
            viewRoute:'',
            approveRoute:'',
            cancelRoute:'',
            approveType:'',
            approveData:'',
            payRoute:'',
            PerPageData:'10',
            TotalRows:'1',
            Type:'',
            items: [],
            fields: [
                { key: 'names', label: 'নাম', sortable: true },
                { key: 'unioun', label: 'ইউনিয়ন', sortable: true },
                { key: 'thana', label: 'উপজেলা', sortable: true },
                { key: 'district', label: 'জেলা', sortable: true },
                { key: 'position', label: 'পদবি', sortable: true },

                { key: 'actions', label: 'Actions' }
            ],


        }
    },
    // updated(){

    //  this.sonodList();

    // },

  watch: {
        '$route':  {
            handler(newValue, oldValue) {

                    this.sonodname();

            },
        deep: true
        }
    },

    methods: {


        tenderComittiVeiw(item){
            Swal.fire({
                        title:'মূল্যায়ন কমিটি',
                        html:`

                        <table width="100%" border="1" style="border-collapse: collapse;">
                            <tbody>
                                <tr>
                                    <td>ক্রমিক</td>
                                    <td>নাম</td>
                                    <td>পদবি</td>
                                    <td>মোবাইল</td>
                                </tr>

                                <tr>
                                    <td>১</td>
                                    <td>${item.committe1name}</td>
                                    <td>${item.committe1position}</td>
                                    <td>${item.commette1phone}</td>
                                </tr>

                                <tr>
                                    <td>২</td>
                                    <td>${item.committe2name}</td>
                                    <td>${item.committe2position}</td>
                                    <td>${item.commette2phone}</td>
                                </tr>

                                <tr>
                                    <td>৩</td>
                                    <td>${item.committe3name}</td>
                                    <td>${item.committe3position}</td>
                                    <td>${item.commette3phone}</td>
                                </tr>

                            </tbody>
                        </table>




                        `,


                    })
        },

        tenderComitti(id){
            Swal.fire({
            title: 'মূল্যায়ন কমিটি',
            width: '80%',
            html:

            `


            <table width="100%" border="1" style="border-collapse: collapse;">
                            <tbody>
                                <tr>
                                    <td style='padding:10px 16px'>নাম</td>
                                    <td style='padding:10px 16px'>পদবি</td>
                                    <td style='padding:10px 16px'>মোবাইল</td>
                                </tr>


                                <tr>
                                    <td style='padding:10px 16px'>
                                        <input style='border:1px solid red' type='text'  id="committe1name" class="swal2-input" autocomplete="off" required>
                                    </td>

                                    <td style='padding:10px 16px'>
                                        <input style='border:1px solid red' type='text' value='সভাপতি' readonly  id="committe1position" class="swal2-input" autocomplete="off" required>
                                    </td>

                                    <td style='padding:10px 16px'>
                                        <input style='border:1px solid red' type='text'  id="committe1" class="swal2-input" autocomplete="off" required>
                                    </td>
                                </tr>


                                <tr>
                                    <td style='padding:10px 16px'>
                                        <input style='border:1px solid red' type='text'  id="committe2name" class="swal2-input" autocomplete="off" required>
                                    </td>

                                    <td style='padding:10px 16px'>
                                        <input style='border:1px solid red' type='text'  value='সদস্য' readonly id="committe2position" class="swal2-input" autocomplete="off" required>
                                    </td>

                                    <td style='padding:10px 16px'>
                                        <input style='border:1px solid red' type='text'  id="committe2" class="swal2-input" autocomplete="off" required>
                                    </td>
                                </tr>



                                <tr>
                                    <td style='padding:10px 16px'>
                                        <input style='border:1px solid red' type='text'  id="committe3name" class="swal2-input" autocomplete="off" required>
                                    </td>

                                    <td style='padding:10px 16px'>
                                        <input style='border:1px solid red' type='text'  value='সদস্য' readonly  id="committe3position" class="swal2-input" autocomplete="off" required>
                                    </td>

                                    <td style='padding:10px 16px'>
                                        <input style='border:1px solid red' type='text'  id="committe3" class="swal2-input" autocomplete="off" required>
                                    </td>
                                </tr>


                                <tr>
                                    <td style='padding:10px 16px'>
                                        <input style='border:1px solid red' type='text'  id="committe4name" class="swal2-input" autocomplete="off" required>
                                    </td>

                                    <td style='padding:10px 16px'>
                                        <input style='border:1px solid red' type='text'  value='সদস্য' readonly  id="committe4position" class="swal2-input" autocomplete="off" required>
                                    </td>

                                    <td style='padding:10px 16px'>
                                        <input style='border:1px solid red' type='text'  id="committe4" class="swal2-input" autocomplete="off" required>
                                    </td>
                                </tr>


                                <tr>
                                    <td style='padding:10px 16px'>
                                        <input style='border:1px solid red' type='text'  id="committe5name" class="swal2-input" autocomplete="off" required>
                                    </td>

                                    <td style='padding:10px 16px'>
                                        <input style='border:1px solid red' type='text'  value='সদস্য সচিব' readonly  id="committe5position" class="swal2-input" autocomplete="off" required>
                                    </td>

                                    <td style='padding:10px 16px'>
                                        <input style='border:1px solid red' type='text'  id="committe5" class="swal2-input" autocomplete="off" required>
                                    </td>
                                </tr>




                            </tbody>
                        </table>



                `,
            focusConfirm: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
            preConfirm: async (resolve) => {

                var committe1 = document.getElementById('committe1').value
                var committe1name = document.getElementById('committe1name').value
                var committe1position = document.getElementById('committe1position').value

                var committe2 = document.getElementById('committe2').value
                var committe2name = document.getElementById('committe2name').value
                var committe2position = document.getElementById('committe2position').value

                var committe3 = document.getElementById('committe3').value
                var committe3name = document.getElementById('committe3name').value
                var committe3position = document.getElementById('committe3position').value

                var committe4 = document.getElementById('committe4').value
                var committe4name = document.getElementById('committe4name').value
                var committe4position = document.getElementById('committe4position').value

                var committe5 = document.getElementById('committe5').value
                var committe5name = document.getElementById('committe5name').value
                var committe5position = document.getElementById('committe5position').value



                if(committe1 && committe2 && committe3){
                    var formValues = {};

                    formValues['commette1phone'] = committe1;
                    formValues['committe1name'] = committe1name;
                    formValues['committe1position'] = committe1position;

                    formValues['commette2phone'] = committe2;
                    formValues['committe2name'] = committe2name;
                    formValues['committe2position'] = committe2position;


                    formValues['commette3phone'] = committe3;
                    formValues['committe3name'] = committe3name;
                    formValues['committe3position'] = committe3position;


                    formValues['commette4phone'] = committe4;
                    formValues['committe4name'] = committe4name;
                    formValues['committe4position'] = committe4position;


                    formValues['commette5phone'] = committe5;
                    formValues['committe5name'] = committe5name;
                    formValues['committe5position'] = committe5position;


                    var res = await this.callApi('post',`/api/committe/update/${id}`,formValues);
                    if(res.status==200){
                        Swal.fire({
                        title:'মূল্যায়ন কমিটি সফল ভাবে গঠন হয়েছে',
                        icon:'success'
                    })
                    this.sonodname();
                    }else{
                        Swal.fire({
                        title:'কিছু একটা সমস্যা হয়েছে',
                        icon:'error'
                    })
                    }
                }else{
                    Swal.fire({
                        title:'সবগুলো ফোন নাম্বার পূরণ করুন',
                        icon:'error'
                    })
                }
            }
            })
        },



        tendeSelection(item, itemStatus){

            // this.$router.push({name:'tendersubmitlist',params:{tender_id:item.id}});







            Swal.fire({
            title: 'Result Committe',
            width: '80%',
            html:
                `

                <table width="100%" border="1" style="border-collapse: collapse;">
                            <tbody>
                                <tr>
                                    <td style='padding:10px 16px'>পদবি</td>
                                    <td style='padding:10px 16px'>মোবাইল</td>
                                    <td style='padding:10px 16px'>ওটিপি</td>
                                </tr>

                                <tr>

                                    <td style='padding:10px 16px'>সভাপতি</td>
                                    <td style='padding:10px 16px'>
                                        <input style='border:1px solid red' type='text' id="commette1phone" class="swal2-input" autocomplete="off" required>
                                    </td>
                                    <td style='padding:10px 16px'>
                                        <input style='border:1px solid red' type='password'  id="commette1pass" class="swal2-input" autocomplete="off" required>
                                    </td>
                                </tr>

                                <tr>

                                    <td style='padding:10px 16px'>সদস্য সচিব</td>
                                    <td style='padding:10px 16px'>
                                        <input style='border:1px solid red' type='text'  id="commette5phone" class="swal2-input" autocomplete="off" required>
                                    </td>
                                    <td style='padding:10px 16px'>
                                        <input style='border:1px solid red' type='password' id="commette5pass" class="swal2-input" autocomplete="off" required>
                                    </td>
                                </tr>


                            </tbody>
                        </table>





                `,
                allowOutsideClick: false,
                allowEscapeKey: false,
            focusConfirm: false,
            preConfirm: async (resolve) => {

                var commette1phone = document.getElementById('commette1phone').value
                var commette1pass = document.getElementById('commette1pass').value

                // var commette2phone = document.getElementById('commette2phone').value
                // var commette2pass = document.getElementById('commette2pass').value

                var commette5phone = document.getElementById('commette5phone').value
                var commette5pass = document.getElementById('commette5pass').value

                if(commette1phone && commette1pass && commette5phone && commette5pass){

                    if(commette1phone===item.commette1phone && commette5phone===item.commette5phone && commette1pass===item.commette1pass && commette5pass===item.commette5pass){

                        // this.$router.push({name:'tendersubmitlist',params:{tender_id:item.id}});
                       localStorage.setItem('tenderAccess',true)
                            this.$router.push({name:'tendersubmitlist',params:{tender_id:item.id}});



                    }else{
                        localStorage.removeItem('tenderAccess')
                        Swal.fire({
                            title:'মূল্যায়ন কমিটির ফোন নাম্বার অথবা পাসওয়ার্ড ভুল',
                            icon:'error'
                        })
                    }
                }else{
                    localStorage.removeItem('tenderAccess')
                    Swal.fire({
                        title:'সবগুলো ফিল্ড পূরণ করুন',
                        icon:'error'
                    })
                }
            }
            })





        },





        sonodname(){
            this.preLooding = true
            var position = this.Users.position
            var thana = this.Users.thana
            var unioun = localStorage.getItem('unioun');
            var status = this.$route.params.name;
              axios.get(`/api/tender?union_name=${unioun}&status=${status}`)
                .then(({ data }) => {
                    // console.log(data)
                  this.items = data
                  this.TotalRows = `${this.items.length}`;
                  this.preLooding = false
                })
                .catch()
        },

    },
    mounted() {
        setTimeout(()=>{

            this.sonodname();
        }, 2000);


        localStorage.removeItem('tenderAccess')


    }


}
</script>

<!--

<div class="form-group">
    <lable>Comitte one phone number</lable>
    <input type='text' name="phone1" id="commette1phone" class="swal2-input" autocomplete="off" required>
</div>
<div class="form-group">
    <lable>Comitte one password</lable>
    <input type='password' name="pass1" id="commette1pass" class="swal2-input" autocomplete="off" required>
</div>
<div class="form-group">
    <lable>Comitte one phone number</lable>
    <input type='text' id="commette2phone" name="phone2" class="swal2-input" autocomplete="off" required>
</div>
<div class="form-group">
    <lable>Comitte one password</lable>
    <input type='password' name="pass2" id="commette2pass" class="swal2-input" autocomplete="off" required>
</div>
<div class="form-group">
    <lable>Comitte one phone number</lable>
    <input type='text' id="commette3phone" name="phone3" class="swal2-input" autocomplete="off" required>
</div>
<div class="form-group">
    <lable>Comitte one password</lable>
    <input type='password' name="pass3" id="commette3pass" class="swal2-input" autocomplete="off" required>
</div> -->
