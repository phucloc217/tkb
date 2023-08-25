import './bootstrap';
import {createApp} from 'vue'
import routes from './router'
// Plugins
import GlobalComponents from "./globalComponents";
import GlobalDirectives from "./globalDirectives";
import Notifications from "./components/NotificationPlugin";

// MaterialDashboard plugin
import MaterialDashboard from "./material-dashboard";

import Chartist from "chartist";

import App from './App.vue'
const router = new VueRouter({
  routes, // short for routes: routes
  linkExactActiveClass: "nav-item active",
});

const app = createApp(App)
app.use(router);
app.use(VueRouter);
app.use(MaterialDashboard);
app.use(GlobalComponents);
app.use(GlobalDirectives);
app.use(Notifications);
app.prototype.$Chartist = Chartist
app.mount("#app")