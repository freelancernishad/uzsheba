<template>
    <div>
    <div class="container">
      <loader v-if="loading" object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#343a40" objectbg="#999793" opacity="80" name="circular"></loader>

      <div class="breadcrumbs-area">
        <h3>Tender Calender List</h3>
        <ul>
          <li>
            <router-link :to="{ name: 'Dashboard' }">Home</router-link>
          </li>
          <li>Tender Calender List</li>
        </ul>
      </div>

      <div v-if="!loading">


        <div class="card">
            <div class="card-header">
                <router-link :to="{ name: 'TenderCalenderForm' }" class="btn btn-info" >তৈরি করুন</router-link>
            </div>
        <div class="card-body">

        <table class="table table-striped">
          <thead>
            <tr>
              <th>Sorok No</th>
              <th>BN Year</th>
              <th>EN Year</th>
              <th>Calender ID</th>
              <th>Union</th>
              <th>DC Name</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="calender in calenders" :key="calender.id">
              <td>{{ calender.sorok_no }}</td>
              <td>{{ calender.bn_year }}</td>
              <td>{{ calender.en_year }}</td>
              <td>{{ calender.calender_id }}</td>
              <td>{{ calender.union }}</td>
              <td>{{ calender.dc_name }}</td>
              <td>{{ calender.status }}</td>
              <td>

                <button class="btn btn-info btn-sm" @click="showCommitteeForm(calender.id)" v-if="$route.params.status=='new'">মূল্যায়ন কমিটি তৈরি করুন</button>
                <button class="btn btn-info btn-sm" @click="showCommittee(calender.teams)" v-else>মূল্যায়ন কমিটি দেখুন</button>
                <button class="btn btn-success btn-sm" @click="showModal(calender.items)">হাট বাজারের তালিকা</button>

                   
                <button class="btn btn-info btn-sm" v-if="$route.params.status=='pending'" @click="confirmApprove(calender.id)">Approve</button>


                <button class="btn btn-info btn-sm" v-if="$route.params.status=='new'" @click="editCalender(calender.id)">Edit</button>

                <button class="btn btn-danger btn-sm" v-if="$route.params.status=='new'" @click="confirmDelete(calender.id)">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
</div>

</div>





<!-- Modal -->
<b-modal size="lg" v-model="modalVisible" title="হাট বাজারের তালিকা" >
  <div>
    <table class="table">
      <thead>
        <tr>
            <th>ক্রমিক নং</th>
            <th>ইউনিয়নের নাম</th>
            <th>হাট বাজারের নাম</th>
            <th>বিগত অর্থ বছরের ইজারা মূলের গড়</th>
            <th>৬% বিত্তি </th>
            <th>ইজারা মূল্য</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in selectedTenderCalendar" :key="index">
          <td>{{ index+1 }}</td>
          <td>{{ item.union_name }}</td>
          <td>{{ item.hat_name }}</td>
          <td>{{ item.previous_ijara_price }}</td>
          <td>{{ item.six_percent_bitti }}</td>
          <td>{{ item.ijara_price }}</td>
        </tr>
      </tbody>
    </table>
  </div>
      <!-- Modal Footer Slot -->
      <template #modal-footer>
        <button class="btn btn-primary" @click="handleCloseModal">Close</button>
      </template>
</b-modal>



<!-- Modal -->
<b-modal size="lg" v-model="committesModalVisible" title="মূল্যায়ন কমিটি" >
  <div>
    <table class="table">
      <thead>
        <tr>
            <th>নাম</th>
            <th>পদবি</th>
            <th>মোবাইল</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(committee, index) in committes" :key="index">
          <td>{{ committee.name }}</td>
            <td>{{ committee.position }}</td>
            <td>{{ committee.phone }}</td>
        </tr>
      </tbody>
    </table>
  </div>
      <!-- Modal Footer Slot -->
      <template #modal-footer>
        <button class="btn btn-primary" @click="handleCloseModal">Close</button>
      </template>
</b-modal>








  <b-modal size="lg" v-model="committeeFormVisible" title="Add Committees">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>নাম</th>
                <th>পদবি</th>
                <th>মোবাইল</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="index in 5" :key="index">
                <td>
                  <input type="text" class="form-control" v-model="forms[index].name" required>
                </td>
                <td>
                  <input type="text" class="form-control" v-model="forms[index].position" required readonly disabled >
                </td>
                <td>
                  <input type="text" class="form-control" v-model="forms[index].phone" required>
                </td>

              </tr>
            </tbody>
          </table>

          <button type="button" class="btn btn-primary" v-if="loading">Please Wait....</button>
          <button type="button" class="btn btn-primary" v-else @click="handleCommitteeFormSubmit">Submit</button>

                <!-- Modal Footer Slot -->
      <template #modal-footer>
        <button class="btn btn-primary" @click="handleClose">Close</button>
      </template>
  </b-modal>



