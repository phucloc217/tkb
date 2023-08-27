<template>
  <div class="card">
    <div class="card-header pb-0">
      <h6>Danh sách lớp học</h6>
      <argon-button color="success" size="sm" class="ms-auto" data-bs-toggle="modal" data-bs-target="#exampleModal">Thêm
        Lớp học</argon-button>
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
                <span class="m-3"> <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                    data-toggle="tooltip" data-original-title="Edit user">Chỉnh sửa</a></span>
                <span class="m-3 "> <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                    data-toggle="tooltip" data-original-title="Edit user">Xóa</a></span>

              </td>
            </tr>


          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Thêm lớp học</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="">
            <label for="example-text-input" class="form-control-label">Mã lớp</label>
            <argon-input type="text" value="" />
          </div>
          <div class="">
            <label for="example-text-input" class="form-control-label">Tên lớp</label>
            <argon-input type="text" value="" />
          </div>
          <div class="">
            <label for="example-text-input" class="form-control-label">Sĩ số</label>
            <argon-input type="number" value="" />
          </div>
          <div class="">
            <label for="example-text-input" class="form-control-label">Khóa học</label>
            <argon-input type="number" value="" />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button type="button" class="btn btn-primary">Lưu</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ArgonButton from "@/components/ArgonButton.vue";
import ArgonInput from "@/components/ArgonInput.vue";
export default {
  name: "lophoc-table",
  components: {
    ArgonButton,
    ArgonInput
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
          _THIS.listLopHoc = response.data
        })
        .catch(response => console.log(response));
    },
  },
  mounted() {
    this.getLopHoc();
  },
};
</script>
