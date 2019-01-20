/*
|-------------------------------------------------------------------------------
| VUEX modules/tasks.js
|-------------------------------------------------------------------------------
| The Vuex data store for the tasjs
*/

import taskAPI from '../api/task.js';
import { resolve } from 'path';
import { reject } from 'q';
import stateAPI from "../api/state";

/*
|-------------------------------------------------------------------------------
| DIFFERENTS STATES FOR LOADING
|-------------------------------------------------------------------------------
| status = 0 -> No loading has begun
| status = 1 -> Loading has started
| status = 2 -> Loading completed successfully
| status = 3 -> Loading completed unsuccessfully
|-------------------------------------------------------------------------------
*/

export const tasks = {

    state: {
        tasks: [],

        task: {},
    },
    actions: {

        newTask({ commit }, data) {

            let token = window.localStorage.getItem('token');

            return new Promise((resolve, reject) => {

                taskAPI.newTask({ data, token })
                    .then(response => {
                        commit('addTaskToList', response.data.task);
                        resolve(response)
                    }, error => {
                        reject(error);
                    })
            })

        }
        ,

        loadTasks({ commit }, data) {

            let token = window.localStorage.getItem('token');

            return new Promise((resolve, reject) => {
                taskAPI.getTasks({ data, token })
                    .then(function (response) {
                        commit('setTasks', response.data.tasks);
                        resolve(response)
                    }, error => {
                        reject(error)
                    })

            })


        },

        changeState: function ({commit}, data) {

            let token = window.localStorage.getItem('token');

            return new Promise( (resolve, reject) => {

                taskAPI.updateState( {data, token})
                    .then( response => {
                        resolve(response)
                    }, error => {
                        reject(error)
                    })
            })
        }

    },

    mutations: {

        setTasks(state, array) {
            state.tasks = array;
        },

        setTask(state, task) {
            state.task = task;
        },

        addTaskToList: ( state, task) => state.tasks.push(task),

        modifyTasks: (state, data) => {
            let index = state.tasks.findIndex(x => x.id === data.id);
            state.tasks[index].state = data.state;
        }
    },

    getters: {

        getTasks(state) {
            return state.tasks;
        },

        getTask(state) {
            return state.task;
        }
    }
}