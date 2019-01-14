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
    /*
        Defines the state being monitored for the module.
    */
    state: {
        tasks: [],
        tasksLoadStatus: 0,

        task: {},
        taskLoadStatus: 0
    },
    /*
        Defines the actions used to retrieve the data.
    */    
    actions: {
        /*
            Loads the tasks from the API
        */
        loadTasks( { commit } ){

            commit( 'setTasksLoadStatus', 1 );

            taskAPI.getTasks()
                .then( function( response ){
                commit( 'setTasks', response.data );
                commit( 'setTasksLoadStatus', 2 );
                })
                .catch( function(){
                commit( 'setTasks', [] );
                commit( 'setTasksLoadStatus', 3 );
                });

        },
        /*
            Loads an individual task from the API
        */
        loadTask( { commit }, data ){
            commit( 'setTaskLoadStatus', 1 );

            taskAPI.getTask( data.id )
                .then( function( response ){
                commit( 'setTask', response.data );
                commit( 'setTaskLoadStatus', 2 );
                })
                .catch( function(){
                commit( 'setTask', {} );
                commit( 'setTaskLoadStatus', 3 );
                });
        }
    },
    /*
        Defines the mutations used ( setters )
    */
    mutations: {
        /*
            Sets the tasks load status
        */
        setTasksLoadStatus( state, status ){
          state.tasksLoadStatus = status;
        },
        /*
            Sets the tasks
        */
        setTasks( state, tasks ){
          state.tasks = tasks;
        },
        /*
            Set the task load status
        */
        setTaskLoadStatus( state, status ){
          state.taskLoadStatus = status;
        },
        /*
            Set the task
        */
        setTask( state, task ){
          state.task = task;
        }
    },
    /*
        Defines the getters used by the module
    */
    getters: {
        /*
            Returns the tasks load status.
        */
        getTasksLoadStatus( state ){
          return state.tasksLoadStatus;
        },
        /*
            Returns the tasks.
        */
        getTasks( state ){
          return state.tasks;
        },
        /*
            Returns the tasks load status
        */
        getTaskLoadStatus( state ){
          return state.taskLoadStatus;
        },
        /*
            Returns the task
        */
        getTask( state ){
          return state.task;
        }
    }
}