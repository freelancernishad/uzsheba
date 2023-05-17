<template>
<div>
  <single-select inline-template>
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <select-2 :options="options" name="test" v-model="selected"></select-2>
           <pre class="code">
              <p v-text="selected"></p>
            </pre>
        </div>
      </div>
    </div>
    </single-select>
    <multiple-select inline-template>
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <select-2 :options="options" name="test" v-model="selected" multiple=true></select-2>
            <pre class="code">
              <p v-text="selected"></p>
            </pre>
          </div>
        </div>
      </div>
    </multiple-select>
</div>
</template>



<script>

Vue.component("select-2", {
  template:
    '<select v-bind:name="name" class="form-control" v-bind:multiple="multiple"></select>',
  props: {
    name: "",
    options: {
      Object
    },
    value: null,
    multiple: {
      Boolean,
      default: false
    }
  },
  data() {
    return {
      select2data: []
    };
  },
  mounted() {
    this.formatOptions();
    let vm = this;
    let select = $(this.$el);
    select
      .select2({
        placeholder: "Select",
        theme: "bootstrap",
        width: "100%",
        allowClear: true,
        data: this.select2data
      })
      .on("change", function () {
        vm.$emit("input", select.val());
      });
    select.val(this.value).trigger("change");
  },
  methods: {
    formatOptions() {
      this.select2data.push({ id: "", text: "Select" });
      for (let key in this.options) {
        this.select2data.push({ id: key, text: this.options[key] });
      }
    }
  },
  destroyed: function () {
    $(this.$el).off().select2("destroy");
  }
});

const options = {
  apples: "green",
  bananas: "yellow",
  orange: "orange"
};

const singleSelect = Vue.component("single-select", {
  data() {
    return {
      selected: "orange",
      options
    };
  }
});

const multiSelect = Vue.component("multiple-select", {
  data() {
    return {
      selected: "apples",
      options
    };
  }
});

const app = new Vue({
  el: "#app"
});


</script>
