<template>
    <div class="row">
        <div class="mainBody col-md-9 mt-3">

            <h4 class="text-center" style="    background: #008000;
    color: white;
    padding: 12px 3px;">ই-নিলাম/ই-ইজারা সিস্টেম</h4>


<table class="table">

<thead>
<tr>
<th width="20%">বিজ্ঞপ্তি প্রকাশের তারিখ
</th>
<th width="60%">নিলাম/ইজারার বিবরণ</th>
<th width="20%">বিস্তারিত দেখুন </th>
</tr>
</thead>
<tbody>


<tr v-for="(tender,indexs) in tenders" :key="'tenders'+indexs">

<td>{{ dateformatGlobal(tender.noticeDate)[6] }}</td>

<td>{{ tender.tender_name }}</td>

<td><router-link class="btn btn-info" :to="{name:'tenderView',params:{id:tender.id}}">বিস্তারিত দেখুন</router-link></td>
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
