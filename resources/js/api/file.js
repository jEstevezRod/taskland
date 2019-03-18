/*
    Imports the Taskland API URL from the config.
*/

import { TASKLAND_CONFIG } from '../config.js';

export default {


    loadFile: function(data) {

        axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token;
    }

    
}