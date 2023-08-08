<template>
    <div id="wrapper" class="wrapper bg-ash"
        :class="{ 'sidebar-collapsed': sidebarstatus, 'sidebar-collapsed-mobile': mobileSidebar }">
        <loader v-if="preLooding" object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#343a40"
            objectbg="#999793" opacity="80" name="circular"></loader>


        <!-- Header Menu Area Start Here -->
        <div class="navbar navbar-expand-md header-menu-one bg-light" id='topnavbar'>
            <div class="nav-bar-header-one">
                <div class="header-logo">
                    <h3 style="    margin-bottom: 0;">
                        <router-link :to="{ name: 'Dashboard' }" class="text-white">
                            {{ changeName(user.position) }}
                            <!-- <img width="80%" src="http://esoft4u.tmscedu.com/asset/img/Logo123.png" alt="logo"> -->
                        </router-link>
                    </h3>
                </div>
                <div class="toggle-button sidebar-toggle">
                    <button type="button" class="item-link" @click="sidebarstatus = !sidebarstatus">
                        <span class="btn-icon-wrap">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="d-md-none mobile-nav-bar">
                <button class="navbar-toggler pulse-animation" type="button" data-toggle="collapse"
                    data-target="#mobile-navbar" aria-expanded="false">
                    <i class="far fa-arrow-alt-circle-down"></i>
                </button>
                <button type="button" class="navbar-toggler sidebar-toggle-mobile"
                    @click="mobileSidebar = !mobileSidebar">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <div class="header-main-menu collapse navbar-collapse" id="mobile-navbar">
                <ul class="navbar-nav">
                    <li class="navbar-item header-search-bar">
                        <div class="input-group stylish-input-group">
                            <span class="input-group-addon">
                                <button type="submit">
                                    <!-- <span class="flaticon-search" aria-hidden="true"></span> -->
                                </button>
                            </span>
                            <!-- <input type="text" class="form-control" placeholder="Find Something . . ."> -->
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="navbar-item dropdown header-admin">
                        <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            <div class="admin-title">
                                <h5 class="item-title">{{ user.name }}</h5>

                                <span v-if="user.position=='sub_admin'">{{ user.designation }}</span>
                                <span v-else>{{ changeName(user.position) }}</span>


                            </div>
                            <div class="admin-img">
                                <img :src="$asseturl + 'dashboard_asset/img/figure/admin.jpg'" alt="Admin">
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="item-header">
                                <h6 class="item-title">{{ $localStorage.getItem('user') }}</h6>
                            </div>
                            <div class="item-content">
                                <ul class="settings-list">
                                    <li>
                                        <router-link class="dropdown-item" :to="{ name: 'profile' }">
                                            <img :src="$asseturl + 'dashboard_asset/img/figure/admin.jpg'" alt="Admin">
                                            Profile
                                        </router-link>
                                    </li>

                                    <li>
                                        <router-link class="dropdown-item" :to="{ name: 'logout' }">
                                            <i class="flaticon-turn-off"></i> Logout
                                        </router-link>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
                <div class="mobile-sidebar-header d-md-none">
                    <div class="header-logo">
                        <a href="/" style="    padding: 10px !important;">
                            {{ user.position }} Panel
                            <!-- <img width="80%" src="http://esoft4u.tmscedu.com/asset/img/Logo123.png" alt="logo"> -->

                        </a>
                    </div>
                </div>
                <div class="sidebar-menu-content" id="dashboardheight">
                    <ul class="nav nav-sidebar-menu sidebar-toggle-view navBar">






                        <li class="nav-item" @click="submenu(0)">
                            <router-link :to="{ name: 'Dashboard' }" class="nav-link"><i
                                    class="flaticon-dashboard"></i><span>ড্যাশবোর্ড</span></router-link>
                        </li>




                        <li class="nav-item" @click="submenu(0)">
                            <router-link :to="{ name: 'report' }" class="nav-link"><i
                                    class="flaticon-dashboard"></i><span>সকল প্রতিবেদন</span></router-link>
                        </li>



                        
                        <li class="nav-item sidebar-nav-item">
                            <a href="javascript:void(0)" class="nav-link" @click="submenu(100)"><i class="flaticon-technological"></i><span>ইজারা</span></a>
                            <transition name="slide">
                                <ul class="nav sub-group-menu menu-open child" v-if="selected == 100"
                                    style="display:block">

                                    <li class="nav-item">
                                        <router-link
                                            :to="{ name: 'tenderlist', params: { name: 'pending' } }"
                                            class="nav-link"><i class="fas fa-angle-right"></i> নতুন ইজারা
                                        </router-link>
                                    </li>

                                    <li class="nav-item">
                                        <router-link
                                            :to="{ name: 'tenderlist', params: { name: 'active' } }"
                                            class="nav-link"><i class="fas fa-angle-right"></i> চলমান ইজারা
                                        </router-link>
                                    </li>

                                    <li class="nav-item">
                                        <router-link
                                            :to="{ name: 'tenderlist', params: { name: 'proccesing' } }"
                                            class="nav-link"><i class="fas fa-angle-right"></i> নির্বাচন প্রক্রিয়াধীন
                                        </router-link>
                                    </li>

                                    <li class="nav-item">
                                        <router-link
                                            :to="{ name: 'tenderlist', params: { name: 'Completed' } }"
                                            class="nav-link"><i class="fas fa-angle-right"></i> কমপ্লিট ইজারা
                                        </router-link>
                                    </li>


                                </ul>
                            </transition>
                        </li>








                        <li class="nav-item sidebar-nav-item" :class="{ active: selected == 101 }">
                            <a href="javascript:void(0)" class="nav-link" @click="submenu(101)"><i
                                    class="flaticon-technological"></i><span>নলকূপ লাইসেন্স</span>
                            </a>
                            <transition name="slide">
                                <ul class="nav sub-group-menu menu-open child" v-if="selected == 101"
                                    style="display:block">
                                    <li class="nav-item" v-if="this.$localStorage.getItem('position') == 'admin' || this.$localStorage.getItem('position') == 'chairman' || this.$localStorage.getItem('position') == 'uno'">
                                        <router-link :to="{ name: 'applicationlist', params:{type:'pending',name:'tube_well_license'} }" class="nav-link"><i
                                                class="fas fa-angle-right"></i> নতুন আবেদন </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link :to="{ name: 'applicationlist', params:{type:'processing',name:'tube_well_license'} }" class="nav-link"><i
                                                class="fas fa-angle-right"></i> তদন্তাধীন আবেদন </router-link>
                                    </li>
                                    <li class="nav-item" v-if="this.$localStorage.getItem('position') == 'admin' || this.$localStorage.getItem('position') == 'chairman' || this.$localStorage.getItem('position') == 'uno'">
                                        <router-link :to="{ name: 'applicationlist', params:{type:'processied',name:'tube_well_license'} }" class="nav-link"><i
                                                class="fas fa-angle-right"></i> তদন্তকৃত আবেদন </router-link>
                                    </li>
                                    <li class="nav-item" v-if="this.$localStorage.getItem('position') == 'admin' || this.$localStorage.getItem('position') == 'chairman' || this.$localStorage.getItem('position') == 'uno'">
                                        <router-link :to="{ name: 'applicationlist', params:{type:'approved',name:'tube_well_license'} }" class="nav-link"><i
                                                class="fas fa-angle-right"></i> অনুমোদিত আবেদন </router-link>
                                    </li>
                                    <li class="nav-item" v-if="this.$localStorage.getItem('position') == 'admin' || this.$localStorage.getItem('position') == 'chairman' || this.$localStorage.getItem('position') == 'uno'">
                                        <router-link :to="{ name: 'applicationlist', params:{type:'canceled',name:'tube_well_license'} }" class="nav-link"><i
                                                class="fas fa-angle-right"></i> বাতিলকৃত আবেদন </router-link>
                                    </li>
                                </ul>
                            </transition>
                        </li>



                        <li class="nav-item sidebar-nav-item" :class="{ active: selected == 102 }">
                            <a href="javascript:void(0)" class="nav-link" @click="submenu(102)"><i
                                    class="flaticon-technological"></i><span>ভবনের নকশা</span>
                            </a>
                            <transition name="slide">
                                <ul class="nav sub-group-menu menu-open child" v-if="selected == 102"
                                    style="display:block">
                                    <li class="nav-item" v-if="this.$localStorage.getItem('position') == 'admin' || this.$localStorage.getItem('position') == 'chairman' || this.$localStorage.getItem('position') == 'uno'">
                                        <router-link :to="{ name: 'applicationlist', params:{type:'pending',name:'building_design'} }" class="nav-link"><i
                                                class="fas fa-angle-right"></i> নতুন আবেদন </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link :to="{ name: 'applicationlist', params:{type:'processing',name:'building_design'} }" class="nav-link"><i
                                                class="fas fa-angle-right"></i> তদন্তাধীন আবেদন </router-link>
                                    </li>
                                    <li class="nav-item" v-if="this.$localStorage.getItem('position') == 'admin' || this.$localStorage.getItem('position') == 'chairman' || this.$localStorage.getItem('position') == 'uno'">
                                        <router-link :to="{ name: 'applicationlist', params:{type:'processied',name:'building_design'} }" class="nav-link"><i
                                                class="fas fa-angle-right"></i> তদন্তকৃত আবেদন </router-link>
                                    </li>
                                    <li class="nav-item" v-if="this.$localStorage.getItem('position') == 'admin' || this.$localStorage.getItem('position') == 'chairman' || this.$localStorage.getItem('position') == 'uno'">
                                        <router-link :to="{ name: 'applicationlist', params:{type:'approved',name:'building_design'} }" class="nav-link"><i
                                                class="fas fa-angle-right"></i> অনুমোদিত আবেদন </router-link>
                                    </li>
                                    <li class="nav-item" v-if="this.$localStorage.getItem('position') == 'admin' || this.$localStorage.getItem('position') == 'chairman' || this.$localStorage.getItem('position') == 'uno'">
                                        <router-link :to="{ name: 'applicationlist', params:{type:'canceled',name:'building_design'} }" class="nav-link"><i
                                                class="fas fa-angle-right"></i> বাতিলকৃত আবেদন </router-link>
                                    </li>
                                </ul>
                            </transition>
                        </li>







                        <li class="nav-item" @click="submenu(0)" v-if="this.$localStorage.getItem('position') == 'admin'">
                                <router-link :to="{ name: 'userlist' }" class="nav-link"><i
                                    class="flaticon-dashboard"></i><span>ইউজার</span></router-link>
                        </li>

                        <li class="nav-item" @click="submenu(0)"
                        v-if="this.$localStorage.getItem('position') == 'admin'">
                            <router-link :to="{ name: 'unionlist' }" class="nav-link"><i
                                    class="flaticon-dashboard"></i><span>উপজেলার এর তালিকা</span></router-link>
                        </li>


                    </ul>
                </div>
            </div>
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <slot></slot>
                <!-- Footer Area Start Here -->
                <!-- <footer class="footer-wrap-layout1">
                    <div class="copyright">© Copyrights <a href="#">Company name</a> 2019. All rights reserved.
                        Developed by <a target="_blank"
                            href="https://api.whatsapp.com/send?phone=8801909756552&text=I%27m%20interested%20in%20your%20services">Freelancer
                            Nishad</a></div>
                </footer> -->
                <!-- Footer Area End Here -->
            </div>
        </div>
        <!-- Page Area End Here -->
    </div>
