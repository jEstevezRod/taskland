/*
    Imports the Roast API URL from the config.
*/

import { TASKLAND_CONFIG } from '../config.js';

export default {

    /*
        GET     /api/v1/tasks
    */
   getTasks: function(){
    return axios.get( TASKLAND_CONFIG.API_URL + '/tasks' );
},
    /*
        GET     /api/v1/tasks/{taskID}
    */
   getTask: function( taskID ){
    return axios.get( TASKLAND_CONFIG.API_URL + '/tasks/' + taskID );
},

    /*
        POST    /api/v1/tasks
    */
    postAddNewTask: function( name, address, city, state, zip ){
        return axios.post( TASKLAND_CONFIG.API_URL + '/tasks',
            {
                name: name,
                address: address,
                city: city,
                state: state,
                zip: zip
            }
        );
    }

}