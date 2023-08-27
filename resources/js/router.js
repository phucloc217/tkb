import { createRouter, createWebHashHistory } from "vue-router";
import Dashboard from "./views/dashboard.vue";
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
