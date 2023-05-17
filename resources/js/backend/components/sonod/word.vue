<template>
    <div>

        <div class="breadcrumbs-area">
            <h3>আবেদনের তালিকা</h3>
            <ul>
                <li>
                    <router-link :to="{name:'Dashboard'}">ড্যাশবোর্ড</router-link>
                </li>
                <li>আবেদনের তালিকা</li>
            </ul>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">


                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="card-title">ওয়ার্ডের তালিকা</h5>

                                </div>





                                <div class="col-md-2 col-sm-3 col-4" v-for="word in words">
                                    <router-link :to="{name:'applicationlist',params:{word:word,type:$route.params.type}}" class="btn btn-info btn-lg"> {{ int_en_to_bn(word) }}নং ওয়ার্ড</router-link>
                                </div>





                            </div>
                        </div>
                    </div>
                </div>

            </div>
            </div>
            </div>
</template>


<script>
export default {
    data() {
        return {
            words:[]
        }
    },
    created() {
        this.words = this.getUsers.words;
    },
}
</script>


<style scoped>
    a.btn.btn-info.btn-lg {
        font-size: 26px;
        margin: 4px;
    }

    </style>
