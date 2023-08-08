<template>
    <div class="row">
        <div class="mainBody col-md-9 mt-3">

<h4 class="text-center">ইজারা</h4>

<table class="table">

<thead>
<tr>
<th width="20%">প্রকাশের তারিখ </th>
<th width="60%">বিষয় </th>
<th width="20%">দেখুন </th>
</tr>
</thead>
<tbody>


<tr v-for="(tender,indexs) in tenders" :key="'tenders'+indexs">

<td>{{ dateformatGlobal(tender.noticeDate)[6] }}</td>

<td>{{ tender.description }}</td>

<td><router-link class="btn btn-info" :to="{name:'tenderView',params:{id:tender.id}}">দেখুন</router-link></td>
</tr>



</tbody>

</table>











</div>
        <side-bar></side-bar>
    </div>
</template>
<script>
export default {
    data() {
        return {
            tenders:{}
        }
    },

    methods: {
        async getTender(){
            console.log(this.subdomaingetOwn)

            if (this.getType == 'Union') {
              var  unionname = this.getUnion.subdomainget;
                var res = await this.callApi('get',`/api/get/all/tender/list?union_name=${unionname}`,[]);
            }else{
                var res = await this.callApi('get',`/api/get/all/tender/list`,[]);
            }



        this.tenders = res.data;
        },
    },
    mounted() {
this.getTender();
    }
}
</script>
