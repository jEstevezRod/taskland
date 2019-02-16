import { TASKLAND_CONFIG } from '../config.js';

export default {

    postNewTeam (data) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token;

        return axios.post( TASKLAND_CONFIG.API_URL + '/newTeam', data.data);
    },

    loadTeams: token => {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;

        return axios.get ( TASKLAND_CONFIG.API_URL + '/loadTeams')
    },

    loadTeamAPI: data => {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token;

        return axios.get( TASKLAND_CONFIG.API_URL + `/loadTeam/${data.data}`)
    }
}