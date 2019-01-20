/*
|-------------------------------------------------------------------------------
| VUEX modules/states.js
|-------------------------------------------------------------------------------
| The Vuex data store for the states
*/

import stateAPI from '../api/state.js';


export const states = {
    state: {

        stateList: []
    },
    actions: {

        newState: function ({commit}, data) {

            let token = window.localStorage.getItem('token');

            return new Promise( (resolve, reject) => {

                stateAPI.addNewState({data, token} )
                    .then( response => {
                        console.log(response.data.message);
                        commit('addStateToList', response.data.state);
                        resolve(response)
                    }, error => {
                        reject(error)
                    })
            })


        },

        loadStates: function ({commit}, data ) {

            let token = window.localStorage.getItem('token');

            return new Promise( ((resolve, reject) => {
                stateAPI.loadAllStates({data, token})
                    .then( response => {
                        console.log(response.data.message);
                        commit('fillStateList', response.data.states);
                        resolve(response)
                    }, error => {
                        reject(error)
                    })
            }))

        },



    },
    mutations: {

        fillStateList: (state, array) => state.stateList = array,

        addStateToList: (state, newState) => state.stateList.push(newState),

    },
    getters: {

        getStateList: state => state.stateList,

        countStates: state => state.stateList.length

    }

}