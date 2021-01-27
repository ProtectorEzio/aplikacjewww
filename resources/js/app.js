require('./bootstrap');
import Vue from 'vue'
import App from './views/mainview.vue'
import router from './router.js'
import store from './store.js'
import axios from 'axios';
Vue.prototype.axios = axios;
import pagination from 'laravel-vue-pagination';
Vue.component('pagination', pagination);
import ViewUI from 'view-design';
import 'view-design/dist/styles/iview.css';
Vue.use(ViewUI);

const app = new Vue({
    el: '#app',
    router,
    store,
    axios,
    components: { App,pagination },
})