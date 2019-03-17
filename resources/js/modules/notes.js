/*
|-------------------------------------------------------------------------------
| VUEX modules/projects.js
|-------------------------------------------------------------------------------
| The Vuex data store for the users
*/

import noteAPI  from '../api/note.js';


export const notes = {
    state: {
        noteList: [],
        note: {}
    },
    actions: {

        loadNotes: function({commit}) {

            const token = window.localStorage.getItem('token');

            return new Promise((resolve, reject) => {

                noteAPI.loadNotes({token})
                .then( response => {
                    console.log(response)
                    commit('setNoteArray', response.data)
                    resolve(response.data)
                }, error => {
                    reject(error);
                })

            })


        },

        createNotes: function({commit}, data) {

            const token = window.localStorage.getItem("token");

            return new Promise((resolve, reject) => {

                noteAPI.createNotes({data, token})
                .then( response => {
                    console.log(response)
                    resolve(response.data)
                    commit('addNote', response.data)
                }, error => {
                    reject(error)
                })
            })
        },

        updateNote: function({dispatch}, data) {

            const token = window.localStorage.getItem('token');

            return new Promise((resolve, reject) => {

                noteAPI.updateNote({data, token})
                .then( response => {
                    resolve(response.data)
                    console.log(response)
                    dispatch('loadNotes')
                }, error => {
                    reject(error)
                })

            })
        },

        deleteNote: function({commit},data) {

            const token = window.localStorage.getItem('token');

            return new Promise((resolve,reject) => {

                noteAPI.deleteNote({token,data})
                .then( response => {
                    console.log(response)
                    resolve(response.data)
                    commit('spliceNote', response.data.id)
                }, error => {
                    reject(error)
                })

            })
        }


    },
    mutations: {
        setNoteArray: (state, data) => state.noteList = data,

        setNote: (state, data) => state.note = data,

        addNote: (state, data) => state.noteList.push(data),

        spliceNote: (state, id) => state.noteList = state.noteList.filter( x => x.id != id)
    },
    getters: {
        noteArray: state => state.noteList

    }

};