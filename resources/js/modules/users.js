/*
|-------------------------------------------------------------------------------
| VUEX modules/users.js
|-------------------------------------------------------------------------------
| The Vuex data store for the users
*/

import UserAPI from '../api/user.js';
import  axios  from 'axios'
import router from '../routes.js'


const types = {
    LOGIN: 'LOGIN',
    LOGOUT: 'LOGOUT'
}


export const users = {

    state: {
        user: {},
        hasPassword: true,
        firstPassword: '',
        newUser: {},
        logged: !!window.localStorage.getItem('token'),
        token: localStorage.getItem('token') || ''
    },


    actions: {

        loginUser({commit}, data) {
            UserAPI.getLoginUser(data)
                .then(function (response) {
                    commit(types.LOGIN)
                    window.localStorage.setItem('token', response.data.access_token)
                    window.localStorage.setItem('userId', response.data.user_id)
                    axios.defaults.headers.common['Authorization'] = 'Bearer ' + response.data.access_token
                    router.push('main')
                })

        },
        logoutUser({commit}) {
            let token = window.localStorage.getItem('token')
            UserAPI.logoutUser(token)
                .then(function () {
                        commit(types.LOGOUT)
                        window.localStorage.removeItem('token')
                        window.localStorage.removeItem('userId')
                        delete axios.defaults.headers.common['Authorization']
                        router.push('/')
                    }
                )
        },

        loadUser({commit}) {
            let token = window.localStorage.getItem('token')
            UserAPI.getUser(token)
                .then(function (response) {
                    commit('setUser', response.data);
                })
                .catch(function () {
                    commit('setUser', {});
                });
        },

        checkPassword({commit}) {

            UserAPI.getUserHasPassword()
                .then(function (response) {
                    commit('setHasPassword', response.data);
                })
                .catch(function () {
                    commit('setHasPassword', 'Error in Vuex Users module');
                })
        },

        putFirstPassword({commit}, data, dispatch) {

            UserAPI.setFirstPassword(data.password)
                .then(
                    response => {
                        commit('setFirstPassword', response.data);
                        dispatch('checkPassword');
                    }
                )
                .catch(function () {
                    commit('setFirstPassword', null)
                })
        }
    },


    mutations: {
        [types.LOGIN](state) {
            state.logged = true
        },

        [types.LOGOUT](state) {
            state.logged = false
        },

        setUser(state, user) {
            state.user = user;
        },

        setHasPassword(state, value) {
            state.hasPassword = value;
        },

        setFirstPassword(state, firstPassword) {
            state.firstPassword = firstPassword
        },

        setNewUser(state, newUser) {
            state.newUser = newUser
        },
        setToken(state, nToken) {
            state.token = nToken
        }


    },


    getters: {

        getUser(state) {
            return state.user;
        },

        getHasPassword(state) {
            return state.hasPassword;
        },
        getFirstPassword(state) {
            return state.firstPassword;
        },
        getNewUser(state) {
            return state.newUser;
        },
        isLogged: state => state.logged,

        getToken: state => state.token,

    }
}