import { TASKLAND_CONFIG } from '../config.js';

export default {

    postNewTeam: function (data) {
        return axios.post( TASKLAND_CONFIG.API_URL + '/newTeam', data)
    }
}