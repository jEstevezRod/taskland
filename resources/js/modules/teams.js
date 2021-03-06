/*
|-------------------------------------------------------------------------------
| VUEX modules/teams.js
|-------------------------------------------------------------------------------
| The Vuex data store for the teams
*/

import teamAPI from '../api/team.js';


export const teams = {
    state: {
        team: {},
        teamList: [],
        numberTeams: 0,
    },
    actions: {

        newTeam: function ({ commit }, data) {
            let token = window.localStorage.getItem('token')

            return new Promise((resolve, reject) => {
                teamAPI.postNewTeam({ data, token })
                    .then(response => {
                        commit('setTeam', response.data.team);
                        commit('addTeamToTeamList', response.data.team);
                        resolve(response)
                    }, error => {
                        console.log('Reject creating a new team, I\'m on newTeam in teams.js ');
                        reject(error);
                    })
            })

        },

        loadAllTeams: function ({ commit }) {

            let token = window.localStorage.getItem('token')

            return new Promise((resolve, reject) => {

                teamAPI.loadTeams(token)
                    .then(response => {
                        commit('fillTeamList', response.data.teams);
                        resolve(response)
                    }, error => {
                        console.log('Reject loading teams, I\'m on loadTeams in teams.js ')
                        reject(error)
                    })
            })
        },

        loadTeam: function ({ commit }, data) {

            let token = window.localStorage.getItem('token');

            return new Promise((resolve, reject) => {

                teamAPI.loadTeamAPI({ token, data })
                    .then(response => {
                        
                        console.log(response.data.team);
                        commit('setTeam', response.data.team)
                        resolve(response.data.team)
                    }, error => {
                        console.error(error)
                        reject(error)
                    })

            })
        },

        loadTeamWithProject: function ({commit}, data) {

            const token = window.localStorage.getItem('token');

            return new Promise((resolve, reject)=> {

                teamAPI.loadTeamWithProject({token,data})
                    .then( response => {
                        console.log(response)
                        resolve(response.data)
                    }, error => {
                        reject(error)
                    })
            })
        }


    },
    mutations: {

        setTeam: (state, team) => state.team = team,

        addTeamToTeamList: (state, value) => state.teamList.push(value),

        fillTeamList: (state, array) => state.teamList = array,

    },
    getters: {

        team: state => state.team,

        getTeamList: state => state.teamList,

        getNumberTeams: state => state.teamList.length


    }

}