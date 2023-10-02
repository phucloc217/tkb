<template>
  <div class="card">
    <div class="card-header pb-0">
      <div class="d-flex align-items-center">
        <h6>Danh sách phòng học</h6>
        <argon-button color="success" size="sm" class="ms-auto" data-bs-toggle="modal" data-bs-target="#exampleModal">Thêm
          Phòng học</argon-button>
      </div>
    </div>
    <div class="card-body px-0 pt-0 pb-2">
      <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
          <thead>
            <tr>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên phòng học</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Sức chứa</th>
              <th class="text-secondary opacity-7"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="phonghoc  in listPhongHoc">
              <td>
                <div class="d-flex px-2 py-1">

                  <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ phonghoc.tenphong }}</h6>
                  </div>
                </div>
              </td>
              <td>
                <p class="text-xs font-weight-bold mb-0 text-center">{{ phonghoc.succhua }}</p>
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
          <h5 class="modal-title" id="exampleModalLabel">Thêm phòng học</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="">
            <label for="example-text-input" class="form-control-label">Tên phòng</label>
            <input class="form-control" type="text" name="id" v-model="this.form.tenphong" />
          </div>
          <div class="">
            <label for="example-text-input" class="form-control-label">Sức chứa</label>
            <input class="form-control" type="number" name="siso" v-model="this.form.succhua" />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button type="button" class="btn btn-primary" @click="postPhongHoc()">Lưu</button>
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
  name: "phonghoc-table",
  components: {
    ArgonButton,
    ArgonInput
  },
  data() {
    return {
      listPhongHoc: {},
      form: {
        tenphong: '',
        succhua: 0
      },
    }
  },
  methods: {
    async getPhongHoc() {
      let _THIS = this;
      await axios.get(this.API_URL + '/phonghoc', {
        headers: {
          'Authorization': 'Token ' + window.sessionStorage.getItem('token'),
          'Content-Type': 'application/json; charset=utf-8',
          'Accept': 'application/json',
        }
      })
        .then(function (response) {
          _THIS.listPhongHoc = response.data
        })
        .catch(function (err) {
          // console.log(err)
          toast.error(err.response.data, { theme: 'colored' })
        });
    },
    async postPhongHoc() {
      let _THIS = this;
      await axios.post(this.API_URL + '/phonghoc', this.form)
        .then(function () {
          toast.success("Thêm phòng học thành công", { theme: 'colored' }),
            _THIS.form.tenphong = '',
            _THIS.form.succhua = 0
          _THIS.getPhongHoc();
        })
        .catch(function (err) {
          toast.error("Đã xảy ra lỗi", { theme: 'colored' })
        });
    },

    async deletePhongHoc(id) {
      await axios.delete(this.API_URL + '/phonghoc/' + id, { data: { id: id } })
        .then(function () {
          toast.success("Xóa phòng học thành công", { theme: 'colored' })
        })
        .catch(function (err) {
          console.log(err)
          toast.error("Đã xảy ra lỗi", { theme: 'colored' })
        });
    },
    btnDelete(id) {

      this.$swal({
        title: 'Xóa phòng học ',
        text: "Bạn sẽ không thể hoàn tác thao tác này",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Xóa',
        confirmButtonColor: '#00FFFF',
        cancelButtonText: 'Đóng',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          this.deletePhongHoc(id)
          this.getPhongHoc()
        }
      });
    }
  },
  mounted() {
    this.getPhongHoc();
  },
};
</script>
