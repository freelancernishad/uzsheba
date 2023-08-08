<template>
    <div>
        <loader v-if="preLooding" object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#343a40" objectbg="#999793" opacity="80" name="circular"></loader>

        <div class="breadcrumbs-area">
    <h3>নির্বাচিত তালিকা</h3>
    <ul>
        <li>
            <router-link :to="{name:'Dashboard'}">Home</router-link>
        </li>
        <li>নির্বাচিত তালিকা</li>
    </ul>
</div>
    <div class="container mt-5">



        <div class="d-flex justify-content-center align-items-center" v-if="tenders.status!='Completed'">
            <button class="btn btn-info py-3 px-3" @click="selections">এই বাটন ক্লিক করে নির্বাচন করুন</button>
        </div>





<!--
        <div class="text-right">
            <a :href="'/pdf/sder/download/'+$route.params.tender_id" class="btn btn-info" target="_blank">Pdf Download</a>
        </div> -->

        <div class="table-responsive">
            <table class="table">
            <thead>
                <tr>
                <th scope="col">দরপত্র নম্বর</th>
                <th scope="col">নাম</th>
                <th scope="col">পিতার নাম</th>
                <th scope="col">ঠিকানা</th>
                <th scope="col">মোবাইল</th>
                <th scope="col">দরের পরিমাণ</th>
                <th scope="col">কথায়</th>
                <th scope="col">জামানতের পরিমাণ</th>
                <th scope="col">files</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="application in applications" :key="application.id">
                    <th scope="row">{{ application.dorId }}</th>
                    <td>{{ application.applicant_orgName }}</td>
                    <td>{{ application.applicant_org_fatherName }}</td>
                    <td>গ্রাম- {{ application.vill }}, ডাকঘর- {{ application.postoffice }}, উপজেলা- {{ application.thana }}, জেলা- {{ application.distric }}</td>
                    <td>{{ application.mobile }}</td>
                    <td>{{ application.DorAmount }}</td>
                    <td>{{ application.DorAmountText }}</td>
                    <td>{{ application.depositAmount }}</td>
                    <td>
                        <button class="btn btn-info" @click="showImage(application)">Files</button>
                    </td>

                </tr>


            </tbody>
            </table>
        </div>

    </div>

    <div class="overlay" v-if="popup">
        <div  class="row fixed">
            <div class="col-md-12 text-right" ><span style="padding: 7px 3px;background: red;color: white;border-radius: 7px;cursor: pointer;" @click="closePoup">Close</span></div>
            <div class="col-md-12">
                <h2>ব্যাংক ড্রাফট/পে-অর্ডারের ছবি</h2>
                <img :src="poupitems.bank_draft_image"  alt="">
                <a :href="poupitems.bank_draft_image" target="_blank" class="btn btn-info">Download</a>
            </div>
            <div class="col-md-12">
                <h2>দরপত্র সিডিউলের ছবি</h2>
                <img :src="poupitems.deposit_details"  alt="">
                <a :href="poupitems.deposit_details" target="_blank" class="btn btn-info">Download</a>
            </div>
        </div>
    </div>





    </div>




</template>
<script>
export default {
    name: "home",
    created() {
        // if (!User.loggedIn()) {
        //     this.$router.push({ name: "/" });
        // }
    },

    data() {
        return {
            tenders:{status:'Pending'},
            applications:{},
            preLooding:false,
            popup:false,
            poupitems:{},
        };
    },
    mounted() {


        this.getTender();
        setTimeout(() => {
            if(this.tenders.status=='Completed'){
                this.getApplication();
            }
        }, 3000);

    },
    methods: {

       async selections(){


        Swal.fire({
            title: 'ইজারাটি কি সফটওয়্যার এর মাধমে নির্বাচন করতে চান?',
            showCancelButton: true,
            confirmButtonText: 'হ্যাঁ',
            }).then(async (result) => {
                this.preLooding = true
                if (result.isConfirmed) {
                    var tender_id = this.$route.params.tender_id
                    var res = await this.callApi('post',`/api/tender/selection/${tender_id}`);
                    if(res.status==200){
                        this.getApplication();
                        this.getTender();
                        this.preLooding = false
                    }else if(res.status==404){
                        Swal.fire({
                            icon:'error',
                            title:'কোনো ইজারা জমা হয় নি!',
                        })
                        this.preLooding = false
                    }else if(res.status==422){
                        Swal.fire({
                            icon:'error',
                            title:'ইজারা খোলার সময় হয় নি!',
                        })
                        this.preLooding = false
                    }
                }
            })








        },



        async getTender(){
            var tender_id = this.$route.params.tender_id
            var res = await this.callApi('get',`/api/tender/${tender_id}`,[]);
            this.tenders = res.data;
        },

        getApplication(Selected='') {
            this.preLooding = true;
            var quiry = '';
            if(Selected)  quiry = `?status=${Selected}`;
            var tender_id = this.$route.params.tender_id
            axios
                .get(`/api/get/all/aplications/${tender_id}${quiry}`)
                .then(({ data }) => (this.applications = data))
                .catch();
                this.preLooding = false
        },


        showImage(items){
            this.popup = true;
            this.poupitems = items
        },
        closePoup(){
            this.popup = false;
            this.poupitems = {}
        }
    }
};





</script>
<style lang="css" scoped>
#img_size {
    width: 40px;
}
.row.fixed {
    background: #e5e5e5;
    padding: 13px 5px;
    position: fixed;
    width: 75%;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    overflow: auto;
    height: 80vh;
}
.overlay {
    width: 100%;
    height: 100vh;
    position: fixed;
    background: #000000a6;
    top: 0;
    left: 0;
    z-index: 9999;
}
</style>
