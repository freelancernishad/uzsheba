<template>
    <div>
        <loader v-if="preLooding" object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#343a40"
            objectbg="#999793" opacity="80" name="circular"></loader>
        <div class="breadcrumbs-area">
            <h3>প্রতিবেদন</h3>
            <ul>
                <li>
                    <router-link :to="{ name: 'Dashboard' }">Home</router-link>
                </li>
                <li>প্রতিবেদন</li>
            </ul>
        </div>


        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">

                        <form @submit.stop.prevent="sonodList(true,'month')" class="d-flex align-items-center">
                            <div class="form-group mb-0">
                                <select class="form-control" v-model="search.month">
                                    <option value="">মাস নির্বাচন করুন</option>
                                    <option v-for="(month,index) in months" :key="'month'+index" :value="month.en" >{{ month.bn }}</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-info">খুঁজুন</button>
                        </form>


                    </div>
                    <div class="col-md-8">

                        <form @submit.stop.prevent="sonodList(true,'dateToDate')" class="d-flex align-items-center">

                            <div class="form-group mb-0">

                               <input type="date" v-model="search.from" class="form-control">
                            </div>

                            <div class="form-group mb-0 p-3">
                                <label for="">--To--</label>
                            </div>

                            <div class="form-group mb-0">
                               <input type="date" v-model="search.to" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-info">খুঁজুন</button>
                        </form>


                    </div>

                </div>
            </div>
        </div>

        <div class="text-right">
            <a target="_blank" :href="'/dashboard/report/download?stutus='+$route.params.type+'&word='+$route.params.word+'&unioun='+$localStorage.getItem('unioun')+extraParams" class="btn btn-info">ডাউনলোড প্রতিবেদন</a>
        </div>


        <div class="card">
            <div class="card-header">






                <nav aria-label="Page navigation example" v-if="TotalRows>20">
            <ul class="pagination  justify-content-end">
                <!-- <li class="page-item"><a class="page-link" href="#">Previous</a></li> -->
                <li class="page-item" v-for="(pag,index) in Totalpage" :key="'p'+index" v-if="index==0 && pag.url">
                    <router-link class="page-link"
                        :to="{name:'sonod',params:{name:$route.params.name,type:$route.params.type},query:{page:pag.url.split('?')[1].split('=')[1]}}"
                        v-html="pag.label"></router-link>
                </li>
                <li class="page-item" v-for="(pag,index) in Totalpage" :key="'i'+index"
                    :class="{active:pag.active,'disabled':pag.label=='...'}"
                    v-if="index!=0 && pag.label!='Next &raquo;'">
                    <router-link class="page-link"
                        :to="{name:'sonod',params:{name:$route.params.name,type:$route.params.type},query:{page:pag.label}}"
                        v-html="pag.label"></router-link>
                </li>
                <li class="page-item" v-for="(pag,index) in Totalpage" :key="'l'+index"
                    v-if="pag.label=='Next &raquo;'  && pag.url">
                    <router-link class="page-link"
                        :to="{name:'sonod',params:{name:$route.params.name,type:$route.params.type},query:{page:pag.url.split('?')[1].split('=')[1]}}"
                        v-html="pag.label"></router-link>
                </li>
                <!-- <li class="page-item"><a class="page-link" href="#">Next</a></li> -->
            </ul>
        </nav>

            </div>

            <div class="card-body table-responsive">
                <table class="table table-hover table-striped sonodTable">
                    <thead class="sonodThead">


                        <tr class="sonodTr">
                            <th class="sonodTh">রেজিস্ট্রেশন নাম্বার</th>
                            <th class="sonodTh">শিশুর নাম</th>
                            <th class="sonodTh">মাতার নাম</th>
                            <th class="sonodTh">পিতার নাম</th>
                            <th class="sonodTh">গ্রাম/মহল্লা</th>
                        </tr>




                    </thead>
                    <tbody class="sonodTbody">

                        <tr class="sonodTr" v-for="(item,index) in items" :key="item.id">
                            <td class="sonodTd">{{ item.id_no }}</td>
                            <!-- <td>{{ item.unioun_name }}</td> -->

                            <td class="sonodTd"><span v-if="$route.params.type=='approved'">{{ item.childs_name }}</span><span v-else>{{ item.name }}</span> </td>

                            <td class="sonodTd"><span v-if="$route.params.type=='approved'">{{ item.name }}</span><span v-else>{{ item.husband_name }}</span></td>

                            <td class="sonodTd"  v-if="$route.params.type=='approved'"><span>{{ item.husband_name }}</span></td>

                            <td class="sonodTd">{{ item.village }}</td>
                        </tr>



                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>
                <!-- <approve-component></approve-component> -->
            </div>
            <div class="card-footer">

                <nav aria-label="Page navigation example" v-if="TotalRows>20">
            <ul class="pagination  justify-content-end">
                <!-- <li class="page-item"><a class="page-link" href="#">Previous</a></li> -->
                <li class="page-item" v-for="(pag,index) in Totalpage" :key="'p'+index" v-if="index==0 && pag.url">
                    <router-link class="page-link"
                        :to="{name:'sonod',params:{name:$route.params.name,type:$route.params.type},query:{page:pag.url.split('?')[1].split('=')[1]}}"
                        v-html="pag.label"></router-link>
                </li>
                <li class="page-item" v-for="(pag,index) in Totalpage" :key="'i'+index"
                    :class="{active:pag.active,'disabled':pag.label=='...'}"
                    v-if="index!=0 && pag.label!='Next &raquo;'">
                    <router-link class="page-link"
                        :to="{name:'sonod',params:{name:$route.params.name,type:$route.params.type},query:{page:pag.label}}"
                        v-html="pag.label"></router-link>
                </li>
                <li class="page-item" v-for="(pag,index) in Totalpage" :key="'l'+index"
                    v-if="pag.label=='Next &raquo;'  && pag.url">
                    <router-link class="page-link"
                        :to="{name:'sonod',params:{name:$route.params.name,type:$route.params.type},query:{page:pag.url.split('?')[1].split('=')[1]}}"
                        v-html="pag.label"></router-link>
                </li>
                <!-- <li class="page-item"><a class="page-link" href="#">Next</a></li> -->
            </ul>
        </nav>
            </div>
        </div>



    </div>
