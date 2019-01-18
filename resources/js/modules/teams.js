/*
|-------------------------------------------------------------------------------
| VUEX modules/teams.js
|-------------------------------------------------------------------------------
| The Vuex data store for the teams
*/

import teamAPI from '../api/team.js';


export const teams = {
    state: {
        team: ''
    },
    actions: {

        newTeam: function ({commit},data) {
            console.log(data);
            teamAPI.postNewTeam(data)
                .then( (response) => {
                    console.log(response);
                })
        }

    },
    mutations: {

    },
    getters: {

    }

}