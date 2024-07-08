<template>
    <div>

      <loader v-if="loading" object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#343a40" objectbg="#999793" opacity="80" name="circular"></loader>

      <div class="breadcrumbs-area">
        <h3>Hat Bazar Select</h3>
        <ul>
          <li>
            <router-link :to="{ name: 'Dashboard' }">Home</router-link>
          </li>
          <li>Hat Bazar Select</li>
        </ul>
      </div>


      <div v-if="scheduleTime">
      <p><strong>দরপত্র আহবানের পর্যায়:</strong> {{ scheduleTime.stage_of_tender }}</p>
      <p><strong>দরপত্র সিডিউল বিক্রয়ের শুরুর তারিখ ও সময়:</strong> {{ formatBengaliDateTime(scheduleTime.form_buy_start) }}</p>
      <p><strong>দরপত্র সিডিউল বিক্রয়ের শেষ তারিখ ও সময়:</strong> {{ formatBengaliDateTime(scheduleTime.form_buy_end) }}</p>
      <p><strong>দরপত্র গ্রহণের শুরুর তারিখ ও সময়:</strong> {{ formatBengaliDateTime(scheduleTime.tender_start) }}</p>
      <p><strong>দরপত্র গ্রহণের শেষ তারিখ ও সময়:</strong> {{ formatBengaliDateTime(scheduleTime.tender_end) }}</p>
      <p><strong>দরপত্র বাক্স খোলার তারিখ ও সময়:</strong> {{ formatBengaliDateTime(scheduleTime.tender_open) }}</p>
    </div>

      <form @submit.prevent="submitForm">
        <table class="table">
          <thead>
            <tr>
                <th>Select</th>
                <th>ক্রমিক নং</th>
                <th>ইউনিয়নের নাম</th>
                <th>হাট বাজারের নাম</th>
                <th>বিগত অর্থ বছরের ইজারা মূলের গড়</th>
                <th>৬% বিত্তি</th>
                <th>ইজারা মূল্য</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in calendarItems" :key="index">
                <td>
                    <input type="checkbox" v-model="selectedItems" :value="item.id">
                </td>
                <td>{{ int_en_to_bn(index+1) }}</td>
                <td>{{ item.union_name }}</td>
                <td>{{ item.hat_name }}</td>
                <td>{{ int_en_to_bn(item.previous_ijara_price) }}</td>
                <td>{{ int_en_to_bn(item.six_percent_bitti) }}</td>
                <td>{{ int_en_to_bn(item.ijara_price) }}</td>

            </tr>
          </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </template>

  <script>
  export default {
    data() {
      return {
        scheduleTimeId: null,
        calenderId: null,
        calendarItems: [], // Fetch calendar items from your API
        selectedItems: [],
        scheduleTimes: [],

      };
    },

    computed: {
        scheduleTime() {
        return this.scheduleTimes.find(item => item.id == this.scheduleTimeId);
        }
    },
    created() {
      this.scheduleTimeId = this.$route.params.scheduleTimeId;
      this.calenderId = this.$route.params.calenderId;
      this.fetchCalendarItems();
    },
    methods: {
      fetchCalendarItems() {
        // Replace with your API call
        axios.get(`/api/tender-calenders/${this.calenderId}`)
          .then(response => {
            this.calendarItems = response.data.items;
            this.scheduleTimes = response.data.schedule_times;
          })
          .catch(error => {
            console.error('Error fetching calendar items:', error);
          });
      },
      submitForm() {
        const data = {
          scheduleTimeId: this.scheduleTimeId,
          calenderId: this.calenderId,
          selectedItems: this.selectedItems
        };
        // Replace with your API call
        axios.post('/api/add-hat-bazar', data)
          .then(response => {
            alert('Hat Bazar added successfully');
            this.$router.push({ name: 'tendercalender',params: { status: 'approved' } });
          })
          .catch(error => {
            console.error('Error adding Hat Bazar:', error);
          });
      }
    }
  };
  </script>
