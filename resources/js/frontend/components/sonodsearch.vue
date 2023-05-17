<template>
    <div class="row">
        <div class="mainBody col-md-9 mt-3">
            <form method="POST" @submit.stop.prevent="onSubmit">

                <div class="form-group">
                    <label for="">ইস্যুকৃত লাইসেন্স নম্বর লিখুন</label>
                    <input type="text" v-model="form.sonod_Id" id="sonodNo" class="form-control" required />
                </div>
                <div class="form-group text-center">
                    <input type="submit" class="btn btn-info" v-if="!searching" value="Search" />
                    <input type="button" class="btn btn-info" disabled v-else value="Searching" />
                </div>
            </form>


            <div class="row" v-if="search && notfound == false">
                <div class="col-md-12 mx-0">
                    <form id="msform">
                        <ul id="progressbar">
                            <li :class="{ active: aplication }" id="account"><strong>আবেদন জমা হয়েছে</strong></li>
                            <li :class="{ active: todonttodhin }" id="payment"><strong>তদন্তাধীন</strong></li>
                            <li :class="{ active: todonttokrito }" id="confirm"><strong>তদন্তকৃত</strong></li>
                            <li :class="{ active: approved }" id="confirm"><strong>অনুমোদিত</strong></li>
                            <li :class="{ active: lisenefee }" id="confirm"><strong>লাইসেন্স ফি</strong></li>

                        </ul>
                    </form>
                </div>
            </div>


            <table class="table" v-if="search && notfound == false">
                <tr><td colspan="2" style="text-align: center;font-size: 20px;">

                <span v-if="aplication && todonttodhin">আপনার লাইসেন্সটি এখন পক্রিয়াধীন আছে। দয়া করে অপেক্ষা করুন।</span>
                <span v-if="aplication && todonttodhin && todonttokrito">আপনার লাইসেন্সটি  পক্রিয়াধীন আছে। দয়া করে অপেক্ষা করুন। </span>


                </td></tr>



                <tr>
                    <td>সেবার ধরণ</td>
                    <td>গভীর/অগভীর নলকূপ স্থাপনের লাইসেন্সে</td>
                </tr>
                <tr>
                    <td>আবেদনের ক্রমিক নাম্বার</td>
                    <td>{{ sonoddata.licence_no }}</td>
                </tr>
                <tr>
                    <td>আবেদনের তারিখ</td>
                    <td>{{ sonoddata.created_at }}</td>
                </tr>
                <tr>
                    <td>আবেদনকারির নাম</td>
                    <td class="sonodTd" v-if="sonoddata.applicant_type=='একক ব্যক্তি'">{{ sonoddata.appicant_name }}</td>
                    <td class="sonodTd" v-else-if="sonoddata.applicant_type=='সমবায় সমিতি/প্রতিষ্ঠান'">{{ sonoddata.gostir_name }}</td>
                    <td class="sonodTd" v-else-if="sonoddata.applicant_type=='একটি গোষ্ঠী'">{{ sonoddata.appicant_sumiti_name }}</td>
                </tr>

                <tr>
                    <td>বর্তমান ঠিকানা</td>
                    <td>  {{
                            sonoddata.village
                    }}, {{ sonoddata.post }}, {{
        sonoddata.upozila
}}, {{ sonoddata.district }}</td>
                </tr>
                <tr>
                    <td>মোবাইল নাম্বার</td>
                    <td>{{ sonoddata.mobile_number }}</td>
                </tr>
            </table>
            <div class="card text-center" v-else-if="search && notfound">
                <div class="card-body">
                    <h1 style="color:red">দু:খিত !</h1>
                    <p>আপনার অনুসন্ধানকৃত নম্বরের কোন গভীর/অগভীর নলকূপ স্থাপনের লাইসেন্স ইস্যু/প্রদান করা হয়নি।</p>
                </div>
            </div>
        </div>
        <side-bar></side-bar>
    </div>
