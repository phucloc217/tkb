<template>
  <div class="card">
    <div class="card-header pb-0">
      <div class="d-flex align-items-center">
        <h6>Danh sách lớp học</h6>
        <argon-button color="success" size="sm" class="ms-auto" data-bs-toggle="modal" data-bs-target="#exampleModal">Thêm
          Lớp học</argon-button>
      </div>
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
                    data-toggle="tooltip" data-original-title="Edit class">Chỉnh sửa</a></span>
                <span class="m-3 "> <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                    data-toggle="tooltip" data-original-title="Delete class" @click="btnDelete(lophoc.id)">Xóa</a></span>

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
            <input class="form-control" type="text" name="id" v-model="this.form.id" />
          </div>
          <div class="">
            <label for="example-text-input" class="form-control-label">Ngành</label>
            <select name="tenlop" id="tenlop" class="form-select" v-model="this.form.tenlop">
              <option value="Quản trị mạng máy tính">Quản trị mạng máy tính</option>
              <option value="Tin học văn phòng">Tin học văn phòng</option>
              <option value="Kĩ thuật lắp ráp & sửa chữa máy tính">Kĩ thuật lắp ráp & sửa chữa máy tính</option>
            </select>

          </div>
          <div class="">
            <label for="example-text-input" class="form-control-label">Sĩ số</label>
            <input class="form-control" type="number" name="siso" v-model="this.form.siso" />
          </div>
          <div class="">
            <label for="example-text-input" class="form-control-label">Khóa học</label>
            <input class="form-control" type="number" name="khoahoc" v-model="this.form.khoahoc" />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button type="button" class="btn btn-primary" @click="postLopHoc()">Lưu</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ArgonButton from "@/components/ArgonButton.vue";
import ArgonInput from "@/components/ArgonInput.vue";
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
export default {
  name: "lophoc-table",
  components: {
    ArgonButton,
    ArgonInput
  },
  data() {
    return {
      listLopHoc: {},
      form: {
        id: null,
        tenlop: null,
        siso: 0,
        khoahoc: 0
      },
    }
  },
  methods: {
    async getLopHoc() {
      let _THIS = this;
      await axios.get(this.API_URL + '/lophoc', {
        headers: {
          'Authorization': 'Token ' + window.sessionStorage.getItem('token'),
          'Content-Type': 'application/json; charset=utf-8',
          'Accept': 'application/json',
        }
      })
        .then(function (response) {
          _THIS.listLopHoc = response.data
        })
        .catch(function (err) {
          // console.log(err)
          toast.error("Đã xảy ra lỗi", { theme: 'colored' })
        });
    },
    async postLopHoc() {
      let _THIS = this;
      await axios.post(this.API_URL + '/lophoc', this.form)
        .then(function () {
          toast.success("Thêm lớp học thành công", { theme: 'colored' }),
            _THIS.form.id = null,
            _THIS.form.tenlop = null,
            _THIS.form.siso = 0,
            _THIS.form.khoahoc = 0
          _THIS.getLopHoc();
        })
        .catch(function (err) {
          console.log(err)
          toast.error("Đã xảy ra lỗi", { theme: 'colored' })
        });
    },

    async deleteLopHoc(id) {
      await axios.delete(this.API_URL + '/lophoc/' + id, { data: { id: id } })
        .then(function () {
          toast.success("Xóa lớp học thành công", { theme: 'colored' })
        })
        .catch(function (err) {
          console.log(err)
          toast.error("Đã xảy ra lỗi", { theme: 'colored' })
        });
    },
    btnDelete(id) {

      this.$swal({
        title: 'Xóa lớp ' + id,
        text: "Bạn sẽ không thể hoàn tác thao tác này",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Xóa',
        confirmButtonColor: '#00FFFF',
        cancelButtonText: 'Đóng',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          this.deleteLopHoc(id)
          this.getLopHoc()
          // this.$swal(
          //   'Deleted!',
          //   'Your file has been deleted.',
          //   'success'
          // )
        }
      });
    }
  },
  mounted() {
    this.getLopHoc();
  },
};
</script>
