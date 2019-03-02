/*
    Imports the Taskland API URL from the config.
*/

import { TASKLAND_CONFIG } from '../config.js';

export default {

    newTask: function( data){

        axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token;

        return axios.post( TASKLAND_CONFIG.API_URL + '/tasks',
            {
                project_id: data.data.project_id,
                subject: data.data.subject,
                description: data.data.description,
                state: data.data.state,
                due_date: data.data.due_date,
                progress: data.data.progress
            }
        );
    },
    getTasks: function( data) {

        axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token;
        
        return axios.get( TASKLAND_CONFIG.API_URL + '/loadTasks/'+ data.data )
    },


    updateState : function (data)  {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token;

        return axios.post( TASKLAND_CONFIG.API_URL + '/changeStatus/' + data.data.id, data)

    },

    countAllTasks: function (data) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token;

        return axios.get( TASKLAND_CONFIG.API_URL + '/countTasks')
    },

    loadTask: function (data) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token;

        return axios.get( TASKLAND_CONFIG.API_URL + '/loadTask/' + data.data)

    },

    loadTasksCalendar: function (data) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token;

        return axios.get( TASKLAND_CONFIG.API_URL + '/loadTasksCalendar')
        
    },

    loadUsersInProject: function (data) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token;

        return axios.get( TASKLAND_CONFIG.API_URL + `/loadUsersInProject/${data.data}`)
    }

}