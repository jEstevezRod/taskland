/*
|-------------------------------------------------------------------------------
| VUEX modules/assignedtasks.js
|-------------------------------------------------------------------------------
| The Vuex data store for the users
*/

import assignedTaskrAPI from '../api/assignedtask.js';

export const assignedTasks = {
    state: {

    },
    actions: {
        assignTaskTo: function ({commit}, data) {
            const token = window.localStorage.getItem('token');

            return new Promise((resolve, reject) => {

                assignedTaskrAPI.assignTaskTo({token, data})
                    .then( response => {
                        console.log(response)
                    }, error => {
                        reject(error)
                    })
            })
        }

    },
    mutations: {

    },
    getters: {

    }

}