</template>
<script>
export default {
    props: ['user', 'permission', 'roles'],
    async created() {
        // this.getSonodNamesAdmin();

        // var url = this.$appUrl.split("//");
        // var subdomain = url[1].split(".");
        var subdomain = [];

        this.$store.commit('setWebsiteStatus', 'main')

        if (!User.loggedIn()) {
            window.location.href = '/login'
        }

        //             if(this.$route.params.name){
        //  var ress =  await this.callApi('get',`/api/get/sonodname/list?data=${this.$route.params.name.replaceAll('_',' ')}`,[]);
        //        this.$store.commit('setUpdateSonodName', ress.data)
        //             }
        if (this.$route.params.name) {
            var result = await this.callApi('get', `/api/get/sonodname/list?data=${this.$route.params.name.replaceAll('_', ' ')}`, []);
            this.$store.commit('setUpdateSonodName', result.data)
        }




        this.$store.commit('setUpdateSonodNames', this.SonodNamesAdmin)
        this.$store.commit('setUpdateUser', this.user)
        // this.$store.commit('setUserPermission', JSON.parse(this.permission.permission))
        // this.$store.commit('setUserRoles', this.roles)



        //  this.$store.dispatch("getUser",this.user);


        if (localStorage.getItem('selectedMenu')) {
            this.selected = localStorage.getItem('selectedMenu')
        }
        window.addEventListener("resize", this.myEventHandler);
        window.addEventListener("scroll", this.myscroll);

    },
    watch: {
        '$route': async function (to, from) {


        }
    },
    destroyed() {
        window.removeEventListener("resize", this.myEventHandler);
        window.removeEventListener("scroll", this.myscroll);
    },
    data() {
        return {
            selected: 0,
            preLooding: false,
            sidebarstatus: false,
            mobileSidebar: false,
            SonodNamesAdmin:{},
            allSonodCount: {
                Pending: {},
                Secretary_approved: {},
                approved: {},
            },
        }
    },
    watch: {
        '$route': {
            handler(newValue, oldValue) {
                this.sidebarstatus = false
                this.mobileSidebar = false


            },
            deep: true



        }
    },
    methods: {

    async getSonodNamesAdmin(){
        this.preLooding = true

        var res = await this.callApi('get', '/api/get/sonodname/list?admin=1', []);
        this.SonodNamesAdmin = res.data
        this.preLooding = false

        },
    async sonodlistCount() {
            var unionname = localStorage.getItem('unioun');
            if (this.$localStorage.getItem('position') == 'District_admin' || this.$localStorage.getItem('position') == 'Thana_admin') {

                var unionname = '';
            }

            // var allSonodc = await this.callApi('get', `/api/get/sonod/count?union=${unionname}&postion=${localStorage.getItem('position')}`, []);
            // this.allSonodCount = allSonodc.data
            // console.log(allSonodc)
        },

        myscroll() {



            // Get the header
            var header = document.getElementById("topnavbar");

            var sticky = header.offsetTop;


            if (window.pageYOffset > sticky) {
                header.classList.add("fixednav");
            } else {
                header.classList.remove("fixednav");
            }



        },




        myEventHandler() {
            // if (window.innerWidth > 768) {
            //     this.sidebarstatus = false
            // } else {
            //     this.mobileSidebar = false
            // }


            // // var index = 1
            // // if(localStorage.getItem('role')=='admin' || localStorage.getItem('role')=='teacher'){
            // //     index= 0
            // // }
            //     var clientHeight = document.getElementsByClassName('navBar')[0].clientHeight;

            // var menuheight = 0
            // if(clientHeight<window.innerHeight){
            //     menuheight= window.innerHeight
            // }else{
            //     menuheight= '100%'
            // }
            // document.getElementById('wrapper').style.height = menuheight +'px';
            // document.getElementById('dashboardheight').style.height = menuheight +'px';










        },
        submenu(ref) {

            if (this.selected > 0) {
                if (ref == this.selected) {
                    this.selected = 0
                    localStorage.setItem('selectedMenu', 0)
                } else {
                    this.selected = ref
                    localStorage.setItem('selectedMenu', ref)
                }
            } else {
                this.selected = ref
                localStorage.setItem('selectedMenu', ref)
            }
        }
    },
    mounted() {
        // this.myEventHandler();

        this.sonodlistCount()
        setInterval(() => {
            this.sonodlistCount()
        }, 300000);
    }
}
</script>
<style>

