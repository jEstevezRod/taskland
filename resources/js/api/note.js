/*
    Imports the Taskland API URL from the config.
*/

import { TASKLAND_CONFIG } from '../config.js';

export default {


    loadNotes: function(data) {

        axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token;

        return axios.get( TASKLAND_CONFIG.API_URL + '/indexNotes/')
    },

    createNotes: function (data){

        axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token;
        console.log(data.data)
        return axios.post(TASKLAND_CONFIG.API_URL + '/storeNotes', data.data)
    },

    updateNote: function( data) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token;

        return axios.put(TASKLAND_CONFIG.API_URL + `/updateNote/${data.data.id}`, data.data.data)
    },

    deleteNote: function( data ){
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token;

        return axios.delete(TASKLAND_CONFIG.API_URL + `/deleteNote/${data.data}`);
    }
}