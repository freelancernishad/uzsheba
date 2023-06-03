<template>
  <div class="RightSidebar mt-3" :class="ClassName">
                <div class="sidebarTitle mb-3 defaltColor" v-if="getType=='main'" >
                    <h4>উপদেষ্টা ও তত্ত্বাবধানে</h4>
                </div>
                <p class="sidebaruser text-center" v-if="getType=='main'">
                    <img width="70%" alt="" :src="$asseturl+'assets/img/DC-Panchagarh.png'" />
                </p>
                <div class="contactInfo text-center" v-if="getType=='main'" >
                    <span><b>জনাব মো: জহুরুল ইসলাম</b></span> <br />
                    <span><b>জেলা প্রশাসক ও জেলা ম্যাজিস্ট্রেট</b></span> <br />
                </div>


                <div class="sidebarTitle mb-3 defaltColor"  v-if="getType=='main'">
                    <h4>পরিকল্পনা ও বাস্তবায়নে</h4>
                </div>
                <p class="sidebaruser text-center"  v-if="getType=='main'">
                    <img width="70%" alt="" :src="$asseturl+'assets/img/uno-pic2.png'" />
                </p>
                <div class="contactInfo text-center"  v-if="getType=='main'">
                    <span><b> সোহাগ চন্দ্র সাহা</b></span> <br />
                    <span><b>উপজেলা নির্বাহী অফিসার</b></span> <br />
                </div>


                <div class="sidebarTitle mb-3 defaltColor"  v-if="getType=='Union'">
                        <h4>এক নজরে {{  getunionInfos.short_name_b  }} উপজেলা পরিষদ</h4>
                    </div>
                    <p class='sidebaruser text-center' v-if="getType=='Union'">
                        <img width="100%" height="100px" alt="" :src="getunionInfos.u_image"> </p>
                <div class="contactInfo text-center" v-if="getType=='Union'">
                    <span style='font-size:13px'>{{ getunionInfos.u_description }}</span> <br>




                </div>

                    <div class="sidebarTitle mb-3 defaltColor" v-if="getType=='Union'">
                        <h4>নোটিশ</h4>
                    </div>
                    <p class='sidebaruser text-center' v-if="getType=='Union'">
                    </p>
                <div class="contactInfo text-center" v-if="getType=='Union'">
                    <span style='font-size:13px'>{{ getunionInfos.u_notice }}</span> <br>

                </div>



                <div class="sidebarTitle mb-3 defaltColor">
                    <h4>জরুরি হটলাইন</h4>
                </div>

                <div class="column block" style="text-align: center;">
                    <img width="70%" :src="$asseturl+'assets/img/suport.jpg'" alt="" />
                </div>

                <div class="fb-page" data-href="https://www.facebook.com/unotetuliaofficial" data-width="350"
                    data-height="300" data-adapt-container-width="true" data-show-facepile="true"></div>

                <div id="fb-root"></div>

                <!-- <iframe
                    :src="getunionInfos.google_map"
                    allowfullscreen="" loading="lazy"></iframe> -->
            </div>
</template>
<script>
export default {
    props:{
        ClassName:{
            type:String,
            default:'col-md-3'
        }
    }
}
</script>