</template>
<script>
export default {
    data() {
        return {
            searching: false,
            aplication: false,
            todonttodhin: false,
            todonttokrito: false,
            approved: false,
            lisenefee: false,
            cancel: false,
            form: {
                sonod_Id: null,
                sonod_name: null,
            },
            search: false,
            notfound: false,
            sonoddata: {
                payment_status: null,
                sonod_name: null,
                sonod_Id: null,
                created_at: null,
                applicant_name: null,
                applicant_father_name: null,
                applicant_holding_tax_number: null,
                applicant_present_Upazila: null,
                applicant_present_district: null,
                applicant_present_post_office: null,
                applicant_present_road_block_sector: null,
                applicant_present_village: null,
                applicant_present_word_number: null,
                applicant_mobile: null,
                sonodUrl: null,
                paymentUrl: null,
            }
        }
    },
    watch: {
        '$route': {
            handler(newValue, oldValue) {
                if (!this.$route.query.sonod_Id && !this.$route.query.sonod_name) {
                    this.search = false
                    this.notfound = false
                    this.form = {
                        sonod_Id: null,
                        sonod_name: null,
                    }
                }
            },
            deep: true
        }
    },
    methods: {
        async onSubmit() {
            this.searching = true
            var res = await this.callApi('post', `/api/sonod/search`, this.form);
            console.log(res);
            if (this.$route.query.sonod_Id != this.form.sonod_Id) {
                this.$router.push({ name: 'sonodsearch', query: {sonod_Id: this.form.sonod_Id } })
                // console.log('dd')
            }
            if (res.data == 0) {
                this.aplication = false
                    this.todonttodhin = false
                    this.todonttokrito = false
                    this.approved = false
                    this.lisenefee = false
                this.search = true;
                this.notfound = true;
            } else if (res.data.searchstatus == 'approved') {
                this.sonoddata = res.data
                this.search = true;
                this.notfound = false;

                this.aplication = true
                    this.todonttodhin = true
                    this.todonttokrito = true
                    this.approved = true
                    this.lisenefee = true
                this.$router.push({ name: 'sonodVerify', params: { id: res.data.id } })
            } else if (res.data.searchstatus == 'all') {
                this.sonoddata = res.data
                this.search = true;
                this.notfound = false;

               if (res.data.status == 'pending' && res.data.payment_status == 'Unpaid') {
                    console.log('pending');
                    this.aplication = true
                    this.todonttodhin = false
                    this.todonttokrito = false
                    this.approved = false
                    this.lisenefee = false
                } else if (res.data.status == 'processing' && res.data.payment_status == 'Unpaid') {
                    console.log('processing');
                    this.aplication = true
                    this.todonttodhin = true
                    this.todonttokrito = false
                    this.approved = false
                    this.lisenefee = false
                } else if (res.data.status == 'processied' && res.data.payment_status == 'Unpaid') {
                    console.log('processied');
                    this.aplication = true
                    this.todonttodhin = true
                    this.todonttokrito = true
                    this.approved = false
                    this.lisenefee = false
                } else if (res.data.status == 'approved' && res.data.payment_status == 'Unpaid') {
                    console.log('approved');
                    this.aplication = true
                    this.todonttodhin = true
                    this.todonttokrito = true
                    this.approved = true
                    this.lisenefee = false
                } else if (res.data.status == 'approved' && res.data.payment_status == 'Paid') {
                    this.aplication = true
                    this.todonttodhin = true
                    this.todonttokrito = true
                    this.approved = true
                    this.lisenefee = true
                }else {
                    console.log('nothing')
                }



            }
            this.searching = false
        }
    },
    mounted() {
        console.log(this.$route.query)
        if (this.$route.query.sonod_Id && this.$route.query.sonod_name) {
            this.search = true;
            this.form.sonod_Id = this.$route.query.sonod_Id
            this.form.sonod_name = this.$route.query.sonod_name
            // ?sonod=নাগরিকত্ব%20সনদ&sonod_id=7790812200002
            this.onSubmit();
        }
    }
}
</script>
<style>
/*form styles*/
#msform {
    text-align: center;
    position: relative;
    margin-top: 20px;
}
/*progressbar*/
#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: lightgrey;
}
#progressbar .active {
    color: #000000;
}
#progressbar li {
    list-style-type: none;
    font-size: 12px;
    width: 16%;
    float: left;
    position: relative;
}
/*Icons in the ProgressBar*/
#progressbar #account:before {

    content: "Done";


}
#progressbar #personal:before {
    font-family: FontAwesome;
    content: "Done";
}
#progressbar #payment:before {
    font-family: FontAwesome;
    content: "Done";
}
#progressbar #confirm:before {
    font-family: FontAwesome;
    content: "Done";
}
/*ProgressBar before any progress*/
#progressbar li:before {
    width: 50px;
    height: 50px;
    line-height: 45px;
    display: block;
    font-size: 18px;
    color: #ffffff;
    background: lightgray;
    border-radius: 50%;
    margin: 0 auto 10px auto;
    padding: 2px;
}
/*ProgressBar connectors*/
#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: lightgray;
    position: absolute;
    left: 0;
    top: 25px;
    z-index: -1;
}
/*Color number of the step and the connector before it*/
#progressbar li.active:before,
#progressbar li.active:after {
    background: skyblue;
}
/*Imaged Radio Buttons*/
.radio-group {
    position: relative;
    margin-bottom: 25px;
}
.radio {
    display: inline-block;
    width: 204;
    height: 104;
    border-radius: 0;
    background: lightblue;
    box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
    box-sizing: border-box;
    cursor: pointer;
    margin: 8px 2px;
}
.radio:hover {
    box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3);
}
.radio.selected {
    box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1);
}
/*Fit image in bootstrap div*/
.fit-image {
    width: 100%;
    object-fit: cover;
}
</style>




