<template>
    <div>
        <loader v-if="preLooding" object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#343a40"
            objectbg="#999793" opacity="80" name="circular"></loader>


            <div class="row">
                <div class="mainBody col-md-12 mt-3">


                    <form @submit.stop.prevent="finalSubmit">

                    <div class="col-md-12">
                        <h6 class="serviceTitle position-relative text-center">গভীর/অগভীর নলকূপ স্থাপনের জন্য লাইসেন্স প্রাপ্তির আবেদন ফরম</h6>
                    </div>

                    <div class="col-md-12">


                            <div class="row">
                                <div class="col-md-12 text-center">
                                        <p>
                                            তফশিল - ২ এর ফরম-ক [বিধি ৪(১) দ্রষ্টব্য]<br>
                                        </p>
                                    </div>

                                <div class="col-md-12">
                                        <p>
                                        বরাবর,<br>
                                        চেয়ারম্যান,<br>
                                        উপজেলা পরিষদ, তেঁতুলিয়া, পঞ্চগড়।<br>
                                        </p>

                                </div>
                                <div class="col-md-12 form_title">
                                    <h5>আবেদনকারীর নামঃ</h5>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""  class="labelColor">আবেদনকারীর ধরণ</label>
                                        <select v-model="form.applicant_type" class="form-control" id="applicant_type" required>
                                            <option>একক ব্যক্তি</option>
                                            <option>সমবায় সমিতি/প্রতিষ্ঠান</option>
                                            <option>একটি গোষ্ঠী</option>
                                        </select>
                                    </div>
                                </div>




                                <div class="col-md-12" v-if="form.applicant_type=='একক ব্যক্তি'">
                                    <div class="row">


                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for=""  class="labelColor">জাতীয় পরিচয় নং</label>
                                                <input type="text" v-model="form.nid_no" id="nid_no" class="form-control" placeholder="" required >

                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for=""  class="labelColor">জন্ম তারিখ</label>
                                                <input type="date" v-model="form.dateOfBirth" id="nid_no" class="form-control" placeholder="" required >

                                            </div>
                                        </div>




                                        <div class="col-md-2" style="display: flex;justify-content: center;align-items: center;">
                                                <button type="button" @click="checkNID" class="btn btn-info">Check NID</button>
                                        </div>




                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""  class="labelColor">নাম</label>
                                                <input type="text" v-model="form.appicant_name" id="appicant_name" class="form-control" placeholder=""   required >

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""  class="labelColor">পিতার নাম</label>
                                                <input type="text" v-model="form.applicant_father_name" id="applicant_father_name" class="form-control" placeholder=""   required >

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12"  v-if="form.applicant_type=='সমবায় সমিতি/প্রতিষ্ঠান'">
                                    <div class="row">
                                        <div class="col-md-6 ">
                                            <div class="form-group">
                                                <label for=""  class="labelColor">সমিতি/প্রতিষ্ঠানের নাম</label>
                                                <input type="text" v-model="form.appicant_sumiti_name" id="appicant_sumiti_name" class="form-control" placeholder=""  >

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""  class="labelColor">রেজিস্ট্রেশন নম্বর</label>
                                                <input type="text" v-model="form.applicant_sumiti_registration_no" id="applicant_sumiti_registration_no" class="form-control" placeholder=""  >

                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""  class="labelColor">আবেদন করিবার জন্য ক্ষমতাপ্রাপ্ত প্রতিনিধির নাম</label>
                                                <input type="text" v-model="form.applicant_p_m_name" id="applicant_p_m_name" class="form-control" placeholder=""  >

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12"  v-if="form.applicant_type=='একটি গোষ্ঠী'">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""  class="labelColor">গোষ্ঠীর নাম</label>
                                                <input type="text" v-model="form.gostir_name" id="gostir_name" class="form-control" placeholder=""  >

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""  class="labelColor">আবেদন করিবার জন্য ক্ষমতাপ্রাপ্ত প্রতিনিধির নাম</label>
                                                <input type="text" v-model="form.applicant_g_p_m_name" id="applicant_g_p_m_name" class="form-control" placeholder=""  >

                                            </div>
                                        </div>
                                    </div>
                                </div>




                                <div class="col-md-12 form_title">
                                    <h5>আবেদনকারীর ঠিকানা</h5>
                                </div>





        <div class="col-md-12"  v-if="form.applicant_type=='একক ব্যক্তি'">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="labelColor">জেলা</label>
                        <input type="text" class="form-control" v-model="form.district"  >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="labelColor">উপজেলা/থানা</label>
                        <input type="text" class="form-control" v-model="form.upozila"  >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="labelColor">ইউনিয়ন</label>
                        <input type="text" class="form-control" v-model="form.union"  >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">ডাকঘর</label>
                        <input type="text" class="form-control" v-model="form.post"  >
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12"  v-else>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="labelColor">বিভাগ</label>

                        <select class='form-control'  id="division" v-model="Pdivision" @change="getdistrictFun" required>
                            <option value="">বিভাগ নির্বাচন করুন</option>
                            <option v-for="(div,indexx) in getdivisions" :key="'divisionss'+indexx" :value="div.id">{{ div.bn_name }}
                            </option>
                        </select>
                        <!-- <input type="text" class="form-control" v-model="form.applicant_present_district"> -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="labelColor">জেলা</label>
                        <select class='form-control' id="district" v-model="applicant_present_district" @change="getthanaFun" required>
                            <option value="">জেলা নির্বাচন করুন</option>
                            <option v-for="dist in getdistricts" :key="'dist'+dist.id" :value="dist.id">{{ dist.bn_name }}
                            </option>
                        </select>
                        <!-- <input type="text" class="form-control" v-model="form.applicant_present_district"> -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="labelColor">উপজেলা/থানা</label>

                        <select class='form-control'  id="thana" v-model="thana" @change="getuniounFun" required>
                            <option value="">উপজেলা নির্বাচন করুন</option>
                            <option v-for="thana in getthanas" :key="'thana'+thana.id" :value="thana.id">{{ thana.bn_name
                            }}</option>
                        </select>
                        <!-- <input type="text" class="form-control" v-model="form.applicant_present_Upazila"> -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="labelColor">ইউনিয়ন</label>
                        <select class='form-control'  id="thana" v-model="form.union"  required>
                            <option value="">ইউনিয়ন নির্বাচন করুন</option>
                            <option v-for="union in getuniouns" :key="'union'+union.id" :value="union.bn_name">{{ union.bn_name
                            }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">ডাকঘর</label>
                        <input type="text" class="form-control" v-model="form.post"  >
                    </div>
                </div>
                <!-- <div class="col-md-6">
                    <div class="form-group">
                        <label for="">ডাকঘর</label>
                        <select v-model="form.post" id="post" class="form-control" required >
                            <option value="">ডাকঘর নির্বাচন করুন</option>
                            <option value="বাংলাবান্ধা">বাংলাবান্ধা</option>
                            <option value="সিপাইপাড়া">সিপাইপাড়া</option>
                            <option value="তিরনইহাট">তিরনইহাট</option>
                            <option value="তেঁতুলিয়া">তেঁতুলিয়া</option>
                            <option value="আজিজনগর">আজিজনগর</option>
                            <option value="শালবাহান">শালবাহান</option>
                            <option value="মাঝিপাড়া">মাঝিপাড়া</option>
                            <option value="বুড়াবুড়ি">বুড়াবুড়ি</option>
                            <option value="ভজনপুর">ভজনপুর</option>
                            <option value="দেবনগর">দেবনগর</option>
                        </select>
                    </div>
                </div> -->
            </div>
        </div>



                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="labelColor">ওয়ার্ড নং</label>
                        <select v-model="form.wordNo" id="word_no" class="form-control" required>
                            <option value="">ওয়াড নং</option>
                            <option value="1">১</option>
                            <option value="2">২</option>
                            <option value="3">৩</option>
                            <option value="4">৪</option>
                            <option value="5">৫</option>
                            <option value="6">৬</option>
                            <option value="7">৭</option>
                            <option value="8">৮</option>
                            <option value="9">৯</option>

                        </select>
                        <!-- <input type="text" class="form-control" v-model="form.applicant_present_word_number"> -->
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="labelColor">গ্রাম/মহল্লা</label>
                        <input type="text" class="form-control" v-model="form.village" required>
                    </div>
                </div>




















                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""  class="labelColor">মোবাইল নম্বর</label>
                                        <input type="text" v-model="form.mobile_number" id="mobile_number"  minlength="11" maxlength="11" class="form-control" placeholder="" required >

                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""  class="labelColor">ইমেইল</label>
                                        <input type="email" v-model="form.email" id="email" class="form-control" placeholder=""  >

                                    </div>
                                </div>




                                <div class="col-md-12"></div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""  class="labelColor">প্রার্থীত নলকূপের শ্রেণি</label>
                                        <select v-model="form.nolkup_type" id="nolkup_type" class="form-control" required>
                                            <option value="">Select</option>
                                            <option>গভীর</option>
                                            <option>অগভীর</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""  class="labelColor">প্রার্থীত নলকূপের সাইজ</label>
                                        <select v-model="form.nolkup_size" id="nolkup_size" class="form-control" required>
                                            <option value="">Select</option>
                                            <option>০.৫ কিউসেক মিটার (৬ হেক্টর)</option>
                                            <option>১.০ কিউসেক মিট (১২ হেক্টর)</option>
                                            <option>১.৫ কিউসেক মিট (১৮ হেক্টর)</option>
                                            <option>২.০ কিউসেক মিট (২৪ হেক্টর)</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 form_title">
                                    <h5>নলকূপের দ্বারা সম্ভাব্য উপকৃত এলাকা এবং তথ্যাদি</h5>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">


                                        <textarea v-model="form.area_description" id="area_description" class="form-control" cols="30" rows="4"></textarea>


                                    </div>
                                </div>




                                <div class="col-md-12 form_title">
                                    <h5>নলকূপ স্থাপনের প্রস্তাবিত স্থান</h5>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""  class="labelColor">এলাকার নাম</label>
                                        <input type="text" v-model="form.area_name" id="area_name" class="form-control" placeholder="" required >

                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""  class="labelColor">মৌজার নাম</label>
                                        <input type="text" v-model="form.mouja_name" id="mouja_name" class="form-control" placeholder="" required >

                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""  class="labelColor">জে.এল নং </label>
                                        <input type="text" v-model="form.JL_No" id="JL_No" class="form-control" placeholder="" required >

                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""  class="labelColor">খতিয়ান নং </label>
                                        <input type="text" v-model="form.khotiyan_no" id="khotiyan_no" class="form-control" placeholder="" required >

                                    </div>
                                </div>




                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""  class="labelColor">দাগ নং </label>
                                        <input type="text" v-model="form.dag_NO" id="dag_NO" class="form-control" placeholder="" required >

                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""  class="labelColor">চাষাবাদকৃত জমির পরিমাণ </label>
                                        <input type="text" v-model="form.land_amount" id="land_amount" class="form-control" placeholder="" required >

                                    </div>
                                </div>




                                <div class="col-md-12 form_title">
                                    <h5>প্রস্তাবিত স্থান হতে নিকটবর্তী নলকূপের দূরত্ব</h5>
                                </div>





                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""  class="labelColor">নিকটবর্তী নলকূপের শ্রেণি</label>
                                        <select v-model="form.near_nolkup_type" id="near_nolkup_type" class="form-control" required>
                                            <option value="">Select</option>
                                            <option>গভীর</option>
                                            <option>অগভীর</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""  class="labelColor">উত্তর দিকে (মিটার )</label>
                                        <input type="text" v-model="form.near_nolkup_uttor" id="near_nolkup_uttor" class="form-control" placeholder="" required >

                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""  class="labelColor">দক্ষিণ দিকে (মিটার ) </label>
                                        <input type="text" v-model="form.near_nolkup_dokkhin" id="near_nolkup_dokkhin" class="form-control" placeholder="" required >

                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""  class="labelColor">পূর্ব দিকে (মিটার ) </label>
                                        <input type="text" v-model="form.near_nolkup_purbo" id="near_nolkup_purbo" class="form-control" placeholder="" required >

                                    </div>
                                </div>




                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""  class="labelColor">পশ্চিম দিকে (মিটার ) </label>
                                        <input type="text" v-model="form.near_nolkup_poscim" id="near_nolkup_poscim" class="form-control" placeholder="" required >

                                    </div>
                                </div>





                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""  class="labelColor">বৈদ্যুতিক সংযোগের দূরত্ব (মিটার ) </label>
                                        <input type="text" v-model="form.electricity_distance" id="electricity_distance" class="form-control" placeholder="" required >

                                    </div>
                                </div>




                                <div class="col-md-12"></div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""  class="labelColor">লাইসেন্স প্রদানের জন্য কোনো বিশেষ বিবেচনা (যদি থাকে তাহলে উল্লেখ্য করুন)</label>

                                        <textarea v-model="form.description" id="description" class="form-control" cols="30" rows="3"></textarea>


                                    </div>
                                </div>




                                <div class="col-md-6 d-none">
                                    <div class="form-group">
                                        <label for=""  class="labelColor">জমাকৃত ফি এর পরিমাণ </label>
                                        <input type="text" v-model="form.deposite_fee" id="deposite_fee" class="form-control" placeholder="" required >

                                    </div>
                                </div>




                                <div class="col-md-6  d-none">
                                    <div class="form-group">
                                        <label for=""  class="labelColor">জমাদানের তারিখ </label>
                                        <input type="date" v-model="form.deposite_date" id="deposite_date" class="form-control" placeholder="" required >

                                    </div>
                                </div>





                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""  class="labelColor">নলকূপ স্থাপনের জন্য প্রস্তাবিত স্থান/জমির মালিকানার ধরণ</label>
                                        <select v-model="form.owner_type" id="owner_type" class="form-control" required>
                                            <option value="">Select</option>
                                            <option>আবেদনকারীর নিজ নামে</option>
                                            <option>ওয়ারিশ/উত্তরাধিকার সূত্রে</option>
                                            <option>অন্যান্য</option>
                                        </select>
                                    </div>
                                </div>




                                <div class="col-md-12 form_title">
                                    <h5>আবেদনের সাথে দাখিলকৃত প্রয়োজনীয় কাগজপত্র</h5>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""  class="labelColor">আবেদনকারীর ছবি</label>


                                        <input type="file" class="custom-file-input" id="passport_size_mage" accept="image/*" @change="FileSelected($event, 'passport_size_mage')">
                                        <label class="custom-file-label" for="passport_size_mage">Choose file</label>
                                        <img :src="form.passport_size_mage" width="100px" alt="">


                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""  class="labelColor">জাতীয় পরিচয়পত্রের কপি</label>

                                        <input type="file" class="custom-file-input" id="nid_copy" accept="image/*" @change="FileSelected($event, 'nid_copy')">
                                        <label class="custom-file-label" for="nid_copy">Choose file</label>
                                        <img :src="form.nid_copy" width="100px" alt="">


                                    </div>
                                </div>









                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""  class="labelColor">খতিয়ানের কপি</label>
                                        <input type="file" class="custom-file-input" id="khotiyan_copy" accept="image/*" @change="FileSelected($event, 'khotiyan_copy')">
                                        <label class="custom-file-label" for="khotiyan_copy">Choose file</label>
                                        <img :src="form.khotiyan_copy" width="100px" alt="">

                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""  class="labelColor">ভূমি উন্নয়ন কর পরিশোধের কপি</label>
                                        <input type="file" class="custom-file-input" id="tax_copy" accept="image/*" @change="FileSelected($event, 'tax_copy')">
                                        <label class="custom-file-label" for="tax_copy">Choose file</label>
                                        <img :src="form.tax_copy" width="100px" alt="">


                                    </div>
                                </div>




                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""  class="labelColor">নকশা/মৌজা ম্যাপ</label>
                                        <input type="file" class="custom-file-input" id="map" accept="image/*" @change="FileSelected($event, 'map')" >
                                        <label class="custom-file-label" for="map">Choose file</label>
                                        <img :src="form.map" width="100px" alt="">


                                    </div>
                                </div>



                                <div class="col-md-6" v-if="form.owner_type=='ওয়ারিশ/উত্তরাধিকার সূত্রে'">
                                    <div class="form-group">
                                        <label for=""  class="labelColor">ওয়ারিশান সনদপত্রের কপি (প্রযোজ্য ক্ষেত্রে)</label>
                                        <input type="file" class="custom-file-input" id="wyarisan" accept="image/*" @change="FileSelected($event, 'wyarisan')">
                                        <label class="custom-file-label" for="wyarisan">Choose file</label>
                                        <img :src="form.wyarisan" width="100px" alt="">


                                    </div>
                                </div>

                                <div class="col-md-12 text-center">দলিলের কপি</div>


                                <div class="col-md-12" >
                                    <table class="table">
                                        <thead>
                                            <tr>
                                            <th width="75%">পাতা</th>
                                            <th width="25%"><button type="button" class="flex justify-start btn btn-info" @click="addMore()">যোগ করুন</button></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(lan, index) in form.land_copy" :key="index">
                                            <td>
                                                <div class="form-group">
                                                    <input type="file" class="form-control" accept="image/*" @change="FileSelectedLoop($event, index)" required>
                                                    <img :src="form.land_copy[index]" width="100px" alt="">
                                                </div>
                                        </td>
                                            <td><button type="button" class="ml-2 btn btn-danger" @click="remove(index)" v-show="index != 0">মুছন</button></td>
                                        </tr>
                                        </tbody>

                                    </table>

                                </div>




                                </div>
                                <div class="col-md-12 my-5 text-center">
                                    <input type="submit" value="দাখিল করুন" v-if="!submitLoad" class="btn btn-success">
                                    <span class="btn btn-info" v-else-if="submitLoad">অপেক্ষা করুন...</span>
                                </div>
                    </div>








                    </form>
                    </div>



                </div>


        <!-- Info modal -->
        <b-modal :id="infoModal.id" size="xl" :title="infoModal.title" ok-only ok-disabled no-close-on-esc
            no-close-on-backdrop>

<!--
            <div class="row">






<div class="col-md-4"><b>আইডি নং :</b> {{ form.id_no }}</div>
<div class="col-md-4"><b>গর্ভবতী মহিলার নাম :</b> {{ form.name }}</div>
<div class="col-md-4"><b>গর্ভবতী মহিলার জাতীয় পরিচয়পত্র :</b> {{ form.pregnant_woman_nid }}</div>
<div class="col-md-4"><b>স্বামীর নাম :</b> {{ form.husband_name }}</div>
<div class="col-md-4"><b>স্বামীর জাতীয় পরিচয়পত্র :</b> {{ form.husband_name_nid }}</div>
<div class="col-md-4"><b>মোবাইল নম্বর :</b> {{ form.mobile_no }}</div>
<div class="col-md-4"><b>বিভাগ :</b> {{ form.division }}</div>
<div class="col-md-4"><b>জেলা :</b> {{ form.district }}</div>
<div class="col-md-4"><b>উপজেলা/থানা :</b> {{ form.upazila }}</div>
<div class="col-md-4"><b>ইউনিয়ন :</b> {{ form.union }}</div>
<div class="col-md-4"><b>পোষ্ট অফিস :</b> {{ form.post_office }}</div>
<div class="col-md-4"><b>ওয়ার্ড নং :</b> {{ form.word_number }}</div>
<div class="col-md-4"><b>গ্রাম/মহল্লা :</b> {{ form.village }}</div>
<div class="col-md-4"><b>শেষ মাসিকের তারিখ :</b> {{ form.date_of_last_menstrual_period }}</div>
<div class="col-md-4"><b>সম্ভাব্য প্রসবের তারিখ :</b> {{ form.probable_date_of_delivery }}</div>
<div class="col-md-4"><b>গ্রাভিড (কত তম গর্ভ) :</b> {{ form.how_many_wombs }}</div>
<div class="col-md-4"><b>কত তম সন্তান :</b> {{ form.how_many_children }}</div>



</div> -->

            <form @submit.stop.prevent="finalSubmit" style="margin-top: 50px;">

                <div class="text-center" style="width:50%;margin:0 auto">
                    <h3>আপনার আবেদনটি সফল করার জন্য Confirm বাটন এ চাপ দিন</h3>
                    <button type="submit" class="btn btn-info" v-if="!submitLoad">Confirm</button>
                    <span class="btn btn-info" v-else-if="submitLoad">Please Wait...</span>
                </div>
            </form>

            <template #modal-footer>
                <div></div>
            </template>

        </b-modal>
    </div>
</template>
<script>
export default {
  data() {
    return {
      infoModal: {
        id: "info-modal",
        title: "",
        content: "",
        content_id: "",
      },
      preLooding: false,
      submitLoad: false,
      form: {
        unioun_name:'',
        sonod_name:'নলকূপ লাইসেন্স',
        applicant_type:'একক ব্যক্তি',
        appicant_name:'',
        applicant_father_name:'',
        appicant_sumiti_name:'',
        applicant_sumiti_registration_no:'',
        applicant_p_m_name:'',
        gostir_name:'',
        applicant_g_p_m_name:'',
        district:'',
        upozila:'',
        union:'',
        post:'',
        wordNo:'',
        village:'',
        mobile_number:'',
        email:'',
        nid_no:'',
        dateOfBirth:'',
        nolkup_type:'',
        nolkup_size:'',
        area_description:'',
        area_name:'',
        mouja_name:'',
        JL_No:'',
        khotiyan_no:'',
        dag_NO:'',
        land_amount:'',
        near_nolkup_type:'',
        near_nolkup_uttor:'',
        near_nolkup_dokkhin:'',
        near_nolkup_purbo:'',
        near_nolkup_poscim:'',
        electricity_distance:'',
        description:'',
        deposite_fee:'0',
        deposite_date:'',
        owner_type:'',
        passport_size_mage:'',
        nid_copy:'',
        land_copy:[''],
        khotiyan_copy:'',
        tax_copy:'',
        map:'',
        wyarisan:'',
        status:'Prepaid',
      },

      sameStatus: "",

      getdivisions: {},
      getdistricts: {},
      getthanas: {},
      getuniouns: {},

      getdivisionsPer: {},
      getdistrictsPer: {},
      getthanasPer: {},
      getuniounsPer: {},
      Pdivision: "",
      applicant_present_district: "",
      thana: "",

      nidform:{
        nidNumber:'',
        dateOfBirth:'',
      },


    };
  },
  watch: {
    $route: {
      handler(newValue, oldValue) {
        this.form.year = new Date().getFullYear();
        this.sonodname();
      },
      deep: true,
    },
  },

  methods: {

    async checkNID(){
        this.preLooding = true
        this.nidform['nidNumber'] = this.form.nid_no;
        this.nidform['dateOfBirth'] = this.form.dateOfBirth;

        var res = await this.callApi('post',`/api/citizen/information/nid`,this.nidform);
        console.log(res)

        if(res.data.status=='invaild dateOfBirth'){
            this.form.appicant_name = ''
            this.form.applicant_father_name = ''
        }else if(res.data.status=='found'){
            this.form.appicant_name = res.data.informations.fullNameBN
            this.form.applicant_father_name = res.data.informations.fathersNameBN
            this.form.district = res.data.informations.presentDistrict
            this.form.upozila = res.data.informations.presentThana
            this.form.union = res.data.informations.presentUnion
            this.form.post = res.data.informations.presentPost
            this.form.village = res.data.informations.presentVillage
            this.form.passport_size_mage = res.data.informations.photoUrl
        }else if(res.data.status=='not-found'){
            this.form.appicant_name = ''
        this.form.applicant_father_name = ''
        }else{
            this.form.appicant_name = ''
            this.form.applicant_father_name = ''
        }
        this.preLooding = false

    },




    FileSelected($event, parent_index) {
            let file = $event.target.files[0];
            if (file.size > 5048576) {
                Notification.image_validation();
            } else {
                let reader = new FileReader;
                reader.onload = event => {
                    this.form[parent_index] = event.target.result
                    // console.log(event.target.result);
                };
                reader.readAsDataURL(file)
            }
            //   console.log($event.target.result);
        },


        FileSelectedLoop($event, parent_index) {
            let file = $event.target.files[0];
            if (file.size > 5048576) {
                Notification.image_validation();
            } else {
                let reader = new FileReader;
                reader.onload = event => {
                    this.form['land_copy'][parent_index] = event.target.result
                    // console.log(event.target.result);
                };
                reader.readAsDataURL(file)
            }
            //   console.log($event.target.result);
        },


        addMore() {
            this.form.land_copy.push([]);
        },

        remove(index) {
            this.form.land_copy.splice(index, 1);
        },



    async getdivisionFun() {
            var res = await this.callApi('get', `/api/getdivisions`, []);
            this.getdivisions = res.data;
        },
        async getdistrictFun() {
            var res = await this.callApi('get', `/api/getdistrict?id=${this.Pdivision}`, []);
            this.getdistricts = res.data;
        },
        async getthanaFun() {
            var res = await this.callApi('get', `/api/getthana?id=${this.applicant_present_district}`, []);
            this.getthanas = res.data;
            var resOwn = await this.callApi('get', `/api/getdistrict?ownid=${this.applicant_present_district}`, []);
            this.form.district = resOwn.data.bn_name
        },
        async getuniounFun() {
            var ress = await this.callApi('get', `/api/getthana?ownid=${this.thana}`, []);
            // console.log(ress.data.bn_name);
            this.form.upozila = ress.data.bn_name;
            // this.getuniouns = ress.data;
            var res = await this.callApi('get', `/api/getunioun?id=${this.thana}`, []);
            this.getuniouns = res.data;
        },



    async onSubmit() {
      this.$root.$emit("bv::show::modal", this.infoModal.id);
    },
    async finalSubmit() {
      this.submitLoad = true;
      var res = await this.callApi("post", "/api/sonod/submit", this.form);
      var datas = res.data;

      if(res.status==201){
        window.location.href=`/l/f/${datas.id}?f=a`
      }



    //   Swal.fire({
    //     title: "অভিনন্দন",
    //     text: `আপনার আবেদনটি সফলভাবে দাখিল হয়েছে`,
    //     icon: "success",
    //     confirmButtonColor: "green",
    //     confirmButtonText: `আবেদনপত্র ডাউনলোড`,
    //     allowOutsideClick: false,
    //     allowEscapeKey: false,
    //   }).then(async (result) => {
    //     if (result.isConfirmed) {
    //     window.location.href=`/apllication/document/${datas.id}`
    //     } else if (result.isDenied) {

    //     } else if (result.isDismissed) {
    //       this.$router.push({ name: "home" });
    //     }
    //     this.submitLoad = false

    //   });



    },
  },
  mounted() {
    this.form.unioun_name = localStorage.getItem('unioun');
    this.getdivisionFun();
    this.form.deposite_date = this.dateformatGlobal()[0];
  },
};
</script>
<style scoped >
.app-heading {
  text-align: center;
  margin: 32px 0;
  font-size: 23px;
  border-bottom: 1px solid #159513;
  color: #ffffff;
  background: #255f95;
}

.form-pannel {
  border: 1px solid #159513;
  padding: 25px 25px 25px 25px;
}

.panel-heading {
  padding: 11px 0px;
  border-top-right-radius: 6px;
  border-top-left-radius: 6px;
  margin-top: 20px;
}

.form-pannel {
  border-bottom-left-radius: 6px;
  border-bottom-right-radius: 6px;
}

.dropdown-menu {
  z-index: 99999;
}

.labelColor {
  color: #493eff;
  font-weight: 600;
}
</style>


