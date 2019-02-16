import { TASKLAND_CONFIG } from "../config";

export default {

    createComment: function (data) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token;

        return axios.post( TASKLAND_CONFIG.API_URL + '/addNewComment', data.data)
    },

    loadComments: function (data) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token;

        return axios.get( TASKLAND_CONFIG.API_URL + `/loadComments/${data.data}`)
    }
}