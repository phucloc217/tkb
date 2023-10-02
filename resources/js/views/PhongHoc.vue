<template>
  <div class="py-4 container-fluid">
    <div class=" row">
      <div class="col-12">
        <PhongHocTable/>
      </div>
    </div>
  </div>
</template>

<script>
import PhongHocTable from "./components/PhongHocTable.vue"; ;
export default {
  name: "phonghoc",
  components: {
    PhongHocTable,
    
  },
  data() {
    return {
      
    };
  },
};
</script>
