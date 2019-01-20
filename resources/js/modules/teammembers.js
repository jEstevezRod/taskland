/*
|-------------------------------------------------------------------------------
| VUEX modules/teammembers.js
|-------------------------------------------------------------------------------
| The Vuex data store for the teammembers
*/

import teamMemberAPI from '../api/teammember.js';


export const teamMembers = {
    state: {
        teams: []
    },
    actions: {

        newTeamMember: function ({commit},team_id) {

            let token = window.localStorage.getItem('token');

            return new Promise((resolve, reject) => {
                teamMemberAPI.addTeamMember({team_id: team_id, token: token})
                    .then (response => {
                        resolve(response)
                    }, error => {
                    reject(error)
                })
            })


        }
    },
    mutations: {},
    getters: {}

}