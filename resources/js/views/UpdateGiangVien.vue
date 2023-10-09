<template>
  <main>

    <div class="py-4 container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0"><b>Sửa thông tin giảng viên</b></p>
                <argon-button color="success" size="sm" class="ms-auto" @click="validatePost()">Lưu</argon-button>
              </div>
            </div>
            <div class="card-body">
              <p class="text-uppercase text-sm">Thông tin giảng viên</p>
              <div class="row">
                <div class="col-md-6">
                  <label for="example-text-input" class="form-control-label">Họ và tên</label>
                  <input class="form-control" type="text" v-model="this.form.name"
                    v-bind:class="{ 'form-control': true, 'is-invalid': this.checkErrors.name, 'is-valid': !this.checkErrors.name && this.form.name != '' }" />
                </div>
                <div class="col-md-6">
                  <label for="example-text-input" class="form-control-label">Ngày sinh</label>
                  <input class="form-control" type="date" v-model="form.ngaysinh"
                    v-bind:class="{ 'form-control': true, 'is-invalid': this.checkErrors.ngaysinh, 'is-valid': !this.checkErrors.ngaysinh && this.form.ngaysinh != '' }" />
                </div>
                <div class="col-md-6">
                  <label for="example-text-input" class="form-control-label">Học hàm</label>
                  <select class="form-select" aria-label="Default select example" v-model="form.hocham">
                    <option value="K" selected>Không có</option>
                    <option value="PGS">Phó Giáo sư</option>
                    <option value="GS">Giáo sư</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="example-text-input" class="form-control-label">Học vị</label>
                  <select class="form-select" aria-label="Default select example" v-model="form.hocvi">
                    <option value="CN">Cử nhân / Kỹ sư</option>
                    <option value="THS">Thạc sĩ</option>
                    <option value="TS">Tiến sĩ</option>
                  </select>
                </div>
              </div>
              <hr class="horizontal dark" />
              <p class="text-uppercase text-sm">Thông tin liên hệ</p>
              <div class="row">
                <div class="col-md-12">
                  <label for="example-text-input" class="form-control-label">Địa chỉ</label>
                  <input type="text" class="form-control" v-model="form.diachi" />
                </div>
                <div class="col-md-4">
                  <label for="example-text-input" class="form-control-label">Số điện thoại</label>
                  <input type="tel" class="form-control" v-model="form.sdt"
                    v-bind:class="{ 'form-control': true, 'is-invalid': this.checkErrors.sdt, 'is-valid': !this.checkErrors.sdt && this.form.sdt != '' }" />
                </div>
                <div class="col-md-4">
                  <label for="example-text-input" class="form-control-label">Email</label>
                  <input type="email" class="form-control" v-model="form.email"
                    v-bind:class="{ 'form-control': true, 'is-invalid': this.checkErrors.email, 'is-valid': !this.checkErrors.email && this.form.email != '' }" />
                </div>
                <div class="col-md-4">
                  <label for="example-text-input" class="form-control-label">Ảnh</label>
                  <input class="form-control" ref="myFiles" type="file" id="formFile" @change="onFileChange">
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="row mt-2">
        <div class="col-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0"><b>Phân quyền</b></p>
                <argon-button color="success" size="sm" class="ms-auto" @click="patchPermisions">Lưu</argon-button>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-5">Tên quyền</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                      </th>

                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="permission, index  in listPermisions">
                      <td class="ps-5">
                        <p class="text-xs font-weight-bold mb-0 text-capitalize">{{ permission.name }}</p>
                      </td>
                      <td class="align-middle text-center">
                        <input type="checkbox" :value="permission.name" v-model="permissions">
                      </td>
                      
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import setTooltip from "@/assets/js/tooltip.js";
import ArgonInput from "@/components/ArgonInput.vue";
import ArgonButton from "@/components/ArgonButton.vue";
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import axios from "axios";
const body = document.getElementsByTagName("body")[0];
import {ref} from 'vue'
export default {
  name: "them-giang-vien",
  data() {
    return {
      showMenu: false,
      permissions:ref([]),
      user: '',
      form: {
        name: '',
        ngaysinh: '',
        hocham: 'K',
        hocvi: 'CN',
        diachi: '',
        sdt: '',
        email: '',
        anh: []
      },
      formPermissions:ref([]),
      checkErrors: {
        name: false,
        ngaysinh: false,
        diachi: false,
        sdt: false,
        email: false
      }
    };
  },
  components: { ArgonInput, ArgonButton },
  methods: {
    async getPermisions() {
      let _THIS = this
      await axios.get(this.API_URL + '/phanquyen')
        .then(function (res) {
          _THIS.listPermisions = res.data
        })
        .catch(function (err) {
          toast.error("Không thể lấy danh sách quyền", { theme: 'colored' })
        })
    },
    async patchPermisions(){
      let _THIS = this
      console.log(_THIS.permissions)
      let id = _THIS.$router.currentRoute.value.params.id
      await axios.patch(this.API_URL+'/phanquyen/'+id,{permissions:_THIS.permissions})
      .then(function (res){
        console.log(res)
          toast.success("Cập nhật quyền thành công",{ theme: 'colored' })
      })
      .catch(function(err){
        console.log(err)
        toast.error("Đã xảy ra lỗi",{ theme: 'colored' })
      })
    },
    async getUserPermisions() {
      let _THIS = this
      let id = _THIS.$router.currentRoute.value.params.id
      await axios.get(this.API_URL + '/phanquyen/'+id)
        .then(function (res) {
          _THIS.permissions = res.data
        })
        .catch(function (err) {
          console.log(err)
          toast.error("Không thể lấy danh sách quyền", { theme: 'colored' })
        })
    },

    async getGiangVien() {
      let _THIS = this
      let id = _THIS.$router.currentRoute.value.params.id
      await axios.get(this.API_URL + '/user/' + id)
        .then(function (response) {
          _THIS.form.name = response.data.name
          _THIS.form.ngaysinh = response.data.ngaysinh
          _THIS.form.hocham = response.data.hocham
          _THIS.form.hocvi = response.data.hocvi
          _THIS.form.diachi = response.data.diachi
          _THIS.form.sdt = response.data.sdt
          _THIS.form.email = response.data.email
        })
        .catch(function (err) {
          toast.error("Đã xảy ra lỗi", { theme: 'colored' })
        })
    },
    validatePost() {
      this.form.name == '' ? this.checkErrors.name = true : this.checkErrors.name = false
      this.form.ngaysinh == '' ? this.checkErrors.ngaysinh = true : this.checkErrors.ngaysinh = false
      this.form.email == '' ? this.checkErrors.email = true : this.checkErrors.email = false
      this.form.sdt == '' ? this.checkErrors.sdt = true : this.checkErrors.sdt = false
      if (this.checkErrors.name || this.checkErrors.ngaysinh || this.checkErrors.email || this.checkErrors.sdt) return;
      this.patchGiangVien();
    },
    async patchGiangVien() {
      let _THIS = this
      let id = _THIS.$router.currentRoute.value.params.id
      await axios.patch(this.API_URL + '/user/' + id, this.form, {
        headers: {
          'Content-Type': 'multipart/form-data',
          'Content-Type': 'application/json;charset=utf-8'
        }
      })
        .then(function (response) {
          toast.success("Cập nhật thành công", { theme: 'colored' })
        })
        .catch(function (err) {
          console.log(err)
          toast.error(err.response.data.message, { theme: 'colored' })
        });
    },
    onFileChange(e) {
      let files = e.target.files || e.dataTransfer.files;
      if (!files.length)
        return;
      this.createImage(files[0]);
    },
    createImage(file) {
      let reader = new FileReader();
      let vm = this;
      reader.onload = (e) => {
        vm.image = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    removeImage: function (e) {
      this.form.anh = '';
    }
  },

  mounted() {
    this.getGiangVien();
    this.getPermisions();
    this.getUserPermisions();
    setTooltip();
  },

};
</script>
