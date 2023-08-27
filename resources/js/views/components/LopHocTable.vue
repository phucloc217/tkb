<template>
  <div class="card">
    <div class="card-header pb-0">
      <h6>Danh sách lớp học</h6>
      <argon-button color="success" size="sm" class="ms-auto">Thêm Lớp học</argon-button>
    </div>
    <div class="card-body px-0 pt-0 pb-2">
      <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
          <thead>
            <tr>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lớp học</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Khóa</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sĩ số</th>
              <th class="text-secondary opacity-7"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="lophoc, index  in listLopHoc">
              <td>
                <div class="d-flex px-2 py-1">

                  <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ lophoc.id }}</h6>
                    <p class="text-xs text-secondary mb-0">{{ lophoc.tenlop }}</p>
                  </div>
                </div>
              </td>
              <td>
                <p class="text-xs font-weight-bold mb-0">{{ lophoc.khoahoc }}</p>
              </td>
              <td class="align-middle text-center">
                <span class="text-secondary text-xs font-weight-bold">{{ lophoc.siso }}</span>
              </td>
              <td class="align-middle">
                <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                  data-original-title="Edit user">Chỉnh sửa</a>
              </td>
            </tr>


          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import ArgonButton from "@/components/ArgonButton.vue";
export default {
  name: "lophoc-table",
  components: {
    ArgonButton
  },
  data() {
    return {
      listLopHoc: {},
    }
  },
  methods: {
    async getLopHoc() {
      let _THIS = this;
      await axios.get(this.API_URL + '/lophoc')
        .then(function (response) {
          _THIS.listLopHoc=response.data
        })
        .catch(response => console.log(response));
    },
  },
  mounted() {
    this.getLopHoc();
  },
};
</script>
