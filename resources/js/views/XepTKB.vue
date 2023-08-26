<template>
  <div class="py-4 container-fluid">
    <div class=" row">
      <div class="col-12">
        <Calendar/>
      </div>
    </div>
  </div>
</template>

<script>
import Calendar from "./components/Calendar.vue"; ;

export default {
  name: "giangvien",
  components: {
    Calendar,
  },
  data() {
    return {
      
    };
  },
};
</script>
