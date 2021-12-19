/* eslint-disable no-unused-vars */
import Vue from "vue";
import App from "./App.vue";
import router from "./router";
// import "slick-vuejs";
// import "slick-carousel";
// import "slick-carousel/slick/slick.css";
// import "slick-carousel/slick/slick-theme.css";
import "bootstrap/dist/css/bootstrap.css";
import "..//src/assets/css/bootstrap.min.css";
import "..//src/assets/css/font-awesome.min.css";
import "normalize.css";
import "..//src/assets/css/slick.css";
import "..//src/assets/css/style.css";
import "..//src/assets/css/media_query.css";
import "bootstrap/dist/js/bootstrap.min.js";
import VueSimpleAlert from "vue-simple-alert";

import VueI18n from "vue-i18n";
import en from "./assets/lang/en.json";
import ar from "./assets/lang/ar.json";

Vue.use(VueSimpleAlert);
import jQuery from "jquery";
import axios from "axios";
global.jQuery = jQuery;
global.$ = jQuery;
import "jquery/dist/jquery.min.js";
import "..//src/assets/js/style";
import store from "./store";

import VueVideoPlayer from "vue-video-player";

// require videojs style
import "video.js/dist/video-js.css";
// import 'vue-video-player/src/custom-theme.css'
Vue.use(
  VueVideoPlayer /* {
  options: global default options,
  events: global videojs events
} */
);

Vue.prototype.$api_url = "http://api.troom.aisent/";
// Vue.prototype.$api_url = "https://api.troom.ae/";

require("bootstrap");
const lang = localStorage.getItem("lang") || "ar";
axios.defaults.headers["Accept-Language"] = lang;
document.documentElement.lang = lang;

import JwPagination from "jw-vue-pagination";
Vue.component("jw-pagination", JwPagination);

import VueSocialChat from "vue-social-chat"
Vue.use(VueSocialChat)

const messages = {
  en,
  ar,
};

Vue.use(VueI18n);
const i18n = new VueI18n({
  locale: localStorage.getItem("lang") || "ar",
  messages,
});

import Tawk from "vue-echo";

Vue.use(Tawk, {
  tawkSrc: "610fb065649e0a0a5cd01b1b",
});

Vue.config.productionTip = false;
new Vue({
  i18n,
  router,
  store,
  Tawk,
  render: (h) => h(App),
}).$mount("#app");
