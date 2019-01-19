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
    },
    actions: {

        newTask({commit}, data) {

            taskAPI.newTask(data)
                .then((response) => console.log(response.data.message))
                .catch()
        }
        ,

        loadTasks( { commit } ){


            taskAPI.getTasks()
                .then( function( response ){
                commit( 'setTasks', response.data );
                })
                .catch( function(){
                commit( 'setTasks', [] );
                });

        },
        loadTask( { commit }, data ){

            taskAPI.getTask( data.id )
                .then( function( response ){
                commit( 'setTask', response.data );
                })
                .catch( function(){
                commit( 'setTask', {} );
                });
        }
    },

    mutations: {

        setTasks( state, tasks ){
          state.tasks = tasks;
        },

        setTask( state, task ){
          state.task = task;
        }
    },

    getters: {

        getTasks( state ){
          return state.tasks;
        },

        getTask( state ){
          return state.task;
        }
    }
}