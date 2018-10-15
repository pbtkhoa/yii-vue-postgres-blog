import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import App from './App'

import '~/plugins';
import '~/components';

Vue.config.productionTip = false;
Vue.prototype.$baseAppUrl = window.config.baseUrl || 'http://localhost:8080';

new Vue({
    store,
    router,
    ...App
});