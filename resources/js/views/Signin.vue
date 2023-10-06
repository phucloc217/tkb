<template>
  <main class="mt-0 main-content">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="mx-auto col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0">
              <form action="" @submit="login">
                <div class="card card-plain">
                  <div class="pb-0 card-header text-start">
                    <h4 class="font-weight-bolder">Đăng nhập</h4>
                    <p class="mb-0">Vui lòng nhập Email và Mật khẩu để đăng nhập</p>
                  </div>
                  <div class="card-body">

                    <div class="mb-3">
                      <input type="tel" class="form-control form-control-lg" placeholder="Số điện thoại"
                        v-model="form.sdt" autocomplete="new-password">
                    </div>
                    <div class="mb-3">
                      <input type="password" class="form-control form-control-lg" placeholder="Mật khẩu"
                        v-model="form.password" autocomplete="new-password">
                    </div>
                    <div class="text-center">
                      <button class="btn btn-lg mt-4 bg-gradient-success w-100" type="submit">Đăng nhập</button>
                    </div>
                  </div>

                </div>
              </form>
            </div>
            <div
              class="top-0 my-auto text-center col-6 d-lg-flex d-none h-100 pe-0 position-absolute end-0 justify-content-center flex-column">
              <div
                class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg');
          background-size: cover;">
                <span class="mask bg-gradient-success opacity-6"></span>
                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Attention is the new currency"</h4>
                <p class="text-white position-relative">The more effortless the writing looks, the more effort the writer
                  actually put into the process.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<script>
import Navbar from "@/examples/PageLayout/Navbar.vue";
import ArgonInput from "@/components/ArgonInput.vue";
import ArgonSwitch from "@/components/ArgonSwitch.vue";
import ArgonButton from "@/components/ArgonButton.vue";
const body = document.getElementsByTagName("body")[0];
import { toast } from 'vue3-toastify';
export default {
  name: "signin",
  components: {
    Navbar,
    ArgonInput,
    ArgonSwitch,
    ArgonButton,
  },
  data() {
    return {
      form: {
        sdt: '',
        password: '',
      },
    }
  },
  methods:
  {
    async login(e) {
      e.preventDefault();
      if (this.form.sdt == '') {
        toast.error("Số điện thoại không được bỏ trống", { theme: 'colored' })
        return
      }
      if (this.form.password == '') {
        toast.error("Mật khẩu không được bỏ trống", { theme: 'colored' })
        return
      }
      let _THIS = this;
      await axios.post(this.API_URL + '/login', this.form)
        .then(function (res) {
          try {
            window.sessionStorage.setItem('token', res.data.access_token);
            window.sessionStorage.setItem('userID', res.data.user_id);
            // _THIS.$router.push("/")
            window.location.replace("/");
          } catch (error) {
            toast.error("Không thể đăng nhập lúc này", { theme: 'colored' })
          }
        })
        .catch(function (err) {
          toast.error(err.response.data.message, { theme: 'colored' })
        });
    }
  },
  mounted() {
    window.sessionStorage.removeItem('token');
    window.sessionStorage.removeItem('userID');

  },
  created() {

    this.$store.state.hideConfigButton = true;
    this.$store.state.showNavbar = false;
    this.$store.state.showSidenav = false;
    this.$store.state.showFooter = false;
    body.classList.remove("bg-gray-100");
  },
  beforeUnmount() {

    this.$store.state.hideConfigButton = false;
    this.$store.state.showNavbar = true;
    this.$store.state.showSidenav = true;
    this.$store.state.showFooter = true;
    body.classList.add("bg-gray-100");
  },
};
</script>
