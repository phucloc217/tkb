<template>
  <div class="py-4 container-fluid">
    <div class=" row">
      <div class="col-12">
        <MonHocTable/>
      </div>
    </div>
  </div>
</template>

<script>
import MonHocTable from "./components/MonHocTable.vue"; ;
import ArgonInput from "@/components/ArgonInput.vue";
export default {
  name: "monhoc",
  components: {
    MonHocTable,
    ArgonInput
  },
  data() {
    return {
      
    };
  },
};
</script>
