/*
|-------------------------------------------------------------------------------
| VUEX modules/states.js
|-------------------------------------------------------------------------------
| The Vuex data store for the states
*/

import commentAPI from '../api/comment.js';

export const comments = {

    state : {
        commentList: [],
        comment: ''
    },
    actions: {

        newComment: function ({commit}, data) {

            let token = window.localStorage.getItem('token');

            return new Promise( (resolve, reject) => {

                commentAPI.createComment( {token, data})
                    .then(
                        response => {
                            console.log(response.data.message);
                            commit('addCommentsToList', response.data.comment);
                            resolve(response);
                        }, error => {
                            console.error(error);
                            reject(error)
                        }
                    )

            })
        },

        loadCommentsTask: function ({commit}, data) {

            let token = window.localStorage.getItem('token');

            return new Promise( ((resolve, reject) => {

                commentAPI.loadComments({token,data})
                    .then( response => {
                        console.log(response.data.message);
                        commit('setCommentList', response.data.comments);
                        resolve(response.data)
                    }, error => {
                        console.error(error);
                        reject(error)
                    })

            }))
        }

    },
    mutations : {

        addCommentsToList: (state, data) => state.commentList.unshift(data),

        setCommentList: (state, data) => state.commentList = data

    },
    getters : {

        comments : state => state.commentList

    }
}