


require('es6-promise').polyfill();


import Vue from 'vue'
import Vuex from 'vuex'

Vue.use( Vuex );

import { tasks } from './modules/tasks'
import { users} from './modules/users'
import { teams } from './modules/teams'

export default new Vuex.Store({
    modules: {
        tasks,
        users,
        teams
    }
});