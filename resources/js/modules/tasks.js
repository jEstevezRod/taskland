/*
|-------------------------------------------------------------------------------
| VUEX modules/tasks.js
|-------------------------------------------------------------------------------
| The Vuex data store for the tasjs
*/

import taskAPI from '../api/task.js';


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

        taskNumber: 0,

        projectInTeam: 0,

        personalProject: 0,

        countProjects: 0,

        task_loaded: {}
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
        },
        countAllTasks: function ( {commit}) {

            let token = window.localStorage.getItem('token')

            return new Promise( ((resolve, reject) => {

                taskAPI.countAllTasks({token})
                    .then(response => {
                        commit('setTaskNumber', response.data.a);
                        commit('setPersonalProjects', response.data.c);
                        commit('setTeamProjects', response.data.b);
                        commit('setProjectNumber', response.data.d);
                        resolve(response)
                    },error => {
                        reject(error)
                    })
            }))
        },

        loadTask: function ({commit}, data) {

            let token = window.localStorage.getItem("token");

            return new Promise( (resolve, reject) => {

                taskAPI.loadTask({token,data})
                .then( response => {
                    console.log(response.data.message)
                    commit('pushTask', response.data.task)
                    resolve(response.data)
                }, error => {
                    reject(error)
                })

            })
            
        },

        loadTasksCalendar: function ({commit}) {

            let token = window.localStorage.getItem("token")

            return new Promise( (resolve, reject) => {
                
                taskAPI.loadTasksCalendar({token})
                .then( response => {
                    console.log("787897897779787897987879789797897897878978979878789789789");
                    console.log(response);
                    resolve(response.data)
                }, error => {
                    reject(error);
                })

            })
            
        },
        loadUsersInProject: function ({commit}, data) {

            const token = window.localStorage.getItem("token");

            return new Promise((resolve,reject) => {
                taskAPI.loadUsersInProject({token, data})
                    .then( response => {
                        resolve(response.data)
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
        },

        setTaskNumber: (state, value) => state.taskNumber = value,

        setProjectNumber: (state, value) => state.countProjects = value,

        setPersonalProjects: (state, value) => state.personalProject = value,

        setTeamProjects: (state, value) => state.projectInTeam = value,

        pushTask: (state, data) => state.task_loaded = data

    },

    getters: {

        getTasks(state) {
            return state.tasks;
        },

        getTask(state) {
            return state.task;
        },

        getTaskNumber: state => state.taskNumber,

        getCountProjects: state => state.countProjects,

        getPersonalProjects: state => state.personalProject ,

        getTeamProjects: state => state.projectInTeam,

        task: state => state.task_loaded
    }
}