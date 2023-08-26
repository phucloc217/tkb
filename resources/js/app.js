import './bootstrap';
import {createApp} from 'vue'
import store from "./store";
import router from "./router";
import "./assets/css/nucleo-icons.css";
import "./assets/css/nucleo-svg.css";
import ArgonDashboard from "./argon-dashboard";

import App from './App.vue'

const app = createApp(App)
app.use(router);
app.use(store);
app.use(ArgonDashboard);
app.mount("#app")