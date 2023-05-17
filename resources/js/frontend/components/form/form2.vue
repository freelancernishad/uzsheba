<template>
    <div>
        <loader v-if="preLooding" object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#343a40"
            objectbg="#999793" opacity="80" name="circular"></loader>


            <div class="row">
                <div class="mainBody col-md-12 mt-3">


                    <form @submit.stop.prevent="finalSubmit">

                    <div class="col-md-12">
                        <h6 class="serviceTitle position-relative text-center">ভবনের নকশা প্রাপ্তির আবেদন ফরম</h6>
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
                                                <input type="text" v-model="form.appicant_name" id="appicant_name" class="form-control" placeholder="" disabled readonly required >

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""  class="labelColor">পিতার নাম</label>
                                                <input type="text" v-model="form.applicant_father_name" id="applicant_father_name" class="form-control" placeholder="" disabled readonly required >

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
                        <input type="text" class="form-control" v-model="form.district" disabled readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="labelColor">উপজেলা/থানা</label>
                        <input type="text" class="form-control" v-model="form.upozila" disabled readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="labelColor">ইউনিয়ন</label>
                        <input type="text" class="form-control" v-model="form.union" disabled readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">ডাকঘর</label>
                        <input type="text" class="form-control" v-model="form.post" disabled readonly>
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
                </div>
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






                                </div>



                <div class="row">
                    <div class="col-md-12">
                        <div class="app-heading"> ইমারত নির্মাণ/পুকুর খনন/পাহাড় কর্তন এর তথ্য</div>
                    </div>

                    <div class="col-md-12">
                        <div class="text-heading"> যে জমিতে ইমারত নির্মাণ/পুকুর খনন/পাহাড় কর্তন করা হবে তাঁর বিবরণ</div>
                    </div>
                    <!-- col-md-4 -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="labelColor">সিটি কর্পোরেশন/পৌরসভা/আম/মহল্লা/ উন্নয়নকৃত এলাকার নাম </label>
                            <input type="text" v-model="form.building_construction['areaName']" class="form-control" >
                        </div>
                    </div>
                    <!-- col-md-4 -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="labelColor">দাগ ও খতিয়ান নং (জরিপ মোতাবেক)/প্লট নং</label>
                            <input type="text"  v-model="form.building_construction['dagKhotiyan']"   class="form-control" >
                        </div>
                    </div>
                    <!-- col-md-4 -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="labelColor"> মৌজার নাম / ব্লক নং/সেক্টর নং</label>
                            <input type="text"  v-model="form.building_construction['Mouja']"  class="form-control" >
                        </div>
                    </div>
                    <!-- col-md-4 -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="labelColor">ওয়ার্ড নং (প্রযোজ্য ক্ষেত্রে)</label>
                            <select  class="form-control"  v-model="form.building_construction['wordNo']">
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
                        </div>
                    </div>
                    <!-- col-md-4 -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="labelColor">রাস্তার নাম</label>
                            <input type="text"  class="form-control"  v-model="form.building_construction['rastarName']" >
                        </div>
                    </div>
                    <!-- col-md-4 -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="labelColor">সিট নং (প্রযোজ্য ক্ষেত্রে)</label>
                            <input type="text"  class="form-control"  v-model="form.building_construction['sitNo']" >
                        </div>
                    </div>
                    <!-- col-md-4 -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="labelColor">দাগে আবেদনকারী/আবেদনকারীগণের অংশের পরিমাণ</label>
                            <input type="text"  class="form-control"  v-model="form.building_construction['dageApplicantOngso']" >
                        </div>
                    </div>
                    <!-- col-md-4 -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="labelColor">আবেদনকারী/আবেদনকারীগণ কি সূত্রে সাইটের জমি অর্জন করিয়াছেন</label>
                            <input type="text"  class="form-control"  v-model="form.building_construction['jomirMakilType']" >
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="text-heading"> সাইটের বিবরণ</div>
                    </div>
                    <!-- col-md-4 -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="labelColor">সাইটের আয়তন (ক্ষেত্রফল)</label>
                            <input type="text"  class="form-control"  v-model="form.building_construction['siterAyoton']" >
                        </div>
                    </div>

                    <div class="col-md-12"></div>
                    <div class="col-md-12">
                        <div class="text-heading">সাইটের চৌহদ্দী (বাহুর পরিমাণ)</div>
                    </div>
                    <div class="col-md-12"></div>
                    <!-- col-md-3 -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="labelColor">উত্তরে</label>
                            <input type="text"  class="form-control"  v-model="form.building_construction['siterUttore']" >
                        </div>
                    </div>
                    <!-- col-md-3 -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="labelColor">দক্ষিণে</label>
                            <input type="text"  class="form-control"  v-model="form.building_construction['siterDokhine']" >
                        </div>
                    </div>
                    <!-- col-md-3 -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="labelColor">পূর্বে</label>
                            <input type="text"  class="form-control"  v-model="form.building_construction['siterPurbe']" >
                        </div>
                    </div>
                    <!-- col-md-3 -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="labelColor">পশ্চিমে</label>
                            <input type="text"  class="form-control"  v-model="form.building_construction['siterPoschime']" >
                        </div>
                    </div>


                    <div class="col-md-12"></div>
                    <div class="col-md-12">
                        <div class="text-heading">ইমারত দ্বারা সাইটের যে পরিমাণ স্থান আচ্ছাদিত হইবে তাহার বিশদ বিবরণ</div>
                    </div>
                    <div class="col-md-12"></div>
                    <!-- col-md-3 -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="labelColor">১ম তলা </label>
                            <input type="text"  class="form-control"  v-model="form.building_construction['protomTola']" >
                        </div>
                    </div>
                    <!-- col-md-3 -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="labelColor">অন্যান্য তলা </label>
                            <input type="text"  class="form-control"  v-model="form.building_construction['OnnannoTola']" >
                        </div>
                    </div>



                    <div class="col-md-12"></div>
                    <div class="col-md-12">
                        <div class="text-heading">সাইটের নিকটস্থ রাস্তার বিবরণ</div>
                    </div>
                    <div class="col-md-12"></div>
                    <!-- col-md-3 -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="labelColor">নাম</label>
                            <input type="text"  class="form-control"  v-model="form.building_construction['siterNikotName']" >
                        </div>
                    </div>
                    <!-- col-md-3 -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="labelColor">অবস্থান (কোনদিকে)</label>
                            <input type="text"  class="form-control"  v-model="form.building_construction['siterNikotObostan']" >
                        </div>
                    </div>
                    <!-- col-md-3 -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="labelColor">দূরত্ব</label>
                            <input type="text"  class="form-control"  v-model="form.building_construction['siterNikotDurotto']" >
                        </div>
                    </div>
                    <!-- col-md-3 -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="labelColor">বিস্তার</label>
                            <input type="text"  class="form-control"  v-model="form.building_construction['siterNikotBistar']" >
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="" class="labelColor">নিকটস্থ রাস্তা হইতে সাইটে যাতায়াতের উপায়</label>
                            <input type="text"  class="form-control"  v-model="form.building_construction['siterNikotJatayatUpay']" >
                        </div>
                    </div>




                    <div class="col-md-12"></div>
                    <div class="col-md-12">
                        <div class="text-heading">সাইটের বিভিন্ন দিকে যে পরিমাণ স্থান উন্মুক্ত রাখা হইবে</div>
                    </div>
                    <div class="col-md-12"></div>
                    <!-- col-md-3 -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="labelColor">উত্তর সীমানা হইতে</label>
                            <input type="text"  class="form-control"  v-model="form.building_construction['siterFakaUttorDike']" >
                        </div>
                    </div>
                    <!-- col-md-3 -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="labelColor">দক্ষিণ সীমানা হইতে</label>
                            <input type="text"  class="form-control"  v-model="form.building_construction['siterFakaDokhinDike']" >
                        </div>
                    </div>
                    <!-- col-md-3 -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="labelColor">পূর্ব সীমানা হইতে</label>
                            <input type="text"  class="form-control"  v-model="form.building_construction['siterFakaPurboDike']" >
                        </div>
                    </div>
                    <!-- col-md-3 -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="labelColor">পশ্চিম সীমানা হইতে</label>
                            <input type="text"  class="form-control"  v-model="form.building_construction['siterFakaPoschimDike']" >
                        </div>
                    </div>






                    <div class="col-md-12"></div>
                    <div class="col-md-12">
                        <div class="text-heading">সাইটের পূর্ব নির্মিত কাঁচা/পাকা ইমারতের বিবরণ (যদি থাকে)</div>
                    </div>
                    <div class="col-md-12"></div>
                    <!-- col-md-3 -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="labelColor">পূর্ব নির্মিত ইমারতের সংখ্যা ও তদ্বারা বেষ্টিত স্থানের পরিমাণ </label>
                            <input type="text"  class="form-control"  v-model="form.building_construction['PurbeImaroterSonkha']" >
                        </div>
                    </div>
                    <!-- col-md-3 -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="labelColor">প্রস্তাবিত ইমারত নির্মাণ অনুমোদিত হলে পূর্ব নির্মিত ইমারতের কোন অংশ ভাংতে হবে কিনা এবং হলে তদ্বারা স্থানের পরিমাণ </label>
                            <input type="text"  class="form-control"  v-model="form.building_construction['vagaStanerPoriman']" >
                        </div>
                    </div>




                    <div class="col-md-12"></div>
                    <div class="col-md-12">
                        <div class="text-heading">এলাকার বিভিন্ন সেবা-সুযোগের বিবরণ </div>
                    </div>
                    <div class="col-md-12"></div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="labelColor"> বিদ্যুৎ সরবরাহ লাইন আছে কিনা </label>
                            <select  class="form-control"  v-model="form.building_construction['BidudLIneAcheKina']" >
                                <option value="">নির্বাচন করুন</option>
                                <option>হ্যাঁ</option>
                                <option>না</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="labelColor"> পানি সরবরাহ লাইন আছে কিনা </label>
                            <select  class="form-control"  v-model="form.building_construction['paniLIneAcheKina']">
                                <option value="">নির্বাচন করুন</option>
                                <option>হ্যাঁ</option>
                                <option>না</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="labelColor">গ্যাস সরবরাহ লাইন আছে কিনা </label>
                            <select  class="form-control"  v-model="form.building_construction['gasLIneAcheKina']" >
                                <option value="">নির্বাচন করুন</option>
                                <option>হ্যাঁ</option>
                                <option>না</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="labelColor"> পয়ঃ নিষ্কাশন লাইন আছে কিনা </label>
                            <select  class="form-control"  v-model="form.building_construction['poyNiskasonLIneAcheKina']" >
                                <option value="">নির্বাচন করুন</option>
                                <option>হ্যাঁ</option>
                                <option>না</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="labelColor"> প্রস্তাবিত ইমারতের ক্ষেত্রে সেপ্টিক ট্যাংকের ব্যবস্থা আছে কিনা </label>
                            <select  class="form-control"  v-model="form.building_construction['tackLIneAcheKina']" >
                                <option value="">নির্বাচন করুন</option>
                                <option>হ্যাঁ</option>
                                <option>না</option>
                            </select>
                        </div>
                    </div>




                    <div class="col-md-12"></div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="labelColor"> প্রস্তাবিত ইমারত নির্মাণ/পুকুর খনন/পাহাড় কর্তন বা ধ্বংস সাধনের কাজ কখন শুরু হবে</label>
                            <input type="date"  class="form-control"  v-model="form.building_construction['startDate']" >
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="labelColor"> প্রস্তাবিত ইমারত নির্মাণ/পুকুর খনন/পাহাড় কর্তন বা ধ্বংস সাধনের উদ্দেশ্য</label>
                            <input type="text"  class="form-control"  v-model="form.building_construction['uddesso']" >
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="" class="labelColor"> অথরাইজড অফিসারের অনুমোদন ব্যতীত আবেদনকারী পূর্বে কোন ইমারত নির্মাণ/পুকুর খনন/পাহাড় কর্তন বা ধ্বংস সাধন করিয়া থাকিলে তজ্জন্য তাহার বিরুদ্ধে Building Construction Act, 1952 (E.B. Act II of 1953) এর অধীন নোটিশ জারী হইয়াছে কিনা</label>
                            <input type="text"  class="form-control"  v-model="form.building_construction['faltImarotTodontto']" >
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="" class="labelColor">প্রস্তাবিত ইমারত নির্মাণ/পুকুর খনন /পাহাড় কর্তন বা ধ্বংস সাধন সম্পর্কে আবেদনকারীর বিরুদ্ধে Building Construction Act, 1952 (E.B. Act II of 1953) এর section 12 এর অধীন কোন মামলা দায়ের হইয়াছে কিনা</label>
                            <input type="text"  class="form-control"  v-model="form.building_construction['mamlaTodontto']" >
                        </div>
                    </div>

                    <div class="col-md-12"></div>
                    <div class="col-md-12">
                        <div class="text-heading">প্রস্তাবিত পুকুর খনন/পাহাড় কর্তন বা ধ্বংস সাধনের স্থান হইতে নিকটবর্তী :- </div>
                    </div>
                    <div class="col-md-12"></div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="labelColor">রাস্তার দূরত্ব</label>
                            <input type="text"  class="form-control"  v-model="form.building_construction['rastarDurotto']" >
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="labelColor">ইমারতের দূরত্ব</label>
                            <input type="text"  class="form-control"  v-model="form.building_construction['imaroterDurotto']" >
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="labelColor">পয়ঃ নালার দূরত্ব</label>
                            <input type="text"  class="form-control"  v-model="form.building_construction['poyNalarDurotto']">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="labelColor">বিদ্যুৎ সরবরাহ লাইনের দূরত্ব</label>
                            <input type="text"  class="form-control"   v-model="form.building_construction['bidudLineDurotto']">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="labelColor">গ্যাস সরবরাহ লাইনের দূরত্ব</label>
                            <input type="text"  class="form-control"  v-model="form.building_construction['gasLineDurotto']" >
                        </div>
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
        sonod_name:'ভবনের নকশা',
        applicant_type:'',
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
        building_construction:{
                     "areaName":"",
                     "dagKhotiyan":"",
                     "Mouja":"",
                     "wordNo":"",
                     "rastarName":"",
                     "sitNo":"",
                     "dageApplicantOngso":"",
                     "jomirMakilType":"",
                     "siterAyoton":"",
                     "siterUttore":"",
                     "siterDokhine":"",
                     "siterPurbe":"",
                     "siterPoschime":"",
                     "protomTola":"",
                     "OnnannoTola":"",
                     "siterNikotName":"",
                     "siterNikotObostan":"",
                     "siterNikotDurotto":"",
                     "siterNikotBistar":"",
                     "siterNikotJatayatUpay":"",
                     "siterFakaUttorDike":"",
                     "siterFakaDokhinDike":"",
                     "siterFakaPurboDike":"",
                     "siterFakaPoschimDike":"",
                     "PurbeImaroterSonkha":"",
                     "vagaStanerPoriman":"",
                     "BidudLIneAcheKina":"",
                     "paniLIneAcheKina":"",
                     "gasLIneAcheKina":"",
                     "poyNiskasonLIneAcheKina":"",
                     "tackLIneAcheKina":"",
                     "startDate":"",
                     "uddesso":"",
                     "faltImarotTodontto":"",
                     "mamlaTodontto":"",
                     "rastarDurotto":"",
                     "imaroterDurotto":"",
                     "poyNalarDurotto":"",
                     "bidudLineDurotto":"",
                     "gasLineDurotto":""
                },
        land_copy:[[]],
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



    },
  },
  mounted() {
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


.text-heading {
    font-size: 21px;
    color: green;
    border-bottom: 2px solid green;
    text-align: center;
    margin-bottom: 25px;
}
</style>