</div>

  </template>

  <script>

  export default {

    data() {
      return {
        approvedata:{},
        committeeFormVisible: false,
        loading: true, // Set to true initially to show the loader
        calenders: [],
        tender_calender_id:'',
        forms: {
        1: { name: '', position: 'সভাপতি', phone: '', pass: '' },
        2: { name: '', position: 'সদস্য', phone: '', pass: '' },
        3: { name: '', position: 'সদস্য', phone: '', pass: '' },
        4: { name: '', position: 'সদস্য', phone: '', pass: '' },
        5: { name: '', position: 'সদস্য সচিব', phone: '', pass: '' }
      },
      submittedCommittees: [], // Array to store submitted committees


      form:{},
      committes: {},
      committesModalVisible: false,


        modalVisible: false,
        selectedTenderCalendar: {} // Placeholder for selected tender calendar data
      };
    },
    created() {
      this.fetchCalenders();
    },

    watch: {
        '$route':  {
            handler(newValue, oldValue) {
              this.fetchCalenders();

            },
        deep: true
        }
    },
    methods: {
        showCommitteeForm(id) {
            this.tender_calender_id = id
            this.committeeFormVisible = true;
        },


        handleClose() {
            this.tender_calender_id = ''
            this.committeeFormVisible = false;
        },



        handleCommitteeFormSubmit() {
            this.loading = true;
            this.form['tender_calender_id'] = this.tender_calender_id
            this.form['items'] = this.forms

      // Handle form data submission
      axios.post('/api/tender-teams', this.form)
        .then(response => {
          console.log('Form submitted:', response.data);
          // Optionally, refresh the data or give feedback to the user
          this.committeeFormVisible = false;
          this.fetchCalenders();
        })
        .catch(error => {
          console.error('Error submitting form:', error);
        });
    },

        showModal(items) {
            // Example: Fetch or set selected tender calendar data before showing modal
            this.selectedTenderCalendar = items;
            this.modalVisible = true; // Show the modal
        },

        showCommittee(items) {
            // Example: Fetch or set selected tender calendar data before showing modal
            this.committes = items;
            this.committesModalVisible = true; // Show the modal
        },


        handleCloseModal() {
            this.modalVisible = false; // Close the modal
            },


      fetchCalenders() {
        this.loading = true;
        var status = 'new';
        if(this.$route.params.status){
          status = this.$route.params.status;
        }
        axios.get(`/api/tender-calenders?status=${status}`)
          .then(response => {
            this.calenders = response.data;
            this.loading = false; // Hide the loader once data is fetched
          })
          .catch(error => {
            console.error('There was an error fetching the calenders:', error);
            this.loading = false; // Hide loader in case of error too
          });
      },
      editCalender(id) {
            // Redirect to edit route with the calender ID
            this.$router.push({ name: 'TenderCalenderedit', params: { id: id } });
        },
        confirmDelete(id) {
      // Show confirmation dialog before deletion
      Swal.fire({
        title: 'Confirm Deletion',
        text: 'Are you sure you want to delete this calendar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545', // Red color for confirmation button
        cancelButtonColor: '#6c757d', // Grey color for cancel button
        confirmButtonText: 'Confirm Delete'
      }).then((result) => {
        if (result.isConfirmed) {
          // User confirmed deletion, proceed with deleteCalender()
          this.deleteCalender(id);
        } else {
          // User canceled deletion
          Swal.fire('Cancelled', 'Deletion has been cancelled.', 'info');
        }
      });
    },
    deleteCalender(id) {
      // Perform deletion request
      axios.delete(`/api/tender-calenders/${id}`)
        .then(response => {
          // Deletion successful, show success message
          Swal.fire('Deleted!', 'The calendar has been deleted.', 'success');
          // Optionally, perform any post-deletion actions (e.g., refresh data)
          this.fetchCalenders();
        })
        .catch(error => {
          // Deletion failed, show error message
          Swal.fire('Error', 'There was an error deleting the calendar.', 'error');
          console.error('Error deleting calendar:', error);
        });
    },        
    
    
    
    
    confirmApprove(id) {
      // Show confirmation dialog before deletion
      Swal.fire({
        title: 'Confirm Approve',
        text: 'Are you sure you want to Approve this calendar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545', // Red color for confirmation button
        cancelButtonColor: '#6c757d', // Grey color for cancel button
        confirmButtonText: 'Confirm Approve'
      }).then((result) => {
        if (result.isConfirmed) {
          // User confirmed deletion, proceed with deleteCalender()
          this.ApproveCalender(id);
        } else {
          // User canceled deletion
          Swal.fire('Cancelled', 'Approve has been cancelled.', 'info');
        }
      });
    },
    ApproveCalender(id) {

        this.approvedata['dc_name'] = this.Users.name;
        this.approvedata['dc_signature'] = this.Users.signature;

      // Perform deletion request
      axios.post(`/api/tender-calenders/approve/${id}`,this.approvedata)
        .then(response => {
          // Deletion successful, show success message
          Swal.fire('Deleted!', 'The calendar has been deleted.', 'success');
          // Optionally, perform any post-deletion actions (e.g., refresh data)
          this.fetchCalenders();
        })
        .catch(error => {
          // Deletion failed, show error message
          Swal.fire('Error', 'There was an error deleting the calendar.', 'error');
          console.error('Error deleting calendar:', error);
        });
    },
    }
  };
  </script>

  <style>
  /* Add any custom styles here */
  </style>
