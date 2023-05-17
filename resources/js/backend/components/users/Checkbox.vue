<template>

                            <!-- <multiselect v-model="vax.tikaname" :options="options" :multiple="true" required></multiselect> -->
                        <div class="form-check" >
                            <input class="form-check-input" :id="inputId" type="checkbox" :value="inputValue"  v-model="model">
                            <label class="form-check-label" :for="inputId" >
                                {{ label }}
                            </label>
                        </div>






</template>

<script>
export default {
  name: "Checkbox",
  props: {
    label: String,
    value: Array,
    inputValue: String,
    inputId: String,
  },
  computed: {
    model: {
      get() {
        return this.value;
      },
      set(value) {
        this.$emit("input", value);
      },
    },
  },
};
</script>
