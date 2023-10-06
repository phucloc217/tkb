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
                <p class="mb-0">Cập nhật thông tin</p>
                <argon-button color="success" size="sm" class="ms-auto">Lưu</argon-button>
              </div>
            </div>
            <div class="card-body">
              <p class="text-uppercase text-sm">Thông tin người dùng</p>
              <div class="row">
                <div class="col-md-6">
                  <label for="example-text-input" class="form-control-label">Họ và tên</label>
                  <input class="form-control" type="text" value="Nguyễn Phúc Lộc" />
                </div>
                <div class="col-md-6">
                  <label for="example-text-input" class="form-control-label">Ngày sinh</label>
                  <argon-input type="date" value="2001-07-21" />
                </div>
                <div class="col-md-6">
                  <label for="example-text-input" class="form-control-label">Học hàm</label>
                  <select class="form-select" aria-label="Default select example">
                    <option value="K" selected>Không có</option>
                    <option value="PGS">Phó Giáo sư</option>
                    <option value="GS">Giáo sư</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="example-text-input" class="form-control-label">Học vị</label>
                  <select class="form-select" aria-label="Default select example">
                    <option value="CN" selected>Cử nhân / Kỹ sư</option>
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
                  <argon-input type="text" value="Biên Hòa, Đồng Nai" />
                </div>
                <div class="col-md-4">
                  <label for="example-text-input" class="form-control-label">Số điện thoại</label>
                  <argon-input type="tel" value="0123456789" />
                </div>
                <div class="col-md-4">
                  <label for="example-text-input" class="form-control-label">Email</label>
                  <argon-input type="email" value="loc.nguyen456789@gmail.com" />
                </div>
                
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
      }
    };
  },
  components: { ArgonInput, ArgonButton },

  mounted() {
    this.$store.state.isAbsolute = true;
    setNavPills();
    setTooltip();
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
