<template>
    <div>








    <div class="container">
      <loader v-if="loading" object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#343a40" objectbg="#999793" opacity="80" name="circular"></loader>

      <div class="breadcrumbs-area">
        <h3>{{ isNew ? 'Add' : 'Edit' }} Tender Calendar</h3>
        <ul>
          <li>
            <router-link :to="{ name: 'Dashboard' }">Home</router-link>
          </li>
          <li>
            <router-link :to="{ name: 'TenderCalenderList' }">Tenders List</router-link>
          </li>
          <li>{{ isNew ? 'Add' : 'Edit' }} Tender Calendar</li>
        </ul>
      </div>

      <div v-if="!loading">
        <!-- Tender Calendar Form -->
        <form @submit.prevent="handleSubmit">
          <div class="form-group">
            <label for="sorok_no">স্মারক নং</label>
            <input type="text" class="form-control" id="sorok_no" v-model="form.sorok_no">
          </div>
          <div class="form-group">
            <label for="bn_year">বাংলা সাল</label>
            <input type="text" class="form-control" id="bn_year" v-model="form.bn_year">
          </div>
          <div class="form-group">
            <label for="en_year">ইংরেজি সাল</label>
            <input type="text" class="form-control" id="en_year" v-model="form.en_year">
          </div>

          <!-- Tender Calendar Items Table -->
          <hr>
          <h2>হাট বাজারের তালিকা</h2>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>ক্রমিক নং</th>
                <th>ইউনিয়নের নাম</th>
                <th>হাট বাজারের নাম</th>
                <th>বিগত অর্থ বছরের ইজারা মূলের গড়</th>
                <th>৬% বিত্তি </th>
                <th>ইজারা মূল্য</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, index) in form.items" :key="index">
                <td>
                  {{ index+1 }}
                </td>
                <td>
                  <input type="text" class="form-control" v-model="item.union_name">
                </td>
                <td>
                  <input type="text" class="form-control" v-model="item.hat_name">
                </td>
                <td>
                  <input type="number" step="0.01" class="form-control" v-model="item.previous_ijara_price">
                </td>
                <td>
                  <input type="number" step="0.01" class="form-control" v-model="item.six_percent_bitti">
                </td>
                <td>
                  <input type="number" step="0.01" class="form-control" v-model="item.ijara_price">
                </td>
                <td>
                  <button type="button" class="btn btn-danger btn-sm" @click="removeItem(index)">Remove</button>
                </td>
              </tr>

              <tr>
                <td></td>
                <td>

                </td>
                <td>

                </td>
                <td>

                </td>
                <td>

                </td>
                <td>

                </td>
                <td>
                  <button type="button" class="btn btn-success btn-sm" @click="addNewItem">Add new item</button>
                </td>
              </tr>
            </tbody>
          </table>



          <!-- Tender Schedule Times Table -->
            <hr>
            <h2>Tender Schedule Times</h2>
            <table class="table table-striped">
            <thead>
                <tr>
                <th>Stage of Tender</th>
                <th>Form Buy Start</th>
                <th>Form Buy End</th>
                <th>Tender Start</th>
                <th>Tender End</th>
                <th>Tender Open</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(time, index) in form.scheduleTimes" :key="index">
                <td>
                    <input type="text" class="form-control" v-model="time.stage_of_tender">
                </td>
                <td>
                    <input type="datetime-local" class="form-control" v-model="time.form_buy_start">
                </td>
                <td>
                    <input type="datetime-local" class="form-control" v-model="time.form_buy_end">
                </td>
                <td>
                    <input type="datetime-local" class="form-control" v-model="time.tender_start">
                </td>
                <td>
                    <input type="datetime-local" class="form-control" v-model="time.tender_end">
                </td>
                <td>
                    <input type="datetime-local" class="form-control" v-model="time.tender_open">
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" @click="removeTime(index)">Remove</button>
                </td>
                </tr>
                <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <button type="button" class="btn btn-success btn-sm" @click="addNewTime">Add new time</button>
                </td>
                </tr>
            </tbody>
            </table>



          <div class="form-group col-md-12">
          <label for="">শর্তাবলী</label>
          <vue-editor v-model="form.rules" api-key="nhnny39zzu3w0euy077ojdf9gk1n3mjpkobk25i228rt3qkz" style="height:250px;" :init="tinyInt"></vue-editor>
        <!-- <textarea v-model="form.tender_roles" class="form-control" style="height:300px"></textarea> -->
        </div>




        <div class="form-group col-md-12">
          <label for="">অনুলিপি এবং অন্যান্য</label>
          <vue-editor v-model="form.onulipi" api-key="nhnny39zzu3w0euy077ojdf9gk1n3mjpkobk25i228rt3qkz" style="height:250px;" :init="tinyInt"></vue-editor>
        <!-- <textarea v-model="form.tender_roles" class="form-control" style="height:300px"></textarea> -->
        </div>




          <button type="submit" class="btn btn-primary">{{ isNew ? 'Submit' : 'Update' }}</button>
        </form>
      </div>
    </div>
