import { createRouter, createWebHashHistory } from "vue-router";
import Dashboard from "./views/dashboard.vue";
import Profile from "./views/Profile.vue";
import ThemGiangVien from "./views/ThemGiangVien.vue";
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
    path: "/giangvien/:id",
    name: "Update Giảng Viên",
    component: () => import("./views/UpdateGiangVien.vue"),
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
    path: "/monhoc",
    name: "Quản lý môn học",
    component: () => import("./views/MonHoc.vue"),
  },
  {
    path: "/phonghoc",
    name: "Quản lý phòng học",
    component: () => import("./views/PhongHoc.vue"),
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
  {
    path: "/themgiangvien",
    name: "Thêm giảng viên",
    component: ThemGiangVien,
  },

  
];

const router = createRouter({
  history: createWebHashHistory(),
  routes,
  linkActiveClass: "active",
});

router.beforeEach((to, from, next) => {
  const publicPages = ['/dangnhap'];
  const authRequired = !publicPages.includes(to.path);
  const loggedIn = window.sessionStorage.getItem('token');

  // trying to access a restricted page + not logged in
  // redirect to login page
  if (authRequired && !loggedIn) {
    next('/dangnhap');
  } 
  else
  {
    next();
  }
});

export default router;