.form_title {
    border-bottom: 2px solid #159513;
    color: #159513;
    margin: 23px 0;
}
.form_title h5 {
    color: #159513 !important;
}

ul.nav.sub-group-menu.menu-open.child {
    padding: 0 !important;
}

ul.nav.sub-group-menu.menu-open.child li {
    padding: 10px 0;
}

.slide-enter-active {
    -moz-transition-duration: 0.3s;
    -webkit-transition-duration: 0.3s;
    -o-transition-duration: 0.3s;
    transition-duration: 0.3s;
    -moz-transition-timing-function: ease-in;
    -webkit-transition-timing-function: ease-in;
    -o-transition-timing-function: ease-in;
    transition-timing-function: ease-in;
}

.slide-leave-active {
    -moz-transition-duration: 0.3s;
    -webkit-transition-duration: 0.3s;
    -o-transition-duration: 0.3s;
    transition-duration: 0.3s;
    -moz-transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
    -webkit-transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
    -o-transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
    transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
}

.slide-enter-to,
.slide-leave {
    max-height: 100px;
    overflow: hidden;
}

.slide-enter,
.slide-leave-to {
    overflow: hidden;
    max-height: 0;
}

a.nav-link span {
    font-size: 14px !important;
}
textarea.form-control {
    background: #b9b9b9 !important;
}
</style>
