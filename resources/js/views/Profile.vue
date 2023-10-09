<template>
  <main>
    <div class="container-fluid">
      <div class="page-header min-height-300" style="
            background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');
            margin-right: -24px;
            margin-left: -34%;
          ">
        <span class="mask bg-gradient-success opacity-6"></span>
      </div>
      <div class="card shadow-lg mt-n6">
        <div class="card-body p-3">
          <div class="row gx-4">
            <div class="col-auto">
              <div class="avatar avatar-xl position-relative">
                <img src="../assets/img/team-1.jpg" alt="profile_image" class="shadow-sm w-100 border-radius-lg" />
              </div>
            </div>
            <div class="col-auto my-auto">
              <div class="h-100">
                <h5 class="mb-1">Nguyễn Phúc Lộc</h5>
                <p class="mb-0 font-weight-bold text-sm">Giảng viên</p>
              </div>
            </div>
            <div class="mx-auto mt-3 col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0">
              <div class="nav-wrapper position-relative end-0">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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
                  <input class="form-control" type="text" v-model="form.name"
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
                <!-- <div class="col-md-4">
                  <label for="example-text-input" class="form-control-label">Ảnh</label>
                  <input class="form-control" ref="myFiles" type="file" id="formFile" @change="onFileChange">
                </div> -->
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </main>
</template>

<script>
import setNavPills from "@/assets/js/nav-pills.js";
import setTooltip from "@/assets/js/tooltip.js";
import ArgonInput from "@/components/ArgonInput.vue";
import ArgonButton from "@/components/ArgonButton.vue";
import { ref } from 'vue'
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
const body = document.getElementsByTagName("body")[0];

export default {
  name: "profile",
  data() {
    return {
      showMenu: false,
      form: {
        name: '',
        ngaysinh: '',
        hocham: 'K',
        hocvi: 'CN',
        diachi: '',
        sdt: '',
        email: ''
      },
      formPermissions: ref([]),
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
    async getUserInfo() {
      let _THIS = this
      let userID = window.sessionStorage.getItem('userID')
      axios.get(this.API_URL + '/user/' + userID)
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
          console.log(err)
        })
    },
    async patchGiangVien() {
      let _THIS = this
      let id = window.sessionStorage.getItem('userID')
      await axios.patch(this.API_URL + '/user/' + id, this.form, {
        headers: {
          'Content-Type': 'multipart/form-data',
          'Content-Type': 'application/json;charset=utf-8'
        }
      })
        .then(function (response) {
          console.log(response)
          toast.success("Cập nhật thành công", { theme: 'colored' })
        })
        .catch(function (err) {
          console.log(err)
          toast.error(err.response.data.message, { theme: 'colored' })
        });
    },
    validatePost() {
      this.form.name == '' ? this.checkErrors.name = true : this.checkErrors.name = false
      this.form.ngaysinh == '' ? this.checkErrors.ngaysinh = true : this.checkErrors.ngaysinh = false
      this.form.email == '' ? this.checkErrors.email = true : this.checkErrors.email = false
      this.form.sdt == '' ? this.checkErrors.sdt = true : this.checkErrors.sdt = false
      if (this.checkErrors.name || this.checkErrors.ngaysinh || this.checkErrors.email || this.checkErrors.sdt) return;
      this.patchGiangVien();
    },
  },
  mounted() {
    this.$store.state.isAbsolute = true;
    setNavPills();
    setTooltip();
    this.getUserInfo()
  },
  beforeMount() {
    this.$store.state.imageLayout = "profile-overview";
    this.$store.state.showNavbar = false;
    this.$store.state.showFooter = true;
    this.$store.state.hideConfigButton = true;
    body.classList.add("profile-overview");
  },
  beforeUnmount() {
    this.$store.state.isAbsolute = false;
    this.$store.state.imageLayout = "default";
    this.$store.state.showNavbar = true;
    this.$store.state.showFooter = true;
    this.$store.state.hideConfigButton = false;
    body.classList.remove("profile-overview");
  }
};
</script>
