/*
|-------------------------------------------------------------------------------
| VUEX modules/users.js
|-------------------------------------------------------------------------------
| The Vuex data store for the users
*/

import projectUserAPI from '../api/projectuser.js';


export const projectUsers = {
    state: {

    },
    actions: {

        addUserInProject({commit}, data) {

            let token = window.localStorage.getItem('token');

            return new Promise( ((resolve, reject) => {
                projectUserAPI.addNewUserInProject({data, token})
                    .then( response => {
                        console.log(response.data.message);
                        resolve(response)
                    }, error => {
                        reject(error)
                    })
            }))
        }

    },
    mutations: {

    },
    getters: {

    }

}