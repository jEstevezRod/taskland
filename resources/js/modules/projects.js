/*
|-------------------------------------------------------------------------------
| VUEX modules/projects.js
|-------------------------------------------------------------------------------
| The Vuex data store for the users
*/

import projectAPI from '../api/project.js';


export const projects = {
    state: {
        project: {},
        projectList: [],
        projectName: '',
    },
    actions: {

        newProject: function ({commit}, data) {
            let token = window.localStorage.getItem('token');

            return new Promise((resolve, reject) => {

                projectAPI.addNewProject({data, token})
                    .then(response => {
                        console.log(response.data.message);
                        commit('addProjectToList', response.data.project);
                        resolve(response)
                    }, error => {
                        console.error(error);
                        reject(error)
                    })
            })

        },

        loadProjects: function ({commit}) {

            let token = window.localStorage.getItem('token');

            return new Promise((resolve, reject) => {

                projectAPI.loadAllProjects(token)
                    .then(response => {
                        commit('setProjectList', response.data.projects);
                        resolve(response)
                    }, error => {
                        reject(error)
                    })
            })

        },

        loadProjectName: function ({commit}, data) {

            let token = window.localStorage.getItem('token');

            return new Promise (((resolve, reject) => {

                projectAPI.getName({data,token})
                    .then( response => {
                        commit('setProjectName', response.data.name);
                        resolve(response)
                    }, error => {
                        reject(error)
                    })
            }));

        }


    },
    mutations: {
        setProjectList: (state, array) => state.projectList = array,

        addProjectToList: (state, project) => state.projectList.push(project),

        setProjectName: (state, name) => state.projectName = name
    },
    getters: {

        getProjectList: (state) => state.projectList,

        getProjectName: (state) => state.projectName
    }

};