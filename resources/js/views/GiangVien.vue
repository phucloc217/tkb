<template>
  <div class="py-4 container-fluid">
    <div class=" row">
      <div class="col-12">
        <GiangVienTableVue/>
      </div>
    </div>
  </div>
</template>

<script>
import GiangVienTableVue from "./components/GiangVienTable.vue"; ;

export default {
  name: "giangvien",
  components: {
    GiangVienTableVue,
  },
  data() {
    return {
      
    };
  },
};
</script>
