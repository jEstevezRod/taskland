
window._ = require('lodash');

try {
    window.$ = window.jQuery = require('jquery');

} catch (e) {}


window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}



import Vue    from 'vue';
import router from './routes.js'
import store from './store.js'
import Buefy from 'buefy';

Vue.use(Buefy)

import Home from './pages/Home.vue'
import Main from './pages/Main.vue'

import VeeValidate from 'vee-validate';

Vue.use(VeeValidate);

// const tokenJWT = localStorage.getItem('token')
//
// if (tokenJWT) {
//     window.axios.defaults.headers.common['Authorization'] = tokenJWT
// }
new Vue({
    components: {
        Home, Main
    },
    router,
    store
}).$mount('#app');