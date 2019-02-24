import { TASKLAND_CONFIG} from "../config";


export default {

    addNewUserInProject: function (data) {

        axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token;

        return axios.post( TASKLAND_CONFIG.API_URL + '/addNewUserInProject', data)
    },

    addTeamInProject: function (data) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token;

        return axios.post( TASKLAND_CONFIG.API_URL + '/addTeamToProject', data.data)

    },

}