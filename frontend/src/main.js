import '@babel/polyfill'
import Vue from 'vue'
import './plugins/vuetify'
import App from './App.vue'
import router from './router'
import {store} from "./store";
import axios from 'axios';
import VueAxios from 'vue-axios';
import VueClip from 'vue-clip';
import errorHandler from './errorHandler';
import JsonExcel from 'vue-json-excel';
import VeeValidate from 'vee-validate';

import 'vue2-dropzone/dist/vue2Dropzone.css'
import '@fortawesome/fontawesome-free/css/all.css' // Ensure you are using css-loader
import 'material-design-icons-iconfont/dist/material-design-icons.css' // Ensure you are using css-loader

import VDateRange from 'vuetify-daterange-picker';
import 'vuetify-daterange-picker/dist/vuetify-daterange-picker.css';

Vue.config.productionTip = false

Vue.use(VueAxios, axios);

Vue.use(VueClip);

Vue.component('downloadExcel', JsonExcel);

Vue.use(VDateRange);

Vue.use(VeeValidate, { inject: false })


Vue.filter('downloadUrl', function (value) {
    if (!value) return ''
    else return process.env.VUE_APP_SERVER_URL + '/downloadFile/' + value
})


//auto authentication
const token = localStorage.getItem('token')
if (token) {
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
}

axios.defaults.baseURL = process.env.VUE_APP_SERVER_URL

//checking in interceptor works
axios.interceptors.response.use(
    response => response,
    errorHandler
);

export const app = new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app')
