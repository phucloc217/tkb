<template>
  <div
    class="collapse navbar-collapse w-auto h-auto h-100"
    id="sidenav-collapse-main"
  >
    <ul class="navbar-nav">
      <li class="nav-item">
        <sidenav-item
          url="/dashboard-default"
          :class="getRoute() === 'dashboard-default' ? 'active' : ''"
          :navText="this.$store.state.isRTL ? 'لوحة القيادة' : 'Dashboard'"
        >
          <template v-slot:icon>
            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
          </template>
        </sidenav-item>
      </li>
      <li class="nav-item">
        <sidenav-item
          url="/giangvien"
          :class="getRoute() === 'giangvien' ? 'active' : ''"
          :navText="this.$store.state.isRTL ? 'الجداول' : 'Giảng viên'"
        >
          <template v-slot:icon>
            <font-awesome-icon icon="fa-solid fa-address-card" aria-hidden="true" class="text-success text-sm opacity-10"/>
          </template>
        </sidenav-item>
      </li>
      <li class="nav-item">
        <sidenav-item
          url="/xeptkb"
          :class="getRoute() === 'xeptkb' ? 'active' : ''"
          :navText="this.$store.state.isRTL ? 'الجداول' : 'Xếp thời khóa biểu'"
        >
          <template v-slot:icon>
            <i
              class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"
            ></i>
          </template>
        </sidenav-item>
      </li>
      <li class="nav-item">
        <sidenav-item
          url="/lophoc"
          :class="getRoute() === 'lophoc' ? 'active' : ''"
          :navText="this.$store.state.isRTL ? 'الجداول' : 'Quản lý lớp học'"
        >
          <template v-slot:icon>
            <font-awesome-icon icon="fa-solid fa-briefcase" class="text-primary text-sm opacity-10"/>
          </template>
        </sidenav-item>
      </li>
      <li class="nav-item">
        <sidenav-item
          url="/monhoc"
          :class="getRoute() === 'monhoc' ? 'active' : ''"
          :navText="this.$store.state.isRTL ? 'الجداول' : 'Quản lý môn học'"
        >
          <template v-slot:icon>
            <font-awesome-icon icon="fa-solid fa-book" class="text-danger text-sm opacity-10"/>
          </template>
        </sidenav-item>
      </li>
     
      <li class="mt-3 nav-item">
        <h6
          v-if="this.$store.state.isRTL"
          class="text-xs ps-4 text-uppercase font-weight-bolder opacity-6"
          :class="this.$store.state.isRTL ? 'me-4' : 'ms-2'"
        >
          صفحات المرافق
        </h6>
        <h6
          v-else
          class="text-xs ps-4 text-uppercase font-weight-bolder opacity-6"
          :class="this.$store.state.isRTL ? 'me-4' : 'ms-2'"
        >
          TÀI KHOẢN
        </h6>
      </li>
      <li class="nav-item">
        <sidenav-item
          url="/profile"
          :class="getRoute() === 'profile' ? 'active' : ''"
          :navText="this.$store.state.isRTL ? 'حساب تعريفي' : 'Tài khoản'"
        >
          <template v-slot:icon>
            <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
          </template>
        </sidenav-item>
      </li>
    </ul>
  </div>
  
</template>
<script>
import SidenavItem from "./SidenavItem.vue";
import SidenavCard from "./SidenavCard.vue";

export default {
  name: "SidenavList",
  props: {
    cardBg: String
  },
  data() {
    return {
      title: "Argon Dashboard 2",
      controls: "dashboardsExamples",
      isActive: "active"
    };
  },
  components: {
    SidenavItem,
    SidenavCard
  },
  methods: {
    getRoute() {
      const routeArr = this.$route.path.split("/");
      return routeArr[1];
    }
  }
};
</script>
