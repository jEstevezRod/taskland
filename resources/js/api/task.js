/*
    Imports the Taskland API URL from the config.
*/

import { TASKLAND_CONFIG } from '../config.js';

export default {


   getTasks: function(){
    return axios.get( TASKLAND_CONFIG.API_URL + '/tasks' );
},
   getTask: function( taskID ){
    return axios.get( TASKLAND_CONFIG.API_URL + '/tasks/' + taskID );
},
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