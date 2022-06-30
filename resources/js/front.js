/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");
import Vue from "vue";
import VueAgile from "vue-agile";

Vue.use(VueAgile);

window.axios = require("axios");
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

window.Vue = require("vue");

import App from "./views/App";

import router from "./router";

const app = new Vue({
    el: "#root",
    render: (h) => h(App), //renderizziamo App all'avvio di Vue
    router,
});