</div>
  </template>

  <script>
  import axios from 'axios';

  export default {
    data() {
      return {
        loading: false,
        isNew: true,
        form: {

          sorok_no: '',
          bn_year: '',
          en_year: '',
          calender_id: '', // Update with actual value if applicable
          union: '', // Update with actual value if applicable
          dc_name: '',
          dc_signature: '',
          rules: '',
          onulipi: '',
          status: 'Active',

          items: [
            {
                id: '',
                union_name: '',
                hat_name: '',
                ijara_price: 0,
                previous_ijara_price: 0,
                six_percent_bitti: 0
            }
          ],
        scheduleTimes: [
                {
                    id: '',
                    stage_of_tender: '',
                    form_buy_start: '',
                    form_buy_end: '',
                    tender_start: '',
                    tender_end: '',
                    tender_open: ''
                }
            ]
        },
        tinyInt:
                {
                    plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
                    toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
                },
        serialCounter: 1,


      };
    },
    created() {
      // Check if editing an existing Tender Calendar
      const id = this.$route.params.id;
      if (id) {
        this.isNew = false;
        this.loadTenderCalendar(id);
      }
    },
    methods: {



      async handleSubmit() {
        try {
          this.loading = true;

          if (this.isNew) {
            // Add new Tender Calendar
            this.form.union = this.Users.unioun; // Replace with actual union value
            const res = await axios.post('/api/tender-calenders', this.form);
            console.log('Created:', res.data);
          } else {
            // Update existing Tender Calendar
            const res = await axios.post(`/api/tender-calenders/${this.form.id}`, this.form);
            console.log('Updated:', res.data);
          }

          this.$router.push({ name: 'tendercalender',params: { status: 'new' } });
        } catch (error) {
          console.error('Error:', error);
          // Handle error scenarios
        } finally {
          this.loading = false;
        }
      },
      async loadTenderCalendar(id) {
      try {
        const response = await axios.get(`/api/tender-calenders/${id}`);
        const data = response.data;

        this.form = {
          id: data.id,
          sorok_no: data.sorok_no,
          bn_year: data.bn_year,
          en_year: data.en_year,
          calender_id: data.calender_id,
          union: data.union,
          dc_name: data.dc_name,
          dc_signature: data.dc_signature,
          status: data.status,
          items: data.items.map(item => ({
            id: item.id,
            index_no: item.index_no,
            union_name: item.union_name,
            hat_name: item.hat_name,
            ijara_price: item.ijara_price,
            previous_ijara_price: item.previous_ijara_price,
            six_percent_bitti: item.six_percent_bitti
          }))
        };
      } catch (error) {
        console.error('Error loading Tender Calendar:', error);
        // Handle error scenarios
      }
    },
      addNewItem() {
        // Add new item to the form's items array
        this.form.items.push({
          index_no: this.serialCounter++,
          id: '',
          union_name: '',
          hat_name: '',
          ijara_price: 0,
          previous_ijara_price: 0,
          six_percent_bitti: 0
        });


      },
      removeItem(index) {
        // Remove item from form's items array
        this.form.items.splice(index, 1);
      },


      addNewTime() {
    // Add new time to the form's scheduleTimes array
    this.form.scheduleTimes.push({
      id: '',
      stage_of_tender: '',
      form_buy_start: '',
      form_buy_end: '',
      tender_start: '',
      tender_end: '',
      tender_open: ''
    });
  },
  removeTime(index) {
    // Remove time from form's scheduleTimes array
    this.form.scheduleTimes.splice(index, 1);
  }
  

    }
  };
  </script>

  <style>
  /* Add any custom styles here */
  </style>
