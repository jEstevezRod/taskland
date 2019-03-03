/*
|-------------------------------------------------------------------------------
| VUEX modules/teammembers.js
|-------------------------------------------------------------------------------
| The Vuex data store for the teammembers
*/

import teamMemberAPI from '../api/teammember.js';


export const teamMembers = {
    state: {
        members: []
    },
    actions: {

        newTeamMember: function ({commit},team_id) {

            let token = window.localStorage.getItem('token');

            return new Promise((resolve, reject) => {

                teamMemberAPI.addTeamMember({team_id: team_id, token: token})
                    .then (response => {
                        commit('addMemberToList', response.data.member)
                        resolve(response.data)
                    }, error => {
                    reject(error)
                })
            })


        },
        loadTeamMembers: function ({commit}, data) {

            let token = window.localStorage.getItem('token');

            return new Promise ( (resolve, reject) => {

                teamMemberAPI.loadTeamMembersAPI({token, data})
                .then( response => {
                    console.log(response.data.message);
                    commit('setTeamMemberList', response.data.members)
                    resolve(response.data)
                }, error => {
                    console.error(error);
                    reject(error)
                })

            })

        },

        addMember: function ({commit}, data) {

            let token = window.localStorage.getItem('token');

            return new Promise ((resolve, reject) => {

                teamMemberAPI.addMemberToTeam({token, data})
                .then( response => {
                    console.log(response.data.message);
                    if ( response.data.status) {
                        commit('addMemberToList', response.data.member)
                        resolve(response.data)
                    }
                }, error => {
                    console.error(error);
                    reject(error)
                })
            })
        },
        loadTeamMembersWithProject: function ({commit}, data) {

            const token = window.localStorage.getItem('token');

            return new Promise((resolve,reject) => {

                teamMemberAPI.loadTeamMembersWithProject({token, data})
                    .then( response => {
                        resolve(response.data)
                    }, error => {
                        reject(error)
                    })
            })
        }
    },
    mutations: {

        setTeamMemberList: (state, list) => state.members = list,

        addMemberToList: (state, member) => state.members.push(member)

    },
    getters: {

        listMembers: state => state.members
    }

}