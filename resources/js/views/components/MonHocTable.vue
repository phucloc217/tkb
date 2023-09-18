<template>
  <div class="card">
    <div class="card-header pb-0">
      <div class="d-flex align-items-center">
        <div class="col-8">
          <h6>Danh sách môn học</h6>
        </div>
        <div class="col-2">
          <select name="lophoc" id="" class="form-select" v-model="form.malop" @change="changeEventsSource">
            <option v-for="lophoc in listLopHoc" :value="lophoc.id">{{ lophoc.id }}</option>
          </select>
        </div>
        <div class="col-2 ms-2"><argon-button color="success" size="sm" class="ms-auto" data-bs-toggle="modal"
            data-bs-target="#exampleModal">Thêm môn học</argon-button>
        </div>
      </div>

    </div>
    <div class="card-body px-0 pt-0 pb-2">
      <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
          <thead>
            <tr>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên môn học</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Số tiết</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Còn lạỉ</th>
              <th class="text-secondary opacity-7"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="monhoc, index  in listMonHoc">
              <td>
                <div class="d-flex px-2 py-1">

                  <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ monhoc.tenmh }}</h6>
                    <p class="text-xs text-secondary mb-0">{{ monhoc.name }}</p>
                  </div>
                </div>
              </td>
              <td>
                <p class="text-xs font-weight-bold mb-0">{{ monhoc.sotiet }}</p>
              </td>
              <td class="align-middle text-center">
                <p class="text-xs font-weight-bold mb-0">{{ monhoc.conlai }}</p>
              </td>
              <td class="align-middle">
                <span class="m-3"> <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                    data-toggle="tooltip" data-original-title="Edit class">Chỉnh sửa</a></span>
                <span class="m-3 "> <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                    data-toggle="tooltip" data-original-title="Delete class" @click="btnDelete(monhoc.id)">Xóa</a></span>
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
          <h5 class="modal-title" id="exampleModalLabel">Thêm môn học</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="">
            <label for="example-text-input" class="form-control-label">Tên môn học</label>
            <input class="form-control" type="text" name="id" v-model="this.form.tenmh" />
          </div>

          <div class="">
            <label for="example-text-input" class="form-control-label">Số tiết</label>
            <input class="form-control" type="number" min="0" name="siso" v-model="this.form.sotiet" />
          </div>
          <div class="">
            <label for="example-text-input" class="form-control-label">Giảng viên</label>
            <select name="lophoc" id="" class="form-select" v-model="form.idgv" @change="changeEventsSource">
              <option v-for="giangvien in listGiangVien" :value="giangvien.id">{{ giangvien.id }} - {{ giangvien.name }}</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button type="button" class="btn btn-primary" @click="postMonHoc()">Lưu</button>
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
  name: "monhoc-table",
  components: {
    ArgonButton,
    ArgonInput
  },
  data() {
    return {
      listMonHoc: {},
      listLopHoc: {},
      listGiangVien: {},
      form: {
        tenmh: '',
        sotiet: 0,
        malop: '',
        idgv: null
      },
    }
  },
  methods: {
    async getMonHoc() {
      let _THIS = this;
      await axios.get(this.API_URL + '/monhoc/' + this.form.malop)
        .then(function (response) {
          _THIS.listMonHoc = response.data
        })
        .catch(function (err) {
          toast.error("Đã xảy ra lỗi", { theme: 'colored' })
        });
    },
    async getGiangVien() {
      let _THIS = this;
      await axios.get(this.API_URL + '/user')
        .then(function (response) {
          _THIS.listGiangVien = response.data
        })
        .catch(function (err) {
          toast.error("Đã xảy ra lỗi khi lấy danh sách Giảng viên", { theme: 'colored' })
        });
    },
    async postMonHoc() {
      let _THIS = this;
      await axios.post(this.API_URL + '/monhoc', this.form)
        .then(function () {
          toast.success("Thêm lớp học thành công", { theme: 'colored' }),
            _THIS.form.tenmh = '',
            _THIS.form.sotiet = 0,
            _THIS.form.giangvien = '',
            _THIS.getMonHoc();
        })
        .catch(function (err) {
          console.log(err)
          toast.error("Đã xảy ra lỗi", { theme: 'colored' })
        });
    },

    async deleteMonHoc(id) {
      await axios.delete(this.API_URL + '/monhoc/' + id, { data: { id: id } })
        .then(function () {
          toast.success("Xóa môn học thành công", { theme: 'colored' })
        })
        .catch(function (err) {
          toast.error("Đã xảy ra lỗi", { theme: 'colored' })
        });
    },
    btnDelete(id) {

      this.$swal({
        title: 'Xóa môn học ',
        text: "Bạn sẽ không thể hoàn tác thao tác này",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Xóa',
        confirmButtonColor: '#00FFFF',
        cancelButtonText: 'Đóng',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          this.deleteMonHoc(id)
          this.getMonHoc()
        }
      });
    },
    async getLopHoc() {
      let _THIS = this
      await axios.get(this.API_URL + '/lophoc')
        .then(function (response) {
          _THIS.listLopHoc = response.data
        })
        .catch(function (err) {
          if (err.data != null)
            toast.error("Không thể lấy danh sách lớp học", { theme: 'colored' })
        });
    },
    async changeEventsSource() {
      await this.getMonHoc()

    },
  },
  mounted() {
    this.getLopHoc();
    this.getGiangVien();
  },
};
</script>