</template>
<script>
export default {
    computed: {
    },
    created() {

    },
    data() {
        return {
            months:{
                January: {
                    en: 'January',
                    bn: 'জানুয়ারি'
                },
                February: {
                    en: 'February',
                    bn: 'ফেব্রুয়ারি'
                },
                March: {
                    en: 'March',
                    bn: 'মার্চ'
                },
                April: {
                    en: 'April',
                    bn: 'এপ্রিল'
                },
                May: {
                    en: 'May',
                    bn: 'মে'
                },
                June: {
                    en: 'June',
                    bn: 'জুন'
                },
                July: {
                    en: 'July',
                    bn: 'জুলাই'
                },
                August: {
                    en: 'August',
                    bn: 'আগস্ট'
                },
                September: {
                    en: 'September',
                    bn: 'সেপ্টেম্বর'
                },
                October: {
                    en: 'October',
                    bn: 'অক্টোবর'
                },
                November: {
                    en: 'November',
                    bn: 'নভেম্বর'
                },
                December: {
                    en: 'December',
                    bn: 'ডিসেম্বর'
                }
                },
            preLooding: true,
            nidverify: false,
            dobverify: false,
            buttonLoader: false,
            Type: '',
            sonod_id: '',
            Vaccination: '',
            editRoute: '',
            viewRoute: '',
            cancelRoute: '',
            approveRoute: '',
            approveType: '',
            payRoute: '',
            applicationRoute: '',
            applicationRoute2: '',
            items: [],
            f: {
                paymentType: '',
                district: '',
            },
            b: {
                reson: '',
            },
            infoModal: {
                id: 'info-modal',
                title: '',
                content: {},
                content_id: '',
            },
            prottoyonModal: {
                id: 'prottoyon-modal',
                title: '',
                content: {},
                content_id: '',
            },
            actionModal: {
                id: 'action-modal',
                title: '',
                status: '',
                content: {},
                content_id: '',
            },
            PerPageData: '20',
            TotalRows: '1',
            Totalpage: {},
            search:{
                month:'',
                from:'',
                to:'',
            },
            extraParams:'',
        }
    },
    watch: {
        '$route': {
            handler(newValue, oldValue) {
                this.uniondata();
                this.sonodList();
            },
            deep: true
        }
    },
    methods: {


        async sonodList(auto = false, value = '') {

            if (!auto) this.preLooding = true
            var page = 1;
            if (this.$route.query.page) page = this.$route.query.page;

            var params = '';

            if(value=='month'){
                params = `&month=${this.search.month}&dataType=month`;
                this.search.from = '';
                this.search.to = '';
            }else if(value=="dateToDate"){
                params = `&from=${this.search.from}&to=${this.search.to}&dataType=dateToDate`;
                this.search.month = '';
            }

            this.extraParams = params;



             var res = await this.callApi('get', `/api/sonod/list?page=${page}&stutus=${this.$route.params.type}&word=${this.$route.params.word}&unioun=${this.$localStorage.getItem('unioun')}${params}`, []);

                this.items = res.data.data
                this.TotalRows = `${res.data.total}`;
                console.log(res.data.total)
                this.Totalpage = res.data.links
                if (!auto) window.scrollTo(0, 0);
                if (!auto) this.preLooding = false


        },

    },
    mounted() {
            this.sonodList();

        setInterval(() => {
            this.sonodList(true,this.sonod_id)
        }, 300000);
    }
}
</script>
<style scoped>
th.position-relative {
    font-size: 13px;
}
th {
    font-size: 11px;
}
td {
    font-size: 12px !important;
}
li.page-item.active a {
    color: white !important;
}



button.btn.btn-info {
    font-size: 23px;
    margin-left: 10px;
}









</style>
