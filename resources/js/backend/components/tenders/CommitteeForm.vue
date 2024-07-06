

<template>
  <b-modal v-model="visible" title="Add Committee" @ok="handleSubmit">
    <b-form @submit.stop.prevent="handleSubmit">
      <b-form-group label="Name" label-for="name">
        <b-form-input id="name" v-model="form.name" required></b-form-input>
      </b-form-group>

      <b-form-group label="Position" label-for="position">
        <b-form-input id="position" v-model="form.position" required></b-form-input>
      </b-form-group>

      <b-form-group label="Phone" label-for="phone">
        <b-form-input id="phone" v-model="form.phone" required></b-form-input>
      </b-form-group>

      <b-form-group label="Password" label-for="pass">
        <b-form-input type="password" id="pass" v-model="form.pass" required></b-form-input>
      </b-form-group>

      <b-button type="submit" variant="primary">Submit</b-button>
    </b-form>
  </b-modal>
</template>

<script>
export default {
  props: {
    visible: {
      type: Boolean,
      required: true
    }
  },
  data() {
    return {
      form: {
        name: '',
        position: '',
        phone: '',
        pass: ''
      }
    };
  },
  methods: {
    handleSubmit() {
      this.$emit('submit', this.form);
      this.$emit('update:visible', false);
    }
  }
};
</script>
