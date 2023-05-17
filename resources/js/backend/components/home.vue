<template>
    <div>
        <!-- Sidebar Area End Here -->
        <div class="dashboard-content-one">
            <!-- Breadcubs Area Start Here -->
            <div class="breadcrumbs-area">


                <!-- <h3 v-if="Users.position=='District_admin'">জেলা প্রশাসকের ড্যাশবোর্ড</h3>
                <h3 v-else-if="Users.position=='Chairman'">চেয়ারম্যানের ড্যাশবোর্ড</h3>
                <h3 v-else-if="Users.position=='Secretary'">সচিবের ড্যাশবোর্ড</h3> -->
                <!-- <h3 v-else>উপজেলা ড্যাশবোর্ড</h3> -->
                <h3>ড্যাশবোর্ড</h3>



                <ul>
                    <li>
                        <router-link :to="{ name: 'Dashboard' }">ড্যাশবোর্ড</router-link>
                    </li>
<!--
                    <li v-if="Users.position=='District_admin'">জেলা প্রশাসক </li>
                    <li v-else-if="Users.position=='Chairman'">চেয়ারম্যান </li>
                    <li v-else-if="Users.position=='Secretary'">সচিব </li>
                    <li v-else>উপজেলা </li> -->

                </ul>
            </div>
            <!-- Breadcubs Area End Here -->
            <!-- Dashboard summery Start Here -->
            <!-- <div class="row gutters-20">



                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="dashboard-summery-one mg-b-20">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <div class="item-icon bg-light-green ">
                                    <img width="75px" :src="$asseturl+'assets/img/application.png'" alt="">


                                </div>
                            </div>
                            <div class="col-6">
                                <div class="item-content">
                                    <div class="item-title">মোট আবেদন</div>
                                    <div class="item-number"><span class="counter" :data-num="sonodCount.allSonodCount">{{ sonodCount.allSonodCount }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="dashboard-summery-one mg-b-20">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <div class="item-icon bg-light-blue">
                                    <img width="75px" :src="$asseturl+'assets/img/NewApplication.png'" alt="">


                                </div>
                            </div>
                            <div class="col-6">
                                <div class="item-content">
                                    <div class="item-title">নতুন আবেদন</div>
                                    <div class="item-number"><span class="counter" :data-num="sonodCount.pendingSonodCount">{{ sonodCount.pendingSonodCount }}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="dashboard-summery-one mg-b-20">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <div class="item-icon bg-light-yellow">
                                    <img width="75px" :src="$asseturl+'assets/img/approved.png'" alt="">


                                </div>
                            </div>
                            <div class="col-6">
                                <div class="item-content">
                                    <div class="item-title">ইস্যুকৃত সনদ</div>
                                    <div class="item-number"><span class="counter" :data-num="sonodCount.approvedSonodCount">{{ sonodCount.approvedSonodCount }}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="dashboard-summery-one mg-b-20">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <div class="item-icon bg-light-red">
                                    <img width="75px" :src="$asseturl+'assets/img/6427300.png'" alt="">


                                </div>
                            </div>
                            <div class="col-6">
                                <div class="item-content">
                                    <div class="item-title">বাতিলকৃত আবেদন</div>
                                    <div class="item-number"><span class="counter"
                                            :data-num="sonodCount.cancelSonodCount">{{ sonodCount.cancelSonodCount }}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- Dashboard summery End Here -->
<!--
                <div class="col-xl-6 col-sm-6 col-12">
                    <div class="dashboard-summery-one mg-b-20">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <div class="item-icon bg-light-red">
                                    <img width="75px" :src="$asseturl+'assets/img/bdt_icon.png'" alt="">


                                </div>
                            </div>
                            <div class="col-6">
                                <div class="item-content">
                                    <div class="item-title">মোট আদায়কৃত ফি'র পরিমাণ</div>
                                    <div class="item-number"><span class="counter"
                                            :data-num="amount">{{ amount }}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
            <!-- Dashboard summery End Here -->

        </div>
    </div>
</template>
<script>
// import { mapState,mapActions } from 'vuex';
export default {
    computed: {
        // users(){
        //    return this.$store.state.Users
        // }
    },
    async created() {
        //   const res = await this.callApi('POST', '/api/user', {});
        // if (!User.loggedIn()) {
        //     this.$router.push({ name: "/login" });
        // }
    },
    data() {
        return {
            sonodCount:{

            allSonodCount:0,
            pendingSonodCount:0,
            approvedSonodCount:0,
            cancelSonodCount:0,

        },
        amount:0,
        };
    },
    mounted() {
        // this.totalamount();

        // this.callCount()
        // setInterval(() => {
        //     this.callCount()
        // },300000)


    },
    methods: {

        callCount(){
            this.sonodCountDashbord('all','allSonodCount')
                this.sonodCountDashbord('Pending','pendingSonodCount')
                this.sonodCountDashbord('approved','approvedSonodCount')
                this.sonodCountDashbord('cancel','cancelSonodCount')
        },



       async sonodCountDashbord(status = '',data=''){

        if(localStorage.getItem('position')=='Secretary' || localStorage.getItem('position')=='Chairman'){

            var res = await this.callApi('get',`/api/count/sonod/${status}?union=${localStorage.getItem('unioun')}`,[]);
        }else{
            var res = await this.callApi('get',`/api/count/sonod/${status}`,[]);

        }

            this.sonodCount[data] = res.data;
        },
       async totalamount(){


        if(localStorage.getItem('position')=='Secretary' || localStorage.getItem('position')=='Chairman'){
            var res = await this.callApi('get',`/api/sum/amount?union=${localStorage.getItem('unioun')}`,[]);

            }else{
                var res = await this.callApi('get',`/api/sum/amount`,[]);


            }


            this.amount = res.data
        }

    },
};
</script>
<style lang="css" scoped>
</style>
