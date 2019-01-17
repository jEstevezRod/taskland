import Vue from 'vue'
import VueRouter from 'vue-router'
import store from './store'

Vue.use(VueRouter);


const router = new VueRouter({
    routes: [
        {
            path: '/',
            name: 'Home',
            component: Vue.component('Home', require('./pages/Home.vue')).default,
            meta: {
                auth: false
            }
        },
        {
            path: '/password',
            name: 'Password',
            component: Vue.component('Password', require('./pages/Password.vue')).default,
            meta: {
                auth: false
            }
        },
        {
            path: '/main',
            name: 'Main',
            component: Vue.component('Main', require('./pages/Main.vue')).default,
            meta: {
                auth: true
            },
            children: [
                {
                    path: '',
                    name: 'HomeViewComponent',
                    component: Vue.component('HomeViewComponent', require('./pages/HomeViewComponent.vue')).default,
                    meta: {
                        auth: true
                    }
                },
                {
                    path: '/dashboard',
                    name: 'Dashboard',
                    component: Vue.component('Dashboard', require('./pages/TaskContainerComponent.vue')).default,
                    meta: {
                        auth: true
                    },
                    children: [
                        {
                            path: '',
                            component: Vue.component('DashboardHomeComponent', require('./pages/DashboardHomeComponent.vue')).default,
                        },
                        {
                            path: ':id',
                            name: 'dashboard',
                            component: Vue.component('ProjectsComponent', require('./components/dashboard/ProjectsComponent')).default,
                        }
                    ]
                }
            ]

        },
        {path: '*', redirect: '/'}
    ]


});


// router.beforeEach((to, from, next) => {
//
//     // check if the route requires authentication and user is not logged in
//     if (to.matched.some(route => route.meta.auth) && !store.state.isLogged) {
//         // redirect to login page
//         next({ name: 'Home' })
//         return
//     }
//
//     // if logged in redirect to dashboard
//     if(to.path === '/login' && store.state.isLogged) {
//         next({ name: 'HomeViewComponent' })
//         return
//     }
//
//     next()
// })

export default router