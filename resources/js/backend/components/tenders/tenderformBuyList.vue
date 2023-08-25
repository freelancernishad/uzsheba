<template>
    <div>
        <loader v-if="preLooding" object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#343a40" objectbg="#999793" opacity="80" name="circular"></loader>

        <div class="breadcrumbs-area">
    <h3>সিডিউল ক্রেতার তালিকা</h3>
    <ul>
        <li>
            <router-link :to="{name:'Dashboard'}">Home</router-link>
        </li>
        <li>সিডিউল ক্রেতার তালিকা</li>
    </ul>
</div>
    <div class="container mt-5">



        <div class="table-responsive">
            <table class="table">
            <thead>
                <tr>
                <th scope="col">নাম</th>
                <th scope="col">পিতার নাম</th>
                <th scope="col">ঠিকানা</th>
                <th scope="col">মোবাইল</th>

                </tr>
            </thead>
            <tbody>
                <tr v-for="application in applications" :key="application.id">
                   
                    <td>{{ application.name }}</td>
                    <td>{{ application.applicant_org_fatherName }}</td>
                    <td>গ্রাম- {{ application.vill }}, ডাকঘর- {{ application.postoffice }}, উপজেলা- {{ application.thana }}, জেলা- {{ application.distric }}</td>
                    <td>{{ application.PhoneNumber }}</td>


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
            preLooding:true,
            popup:false,
            poupitems:{},
        };
    },
    mounted() {
        this.getApplication();
    },
    methods: {





        getApplication(Selected='') {
            this.preLooding = true;
            var quiry = '';
            if(Selected)  quiry = `?status=${Selected}`;
            var tender_id = this.$route.params.id
            axios
                .post(`/api/get/all/form/buy/${tender_id}${quiry}`)
                .then(({ data }) => (this.applications = data))
                .catch();
                this.preLooding = false
        },



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
