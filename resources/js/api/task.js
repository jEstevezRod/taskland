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
    newTask: function( data){
        return axios.post( TASKLAND_CONFIG.API_URL + '/tasks',
            {
                project_id: data.project_id,
                subject: data.subject,
                description: data.description,
                state: data.state,
            }
        );
    }

}