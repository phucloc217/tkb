import { createRouter, createWebHashHistory } from "vue-router";
import Dashboard from "./views/dashboard.vue";
import Tables from "./views/Tables.vue";
import Billing from "./views/Billing.vue";
import VirtualReality from "./views/VirtualReality.vue";
import Profile from "./views/Profile.vue";
import Signin from "./views/Signin.vue";

const routes = [
  {
    path: "/",
    name: "/",
    redirect: "/dashboard-default",
  },
  {
    path: "/giangvien",
    name: "Giảng viên",
    component: () => import("./views/GiangVien.vue"),
  },
  {
    path: "/xeptkb",
    name: "Xếp thời khóa biểu",
    component: () => import("./views/XepTKB.vue"),
  },
  {
    path: "/lophoc",
    name: "Quản lý lớp học",
    component: () => import("./views/LopHoc.vue"),
  },
  {
    path: "/dangnhap",
    name: "Đăng nhập",
    component: Signin,
  },
  {
    path: "/dashboard-default",
    name: "Dashboard",
    component: Dashboard,
  },
  {
    path: "/tables",
    name: "Tables",
    component: Tables,
  },
  {
    path: "/billing",
    name: "Billing",
    component: Billing,
  },
  {
    path: "/virtual-reality",
    name: "Virtual Reality",
    component: VirtualReality,
  },

  {
    path: "/profile",
    name: "Profile",
    component: Profile,
  },

  
];

const router = createRouter({
  history: createWebHashHistory(),
  routes,
  linkActiveClass: "active",
});

export default router;
