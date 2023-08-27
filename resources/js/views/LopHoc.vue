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
import ArgonInput from "@/components/ArgonInput.vue";
export default {
  name: "lophoc",
  components: {
    LopHocTable,
    ArgonInput
  },
  data() {
    return {
      
    };
  },
};
</script>
