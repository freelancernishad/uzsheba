<template>
    <div>
        <div class="row">
            <div class="mainBody col-md-9 mt-3">
                <div class="pmCover">
                    <!-- <vue-image-slider :images="imageArray" :intervalVal=5000 :width="width" :height="height"  /> -->
                    <vue-flux :options="vfOptions" :images="vfImages" :transitions="vfTransitions" ref="slider">
                        <template v-slot:preloader>
                            <flux-preloader />
                        </template>
                        <!-- <template v-slot:caption>
      <flux-caption />
   </template> -->
                        <!-- <template v-slot:controls>
      <flux-controls />
   </template> -->
                        <!-- <template v-slot:pagination>
      <flux-pagination />
   </template> -->
                        <!-- <template v-slot:index>
      <flux-index />
   </template> -->
                    </vue-flux>
                    <!--        <img width="100%" src="assets/img/National-Portal-Card-PM.jpeg" alt=""> --->
                </div>





                <div class="services mt-3">


                    <div class="row" v-if="getType=='main'" style="    justify-content: center;">
                        <div class="col-md-12">
                            <h6 class="serviceTitle position-relative defaltColor">
                                সেবাসমূহ
                            </h6>
                        </div>


                        <div class="col-lg-6 mt-3 mb-3 text-center"  @click="sendInfo('/application')" >
                            <div class="serviceBox">
                                <div class="serviceLogo">
                                    <img :src="$asseturl+'assets/img/Untitled-1-12.png'" width="150px" alt="" />
                                </div>
                                <div class="serviceTitle defaltTextColor">
                                    গভীর/অগভীর নলকূপ স্থাপনের লাইসেন্স
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mt-3 mb-3 text-center"  @click="sendInfo('/application2')" >
                            <div class="serviceBox">
                                <div class="serviceLogo">
                                    <img :src="$asseturl+'assets/img/5874269.png'" width="150px" alt="" />
                                </div>
                                <div class="serviceTitle defaltTextColor">
                                    ভবনের নকশা অনুমোদন

                                </div>
                            </div>
                        </div>


                        <router-link class="col-lg-6 mt-3 mb-3 text-center" :to="{name:'tenders'}">
                            <div class="serviceBox">
                                <div class="serviceLogo">
                                    <img :src="$asseturl+'assets/img/nilam.png'" width="200px" alt="" />
                                </div>
                                <div class="serviceTitle defaltTextColor">
                                    অনলাইন নিলাম

                                </div>
                            </div>
                        </router-link>






                    </div>


                    <div class="row" v-else style="    justify-content: center;">
                        <div class="col-md-12">
                            <h6 class="serviceTitle position-relative defaltColor">
                                সেবাসমূহ
                            </h6>
                        </div>


                        <router-link class="col-lg-6 mt-3 mb-3 text-center" :to="{ name: 'childApplication' }">
                            <div class="serviceBox">
                                <div class="serviceLogo">
                                    <img :src="$asseturl+'assets/img/Untitled-1-12.png'" width="150px" alt="" />
                                </div>
                                <div class="serviceTitle defaltTextColor">
                                    গভীর/অগভীর নলকূপ স্থাপনের লাইসেন্স
                                </div>
                            </div>
                        </router-link>

                        <router-link class="col-lg-6 mt-3 mb-3 text-center" :to="{ name: 'childApplication2' }">
                            <div class="serviceBox">
                                <div class="serviceLogo">
                                    <img :src="$asseturl+'assets/img/5874269.png'" width="150px" alt="" />
                                </div>
                                <div class="serviceTitle defaltTextColor">
                                    ভবনের নকশা অনুমোদন

                                </div>
                            </div>
                        </router-link>


                        <router-link class="col-lg-6 mt-3 mb-3 text-center" :to="{name:'tenders'}">
                            <div class="serviceBox">
                                <div class="serviceLogo">
                                    <img :src="$asseturl+'assets/img/nilam.png'" width="200px" alt="" />
                                </div>
                                <div class="serviceTitle defaltTextColor">
                                    অনলাইন নিলাম
                                </div>
                            </div>
                        </router-link>




                    </div>







<div class="row">

                         <div class="col-md-12">
                            <h6 class="serviceTitle position-relative defaltColor">
                                উপজেলা পরিষদ সেবা সিস্টেম
                            </h6>
                        </div>
                        <div class="col-md-12">
                            <p>
                                ডিজিটাল সেচ সেবা www.uzpseba.gov.bd প্রান্তিক পর্যায়ের কৃষকদেরকে ক্ষুদ্র সেচ কার্যক্রমের অংশ হিসেবে দ্রুত সময়ে সেবা প্রদান নিশ্চিতকরনের লক্ষ্যে উপজেলা প্রশাসন, তেঁতুলিয়া উদ্যোগে এবং উপজেলা সেচ কমিটি ও বাংলাদেশ কৃষি উন্নয়ন কর্পোরেশন (বিএডিসি) কর্তৃক অনলাইনে গভীর/অগভীর নলকূপ স্থাপনের লাইসেন্স প্রদানের নিমিত্ত গৃহীত একটি উদ্ভাবনী উদ্যোগ।
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <side-bar class-name="col-md-3"></side-bar>
        </div>

        <b-modal :id="actionModalhome.id" size="xl" title="ইউনিয়ন নির্বাচন করুন" ok-only>
                    <union-select :custom-url="actionModalhome.title" />
        </b-modal>

    </div>
</template>
<script>
import {
    VueFlux,
    FluxCaption,
    FluxControls,
    FluxIndex,
    FluxPagination,
    FluxPreloader,
} from "vue-flux";
import FlipCard from "./layouts/FlipCard.vue";
export default {
    created() {
        // if (!User.loggedIn()) {
        //     this.$router.push({ name: "/login" });
        // }
    },
    components: {
        VueFlux,
        FluxCaption,
        FluxControls,
        FluxIndex,
        FluxPagination,
        FluxPreloader,
        FlipCard,
    },
    data() {
        return {
            selectedUser: '',
            flipped: false,
            vfOptions: {
                autoplay: true,
            },
            vfImages: [
                this.$asseturl + "assets/img/padmabanner.jpeg",
                // this.$asseturl + "assets/img/slider2.jpg",
                // this.$asseturl + "assets/img/61ed07bbaac6b597183901.jpg",
                // this.$asseturl + "assets/img/slide1.jpeg",
                // this.$asseturl + "assets/img/slide2.jpeg",
                // this.$asseturl+"assets/img/padmabanner.jpeg",
                // this.$asseturl+"assets/img/slide12.jpg",
                // this.$asseturl+"assets/img/slide11.jpg",
                // "/assets/img/slider2.png",
            ],
            vfTransitions: [
                "blinds2d",
                "blinds3d",
                "blocks1",
                "blocks2",
                "book",
                "camera",
                "concentric",
                "cube",
                "explode",
                "fade",
                "fall",
                "kenburn",
                "round1",
                "round2",
                "slide",
                "swipe",
                "warp",
                "waterfall",
                "wave",
                "zip",
            ],
            actionModalhome: {
                id: 'action-modal-home',
                title: '',
                status: '',
                content: {},
                content_id: '',
            }
            //   vfCaptions: [],
        };
    },
    mounted() {
    },
    methods: {

        sendInfo(item, button) {


            this.actionModalhome.title = item;
            this.selectedUser = item;
            this.$root.$emit('bv::show::modal', this.actionModalhome.id, button)

            console.log(item)
        },
    },
};
</script>
<style lang="css" scoped>
a.prev {
    display: none !important;
}

a.next {
    display: none !important;
}
</style>
