<template>
    <div>
 <loader v-if="preLooding" object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#343a40" objectbg="#999793" opacity="80" name="circular"></loader>

<div class="breadcrumbs-area">
    <h3>Union List</h3>
    <ul>
        <li>
            <router-link :to="{name:'Dashboard'}">Home</router-link>
        </li>
        <li>Union List</li>
    </ul>
</div>




        <div class="card">
            <div class="card-header">
                <form class="d-flex" style="justify-content: space-evenly;" @submit.stop.prevent="onSubmit">
                    <div class="form-group m-0" style="width:48%">
                        <select class="form-control" v-model="f.paymentType" required>
                            <option value="">Select</option>
                            <option value="Postpaid">Postpaid</option>
                            <option value="Prepaid">Prepaid</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info" style="width:48%">Update all</button>

                </form>
            </div>
        <div class="card-body">


         <table class="table">
            <thead>

                <tr>
                    <th>নাম</th>
                    <th>ইউনিয়ন</th>
                    <th>উপজেলা</th>
                    <th>জেলা</th>
                    <th>Actions</th>
                </tr>

            </thead>

            <tbody>
                <tr v-for="(item,index) in items" :key="''+item.id">
                    <td>{{ item.full_name }}</td>
                    <td>{{ item.short_name_b }}</td>
                    <td>{{ item.thana }}</td>
                    <td>{{ item.district }}</td>
                    <td><router-link size="sm" :to="{ name: 'unionlistedit', params: { id: item.id } }"
                    class="btn btn-info mr-1 mt-1">
                    Edit
                </router-link></td>

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



    },
    created() {


    },
    data() {
        return {

            f: {
                paymentType: '',
                district: '',
            },


            preLooding:true,

            access:'',
            sortstatus:false,
            Filter:true,
            addNew:'',
            FilterOn:false,
            PerPage:false,
            SelectOption:false,
            AllUpdate:'/api/payment/update',
            deleteRoute:'',
            editRoute:'unionlistedit',
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
                // { key: 'id', label: '#', sortable: false },
                { key: 'full_name', label: 'নাম', sortable: true },
                { key: 'short_name_b', label: 'ইউনিয়ন', sortable: true },
                { key: 'thana', label: 'উপজেলা', sortable: true },
                { key: 'district', label: 'জেলা', sortable: true },



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

        // hello


      },
      deep: true



        }
    },

    methods: {


        sonodname(){


            this.preLooding = true
            var position = localStorage.getItem('position');
            var userid = localStorage.getItem('userid');
            // var thana = this.Users.thana
            // var district = this.Users.district
            axios.get(`/api/get/union/list?position=${position}&userid=${userid}`)
                .then(({ data }) => {
                    // console.log(data)
                  this.items = data
                  this.TotalRows = `${this.items.length}`;
                  this.preLooding = false
                })
                .catch()
        },

        async onSubmit() {

            this.f.district = this.Users.district;
            var res = await this.callApi('post', this.AllUpdate, this.f);
            this.$emit('event-name')
            // console.log(res)
            // this.getunionInfo();
            //     this.$router.push({ name: 'unionlist'})
            Notification.customSuccess('Payment Info Update Successfuly Done');


            },


    },
    mounted() {
    //    setTimeout(()=>{
        this.sonodname();

    //   }, 2000);
    }


}
</script>
