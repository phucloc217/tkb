<template>
  <div class="py-4 container-fluid">
    <div class=" row">
      <div class="col-12">
        <LopHocTable/>
      </div>
    </div>
  </div>
</template>

<script>
import LopHocTable from "./components/LopHocTable.vue"; ;

export default {
  name: "lophoc",
  components: {
    LopHocTable,
  },
  data() {
    return {
      
    };
  },
};
</script>
