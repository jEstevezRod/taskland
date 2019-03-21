
window._ = require('lodash');
window.$ = require('jquery')
window.JQuery = require('jquery')
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

import Echo from 'laravel-echo'

window.Pusher = require('pusher-js');

let tokenJWT = window.localStorage.getItem("token");

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '4f82658cc05f98e8e468',
    cluster: 'eu',
    encrypted: true,
    auth:
    {
        headers:
        {
            'Authorization': 'Bearer ' + tokenJWT
        }
    }
});


import Vue from 'vue';
import router from './routes.js'
import store from './store.js'
import Buefy from 'buefy';



Vue.use(Buefy);

import bulmaExtensions from '../../node_modules/bulma-extensions/dist/js/bulma-extensions.min'

Vue.use(bulmaExtensions);

import Home from './pages/Home.vue'
import Main from './pages/Main.vue'


import VeeValidate from 'vee-validate';

Vue.use(VeeValidate);
Vue.use(require('vue-moment'));

// const tokenJWT = localStorage.getItem('token')
//
// if (tokenJWT) {
//     window.axios.defaults.headers.common['Authorization'] = tokenJWT
// }
import FullCalendar from 'vue-full-calendar'
Vue.use(FullCalendar)

import Bars from 'vuebars'

Vue.use(Bars);

new Vue({
    components: {
        Home, Main
    },
    router,
    store
}).$mount('#app');