<template>
  <kalendar :configuration="calendar_settings" :appointments="appointments"/>
</template>

<script>
import { Kalendar } from "kalendar-vue";
import "kalendar-vue/dist/kalendar-vue.css";

export default {
  components: {
    Kalendar
  },
  data() {
    return {
      appointments: [],
      calendar_settings: {
        style: "material_design", // ['flat_design', 'material_design']
        view_type: "Month", // ['Month', 'Day']
        split_value: 20, // Value % 60 === 0
        cell_height: 20, // !isNaN(Value)
        scrollToNow: true, // Boolean
        current_day: new Date() // Valid date
      }
    };
  }
};
</script>

<style>
</style>
