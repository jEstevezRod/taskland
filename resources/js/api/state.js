import { TASKLAND_CONFIG} from "../config";

export default {

    addNewState: function (data) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token;

        return axios.post( TASKLAND_CONFIG.API_URL + '/addNewState', data)

    },

    loadAllStates: function (data) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token;

        return axios.get( TASKLAND_CONFIG.API_URL + '/loadStates/' + data.data)
    },

    deleteState: function (data) {

        axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token;

        return axios.delete( TASKLAND_CONFIG.API_URL + `/deleteState/${data.data.id}`, data)
    }

}